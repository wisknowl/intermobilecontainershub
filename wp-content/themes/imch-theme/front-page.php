<?php
/**
 * Front Page Template
 */

get_header(); ?>

<!-- 1. Hero Section -->
<section class="imch-hero">
    <div class="imch-container">
        <div class="imch-hero-content">
            <div class="imch-hero-pill">
                <span class="imch-hero-pill-icon">⚡</span>
                <span>Direct Depot Inventory • Nationwide Ground Delivery</span>
            </div>
            <h1 class="imch-hero-title">
                Industrial-Grade <span class="imch-text-highlight">20ft & 40ft</span> Shipping Containers
            </h1>
            <p class="imch-hero-lead">
                Verified wind &amp; watertight, cargo-worthy, and one-trip shipping containers for storage, construction, and custom conversions. Delivered directly to your site with tilt-bed ground drop.
            </p>
            
            <div class="imch-hero-actions">
                <a href="<?php echo esc_url( add_query_arg( 'filter_size', '20ft', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-btn imch-btn-primary imch-btn-lg">
                    <span>Shop 20ft Containers</span>
                    <span class="imch-btn-arrow">→</span>
                </a>
                <a href="<?php echo esc_url( add_query_arg( 'filter_size', '40ft', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-btn imch-btn-navy imch-btn-lg">
                    <span>Shop 40ft Containers</span>
                    <span class="imch-btn-arrow">→</span>
                </a>
                <a href="<?php echo esc_url( imch_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" class="imch-btn imch-btn-whatsapp imch-btn-lg">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/whatsapp.svg' ); ?>" alt="" width="20" height="20">
                    <span>WhatsApp Quote</span>
                </a>
            </div>

            <!-- Discount Notification Banner -->
            <div class="imch-hero-discount-alert">
                <span class="imch-discount-pill">🔥 10% OFF</span>
                <span><strong>Instant 10% Cash Savings:</strong> Automatically applied at checkout when paying with Zelle, CashApp, Chime, or Apple Pay.</span>
            </div>
        </div>
    </div>
</section>

<!-- 2. Trust Badges Strip -->
<section class="imch-trust-strip">
    <div class="imch-container">
        <div class="imch-trust-grid">
            <div class="imch-trust-card">
                <span class="imch-trust-card-icon">🛡️</span>
                <div class="imch-trust-card-text">
                    <h4>CSC & WWT Certified</h4>
                    <p>Guaranteed wind & watertight integrity with functional doors and seals.</p>
                </div>
            </div>
            <div class="imch-trust-card">
                <span class="imch-trust-card-icon">🚛</span>
                <div class="imch-trust-card-text">
                    <h4>Direct Ground Drop Delivery</h4>
                    <p>Tilt-bed trailer placement directly where you need it on your property.</p>
                </div>
            </div>
            <div class="imch-trust-card">
                <span class="imch-trust-card-icon">🏷️</span>
                <div class="imch-trust-card-text">
                    <h4>10% Instant Payment Savings</h4>
                    <p>Transparent pricing with zero hidden fees plus 10% checkout discount.</p>
                </div>
            </div>
            <div class="imch-trust-card">
                <span class="imch-trust-card-icon">📞</span>
                <div class="imch-trust-card-text">
                    <h4>Direct Logistics Support</h4>
                    <p>Dedicated Austin TX specialists ready via phone, email, and WhatsApp.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Size Selector Dual Split Cards -->
<section class="imch-section imch-section-alt">
    <div class="imch-container">
        <div class="imch-section-header text-center">
            <span class="imch-subtitle">CHOOSE YOUR SPECIFICATION</span>
            <h2 class="imch-title">Select Your Container Size</h2>
            <p class="imch-subtext">Whether you need compact on-site storage or large commercial capacity, we have 20ft and 40ft units in stock.</p>
        </div>

        <div class="imch-sizes-grid">
            <!-- 20ft Card -->
            <div class="imch-size-card">
                <div class="imch-size-badge">MOST POPULAR FOR SITES</div>
                <div class="imch-size-header">
                    <h3>20ft Shipping Containers</h3>
                    <p class="imch-size-dims">20' Length &times; 8' Width &times; 8'6" Standard / 9'6" High Cube</p>
                </div>
                <div class="imch-size-body">
                    <ul class="imch-size-features">
                        <li>✅ Fits inside a single standard parking space</li>
                        <li>✅ ~1,170 cubic feet of secure dry storage</li>
                        <li>✅ Easy to deliver on smaller tilt-bed trucks</li>
                        <li>✅ Ideal for residential storage, tools, and small job sites</li>
                        <li>✅ Available in New One-Trip, Cargo Worthy, and WWT</li>
                    </ul>
                    <div class="imch-size-action">
                        <a href="<?php echo esc_url( add_query_arg( 'filter_size', '20ft', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-btn imch-btn-primary imch-btn-block">
                            Browse 20ft Containers →
                        </a>
                    </div>
                </div>
            </div>

            <!-- 40ft Card -->
            <div class="imch-size-card imch-size-card-dark">
                <div class="imch-size-badge imch-badge-orange">MAXIMUM STORAGE VALUE</div>
                <div class="imch-size-header">
                    <h3>40ft Shipping Containers</h3>
                    <p class="imch-size-dims">40' Length &times; 8' Width &times; 8'6" Standard / 9'6" High Cube</p>
                </div>
                <div class="imch-size-body">
                    <ul class="imch-size-features">
                        <li>✅ Massive ~2,390 to 2,690 cubic feet storage capacity</li>
                        <li>✅ Best cost-per-square-foot storage ratio</li>
                        <li>✅ High Cube units provide extra foot of vertical ceiling height</li>
                        <li>✅ Ideal for commercial warehouses, farms, heavy machinery & homes</li>
                        <li>✅ Available in New One-Trip, Cargo Worthy, and WWT</li>
                    </ul>
                    <div class="imch-size-action">
                        <a href="<?php echo esc_url( add_query_arg( 'filter_size', '40ft', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-btn imch-btn-primary imch-btn-block">
                            Browse 40ft Containers →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Featured Products Grid -->
<section class="imch-section">
    <div class="imch-container">
        <div class="imch-section-header imch-flex-between">
            <div>
                <span class="imch-subtitle">CURRENT INVENTORY</span>
                <h2 class="imch-title">Featured Shipping Containers</h2>
            </div>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="imch-link-more">
                View All Containers (<?php echo wp_count_posts( 'product' )->publish; ?> Units) →
            </a>
        </div>

        <div class="imch-products-grid">
            <?php
            $featured_query = new WP_Query( array(
                'post_type'      => 'product',
                'posts_per_page' => 8,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );

            if ( $featured_query->have_posts() ) :
                while ( $featured_query->have_posts() ) :
                    $featured_query->the_post();
                    wc_get_template_part( 'content', 'product' );
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>' . esc_html__( 'No products found.', 'imch' ) . '</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<!-- 5. How It Works (Ordering Process) -->
<section class="imch-section imch-section-dark">
    <div class="imch-container">
        <div class="imch-section-header text-center">
            <span class="imch-subtitle">SEAMLESS PURCHASING</span>
            <h2 class="imch-title text-white">How Ordering Works</h2>
            <p class="imch-subtext text-gray">Simple, transparent, direct delivery right to your location in 5 straightforward steps.</p>
        </div>

        <div class="imch-steps-grid">
            <div class="imch-step-card">
                <span class="imch-step-number">01</span>
                <h4>Browse &amp; Select</h4>
                <p>Choose your size (20ft or 40ft) and condition (New One-Trip or Used Cargo-Worthy).</p>
            </div>
            <div class="imch-step-card">
                <span class="imch-step-number">02</span>
                <h4>Add to Cart</h4>
                <p>Add your unit to cart and provide your delivery site surface and access clearance.</p>
            </div>
            <div class="imch-step-card imch-step-card-active">
                <span class="imch-step-number">03</span>
                <h4>10% Checkout Discount</h4>
                <p>Choose Zelle, CashApp, Chime, or Apple Pay to instantly save 10% off your order.</p>
            </div>
            <div class="imch-step-card">
                <span class="imch-step-number">04</span>
                <h4>WhatsApp Confirmation</h4>
                <p>Connect with our dispatch manager on WhatsApp or email to lock your drop-off window.</p>
            </div>
            <div class="imch-step-card">
                <span class="imch-step-number">05</span>
                <h4>Direct Ground Delivery</h4>
                <p>Our driver tilts and unloads the container smoothly right onto your prepared site.</p>
            </div>
        </div>
    </div>
</section>

<!-- 6. Conditions Explained -->
<section class="imch-section">
    <div class="imch-container">
        <div class="imch-section-header text-center">
            <span class="imch-subtitle">TRANSPARENT GRADING</span>
            <h2 class="imch-title">Understanding Container Conditions</h2>
            <p class="imch-subtext">Know exactly what you are purchasing with our strict inspection standards.</p>
        </div>

        <div class="imch-conditions-grid">
            <div class="imch-condition-card">
                <div class="imch-condition-tag imch-tag-new">ONE-TRIP / NEW</div>
                <h3>One-Trip Shipping Containers</h3>
                <p>Manufactured overseas and shipped with cargo only once to the United States. In near-pristine condition with minimal to no dents, fresh factory paint, lock box included, and immaculate marine-grade plywood floors.</p>
                <div class="imch-condition-meta"><strong>Best For:</strong> High-visibility locations, offices, container homes, and retail.</div>
            </div>

            <div class="imch-condition-card">
                <div class="imch-condition-tag imch-tag-cw">CARGO-WORTHY (CW)</div>
                <h3>Cargo-Worthy Containers</h3>
                <p>Certified capable of ocean freight transport under CSC standards. Mechanically sound with structural corners intact, water-tight door gaskets, and guaranteed weather protection. Minor surface scrapes and paint fading.</p>
                <div class="imch-condition-meta"><strong>Best For:</strong> Secure storage, jobsite workshops, export shipping, and tools.</div>
            </div>

            <div class="imch-condition-card">
                <div class="imch-condition-tag imch-tag-wwt">WIND &amp; WATERTIGHT (WWT)</div>
                <h3>Wind &amp; Watertight Containers</h3>
                <p>Inspected to ensure no light or water penetrates the roof, walls, or doors. Retired from maritime shipping but structurally solid for all static ground storage applications. Maximum budget efficiency.</p>
                <div class="imch-condition-meta"><strong>Best For:</strong> Cost-effective agricultural storage, rural properties, and materials.</div>
            </div>
        </div>
    </div>
</section>

<!-- 7. FAQ Section -->
<section class="imch-section imch-section-alt">
    <div class="imch-container">
        <div class="imch-section-header text-center">
            <span class="imch-subtitle">FREQUENTLY ASKED QUESTIONS</span>
            <h2 class="imch-title">Common Questions &amp; Delivery Answers</h2>
        </div>

        <div class="imch-faq-list">
            <details class="imch-faq-item" open>
                <summary class="imch-faq-question">How does container delivery work?</summary>
                <div class="imch-faq-answer">
                    <p>We deliver using specialized tilt-bed roll-off trailers. The driver reverses into the designated location, tilts the bed, and slowly drives forward as the container glides gently onto the ground. For 20ft containers, approximately 60 feet of straight clearance is required; for 40ft containers, approximately 100-120 feet of clearance is needed.</p>
                </div>
            </details>

            <details class="imch-faq-item">
                <summary class="imch-faq-question">How do I get the 10% discount at checkout?</summary>
                <div class="imch-faq-answer">
                    <p>When you proceed to checkout, simply select <strong>Zelle, CashApp, Chime, or Apple Pay</strong> as your payment option. The system automatically calculates and deducts 10% from your order total instantly!</p>
                </div>
            </details>

            <details class="imch-faq-item">
                <summary class="imch-faq-question">What ground preparation is needed?</summary>
                <div class="imch-faq-answer">
                    <p>Containers require a flat, firm, level surface. Paved concrete, asphalt, or compacted crushed gravel are ideal. If placing on dirt or grass, we recommend laying treated wooden blocks (4x4s or 6x6s) or concrete patio pavers under the four corner castings to prevent moisture accumulation and sinking.</p>
                </div>
            </details>

            <details class="imch-faq-item">
                <summary class="imch-faq-question">Can I specify which way the doors face on the truck?</summary>
                <div class="imch-faq-answer">
                    <p>Yes! During scheduling via WhatsApp or phone, you can specify whether you want doors loaded facing the truck cab (doors come off last) or doors facing the rear (doors touch the ground first).</p>
                </div>
            </details>

            <details class="imch-faq-item">
                <summary class="imch-faq-question">Are the containers inspected before delivery?</summary>
                <div class="imch-faq-answer">
                    <p>Every single container dispatched from our depot network undergoes a physical inspection. We verify that doors seal tightly, locking rods turn freely, floors are solid, and there are no holes or leaks.</p>
                </div>
            </details>
        </div>
    </div>
</section>

<!-- 8. Bottom CTA Band -->
<section class="imch-cta-band">
    <div class="imch-container">
        <div class="imch-cta-inner">
            <div class="imch-cta-text">
                <h2>Ready to Secure Your Container?</h2>
                <p>Speak with our logistics coordinators today for custom freight quotes, site clearance checks, or expedited delivery.</p>
            </div>
            <div class="imch-cta-buttons">
                <a href="tel:<?php echo esc_attr( IMCH_PHONE_TEL ); ?>" class="imch-btn imch-btn-white imch-btn-lg">
                    📞 Call <?php echo esc_html( IMCH_PHONE ); ?>
                </a>
                <a href="<?php echo esc_url( imch_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" class="imch-btn imch-btn-whatsapp imch-btn-lg">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/whatsapp.svg' ); ?>" alt="" width="20" height="20">
                    <span>Chat on WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
