<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NM_Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-footer__main">
			<div class="container">
				<div class="footer-container">
					<div class="footer-left footer-item">
						<h5>Kontakt</h5>
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-2',
									'menu_id'        => 'footer-menu-1',
									'menu_class'     => 'footer-menu',
								)
							);
						?>
						<div class="footer-item-media">
							<a href="javascript:;" class="font-face"></a>
							<a href="javascript:;" class="font-insta"></a>
							<a href="javascript:;" class="font-tik_tok"></a>
						</div>
					</div>
					<div class="footer-center footer-item">
						<h5>Informacije</h5>
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-3',
									'menu_id'        => 'footer-menu-2',
									'menu_class'     => 'footer-menu',
								)
							);
						?>
					</div>
					<div class="footer-right footer-item">
						<h5>Budi u toku</h5>
						<p>Ovde ostavi svoj e-mail ukoliko među prvima želiš da saznaš o akcijama i specijalnim ponudama. </p>
						<div class="newsletter">
							<?php echo do_shortcode('[mc4wp_form id=136]'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="site-footer__copyright">
			<div class="container">
				<p>Sva prava zadržana &copy; <?php echo date('Y'); ?> Svet Igranja. </p>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
