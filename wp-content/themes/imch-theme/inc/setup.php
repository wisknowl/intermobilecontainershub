<?php
/**
 * Theme Setup and Features
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function imch_theme_setup() {
    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable post thumbnails
    add_theme_support( 'post-thumbnails' );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'imch' ),
        'footer'  => __( 'Footer Navigation', 'imch' ),
    ) );

    // WooCommerce support
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // HTML5 markup support
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
}
add_action( 'after_setup_theme', 'imch_theme_setup' );
