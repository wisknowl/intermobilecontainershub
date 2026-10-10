<?php
/**
 * Default Page Template
 * Used for standard WordPress pages and WooCommerce endpoints (Cart, Checkout, Account)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <div class="imch-page-hero">
        <div class="imch-container">
            <div class="imch-breadcrumbs-wrap">
                <?php woocommerce_breadcrumb(); ?>
            </div>
            <h1 class="imch-page-title"><?php the_title(); ?></h1>
        </div>
    </div>

    <div class="imch-page-content">
        <div class="imch-container">
            <div class="imch-entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

<?php endwhile; ?>

<?php get_footer(); ?>
