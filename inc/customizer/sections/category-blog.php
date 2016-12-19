<?php
/**
 * Kids Education Category Blog Customizer options
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */


// Add category blog enable section
$wp_customize->add_section( 'kids_education_category_blog_section', array(
	'title'             => __('Category Blog','kids-education'),
	'description'       => __( 'Category Blog section options.', 'kids-education' ),
	'panel'             => 'kids_education_sections_panel'
) );

// Add category blog enable setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[category_blog_enable]', array(
	'default'           => $options['category_blog_enable'],
	'sanitize_callback' => 'kids_education_sanitize_select'
) );

$wp_customize->add_control( 'kids_education_theme_options[category_blog_enable]', array(
	'label'             => __( 'Enable on', 'kids-education' ),
	'section'           => 'kids_education_category_blog_section',
	'type'              => 'select',
	'choices'           => kids_education_enable_disable_options()
) );

// Add category blog content type setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[category_blog_content_type]', array(
	'default'           => $options['category_blog_content_type'],
	'sanitize_callback' => 'kids_education_sanitize_select'
) );

$wp_customize->add_control( 'kids_education_theme_options[category_blog_content_type]', array(
	'label'           	=> __( 'Content Type', 'kids-education' ),
	'section'         	=> 'kids_education_category_blog_section',
	'type'            	=> 'select',
	'active_callback' 	=> 'kids_education_is_category_blog_section_active',
	'choices'         	=> array(
		'category'    	=> __( 'Category', 'kids-education' )
	)
) );


// Add category blog title setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[category_blog_title]', array(
	'default'           => $options['category_blog_title'],
	'transport'         => 'postMessage',
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'kids_education_theme_options[category_blog_title]', array(
	'label'           	=> __( 'Title', 'kids-education' ),
	'section'         	=> 'kids_education_category_blog_section',
	'type'            	=> 'text',
	'active_callback' 	=> 'kids_education_is_category_blog_section_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'kids_education_theme_options[category_blog_title]', array(
		'selector'            => '#blog h2.entry-title',
		'render_callback'     => 'kids_education_customize_partial_category_blog_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
	) );
}

// Add category blog number setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[category_blog_count]', array(
	'default'           => $options['category_blog_count'],
	'sanitize_callback' => 'kids_education_sanitize_number_range',
	'validate_callback' => 'kids_education_validate_no_of_blog'
) );

$wp_customize->add_control( 'kids_education_theme_options[category_blog_count]', array(
	'label'           => __( 'Number of posts.', 'kids-education' ),
	'description'     => __( 'Notice: Please refresh after the number of slides is set to see the effects.', 'kids-education' ),
	'section'         => 'kids_education_category_blog_section',
	'type'            => 'number',
	'active_callback' => 'kids_education_is_category_blog_section_active',
	'input_attrs'     => array(
		'max' 		  => 6,
		'min' 		  => 1
	)
) );

/**
 * Content type: Catgory
*/

// Show category type setting and control
$wp_customize->add_setting( 'kids_education_theme_options[category_blog_content_category]', array(
	'sanitize_callback' => 'kids_education_sanitize_category_list'
) );

$wp_customize->add_control( new kids_education_Dropdown_Category_Control( $wp_customize, 'kids_education_theme_options[category_blog_content_category]', array(
	'label'           => __( 'Category', 'kids-education' ),
	'description'     => __( 'Select the category of posts to be shown.', 'kids-education' ),
	'section'         => 'kids_education_category_blog_section',
	'active_callback' => 'kids_education_is_category_blog_section_active',
) ) );