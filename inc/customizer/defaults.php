<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 *
 * @return array An array of default values
 */

function kids_education_get_default_theme_options() {
	$theme_data = wp_get_theme(); // get theme data
	$kids_education_default_options = array(

		// Main Slider
		'enable_main_slider'			=> 'disabled',
		'main_slider_type'				=> 'page',
		'main_slider_no_of_posts'		=> 2,
		'main_slider_learn_more_text'   => __( 'Learn more', 'kids-education' ),


		// Features section
		'features_enable'				=> 'disabled',
		'features_section_title' 		=> __( 'School Activities', 'kids-education' ),
		'features_section_type'			=> 'category',
		'features_dropdown_categories'  => null,

		// gallery section
		'gallery_enable'				=> 'disabled',
		'gallery_source'				=> 'category',
		'gallery_title'					=> __( 'Our Gallery', 'kids-education' ),
		'gallery_no_of_img'				=> 8,
		'gallery_category'				=> null,
		'gallery_page_readmore'			=> __( 'Load More', 'kids-education' ),

		// Category blog
		'category_blog_enable' 			=> 'disabled',
		'category_blog_content_type'	=> 'category',
		'category_blog_title'			=> __( 'Kindergarten Blog & News', 'kids-education' ),
		'category_blog_count' 			=> 3,

		// Recent
		'recent_enable' 				=> 'disabled',
		'recent_title' 					=> __( 'Recent Classes', 'kids-education' ),
		'recent_count'	 				=> 6,
		'recent_visible_no_of_slides' 	=> 3,
		'recent_content_type'	 		=> 'post',

		// Search Course
		'search_course_enable'			=> 'disabled',

		// Theme Options
		'search_text'					=> __( 'Search...', 'kids-education' ),
		'long_excerpt_length'           => 25,
		'short_excerpt_length'          => 10,
		'read_more_text'		        => __( 'Read More >>', 'kids-education' ),
		'breadcrumb_enable'         	=> false,
		'breadcrumb_separator'         	=> '/',
		'post_navigation_enable'		=> true,
		'post_navigation_type'			=> 'default',
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',
		'reset_options'      			=> false,
		'enable_frontpage_content' 		=> true,

	);

	$output = apply_filters( 'kids_education_default_theme_options', $kids_education_default_options );
	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}

/**
 * Returns kids_education_content registered for journal.
 *
 * @since Kids Education 0.1
 */
function kids_education_get_content() {
	$theme_data = wp_get_theme();

	$kids_education_content['left'] 	= sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved.', '1: Year, 2: Site Title with home URL', 'kids-education' ), date_i18n( 'Y', strtotime( date( 'Y' ) ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

	$kids_education_content['right']	= esc_attr( $theme_data->get( 'Name') ) . '&nbsp;' . __( 'by', 'kids-education' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_attr( $theme_data->get( 'Author' ) ) .'</a>';

	return apply_filters( 'kids_education_get_content', $kids_education_content );
}