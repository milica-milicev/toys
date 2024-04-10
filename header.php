<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NM_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon.png"/>

	<!-- Preload fonts -->
	<!-- <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Regular.woff2" as="font" crossorigin /> -->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nm_theme' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-header__top">
			<div class="container">
				<nav class="site-header__top-nav">
					<ul class="site-header__top-nav-links">
						<li><a class="icon font-mail" href="mailto:info@svetigranja.rs">info@svetigranja.rs</a></li>
						<li><a class="icon font-phone" href="tel:0603214261">060 / 321 42 61</a></li>
					</ul>
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-4',
								'menu_id'        => 'header-top-menu',
								'menu_class'     => 'site-header__top-nav-menu',
							)
						);
					?>
				</nav>
			</div>
		</div>
		<div class="site-header__bottom">
			<div class="container">
				<div class="site-header__container">
					<div class="site-header__branding">
						<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img class="site-header__logo-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.svg" alt="<?php bloginfo( 'name' ); ?> Logo" title="<?php bloginfo( 'name' ); ?>">
						</a>
					</div>
					<div class="site-header__nav">
						<nav id="site-navigation" class="main-navigation js-navigation">
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'menu-1',
										'menu_id'        => 'primary-menu',
										'menu_class'     => 'main-navigation__menu',
									)
								);
							?>
						</nav><!-- #site-navigation -->
					</div>
					<div class="site-header__actions">
						<ul class="site-header__actions-list">
							<li class="site-header__actions-item">
								<button class="site-header__actions-link site-header__actions-link--search js-search-btn"><span class="font-search"></span></button>
							</li>
							<li class="site-header__actions-item">
								<!-- <button class="site-header__actions-link"><span class="font-cart"></span></button> -->
								<a class="site-header__actions-link  cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'Pogledajte vašu korpu' ); ?>">
									<span class="font-cart"></span>
									<span class="site-header__actions-link-sup js-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
								</a>
							</li>
						</ul>
						<button type="button" class="site-header__navigation-toggle js-menu-btn">
							<span class="site-header__navigation-toggle-stripe"></span>
							<span class="site-header__navigation-toggle-stripe"></span>
							<span class="site-header__navigation-toggle-stripe"></span>
						</button>
					</div>
				</div>
				<div class="site-header__search js-search-form">
					<?php get_search_form(); ?>
					<button class="site-header__search-close-btn js-close-search"><span class="font-close"></span></button>
					<div class="site-header__search-results js-search-results"></div>
					<div class="site-header__search-results-loader js-search-loader">Učitavaju se rezultati...</div>
				</div>
			</div>
		</div>
	</header>

	<div id="content" class="site-content">
