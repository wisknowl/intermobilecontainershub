<?php
/**
 * Single Product Template
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

while ( have_posts() ) :
    the_post();
    global $product;

    $product_id   = $product->get_id();
    $size_meta    = get_post_meta( $product_id, '_imch_size', true );
    $cond_meta    = get_post_meta( $product_id, '_imch_condition', true );
    $main_img_id  = $product->get_image_id();
    $gallery_ids  = $product->get_gallery_image_ids();
    $all_img_ids  = array_merge( array( $main_img_id ), $gallery_ids );
    $all_img_ids  = array_filter( array_unique( $all_img_ids ) );

    $regular_price = floatval( $product->get_price() );
    $discounted_price = $regular_price * 0.90;

    $wa_msg = sprintf( "Hello! I am inquiring about container: %s (SKU: %s). Can you provide a freight quote and delivery schedule?", $product->get_name(), $product->get_sku() );
    $wa_url = imch_whatsapp_url( $wa_msg );
    ?>

    <div class="imch-single-product-wrap">
        <div class="imch-container">
            <div class="imch-breadcrumbs-wrap">
                <?php woocommerce_breadcrumb(); ?>
            </div>

            <div class="imch-single-grid">
                <!-- Left: Media Gallery -->
                <div class="imch-gallery-col">
                    <div class="imch-gallery-featured">
                        <?php if ( ! empty( $all_img_ids ) ) : 
                            $first_img = wp_get_attachment_image_url( $all_img_ids[0], 'large' );
                        ?>
                            <img id="imch-main-display-img" src="<?php echo esc_url( $first_img ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" width="800" height="600">
                        <?php else : ?>
                            <img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" alt="Placeholder" width="800" height="600">
                        <?php endif; ?>

                        <div class="imch-gallery-badges">
                            <?php if ( $size_meta ) : ?>
                                <span class="imch-badge-size"><?php echo esc_html( $size_meta ); ?></span>
                            <?php endif; ?>
                            <?php if ( $cond_meta ) : ?>
                                <span class="imch-badge-cond"><?php echo esc_html( $cond_meta ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ( count( $all_img_ids ) > 1 ) : ?>
                        <div class="imch-gallery-thumbs">
                            <?php foreach ( $all_img_ids as $index => $img_id ) : 
                                $thumb_url = wp_get_attachment_image_url( $img_id, 'thumbnail' );
                                $full_url = wp_get_attachment_image_url( $img_id, 'large' );
                            ?>
                                <button type="button" class="imch-thumb-btn <?php echo $index === 0 ? 'imch-thumb-active' : ''; ?>" data-full="<?php echo esc_url( $full_url ); ?>" aria-label="View photo <?php echo $index + 1; ?>">
                                    <img src="<?php echo esc_url( $thumb_url ); ?>" alt="" width="80" height="60">
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="imch-inspection-banner">
                        <span>🔍 <strong>Depot Inspection Verified:</strong> Structurally sound Corten steel, intact gaskets, marine-grade plywood floors, weather-sealed locks.</span>
                    </div>
                </div>

                <!-- Right: Product Information & Purchasing -->
                <div class="imch-summary-col">
                    <div class="imch-sku-stock-row">
                        <span class="imch-sku">SKU: <?php echo esc_html( $product->get_sku() ?: 'ICH-' . $product_id ); ?></span>
                        <span class="imch-stock-badge">🟢 In Stock at Regional Depot</span>
                    </div>

                    <h1 class="imch-product-title"><?php echo esc_html( $product->get_name() ); ?></h1>

                    <!-- Pricing Box with 10% Discount Callout -->
                    <div class="imch-price-box">
                        <div class="imch-price-display">
                            <span class="imch-price-amount"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
                        </div>
                        <div class="imch-discount-highlight">
                            <div class="imch-discount-tag">🔥 10% CASH SAVINGS AT CHECKOUT</div>
                            <div class="imch-discount-math">
                                Pay only <strong>$<?php echo number_format( $discounted_price, 2 ); ?></strong> when selecting Zelle, CashApp, Chime, or Apple Pay!
                            </div>
                        </div>
                    </div>

                    <!-- Short Description -->
                    <?php if ( $product->get_short_description() ) : ?>
                        <div class="imch-short-desc">
                            <?php echo wp_kses_post( $product->get_short_description() ); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Key Spec Bullets -->
                    <div class="imch-key-specs-card">
                        <div class="imch-spec-item">
                            <span class="imch-spec-label">Container Size:</span>
                            <span class="imch-spec-val"><?php echo esc_html( $size_meta ?: 'Standard ISO Unit' ); ?></span>
                        </div>
                        <div class="imch-spec-item">
                            <span class="imch-spec-label">Condition Grade:</span>
                            <span class="imch-spec-val"><?php echo esc_html( $cond_meta ?: 'Cargo-Worthy / WWT' ); ?></span>
                        </div>
                        <div class="imch-spec-item">
                            <span class="imch-spec-label">Door Configuration:</span>
                            <span class="imch-spec-val">Double End Cargo Doors with Cam-Locks</span>
                        </div>
                        <div class="imch-spec-item">
                            <span class="imch-spec-label">Delivery Type:</span>
                            <span class="imch-spec-val">Direct Tilt-Bed Ground Placement</span>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <div class="imch-cart-form-wrap">
                        <?php woocommerce_template_single_add_to_cart(); ?>
                    </div>

                    <!-- Direct Contact & Logistics CTAs -->
                    <div class="imch-single-actions-divider">
                        <span>Direct Depot Dispatch &amp; Support</span>
                    </div>

                    <div class="imch-direct-cta-grid">
                        <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="imch-btn imch-btn-whatsapp imch-btn-block">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/whatsapp.svg' ); ?>" alt="WhatsApp" width="20" height="20">
                            <span>Inquire on WhatsApp</span>
                        </a>
                        <a href="tel:<?php echo esc_attr( IMCH_PHONE_TEL ); ?>" class="imch-btn imch-btn-phone imch-btn-block">
                            <span>📞</span>
                            <span>Call <?php echo esc_html( IMCH_PHONE ); ?></span>
                        </a>
                    </div>
                    <button type="button" class="imch-btn imch-btn-quote imch-btn-block" id="imch-open-quote-modal" data-product="<?php echo esc_attr( $product->get_name() ); ?>">
                        <span>📋</span>
                        <span>Request Custom Freight Quote</span>
                    </button>
                </div>
            </div>

            <!-- Full Details & Specifications -->
            <div class="imch-product-details-section">
                <div class="imch-details-tabs">
                    <div class="imch-detail-block">
                        <h3 class="imch-detail-heading">Product Summary &amp; Specifications</h3>
                        <div class="imch-detail-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="imch-related-section">
                <h3 class="imch-related-title"><?php esc_html_e( 'Other Available Containers', 'imch' ); ?></h3>
                <div class="imch-products-grid">
                    <?php
                    $related_query = new WP_Query( array(
                        'post_type'      => 'product',
                        'posts_per_page' => 4,
                        'post__not_in'   => array( $product_id ),
                        'orderby'        => 'rand',
                    ) );

                    if ( $related_query->have_posts() ) :
                        while ( $related_query->have_posts() ) :
                            $related_query->the_post();
                            wc_get_template_part( 'content', 'product' );
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php endwhile; // end of the loop.

get_footer( 'shop' );
