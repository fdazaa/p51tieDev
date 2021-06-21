<?php

namespace Drupal\epayco\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of factory entities.
 *
 * @ingroup epayco
 */
class FactoryListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  protected function getModuleName() {
    return 'epayco';
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header = [
      'label' => $this->t('Label'),
      'machine_name' => $this->t('Machine name'),
      'info' => $this->t('Data'),
    ];

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row = [
      'label' => $entity->label(),
      'machine_name' => $entity->id(),
      'info' => [
        '#theme' => 'item_list',
        '#items' => [],
      ],
    ];
    foreach ($this->getVars($entity) as $key => $value) {
      array_push($row['info']['#items'], $key . ': ' . $value);
    }
    $row['info'] = render($row['info']);

    return $row + parent::buildRow($entity);
  }

  /**
   * Get a list of available useful variables to be shown.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity to fetch values from.
   */
  public function getVars(EntityInterface $entity) {
    return [
      'p_cust_id_cliente' => $entity->getClientId(),
      'p_key' => $entity->getKey(),
      'public_key' => $entity->getApiPublicKey(),
      'private_key' => $entity->getApiPrivateKey(),
      'language' => $entity->getLanguageCode(),
      'mode' => $entity->isTestMode() ? $this->t('True') : $this->t('False'),
    ];
  }

}
