<?php

namespace Drupal\epayco\Event;

/**
 * Class GatewayTransactionEvents.
 *
 * @package Drupal\epayco\Event
 */
final class GatewayTransactionEvents {

  /**
   * Name of the event fired when an ePayco transaction is made.
   *
   * @var string
   */
  const EPAYCO_TRANSACTION_RESPONSE = 'epayco.transaction.response';

}
