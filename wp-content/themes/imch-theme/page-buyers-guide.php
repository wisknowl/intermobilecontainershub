<?php
/**
 * Template Name: Buyers Guide
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div class="imch-page-hero">
    <div class="imch-container">
        <div class="imch-breadcrumbs-wrap">
            <?php woocommerce_breadcrumb(); ?>
        </div>
        <h1 class="imch-page-title">Shipping Container Buyers Guide</h1>
        <p class="imch-page-lead">Everything you need to know about container dimensions, condition grades, site prep, and tilt-bed delivery before ordering.</p>
    </div>
</div>

<div class="imch-page-content">
    <div class="imch-container">
        <div class="imch-guide-grid">
            <div class="imch-guide-main">
                
                <!-- Section 1: Dimensions & Sizes -->
                <section class="imch-guide-section">
                    <h2>1. Choosing the Right Size: 20ft vs 40ft</h2>
                    <p>Shipping containers are standardized ISO steel freight units engineered for marine and intermodal transport. The two primary industry sizes are 20ft and 40ft units.</p>

                    <div class="imch-table-scroll-hint" aria-hidden="true">
                        <span class="imch-hint-icon">⇄</span>
                        <span>Swipe horizontally to compare 20ft &amp; 40ft dimensions</span>
                    </div>

                    <div class="imch-table-responsive">
                        <table class="imch-spec-table">
                            <thead>
                                <tr>
                                    <th>Specification</th>
                                    <th>20ft Standard</th>
                                    <th>20ft High Cube</th>
                                    <th>40ft Standard</th>
                                    <th>40ft High Cube</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>External Length</strong></td>
                                    <td>19' 10.5" (6.06 m)</td>
                                    <td>19' 10.5" (6.06 m)</td>
                                    <td>40' 0" (12.19 m)</td>
                                    <td>40' 0" (12.19 m)</td>
                                </tr>
                                <tr>
                                    <td><strong>External Width</strong></td>
                                    <td>8' 0" (2.44 m)</td>
                                    <td>8' 0" (2.44 m)</td>
                                    <td>8' 0" (2.44 m)</td>
                                    <td>8' 0" (2.44 m)</td>
                                </tr>
                                <tr>
                                    <td><strong>External Height</strong></td>
                                    <td>8' 6" (2.59 m)</td>
                                    <td>9' 6" (2.90 m)</td>
                                    <td>8' 6" (2.59 m)</td>
                                    <td>9' 6" (2.90 m)</td>
                                </tr>
                                <tr>
                                    <td><strong>Internal Volume</strong></td>
                                    <td>1,172 cu ft (33.2 m³)</td>
                                    <td>1,320 cu ft (37.4 m³)</td>
                                    <td>2,390 cu ft (67.7 m³)</td>
                                    <td>2,694 cu ft (76.3 m³)</td>
                                </tr>
                                <tr>
                                    <td><strong>Tare Weight</strong></td>
                                    <td>approx. 5,000 lbs</td>
                                    <td>approx. 5,300 lbs</td>
                                    <td>approx. 8,200 lbs</td>
                                    <td>approx. 8,750 lbs</td>
                                </tr>
                                <tr>
                                    <td><strong>Max Payload</strong></td>
                                    <td>approx. 62,000 lbs</td>
                                    <td>approx. 62,000 lbs</td>
                                    <td>approx. 59,000 lbs</td>
                                    <td>approx. 58,500 lbs</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="imch-guide-callout">
                        <strong>💡 Pro Tip:</strong> If you plan to convert your container into an office, workshop, or living space, or need to run overhead ducting, lighting, or insulation, always choose a <strong>High Cube (9'6" Height)</strong> container. That extra 12 inches of vertical clearance makes an enormous difference.
                    </div>
                </section>

                <!-- Section 2: Condition Grades -->
                <section class="imch-guide-section">
                    <h2>2. Understanding Container Condition Grades</h2>
                    <p>We clearly grade every container in our depot inventory so you know exactly what is landing on your property:</p>

                    <div class="imch-cond-grid">
                        <div class="imch-cond-card">
                            <span class="imch-cond-tag tag-new">NEW / ONE-TRIP</span>
                            <h4>One-Trip (Like New)</h4>
                            <p>Manufactured overseas and loaded with dry cargo on a single transoceanic voyage to the USA. Practically brand-new with clean factory paint, pristine marine-grade wood floors, lock box factory-welded, and zero rust.</p>
                        </div>

                        <div class="imch-cond-card">
                            <span class="imch-cond-tag tag-cw">CARGO-WORTHY (CW)</span>
                            <h4>Cargo-Worthy (CW)</h4>
                            <p>Certified capable of international marine shipping under valid CSC criteria. Structurally sound, weatherproof, no structural deformation. May have cosmetic surface patina, scratches, and minor shipping dings, but 100% weather-tight.</p>
                        </div>

                        <div class="imch-cond-card">
                            <span class="imch-cond-tag tag-wwt">WIND & WATERTIGHT (WWT)</span>
                            <h4>Wind & Watertight (WWT)</h4>
                            <p>Retired from active ocean shipping service but thoroughly inspected to guarantee zero water leaks, functional double door seals, and solid flooring. Ideal for farms, ranches, job-sites, and commercial storage.</p>
                        </div>
                    </div>
                </section>

                <!-- Section 3: Delivery & Site Preparation -->
                <section class="imch-guide-section">
                    <h2>3. Site Preparation & Tilt-Bed Delivery</h2>
                    <p>We deliver containers using professional roll-off tilt-bed trailers. The trailer backs up to the designated drop location, tilts the bed at a 45-degree angle, and rolls the container smoothly onto the ground as the tractor pulls forward.</p>

                    <div class="imch-delivery-checklist">
                        <div class="imch-check-item">
                            <span class="imch-check-icon">📐</span>
                            <div>
                                <strong>Straight-Line Clearance:</strong>
                                <p>For a 20ft container, you need at least <strong>60 to 70 feet</strong> of straight, unobstructed driving line. For a 40ft container, you need at least <strong>100 to 120 feet</strong> of straight clearance.</p>
                            </div>
                        </div>

                        <div class="imch-check-item">
                            <span class="imch-check-icon">🌲</span>
                            <div>
                                <strong>Height & Overhead Obstacles:</strong>
                                <p>Tilt-bed trailers require a minimum of <strong>14 feet of overhead clearance</strong> while driving, and <strong>16 to 20 feet</strong> when the trailer bed is elevated to slide off the container. Watch for low-hanging branches and power lines.</p>
                            </div>
                        </div>

                        <div class="imch-check-item">
                            <span class="imch-check-icon">🚜</span>
                            <div>
                                <strong>Ground Foundation:</strong>
                                <p>The drop surface must be firm, dry, and level (compacted gravel, concrete slab, asphalt, or dry solid dirt). If placing on grass or soft dirt, set down heavy treated wood 4x4s, 6x6 railroad ties, or concrete footings under the four corner castings.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 4: 10% Discount Explanation -->
                <section class="imch-guide-section">
                    <h2>4. Transparent Pricing & 10% Instant Savings</h2>
                    <p>At Intermobile Containers Hub, we offer direct depot pricing. When ordering online, you can select any of our 4 instant digital payment channels:</p>
                    <ul class="imch-feature-list">
                        <li><strong>Zelle</strong> (Instant 10% discount applied at checkout)</li>
                        <li><strong>CashApp</strong> (Instant 10% discount applied at checkout)</li>
                        <li><strong>Chime</strong> (Instant 10% discount applied at checkout)</li>
                        <li><strong>Apple Pay</strong> (Instant 10% discount applied at checkout)</li>
                        <li><strong>Bank Payment</strong> (Direct ACH or wire settlement for commercial accounts)</li>
                    </ul>
                </section>

            </div>

            <!-- Sidebar -->
            <div class="imch-guide-sidebar">
                <div class="imch-sidebar-card">
                    <h3>Ready to Order?</h3>
                    <p>Browse our live inventory of inspected containers ready for rapid nationwide dispatch.</p>
                    <div class="imch-guide-buttons">
                        <a href="<?php echo esc_url( add_query_arg( 'filter_size', '20ft', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-btn imch-btn-primary imch-btn-block">
                            Shop 20ft Containers →
                        </a>
                        <a href="<?php echo esc_url( add_query_arg( 'filter_size', '40ft', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-btn imch-btn-navy imch-btn-block">
                            Shop 40ft Containers →
                        </a>
                        <a href="<?php echo esc_url( imch_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" class="imch-btn imch-btn-whatsapp imch-btn-block">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/whatsapp.svg' ); ?>" alt="" width="18" height="18">
                            <span>Ask a Logistics Expert</span>
                        </a>
                    </div>
                </div>

                <div class="imch-sidebar-card imch-help-box">
                    <h4>Need a Site Visit Assessment?</h4>
                    <p>If your location has narrow access, steep incline, or tight corners, call our Austin depot team at <a href="tel:<?php echo esc_attr( IMCH_PHONE_TEL ); ?>"><?php echo esc_html( IMCH_PHONE ); ?></a> for personalized delivery planning.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
