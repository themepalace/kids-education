<?php
/**
 * Kids Educationfunctions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

if ( ! function_exists( 'kids_education_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kids_education_setup() {
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Theme Palace, use a find and replace
	 * to change 'kids-education' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'kids-education', get_template_directory() . '/languages' );

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
	set_post_thumbnail_size( '320', '216', true );
	add_image_size( 'kids-education-gallery-section-small', '300', '300', true );
	add_image_size( 'kids-education-related-posts-image', '400', '200', true );
	add_image_size( 'kids-education-blog-images', '175', '230', true );
	add_image_size( 'kids-education-archive-search-image', '350', '265', true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'left-header-menu'  => esc_html__( 'Left Header Menu', 'kids-education' ),
		'right-header-menu' => esc_html__( 'Right Header Menu', 'kids-education' ),
		'footer-menu'       => esc_html__( 'Footer Menu', 'kids-education' ),	
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

	// This setup supports logo, site-title & site-description
	add_theme_support( 'custom-logo', array(
		'height'      => 70,
		'width'       => 120,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', kids_education_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'kids_education_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kids_education_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kids_education_content_width', 640 );
}
add_action( 'after_setup_theme', 'kids_education_content_width', 0 );

/**
* Register gallery thumbnail size to media.
*/
function kids_education_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'kids-education-gallery-section-small' 		=> __( 'Gallery Thumbnail', 'kids-education' ),
    ) );
}
add_filter( 'image_size_names_choose', 'kids_education_custom_sizes' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kids_education_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'kids-education' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'kids-education' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'kids-education' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Add widgets here.', 'kids-education' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'kids_education_widgets_init' );


if ( ! function_exists( 'kids_education_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function kids_education_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Montserrat Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat Alternates font: on or off', 'kids-education' ) ) {
		$fonts[] = 'Montserrat Alternates';
	}

	/* translators: If there are characters in your language that are not supported by Courgette, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Courgette font: on or off', 'kids-education' ) ) {
		$fonts[] = 'Courgette';
	}

	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto Condensed font: on or off', 'kids-education' ) ) {
		$fonts[] = 'Roboto Condensed';
	}

	/* translators: If there are characters in your language that are not supported by Raleway, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'kids-education' ) ) {
		$fonts[] = 'Raleway';
	}

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'kids-education' ) ) {
		$fonts[] = 'Poppins';
	}

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Titillium Web font: on or off', 'kids-education' ) ) {
		$fonts[] = 'Titillium Web';
	}

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Shadows Into Light: on or off', 'kids-education' ) ) {
		$fonts[] = 'Shadows Into Light';
	}

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Atma: on or off', 'kids-education' ) ) {
		$fonts[] = 'Atma';
	}
	
	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Indie Flower: on or off', 'kids-education' ) ) {
		$fonts[] = 'Indie Flower';
	}
	
	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Pacifico: on or off', 'kids-education' ) ) {
		$fonts[] = 'Pacifico';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css?family=' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function kids_education_scripts() {
	// Get theme options
	$options = kids_education_get_theme_options();
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'kids-education-fonts', kids_education_fonts_url(), array(), null );

	// Add font awesome css
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/plugins/minified/css/font-awesome.min.css', array(), '4.6.3' ); 

	// Add slick css
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/plugins/minified/css/slick.min.css', array(), '' );

	// Add slick-theme css
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/plugins/minified/css/slick-theme.min.css', array(), '' );

	// Add jquery-sidr-light css
	wp_enqueue_style( 'jquery-sidr-light', get_template_directory_uri() . '/assets/plugins/minified/css/jquery.sidr.light.min.css', array(), '' ); 

	// Add lightbox css
	wp_enqueue_style( 'lightbox', get_template_directory_uri() . '/assets/plugins/minified/css/lightbox.min.css', array(), '' );           

	wp_enqueue_style( 'kids-education-style', get_stylesheet_uri() );

	// Add blue color 
	wp_enqueue_style( 'kids-education-blue-style', get_template_directory_uri() . '/assets/colors/blue.min.css', array(), '' );

	// Load sidr js
	wp_enqueue_script( 'jquery-sidr', get_template_directory_uri() . '/assets/plugins/minified/js/jquery.sidr.min.js', array( 'jquery' ), '', true );

	// Load slick js
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/plugins/minified/js/slick.min.js', array( 'jquery' ), '', true );

	// Load isotope js
	wp_enqueue_script( 'jquery-isotope', get_template_directory_uri() . '/assets/plugins/minified/js/isotope.min.js', array( 'jquery' ), '', true );

	// Load lightbox js
	wp_enqueue_script( 'jquery-lightbox', get_template_directory_uri() . '/assets/plugins/minified/js/lightbox.min.js', array( 'jquery' ), '', true );

	// Load jquery-ui js
	wp_enqueue_script( 'jquery-ui-datepicker' );

	// Load custom js
	wp_enqueue_script( 'kids-education-custom', get_template_directory_uri() . '/assets/js/custom.min.js', array(), '',true );

	// Load the html5 shiv.
	wp_enqueue_script( 'kids-education-html5', get_template_directory_uri() . '/assets/js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'kids-education-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'kids-education-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '', true );

	wp_enqueue_script( 'kids-education-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kids_education_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';


