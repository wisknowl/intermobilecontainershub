<?php
/**
 * Template Name: Contact Us
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
        <span class="imch-badge-brand">DIRECT REGIONAL DISPATCH</span>
        <h1 class="imch-page-title">Contact &amp; Container Freight Estimates</h1>
        <p class="imch-page-lead">Connect with our container logistics specialists for immediate depot availability, nationwide tilt-bed freight quotes, and custom fleet pricing.</p>
    </div>
</div>

<div class="imch-page-content imch-contact-page-wrap">
    <div class="imch-container">
        <div class="imch-contact-grid">
            
            <!-- Primary Left Column: Send Us an Inquiry Form -->
            <div class="imch-contact-form-col">
                <div class="imch-form-card">
                    <div class="imch-form-card-header">
                        <span class="imch-badge-brand">⚡ 1-HOUR RESPONSE GUARANTEE</span>
                        <h2>Send Us an Inquiry</h2>
                        <p class="imch-form-card-sub">Need a freight estimate or looking for multiple 20ft / 40ft units? Leave your details below and our coordinator will respond within 1 business hour.</p>
                    </div>

                    <form id="imch-contact-page-form" class="imch-form">
                        <?php wp_nonce_field( 'imch_inquiry_nonce', 'imch_nonce' ); ?>

                        <div class="imch-form-row">
                            <label for="contact-fullname">Full Name <span class="imch-req">*</span></label>
                            <input type="text" id="contact-fullname" name="fullname" required placeholder="John Doe" autocomplete="name">
                        </div>

                        <div class="imch-form-row-2">
                            <div class="imch-form-row">
                                <label for="contact-email">Email Address <span class="imch-req">*</span></label>
                                <input type="email" id="contact-email" name="email" required placeholder="john@example.com" autocomplete="email">
                            </div>
                            <div class="imch-form-row">
                                <label for="contact-phone">Phone Number <span class="imch-req">*</span></label>
                                <input type="tel" id="contact-phone" name="phone" required placeholder="(757) 906-8036" autocomplete="tel">
                            </div>
                        </div>

                        <div class="imch-form-row-2">
                            <div class="imch-form-row">
                                <label for="contact-zip">Delivery Destination ZIP Code <span class="imch-req">*</span></label>
                                <input type="text" id="contact-zip" name="delivery_zip" required placeholder="e.g. 78758" autocomplete="postal-code">
                            </div>
                            <div class="imch-form-row">
                                <label for="contact-product">Container Size &amp; Type</label>
                                <select id="contact-product" name="product_interest">
                                    <option value="20ft Standard Container">20ft Standard Cargo Container (8'6" H)</option>
                                    <option value="20ft High Cube Container">20ft High Cube Container (9'6" H)</option>
                                    <option value="40ft Standard Container">40ft Standard Cargo Container (8'6" H)</option>
                                    <option value="40ft High Cube Container">40ft High Cube Container (9'6" H)</option>
                                    <option value="20ft Open Side Container">20ft Open Side / Side Access</option>
                                    <option value="40ft Open Side Container">40ft Open Side / Side Access</option>
                                    <option value="Refrigerated Container">Refrigerated (Reefer) Container</option>
                                    <option value="Specialized / Converted Unit">Specialized / Converted Container</option>
                                </select>
                            </div>
                        </div>

                        <div class="imch-form-row">
                            <label for="contact-quantity">Estimated Units Needed</label>
                            <select id="contact-quantity" name="quantity">
                                <option value="1 Unit">1 Unit (Single Placement)</option>
                                <option value="2 Units">2 Units (Tandem / Paired Site)</option>
                                <option value="3-5 Units">3 – 5 Units (Commercial / Jobsite)</option>
                                <option value="6+ Units (Fleet Order)">6+ Units (Fleet / Bulk Order)</option>
                            </select>
                        </div>

                        <div class="imch-form-row">
                            <label for="contact-notes">Site Surface &amp; Access Notes <span class="imch-opt">(Optional)</span></label>
                            <textarea id="contact-notes" name="notes" rows="3" placeholder="Mention site surface (packed gravel, concrete, asphalt, grass), gate width, or preferred delivery timing..."></textarea>
                        </div>

                        <div class="imch-form-actions">
                            <button type="submit" class="imch-btn imch-btn-primary imch-btn-lg imch-btn-block" id="contact-submit-btn">
                                <span>Submit Freight Inquiry 📨</span>
                            </button>
                        </div>

                        <div class="imch-form-feedback" id="contact-form-feedback"></div>

                        <!-- Trust Guarantees Footer -->
                        <div class="imch-form-trust-footer">
                            <div class="imch-trust-pill">
                                <span>⚡</span> 1-Hour Response
                            </div>
                            <div class="imch-trust-pill">
                                <span>🔒</span> 100% Free No-Obligation
                            </div>
                            <div class="imch-trust-pill">
                                <span>🚛</span> Direct Ground Placement
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Companion Right Column: Depot Information & Quick Contacts -->
            <div class="imch-contact-info-col">
                <div class="imch-contact-card">
                    <span class="imch-badge-brand">REGIONAL DEPOT FACILITY</span>
                    <h2>Austin Logistics Depot</h2>
                    <p class="imch-depot-desc">Intermobile Containers Hub operates strategically positioned depot storage facilities and direct tilt-bed transport networks nationwide.</p>

                    <div class="imch-contact-list">
                        <div class="imch-contact-item">
                            <span class="imch-contact-icon">📍</span>
                            <div>
                                <strong>Depot Facility Address</strong>
                                <p><?php echo esc_html( IMCH_ADDRESS ); ?></p>
                            </div>
                        </div>

                        <div class="imch-contact-item">
                            <span class="imch-contact-icon">📞</span>
                            <div>
                                <strong>Direct Dispatch &amp; Phone Orders</strong>
                                <p><a href="tel:<?php echo esc_attr( IMCH_PHONE_TEL ); ?>"><?php echo esc_html( IMCH_PHONE ); ?></a></p>
                            </div>
                        </div>

                        <div class="imch-contact-item">
                            <span class="imch-contact-icon">✉️</span>
                            <div>
                                <strong>Direct Email Support</strong>
                                <p><a href="mailto:<?php echo esc_attr( IMCH_EMAIL ); ?>"><?php echo esc_html( IMCH_EMAIL ); ?></a></p>
                            </div>
                        </div>

                        <div class="imch-contact-item">
                            <span class="imch-contact-icon">⏰</span>
                            <div>
                                <strong>Depot &amp; Dispatch Hours</strong>
                                <p><?php echo esc_html( IMCH_HOURS ); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="imch-contact-cta-box">
                        <a href="<?php echo esc_url( imch_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" class="imch-btn imch-btn-whatsapp imch-btn-block">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/whatsapp.svg' ); ?>" alt="WhatsApp" width="20" height="20">
                            <span>Chat Live with Dispatch on WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- Instant Payment Savings Card -->
                <div class="imch-contact-discount-card">
                    <span class="imch-badge-discount">🔥 10% CASH SAVINGS</span>
                    <h4>Save 10% at Checkout</h4>
                    <p>Orders paid via Zelle, CashApp, Chime, or Apple Pay automatically receive a 10% instant discount off the container purchase price.</p>
                </div>

                <!-- Ground Placement Notice -->
                <div class="imch-delivery-reassurance-card">
                    <div class="imch-delivery-reassurance-icon">🚚</div>
                    <div>
                        <strong>Tilt-Bed Ground Unloading</strong>
                        <p>Our drivers tilt trailers to roll the container smoothly onto your prepared ground site. No crane needed.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>
