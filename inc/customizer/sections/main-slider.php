<?php
/**
 * Main Slider Customizer options
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */


// Add Main Slider enable section
$wp_customize->add_section( 'kids_education_main_slider_section', array(
	'title'             => __('Main Slider','kids-education'),
	'description'       => __( 'Main Slider section options. Recommended image size for slider is 1350px by 550px', 'kids-education' ),
	'priority'			=> '10',
	'panel'             => 'kids_education_sections_panel'
) );

// Add Main Slider enable setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[enable_main_slider]', array(
	'default'           => $options['enable_main_slider'],
	'sanitize_callback' => 'kids_education_sanitize_select'
) );

$wp_customize->add_control( 'kids_education_theme_options[enable_main_slider]', array(
	'label'             => __( 'Check To Enable', 'kids-education' ),
	'section'           => 'kids_education_main_slider_section',
	'type'              => 'select',
	'choices'			=> kids_education_enable_disable_options(),
) );

// Add Main Slider content type setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[main_slider_type]', array(
	'default'           => $options['main_slider_type'],
	'sanitize_callback' => 'kids_education_sanitize_select'
) );

$wp_customize->add_control( 'kids_education_theme_options[main_slider_type]', array(
	'label'           	=> __( 'Content Type', 'kids-education' ),
	'section'         	=> 'kids_education_main_slider_section',
	'type'            	=> 'select',
	'active_callback' 	=> 'kids_education_is_main_slider_active',
	'choices'         	=> array(
		'page'			=> __( 'Page', 'kids-education')	
	)
) );

// Add Main Slider number of posts setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[main_slider_no_of_posts]', array(
	'default'           => $options['main_slider_no_of_posts'],
	'validate_callback' => 'kids_education_validate_no_of_main_slider',
	'sanitize_callback' => 'kids_education_sanitize_number_range'
) );

$wp_customize->add_control( 'kids_education_theme_options[main_slider_no_of_posts]', array(
	'label'           	=> __( 'Number Of Main Slider', 'kids-education' ),
	'description'       => __( 'Notice: Please refresh after the number of slides is set to see the effects.', 'kids-education' ),
	'section'         	=> 'kids_education_main_slider_section',
	'type'            	=> 'number',
	'active_callback' 	=> 'kids_education_is_main_slider_active',
	'input_attrs'		=> array(
		'min'			=> '2',
		'max'			=> '5',
		'step'			=> '1',
		'style'			=> 'width:50px',
		),
) );

$no_of_post = $options['main_slider_no_of_posts'];

for ( $i = 1; $i <= $no_of_post; $i++ ) {
	// Select main slider page
	$wp_customize->add_setting( 'kids_education_theme_options[page_id_' . $i . ']', array(
		'sanitize_callback' => 'kids_education_sanitize_page'
	) );

	$wp_customize->add_control( 'kids_education_theme_options[page_id_' . $i . ']', array(
		'label'             => __( 'Select Page # ' , 'kids-education' ) . $i,
		'section'           => 'kids_education_main_slider_section',
		'active_callback'	=> 'kids_education_is_main_slider_active',
		'type'              => 'dropdown-pages',
	) );
}

// Add learn more text setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[main_slider_learn_more_text]', array(
	'default'           => $options['main_slider_learn_more_text'],
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'kids_education_theme_options[main_slider_learn_more_text]', array(
	'label'           	=> __( 'Learn More Text', 'kids-education' ),
	'description'		=> __( 'Leave empty to hide button', 'kids-education' ),
	'section'         	=> 'kids_education_main_slider_section',
	'active_callback' 	=> 'kids_education_is_main_slider_active',
));