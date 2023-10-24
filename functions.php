<?php

/**
 * estore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package estore
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function estore_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on estore, use a find and replace
		* to change 'estore' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('estore', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'main-navigation' => esc_html__('Main Navigation', 'estore'),
			'footer_1' => esc_html__('Footer Navigation 1', 'estore'),
			'footer_2' => esc_html__('Footer Navigation 2', 'estore'),
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
			'estore_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

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
	$registration_allowed = get_option('users_can_register');

	if (!$registration_allowed) {
		update_option('users_can_register', 1);
	}
}
add_action('after_setup_theme', 'estore_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function estore_content_width()
{
	$GLOBALS['content_width'] = apply_filters('estore_content_width', 640);
}
add_action('after_setup_theme', 'estore_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function estore_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'estore'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'estore'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'estore_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function estore_scripts()
{
	wp_enqueue_style('estore-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('estore-style', 'rtl', 'replace');

	wp_enqueue_script(
		'owl-carousel',
		'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js',
		array(), // Dependencies, if any
		'2.3.4',  // Version number
		true     // Load the script in the footer (optional)
	);
	wp_enqueue_script('estore-owl-carousel', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true);
	wp_enqueue_script('estore-main', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true);
	wp_enqueue_script('estore-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'estore_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Register Custom Post Type
function advertisement_post_type() {

	$labels = array(
		'name'                  => _x( 'Advertisements', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Advertisement', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Advertisements', 'text_domain' ),
		'name_admin_bar'        => __( 'Advertisement', 'text_domain' ),
		'archives'              => __( 'Advertisement Archives', 'text_domain' ),
		'attributes'            => __( 'Advertisements Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Advertisements', 'text_domain' ),
		'add_new_item'          => __( 'Add New Advertisement', 'text_domain' ),
		'add_new'               => __( 'Add New Advertisement', 'text_domain' ),
		'new_item'              => __( 'New Advertisement', 'text_domain' ),
		'edit_item'             => __( 'Edit Advertisement', 'text_domain' ),
		'update_item'           => __( 'Update Advertisement', 'text_domain' ),
		'view_item'             => __( 'View Advertisement', 'text_domain' ),
		'view_items'            => __( 'View Advertisements', 'text_domain' ),
		'search_items'          => __( 'Search Advertisement', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Advertisement', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Advertisement', 'text_domain' ),
		'items_list'            => __( 'Advertisements list', 'text_domain' ),
		'items_list_navigation' => __( 'Advertisements list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Advertisements list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Advertisement', 'text_domain' ),
		'description'           => __( 'Advertisement for front view', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'advertisement_type', $args );

}
add_action( 'init', 'advertisement_post_type', 0 );
