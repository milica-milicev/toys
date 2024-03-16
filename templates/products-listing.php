<?php
/**
 * Template Name: Products listing
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NM_Theme
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
    <div class="products">
	    <div class="container">
		    
    <?php
        // Loop kroz sve proizvode
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1 // Prikaži sve proizvode
        );

        $products = new WP_Query( $args );

        if ( $products->have_posts() ) : ?>
        <!-- HTML za prikaz kategorija -->
        <div id="category-filter">
            <select id="category-select">
                <option value="">Sve kategorije</option>
                <?php
                // Dohvati sve kategorije
                $categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                ));
                foreach ($categories as $category) {
                    echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="products__container" id="filtered-products">
            <?php
            while ( $products->have_posts() ) : $products->the_post();
                global $product;

                // Dohvati osnovne informacije o proizvodu
                $product_id = $product->get_id();
                $product_title = get_the_title();
                $product_image = wp_get_attachment_url( get_post_thumbnail_id( $product_id ) );
                $price = $product->get_price_html();
                $product_tags = wp_get_post_terms( $product_id, 'product_tag' );
                ?>

                <div class="product-item">
                    <div class="product-item__wrap">
                        <div class="product-item__img">
                            <a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
                                <img src="<?php echo $product_image; ?>" alt="<?php echo $product_title; ?>">
                            </a>
                            <?php
                            if ( $product_tags ) {
                                echo '<ul>';
                                foreach ( $product_tags as $tag ) {
                                    echo '<li><a class="product-item__tag product-item__tag--action" href="' . esc_url( get_term_link( $tag ) ) . '">' . $tag->name . '</a></li>';
                                }
                                echo '</ul>';
                            }
                            ?>
                        </div>
                        <div class="product-item__info">
                            <h3 class="product-item__name"><a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php echo $product_title; ?></a></h3>
                            <div class="product-item__price">
                                <?php echo $price; ?>
                                <!-- <span class="product-item__price-new">2990rsd</span>
                                <span class="product-item__price-old">3990rsd</span> -->
                            </div>
                            <div class="product-item__btn">
                                <!-- <a class="btn" href="javascript:;">Dodaj u korpu</a> -->
                                <?php woocommerce_template_loop_add_to_cart(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            endwhile;
            wp_reset_postdata(); ?>
        </div>
        <?php else :
            echo __( 'Nema pronađenih proizvoda' );
        endif;
        ?>
	</div>
    </div>
</main>
</div>


			

<?php
get_footer();