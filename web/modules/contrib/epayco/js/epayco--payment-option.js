/**
 * @file
 * Shared javascript file for individual payment options and Drupal commerce.
 *
 * @todo
 * Refactor/improve code in this file.
 */

(function ($, Drupal, drupalSettings) {

  'use strict';

  /**
   * Attaches the ePaycoPaymentOption behavior.
   */
  Drupal.behaviors.ePaycoPaymentOption = {
    attach: function (context) {
      var __self = this;
      // Global settings.
      var settings = drupalSettings.epayco || {};
      // Let's auto-open first element, if it's the case.
      if (typeof settings.paymentOption != 'undefined' && typeof settings.paymentOption.auto_open_first != 'undefined') {
        if (settings.paymentOption.auto_open_first) {
          var $element = $('.js--epayco--payment-option--callback:not(.js--processing)').once().first();
          __self.showPaymentModal(__self.getElementPaymentData($element));
        }
      }
      // Also, attaching click listener to the needed element.
      $(document).once().on('click', '.js--epayco--payment-option--callback:not(.js--processing)', function (event) {
        $(this).addClass('js--processing');
        __self.showPaymentModal(__self.getElementPaymentData($(this)));
      });
    },
    getElementPaymentData: function (element) {
      if (typeof element == 'object') {
        var __self = this;
        var parameters = {
          gateway: {
            key: __self.checkRawValueType($(element).data('epayco-key'), 'string'),
            test: __self.checkRawValueType($(element).data('epayco-test'), 'boolean'),
          },
          checkout: {
            name: __self.checkRawValueType($(element).data('epayco-name'), 'string'),
            description: __self.checkRawValueType($(element).data('epayco-description'), 'string'),
            currency: __self.checkRawValueType($(element).data('epayco-currency'), 'string'),
            amount: __self.checkRawValueType($(element).data('epayco-amount'), 'string'),
            // Optionals.
            tax_base: __self.checkRawValueType($(element).data('epayco-tax-base'), 'string'),
            tax: __self.checkRawValueType($(element).data('epayco-tax'), 'string'),
            external: __self.checkRawValueType($(element).data('epayco-external'), 'boolean'),
            country: __self.checkRawValueType($(element).data('epayco-country'), 'string'),
            lang: __self.checkRawValueType($(element).data('epayco-lang'), 'string'),
            invoice: __self.checkRawValueType($(element).data('epayco-invoice'), 'string'),
            extra1: __self.checkRawValueType($(element).data('epayco-extra1'), 'string'),
            extra2: __self.checkRawValueType($(element).data('epayco-extra2'), 'string'),
            extra3: __self.checkRawValueType($(element).data('epayco-extra3'), 'string'),
            confirmation: __self.checkRawValueType($(element).data('epayco-confirmation'), 'string'),
            response: __self.checkRawValueType($(element).data('epayco-response'), 'string'),
            name_billing: __self.checkRawValueType($(element).data('epayco-name-billing'), 'string'),
            address_billing: __self.checkRawValueType($(element).data('epayco-address-billing'), 'string'),
            type_doc_billing: __self.checkRawValueType($(element).data('epayco-type-doc-billing'), 'string'),
            mobilephone_billing: __self.checkRawValueType($(element).data('epayco-mobilephone-billing'), 'string'),
            number_doc_billing: __self.checkRawValueType($(element).data('epayco-number-doc-billing'), 'string'),
            methodsDisable: __self.checkRawValueType($(element).data('epayco-methods-disable'), 'array')
          }
        };
        return parameters;
      }
      else {
        return {}
      }
    },
    checkRawValueType: function (value, expectedType) {
      var checkedValue = null;
      switch (expectedType) {
        case 'string':
          checkedValue = typeof value != 'undefined' ? value.toString() : '';
          break;

        case 'boolean':
          checkedValue = (typeof value == 'string' && (value.toUpperCase() == 'TRUE' || value === '')) || (typeof value == 'boolean' && value) || (typeof value == 'number' && value == 1);
          break;

        case 'array':
          checkedValue = typeof value == 'string' ? value.split(',') : [];
          break;

        case 'integer':
          checkedValue = value && !isNaN(value) ? parseInt(value) : 0;
          break;

        case 'float':
          checkedValue = value && !isNaN(value) ? parseFloat(value) : 0;
          break;
      }

      return checkedValue;
    },
    showPaymentModal: function (parameters) {
      // Let's open modal, if all required variables are available.
      if (
        typeof ePayco == 'object' &&
        typeof parameters.gateway == 'object' &&
        typeof parameters.checkout == 'object' &&
        typeof parameters.gateway.key == 'string' &&
        typeof parameters.gateway.test == 'boolean' &&
        typeof parameters.checkout.name == 'string' &&
        typeof parameters.checkout.description == 'string' &&
        typeof parameters.checkout.currency == 'string' &&
        !isNaN(parameters.checkout.amount)
      ) {
        // Let's initialize an ePayco handler.
        var ePaycoHandler = ePayco.checkout.configure(parameters.gateway);
        // Callback when closing modal.
        ePaycoHandler.onCloseModal = function () {
          $('.js--epayco--payment-option--callback.js--processing').removeClass('js--processing');
        };
        ePaycoHandler.open(parameters.checkout);
      }
    }
  };

})(jQuery, Drupal, drupalSettings);
