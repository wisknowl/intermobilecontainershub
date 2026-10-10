<?php
/**
 * Enqueue scripts and styles
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function imch_enqueue_scripts() {
    $theme_dir = get_template_directory_uri();
    $theme_path = get_template_directory();

    // Modern Google Fonts: Inter (UI/Body) & Barlow Condensed (Display/Headings)
    wp_enqueue_style(
        'imch-fonts',
        'https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Main Theme Stylesheet
    $css_version = file_exists( $theme_path . '/assets/css/style.css' ) ? filemtime( $theme_path . '/assets/css/style.css' ) : '1.0.0';
    wp_enqueue_style( 'imch-style', $theme_dir . '/assets/css/style.css', array(), $css_version );

    // Main Theme JS
    $js_version = file_exists( $theme_path . '/assets/js/main.js' ) ? filemtime( $theme_path . '/assets/js/main.js' ) : '1.0.0';
    wp_enqueue_script( 'imch-main', $theme_dir . '/assets/js/main.js', array(), $js_version, true );

    // Localize data for theme JS
    wp_localize_script( 'imch-main', 'imchData', array(
        'ajaxUrl'          => admin_url( 'admin-ajax.php' ),
        'siteUrl'          => home_url( '/' ),
        'whatsappNumber'   => IMCH_WHATSAPP,
        'discountPercent'  => IMCH_DISCOUNT_PERCENT,
    ) );

    // Checkout specific JS
    if ( function_exists( 'is_checkout' ) && is_checkout() ) {
        $checkout_js_version = file_exists( $theme_path . '/assets/js/checkout.js' ) ? filemtime( $theme_path . '/assets/js/checkout.js' ) : '1.0.0';
        wp_enqueue_script( 'imch-checkout', $theme_dir . '/assets/js/checkout.js', array( 'jquery' ), $checkout_js_version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'imch_enqueue_scripts', 25 );
