<?php
/**
 * Template Name: Homepage
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
		<?php // get content blocks
			get_template_part( 'template-views/blocks/hero/hero' );
			get_template_part( 'template-views/blocks/tiles/tiles' );
			get_template_part( 'template-views/blocks/products/products' );
			get_template_part( 'template-views/blocks/isolated-product/isolated-product' );
			get_template_part( 'template-views/blocks/products/products-akcija' );
			get_template_part( 'template-views/blocks/cards/cards' );
			get_template_part( 'template-views/blocks/info/info' );
			get_template_part( 'template-views/blocks/testimonials/testimonials' );
			get_template_part( 'template-views/blocks/recente-posts/recente-posts' );
		?>
	</main>
</div>

<?php
get_footer();
