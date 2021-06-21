<?php

namespace Drupal\epayco\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Provides the add form for our ePayco factory entity.
 *
 * @ingroup epayco
 */
class FactoryAddForm extends FactoryFormBase {

  /**
   * {@inheritdoc}
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);

    return $actions;
  }

}
