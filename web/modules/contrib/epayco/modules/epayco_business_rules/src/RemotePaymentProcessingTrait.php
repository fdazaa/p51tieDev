<?php

namespace Drupal\epayco_business_rules;

/**
 * Provides some useful options for remote payments.
 */
trait RemotePaymentProcessingTrait {

  /**
   * Helper method to get a payment sample data.
   */
  public function getEmptySamplePaymentData() {
    return [
      'success' => FALSE,
      'title_response' => '',
      'text_response' => '',
      'estado' => '',
      'data' => [
        'x_cust_id_cliente' => '',
        'x_ref_payco' => '',
        'x_id_factura' => '',
        'x_id_invoice' => '',
        'x_description' => '',
        'x_amount' => 0,
        'x_amount_country' => 0,
        'x_amount_ok' => 0,
        'x_tax' => 0,
        'x_amount_base' => 0,
        'x_currency_code' => '',
        'x_bank_name' => '',
        'x_cardnumber' => '',
        'x_quotas' => '',
        'x_respuesta' => '',
        'x_response' => '',
        'x_approval_code' => '',
        'x_transaction_id' => '',
        'x_fecha_transaccion' => '',
        'x_transaction_date' => '',
        'x_cod_respuesta' => 0,
        'x_cod_response' => 0,
        'x_response_reason_text' => '',
        'x_cod_transaction_state' => 0,
        'x_transaction_state' => '',
        'x_errorcode' => '',
        'x_franchise' => '',
        'x_business' => '',
        'x_customer_doctype' => '',
        'x_customer_document' => '',
        'x_customer_name' => '',
        'x_customer_lastname' => '',
        'x_customer_email' => '',
        'x_customer_phone' => '',
        'x_customer_movil' => '',
        'x_customer_ind_pais' => '',
        'x_customer_country' => '',
        'x_customer_city' => '',
        'x_customer_address' => '',
        'x_customer_ip' => '',
        'x_signature' => '',
        'x_test_request' => '',
        'x_extra1' => '',
        'x_extra2' => '',
        'x_extra3' => '',
        'x_extra4' => '',
        'x_extra5' => '',
        'x_extra6' => '',
        'x_extra7' => '',
        'x_extra8' => '',
        'x_extra9' => '',
        'x_extra10' => '',
      ],
    ];
  }

  /**
   * Helper method to get payment data in a common structure.
   *
   * @param array $payment_remote_data
   *   The remote data array.
   * @param string $glue
   *   The character(s) to glue array sub-keys.
   */
  public function normalizePaymentData(array $payment_remote_data, $glue = '->') {
    $data = [];
    if (empty($payment_remote_data)) {
      return [];
    }
    foreach ($payment_remote_data as $payment_key => $payment_value) {
      if (is_scalar($payment_value)) {
        $data[$payment_key] = [
          'value' => $payment_value,
          'type' => gettype($payment_value),
        ];
      }
      elseif (is_array($payment_value)) {
        foreach ($payment_value as $payment_subkey => $payment_subvalue) {
          $data[$payment_key . $glue . $payment_subkey] = [
            'value' => is_scalar($payment_subvalue) ? $payment_subvalue : ((is_array($payment_subvalue) || is_object($payment_subvalue)) ? json_encode($payment_subvalue) : 'UNKNOWN'),
            'type' => gettype($payment_subvalue),
          ];
        }
      }
      else {
        // Last step on data definition. Just in case.
        $data[$payment_key] = [
          'value' => 'UNKNOWN',
          'type' => gettype($payment_value),
        ];
      }
    }

    return $data;
  }

}
