<?php
/**
* Custom css
*
* @package Theme Palace
* @subpackage Kids Education
* @since Kids Education 1.0
*/

// custom css section
$wp_customize->add_section( 'kids_education_custom_css', array(
	'title'             	=> __('Custom CSS','kids-education'),
	'panel'             	=> 'kids_education_theme_options_panel',
	'priority'   			=> 900,
) );

// Setting custom_css.
$wp_customize->add_setting( 'kids_education_theme_options[custom_css]',
	array(
	'sanitize_callback'    	=> 'wp_strip_all_tags',
	'sanitize_js_callback' 	=> 'wp_strip_all_tags',
	)
);
$wp_customize->add_control( 'kids_education_theme_options[custom_css]',
	array(
	'label'    				=> __( 'Custom CSS', 'kids-education' ),
	'section'  				=> 'kids_education_custom_css',
	'type'     				=> 'textarea',
	)
);
