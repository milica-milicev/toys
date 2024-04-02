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

				<div class="filters">
					<button class="filters__toggle js-filters-toggle">Filteri <span class="font-chevron-down"></span></button>
				
					<div class="filters__wrap js-filters">
						<div class="filters__inner">
							<span class="filters__close js-filters-close"><span class="font-close"></span></span>
							<?php
							$current_category = get_queried_object();
							$product_categories = get_terms('product_cat', array(
								'order'      => 'ASC',
								'hide_empty' => false,
								'exclude'    => array(16) // Uncategorized category ID
							));

							// Product categories
							if (!empty($product_categories) && !is_wp_error($product_categories)) : ?>
								<div class="filter">
									<h3 class="filter__title">Kategorije</h3>
									<ul>
										<li class="filter__item <?php if (is_shop()) echo 'filter__active-item'; ?>">
											<a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="filter__item-link">Sve Igračke</a>
										</li>
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

							<!-- Age -->
							<div class="filter">
								<h3 class="filter__title">Uzrast</h3>
								<div class="filter__options">
									<?php // Prikazivanje filtera za uzrast
									$age_ranges = get_field_object('field_65f94e27961f5'); // 'field_key'
					
									if ($age_ranges && isset($age_ranges['choices'])) :
										foreach ($age_ranges['choices'] as $key => $value) : ?>
											<label class="checkbox">
												<?php echo esc_html($value); ?>
												<input class="js-filter-option" type="checkbox" name="age_range" value="<?php echo esc_attr($key); ?>">
												<span class="checkbox__checkmark font-checkmark"></span>
											</label>
										<?php
										endforeach;
									endif; ?>
								</div>
							</div>
						</div>
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
						remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
						remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
						
						do_action( 'woocommerce_before_shop_loop' );
						?>

						<div class="products__container js-products">
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
						<div class="products__loader js-products-loader">
							<div class="products__loader-wrap">
								<span class="products__loader-spinner"></span>Proizvodi se učitavaju...
							</div>
						</div>
						
						<?php
						/**
						 * Hook: woocommerce_after_shop_loop.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						//do_action( 'woocommerce_after_shop_loop' );
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
