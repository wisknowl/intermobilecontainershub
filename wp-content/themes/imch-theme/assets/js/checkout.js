/**
 * Intermobile Containers Hub (ICHub)
 * WooCommerce Checkout Dynamic Discount, Payment Cards & Real-Time Stepper
 *
 * @package IMCH
 */

(function ($) {
  'use strict';

  function markSelectedPaymentMethod() {
    var chosenMethod = $('input[name="payment_method"]:checked').val();
    $('ul.payment_methods li').removeClass('is-selected');
    if (chosenMethod) {
      $('.payment_method_' + chosenMethod).addClass('is-selected');
    }
  }

  $(document).ready(function () {
    // Suppress intrusive jQuery blockUI gray overlays on checkout
    if ($.blockUI) {
      $.blockUI.defaults.overlayCSS = {
        backgroundColor: 'transparent',
        opacity: 0,
        cursor: 'default'
      };
      $.blockUI.defaults.message = null;
      $.blockUI.defaults.css = {
        display: 'none',
        opacity: 0
      };
    }

    markSelectedPaymentMethod();

    // 1. Payment Method Card Selection
    $(document).on('change', 'input[name="payment_method"]', function () {
      markSelectedPaymentMethod();
      $('body').trigger('update_checkout');
    });

    $(document).on('updated_checkout', function () {
      markSelectedPaymentMethod();
    });

    // Also clicking anywhere on the payment method LI activates the radio
    $(document).on('click', 'ul.payment_methods li.wc_payment_method', function (e) {
      if ($(e.target).is('input[type="radio"]') || $(e.target).closest('a').length) {
        return;
      }
      var $radio = $(this).find('input[type="radio"]');
      if ($radio.length && !$radio.is(':checked')) {
        $radio.prop('checked', true).trigger('change');
      }
    });

    // 2. Real-Time Quantity Stepper (+ / -) in Checkout
    $(document).on('click', '.imch-checkout-qty-btn', function (e) {
      e.preventDefault();
      e.stopPropagation();

      var $btn = $(this);
      var key = $btn.data('key');
      var actionType = $btn.hasClass('imch-qty-plus') ? 'plus' : 'minus';
      var $stepper = $btn.closest('.imch-checkout-qty-stepper');

      if ($btn.prop('disabled') || $stepper.hasClass('is-loading') || !key) {
        return;
      }

      $stepper.addClass('is-loading');
      $btn.prop('disabled', true);

      // Optimistic numeric display change
      var $valSpan = $stepper.find('.imch-checkout-qty-val');
      var currentVal = parseInt($valSpan.text(), 10) || 1;
      var anticipatedVal = actionType === 'plus' ? currentVal + 1 : Math.max(0, currentVal - 1);
      if (anticipatedVal > 0) {
        $valSpan.text(anticipatedVal);
      }

      var ajaxEndpoint = (window.imchData && window.imchData.ajaxUrl) ? window.imchData.ajaxUrl : '/wp-admin/admin-ajax.php';

      $.ajax({
        url: ajaxEndpoint,
        type: 'POST',
        dataType: 'json',
        data: {
          action: 'imch_update_checkout_qty',
          cart_item_key: key,
          action_type: actionType,
        },
        success: function (res) {
          if (res && res.success) {
            if (res.data.is_empty) {
              window.location.href = res.data.cart_url || '/cart/';
              return;
            }

            // Update header cart pill counters
            if ($('#imch-cart-counter').length) {
              $('#imch-cart-counter').text(res.data.cart_count);
            }
            if ($('.imch-cart-total-text').length) {
              $('.imch-cart-total-text').html(res.data.cart_total);
            }

            // Trigger checkout recalculation so fees (10% discount) and totals refresh
            $('body').trigger('update_checkout');
          } else {
            $('body').trigger('update_checkout');
          }
        },
        error: function () {
          $('body').trigger('update_checkout');
        },
        complete: function () {
          $btn.prop('disabled', false);
          $stepper.removeClass('is-loading');
        }
      });
    });
  });
})(jQuery);
