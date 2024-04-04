<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NM_Theme
 */

 get_header();
 ?>
	 <main id="primary" class="site-main">

		 <?php
		 while ( have_posts() ) :
			 the_post();
 
			 get_template_part( 'template-views/blocks/hero/hero-alt-post' ); ?>
 
			 <div class="container container--sm">
			 	<?php get_template_part( 'template-views/blocks/single-post/single-post' ); ?>
			</div>
		 <?php endwhile; // End of the loop.
		 ?>

<?php get_template_part( 'template-views/blocks/recente-posts/recente-posts' ); ?>
 
	 </main><!-- #main -->
 
 <?php
 get_footer();
