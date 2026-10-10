<?php
/**
 * Cart Page Template - Intermobile Containers Hub
 * Modern, Mobile-First, Industrial Theme Layout
 *
 * @package IMCH
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="imch-cart-container">
    <div class="imch-cart-grid">
        <!-- Left Column: Cart Form & Items -->
        <div class="imch-cart-main-col">
            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                <?php do_action( 'woocommerce_before_cart_table' ); ?>

                <div class="imch-cart-table-wrapper">
                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-remove"><span class="screen-reader-text"><?php esc_html_e( 'Remove item', 'woocommerce' ); ?></span></th>
                                <th class="product-thumbnail"><span class="screen-reader-text"><?php esc_html_e( 'Thumbnail image', 'woocommerce' ); ?></span></th>
                                <th class="product-name"><?php esc_html_e( 'Container Unit', 'woocommerce' ); ?></th>
                                <th class="product-price"><?php esc_html_e( 'Unit Price', 'woocommerce' ); ?></th>
                                <th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                                <th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                            <?php
                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                $visible    = apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key );

                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && $visible ) {
                                    $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                    $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( array( 100, 75 ) ), $cart_item, $cart_item_key );
                                    ?>
                                    <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item imch-cart-item-row', $cart_item, $cart_item_key ) ); ?>">
                                        
                                        <!-- Remove Button -->
                                        <td class="product-remove">
                                            <?php
                                            echo apply_filters(
                                                'woocommerce_cart_item_remove_link',
                                                sprintf(
                                                    '<a role="button" href="%s" class="remove imch-remove-btn" aria-label="%s" data-product_id="%s" data-product_sku="%s" title="%s">&times;</a>',
                                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                    esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                                    esc_attr( $product_id ),
                                                    esc_attr( $_product->get_sku() ),
                                                    esc_attr__( 'Remove item', 'imch' )
                                                ),
                                                $cart_item_key
                                            );
                                            ?>
                                        </td>

                                        <!-- Thumbnail -->
                                        <td class="product-thumbnail">
                                            <?php
                                            if ( ! $product_permalink ) {
                                                echo $thumbnail;
                                            } else {
                                                printf( '<a href="%s" class="imch-cart-thumb-link">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                            }
                                            ?>
                                        </td>

                                        <!-- Product Title & Details -->
                                        <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                            <div class="imch-cart-prod-meta">
                                                <?php
                                                if ( ! $product_permalink ) {
                                                    echo '<span class="imch-cart-title">' . wp_kses_post( $product_name ) . '</span>';
                                                } else {
                                                    echo '<a href="' . esc_url( $product_permalink ) . '" class="imch-cart-title">' . wp_kses_post( $product_name ) . '</a>';
                                                }

                                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                                                echo wc_get_formatted_cart_item_data( $cart_item );

                                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                                }
                                                ?>
                                                <span class="imch-cart-condition-tag">✓ CSC Certified Wind &amp; Watertight</span>
                                            </div>
                                        </td>

                                        <!-- Unit Price -->
                                        <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                            <div class="imch-cart-price-wrap">
                                                <span class="imch-mobile-label"><?php esc_html_e( 'Unit Price:', 'imch' ); ?></span>
                                                <span class="imch-price-amount"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></span>
                                            </div>
                                        </td>

                                        <!-- Quantity Stepper -->
                                        <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                            <div class="imch-cart-qty-wrap">
                                                <span class="imch-mobile-label"><?php esc_html_e( 'Quantity:', 'imch' ); ?></span>
                                                <div class="imch-stepper">
                                                    <button type="button" class="imch-stepper-btn imch-stepper-minus" aria-label="<?php esc_attr_e( 'Decrease quantity', 'imch' ); ?>">−</button>
                                                    <?php
                                                    if ( $_product->is_sold_individually() ) {
                                                        $min_quantity = 1;
                                                        $max_quantity = 1;
                                                    } else {
                                                        $min_quantity = 0;
                                                        $max_quantity = $_product->get_max_purchase_quantity();
                                                    }

                                                    $product_quantity = woocommerce_quantity_input(
                                                        array(
                                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                                            'input_value'  => $cart_item['quantity'],
                                                            'max_value'    => $max_quantity,
                                                            'min_value'    => $min_quantity,
                                                            'product_name' => $product_name,
                                                            'classes'      => array( 'input-text', 'qty', 'text', 'imch-stepper-input' ),
                                                        ),
                                                        $_product,
                                                        false
                                                    );

                                                    echo $product_quantity;
                                                    ?>
                                                    <button type="button" class="imch-stepper-btn imch-stepper-plus" aria-label="<?php esc_attr_e( 'Increase quantity', 'imch' ); ?>">+</button>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Subtotal -->
                                        <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                            <div class="imch-cart-subtotal-wrap">
                                                <span class="imch-mobile-label"><?php esc_html_e( 'Line Total:', 'imch' ); ?></span>
                                                <span class="imch-subtotal-amount"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            <?php do_action( 'woocommerce_cart_contents' ); ?>

                            <!-- Actions Row (Update Cart & Continue Shopping) -->
                            <tr class="imch-cart-actions-row">
                                <td colspan="6" class="actions">
                                    <div class="imch-cart-actions-bar">
                                        <div class="imch-cart-continue-box">
                                            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="imch-btn imch-btn-ghost">
                                                &larr; <?php esc_html_e( 'Continue Shopping', 'imch' ); ?>
                                            </a>
                                        </div>

                                        <div class="imch-cart-update-box">
                                            <button type="submit" class="button imch-btn imch-btn-secondary" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update Cart', 'woocommerce' ); ?></button>
                                            <?php do_action( 'woocommerce_cart_actions' ); ?>
                                            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                        </tbody>
                    </table>
                </div>

                <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </form>
        </div>

        <!-- Right Column: Cart Totals & Checkout CTA -->
        <div class="imch-cart-sidebar-col">
            <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

            <div class="cart-collaterals imch-cart-collaterals-wrap">
                <!-- Instant Discount Notice Card -->
                <div class="imch-cart-savings-banner">
                    <div class="imch-savings-banner-badge">🔥 10% INSTANT CASH SAVINGS</div>
                    <p>Select <strong>Zelle, CashApp, Chime, or Apple Pay</strong> at checkout to automatically save 10% off your total purchase!</p>
                </div>

                <?php
                /**
                 * Cart collaterals hook.
                 *
                 * @hooked woocommerce_cross_sell_display
                 * @hooked woocommerce_cart_totals - 10
                 */
                do_action( 'woocommerce_cart_collaterals' );
                ?>

                <!-- Trust Guarantee Strip -->
                <div class="imch-cart-trust-badges">
                    <div class="imch-cart-trust-item">
                        <span class="imch-trust-badge-icon">🚚</span>
                        <div>
                            <strong>Direct Site Delivery</strong>
                            <span>Tilt-bed ground drop available</span>
                        </div>
                    </div>
                    <div class="imch-cart-trust-item">
                        <span class="imch-trust-badge-icon">🛡️</span>
                        <div>
                            <strong>CSC Certified</strong>
                            <span>Wind &amp; watertight guaranteed</span>
                        </div>
                    </div>
                    <div class="imch-cart-trust-item">
                        <span class="imch-trust-badge-icon">📞</span>
                        <div>
                            <strong>Dedicated Logistics Coordinator</strong>
                            <span>Drop-off schedule verified prior to dispatch</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
