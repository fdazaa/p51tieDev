<?php

namespace Drupal\epayco_business_rules\Plugin\BusinessRulesVariable;

use Drupal\business_rules\Entity\Variable;
use Drupal\business_rules\Events\BusinessRulesEvent;
use Drupal\business_rules\ItemInterface;
use Drupal\business_rules\Plugin\BusinessRulesVariablePlugin;
use Drupal\business_rules\VariableObject;
use Drupal\business_rules\VariablesSet;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\epayco_business_rules\RemotePaymentProcessingTrait;

/**
 * Class EmptyPaymentVariable.
 *
 * @package Drupal\business_rules\Plugin\BusinessRulesVariable
 *
 * @BusinessRulesVariable(
 *   id = "epayco_empty_payment",
 *   label = @Translation("ePayco empty payment"),
 *   group = @Translation("ePayco"),
 *   description = @Translation("Set a variable to store remote payment information."),
 *   reactsOnIds = {},
 *   isContextDependent = FALSE,
 *   hasTargetEntity = FALSE,
 *   hasTargetBundle = FALSE,
 *   hasTargetField = FALSE,
 * )
 */
class EmptyPaymentVariable extends BusinessRulesVariablePlugin {

  use StringTranslationTrait;
  use RemotePaymentProcessingTrait;

  /**
   * {@inheritdoc}
   */
  public function getSettingsForm(array &$form, FormStateInterface $form_state, ItemInterface $item) {
    $settings['help'] = [
      '#type'  => 'markup',
      '#markup' => $this->t('After this variable is filled, you will be able to process your data.'),
    ];

    return $settings;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array &$form, FormStateInterface $form_state) {
    unset($form['variables']);
  }

  /**
   * {@inheritdoc}
   */
  public function changeDetails(Variable $variable, array &$row) {
    $content = $this->variableFields($variable);
    $keyvalue = $this->util->getKeyValueExpirable('epayco_empty_payment');
    $keyvalue->set('variableFields.' . $variable->id(), $content);
    $details_link = Link::createFromRoute($this->t('Click here to see the payment values.'),
      'business_rules.ajax.modal',
      [
        'method'  => 'nojs',
        'title'  => $this->t('View values'),
        'collection' => 'epayco_empty_payment',
        'key'  => 'variableFields.' . $variable->id(),
      ],
      [
        'attributes' => [
          'class' => ['use-ajax'],
        ],
      ]
    )->toString();

    $row['description']['data']['#markup'] .= '<br>' . $details_link;
  }

  /**
   * {@inheritdoc}
   */
  public function evaluate(Variable $variable, BusinessRulesEvent $event) {
    /** @var \Drupal\business_rules\VariablesSet $variables */
    $variableSet = new VariablesSet();

    // Since it's a new empty variable, we have to use sample data.
    $payment_data = $this->getEmptySamplePaymentData();

    // Setting our global variable.
    $variableObject = new VariableObject($variable->id(), $payment_data, $variable->getType());
    $variableSet->append($variableObject);

    // Let's manage rest of variables.
    foreach ($this->normalizePaymentData($payment_data, '->') as $key => $values) {
      $variableObject = new VariableObject($variable->id() . '->' . $key, $values['value'], $variable->getType());
      $variableSet->append($variableObject);
    }

    return $variableSet;
  }

  /**
   * Display the payment variable fields.
   *
   * @param \Drupal\business_rules\Entity\Variable $variable
   *   The variable entity.
   */
  public function variableFields(Variable $variable) {
    $header = [
      'variable' => $this->t('Variable'),
      'field' => $this->t('Field'),
      'type'  => $this->t('Type'),
    ];
    $rows = [];
    $payment_data = $this->getEmptySamplePaymentData();
    foreach ($this->normalizePaymentData($payment_data, '->') as $key => $values) {
      $rows[] = [
        'variable' => ['data' => ['#markup' => '{{' . $variable->id() . '->' . $key . '}}']],
        'field'  => ['data' => ['#markup' => $key]],
        'type'  => ['data' => ['#markup' => $values['type']]],
      ];
    }
    $content['variable_fields'] = [
      '#type'   => 'table',
      '#header' => $header,
      '#rows'   => $rows,
      '#sticky' => TRUE,
    ];

    return $content;
  }

}
