<?php

/**
 * @file
 * Hooks specific to the Commerce ePayco module.
 */

use Drupal\commerce_payment\Entity\PaymentInterface;

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Alter ePayco data before sending it to the Gateway.
 */
function hook_commerce_epayco_payment_data_alter(PaymentInterface $payment, array &$parameters) {
}

/**
 * @} End of "addtogroup hooks".
 */
