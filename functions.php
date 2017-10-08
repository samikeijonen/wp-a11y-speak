<?php
/**
 * WP a11y speak functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_a11y_speak
 */

if ( ! function_exists( 'wp_a11y_speak_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wp_a11y_speak_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on WP a11y speak, use a find and replace
		 * to change 'wp-a11y-speak' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wp-a11y-speak', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'wp-a11y-speak' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wp_a11y_speak_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'wp_a11y_speak_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_a11y_speak_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_a11y_speak_content_width', 640 );
}
add_action( 'after_setup_theme', 'wp_a11y_speak_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function wp_a11y_speak_scripts() {
	wp_enqueue_style( 'wp-a11y-speak-style', get_stylesheet_uri() );

	wp_enqueue_script( 'wp-a11y-speak-navigation', get_theme_file_uri( 'assets/scripts/navigation.js' ), array(), '20171015', true );

	wp_enqueue_script( 'wp-a11y-speak-skip-link-focus-fix', get_theme_file_uri( 'assets/scripts/skip-link-focus-fix.js' ), array(), '20171015', true );

	// Load filtering JS with wp-a11y JS.
	wp_enqueue_script( 'wp-a11y-speak-filter', get_theme_file_uri( 'assets/scripts/filter-cities.js' ), array( 'wp-a11y' ), '20171008', true );

	// Strings used in JS.
	wp_localize_script( 'wp-a11y-speak-filter', 'WPA11ySpeakText', array(
		'restUrl'         => esc_url( rest_url( 'wp/v2/posts?per_page=50' ) ),
		'successMessage1' => esc_html__( 'Filtering contacts was successful.', 'wp-a11y-speak' ),
		'successMessage2' => esc_html__( 'Filtering categories was successful.', 'wp-a11y-speak' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_a11y_speak_scripts' );

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

