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

			<div class="search-blocks">
				<div class="container">
					<div class="search-blocks__container">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
								get_template_part( 'template-views/blocks/search-blocks/search-blocks' );
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

		<?php else : ?>

		<div class="search-empty">
			<div class="hero hero--alt">
				<div class="container">
					<div class="hero__container">
						<div class="hero__content hero__content--sm">
							<h1 class="hero__content-title"><?php
								/* translators: %s: search query. */
								printf( esc_html__( 'Nismo pronašli ono što tražite: %s', 'nm_theme' ), '<span>' . get_search_query() . '</span>' );
							?></h1>
							<p class="hero__content-desc"><?php esc_html_e( 'Nažalost, nismo uspeli da pronađemo proizvode ili sadržaje koji odgovaraju vašem upitu. Proverite da li ste tačno uneli ključne reči ili pokušajte sa drugačijim terminima pretrage.', 'nm_theme' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php endif;
		?>
	</main><!-- #main -->

<?php
get_footer();
