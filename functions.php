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
			'menu-2' => esc_html__( 'Footer Menu 1', 'nm_theme' ),
			'menu-3' => esc_html__( 'Footer Menu 2', 'nm_theme' ),
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
	global $wp_query;
	$max_pages = ceil($wp_query->found_posts / get_option('posts_per_page'));

	$current_category = get_queried_object();

	// Dodajemo trenutnu kategoriju u objekat ako je to kategorija proizvoda
	if ( is_a( $current_category, 'WP_Term' ) && $current_category->taxonomy === 'product_cat' ) {
		$current_category_slug = $current_category->slug;
	} else {
		$current_category_slug = '';
	}
	wp_enqueue_style( 'nm_theme-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_enqueue_script( 'nm_theme-script', get_template_directory_uri() . '/dist/site.min.js', _S_VERSION, true );

	wp_localize_script( 'nm_theme-script',
		'themeLocal',
		[
			'maxPages' => $max_pages,
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'currentCategory' => $current_category_slug,
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
 * Woocommerce products number on archive page
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 9 );

function new_loop_shop_per_page( $cols ) {
  return 9;
}

/**
 * Woocommerce remove unnecessary fields from the checkout form
 */
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_country']);
	unset($fields['billing']['billing_state']); // Za polja računa (billing)
    unset($fields['shipping']['shipping_state']); // Za polja dostave (shipping) ako je potrebno
    return $fields;
}

/**
 * Filter Products
 */
add_action( 'wp_ajax_nopriv_filter_products_by_age', 'filter_products_by_age' );
add_action( 'wp_ajax_filter_products_by_age', 'filter_products_by_age' );

function filter_products_by_age() {
    $age_filter = (isset($_POST['ageRange']) && !empty($_POST['ageRange'])) ? explode(',', sanitize_text_field($_POST['ageRange'])) : [];
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

	if (!empty($age_filter)) {
		$meta_query = array('relation' => 'OR');
		foreach ($age_filter as $age) {
			$meta_query[] = array(
				'key' => 'age_range',
				'value' => $age,
				'compare' => 'LIKE',
			);
		}
	} else {
		$meta_query = ''; // Ako nema izabranih filtera, ne koristite meta_query
	}

    // Ako se filtrira unutar kategorije, pripremamo taksonomski query
    $tax_query = array();
    if (!empty($category)) {
        $tax_query = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category,
            )
        );
    }

    // Pripremamo argumente za WP_Query
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 9,
        'paged' => $paged,
        'meta_query' => $meta_query,
        'tax_query' => $tax_query,
		'orderby'   => 'menu_order',
		'order' => 'ASC'
    );

    $query = new WP_Query($args);

    $products = array();
    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            wc_get_template_part('content', 'product');
        }
        $products['content'] = ob_get_clean();
        $products['max_num_pages'] = $query->max_num_pages;
    } else {
        $products['content'] = 'Nema pronađenih proizvoda.';
        $products['max_num_pages'] = 0;
    }

    wp_send_json($products);
    wp_reset_postdata();
    die();
}


function perform_search() {
    // Sanitizacija ključne reči dobijene iz AJAX zahteva
    $searchTerm = isset($_REQUEST['term']) ? sanitize_text_field($_REQUEST['term']) : '';

    $query_args = array(
        'post_type' => array('post', 'product'),
        'posts_per_page' => 5,
        's' => $searchTerm,
    );

    $query = new WP_Query($query_args);

    $results = array();

	// Početak bufferinga
	ob_start();

	if ($query->have_posts()) {
		$products_html = '';
		$other_html = '';

		while ($query->have_posts()) : $query->the_post();
			// Proverite da li je trenutni post proizvod ili standardni post i dobavite odgovarajući thumbnail
			$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
			
			// Ako nema thumbnail-a, koristite placeholder sliku
			if (empty($thumbnail_url)) {
				$thumbnail_url = get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg'; // Zamenite sa pravim URL-om vaše placeholder slike
			}

			// Kreirajte HTML za slike
			if (get_post_type() === 'product') {
				// Ako jeste, dodajte ga u products_html
				$products_html .= '<div class="site-header__search-results-item"><img src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
				$products_html .= '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3></div>';
			} else {
				// Ako nije, dodajte ga u other_html
				$other_html .= '<div class="site-header__search-results-item"><img src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';
				$other_html .= '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3></div>';
			}
		endwhile;

		echo '<div class="site-header__search-results-inner">';
		// Sada kada smo sakupili sve proizvode i ostale postove, možemo da ih prikažemo
		if (!empty($products_html)) {
			echo '<span class="site-header__search-results-post-type">Proizvodi</span>' . $products_html;
		}

		if (!empty($other_html)) {
			echo '<span class="site-header__search-results-post-type">Ostalo</span>' . $other_html;
		}
		echo '</div>';

		// Generisanje URL-a za dugme koje vodi na stranicu sa rezultatima pretrage
		$search_url = home_url('/') . '?s=' . urlencode($searchTerm);
		echo '<a href="' . esc_url($search_url) . '" class="btn btn--white">Svi rezultati</a>';

	} else {
		// Nema pronađenih postova
		echo '<p class="site-header__search-results-empty">Nema pronađenih rezultata.</p>';
	}

	// Kraj bufferinga i čišćenje
	$results['content'] = ob_get_clean();

	// Vraćanje rezultata kao JSON
	wp_send_json($results);

	// Obavezno zaustavite izvršavanje nakon slanja AJAX odgovora
	wp_die();
?>

<?php 
// Možete sada ispisati $results['content'] gde god je to potrebno


}
add_action('wp_ajax_nopriv_perform_search', 'perform_search');
add_action('wp_ajax_perform_search', 'perform_search');




/**
 * Cart icon counter in header
 */
add_filter('woocommerce_add_to_cart_fragments', 'custom_woocommerce_header_add_to_cart_fragment');
function custom_woocommerce_header_add_to_cart_fragment($fragments) {
    ob_start();
    ?>
    <span class="site-header__actions-link-sup js-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    <?php
    $fragments['.js-cart-count'] = ob_get_clean();

    ob_start();
    ?>
    <div id="mini-cart">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php
    $fragments['#mini-cart'] = ob_get_clean();

    return $fragments;
}


add_action('wp_footer', 'add_custom_mini_cart');
function add_custom_mini_cart() {
    ?>
    <div id="mini-cart" style="display:none;">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php
}
