<?php
/**
 * Features Customizer options
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */


// Add features enable section
$wp_customize->add_section( 'kids_education_features_section', array(
	'title'             => __('Features','kids-education'),
	'description'       => __( 'Features section options. Max no of features is 4.', 'kids-education' ),
	'panel'             => 'kids_education_sections_panel'
) );

// Add features enable setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[features_enable]', array(
	'default'           => $options['features_enable'],
	'sanitize_callback' => 'kids_education_sanitize_select'
) );

$wp_customize->add_control( 'kids_education_theme_options[features_enable]', array(
	'label'             => __( 'Enable on', 'kids-education' ),
	'section'           => 'kids_education_features_section',
	'type'              => 'select',
	'choices'           => kids_education_enable_disable_options()
) );

// Show features section title setting and control
$wp_customize->add_setting( 'kids_education_theme_options[features_section_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'           => $options['features_section_title'],
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( 'kids_education_theme_options[features_section_title]', array(
	'label'           => __( 'Section Title', 'kids-education' ),
	'section'         => 'kids_education_features_section',
	'active_callback' => 'kids_education_is_features_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'kids_education_theme_options[features_section_title]', array(
		'selector'            => '#features h2.entry-title',
		'render_callback'     => 'kids_education_customize_partial_features_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// Add features content type setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[features_section_type]', array(
	'default'           => $options['features_section_type'],
	'sanitize_callback' => 'kids_education_sanitize_select'
) );

$wp_customize->add_control( 'kids_education_theme_options[features_section_type]', array(
	'label'           	=> __( 'Content Type', 'kids-education' ),
	'section'         	=> 'kids_education_features_section',
	'type'            	=> 'select',
	'active_callback' 	=> 'kids_education_is_features_active',
	'choices'         	=> array(
		'category'		=> __( 'Category', 'kids-education'),
	)
) );

for ( $i=1; $i <= 4; $i++ ) {
	// Show features icon setting and control
	$wp_customize->add_setting( 'kids_education_theme_options[features_icon_'.$i.']', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'kids_education_theme_options[features_icon_'.$i.']', array(
		'label'           => sprintf( __( 'Icon #%s', 'kids-education' ), $i ),
		'section'         => 'kids_education_features_section',
		'active_callback' => 'kids_education_is_features_active',
		'type'            => 'text',
		'input_attrs'     => array( 'placeholder'		=> 'fa-archive' )
	) );

	// Show hr line setting and control
	$wp_customize->add_setting( 'kids_education_theme_options[features_page_hr_'.$i.']', array(
		'sanitize_callback' => 'kids_education_sanitize_number_range'
	) );

	$wp_customize->add_control( new kids_education_Customize_Horizontal_Line ( $wp_customize, 'kids_education_theme_options[features_page_hr_'.$i.']', array(
		'section'         => 'kids_education_features_section',
		'active_callback' => 'kids_education_is_features_active',
		'type'            => 'hr',
	) ) );
}

// Add features section category drop-down setting and control
$wp_customize->add_setting( 'kids_education_theme_options[features_dropdown_categories]', array(
	'default'			=> $options['features_dropdown_categories'],			
	'sanitize_callback'	=> 'kids_education_sanitize_category_list',
) );

$wp_customize->add_control( new kids_education_Dropdown_Category_Control( $wp_customize, 'kids_education_theme_options[features_dropdown_categories]', array(
	'active_callback' 	=> 'kids_education_is_features_active',
	'label'           	=> __('Select Category', 'kids-education' ),
	'section'         	=> 'kids_education_features_section',
	'type'            	=> 'dropdown-category',
 ) ) );
