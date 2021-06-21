<?php

namespace Drupal\epayco\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Provides the edit form for our ePayco factory entity.
 *
 * @ingroup epayco
 */
class FactoryEditForm extends FactoryFormBase {

  /**
   * {@inheritdoc}
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $actions = parent::actions($form, $form_state);
    $actions['submit']['#value'] = $this->t('Update');

    return $actions;
  }

}
