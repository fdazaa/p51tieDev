<?php

namespace Drupal\epayco;

/**
 * Interface for ePayco manager.
 */
interface GatewayHandlerInterface {

  /**
   * The standard checkout API URL.
   *
   * @string
   */
  const EPAYCO_STANDARD_CHECKOUT_API_URL = 'https://secure.payco.co/checkout.php';

  /**
   * The transaction information API URL.
   *
   * @string
   */
  const EPAYCO_TRANSACTION_DATA_API_URL = 'https://secure.payco.co/pasarela/estadotransaccion';

  /**
   * The transaction information by reference code.
   *
   * @string
   */
  const EPAYCO_REFERENCE_CODE_BASE_URL = 'https://secure.epayco.co/validation/v1/reference/';

  /**
   * The transaction information by reference code.
   *
   * @string
   */
  const EPAYCO_PSE_BANKS_LIST_API_URL = 'https://secure.payco.co/restpagos/pse/bancos.json';

  /**
   * The split payments endpoint.
   *
   * @string
   */
  const EPAYCO_SPLIT_PAYMENTS_API_URL = 'https://secure.payco.co/splitpayments.php';

  /**
   * The transactions list.
   *
   * @string
   */
  const EPAYCO_TRANSACTIONS_LIST_API_URL = 'https://apiservices.epayco.co/consulta/transaccion';

  /**
   * The movements list.
   *
   * @string
   */
  const EPAYCO_MOVEMENTS_LIST_API_URL = 'https://apiservices.epayco.co/consulta/movimiento';

}
