<?php
/**
 * titrin functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package titrin
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
function titrin_setup() {
	
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on titrin, use a find and replace
		* to change 'titrin' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'titrin', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'titrin' ),
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
			'titrin_custom_background_args',
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
add_action( 'after_setup_theme', 'titrin_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function titrin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'titrin_content_width', 640 );
}
add_action( 'after_setup_theme', 'titrin_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function titrin_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'titrin' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'titrin' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'titrin_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function titrin_scripts() {
	wp_enqueue_style( 'titrin-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'titrin-style', 'rtl', 'replace' );

	// Enqueue the front-page styles only on the front page
	if (is_front_page()) {
		wp_enqueue_style(
			'front-page-styles', // Handle for the stylesheet
			get_template_directory_uri() . '/css/front-page.css', // Path to the CSS file
			array(), // Dependencies (none in this case)
			'1.0.0', // Version number
			'all' // Media type
		);
	}

	wp_enqueue_script( 'titrin-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

		// swiper configuration
		if (is_front_page()) {
			wp_enqueue_style('swiper-styles', get_template_directory_uri() . '/css/swiper-bundle.css', array(), '11.0.6');
			wp_enqueue_script('swiper-scripts', get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), '11.0.6', array('strategy' => 'defer'));
			wp_enqueue_script('swiper-settings', get_template_directory_uri() . '/js/swiper-settings.js', array('swiper-scripts'), _S_VERSION, array('strategy' => 'defer'));
		}

		// enqueue stylesheet for single blog posts 
		if ( is_single () && get_post_type() == 'post' ) {
			wp_enqueue_style( 'titrin-single-post', get_template_directory_uri() . '/css/single-blog.css', array(), '1.0' );
		}
}
add_action( 'wp_enqueue_scripts', 'titrin_scripts' );
//this is for the blog page css
function titrin_enqueue_blog_styles() {
	if ( is_home() && ! is_front_page() ) {
		wp_enqueue_style( 'titrin-blog-page', get_template_directory_uri() . '/css/blog-page.css', array(), '1.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'titrin_enqueue_blog_styles' );
//this is for the contact page css
function titrin_enqueue_contact_styles() {
	if ( is_page_template( 'contact-us.php' ) ) {
		wp_enqueue_style( 'titrin-contact-page', get_template_directory_uri() . '/css/contact-us.css', array(), '1.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'titrin_enqueue_contact_styles' );
//this is for the services page css
function titrin_enqueue_services_styles(){
	if( is_page_template('page-services.php') ){
		wp_enqueue_style( 'titrin-services-page', get_template_directory_uri() . '/css/service-page.css', array(), '1.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'titrin_enqueue_services_styles' );

// this is for the single service page css
function titrin_enqueue_service_styles(){
	if( is_singular('service') ){
		wp_enqueue_style( 'titrin-service-page', get_template_directory_uri() . '/css/single-service.css', array(), '1.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'titrin_enqueue_service_styles' );

function titrin_register_services_post_type() {
	$labels = array(
			'name'                  => _x( 'Services', 'Post type general name', 'titrin' ),
			'singular_name'         => _x( 'Service', 'Post type singular name', 'titrin' ),
			'menu_name'             => _x( 'Services', 'Admin Menu text', 'titrin' ),
			'name_admin_bar'        => _x( 'Service', 'Add New on Toolbar', 'titrin' ),
			'add_new'               => __( 'Add New', 'titrin' ),
			'add_new_item'          => __( 'Add New Service', 'titrin' ),
			'new_item'              => __( 'New Service', 'titrin' ),
			'edit_item'             => __( 'Edit Service', 'titrin' ),
			'view_item'             => __( 'View Service', 'titrin' ),
			'all_items'             => __( 'All Services', 'titrin' ),
			'search_items'          => __( 'Search Services', 'titrin' ),
			'parent_item_colon'     => __( 'Parent Services:', 'titrin' ),
			'not_found'             => __( 'No services found.', 'titrin' ),
			'not_found_in_trash'    => __( 'No services found in Trash.', 'titrin' ),
			'featured_image'        => __( 'Service Featured Image', 'titrin' ),
			'set_featured_image'    => __( 'Set featured image', 'titrin' ),
			'remove_featured_image' => __( 'Remove featured image', 'titrin' ),
			'use_featured_image'    => __( 'Use as featured image', 'titrin' ),
	);

	$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'service' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'menu_icon'          => 'dashicons-hammer',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'show_in_rest'       => true,
	);

	register_post_type( 'service', $args );
}
add_action( 'init', 'titrin_register_services_post_type' );

function titrin_custom_excerpt_length( $length ) {
	return 20; // Change 20 to however many words you want
}
add_filter( 'excerpt_length', 'titrin_custom_excerpt_length' );

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}