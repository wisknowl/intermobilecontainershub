<?php
/**
 * Main Index Template (WordPress Fallback)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div class="imch-page-hero">
    <div class="imch-container">
        <h1 class="imch-page-title"><?php single_post_title(); ?></h1>
    </div>
</div>

<div class="imch-page-content">
    <div class="imch-container">
        <?php if ( have_posts() ) : ?>
            <div class="imch-posts-list">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'imch-article-card' ); ?>>
                        <h2 class="imch-article-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="imch-article-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <div class="imch-pagination-wrap">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <p><?php esc_html_e( 'No content found.', 'imch' ); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
