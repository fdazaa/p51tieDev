<?php

namespace Drupal\epayco;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Component\Serialization\Json;
use Psr\Log\LoggerInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Epayco\Epayco;

/**
 * Main ePayco service class.
 */
class GatewayHandler implements GatewayHandlerInterface {

  use StringTranslationTrait;

  /**
   * Guzzle Http Client.
   *
   * @var GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * The logger.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * Constructor method.
   *
   * @param \GuzzleHttp\ClientInterface $http_client
   *   The HTTP client.
   * @param \Psr\Log\LoggerInterface $logger
   *   The logger channel.
   */
  public function __construct(ClientInterface $http_client, LoggerInterface $logger) {
    $this->httpClient = $http_client;
    $this->logger = $logger;
  }

  /**
   * We're able to have different clients per store or depending context.
   *
   * @param string $api_key
   *   API key provided by ePayco.
   * @param string $private_key
   *   Private key provided by ePayco.
   * @param string $language
   *   Language code. Ex.: "en", "es".
   * @param bool $test
   *   TRUE or FALSE, depending if operations will be made in test mode.
   */
  public function getFactory($api_key, $private_key, $language, $test) {
    try {
      $epayco = new Epayco([
        'apiKey' => $api_key,
        'privateKey' => $private_key,
        'lenguage' => $language,
        'test' => $test,
      ]);
    }
    catch (\Exception $exception) {
      $epayco = NULL;
      $this->logger->log('error', $exception->getMessage() ?: $this->t('Error initializing ePayco factory.'));
    }

    return $epayco;
  }

  /**
   * Method to execute any factory operation (Experimental).
   *
   * @param \Epayco\Epayco $client_instance
   *   The ePyco client instance.
   * @param string $element_name
   *   The initial object to perform operation.
   * @param string $element_callback
   *   The function name to call from $client_instance->{$element_name}.
   * @param array $params
   *   Array of parameters.
   */
  public function executeFactoryOperation(Epayco $client_instance, $element_name, $element_callback, array $params) {
    $data = [];
    if (isset($client_instance->{$element_name}) && is_object($client_instance->{$element_name}) && $element_callback != '__construct') {
      try {
        $data = call_user_func_array([$client_instance->{$element_name}, $element_callback], $params);
      }
      catch (\Exception $exception) {
        throw new \Exception('Error trying to execute operation: ' . $exception->getMessage());
      }
    }

    return $data;
  }

  /**
   * Method to get a remote transaction status.
   *
   * @param string $transaction_id
   *   The remote transaction ID.
   */
  public function getTransactionRemoteData($transaction_id) {
    $data = [];
    try {
      $response = $this->httpClient->get(GatewayHandlerInterface::EPAYCO_TRANSACTION_DATA_API_URL, [
        'query' => [
          'id_transaccion' => $transaction_id,
        ],
      ]);
      if ($response->getStatusCode() === 200) {
        $data = Json::decode($response->getBody()->getContents());
      }
      else {
        $this->logger->log(
          'error', $this->t('Error requesting transaction information. ID: @transaction_id. Status code: @status_code. Status message: @status_message', [
            '@transaction_id' => $transaction_id,
            '@status_code' => $response->getStatusCode(),
            '@status_message' => $response->getReasonPhrase(),
          ])
        );
      }
    }
    catch (RequestException $requestException) {
      $this->logger->log(
        'error', $this->t('Client exception trying to fetch transaction information. Result was: @exception_message.', [
          '@exception_message' => $requestException->getMessage(),
        ])
      );
    }
    catch (\Exception $exception) {
      $this->logger->log('error', $exception->getMessage() ?: $this->t('General exception'));
    }

    return $data;
  }

  /**
   * Method to get information for a transaction, given a remote reference ID.
   *
   * @param string $reference
   *   The remote reference code.
   */
  public function getReferenceRemoteData($reference) {
    $data = NULL;
    try {
      $response = $this->httpClient->get(GatewayHandlerInterface::EPAYCO_REFERENCE_CODE_BASE_URL . $reference);
      if ($response->getStatusCode() === 200) {
        $data = Json::decode($response->getBody()->getContents());
      }
      else {
        $this->logger->log(
          'error', $this->t('Error requesting reference information for @reference_code. Reason: @status_message', [
            '@reference_code' => $reference,
            '@status_message' => $response->getReasonPhrase(),
          ])
        );
      }
    }
    catch (RequestException $requestException) {
      $this->logger->log(
        'error', $this->t('Client exception trying to fetch reference information. Result was: @exception_message.', [
          '@exception_message' => $requestException->getMessage(),
        ])
      );
    }
    catch (\Exception $exception) {
      $this->logger->log('error', $exception->getMessage() ?: $this->t('General exception trying to get reference data.'));
    }

    return $data;
  }

  /**
   * Method to get list of banks.
   *
   * @param string $public_key
   *   Factory's REST public key (public_key).
   */
  public function getAvailablePseBanks($public_key) {
    $data = NULL;
    try {
      $response = $this->httpClient->get(GatewayHandlerInterface::EPAYCO_PSE_BANKS_LIST_API_URL, [
        'query' => [
          'public_key' => $public_key,
        ],
      ]);
      if ($response->getStatusCode() === 200) {
        $data = Json::decode($response->getBody()->getContents());
      }
      else {
        $this->logger->log(
          'error', $this->t('Error fetching list of banks. Status message: @status_message', [
            '@status_message' => $response->getReasonPhrase(),
          ])
        );
      }
    }
    catch (RequestException $requestException) {
      $this->logger->log(
        'error', $this->t('Client exception trying to fetch banks list. Result was: @exception_message.', [
          '@exception_message' => $requestException->getMessage(),
        ])
      );
    }
    catch (\Exception $exception) {
      $this->logger->log('error', $exception->getMessage() ?: $this->t('General exception trying to fetch banks.'));
    }

    return $data;
  }

  /**
   * Get an encoded signature for standard checkout.
   *
   * @param string $p_cust_id_cliente
   *   The customer client id. Get it from ePayco dashboard.
   * @param string $p_key
   *   The customer key. Get it from ePayco dashboard.
   * @param string $order_id
   *   The Drupal order id.
   * @param string $p_amount
   *   The order amount.
   * @param string $p_currency_code
   *   The order amount currency code.
   */
  public function getPaymentSignature($p_cust_id_cliente, $p_key, $order_id, $p_amount, $p_currency_code) {
    return md5($p_cust_id_cliente . '^' . $p_key . '^' . $order_id . '^' . $p_amount . '^' . $p_currency_code);
  }

}
