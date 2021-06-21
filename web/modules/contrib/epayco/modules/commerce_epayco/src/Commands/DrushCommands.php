<?php

namespace Drupal\commerce_epayco\Commands;

use Drush\Commands\DrushCommands as DrushCommandsBase;
use Drupal\epayco\GatewayHandlerInterface;

/**
 * Defines Drush commands for the Search API.
 */
class DrushCommands extends DrushCommandsBase {

  /**
   * The gateway handler.
   *
   * @var \Drupal\commerce_epayco\GatewayHandlerInterface
   */
  protected $gatewayHandler;

  /**
   * Constructor method.
   *
   * @param \Drupal\commerce_epayco\GatewayHandlerInterface $gateway_handler
   *   The gateway handler.
   */
  public function __construct(GatewayHandlerInterface $gateway_handler) {
    parent::__construct();

    $this->gatewayHandler = $gateway_handler;
  }

  /**
   * Check pending payments.
   *
   * @command commerce_epayco:check_pending_payments
   *
   * @option remote_id
   *   One or several transaction IDs, separated by comma.
   * @option offset
   *   The amount of items to skip.
   * @option range
   *   The max of items to process.
   *
   * @usage drush commerce_epayco:check_pending_payments
   *   Check for pending payments with default configuration.
   * @usage drush commerce_epayco:check_pending_payments --remote_id=xxx,xxx,xxx
   *   Check only payments with specified remote transaction IDs.
   * @usage drush commerce_epayco:check_pending_payments --offset=numeric_value --range=numeric_value
   *   Set a query range to check:
   *   --offset: Amount of elements to skip.
   *   --range: Amount of elements to process.
   *
   * @aliases epayco-check-pending-payments
   */
  public function checkPendingPayments(
    array $options = [
      'remote_id' => NULL,
      'offset' => NULL,
      'range' => NULL,
    ]) {
    $conf = [
      'limit' => [
        'offset' => $options['offset'],
        'range' => $options['range'],
      ],
      'properties' => [
        'remote_id' => array_filter(explode(',', preg_replace('/\s/', '', $options['remote_id']))),
      ],
    ];
    $stats = $this->gatewayHandler->checkPendingPayments($conf);
    $this->output()->writeln(dt('Total processed payments: @total', ['@total' => $stats['counters']['_total']]));
  }

}
