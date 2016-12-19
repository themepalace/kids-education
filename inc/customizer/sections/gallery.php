<?php
/**
 * Gallery Customizer options
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

// Add gallery enable section
$wp_customize->add_section( 'kids_education_gallery_section', array(
	'title'             => __('Gallery','kids-education'),
	'panel'             => 'kids_education_sections_panel'
) );

// Add gallery enable setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[gallery_enable]', array(
	'default'           => $options['gallery_enable'],
	'sanitize_callback' => 'kids_education_sanitize_select'
) );

$wp_customize->add_control( 'kids_education_theme_options[gallery_enable]', array(
	'label'             => __( 'Enable on', 'kids-education' ),
	'section'           => 'kids_education_gallery_section',
	'type'              => 'select',
	'choices'           => kids_education_enable_disable_options()
) );

// Add photo gallery source
$wp_customize->add_setting( 'kids_education_theme_options[gallery_source]', array(
	'default'           => $options['gallery_source'],
	'sanitize_callback' => 'kids_education_sanitize_select'
) );

$wp_customize->add_control( 'kids_education_theme_options[gallery_source]', array(
	'label'             => __( 'Gallery Source', 'kids-education' ),
	'section'           => 'kids_education_gallery_section',
	'type'              => 'select',
	'choices'           => array(
		'category'		=> __( 'Category', 'kids-education' )
	),
	'active_callback' => 'kids_education_is_gallery_active', 
) );


// Add gallery title setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[gallery_title]', array(
	'default'           => $options['gallery_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'kids_education_theme_options[gallery_title]', array(
	'label'           => __( 'Title', 'kids-education' ),
	'section'         => 'kids_education_gallery_section',
	'type'            => 'text',
	'active_callback' => 'kids_education_is_gallery_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'kids_education_theme_options[gallery_title]', array(
		'selector'            => '#portfolio-gallery h2.entry-title',
		'render_callback'     => 'kids_education_customize_partial_gallery_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// no of images in gallery.
$wp_customize->add_setting( 'kids_education_theme_options[gallery_no_of_img]', array(
	'default'           => $options['gallery_no_of_img'],
	'sanitize_callback' => 'kids_education_sanitize_number_range',
	'validate_callback' => 'kids_education_validate_no_of_gallery'
) );

$wp_customize->add_control( 'kids_education_theme_options[gallery_no_of_img]', array(
	'label'             => __( 'No of Images', 'kids-education' ),
	'section'           => 'kids_education_gallery_section',
	'type'              => 'number',
	'input_attrs'		=> array(
		'min'          	=> 1,
		'max' 			=> 12,
		'style'        	=> 'width: 80px;'
	),
	'active_callback' 	=> 'kids_education_is_gallery_active', 
) );

// Add gallery content type setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[gallery_category]', array(
	'sanitize_callback' => 'kids_education_sanitize_category_list'
) );

$wp_customize->add_control( new kids_education_Dropdown_Category_Control( $wp_customize, 'kids_education_theme_options[gallery_category]', array(
	'label'           => __( 'Select categories', 'kids-education' ),
	'section'         => 'kids_education_gallery_section',
	'type'            => 'dropdown-categories',
	'active_callback' => 'kids_education_is_gallery_active', 
) ) );

// Load more text 
$wp_customize->add_setting( 'kids_education_theme_options[gallery_page_readmore]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'         	=> $options['gallery_page_readmore'],
) );

$wp_customize->add_control( 'kids_education_theme_options[gallery_page_readmore]', array(
	'label'           => __( 'Read more', 'kids-education' ),
	'description'	  => __( 'Leave empty to hide readmore button', 'kids-education' ),
	'section'         => 'kids_education_gallery_section',
	'active_callback' => 'kids_education_is_gallery_active', 
) );

// page link
$wp_customize->add_setting( 'kids_education_theme_options[gallery_page_link]', array(
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'kids_education_theme_options[gallery_page_link]', array(
	'label'           => __( 'Link Gallery Page', 'kids-education' ),
	'section'         => 'kids_education_gallery_section',
	'type'            => 'dropdown-pages',
	'active_callback' => 'kids_education_is_gallery_active', 
) );
