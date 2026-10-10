<?php
/**
 * WooCommerce Custom Hooks and Enhancements
 *
 * @package IMCH
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Disable guest order verification gate so order-received confirmation page renders seamlessly
 */
add_filter( 'woocommerce_order_email_verification_required', '__return_false' );

/**
 * Remove coupon code form from checkout page
 */
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

/**
 * Custom Checkout Delivery Details Fields
 */
add_action( 'woocommerce_before_order_notes', 'imch_checkout_delivery_fields' );
function imch_checkout_delivery_fields( $checkout ) {
    echo '<div class="imch-delivery-details-section">';
    echo '<div class="imch-delivery-section-header">';
    echo '<span class="imch-delivery-section-badge">🚛 SITE ACCESS</span>';
    echo '<h3>' . esc_html__( 'Container Delivery Site Specifications', 'imch' ) . '</h3>';
    echo '<p class="imch-section-subtext">' . esc_html__( 'Please provide site access information to ensure safe trailer delivery, turn radius, and ground drop-off.', 'imch' ) . '</p>';
    echo '</div>';

    woocommerce_form_field( 'delivery_site_type', array(
        'type'     => 'select',
        'class'    => array( 'form-row-wide' ),
        'label'    => __( 'Site Classification', 'imch' ),
        'required' => true,
        'options'  => array(
            'commercial'  => __( 'Commercial / Industrial Depot / Warehouse Facility', 'imch' ),
            'residential' => __( 'Residential / Private Property / Farm / Acreage', 'imch' ),
            'jobsite'     => __( 'Active Commercial Construction Site', 'imch' ),
            'other'       => __( 'Other Location (Special Offloading Coordination)', 'imch' ),
        ),
    ), $checkout->get_value( 'delivery_site_type' ) );

    echo '<div class="imch-delivery-fields-grid">';
    woocommerce_form_field( 'delivery_surface', array(
        'type'     => 'select',
        'class'    => array( 'form-row-wide' ),
        'label'    => __( 'Ground Drop Surface', 'imch' ),
        'required' => true,
        'options'  => array(
            'concrete' => __( 'Paved Concrete or Asphalt', 'imch' ),
            'gravel'   => __( 'Packed Gravel or Crushed Stone Bed', 'imch' ),
            'dirt'     => __( 'Dry Dirt / Hard-Packed Grass / Pasture', 'imch' ),
        ),
    ), $checkout->get_value( 'delivery_surface' ) );

    woocommerce_form_field( 'delivery_access_clearance', array(
        'type'     => 'select',
        'class'    => array( 'form-row-wide' ),
        'label'    => __( 'Truck Access Clearance', 'imch' ),
        'required' => true,
        'options'  => array(
            'ample'    => __( 'Clear straight path (60ft+ for 20ft / 100ft+ for 40ft)', 'imch' ),
            'tight'    => __( 'Tight corners / Narrow gate (Coordination needed)', 'imch' ),
        ),
    ), $checkout->get_value( 'delivery_access_clearance' ) );
    echo '</div>';

    echo '</div>';
}

/**
 * Save custom checkout fields to order meta
 */
add_action( 'woocommerce_checkout_update_order_meta', 'imch_save_checkout_delivery_fields' );
function imch_save_checkout_delivery_fields( $order_id ) {
    if ( ! empty( $_POST['delivery_site_type'] ) ) {
        update_post_meta( $order_id, '_delivery_site_type', sanitize_text_field( wp_unslash( $_POST['delivery_site_type'] ) ) );
    }
    if ( ! empty( $_POST['delivery_surface'] ) ) {
        update_post_meta( $order_id, '_delivery_surface', sanitize_text_field( wp_unslash( $_POST['delivery_surface'] ) ) );
    }
    if ( ! empty( $_POST['delivery_access_clearance'] ) ) {
        update_post_meta( $order_id, '_delivery_access_clearance', sanitize_text_field( wp_unslash( $_POST['delivery_access_clearance'] ) ) );
    }
}

/**
 * AJAX Handler for Checkout Real-Time Quantity Increment / Decrement (+ / - buttons)
 */
add_action( 'wp_ajax_imch_update_checkout_qty', 'imch_ajax_update_checkout_qty' );
add_action( 'wp_ajax_nopriv_imch_update_checkout_qty', 'imch_ajax_update_checkout_qty' );
function imch_ajax_update_checkout_qty() {
    $cart_item_key = isset( $_POST['cart_item_key'] ) ? sanitize_text_field( wp_unslash( $_POST['cart_item_key'] ) ) : '';
    $action_type   = isset( $_POST['action_type'] ) ? sanitize_text_field( wp_unslash( $_POST['action_type'] ) ) : ''; // 'plus' or 'minus'

    if ( ! $cart_item_key || ! WC()->cart ) {
        wp_send_json_error( array( 'message' => __( 'Cart not found or invalid key.', 'imch' ) ) );
    }

    $cart = WC()->cart->get_cart();
    if ( ! isset( $cart[ $cart_item_key ] ) ) {
        wp_send_json_error( array( 'message' => __( 'Item not in cart.', 'imch' ) ) );
    }

    $current_qty = $cart[ $cart_item_key ]['quantity'];
    $new_qty = ( $action_type === 'plus' ) ? $current_qty + 1 : $current_qty - 1;

    if ( $new_qty <= 0 ) {
        WC()->cart->remove_cart_item( $cart_item_key );
    } else {
        WC()->cart->set_quantity( $cart_item_key, $new_qty );
    }

    WC()->cart->calculate_totals();

    wp_send_json_success( array(
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_total(),
        'is_empty'   => WC()->cart->is_empty(),
        'cart_url'   => wc_get_cart_url(),
    ) );
}

/**
 * Customize payment method gateway title in checkout to display badges and clean name
 * Guarded against duplication.
 */
/**
 * Gateway title filter - ensure clean plain-text titles across checkout, confirmation, and emails
 */
add_filter( 'woocommerce_gateway_title', 'imch_custom_gateway_title', 20, 2 );
function imch_custom_gateway_title( $title, $gateway_id ) {
    return wp_strip_all_tags( $title );
}

/**
 * Add Trust & Specs Strip below Add to Cart on Single Product
 */
add_action( 'woocommerce_single_product_summary', 'imch_single_product_trust_strip', 35 );
function imch_single_product_trust_strip() {
    ?>
    <div class="imch-single-trust-strip">
        <div class="imch-trust-point">
            <span class="imch-trust-icon">🚚</span>
            <div>
                <strong>Nationwide Delivery</strong>
                <p>Direct to your site on tilt-bed or flatbed trailer</p>
            </div>
        </div>
        <div class="imch-trust-point">
            <span class="imch-trust-icon">🔍</span>
            <div>
                <strong>Inspection Guarantee</strong>
                <p>CSC certified, wind &amp; watertight integrity</p>
            </div>
        </div>
        <div class="imch-trust-point">
            <span class="imch-trust-icon">💳</span>
            <div>
                <strong>10% Instant Payment Savings</strong>
                <p>Save 10% on Zelle, CashApp, Chime, Apple Pay</p>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Filter WooCommerce products by container size (20ft / 40ft) on shop and archive pages
 */
add_action( 'woocommerce_product_query', 'imch_filter_products_by_size', 20, 2 );
function imch_filter_products_by_size( $query, $query_vars ) {
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( ! empty( $_GET['filter_size'] ) ) {
        $size = sanitize_text_field( wp_unslash( $_GET['filter_size'] ) );
        if ( in_array( $size, array( '20ft', '40ft' ), true ) ) {
            $meta_query = (array) $query->get( 'meta_query' );
            $meta_query[] = array(
                'key'     => '_imch_size',
                'value'   => $size,
                'compare' => '=',
            );
            $query->set( 'meta_query', $meta_query );
        }
    }
}

/**
 * Guarantee store new order email recipient uses store email constant IMCH_EMAIL
 */
add_filter( 'woocommerce_email_recipient_new_order', 'imch_order_notification_email_recipient', 20, 2 );
function imch_order_notification_email_recipient( $recipient, $order ) {
    return defined( 'IMCH_EMAIL' ) ? IMCH_EMAIL : get_option( 'admin_email' );
}

/**
 * Render items list inside the Slide-in Right Cart Drawer
 */
function imch_render_cart_drawer_items() {
    if ( ! WC()->cart || WC()->cart->is_empty() ) {
        ?>
        <div class="imch-drawer-empty">
            <div class="imch-drawer-empty-icon">🛒</div>
            <h4><?php esc_html_e( 'Your Cart is Empty', 'imch' ); ?></h4>
            <p><?php esc_html_e( 'You have not added any shipping containers to your order yet.', 'imch' ); ?></p>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="imch-btn imch-btn-primary imch-btn-sm imch-drawer-close-link">
                <?php esc_html_e( 'Browse Containers →', 'imch' ); ?>
            </a>
        </div>
        <?php
        return;
    }

    echo '<div class="imch-drawer-items-list">';
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
            $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
            $product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
            $thumbnail         = $_product->get_image( array( 75, 75 ) );
            $price_display     = WC()->cart->get_product_price( $_product );
            $line_subtotal     = WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] );
            ?>
            <div class="imch-drawer-item" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>">
                <div class="imch-drawer-item-thumb">
                    <?php if ( $product_permalink ) : ?>
                        <a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo $thumbnail; ?></a>
                    <?php else : ?>
                        <?php echo $thumbnail; ?>
                    <?php endif; ?>
                </div>

                <div class="imch-drawer-item-details">
                    <div class="imch-drawer-item-header">
                        <h4 class="imch-drawer-item-title">
                            <?php if ( $product_permalink ) : ?>
                                <a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo esc_html( $product_name ); ?></a>
                            <?php else : ?>
                                <?php echo esc_html( $product_name ); ?>
                            <?php endif; ?>
                        </h4>
                        <button type="button" class="imch-drawer-remove-btn" data-key="<?php echo esc_attr( $cart_item_key ); ?>" aria-label="<?php esc_attr_e( 'Remove item', 'imch' ); ?>" title="<?php esc_attr_e( 'Remove item', 'imch' ); ?>">✕</button>
                    </div>

                    <div class="imch-drawer-item-tag">✓ CSC Certified Wind &amp; Watertight</div>

                    <div class="imch-drawer-item-footer">
                        <div class="imch-drawer-stepper" data-key="<?php echo esc_attr( $cart_item_key ); ?>">
                            <button type="button" class="imch-drawer-qty-btn imch-drawer-qty-minus" aria-label="<?php esc_attr_e( 'Decrease quantity', 'imch' ); ?>">−</button>
                            <span class="imch-drawer-qty-val"><?php echo esc_html( $cart_item['quantity'] ); ?></span>
                            <button type="button" class="imch-drawer-qty-btn imch-drawer-qty-plus" aria-label="<?php esc_attr_e( 'Increase quantity', 'imch' ); ?>">+</button>
                        </div>
                        <div class="imch-drawer-item-price">
                            <span class="imch-drawer-line-total"><?php echo wp_kses_post( $line_subtotal ); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    echo '</div>';
}

/**
 * Render footer inside the Slide-in Right Cart Drawer
 */
function imch_render_cart_drawer_footer() {
    if ( ! WC()->cart || WC()->cart->is_empty() ) {
        ?>
        <div class="imch-drawer-footer-inner is-empty">
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="imch-btn imch-btn-primary imch-btn-block">
                <?php esc_html_e( 'Browse Shipping Containers', 'imch' ); ?>
            </a>
        </div>
        <?php
        return;
    }
    ?>
    <div class="imch-drawer-footer-inner">
        <!-- 10% Instant Payment Savings Note -->
        <div class="imch-drawer-discount-banner">
            <span class="imch-drawer-discount-badge">🏷️ 10% OFF</span>
            <span><?php esc_html_e( 'Instant 10% discount applied at checkout on Zelle, CashApp, Chime & Apple Pay', 'imch' ); ?></span>
        </div>

        <div class="imch-drawer-subtotal-row">
            <span class="imch-drawer-subtotal-label"><?php esc_html_e( 'Estimated Subtotal:', 'imch' ); ?></span>
            <span class="imch-drawer-subtotal-value"><?php echo wp_kses_post( WC()->cart->get_cart_subtotal() ); ?></span>
        </div>
        <p class="imch-drawer-tax-note"><?php esc_html_e( 'Shipping, site delivery classification & 10% cash savings calculated at checkout.', 'imch' ); ?></p>

        <div class="imch-drawer-action-btns">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="imch-btn imch-btn-outline-navy imch-btn-block">
                <span><?php esc_html_e( 'View Cart', 'imch' ); ?></span>
            </a>
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="imch-btn imch-btn-primary imch-btn-block">
                <span><?php esc_html_e( 'Proceed to Checkout →', 'imch' ); ?></span>
            </a>
        </div>
    </div>
    <?php
}

/**
 * AJAX Add to Cart handler that returns updated Drawer contents
 */
add_action( 'wp_ajax_imch_ajax_add_to_cart', 'imch_ajax_add_to_cart_handler' );
add_action( 'wp_ajax_nopriv_imch_ajax_add_to_cart', 'imch_ajax_add_to_cart_handler' );
function imch_ajax_add_to_cart_handler() {
    $product_id = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
    $quantity   = isset( $_POST['quantity'] ) ? absint( $_POST['quantity'] ) : 1;

    if ( ! $product_id || ! WC()->cart ) {
        wp_send_json_error( array( 'message' => __( 'Invalid product or cart.', 'imch' ) ) );
    }

    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
    if ( ! $passed_validation ) {
        wp_send_json_error( array( 'message' => __( 'Validation failed.', 'imch' ) ) );
    }

    $cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity );
    if ( ! $cart_item_key ) {
        wp_send_json_error( array( 'message' => __( 'Could not add product to cart.', 'imch' ) ) );
    }

    WC()->cart->calculate_totals();

    ob_start();
    imch_render_cart_drawer_items();
    $items_html = ob_get_clean();

    ob_start();
    imch_render_cart_drawer_footer();
    $footer_html = ob_get_clean();

    wp_send_json_success( array(
        'cart_count'   => WC()->cart->get_cart_contents_count(),
        'cart_total'   => WC()->cart->get_cart_total(),
        'cart_subtotal'=> WC()->cart->get_cart_subtotal(),
        'items_html'   => $items_html,
        'footer_html'  => $footer_html,
    ) );
}

/**
 * AJAX Drawer Quantity Stepper handler
 */
add_action( 'wp_ajax_imch_drawer_qty', 'imch_ajax_drawer_qty_handler' );
add_action( 'wp_ajax_nopriv_imch_drawer_qty', 'imch_ajax_drawer_qty_handler' );
function imch_ajax_drawer_qty_handler() {
    $cart_item_key = isset( $_POST['cart_item_key'] ) ? sanitize_text_field( wp_unslash( $_POST['cart_item_key'] ) ) : '';
    $action_type   = isset( $_POST['action_type'] ) ? sanitize_text_field( wp_unslash( $_POST['action_type'] ) ) : '';

    if ( ! $cart_item_key || ! WC()->cart ) {
        wp_send_json_error( array( 'message' => __( 'Invalid cart request.', 'imch' ) ) );
    }

    $cart = WC()->cart->get_cart();
    if ( ! isset( $cart[ $cart_item_key ] ) ) {
        wp_send_json_error( array( 'message' => __( 'Item not in cart.', 'imch' ) ) );
    }

    $current_qty = $cart[ $cart_item_key ]['quantity'];
    $new_qty = ( $action_type === 'plus' ) ? $current_qty + 1 : $current_qty - 1;

    if ( $new_qty <= 0 ) {
        WC()->cart->remove_cart_item( $cart_item_key );
    } else {
        WC()->cart->set_quantity( $cart_item_key, $new_qty );
    }

    WC()->cart->calculate_totals();

    ob_start();
    imch_render_cart_drawer_items();
    $items_html = ob_get_clean();

    ob_start();
    imch_render_cart_drawer_footer();
    $footer_html = ob_get_clean();

    wp_send_json_success( array(
        'cart_count'   => WC()->cart->get_cart_contents_count(),
        'cart_total'   => WC()->cart->get_cart_total(),
        'cart_subtotal'=> WC()->cart->get_cart_subtotal(),
        'is_empty'     => WC()->cart->is_empty(),
        'items_html'   => $items_html,
        'footer_html'  => $footer_html,
    ) );
}

/**
 * AJAX Drawer Remove Item handler
 */
add_action( 'wp_ajax_imch_drawer_remove', 'imch_ajax_drawer_remove_handler' );
add_action( 'wp_ajax_nopriv_imch_drawer_remove', 'imch_ajax_drawer_remove_handler' );
function imch_ajax_drawer_remove_handler() {
    $cart_item_key = isset( $_POST['cart_item_key'] ) ? sanitize_text_field( wp_unslash( $_POST['cart_item_key'] ) ) : '';

    if ( ! $cart_item_key || ! WC()->cart ) {
        wp_send_json_error( array( 'message' => __( 'Invalid cart request.', 'imch' ) ) );
    }

    WC()->cart->remove_cart_item( $cart_item_key );
    WC()->cart->calculate_totals();

    ob_start();
    imch_render_cart_drawer_items();
    $items_html = ob_get_clean();

    ob_start();
    imch_render_cart_drawer_footer();
    $footer_html = ob_get_clean();

    wp_send_json_success( array(
        'cart_count'   => WC()->cart->get_cart_contents_count(),
        'cart_total'   => WC()->cart->get_cart_total(),
        'cart_subtotal'=> WC()->cart->get_cart_subtotal(),
        'is_empty'     => WC()->cart->is_empty(),
        'items_html'   => $items_html,
        'footer_html'  => $footer_html,
    ) );
}

/**
 * Update WooCommerce Cart Fragments for Real-Time Header Cart Pill
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'imch_woocommerce_cart_fragments' );
function imch_woocommerce_cart_fragments( $fragments ) {
    $cart_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
    $cart_total = WC()->cart ? WC()->cart->get_cart_total() : '$0.00';

    ob_start();
    ?>
    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="imch-cart-pill" title="<?php esc_attr_e( 'View Shopping Cart', 'imch' ); ?>">
        <span class="imch-cart-icon-wrap">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-2z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            <span class="imch-cart-count" id="imch-cart-counter"><?php echo esc_html( $cart_count ); ?></span>
        </span>
        <span class="imch-cart-total-text"><?php echo wp_kses_post( $cart_total ); ?></span>
    </a>
    <?php
    $fragments['a.imch-cart-pill'] = ob_get_clean();
    $fragments['#imch-drawer-count-badge'] = '<span class="imch-cart-drawer-badge" id="imch-drawer-count-badge">' . esc_html( $cart_count ) . '</span>';

    return $fragments;
}
