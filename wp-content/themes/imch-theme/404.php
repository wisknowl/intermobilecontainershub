<?php
/**
 * 404 Not Found Template
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div class="imch-404-wrap">
    <div class="imch-container text-center">
        <div class="imch-404-content">
            <span class="imch-404-num">404</span>
            <h1 class="imch-404-title">Container Not Found</h1>
            <p class="imch-404-lead">The page or container listing you are looking for may have been moved, renamed, or is currently out of stock.</p>

            <div class="imch-404-search-box">
                <?php get_search_form(); ?>
            </div>

            <div class="imch-404-actions">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="imch-btn imch-btn-primary">
                    Return to Homepage
                </a>
                <a href="<?php echo esc_url( add_query_arg( 'filter_size', '20ft', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-btn imch-btn-outline">
                    Shop 20ft Containers
                </a>
                <a href="<?php echo esc_url( add_query_arg( 'filter_size', '40ft', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-btn imch-btn-outline">
                    Shop 40ft Containers
                </a>
                <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="imch-btn imch-btn-secondary">
                    Contact Depot Team
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
