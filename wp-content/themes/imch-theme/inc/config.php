<?php
/**
 * Business Constants and Helper Configurations
 * Single source of truth for business contact & store details.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'IMCH_NAME', 'Intermobile Containers Hub' );
define( 'IMCH_SHORT_NAME', 'ICHub' );
define( 'IMCH_PHONE', '+1 (757) 906-8036' );
define( 'IMCH_PHONE_TEL', '+17579068036' );
define( 'IMCH_WHATSAPP', '17579068036' );
define( 'IMCH_EMAIL', 'info@intermobilecontainershub.com' );
define( 'IMCH_ADDRESS', '11500 Metric Blvd, North Burnett, Austin, TX 78758' );
define( 'IMCH_HOURS', 'Monday – Saturday: 8:00 AM – 6:00 PM CST' );
define( 'IMCH_DISCOUNT_PERCENT', 10 );

/**
 * Returns formatted WhatsApp URL with pre-filled message
 */
function imch_whatsapp_url( $message = '' ) {
    $phone = get_option( 'imch_whatsapp_number', IMCH_WHATSAPP );
    $phone_clean = preg_replace( '/[^0-9]/', '', $phone );
    if ( empty( $message ) ) {
        $message = "Hello Intermobile Containers Hub, I would like to inquire about purchasing a shipping container.";
    }
    return 'https://wa.me/' . $phone_clean . '?text=' . rawurlencode( $message );
}
