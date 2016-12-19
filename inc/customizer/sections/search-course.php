<?php
/**
 * Kids Education Search Course Customizer options
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */


// Add search enable section
$wp_customize->add_section( 'kids_education_search', array(
	'title'             => __('Search Section','kids-education'),
	'description'       => __( 'Search Seaction section options.', 'kids-education' ),
	'panel'             => 'kids_education_sections_panel'
) );

if ( class_exists( 'TP_Education' ) ) :
	// Add search enable setting and control.
	$wp_customize->add_setting( 'kids_education_theme_options[search_course_enable]', array(
		'default'           => $options['search_course_enable'],
		'sanitize_callback' => 'kids_education_sanitize_select'
	) );

	$wp_customize->add_control( 'kids_education_theme_options[search_course_enable]', array(
		'label'             => __( 'Enable on', 'kids-education' ),
		'section'           => 'kids_education_search',
		'type'              => 'select',
		'choices'           => kids_education_enable_disable_options()
	) );
endif;