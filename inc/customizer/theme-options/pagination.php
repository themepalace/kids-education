<?php
/**
* pagination options
*
* @package Theme Palace
* @subpackage Kids Education
* @since Kids Education 0.1
*/

// Add sidebar section
$wp_customize->add_section( 'kids_education_pagination', array(
	'title'               => __('Pagination','kids-education'),
	'description'         => __( 'Pagination section options.', 'kids-education' ),
	'panel'               => 'kids_education_theme_options_panel'
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[pagination_enable]', array(
	'sanitize_callback'   => 'kids_education_sanitize_checkbox',
	'default'             => $options['pagination_enable']
) );

$wp_customize->add_control( 'kids_education_theme_options[pagination_enable]', array(
	'label'               => __( 'Pagination Enable', 'kids-education' ),
	'section'             => 'kids_education_pagination',
	'type'                => 'checkbox',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'kids_education_sanitize_select',
	'default'             => $options['pagination_type']
) );

$wp_customize->add_control( 'kids_education_theme_options[pagination_type]', array(
	'label'               => __( 'Pagination Type', 'kids-education' ),
	'description'		  => __( 'Select pagination options', 'kids-education' ),
	'section'             => 'kids_education_pagination',
	'type'                => 'select',
	'choices'			  => kids_education_pagination_options(),
	'active_callback'	  => 'kids_education_is_pagination_enable'
) );
