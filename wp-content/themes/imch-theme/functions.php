<?php
/**
 * Intermobile Containers Hub - Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. Business Config & Constants
require_once get_template_directory() . '/inc/config.php';

// 2. Theme Setup & Supports
require_once get_template_directory() . '/inc/setup.php';

// 3. Scripts & Styles Enqueue
require_once get_template_directory() . '/inc/enqueue.php';

// 4. WooCommerce Customizations & Hooks
require_once get_template_directory() . '/inc/woo-hooks.php';

// 5. Custom Payment Gateways & 10% Discount System
require_once get_template_directory() . '/inc/payment-gateways.php';

// 6. Direct Inquiry & Quote Form Handler
require_once get_template_directory() . '/inc/inquiry-form.php';

/**
 * Filter WooCommerce breadcrumb defaults
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'imch_breadcrumb_defaults' );
function imch_breadcrumb_defaults( $defaults ) {
    $defaults['delimiter']   = ' <span class="imch-bc-sep">/</span> ';
    $defaults['wrap_before'] = '<nav class="imch-breadcrumbs" aria-label="Breadcrumb">';
    $defaults['wrap_after']  = '</nav>';
    return $defaults;
}

/**
 * Custom product search query
 */
add_filter( 'get_search_form', 'imch_custom_search_form' );
function imch_custom_search_form( $form ) {
    $form = '<form role="search" method="get" class="imch-search-form" action="' . esc_url( home_url( '/' ) ) . '">
        <input type="search" class="imch-search-input" placeholder="' . esc_attr__( 'Search 20ft & 40ft containers...', 'imch' ) . '" value="' . get_search_query() . '" name="s" />
        <input type="hidden" name="post_type" value="product" />
        <button type="submit" class="imch-search-btn" aria-label="Search">🔍</button>
    </form>';
    return $form;
}
