<?php

namespace Drupal\epayco_business_rules\EventSubscriber;

use Drupal\business_rules\Events\BusinessRulesEvent;
use Drupal\epayco\Event\GatewayTransactionEvent;
use Drupal\epayco\Event\GatewayTransactionEvents;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class TransactionResponseListener.
 *
 * Provides the subscribed event for transaction responses.
 *
 * @package Drupal\epayco_business_rules\EventSubscriber
 */
class TransactionResponseListener implements EventSubscriberInterface, ContainerAwareInterface {

  use ContainerAwareTrait;

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [GatewayTransactionEvents::EPAYCO_TRANSACTION_RESPONSE => ['onTransactionResponse', 1000]];
  }

  /**
   * Create a new event for BusinessRules plugin GatewayTransactionResponse.
   *
   * @param \Drupal\epayco\Event\GatewayTransactionEvent $event
   *   The event.
   */
  public function onTransactionResponse(GatewayTransactionEvent $event) {
    // The remote transaction data.
    $data = $event->getTransactionData();
    // Now, let's prepare our Business Rules event instance.
    $reacts_on_definition = $this->container->get('plugin.manager.business_rules.reacts_on')->getDefinition('transaction_response');
    $new_event = new BusinessRulesEvent($data, [
      'epayco' => [
        'transaction_data' => $data,
      ],
      'entity_type_id' => NULL,
      'bundle' => NULL,
      'entity' => NULL,
      'entity_unchanged' => NULL,
      'reacts_on' => $reacts_on_definition,
    ]);
    /** @var \Symfony\Component\EventDispatcher\EventDispatcher $event_dispatcher */
    $event_dispatcher = $this->container->get('event_dispatcher');
    $event_dispatcher->dispatch($reacts_on_definition['eventName'], $new_event);
  }

}
