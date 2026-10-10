<?php
/**
 * Custom Offline Payment Methods with 10% Discount and WhatsApp Finalization
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register the custom payment gateways
 */
function imch_register_payment_gateways( $gateways ) {
    $gateways[] = 'WC_Gateway_IMCH_Zelle';
    $gateways[] = 'WC_Gateway_IMCH_CashApp';
    $gateways[] = 'WC_Gateway_IMCH_Chime';
    $gateways[] = 'WC_Gateway_IMCH_ApplePay';
    $gateways[] = 'WC_Gateway_IMCH_Bank';
    return $gateways;
}
add_filter( 'woocommerce_payment_gateways', 'imch_register_payment_gateways' );

/**
 * Initialize Gateway Classes after WooCommerce loads
 */
add_action( 'init', 'imch_init_gateway_classes', 0 );
if ( class_exists( 'WC_Payment_Gateway' ) ) {
    imch_init_gateway_classes();
}
function imch_init_gateway_classes() {
    if ( ! class_exists( 'WC_Payment_Gateway' ) || class_exists( 'WC_Gateway_IMCH_Base' ) ) {
        return;
    }

    // Base Abstract Gateway for IMCH Offline Methods
    abstract class WC_Gateway_IMCH_Base extends WC_Payment_Gateway {
        public $discount_applicable = false;
        public $badge_text = '';

        public function has_fields() {
            return false;
        }

        public function payment_fields() {
            // Completely suppress secondary info / description box as requested
            return;
        }

        public function process_payment( $order_id ) {
            $order = wc_get_order( $order_id );

            // Mark as on-hold (awaiting offline verification via WhatsApp/Email)
            $order->update_status( 'on-hold', __( 'Awaiting customer payment confirmation via WhatsApp or Email.', 'imch' ) );

            // Reduce stock levels
            wc_reduce_stock_levels( $order_id );

            // Remove cart
            WC()->cart->empty_cart();

            // Return thank you redirect
            return array(
                'result'   => 'success',
                'redirect' => $this->get_return_url( $order ),
            );
        }
    }

    // 1. Zelle Gateway
    class WC_Gateway_IMCH_Zelle extends WC_Gateway_IMCH_Base {
        public function __construct() {
            $this->id                 = 'imch_zelle';
            $this->icon               = get_template_directory_uri() . '/assets/img/zelle.svg';
            $this->has_fields         = false;
            $this->method_title       = __( 'Zelle', 'imch' );
            $this->method_description = '';
            $this->title              = __( 'Zelle', 'imch' );
            $this->description        = '';
            $this->discount_applicable = true;
            $this->badge_text         = '10% OFF';
            $this->enabled            = 'yes';
        }
    }

    // 2. CashApp Gateway
    class WC_Gateway_IMCH_CashApp extends WC_Gateway_IMCH_Base {
        public function __construct() {
            $this->id                 = 'imch_cashapp';
            $this->icon               = get_template_directory_uri() . '/assets/img/cashapp.svg';
            $this->has_fields         = false;
            $this->method_title       = __( 'CashApp', 'imch' );
            $this->method_description = '';
            $this->title              = __( 'CashApp', 'imch' );
            $this->description        = '';
            $this->discount_applicable = true;
            $this->badge_text         = '10% OFF';
            $this->enabled            = 'yes';
        }
    }

    // 3. Chime Gateway
    class WC_Gateway_IMCH_Chime extends WC_Gateway_IMCH_Base {
        public function __construct() {
            $this->id                 = 'imch_chime';
            $this->icon               = get_template_directory_uri() . '/assets/img/chime.svg';
            $this->has_fields         = false;
            $this->method_title       = __( 'Chime', 'imch' );
            $this->method_description = '';
            $this->title              = __( 'Chime', 'imch' );
            $this->description        = '';
            $this->discount_applicable = true;
            $this->badge_text         = '10% OFF';
            $this->enabled            = 'yes';
        }
    }

    // 4. Apple Pay Gateway
    class WC_Gateway_IMCH_ApplePay extends WC_Gateway_IMCH_Base {
        public function __construct() {
            $this->id                 = 'imch_applepay';
            $this->icon               = get_template_directory_uri() . '/assets/img/applepay.svg';
            $this->has_fields         = false;
            $this->method_title       = __( 'Apple Pay', 'imch' );
            $this->method_description = '';
            $this->title              = __( 'Apple Pay', 'imch' );
            $this->description        = '';
            $this->discount_applicable = true;
            $this->badge_text         = '10% OFF';
            $this->enabled            = 'yes';
        }
    }

    // 5. Bank Payment Gateway
    class WC_Gateway_IMCH_Bank extends WC_Gateway_IMCH_Base {
        public function __construct() {
            $this->id                 = 'imch_bank';
            $this->icon               = get_template_directory_uri() . '/assets/img/bank.svg';
            $this->has_fields         = false;
            $this->method_title       = __( 'Bank Payment', 'imch' );
            $this->method_description = '';
            $this->title              = __( 'Bank Payment', 'imch' );
            $this->description        = '';
            $this->discount_applicable = false;
            $this->badge_text         = '';
            $this->enabled            = 'yes';
        }
    }
}

/**
 * Dynamically apply 10% discount fee when Zelle, CashApp, Chime, or Apple Pay is selected
 */
add_action( 'woocommerce_cart_calculate_fees', 'imch_apply_payment_discount' );
function imch_apply_payment_discount( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        return;
    }

    $chosen_gateway = WC()->session->get( 'chosen_payment_method' );
    $discount_gateways = array( 'imch_zelle', 'imch_cashapp', 'imch_chime', 'imch_applepay' );

    if ( in_array( $chosen_gateway, $discount_gateways, true ) ) {
        $subtotal = $cart->get_subtotal();
        if ( $subtotal > 0 ) {
            $discount_amount = -( $subtotal * ( IMCH_DISCOUNT_PERCENT / 100 ) );
            $cart->add_fee( sprintf( __( '10%% Instant Payment Discount (%s)', 'imch' ), ucfirst( str_replace( 'imch_', '', $chosen_gateway ) ) ), $discount_amount, false );
        }
    }
}

/**
 * Filter available payment gateways to ensure our 5 custom ones are prioritized and enabled
 */
add_filter( 'woocommerce_available_payment_gateways', 'imch_filter_gateways' );
function imch_filter_gateways( $gateways ) {
    // List of our custom gateways
    $desired = array( 'imch_zelle', 'imch_cashapp', 'imch_chime', 'imch_applepay', 'imch_bank' );
    $filtered = array();

    foreach ( $desired as $key ) {
        if ( isset( $gateways[ $key ] ) ) {
            $gateways[ $key ]->enabled = 'yes';
            $filtered[ $key ] = $gateways[ $key ];
        }
    }

    return ! empty( $filtered ) ? $filtered : $gateways;
}

/**
 * Enhance order confirmation / thank-you page with WhatsApp finalization action & payment directions
 */
add_action( 'woocommerce_thankyou', 'imch_thankyou_payment_instructions', 5 );
function imch_thankyou_payment_instructions( $order_id ) {
    if ( ! $order_id ) return;
    $order = wc_get_order( $order_id );
    if ( ! $order ) return;

    $payment_method = $order->get_payment_method();
    $payment_title = wp_strip_all_tags( $order->get_payment_method_title() );
    $total_formatted = wc_price( $order->get_total() );
    $total_raw = number_format( $order->get_total(), 2 );

    $items = array();
    foreach ( $order->get_items() as $item ) {
        $items[] = $item->get_name() . ' (x' . $item->get_quantity() . ')';
    }
    $items_str = ! empty( $items ) ? implode( ', ', $items ) : 'Shipping Container Order';

    $whatsapp_message = sprintf(
        "Hello %s! I just placed Order #%s on your website.\nContainer(s): %s\nTotal Amount: $%s\nPayment Method: %s\nPlease confirm payment reception and my delivery drop-off schedule.",
        IMCH_SHORT_NAME,
        $order_id,
        $items_str,
        $total_raw,
        $payment_title
    );
    $whatsapp_link = imch_whatsapp_url( $whatsapp_message );
    ?>
    <div class="imch-order-next-steps">
        <div class="imch-steps-header">
            <span class="imch-badge-alert"><?php esc_html_e( 'Order Received • Action Required to Complete Delivery', 'imch' ); ?></span>
            <h2><?php printf( esc_html__( 'Complete Your %s Payment & Schedule Drop-off', 'imch' ), esc_html( $payment_title ) ); ?></h2>
            <p><?php esc_html_e( 'Your order has been recorded in our dispatch system. To reserve your container and coordinate your tilt-bed trailer drop-off window, connect with our logistics coordinator on WhatsApp or give us a call.', 'imch' ); ?></p>
        </div>

        <div class="imch-order-actions-box">
            <a href="<?php echo esc_url( $whatsapp_link ); ?>" target="_blank" rel="noopener noreferrer" class="imch-btn imch-btn-whatsapp imch-whatsapp-confirm-btn">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/whatsapp.svg' ); ?>" alt="WhatsApp" width="24" height="24">
                <span><?php esc_html_e( 'Send Order Details on WhatsApp Now', 'imch' ); ?></span>
            </a>

            <div class="imch-order-call-box">
                <span><?php esc_html_e( 'Or call our dispatch desk directly:', 'imch' ); ?></span>
                <a href="<?php echo esc_url( 'tel:' . IMCH_PHONE_TEL ); ?>" class="imch-btn imch-btn-outline">
                    📞 <?php echo esc_html( IMCH_PHONE ); ?>
                </a>
            </div>
        </div>

        <!-- Specific Payment Directions -->
        <div class="imch-payment-directions-card">
            <h4>💳 <?php printf( esc_html__( '%s Payment Instructions', 'imch' ), esc_html( $payment_title ) ); ?></h4>
            <div class="imch-payment-directions-content">
                <?php if ( $payment_method === 'imch_zelle' ) : ?>
                    <p>Please initiate your Zelle transfer for <strong>$<?php echo esc_html( $total_raw ); ?></strong> (10% discount included) using our dispatch coordinator contact or tap the WhatsApp button above to receive the direct recipient tag. Include <strong>Order #<?php echo esc_html( $order_id ); ?></strong> in the payment memo.</p>
                <?php elseif ( $payment_method === 'imch_cashapp' ) : ?>
                    <p>Please send your CashApp payment of <strong>$<?php echo esc_html( $total_raw ); ?></strong> with memo <strong>Order #<?php echo esc_html( $order_id ); ?></strong>. Connect with our dispatch manager on WhatsApp to confirm our verified $Cashtag.</p>
                <?php elseif ( $payment_method === 'imch_chime' ) : ?>
                    <p>Please send your Chime member transfer of <strong>$<?php echo esc_html( $total_raw ); ?></strong> with memo <strong>Order #<?php echo esc_html( $order_id ); ?></strong>. Tap the WhatsApp button above for instant member tag verification.</p>
                <?php elseif ( $payment_method === 'imch_applepay' ) : ?>
                    <p>Please complete Apple Pay transfer of <strong>$<?php echo esc_html( $total_raw ); ?></strong>. Once sent, screenshot your receipt and send via WhatsApp for immediate release to our regional dispatch depot.</p>
                <?php else : ?>
                    <p>A formal invoice with official wire / ACH routing numbers has been emailed to you. You may also coordinate wire confirmation directly with our accounting team on WhatsApp.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="imch-order-reassurance">
            <div class="imch-reassurance-item">
                <strong>⚡ Fast Dispatch Scheduling</strong>
                <p>We coordinate your tilt-bed trailer drop-off window directly with you.</p>
            </div>
            <div class="imch-reassurance-item">
                <strong>🔒 Container Held in Depot</strong>
                <p>Your container unit reservation is secured while payment is finalized.</p>
            </div>
            <div class="imch-reassurance-item">
                <strong>📧 Order Confirmation Dispatched</strong>
                <p>Order receipt sent to <strong><?php echo esc_html( $order->get_billing_email() ); ?></strong> and our team at <strong><?php echo esc_html( defined( 'IMCH_EMAIL' ) ? IMCH_EMAIL : 'info@intermobilecontainershub.com' ); ?></strong>.</p>
            </div>
        </div>
    </div>
    <?php
}
