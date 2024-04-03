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

			<div class="recente-posts">
				<div class="container">
					<div class="recente-posts__container">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();


								get_template_part( 'template-views/blocks/search-block/search-block' );
					

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							

						endwhile; ?>
					</div>

					<?php the_posts_navigation(); ?>
				</div>
			</div>

		<?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	</main><!-- #main -->

<?php
get_footer();
