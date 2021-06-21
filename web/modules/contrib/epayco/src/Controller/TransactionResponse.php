<?php

namespace Drupal\epayco\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\epayco\Event\GatewayTransactionEvent;
use Drupal\epayco\Event\GatewayTransactionEvents;
use Drupal\epayco\GatewayHandlerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Provides a default response page for transactions.
 */
class TransactionResponse implements ContainerInjectionInterface {

  /**
   * The gateway handler.
   *
   * @var \Drupal\commerce_epayco\GatewayHandlerInterface
   */
  protected $gatewayHandler;

  /**
   * The event dispatcher service.
   *
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $eventDispatcher;

  /**
   * The request.
   *
   * @var \Symfony\Component\HttpFoundation\Request
   */
  protected $request;

  /**
   * The logger.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * Constructs a new TransactionResponse controller.
   *
   * @param \Drupal\epayco\GatewayHandlerInterface $gateway_handler
   *   The gateway handler.
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $event_dispatcher
   *   The event dispatcher.
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The request stack.
   * @param \Psr\Log\LoggerInterface $logger
   *   The logger.
   */
  public function __construct(GatewayHandlerInterface $gateway_handler, EventDispatcherInterface $event_dispatcher, RequestStack $request_stack, LoggerInterface $logger) {
    $this->gatewayHandler = $gateway_handler;
    $this->eventDispatcher = $event_dispatcher;
    $this->request = $request_stack->getCurrentRequest();
    $this->logger = $logger;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('epayco.handler'),
      $container->get('event_dispatcher'),
      $container->get('request_stack'),
      $container->get('epayco.logger')
    );
  }

  /**
   * Catch/fire event after doing an ePayco transaction.
   */
  public function responsePage() {
    $remote_ref = $this->request->query->get('ref_payco');
    $data = [];
    try {
      if (strlen($remote_ref) > 0) {
        $data = $this->gatewayHandler->getReferenceRemoteData($remote_ref);
        // We'll dispatch event only if it's a valid transaction.
        if ($data['success']) {
          /** @var \Drupal\epayco\Event\GatewayTransactionEvent $event */
          $event = new GatewayTransactionEvent($data);
          $this->eventDispatcher->dispatch(GatewayTransactionEvents::EPAYCO_TRANSACTION_RESPONSE, $event);
        }
      }
    }
    catch (\Exception $e) {
      $this->logger->error($e->getMessage());
    }

    return [
      '#theme' => 'epayco__transaction_response',
      '#data' => $data,
      '#context' => [],
    ];
  }

  /**
   * Check access to the page, if needed conditions are met.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The current user account.
   */
  public function checkAccess(AccountInterface $account) {
    $remote_ref = $this->request->query->get('ref_payco');
    $access = AccessResult::allowedIf(strlen($remote_ref) > 0)
      ->andIf(AccessResult::allowedIfHasPermission($account, 'access epayco transaction response'))
      ->addCacheableDependency($remote_ref);

    return $access;
  }

}
