<?php
/**
 * Search Results Template
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header( 'shop' ); ?>

<div class="imch-shop-header">
    <div class="imch-container">
        <div class="imch-breadcrumbs-wrap">
            <?php woocommerce_breadcrumb(); ?>
        </div>
        <h1 class="imch-shop-title">
            Search Results for: &ldquo;<?php echo esc_html( get_search_query() ); ?>&rdquo;
        </h1>
        <p class="imch-shop-lead">Showing matched shipping containers and inventory specifications.</p>
    </div>
</div>

<div class="imch-shop-main">
    <div class="imch-container">
        <?php if ( have_posts() ) : ?>
            <div class="imch-products-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php if ( get_post_type() === 'product' ) : ?>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    <?php else : ?>
                        <div class="imch-card imch-card-search-text">
                            <div class="imch-card-body">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php the_excerpt(); ?></p>
                                <a href="<?php the_permalink(); ?>" class="imch-btn imch-btn-sm imch-btn-outline">Read More →</a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
            <div class="imch-pagination-wrap">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <div class="imch-no-products">
                <p>No container units found matching &ldquo;<?php echo esc_html( get_search_query() ); ?>&rdquo;.</p>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="imch-btn imch-btn-primary">
                    Browse All Available Inventory
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer( 'shop' ); ?>
