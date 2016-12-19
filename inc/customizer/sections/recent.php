<?php
/**
 * Kids Education Recent Customizer options
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */


// Add recent enable section
$wp_customize->add_section( 'kids_education_recent', array(
	'title'             => __('Recent','kids-education'),
	'description'       => __( 'Recent section options.', 'kids-education' ),
	'panel'             => 'kids_education_sections_panel'
) );

// Add recent enable setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[recent_enable]', array(
	'default'           => $options['recent_enable'],
	'sanitize_callback' => 'kids_education_sanitize_select'
) );

$wp_customize->add_control( 'kids_education_theme_options[recent_enable]', array(
	'label'             => __( 'Enable on', 'kids-education' ),
	'section'           => 'kids_education_recent',
	'type'              => 'select',
	'choices'           => kids_education_enable_disable_options()
) );

// Add recent title setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[recent_title]', array(
	'default'           => $options['recent_title'],
	'transport'         => 'postMessage',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'kids_education_theme_options[recent_title]', array(
	'label'             => __( 'Title', 'kids-education' ),
	'section'           => 'kids_education_recent',
	'type'              => 'text',
	'active_callback'	=> 'kids_education_is_recent_section_active',
) );


// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'kids_education_theme_options[recent_title]', array(
		'selector'            => '#recent-classes-slider h2.entry-title',
		'render_callback'     => 'kids_education_customize_partial_recent_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// Add no of recent content type setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[recent_content_type]', array(
	'default'           => $options['recent_content_type'],
	'sanitize_callback' => 'kids_education_sanitize_select',
) );

$wp_customize->add_control( 'kids_education_theme_options[recent_content_type]', array(
	'label'             => __( 'Content Type', 'kids-education' ),
	'section'           => 'kids_education_recent',
	'type'              => 'select',
	'choices'			=> kids_education_recent_content_type(),
	'active_callback'	=> 'kids_education_is_recent_section_active',
) );

// Add layout option setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[recent_visible_no_of_slides]', array(
	'default'           => $options['recent_visible_no_of_slides'],
	'sanitize_callback' => 'kids_education_sanitize_select',
) );

$wp_customize->add_control( 'kids_education_theme_options[recent_visible_no_of_slides]', array(
	'label'             => __( 'No of visible slides', 'kids-education' ),
	'section'           => 'kids_education_recent',
	'type'              => 'select',
	'choices'		=> array (
		'3'			=> __( 'Three', 'kids-education'),
		'4'			=> __( 'Four', 'kids-education' )
	),
	'active_callback'	=> 'kids_education_is_recent_section_active',
) );

// Add no of recent content setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[recent_count]', array(
	'default'           => $options['recent_count'],
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'kids_education_theme_options[recent_count]', array(
	'label'             => __( 'No of content', 'kids-education' ),
	'section'           => 'kids_education_recent',
	'type'              => 'number',
	'input_attrs'		=> array (
		'min'	=> 3,
		'max'	=> 9,
		'style'	=> 'width:100px'
		),
	'active_callback'	=> 'kids_education_is_recent_section_active',
) );
