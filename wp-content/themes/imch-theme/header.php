<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <link rel="icon" type="image/svg+xml" href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/favicon.svg' ); ?>">
    <link rel="alternate icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/favicon.png' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="imch-skip-link" href="#main-content"><?php esc_html_e( 'Skip to content', 'imch' ); ?></a>

<!-- Top Bar -->
<div class="imch-topbar">
    <div class="imch-container imch-topbar-inner">
        <div class="imch-topbar-left">
            <span class="imch-topbar-badge">🏷️ 10% Instant Discount on Zelle • CashApp • Chime • Apple Pay</span>
        </div>
        <div class="imch-topbar-right">
            <span class="imch-topbar-item">📍 Austin, TX Hub • Nationwide Delivery</span>
            <a href="tel:<?php echo esc_attr( IMCH_PHONE_TEL ); ?>" class="imch-topbar-phone">
                📞 <span><?php echo esc_html( IMCH_PHONE ); ?></span>
            </a>
            <a href="<?php echo esc_url( imch_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" class="imch-topbar-wa">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/whatsapp.svg' ); ?>" alt="" width="16" height="16">
                <span>WhatsApp Quote</span>
            </a>
        </div>
    </div>
</div>

<!-- Main Sticky Header -->
<header class="imch-header" id="imch-header">
    <div class="imch-container imch-header-inner">
        <!-- Logo: System Colored Rectangle with ICHub -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="imch-brand" aria-label="<?php echo esc_attr( IMCH_NAME ); ?>">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.svg' ); ?>" alt="<?php echo esc_attr( IMCH_NAME ); ?>" class="imch-logo-desktop" width="300" height="52">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-badge.svg' ); ?>" alt="<?php echo esc_attr( IMCH_SHORT_NAME ); ?>" class="imch-logo-mobile" width="120" height="48">
        </a>

        <!-- Desktop Navigation -->
        <nav class="imch-nav" aria-label="<?php esc_attr_e( 'Primary Navigation', 'imch' ); ?>">
            <ul class="imch-menu">
                <li class="imch-menu-item <?php echo is_front_page() ? 'current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'imch' ); ?></a>
                </li>
                <li class="imch-menu-item imch-menu-shop-btn <?php echo ( function_exists('is_shop') && is_shop() && empty($_GET['filter_size']) ) ? 'current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/container-icon.png' ); ?>" alt="" class="imch-menu-container-icon" width="22" height="14"> <?php esc_html_e( 'Shop All', 'imch' ); ?></a>
                </li>
                <li class="imch-menu-item <?php echo is_page( 'buyers-guide' ) ? 'current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url( home_url( '/buyers-guide/' ) ); ?>"><?php esc_html_e( 'Buyers Guide', 'imch' ); ?></a>
                </li>
                <li class="imch-menu-item <?php echo is_page( 'about-us' ) ? 'current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>"><?php esc_html_e( 'About Us', 'imch' ); ?></a>
                </li>
                <li class="imch-menu-item <?php echo is_page( 'contact-us' ) ? 'current-menu-item' : ''; ?>">
                    <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'imch' ); ?></a>
                </li>
            </ul>
        </nav>

        <!-- Right Header Utility -->
        <div class="imch-header-actions">
            <!-- Search toggle button -->
            <button class="imch-icon-btn imch-search-toggle" id="imch-search-toggle" aria-label="<?php esc_attr_e( 'Open Search', 'imch' ); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>

            <!-- WooCommerce Cart Button -->
            <?php if ( function_exists( 'WC' ) ) : 
                $cart_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
                $cart_total = WC()->cart ? WC()->cart->get_cart_total() : '$0.00';
            ?>
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="imch-cart-pill" title="<?php esc_attr_e( 'View Shopping Cart', 'imch' ); ?>">
                <span class="imch-cart-icon-wrap">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-2z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    <span class="imch-cart-count" id="imch-cart-counter"><?php echo esc_html( $cart_count ); ?></span>
                </span>
                <span class="imch-cart-total-text"><?php echo wp_kses_post( $cart_total ); ?></span>
            </a>
            <?php endif; ?>

            <!-- Mobile Drawer Toggle -->
            <button class="imch-menu-toggle" id="imch-mobile-toggle" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'imch' ); ?>" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <!-- Collapsible Search Bar -->
    <div class="imch-search-drawer" id="imch-search-drawer">
        <div class="imch-container">
            <?php get_search_form(); ?>
        </div>
    </div>
</header>

<!-- Mobile Navigation Drawer -->
<div class="imch-drawer-overlay" id="imch-drawer-overlay"></div>
<aside class="imch-drawer" id="imch-drawer" aria-label="<?php esc_attr_e( 'Mobile Menu', 'imch' ); ?>">
    <div class="imch-drawer-header">
        <div class="imch-drawer-logo">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-badge.svg' ); ?>" alt="<?php echo esc_attr( IMCH_SHORT_NAME ); ?>" width="100" height="40">
        </div>
        <button class="imch-drawer-close" id="imch-drawer-close" aria-label="<?php esc_attr_e( 'Close Menu', 'imch' ); ?>">✕</button>
    </div>

    <div class="imch-drawer-body">
        <ul class="imch-drawer-nav">
            <li>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    <span><?php esc_html_e( 'Home', 'imch' ); ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="1" y="5" width="22" height="14" rx="2" ry="2"></rect><line x1="7" y1="5" x2="7" y2="19"></line><line x1="12" y1="5" x2="12" y2="19"></line><line x1="17" y1="5" x2="17" y2="19"></line></svg>
                    <span><?php esc_html_e( 'Shop', 'imch' ); ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo esc_url( home_url( '/buyers-guide/' ) ); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                    <span><?php esc_html_e( 'Buyers Guide', 'imch' ); ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span><?php esc_html_e( 'About Us', 'imch' ); ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span><?php esc_html_e( 'Contact Us', 'imch' ); ?></span>
                </a>
            </li>
        </ul>

        <div class="imch-drawer-contact-block">
            <div class="imch-drawer-badge">🏷️ 10% Instant Discount on Zelle, CashApp, Chime, Apple Pay</div>
            <a href="tel:<?php echo esc_attr( IMCH_PHONE_TEL ); ?>" class="imch-btn imch-btn-primary imch-btn-block">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 4px;" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                <span><?php echo esc_html( IMCH_PHONE ); ?></span>
            </a>
            <a href="<?php echo esc_url( imch_whatsapp_url() ); ?>" target="_blank" rel="noopener noreferrer" class="imch-btn imch-btn-whatsapp imch-btn-block">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/whatsapp.svg' ); ?>" alt="" width="20" height="20">
                <span>Chat on WhatsApp</span>
            </a>
        </div>
    </div>
</aside>

<main id="main-content" class="imch-site-main">
