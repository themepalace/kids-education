<?php 

/**
 * Customizer Partial Functions
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

if ( !function_exists( 'kids_education_customize_partial_features_title' ) ) :
	/**
	 * Render the features section title for the selective refresh partial.
	 *
	 * @since Kids Education 0.1
	 *
	 * @return string
	 */
	function kids_education_customize_partial_features_title() {
		$options = kids_education_get_theme_options();
		return esc_html( $options['features_section_title'] );
	}
endif;

if ( !function_exists( 'kids_education_customize_partial_gallery_title' ) ) :
	/**
	 * Render the counter section subtitle for the selective refresh partial.
	 *
	 * @since Kids Education 0.1
	 *
	 * @return string
	 */
	function kids_education_customize_partial_gallery_title() {
		$options = kids_education_get_theme_options();
		return esc_html( $options['gallery_title'] );
	}
endif;

// Partial refresh for category blog section

if ( !function_exists( 'kids_education_customize_partial_category_blog_title' ) ) :
	/**
	 * Render the counter section subtitle for the selective refresh partial.
	 *
	 * @since Kids Education 0.1
	 *
	 * @return string
	 */
	function kids_education_customize_partial_category_blog_title() {
		$options = kids_education_get_theme_options();
		return esc_html( $options['category_blog_title'] );
	}
endif;

// Partial refresh for recent section

if ( !function_exists( 'kids_education_customize_partial_recent_title' ) ) :
	/**
	 * Render the recent section title for the selective refresh partial.
	 *
	 * @since Kids Education 0.1
	 *
	 * @return string
	 */
	function kids_education_customize_partial_recent_title() {
		$options = kids_education_get_theme_options();
		return esc_html( $options['recent_title'] );
	}
endif;
