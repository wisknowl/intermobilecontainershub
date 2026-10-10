<?php
/**
 * Inquiry & Quote Request Form Handler
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_ajax_imch_submit_inquiry', 'imch_handle_inquiry_submission' );
add_action( 'wp_ajax_nopriv_imch_submit_inquiry', 'imch_handle_inquiry_submission' );

function imch_handle_inquiry_submission() {
    check_ajax_referer( 'imch_inquiry_nonce', 'security' );

    $name     = isset( $_POST['fullname'] ) ? sanitize_text_field( $_POST['fullname'] ) : '';
    $email    = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
    $phone    = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
    $zip      = isset( $_POST['delivery_zip'] ) ? sanitize_text_field( $_POST['delivery_zip'] ) : '';
    $product  = isset( $_POST['product_interest'] ) ? sanitize_text_field( $_POST['product_interest'] ) : '';
    $quantity = isset( $_POST['quantity'] ) ? sanitize_text_field( $_POST['quantity'] ) : '1 Unit';
    $notes    = isset( $_POST['notes'] ) ? sanitize_textarea_field( $_POST['notes'] ) : '';

    if ( empty( $name ) || empty( $email ) || empty( $phone ) ) {
        wp_send_json_error( array( 'message' => __( 'Please fill in all required fields (Name, Email, Phone).', 'imch' ) ) );
    }

    $to = IMCH_EMAIL;
    $subject = sprintf( '[%s] New Container Quote Request: %s', IMCH_SHORT_NAME, $name );
    $body = "New Quote Request Received:\n\n" .
            "Full Name: " . $name . "\n" .
            "Email: " . $email . "\n" .
            "Phone: " . $phone . "\n" .
            "Delivery ZIP Code: " . $zip . "\n" .
            "Container Requested: " . $product . "\n" .
            "Quantity: " . $quantity . "\n" .
            "Notes / Special Access: " . $notes . "\n\n" .
            "Sent from: " . home_url();

    $headers = array( 'Content-Type: text/plain; charset=UTF-8', 'From: ' . IMCH_NAME . ' <' . IMCH_EMAIL . '>' );

    @wp_mail( $to, $subject, $body, $headers );

    // Build instant WhatsApp message link
    $wa_msg = sprintf(
        "Hello %s! I just requested a quote on your website.\nName: %s\nPhone: %s\nDelivery ZIP: %s\nContainer: %s\nQty: %s",
        IMCH_SHORT_NAME,
        $name,
        $phone,
        $zip,
        $product,
        $quantity
    );
    $wa_url = imch_whatsapp_url( $wa_msg );

    wp_send_json_success( array(
        'message' => __( 'Thank you! Your quote request has been received. Our team will contact you shortly.', 'imch' ),
        'whatsapp_url' => $wa_url
    ) );
}
