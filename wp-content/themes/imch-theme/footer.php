</main><!-- #main-content -->

<footer class="imch-footer">
    <div class="imch-footer-top">
        <div class="imch-container">
            <div class="imch-footer-grid">
                <!-- Column 1: Brand & Contact -->
                <div class="imch-footer-col">
                    <div class="imch-footer-logo">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.svg' ); ?>" alt="<?php echo esc_attr( IMCH_NAME ); ?>" width="240" height="42">
                    </div>
                    <p class="imch-footer-desc">
                        Direct-to-consumer and commercial supplier of premium 20ft and 40ft shipping containers across the United States. Fast tilt-bed delivery, transparent condition grading, and dedicated customer support.
                    </p>
                    <ul class="imch-footer-contact">
                        <li>📍 <strong>Hub:</strong> <?php echo esc_html( IMCH_ADDRESS ); ?></li>
                        <li>📞 <strong>Phone:</strong> <a href="tel:<?php echo esc_attr( IMCH_PHONE_TEL ); ?>"><?php echo esc_html( IMCH_PHONE ); ?></a></li>
                        <li>✉️ <strong>Email:</strong> <a href="mailto:<?php echo esc_attr( IMCH_EMAIL ); ?>"><?php echo esc_html( IMCH_EMAIL ); ?></a></li>
                        <li>⏰ <strong>Hours:</strong> <?php echo esc_html( IMCH_HOURS ); ?></li>
                    </ul>
                </div>

                <!-- Column 2: Container Sizes & Categories -->
                <div class="imch-footer-col">
                    <h3 class="imch-footer-title"><?php esc_html_e( 'Container Inventory', 'imch' ); ?></h3>
                    <ul class="imch-footer-links">
                        <li><a href="<?php echo esc_url( add_query_arg( 'filter_size', '20ft', wc_get_page_permalink( 'shop' ) ) ); ?>">20ft Standard Containers (8'6" H)</a></li>
                        <li><a href="<?php echo esc_url( add_query_arg( 'filter_size', '20ft', wc_get_page_permalink( 'shop' ) ) ); ?>">20ft High Cube Containers (9'6" H)</a></li>
                        <li><a href="<?php echo esc_url( add_query_arg( 'filter_size', '40ft', wc_get_page_permalink( 'shop' ) ) ); ?>">40ft Standard Dry Storage (8'6" H)</a></li>
                        <li><a href="<?php echo esc_url( add_query_arg( 'filter_size', '40ft', wc_get_page_permalink( 'shop' ) ) ); ?>">40ft High Cube Containers (9'6" H)</a></li>
                        <li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Open-Side & Specialty Units</a></li>
                        <li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Refrigerated Containers (Reefers)</a></li>
                    </ul>
                </div>

                <!-- Column 3: Quick Navigation -->
                <div class="imch-footer-col">
                    <h3 class="imch-footer-title"><?php esc_html_e( 'Customer Resources', 'imch' ); ?></h3>
                    <ul class="imch-footer-links">
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                        <li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Browse Full Catalog</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/buyers-guide/' ) ); ?>">Comprehensive Buyers Guide</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">About Intermobile Containers Hub</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>">Contact & Depot Logistics</a></li>
                        <li><a href="<?php echo esc_url( wc_get_cart_url() ); ?>">View Cart</a></li>
                        <li><a href="<?php echo esc_url( wc_get_checkout_url() ); ?>">Secure Checkout</a></li>
                    </ul>
                </div>

                <!-- Column 4: Payment Methods & 10% Discount -->
                <div class="imch-footer-col">
                    <h3 class="imch-footer-title"><?php esc_html_e( 'Payment Options & Savings', 'imch' ); ?></h3>
                    <div class="imch-footer-discount-card">
                        <span class="imch-badge-discount">🔥 10% OFF AT CHECKOUT</span>
                        <p>Enjoy an instant <strong>10% cash savings</strong> when selecting Zelle, CashApp, Chime, or Apple Pay during checkout!</p>
                        <div class="imch-payment-icons-strip">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/zelle.svg' ); ?>" alt="Zelle" width="60" height="30">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/cashapp.svg' ); ?>" alt="CashApp" width="60" height="30">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/chime.svg' ); ?>" alt="Chime" width="60" height="30">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/applepay.svg' ); ?>" alt="Apple Pay" width="60" height="30">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/bank.svg' ); ?>" alt="Bank ACH Transfer" width="60" height="30">
                        </div>
                    </div>
                    <div class="imch-footer-wa-box">
                        <p>Have questions? Need urgent assistance?</p>
                        <a href="<?php echo esc_url( imch_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" class="imch-btn imch-btn-whatsapp imch-btn-sm">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/whatsapp.svg' ); ?>" alt="" width="18" height="18">
                            <span>Direct WhatsApp Support</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="imch-footer-bottom">
        <div class="imch-container imch-footer-bottom-inner">
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( IMCH_NAME ); ?>. All rights reserved. Austin, TX. &bull; <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" style="color: inherit; text-decoration: underline;">Privacy Policy</a> &bull; <a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>" style="color: inherit; text-decoration: underline;">Terms of Service</a></p>
            <div class="imch-footer-badges">
                <span>🛡️ SSL 256-Bit Encrypted</span>
                <span>🚛 Nationwide Delivery</span>
                <span><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/container-icon.png' ); ?>" alt="" class="imch-menu-container-icon" width="20" height="13" style="vertical-align: middle; margin-right: 4px;"> Verified Cargo-Worthy Units</span>
            </div>
        </div>
    </div>
</footer>

<!-- Quote / Inquiry Modal -->
<div class="imch-modal-overlay" id="imch-quote-modal" aria-hidden="true">
    <div class="imch-modal-dialog" role="dialog" aria-labelledby="imch-modal-title">
        <div class="imch-modal-header">
            <h3 id="imch-modal-title"><?php esc_html_e( 'Request Container Quote', 'imch' ); ?></h3>
            <button class="imch-modal-close" id="imch-quote-modal-close" aria-label="Close modal">✕</button>
        </div>
        <div class="imch-modal-body">
            <p class="imch-modal-intro"><?php esc_html_e( 'Fill in your details below for a fast, all-inclusive freight and container delivery quote.', 'imch' ); ?></p>
            <form id="imch-inquiry-form" class="imch-form">
                <?php wp_nonce_field( 'imch_inquiry_nonce', 'imch_nonce' ); ?>
                <div class="imch-form-row">
                    <label for="modal-fullname"><?php esc_html_e( 'Full Name *', 'imch' ); ?></label>
                    <input type="text" id="modal-fullname" name="fullname" required placeholder="John Doe">
                </div>
                <div class="imch-form-row-2">
                    <div class="imch-form-row">
                        <label for="modal-email"><?php esc_html_e( 'Email Address *', 'imch' ); ?></label>
                        <input type="email" id="modal-email" name="email" required placeholder="john@example.com">
                    </div>
                    <div class="imch-form-row">
                        <label for="modal-phone"><?php esc_html_e( 'Phone Number *', 'imch' ); ?></label>
                        <input type="tel" id="modal-phone" name="phone" required placeholder="(555) 000-0000">
                    </div>
                </div>
                <div class="imch-form-row-2">
                    <div class="imch-form-row">
                        <label for="modal-zip"><?php esc_html_e( 'Delivery ZIP Code *', 'imch' ); ?></label>
                        <input type="text" id="modal-zip" name="delivery_zip" required placeholder="e.g. 78758">
                    </div>
                    <div class="imch-form-row">
                        <label for="modal-product"><?php esc_html_e( 'Container Size / Type', 'imch' ); ?></label>
                        <input type="text" id="modal-product" name="product_interest" placeholder="e.g. 20ft High Cube Container">
                    </div>
                </div>
                <div class="imch-form-row">
                    <label for="modal-notes"><?php esc_html_e( 'Delivery Site Access Notes (Optional)', 'imch' ); ?></label>
                    <textarea id="modal-notes" name="notes" rows="3" placeholder="Tell us if you need tilt-bed ground drop or flatbed unloading..."></textarea>
                </div>
                <div class="imch-form-actions">
                    <button type="submit" class="imch-btn imch-btn-primary imch-btn-block" id="imch-submit-btn">
                        <span>Send Quote Request</span>
                    </button>
                </div>
                <div class="imch-form-feedback" id="imch-form-feedback"></div>
            </form>
        </div>
    </div>
</div>

<!-- Slide-in Right Cart Drawer -->
<div class="imch-cart-drawer-overlay" id="imch-cart-drawer-overlay" aria-hidden="true"></div>
<aside class="imch-cart-drawer" id="imch-cart-drawer" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Shopping Cart Drawer', 'imch' ); ?>" aria-hidden="true">
    <div class="imch-cart-drawer-header">
        <div class="imch-cart-drawer-title-wrap">
            <span class="imch-cart-drawer-icon">🛒</span>
            <h3 class="imch-cart-drawer-title"><?php esc_html_e( 'Your Cart', 'imch' ); ?></h3>
            <span class="imch-cart-drawer-badge" id="imch-drawer-count-badge"><?php echo ( function_exists( 'WC' ) && WC()->cart ) ? esc_html( WC()->cart->get_cart_contents_count() ) : '0'; ?></span>
        </div>
        <button type="button" class="imch-cart-drawer-close" id="imch-cart-drawer-close" aria-label="<?php esc_attr_e( 'Close cart', 'imch' ); ?>">✕</button>
    </div>

    <!-- Scrollable Items Area -->
    <div class="imch-cart-drawer-body" id="imch-cart-drawer-body">
        <?php if ( function_exists( 'imch_render_cart_drawer_items' ) ) { imch_render_cart_drawer_items(); } ?>
    </div>

    <!-- Bottom Actions & Subtotal Area -->
    <div class="imch-cart-drawer-footer" id="imch-cart-drawer-footer">
        <?php if ( function_exists( 'imch_render_cart_drawer_footer' ) ) { imch_render_cart_drawer_footer(); } ?>
    </div>
</aside>

<?php wp_footer(); ?>
</body>
</html>
