<?php

namespace Drupal\epayco_business_rules\Plugin\BusinessRulesAction;

use Drupal\business_rules\ActionInterface;
use Drupal\business_rules\Events\BusinessRulesEvent;
use Drupal\business_rules\ItemInterface;
use Drupal\business_rules\Plugin\BusinessRulesActionPlugin;
use Drupal\business_rules\VariableObject;
use Drupal\business_rules\VariablesSet;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\epayco_business_rules\RemotePaymentProcessingTrait;

/**
 * Class FetchPaymentAction.
 *
 * @package Drupal\business_rules\Plugin\BusinessRulesAction
 *
 * @BusinessRulesAction(
 *   id = "epayco_fetch_payment",
 *   label = @Translation("Fetch payment"),
 *   group = @Translation("ePayco"),
 *   description = @Translation("Request payment information from ePayco."),
 *   isContextDependent = FALSE,
 *   hasTargetEntity = FALSE,
 *   hasTargetBundle = FALSE,
 *   hasTargetField = FALSE,
 * )
 */
class FetchPaymentAction extends BusinessRulesActionPlugin {

  use StringTranslationTrait;
  use RemotePaymentProcessingTrait;

  /**
   * The gateway handler.
   *
   * @var \Drupal\epayco\GatewayHandlerInterface
   */
  protected $gatewayHandler;

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * The current path stack.
   *
   * @var \Drupal\Core\Path\CurrentPathStack
   */
  protected $currentPath;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration = [], $plugin_id = 'action_set', $plugin_definition = []) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->gatewayHandler = $this->util->container->get('epayco.handler');
    $this->requestStack = $this->util->container->get('request_stack');
    $this->currentPath = $this->util->container->get('path.current');
  }

  /**
   * {@inheritdoc}
   */
  public function getSettingsForm(array &$form, FormStateInterface $form_state, ItemInterface $item) {
    $settings['variable'] = [
      '#type' => 'select',
      '#title' => $this->t('Variable to store the remote information'),
      '#options' => $this->util->getVariablesOptions(['epayco_empty_payment']),
      '#default_value' => $item->getSettings('variable'),
      '#required' => TRUE,
      '#description'  => $this->t('The variable to store the value. Only variables of type "ePayco payment info" are allowed.'),
    ];
    $settings['reference_origin'] = [
      '#type'  => 'select',
      '#title' => $this->t('Value origin/type'),
      '#options' => [
        'custom' => $this->t('Custom'),
        'path_argument' => $this->t('Path argument'),
        'query_string' => $this->t('Query string'),
        'event_argument' => $this->t('Event argument'),
      ],
      '#default_value' => $item->getSettings('reference_origin'),
      '#description' => $this->getConfigurationOptionHelp('reference_origin'),
    ];
    $settings['reference_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Value/Reference'),
      '#default_value' => $item->getSettings('reference_value'),
      '#description' => $this->getConfigurationOptionHelp('reference_value'),
      '#states' => [
        'invisible' => [
          ':input[name="reference_origin"]' => ['value' => 'event_argument'],
        ],
      ],
    ];

    return $settings;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    if ($values['reference_origin'] != 'event_argument' && empty($values['reference_value'])) {
      $form_state->setErrorByName('reference_value', $this->t('If using an option different to "%field_origin", "%field_value" can not be empty.', [
        '%field_origin' => $this->t('Event argument'),
        '%field_value' => $this->t('Value/Reference'),
      ]));
    }
    if ($values['reference_origin'] == 'path_argument' && !intval($values['reference_value'])) {
      $form_state->setErrorByName('reference_value', $this->t('To use "%field_origin", "%field_value" should be an integer greater than or equal to 1.', [
        '%field_origin' => $this->t('Path argument'),
        '%field_value' => $this->t('Value/Reference'),
      ]));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function processSettings(array $settings, ItemInterface $item) {
    if ($settings['reference_origin'] == 'event_argument') {
      $settings['reference_value'] = '';
    }

    return $settings;
  }

  /**
   * {@inheritdoc}
   */
  public function getVariables(ItemInterface $item) {
    $variableSet = parent::getVariables($item);
    $variableObj = new VariableObject($item->getSettings('variable'), NULL, 'epayco_empty_payment');
    $variableSet->append($variableObj);

    return $variableSet;
  }

  /**
   * {@inheritdoc}
   */
  public function execute(ActionInterface $action, BusinessRulesEvent $event) {
    /** @var \Drupal\business_rules\VariablesSet $variables */
    $variables = $event->getArgument('variables');
    $processed_variables = $this->fetchPaymentVariables($action, $variables, $event);
    $event->setArgument('variables', $processed_variables);
    $result = [
      '#type' => 'markup',
      '#markup' => $this->t('Fetching result for %reference, from %type.', [
        '%reference' => $action->getSettings('reference_value'),
        '%type' => $action->getSettings('reference_origin'),
      ]),
    ];

    return $result;
  }

  /**
   * Helper method to fetch/prepare variables.
   *
   * @param \Drupal\business_rules\ActionInterface $action
   *   The current action being executed.
   * @param \Drupal\business_rules\VariablesSet $event_variables
   *   The group of variables into the current event.
   * @param \Drupal\business_rules\Events\BusinessRulesEvent $event
   *   The event class where this action is added to.
   */
  public function fetchPaymentVariables(ActionInterface $action, VariablesSet $event_variables, BusinessRulesEvent $event) {
    $origin = $action->getSettings('reference_origin');
    $value = $origin != 'event_argument' ? parent::processVariables($action->getSettings('reference_value'), $event_variables) : '';
    $empty_variable = $action->getSettings('variable');

    if ($origin == 'event_argument') {
      $_pdr = $event->hasArgument('epayco') ? $event->getArgument('epayco')['transaction_data'] : [];
    }
    else {
      if ($origin == 'path_argument') {
        if ($value = intval($value) && $fragments = explode('/', $this->currentPath->getPath())) {
          $reference = isset($fragments[$value]) ? $fragments[$value] : NULL;
        }
      }
      elseif ($origin == 'query_string') {
        $reference = $this->requestStack->getCurrentRequest()->query->get($value);
      }
      else {
        $reference = $value;
      }
      $_pdr = $reference ? $this->gatewayHandler->getTransactionRemoteData($reference) : [];
    }
    // Let's "normalize" payment info keys with a common structure.
    $_pdn = $this->normalizePaymentData($_pdr, '->');

    if ($event_variables->count() && !empty($_pdn)) {
      foreach ($event_variables->getVariables() as $variable) {
        if ($variable->getType() == 'epayco_empty_payment' && $empty_variable == substr($variable->getId(), 0, strlen($empty_variable))) {
          $variable_id = $variable->getId();
          if ($variable_id == $empty_variable) {
            $event_variables->replaceValue($variable_id, $_pdr);
          }
          else {
            // Remove "variable_name->" from current variable id,
            // to get proper value from the normalized array.
            $search_key = str_replace($empty_variable . '->', '', $variable_id);
            if (isset($_pdn[$search_key])) {
              $event_variables->replaceValue($variable_id, $_pdn[$search_key]['value']);
            }
          }
        }
      }
    }

    return $event_variables;
  }

  /**
   * Helper method to get help texts.
   *
   * @param string $option
   *   The field/option to get help to.
   */
  private function getConfigurationOptionHelp($option) {
    switch ($option) {
      case 'reference_origin':
        return $this->t('
          The value that will determine origin of passed remote payment ID to the gateway:<br/>
          <strong>Custom</strong>: You will provide a fixed or variable as parameter.<br/>
          <strong>Path argument</strong>: Payment data will be fetched for the N-th raw value in current path specified in field "%origin_label".
          So, this value should be an integer telling argument position. use "1" for first argument, "2" for second, "3" for third, and so on.
          For a path like "%example_path", first value (1) is "%example_value1", second (2) is "%example_value2" and third value (3) is "%example_value3".<br/>
          <strong>Query string</strong>: Value will be fetched from a query string key on current path, specified into the field "%origin_label". For example,
          to get value "%example_value4" from "%example_path_qs", you should fill field "%origin_label" with "%example_value5".<br/>
          <strong>Event argument</strong>: Use this option only if this action is added when using on event "Transaction response". This will catch response
          from parent event.
        ', [
          '%example_path' => '/entity/1/operation',
          '%example_path_qs' => '/your-page?reference=1234567890',
          '%example_value1' => 'entity',
          '%example_value2' => '1',
          '%example_value3' => 'operation',
          '%example_value4' => '1234567890',
          '%example_value5' => 'reference',
          '%origin_label' => $this->t('Value/Reference'),
        ]);

      case 'reference_value':
        return $this->t('The remote payment ID to be fetched. Origin of this value depends on option selected for field "%origin_label".', [
          '%origin_label' => $this->t('Value origin/type'),
        ]);

      default:
        return '';
    }
  }

}
