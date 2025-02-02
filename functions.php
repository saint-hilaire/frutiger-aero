<?php
/**
 * Frutiger Aero functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Frutiger_Aero
 */

if ( ! defined( 'FRUTIGER_AERO_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'FRUTIGER_AERO_VERSION', '1.0.3' );
}

if ( ! defined( 'FRUTIGER_AERO_DEFAULT_COLOR_HEX' ) ) {
	define( 'FRUTIGER_AERO_DEFAULT_COLOR_HEX', '69b065' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function frutiger_aero_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Frutiger Aero, use a find and replace
		* to change 'frutiger-aero' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'frutiger-aero', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'frutiger-aero' ),
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
			'frutiger_aero_custom_background_args',
			array(
				'default-color' => FRUTIGER_AERO_DEFAULT_COLOR_HEX,
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
add_action( 'after_setup_theme', 'frutiger_aero_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function frutiger_aero_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'frutiger_aero_content_width', 640 );
}
add_action( 'after_setup_theme', 'frutiger_aero_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function frutiger_aero_scripts() {
	wp_enqueue_style( 'frutiger-aero-style', get_stylesheet_uri(), array(), FRUTIGER_AERO_VERSION );
	wp_style_add_data( 'frutiger-aero-style', 'rtl', 'replace' );

	wp_enqueue_script( 'frutiger-aero-navigation', get_template_directory_uri() . '/js/navigation.js', array(), FRUTIGER_AERO_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'frutiger_aero_scripts' );

function frutiger_aero_custom_background() {
	?>
	<style>
		body {
			<?php if ( get_background_image() ): ?>
			background-image: <? echo get_background_image(); ?>;
			<?php else: ?>
			background: linear-gradient(
				to right,
				#ffffff66,
				#0000001a,
				#ffffff33
			) #<?php echo FRUTIGER_AERO_DEFAULT_COLOR_HEX; ?>;
			<?php endif; ?>
		}
	</style>
	<?php
}
add_action( 'wp_head', 'frutiger_aero_custom_background' );

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

