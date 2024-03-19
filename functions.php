<?php
/**
 * NM Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NM_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nm_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on NM Theme, use a find and replace
		* to change 'nm_theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'nm_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'nm_theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'nm_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'nm_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nm_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nm_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'nm_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nm_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nm_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nm_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nm_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nm_theme_scripts() {
	wp_enqueue_style( 'nm_theme-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_enqueue_script( 'nm_theme-script', get_template_directory_uri() . '/dist/site.min.js', _S_VERSION, true );

	wp_localize_script( 'nm_theme-script',
		'themeLocal',
		[
			'ajax_url'     => admin_url( 'admin-ajax.php' ),
		]
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nm_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) {
// 	require get_template_directory() . '/inc/jetpack.php';
// }

/**
 * Add woocommerce support in the theme
 */
function nm_theme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'nm_theme_add_woocommerce_support' );

/**
 * Custom search form
 */
function custom_search_form($form) {
	$form = '<form class="site-header__search-form" role="search" method="get" id="search-form" action="' . home_url( '/' ) . '" >
	<div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
	<input type="text" class="site-header__search-input js-search-field" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Pretraga...' ) . '" />
	<button type="submit" class="site-header__search-submit" id="search-submit">Pretraži</button>
	</div>
	</form>';

	return $form;
}

add_filter('get_search_form', 'custom_search_form');


/**
 * Woocommerce disable css
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Products filters
 */


// add_action('pre_get_posts', 'custom_age_range_filter');
// function custom_age_range_filter($query) {
//     if (!is_admin() && $query->is_main_query() && is_post_type_archive('product')) {
//         if (!empty($_GET['uzrast'])) {
//             // Zamena razmaka sa '+' u slučaju da je automatski dekodiran
//             $age_ranges_raw = str_replace(' ', '+', $_GET['uzrast']);
//             $age_ranges = explode('+', $age_ranges_raw);
//             $meta_query = array('relation' => 'OR');
//             foreach ($age_ranges as $range) {
//                 $meta_query[] = array(
//                     'key' => 'age_range',
//                     'value' => sanitize_text_field($range),
//                     'compare' => 'LIKE',
//                 );
//             }
//             $query->set('meta_query', $meta_query);
//         }
//     }
// }


/**
 * Filter Team
 */

function filter_products() {
	// $selected_age = '';

	// if ( ! empty( $_REQUEST['selected_age'] ) ) {
	// 	$selected_age = $_REQUEST['selected_age'];
	// }

	// $args = array(
	// 	'post_type' => 'product',
	// 	'posts_per_page' => -1,
	// 	'meta_query' => array(
	// 		array(
	// 			'key' => 'age_range',
	// 			'value' => $selected_age,
	// 			'compare'  => 'LIKE',
	// 			'operator' => 'IN',
	// 		)
	// 	)
	// );

	$selected_ages = array();

    if ( ! empty( $_REQUEST['selected_age'] ) ) {
        $selected_ages = explode(',', $_REQUEST['selected_age']);
    }

    $meta_query = array('relation' => 'OR');

    foreach ($selected_ages as $age) {
        $meta_query[] = array(
            'key' => 'age_range',
            'value' => sanitize_text_field($age),
            'compare' => 'LIKE',
        );
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'meta_query' => $meta_query
    );

	// if ( ! empty( $_REQUEST['loc_term'] ) ) {
	// 	$loc_term = $_REQUEST['loc_term'];
	// }

	// $tax_query = [ 'relation' => 'AND' ];

	// if ( isset( $selected_age ) && $selected_age != "" ) {
	// 	$tax_query[] = [
	// 		'taxonomy' => 'ctax_team_sector',
	// 		'field'    => 'slug',
	// 		'terms'    => $selected_age,
	// 		'compare'  => 'LIKE',
	// 		'operator' => 'IN',
	// 	];
	// }

	// if ( isset( $loc_term ) && $loc_term != "" ) {
	// 	$tax_query[] = [
	// 		'taxonomy' => 'ctax_team_location',
	// 		'field'    => 'slug',
	// 		'terms'    => $loc_term,
	// 		'compare'  => 'LIKE',
	// 		'operator' => 'IN',
	// 	];
	// }

	// $args = [
	// 	'post_type'      => 'product',
	// 	'posts_per_page' => - 1,
	// 	'tax_query'      => $tax_query,
	// ];

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		ob_start(); ?>
		<?php while ( $query->have_posts() ): $query->the_post(); ?>
		<?php wc_get_template_part('content', 'product'); ?>
			
		<?php endwhile; ?>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		$response = [
			'content' => $content,
		];

		// wp_send_json( $response );

		wp_send_json_success(array(
			$content
		));

		wp_reset_postdata();
	endif;

	die();

	
}

add_action( 'wp_ajax_filter_products', 'filter_products' );
add_action( 'wp_ajax_nopriv_filter_products', 'filter_products' );