<?php
/**
 * Theme functions and definitions
 */

define( 'THEME_URI', get_home_url() );
define( 'THEME_NAME', get_bloginfo( 'name' ) );
define( 'THEME_TEMPLATE_DIR', get_template_directory() );
define( 'THEME_TEMPLATE_DIR_URI', get_template_directory_uri() );
define( 'THEME_STYLESHEET', get_stylesheet_uri() );
define( 'THEME_STYLESHEET_DIR', get_stylesheet_directory_uri() );
const THEME_ASSETS = THEME_STYLESHEET_DIR . '/assets/';
const THEME_IMAGES = THEME_ASSETS . 'images/';
const THEME_INCLUDES = THEME_TEMPLATE_DIR . '/includes';

/**
 * Sets up WordPress features.
 */
function wst_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'wst', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Hard cropped image size for grid items
	add_image_size( 'media', 696, 348, true ); // Default size
	add_image_size( 'media-small', 516, 258, true );
	add_image_size( 'media-medium', 624, 312, true );
	add_image_size( 'media-large', 1296, 648, true );
	add_image_size( 'media-full', 1600, 800, true );

	// Add support for editor styles
	add_theme_support( 'editor-styles' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary', 'wst' ),
			'footer-menu' => __( 'Footer', 'wst' ),
		)
	);

	// HTML5 support
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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for core custom logo.
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
add_action( 'after_setup_theme', 'wst_setup' );

// Set the content width in pixels
function wst_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wst_content_width', 856 );
}
add_action( 'after_setup_theme', 'wst_content_width', 0 );

// Register sidebar area.
function wst_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wst' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wst' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wst_widgets_init' );

// Enqueue scripts and styles.
function wst_scripts() {
	wp_enqueue_style( 'wst-style', get_stylesheet_uri(), array(), filemtime( get_theme_file_path( 'style.css' ) ) );
	wp_enqueue_script( 'wst-navigation', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), filemtime( get_theme_file_path( 'assets/js/scripts.min.js' ) ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wst_scripts' );

/**
 * Remove classic theme styles
 *
 * @return void
 */
function wst_disable_classic_theme_styles() {
	wp_deregister_style( 'classic-theme-styles' );
	wp_dequeue_style( 'classic-theme-styles' );
}
add_filter( 'wp_enqueue_scripts', 'wst_disable_classic_theme_styles', 100 );

// Theme functions
require THEME_INCLUDES . '/block-patterns.php';
require THEME_INCLUDES . '/customizer.php';
require THEME_INCLUDES . '/gutenberg.php';
require THEME_INCLUDES . '/template-functions.php';
require THEME_INCLUDES . '/template-tags.php';
require THEME_INCLUDES . '/widgets.php';

// Integrations
if ( class_exists( 'acf' ) ) {
	require THEME_INCLUDES . '/integrations/advanced-custom-fields.php';
}

if ( class_exists( 'GF_Form' ) ) {
	require THEME_INCLUDES . '/integrations/gravity-forms.php';
}

