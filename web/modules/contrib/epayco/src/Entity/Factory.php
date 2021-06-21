<?php

namespace Drupal\epayco\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Epayco\Epayco;

/**
 * Provides an entity to store different settings as needed.
 *
 * @ConfigEntityType(
 *   id = "epayco_factory",
 *   label = @Translation("ePayco factory"),
 *   admin_permission = "administer epayco factory",
 *   handlers = {
 *     "list_builder" = "Drupal\epayco\Controller\FactoryListBuilder",
 *     "form" = {
 *       "add" = "Drupal\epayco\Form\FactoryAddForm",
 *       "edit" = "Drupal\epayco\Form\FactoryEditForm",
 *       "delete" = "Drupal\epayco\Form\FactoryDeleteForm"
 *     }
 *   },
 *   config_prefix = "factory",
 *   config_export = {
 *     "id",
 *     "label",
 *     "client_id",
 *     "client_key",
 *     "api_public_key",
 *     "api_private_key",
 *     "language_code",
 *     "mode"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label"
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/services/epayco/factory/{epayco_factory}/edit",
 *     "delete-form" = "/admin/config/services/epayco/factory/{epayco_factory}/delete"
 *   }
 * )
 */
class Factory extends ConfigEntityBase implements FactoryInterface {

  /**
   * The Drupal entity ID.
   *
   * @var string
   */
  public $id;

  /**
   * The Drupal entity UUID.
   *
   * @var string
   */
  public $uuid;

  /**
   * The Drupal entity label.
   *
   * @var string
   */
  public $label;

  /**
   * The ePayco p_cust_id_client.
   *
   * @var string
   */
  public $client_id;

  /**
   * The ePayco p_key.
   *
   * @var string
   */
  public $client_key;

  /**
   * The ePayco API public_key.
   *
   * @var string
   */
  public $api_public_key;

  /**
   * The ePayco API private_key.
   *
   * @var string
   */
  public $api_private_key;

  /**
   * The epayco language code.
   *
   * @var string
   */
  public $language_code;

  /**
   * The ePayco gateway mode.
   *
   * @var bool
   */
  public $mode;

  /**
   * Get p_cust_id_client.
   */
  public function getClientId() {
    return $this->client_id;
  }

  /**
   * Get p_key.
   */
  public function getKey() {
    return $this->client_key;
  }

  /**
   * Get API public_key.
   */
  public function getApiPublicKey() {
    return $this->api_public_key;
  }

  /**
   * Get API private_key.
   */
  public function getApiPrivateKey() {
    return $this->api_private_key;
  }

  /**
   * Get language code.
   */
  public function getLanguageCode() {
    return $this->language_code;
  }

  /**
   * Check if test mode.
   */
  public function isTestMode() {
    return (boolean) $this->mode;
  }

  /**
   * Get an initialized factory for this configuration.
   */
  public function getFactoryClientInstance() {
    try {
      $epayco = new Epayco([
        'apiKey' => $this->getApiPublicKey(),
        'privateKey' => $this->getApiPrivateKey(),
        'lenguage' => $this->getLanguageCode(),
        'test' => $this->isTestMode(),
      ]);

      return $epayco;
    }
    catch (\Exception $exception) {
      throw new \Exception('Error trying to initialize ePayco factory client: ' . $exception->getMessage());
    }
  }

}
