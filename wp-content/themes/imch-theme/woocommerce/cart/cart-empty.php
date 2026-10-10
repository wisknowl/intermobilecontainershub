<?php
/**
 * Empty Cart Template - Intermobile Containers Hub
 *
 * @package IMCH
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_cart_is_empty' );
?>

<div class="imch-empty-cart-card">
    <div class="imch-empty-cart-icon-wrap">
        <svg class="imch-empty-cart-svg" width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
            <path d="m3.3 7 8.7 5 8.7-5"></path>
            <path d="M12 22V12"></path>
        </svg>
    </div>

    <h2 class="imch-empty-cart-title"><?php esc_html_e( 'Your Shipping Container Cart is Empty', 'imch' ); ?></h2>
    
    <p class="imch-empty-cart-text">
        <?php esc_html_e( 'You do not have any shipping containers or portable office cabins selected. Browse our certified 20ft and 40ft units currently in stock across our nationwide logistics depot network.', 'imch' ); ?>
    </p>

    <div class="imch-empty-cart-actions">
        <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-btn imch-btn-primary imch-btn-lg">
            <span><?php esc_html_e( 'Explore Container Inventory', 'imch' ); ?></span>
            <span class="imch-btn-arrow">&rarr;</span>
        </a>
    </div>

    <div class="imch-empty-reassurance-grid">
        <div class="imch-empty-reassurance-item">
            <span class="imch-reassurance-icon">🚚</span>
            <div>
                <strong>Tilt-Bed Direct Delivery</strong>
                <p>Ground drop-off at your home, depot, or active jobsite.</p>
            </div>
        </div>
        <div class="imch-empty-reassurance-item">
            <span class="imch-reassurance-icon">💳</span>
            <div>
                <strong>10% Instant Payment Savings</strong>
                <p>Save 10% automatically on Zelle, CashApp, Chime, Apple Pay.</p>
            </div>
        </div>
        <div class="imch-empty-reassurance-item">
            <span class="imch-reassurance-icon">🛡️</span>
            <div>
                <strong>Guaranteed Wind &amp; Watertight</strong>
                <p>Every unit inspected &amp; certified prior to release.</p>
            </div>
        </div>
    </div>
</div>
