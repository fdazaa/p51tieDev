<?php

namespace Drupal\epayco\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class GatewayTransactionEvent.
 *
 * @package Drupal\epayco\Event
 */
class GatewayTransactionEvent extends Event {

  /**
   * Transaction data.
   *
   * @var array
   */
  protected $data;

  /**
   * Context data.
   *
   * @var array
   */
  protected $context;

  /**
   * GatewayTransactionEvent class constructor.
   *
   * @param array $data
   *   The transaction data.
   * @param array $context
   *   Extra/useful context information.
   */
  public function __construct(array $data, array $context = []) {
    $this->data = $data;
    $this->context = $context;
  }

  /**
   * Return fetched data.
   *
   * @return array
   *   The remote payment data.
   */
  public function getTransactionData() {
    return $this->data;
  }

  /**
   * Return context.
   *
   * @return array
   *   The event context, if available.
   */
  public function getContext() {
    return $this->context;
  }

}
