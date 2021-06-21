<?php

namespace Drupal\epayco_business_rules\Plugin\BusinessRulesReactsOn;

use Drupal\business_rules\Plugin\BusinessRulesReactsOnPlugin;

/**
 * Class GatewayTransactionResponse.
 *
 * @package Drupal\epayco_business_rules\Plugin\BusinessRulesReactsOn
 *
 * @BusinessRulesReactsOn(
 *   id = "transaction_response",
 *   label = @Translation("Transaction response"),
 *   description = @Translation("Reacts when a payment transaction is received. By default, this event will work only for paths /epayco/transaction/response and /checkout/{commerce_order}/{step}/return."),
 *   group = @Translation("ePayco"),
 *   eventName = "epayco_business_rules.transaction_response",
 *   hasTargetEntity = FALSE,
 *   hasTargetBundle = FALSE,
 *   priority = 1000,
 * )
 */
class GatewayTransactionResponse extends BusinessRulesReactsOnPlugin {}
