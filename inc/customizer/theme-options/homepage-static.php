<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage Kids Education
* @since Kids Education 0.1
*/

/*Homepage content option*/
$wp_customize->add_section( 'kids_education_static_homepage',
	array(
		'title'      			=> __( 'Static Homepage', 'kids-education' ),
		'priority'   			=> 900,
		'panel'      			=> 'kids_education_theme_options_panel',
	)
);

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'kids_education_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content']
) );

$wp_customize->add_control( 'kids_education_theme_options[enable_frontpage_content]', array(
	'label'       => __( 'Enable Content', 'kids-education' ),
	'description' => __( 'Check to enable content on static front page only.', 'kids-education' ),
	'section'     => 'kids_education_static_homepage',
	'type'        => 'checkbox'
) );