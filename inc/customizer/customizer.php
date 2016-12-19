<?php
/**
 * Kids EducationTheme Customizer.
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

// load upgrade to pro option
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';

function kids_education_customize_register( $wp_customize ) {
	$options = kids_education_get_theme_options();

	// Load customize active callback functions.
	require get_template_directory() . '/inc/customizer/active-callback.php';

	// Load customize custom controls functions.
	require get_template_directory() . '/inc/customizer/custom-controls.php';

	// Load customize sanitize functions.
	require get_template_directory() . '/inc/customizer/sanitize.php';

	// Load customize custom controls functions.
	require get_template_directory() . '/inc/customizer/partial.php';

	// Load validation callback functions.
	require get_template_directory() . '/inc/customizer/validation.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	* Add panel for different home page sections
	*
	*/
	$wp_customize->add_panel( 'kids_education_sections_panel' , array(
	    'title'      => __('Sections','kids-education'),
	    'description'=> __( 'Kids Education available sections.', 'kids-education' ),
	    'priority'   => 130,
	) );

	//load main slider section
	require get_template_directory() . '/inc/customizer/sections/main-slider.php';

	//load features section
	require get_template_directory() . '/inc/customizer/sections/features.php';

	//Load search section
	require get_template_directory() . '/inc/customizer/sections/search-course.php';

	//Load recent section
	require get_template_directory() . '/inc/customizer/sections/recent.php';

	//load gallery section
	require get_template_directory() . '/inc/customizer/sections/gallery.php';

	//Load category blog section
	require get_template_directory() . '/inc/customizer/sections/category-blog.php';

	// Add panel for common theme options
	$wp_customize->add_panel( 'kids_education_theme_options_panel' , array(
	    'title'      => __( 'Theme Options','kids-education' ),
	    'description'=> __( 'Kids EducationTheme Options.', 'kids-education' ),
	    'priority'   => 150,
	) );
	
	// load static homepage option
	require get_template_directory() . '/inc/customizer/theme-options/homepage-static.php';

	// load excerpt option
	require get_template_directory() . '/inc/customizer/theme-options/excerpt.php';

	// load search placeholder option
	require get_template_directory() . '/inc/customizer/theme-options/search-placeholder.php';

	// load breadcrumb option
	require get_template_directory() . '/inc/customizer/theme-options/breadcrumb.php';

	// load pagination option
	require get_template_directory() . '/inc/customizer/theme-options/pagination.php';

	// load post navigation option
	require get_template_directory() . '/inc/customizer/theme-options/post-navigation.php';

	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
		// load custom css option
		require get_template_directory() . '/inc/customizer/theme-options/custom-css.php';
	}

	// load reset option
	require get_template_directory() . '/inc/customizer/theme-options/reset.php';
}
add_action( 'customize_register', 'kids_education_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function kids_education_customize_preview_js() {
	wp_enqueue_script( 'kids_education_customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'kids_education_customize_preview_js' );


if ( !function_exists( 'kids_education_reset_options' ) ) :
	/**
	 * Reset all options
	 *
	 * @since Kids Education 0.1
	 *
	 * @param bool $checked Whether the reset is checked.
	 * @return bool Whether the reset is checked.
	 */
	function kids_education_reset_options() {
		$options = kids_education_get_theme_options();
		if ( true === $options['reset_options'] ) {
			// Reset custom theme options.
			set_theme_mod( 'kids_education_theme_options', array() );
			// Reset custom header and backgrounds.
			remove_theme_mod( 'header_image' );
			remove_theme_mod( 'header_image_data' );
			remove_theme_mod( 'header_textcolor' );
		}
	  	else {
		    return false;
	  	}
	}
endif;
add_action( 'customize_save_after', 'kids_education_reset_options' );

// Add Custom Css
function kids_education_inline_css() {
	$options = kids_education_get_theme_options();
	$custom_css = ! empty( $options['custom_css'] ) ? $options['custom_css'] : '';
	$header_text_color = get_header_textcolor(); // get header text color

	$color_layout_css = '';

	if ( HEADER_TEXTCOLOR !== $header_text_color ) {
		$header_color = '
			.site-header .site-title a,
			.site-description {
				color: #'. esc_attr( $header_text_color ) .
			'}';

		$color_layout_css .= $header_color;
	}
	
	$css  = $color_layout_css;	
	$css .= $custom_css;
	wp_add_inline_style( 'kids-education-style', $css );
}
add_action( 'wp_enqueue_scripts', 'kids_education_inline_css', 10 );


// migrate custom css to core add css
function kids_education_custom_css_migrate() {
	$options = kids_education_get_theme_options();
	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
		$custom_css = $options['custom_css'];
		if ( $custom_css ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return = wp_update_custom_css_post( $core_css . $custom_css );
			if ( ! is_wp_error( $return ) ) {
				// Remove from theme.
	            $options['custom_css'] = '';
	            set_theme_mod( 'kids_education_theme_options', $options );
			}
		}
	}
}
add_action( 'after_setup_theme', 'kids_education_custom_css_migrate' );