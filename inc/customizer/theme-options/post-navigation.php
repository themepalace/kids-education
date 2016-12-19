<?php
/**
* post navigation options
*
* @package Theme Palace
* @subpackage Kids Education
* @since Kids Education 0.1
*/

// Add post navigation section
$wp_customize->add_section( 'kids_education_post_navigation', array(
	'title'               => __('Post Navigation','kids-education'),
	'description'         => __( 'Post navigation section options.', 'kids-education' ),
	'panel'               => 'kids_education_theme_options_panel'
) );

// Post navigation enable setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[post_navigation_enable]', array(
	'sanitize_callback'   => 'kids_education_sanitize_checkbox',
	'default'             => $options['post_navigation_enable']
) );

$wp_customize->add_control( 'kids_education_theme_options[post_navigation_enable]', array(
	'label'               => __( 'Post Navigation Enable', 'kids-education' ),
	'section'             => 'kids_education_post_navigation',
	'type'                => 'checkbox',
) );

// Post navigation title setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[post_navigation_type]', array(
	'sanitize_callback'   => 'kids_education_sanitize_select',
	'default'             => $options['post_navigation_type']
) );

$wp_customize->add_control( 'kids_education_theme_options[post_navigation_type]', array(
	'label'               => __( 'Post Navigation Type', 'kids-education' ),
	'section'             => 'kids_education_post_navigation',
	'type'				  => 'select', 
	'active_callback'	  => 'kids_education_enable_post_navigation',
	'choices'			  => array(
		'default'    => __( 'Default', 'kids-education' ),
		'post_title' => __( 'Post Title', 'kids-education' )
	)
) );