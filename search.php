<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package NM_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php if ( have_posts() ) : ?>

			<div class="hero hero--alt">
				<div class="container">
					<div class="hero__container">
						<div class="hero__content hero__content--sm">
							<h1 class="hero__content-title"><?php
								/* translators: %s: search query. */
								printf( esc_html__( 'Rezultati pretrage za: %s', 'nm_theme' ), '<span>' . get_search_query() . '</span>' );
							?></h1>
						</div>
					</div>
				</div>
			</div>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				if ($post->post_type == 'product') :
					get_template_part( 'woocommerce/content-product' );
				else :
					get_template_part( 'template-views/blocks/search/search' );
				endif;

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
