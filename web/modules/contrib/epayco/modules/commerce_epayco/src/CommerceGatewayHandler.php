<?php

namespace Drupal\commerce_epayco;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Psr\Log\LoggerInterface;
use GuzzleHttp\ClientInterface;
use Drupal\epayco\GatewayHandler;

/**
 * Main Commerce ePayco service class.
 */
class CommerceGatewayHandler extends GatewayHandler {

  /**
   * The entity manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructor method.
   *
   * @param \GuzzleHttp\ClientInterface $http_client
   *   The HTTP client.
   * @param \Psr\Log\LoggerInterface $logger
   *   The logger channel.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   Entity type manager service.
   */
  public function __construct(ClientInterface $http_client, LoggerInterface $logger, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($http_client, $logger);
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * Method to check pending payments. Useful for cron executions.
   *
   * @param array $conf
   *   Values to override into this method.
   */
  public function checkPendingPayments(array $conf = []) {
    $stats = [
      'counters' => [
        '_total' => 0,
      ],
    ];

    $payment_storage = $this->entityTypeManager->getStorage('commerce_payment');

    $query = $payment_storage->getQuery()
      ->condition('payment_gateway', 'epayco_%', 'LIKE')
      ->condition('state', 'authorization')
      ->range(
        isset($conf['limit']['offset']) && is_numeric($conf['limit']['offset']) ? $conf['limit']['offset'] : 0,
        isset($conf['limit']['range']) && is_numeric($conf['limit']['range']) ? $conf['limit']['range'] : 10
      )
      ->sort('payment_id', 'ASC');
    if (isset($conf['properties']['remote_id']) && is_array(isset($conf['properties']['remote_id']))) {
      $query->condition('remote_id', $conf['properties']['remote_id'], 'IN');
    }
    $payments = $payment_storage->loadMultiple($query->execute());
    foreach ($payments as $payment) {
      $remote_data = $this->getTransactionRemoteData($payment->remote_id->getString());
      // Let's validate now returned data.
      $__x_cod_response = isset($remote_data['data']['x_cod_response']) ? $remote_data['data']['x_cod_response'] : NULL;
      $__x_response = isset($remote_data['data']['x_response']) ? $remote_data['data']['x_response'] : NULL;
      switch ($__x_cod_response) {
        case 1:
          $payment->setState('completed');
          $payment->setRemoteState($__x_response);
          $payment->save();
          break;

        case 2:
        case 4:
          $payment->setState('authorization_voided');
          $payment->setRemoteState($__x_response);
          $payment->save();
          break;
      }
      $stats['counters'][$__x_cod_response] = isset($stats['counters'][$__x_cod_response]) ? $stats['counters'][$__x_cod_response] + 1 : 1;
      $stats['counters']['_total'] += 1;
    }

    return $stats;
  }

  /**
   * Helper method to load ePayco-made payments by remote ID.
   *
   * @param array $remote_id
   *   The remote transaction IDs.
   */
  public function loadMultiplePaymentsByRemoteId(array $remote_id) {
    if (!empty($remote_id)) {
      $payment_storage = $this->entityTypeManager->getStorage('commerce_payment');
      $query = $payment_storage->getQuery()
        ->condition('payment_gateway', 'epayco_%', 'LIKE')
        ->condition('remote_id', $remote_id, 'IN')
        ->execute();
      $payments = $payment_storage->loadMultiple($query);

      return $payments;
    }

    return [];
  }

}
