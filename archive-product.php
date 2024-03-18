<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
do_action( 'woocommerce_before_main_content' );
?>

<div class="hero hero--alt">
	<div class="container">
		<div class="hero__container">
			<div class="hero__content">
				<div class="hero__breadcrumbs">
					<?php woocommerce_breadcrumb(); ?>
				</div>
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<h1 class="hero__content-title page-title"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>

				<?php
				/**
				 * Hook: woocommerce_archive_description.
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				do_action( 'woocommerce_archive_description' );
				?>
			</div>

			<?php
			if (is_product_category()) :
				$term_id = get_queried_object_id(); // Dohvata ID trenutne kategorije proizvoda
				$thumbnail_id = get_term_meta($term_id, 'thumbnail_id', true); // Dohvata ID slike kategorije
				$image_url = wp_get_attachment_url($thumbnail_id); // Dohvata URL slike

				// Proverava da li postoji slika
				if ($image_url) : ?>
					<div class="hero__main-img">
						<img src="<?php echo $image_url; ?>" alt="">
					</div>
				<?php endif;
			endif; ?>
		</div>
	</div>
</div>

<div class="products products--alt">
	<div class="container">
		<div class="products__main-container">
			<div class="products__aside">

				<?php
				$current_category = get_queried_object();
				$product_categories = get_terms('product_cat', array(
					'orderby'    => 'name',
					'order'      => 'ASC',
					'hide_empty' => false,
				));

				// Product categories
				if (!empty($product_categories) && !is_wp_error($product_categories)) : ?>
					<div class="filter">
						<h3 class="filter__title">Kategorije</h3>
						<ul>
							<?php foreach ($product_categories as $category) : ?>
								<?php $class = ($current_category instanceof WP_Term && $current_category->term_id === $category->term_id) ? 'filter__active-item' : ''; ?>
								<li class="filter__item <?php echo $class; ?>">
									<a href="<?php echo esc_url(get_term_link($category)); ?>" class="filter__item-link">
										<?php echo esc_html($category->name); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				
				<!-- Gender -->
				<div class="filter">
					<h3 class="filter__title">Pol</h3>
					<div class="filter__options">
						<label class="checkbox">
							Dečaci
							<input type="checkbox" name="gender" value="boys">
							<span class="checkbox__checkmark font-checkmark"></span>
						</label>
						<label class="checkbox">
							Devojčice
							<input type="checkbox" name="gender" value="girls" checked>
							<span class="checkbox__checkmark font-checkmark"></span>
						</label>
						<label class="checkbox">
							Univerzalno
							<input type="checkbox" name="gender" value="unisex">
							<span class="checkbox__checkmark font-checkmark"></span>
						</label>
					</div>
				</div>

				<!-- Age -->
				<div class="filter">
					<h3 class="filter__title">Uzrast</h3>
					<div class="filter__options">
						<label class="checkbox">
						0 - 2 godine
							<input type="checkbox" name="age" value="0-2">
							<span class="checkbox__checkmark font-checkmark"></span>
						</label>
						<label class="checkbox">
							2 - 4 godine
							<input type="checkbox" name="age" value="2-4" checked>
							<span class="checkbox__checkmark font-checkmark"></span>
						</label>
						<label class="checkbox">
							4 - 6 godina
							<input type="checkbox" name="age" value="4-6">
							<span class="checkbox__checkmark font-checkmark"></span>
						</label>
						<label class="checkbox">
							6 - 8 godina
							<input type="checkbox" name="age" value="unisex">
							<span class="checkbox__checkmark font-checkmark"></span>
						</label>
					</div>
				</div>
			</div>
			<div class="products__main">
				<?php
					if ( woocommerce_product_loop() ) {

						/**
						 * Hook: woocommerce_before_shop_loop.
						 *
						 * @hooked woocommerce_output_all_notices - 10
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
						?>

						<div class="products__container">
							<?php if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();

									/**
									 * Hook: woocommerce_shop_loop.
									 */
									do_action( 'woocommerce_shop_loop' );

									wc_get_template_part( 'content', 'product' );
								}
							} ?>
						</div>
						
						<?php
						/**
						 * Hook: woocommerce_after_shop_loop.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					} else {
						/**
						 * Hook: woocommerce_no_products_found.
						 *
						 * @hooked wc_no_products_found - 10
						 */
						do_action( 'woocommerce_no_products_found' );
					}
				?>
			</div>
		</div>
	</div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );