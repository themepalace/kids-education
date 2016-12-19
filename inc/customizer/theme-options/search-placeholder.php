<?php
/**
 * Search text options
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since kids_education 0.1
 */

// Add Search text section
$wp_customize->add_section( 'kids_education_search_section', array(
	'title'             => __('Search Options','kids-education'),
	'description'       => __( 'Search section options.', 'kids-education' ),
	'panel'             => 'kids_education_theme_options_panel'
) );

// Search text setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[search_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['search_text']
) );

$wp_customize->add_control( 'kids_education_theme_options[search_text]', array(
	'label'       		=> __( 'Search Text.', 'kids-education' ),
	'description'		=> __( 'Placeholder for search form.', 'kids-education' ),
	'section'     		=> 'kids_education_search_section',
	'type'        		=> 'text',
) );