<?php

namespace Drupal\epayco;

use Drupal\Core\Url;

/**
 * Service class to handle several payment options.
 */
class PaymentOptionsHandler implements PaymentOptionsHandlerInterface {

  /**
   * Build a custom clickable HTML element to launch a payment.
   *
   * @param array $checkout_values
   *   The needed values to be used as attributes for this element.
   *   See https://docs.epayco.co/payments/checkout related to custom checkout.
   * @param array $context
   *   Extra useful information.
   */
  public function buildRenderablePaymentOption(array $checkout_values, array $context = []) {
    $missing = array_diff([
      'key',
      'test',
      'name',
      'description',
      'currency',
      'amount',
    ], array_keys($checkout_values));
    if (!isset($checkout_values['response'])) {
      $checkout_values['response'] = Url::fromRoute('epayco.transaction.default_response', [], ['absolute' => TRUE])->toString();
    }
    $option = [
      '#type' => 'container',
      '#attributes' => [
        'class' => [
          'epayco--payment-option--container',
          empty($missing) ? 'js--epayco--payment-option--callback' : 'js--epayco--payment-option--error',
        ],
      ] + $this->convertPaymentValuesToAttributes($checkout_values),
      '#attached' => [
        'library' => [
          'epayco/payment.option.behavior',
        ],
      ],
      'option' => [
        '#theme' => 'epayco__payment_option',
        '#context' => $context + [
          'epayco' => [
            'data' => [
              'provided' => $checkout_values,
              'missing' => $missing,
            ],
          ],
        ],
      ],
    ];

    return $option;
  }

  /**
   * Convert payment keys from "attribute_name" to "data-epayco-attribute-name".
   *
   * As described at https://docs.epayco.co/payments/checkout.
   *
   * @param array $checkout_values
   *   The values to convert.
   *
   * @todo
   *   Is this needed, or is there another way?. Values will be re-mapped back
   *   to its original key in JS side. But sending them with raw keys could
   *   overlap with other attributes.
   */
  protected function convertPaymentValuesToAttributes(array $checkout_values) {
    $mapped = [];
    if (!empty($checkout_values)) {
      $mappings = [
        'key' => 'data-epayco-key',
        'test' => 'data-epayco-test',
        'name' => 'data-epayco-name',
        'description' => 'data-epayco-description',
        'currency' => 'data-epayco-currency',
        'amount' => 'data-epayco-amount',
        // Optionals.
        'tax_base' => 'data-epayco-tax-base',
        'tax' => 'data-epayco-tax',
        'external' => 'data-epayco-external',
        'country' => 'data-epayco-country',
        'lang' => 'data-epayco-lang',
        'invoice' => 'data-epayco-invoice',
        'extra1' => 'data-epayco-extra1',
        'extra2' => 'data-epayco-extra2',
        'extra3' => 'data-epayco-extra3',
        'confirmation' => 'data-epayco-confirmation',
        'response' => 'data-epayco-response',
        'name_billing' => 'data-epayco-name-billing',
        'address_billing' => 'data-epayco-address-billing',
        'type_doc_billing' => 'data-epayco-type-doc-billing',
        'mobilephone_billing' => 'data-epayco-mobilephone-billing',
        'number_doc_billing' => 'data-epayco-number-doc-billing',
        'methodsDisable' => 'data-epayco-methods-disable',
      ];
      foreach ($checkout_values as $name => $value) {
        if (isset($mappings[$name])) {
          $mapped[$mappings[$name]] = $value;
        }
      }
    }

    return $mapped;
  }

}
