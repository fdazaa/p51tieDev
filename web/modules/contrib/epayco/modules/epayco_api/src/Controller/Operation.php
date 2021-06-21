<?php

namespace Drupal\epayco_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;
use Drupal\epayco\Entity\Factory as ePaycoFactory;
use Drupal\epayco\GatewayHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Operation controller class.
 */
class Operation extends ControllerBase {

  /**
   * The gateway handler.
   *
   * @var \Drupal\epayco\GatewayHandlerInterface
   */
  protected $gatewayHandler;

  /**
   * Class constructor.
   *
   * @param \Drupal\epayco\GatewayHandlerInterface $gateway_handler
   *   The gateway handler.
   */
  public function __construct(GatewayHandlerInterface $gateway_handler) {
    $this->gatewayHandler = $gateway_handler;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('epayco.handler')
    );
  }

  /**
   * Processes POST requests for /epayco/api/operation.
   */
  public function process(ServerRequestInterface $request) {
    $data = [];
    $body = $request->getParsedBody();
    if (!isset($body['type']) || !isset($body['config']) || empty($body['type']) || empty($body['config'])) {
      return new JsonResponse([
        'status' => 'ERROR_INSUFFICIENT_DATA',
        'result' => [],
        'message' => $this->t('Missing needed data to perform any operation.'),
      ]);
    }
    $type = $body['type'];
    $config = $body['config'];
    switch ($type) {
      case 'factory:system':
      case 'factory:custom':
        $data += $this->processFactoryOperation($type, $config);

        break;

      case 'transaction:info':
        $data += $this->processTransactionInfoOperation($config['id']);

        break;

      case 'reference:info':
        $data += $this->processReferenceInfoOperation($config['id']);

        break;

      case 'pse:banks':
        $data += $this->processPseBanksOperation($config['public_key']);

        break;
    }

    return new JsonResponse($data);
  }

  /**
   * Helper method to process factory operation.
   *
   * @param string $factory_type
   *   The factory type to be called. Possible values are:
   *   - factory:system - A previously saved factory.
   *   - factory:custom - Raw factory made with custom values.
   * @param array $factory_config
   *   The needed values to initialize the client instance.
   */
  public function processFactoryOperation($factory_type, array $factory_config) {
    if ($factory_type == 'factory:system') {
      $factory = ePaycoFactory::load($factory_config['factory']);
      if ($factory) {
        $factory_client_instance = $factory->getFactoryClientInstance();
      }
    }
    elseif ($factory_type == 'factory:custom') {
      $factory = $factory_config['factory'];
      if (isset($factory['api_key']) && isset($factory['private_key']) && isset($factory['language']) && isset($factory['test'])) {
        $factory_client_instance = $this->gatewayHandler->getFactory($factory['api_key'], $factory['private_key'], $factory['language'], $factory['test']);
      }
    }
    else {
      return [
        'status' => 'ERROR_INVALID_FACTORY_TYPE',
        'result' => [],
        'message' => $this->t('Invalid factory type.'),
      ];
    }
    // Now, if everything went fine, let's execute operation.
    if (isset($factory_client_instance) && is_object($factory_client_instance)) {
      return [
        'status' => 'OK',
        'result' => $this->gatewayHandler->executeFactoryOperation($factory_client_instance, $factory_config['element'], $factory_config['callback'], Json::decode($factory_config['params'])),
      ];
    }
    return [
      'status' => 'ERROR_INVALID_FACTORY',
      'result' => [],
      'message' => $this->t('Invalid factory.'),
    ];
  }

  /**
   * Helper method to process transaction info operation.
   *
   * @param string $transaction_id
   *   The remote transaction ID.
   */
  public function processTransactionInfoOperation($transaction_id) {
    if ($transaction_id) {
      return [
        'status' => 'OK',
        'result' => $this->gatewayHandler->getTransactionRemoteData($transaction_id),
      ];
    }
    return [
      'status' => 'ERROR_MISSING_TRANSACTION_ID',
      'result' => [],
      'message' => $this->t('Missing transaction ID.'),
    ];
  }

  /**
   * Helper method to process reference info operation.
   *
   * @param string $reference_id
   *   The remote reference ID.
   */
  public function processReferenceInfoOperation($reference_id) {
    if ($reference_id) {
      return [
        'status' => 'OK',
        'result' => $this->gatewayHandler->getReferenceRemoteData($reference_id),
      ];
    }
    return [
      'status' => 'ERROR_MISSING_REFERENCE_ID',
      'result' => [],
      'message' => $this->t('Missing reference ID.'),
    ];
  }

  /**
   * Helper method to process PSE banks operation.
   *
   * @param string $public_key
   *   The factory public key.
   */
  public function processPseBanksOperation($public_key) {
    if ($public_key) {
      return [
        'status' => 'OK',
        'result' => $this->gatewayHandler->getAvailablePseBanks($public_key),
      ];
    }
    return [
      'status' => 'ERROR_MISSING_PUBLIC_KEY',
      'result' => [],
      'message' => $this->t('Missing public key.'),
    ];
  }

}
