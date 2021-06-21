<?php

namespace Drupal\epayco\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Base class for adding and editing.
 *
 * @ingroup epayco
 */
class FactoryFormBase extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $factory = $this->entity;

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $factory->label(),
      '#required' => TRUE,
    ];
    $form['id'] = [
      '#type' => 'machine_name',
      '#title' => $this->t('Machine name'),
      '#default_value' => $factory->id(),
      '#machine_name' => [
        'exists' => [$this, 'exists'],
        'replace_pattern' => '([^a-z0-9_]+)|(^custom$)',
        'error' => 'The machine-readable name must be unique, and can only contain lowercase letters, numbers, and underscores. Additionally, it can not be the reserved word "custom".',
      ],
      '#disabled' => !$factory->isNew(),
    ];
    // Basic settings.
    $form['basic'] = [
      '#type' => 'details',
      '#title' => $this->t('Secret keys'),
      '#description' => $this->t('Values you will need for basic features (for example, when adding a payment gateway).'),
      '#open' => TRUE,
    ];
    $form['basic']['client_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Client ID'),
      '#maxlength' => 15,
      '#default_value' => $factory->getClientId(),
      '#description' => $this->getDefaultApiValueDescription('p_cust_id_cliente'),
      '#required' => TRUE,
    ];
    $form['basic']['client_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Key'),
      '#maxlength' => 255,
      '#default_value' => $factory->getKey(),
      '#description' => $this->getDefaultApiValueDescription('p_key'),
      '#required' => TRUE,
    ];
    // API REST settings.
    $form['api'] = [
      '#type' => 'details',
      '#title' => $this->t('Secret keys Api Rest'),
      '#description' => $this->t('Following are values you will need for advanced features (API callbacks using the ePayco library).'),
      '#open' => TRUE,
    ];
    $form['api']['api_public_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Public key'),
      '#maxlength' => 255,
      '#default_value' => $factory->getApiPublicKey(),
      '#required' => TRUE,
      '#description' => $this->getDefaultApiValueDescription('public_key'),
    ];
    $form['api']['api_private_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Private key'),
      '#maxlength' => 255,
      '#default_value' => $factory->getApiPrivateKey(),
      '#required' => TRUE,
      '#description' => $this->getDefaultApiValueDescription('private_key'),
    ];
    $form['language_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Language code'),
      '#maxlength' => 2,
      '#size' => 10,
      '#default_value' => $factory->getLanguageCode(),
      '#description' => $this->t('Language code needed for the gateway. Examples: ES, EN.'),
      '#required' => TRUE,
    ];
    $form['mode'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Test mode'),
      '#default_value' => $factory->isTestMode(),
    ];

    return $form;
  }

  /**
   * Checks if there is already a record with given id.
   *
   * @param string|int $entity_id
   *   The entity ID.
   * @param array $element
   *   The form element.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return bool
   *   TRUE if entity already exists, FALSE otherwise.
   */
  public function exists($entity_id, array $element, FormStateInterface $form_state) {
    $result = $this->entityTypeManager->getStorage('epayco_factory')->getQuery()
      ->condition('id', $element['#field_prefix'] . $entity_id)
      ->execute();

    return (bool) $result;
  }

  /**
   * Overrides Drupal\Core\Entity\EntityFormController::save().
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   */
  public function save(array $form, FormStateInterface $form_state) {
    $factory = $this->getEntity();
    $status = $factory->save();
    if ($status == SAVED_UPDATED) {
      $this->messenger()->addMessage($this->t('Configuration <em>%label</em> was updated.', ['%label' => $factory->label()]));
    }
    else {
      $this->messenger()->addMessage($this->t('New configuration <em>%label</em> was added.', ['%label' => $factory->label()]));
    }

    $form_state->setRedirect('entity.epayco_factory.list');
  }

  /**
   * Small helper method to just return a shared description format.
   *
   * @param string $key
   *   Single string/key value to be displayed into the message.
   */
  public function getDefaultApiValueDescription($key) {
    return !empty($key) ? $this->t('You may find this value as <em>%key</em> at your ePayco dashboard.', ['%key' => $key]) : '';
  }

}
