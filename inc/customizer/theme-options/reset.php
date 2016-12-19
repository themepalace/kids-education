<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'kids_education_reset_section', array(
	'title'             => __('Reset all settings','kids-education'),
	'description'       => __( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'kids-education' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'kids_education_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'kids_education_sanitize_checkbox',
	'transport'			  => 'postMessage'
) );

$wp_customize->add_control( 'kids_education_theme_options[reset_options]', array(
	'label'             => __( 'Check to reset all settings', 'kids-education' ),
	'section'           => 'kids_education_reset_section',
	'type'              => 'checkbox',
) );