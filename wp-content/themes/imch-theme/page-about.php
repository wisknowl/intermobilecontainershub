<?php
/**
 * Template Name: About Us
 */

get_header(); ?>

<div class="imch-page-hero">
    <div class="imch-container">
        <div class="imch-breadcrumbs-wrap">
            <?php woocommerce_breadcrumb(); ?>
        </div>
        <h1 class="imch-page-title">About Intermobile Containers Hub</h1>
        <p class="imch-page-lead">Direct-depot nationwide supplier of certified 20ft and 40ft shipping containers for storage, industry, and construction.</p>
    </div>
</div>

<div class="imch-page-content">
    <div class="imch-container">
        <div class="imch-about-grid">
            <div class="imch-about-text">
                <h2>Direct Container Logistics Across the United States</h2>
                <p>
                    <strong>Intermobile Containers Hub (ICHub)</strong> was established to eliminate the unnecessary middlemen, confusing broker markups, and uncertain quality often found in the shipping container market. Headquartered at 11500 Metric Blvd in Austin, Texas, we partner directly with maritime shipping lines, port depots, and inland rail intermodal hubs to supply high-quality ISO steel containers directly to property owners, contractors, farmers, and commercial businesses.
                </p>
                <p>
                    Whether you require a compact 20ft container for secure on-site equipment storage or an extra-tall 40ft High Cube container for heavy industrial materials, workshop conversions, or structural modifications, our team coordinates the entire process from depot inspection to tilt-bed ground drop at your location.
                </p>

                <h3>Our Core Commitments</h3>
                <div class="imch-values-list">
                    <div class="imch-value-card">
                        <span class="imch-value-icon">🔍</span>
                        <div>
                            <h4>Rigorous Pre-Trip Inspections</h4>
                            <p>Every container leaving our regional depot facilities undergoes a multi-point physical check for structural squareness, floor stability, watertight door gaskets, and locking rod functionality.</p>
                        </div>
                    </div>

                    <div class="imch-value-card">
                        <span class="imch-value-icon">🚛</span>
                        <div>
                            <h4>Professional Tilt-Bed Placement</h4>
                            <p>We work with vetted freight carriers equipped with specialized roll-off tilt trailers, allowing us to drop containers smoothly onto your designated site without requiring expensive mobile cranes.</p>
                        </div>
                    </div>

                    <div class="imch-value-card">
                        <span class="imch-value-icon">🏷️</span>
                        <div>
                            <h4>10% Instant Payment Savings</h4>
                            <p>We believe in transparent pricing. By utilizing low-overhead digital settlement options like Zelle, CashApp, Chime, and Apple Pay, we pass immediate 10% savings directly to you at checkout.</p>
                        </div>
                    </div>

                    <div class="imch-value-card">
                        <span class="imch-value-icon">📱</span>
                        <div>
                            <h4>Direct WhatsApp &amp; Phone Coordination</h4>
                            <p>No endless automated phone menus. You speak directly with knowledgeable logistics managers who know trailer dimensions, access requirements, and container specs.</p>
                        </div>
                    </div>
                </div>

                <h3>Nationwide Distribution Capabilities</h3>
                <p>
                    Through our strategic logistics network spanning key port cities and inland distribution corridors, we deliver containers nationwide. From agricultural ranches in Texas and construction sites in California to industrial parks in the Midwest and retail properties on the East Coast, our transport partners ensure timely, safe placement.
                </p>
            </div>

            <!-- About Sidebar / Business Card -->
            <div class="imch-about-sidebar">
                <div class="imch-depot-card">
                    <div class="imch-depot-badge">AUSTIN LOGISTICS HUB</div>
                    <h3>Business Information</h3>
                    <ul class="imch-depot-info">
                        <li><strong>Company Name:</strong> <?php echo esc_html( IMCH_NAME ); ?> (ICHub)</li>
                        <li><strong>Operating Facility:</strong> <?php echo esc_html( IMCH_ADDRESS ); ?></li>
                        <li><strong>Customer Support Phone:</strong> <a href="tel:<?php echo esc_attr( IMCH_PHONE_TEL ); ?>"><?php echo esc_html( IMCH_PHONE ); ?></a></li>
                        <li><strong>General Inquiries Email:</strong> <a href="mailto:<?php echo esc_attr( IMCH_EMAIL ); ?>"><?php echo esc_html( IMCH_EMAIL ); ?></a></li>
                        <li><strong>Operating Hours:</strong> <?php echo esc_html( IMCH_HOURS ); ?></li>
                        <li><strong>Service Coverage:</strong> All 50 United States</li>
                    </ul>

                    <div class="imch-sidebar-actions">
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="imch-btn imch-btn-primary imch-btn-block">
                            View Available Inventory →
                        </a>
                        <a href="<?php echo esc_url( imch_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" class="imch-btn imch-btn-whatsapp imch-btn-block">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/whatsapp.svg' ); ?>" alt="" width="20" height="20">
                            <span>Connect on WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
