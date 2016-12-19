<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

if ( ! function_exists( 'kids_education_is_loader_enable' ) ) :
	/**
	 * Check if loader is enabled.
	 *
	 * @since Kids Education 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function kids_education_is_loader_enable( $control ) {
		return $control->manager->get_setting( 'kids_education_theme_options[loader_enable]' )->value();
	}
endif;

if ( ! function_exists( 'kids_education_is_breadcrumb_enable' ) ) :
	/**
	 * Check if breadcrumb is enabled.
	 *
	 * @since Kids Education 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function kids_education_is_breadcrumb_enable( $control ) {
		return $control->manager->get_setting( 'kids_education_theme_options[breadcrumb_enable]' )->value();
	}
endif;

if ( ! function_exists( 'kids_education_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Kids Education 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function kids_education_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'kids_education_theme_options[pagination_enable]' )->value();
	}
endif;

if ( ! function_exists( 'kids_education_is_main_slider_active' ) ) :
	/**
	 * Check if info content is active.
	 *
	 * @since Kids Education 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function kids_education_is_main_slider_active( $control ) {

		return ( 'static-frontpage' == $control->manager->get_setting( 'kids_education_theme_options[enable_main_slider]' )->value() );
	}
endif;

// Active callback for features section
if ( ! function_exists( 'kids_education_is_features_active' ) ) :
	/**
	 * Check if features content is active.
	 *
	 * @since Kids Education 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function kids_education_is_features_active( $control ) {
		return ( 'static-frontpage' == $control->manager->get_setting( 'kids_education_theme_options[features_enable]' )->value() );
	}
endif;

// Active callback for gallery section
if ( ! function_exists( 'kids_education_is_gallery_active' ) ) :
	/**
	 * Check if gallery content is active.
	 *
	 * @since Kids Education 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function kids_education_is_gallery_active( $control ) {
		return ( 'static-frontpage' == $control->manager->get_setting( 'kids_education_theme_options[gallery_enable]' )->value() );
	}
endif;

// Active callback for category blog section
if ( ! function_exists( 'kids_education_is_category_blog_section_active' ) ) :
	/**
	 * Check if category blog content is active.
	 *
	 * @since Kids Education 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function kids_education_is_category_blog_section_active( $control ) {
		return ( 'static-frontpage' == $control->manager->get_setting( 'kids_education_theme_options[category_blog_enable]' )->value() );
	}
endif;

// Active callback for recent section
if ( ! function_exists( 'kids_education_is_recent_section_active' ) ) :
	/**
	 * Check if recent content is active.
	 *
	 * @since Kids Education 0.1
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function kids_education_is_recent_section_active( $control ) {
		return ( 'static-frontpage' == $control->manager->get_setting( 'kids_education_theme_options[recent_enable]' )->value() );
	}
endif;

// Active callback for post navigation
if ( ! function_exists( 'kids_education_enable_post_navigation' ) ) :
	/**
	 * Check if post navigation is enabled.
	 */

	function kids_education_enable_post_navigation( $control ) {
		return ( $control->manager->get_setting( 'kids_education_theme_options[post_navigation_enable]' )->value() );
	}
endif;