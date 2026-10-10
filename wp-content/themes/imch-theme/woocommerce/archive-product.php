<?php
/**
 * WooCommerce Product Archive / Shop Page
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$current_size = isset( $_GET['filter_size'] ) ? sanitize_text_field( $_GET['filter_size'] ) : '';
$current_type = isset( $_GET['filter_type'] ) ? sanitize_text_field( $_GET['filter_type'] ) : '';
?>

<div class="imch-shop-header">
    <div class="imch-container">
        <div class="imch-breadcrumbs-wrap">
            <?php woocommerce_breadcrumb(); ?>
        </div>
        <h1 class="imch-shop-title">
            <?php
            if ( $current_size === '20ft' ) {
                echo '20ft Shipping Containers';
            } elseif ( $current_size === '40ft' ) {
                echo '40ft Shipping Containers';
            } elseif ( is_product_category() ) {
                single_term_title();
            } else {
                echo 'Shipping Container Inventory';
            }
            ?>
        </h1>
        <p class="imch-shop-lead">
            Explore certified 20ft and 40ft units in stock across our nationwide logistics depot network. Take advantage of an instant 10% discount on Zelle, CashApp, Chime, and Apple Pay at checkout.
        </p>

        <!-- Quick Filter Pills -->
        <div class="imch-filter-pills">
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="imch-pill <?php echo empty( $current_size ) && ! is_product_category() ? 'imch-pill-active' : ''; ?>">
                All Containers (<?php echo wp_count_posts( 'product' )->publish; ?>)
            </a>
            <a href="<?php echo esc_url( add_query_arg( 'filter_size', '20ft', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-pill <?php echo $current_size === '20ft' ? 'imch-pill-active' : ''; ?>">
                🔹 20ft Shipping Containers
            </a>
            <a href="<?php echo esc_url( add_query_arg( 'filter_size', '40ft', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-pill <?php echo $current_size === '40ft' ? 'imch-pill-active' : ''; ?>">
                🔶 40ft Shipping Containers
            </a>
            <a href="<?php echo esc_url( add_query_arg( 's', 'High Cube', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-pill">
                ⬆️ High Cube (9'6" H)
            </a>
            <a href="<?php echo esc_url( add_query_arg( 's', 'Open Side', wc_get_page_permalink( 'shop' ) ) ); ?>" class="imch-pill">
                🚪 Open Side Units
            </a>
        </div>
    </div>
</div>

<div class="imch-shop-main">
    <div class="imch-container">
        <div class="imch-shop-toolbar">
            <div class="imch-results-count">
                <?php woocommerce_result_count(); ?>
            </div>
            <div class="imch-ordering-wrap">
                <?php woocommerce_catalog_ordering(); ?>
            </div>
        </div>

        <?php if ( woocommerce_product_loop() ) : ?>

            <div class="imch-products-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
                    wc_get_template_part( 'content', 'product' );
                endwhile;
                ?>
            </div>

            <div class="imch-pagination-wrap">
                <?php woocommerce_pagination(); ?>
            </div>

        <?php else : ?>
            <div class="imch-no-products">
                <p><?php esc_html_e( 'No containers found matching your criteria.', 'imch' ); ?></p>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="imch-btn imch-btn-primary">
                    <?php esc_html_e( 'View All Inventory', 'imch' ); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer( 'shop' ); ?>
