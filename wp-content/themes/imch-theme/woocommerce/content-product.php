<?php
/**
 * Single Product Card inside Product Grid
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

$product_id = $product->get_id();
$size_meta  = get_post_meta( $product_id, '_imch_size', true );
$cond_meta  = get_post_meta( $product_id, '_imch_condition', true );
$image_url  = wp_get_attachment_image_url( $product->get_image_id(), 'medium_large' );
if ( ! $image_url ) {
    $image_url = wc_placeholder_img_src();
}

?>

<div <?php wc_product_class( 'imch-card', $product ); ?>>
    <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="imch-card-media">
        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" loading="lazy" width="400" height="300">
        
        <div class="imch-card-badges">
            <?php if ( ! empty( $size_meta ) ) : ?>
                <span class="imch-badge-size"><?php echo esc_html( $size_meta ); ?></span>
            <?php endif; ?>
            
            <?php if ( ! empty( $cond_meta ) ) : ?>
                <span class="imch-badge-cond"><?php echo esc_html( $cond_meta ); ?></span>
            <?php endif; ?>
        </div>

        <div class="imch-card-discount-tag">10% OFF at Checkout</div>
    </a>

    <div class="imch-card-body">
        <h3 class="imch-card-title">
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
                <?php echo esc_html( $product->get_name() ); ?>
            </a>
        </h3>

        <div class="imch-card-price-row">
            <div class="imch-card-prices">
                <span class="imch-price-main"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
            </div>
        </div>

        <div class="imch-card-footer">
            <button type="button" class="imch-btn imch-btn-sm imch-btn-navy imch-btn-add-cart" data-product-id="<?php echo esc_attr( $product_id ); ?>" data-product-name="<?php echo esc_attr( $product->get_name() ); ?>" aria-label="<?php printf( esc_attr__( 'Add %s to cart', 'imch' ), esc_attr( $product->get_name() ) ); ?>">
                <span>Add to Cart</span>
            </button>
            <button type="button" class="imch-btn imch-btn-sm imch-btn-inquire" data-quote-product="<?php echo esc_attr( $product->get_name() ); ?>" aria-label="<?php printf( esc_attr__( 'Inquire about %s', 'imch' ), esc_attr( $product->get_name() ) ); ?>">
                <span>Inquire</span>
            </button>
            <a href="<?php echo esc_url( imch_whatsapp_url( 'Hi, I am interested in container: ' . $product->get_name() ) ); ?>" target="_blank" rel="noopener noreferrer" class="imch-btn imch-btn-sm imch-btn-wa-icon" title="<?php esc_attr_e( 'Inquire on WhatsApp', 'imch' ); ?>" aria-label="<?php esc_attr_e( 'Inquire on WhatsApp', 'imch' ); ?>">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/whatsapp.svg' ); ?>" alt="WhatsApp" width="18" height="18">
            </a>
        </div>
    </div>
</div>
