<?php
/**
 * Review order table - Intermobile Containers Hub
 * Includes interactive (+) and (-) quantity stepper controls for real-time item increment/decrement.
 *
 * @package IMCH
 */

defined( 'ABSPATH' ) || exit;
?>
<table class="shop_table woocommerce-checkout-review-order-table imch-checkout-review-table">
    <thead>
        <tr>
            <th class="product-name"><?php esc_html_e( 'Container Unit', 'woocommerce' ); ?></th>
            <th class="product-total"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        do_action( 'woocommerce_review_order_before_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $visible  = apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && $visible ) {
                $thumbnail = $_product->get_image( array( 72, 54 ) );
                $unit_price = WC()->cart->get_product_price( $_product );
                ?>
                <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item imch-checkout-cart-item-row', $cart_item, $cart_item_key ) ); ?>">
                    <td class="product-name">
                        <div class="imch-co-item-flex">
                            <div class="imch-co-item-thumb">
                                <?php echo $thumbnail; ?>
                            </div>
                            <div class="imch-co-item-details">
                                <span class="imch-co-item-title">
                                    <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
                                </span>
                                <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                                <span class="imch-co-item-unit-price"><?php echo wp_kses_post( $unit_price ); ?> each</span>

                                <!-- Interactive Plus / Minus Stepper in Checkout -->
                                <div class="imch-co-qty-control" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>">
                                    <span class="imch-co-qty-label"><?php esc_html_e( 'Qty:', 'imch' ); ?></span>
                                    <div class="imch-checkout-qty-stepper">
                                        <button type="button" 
                                                class="imch-checkout-qty-btn imch-qty-minus" 
                                                data-key="<?php echo esc_attr( $cart_item_key ); ?>" 
                                                aria-label="<?php esc_attr_e( 'Decrease quantity', 'imch' ); ?>" 
                                                title="<?php esc_attr_e( 'Decrease quantity', 'imch' ); ?>">−</button>
                                        <span class="imch-checkout-qty-val" id="qty-val-<?php echo esc_attr( $cart_item_key ); ?>"><?php echo esc_html( $cart_item['quantity'] ); ?></span>
                                        <button type="button" 
                                                class="imch-checkout-qty-btn imch-qty-plus" 
                                                data-key="<?php echo esc_attr( $cart_item_key ); ?>" 
                                                aria-label="<?php esc_attr_e( 'Increase quantity', 'imch' ); ?>" 
                                                title="<?php esc_attr_e( 'Increase quantity', 'imch' ); ?>">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="product-total">
                        <div class="imch-co-subtotal-val">
                            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                        </div>
                    </td>
                </tr>
                <?php
            }
        }

        do_action( 'woocommerce_review_order_after_cart_contents' );
        ?>
    </tbody>
    <tfoot>

        <tr class="cart-subtotal imch-totals-row">
            <th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
            <td><?php wc_cart_totals_subtotal_html(); ?></td>
        </tr>

        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> imch-totals-row">
                <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                <td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
            <tr class="shipping-row imch-totals-row">
                <th><?php esc_html_e( 'Delivery Freight', 'woocommerce' ); ?></th>
                <td><?php wc_cart_totals_shipping_html(); ?></td>
            </tr>
            <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
        <?php endif; ?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <tr class="fee imch-fee-row imch-totals-row">
                <th>
                    <span class="imch-fee-name"><?php echo esc_html( $fee->name ); ?></span>
                    <?php if ( stripos( $fee->name, 'Discount' ) !== false || stripos( $fee->name, '10%' ) !== false ) : ?>
                        <span class="imch-badge-savings">SAVINGS APPLIED</span>
                    <?php endif; ?>
                </th>
                <td class="imch-fee-amount"><?php wc_cart_totals_fee_html( $fee ); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
            <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                    <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> imch-totals-row">
                        <th><?php echo esc_html( $tax->label ); ?></th>
                        <td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr class="tax-total imch-totals-row">
                    <th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
                    <td><?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

        <tr class="order-total imch-order-total-row">
            <th><?php esc_html_e( 'Total Amount', 'woocommerce' ); ?></th>
            <td><?php wc_cart_totals_order_total_html(); ?></td>
        </tr>

        <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

    </tfoot>
</table>
