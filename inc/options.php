<?php
/**
 * Kids Education options
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

/**
 * Sidebar position
 * @return array Sidbar positions
 */
function kids_education_sidebar_position() {
  $kids_education_sidebar_position = array(
    'right-sidebar' => __( 'Right', 'kids-education' ),
    'no-sidebar'    => __( 'No Sidebar', 'kids-education' ),
  );

  $output = apply_filters( 'kids_education_sidebar_position', $kids_education_sidebar_position );

  return $output;
}

/**
 * Pagination
 * @return array site pagination options
 */
function kids_education_pagination_options() {
  $kids_education_pagination_options = array(
    'default'         => __( 'Default(Older/Newer)', 'kids-education' ),
    'numeric'         => __( 'Numeric', 'kids-education' ),
  );

  $output = apply_filters( 'kids_education_pagination_options', $kids_education_pagination_options );

  return $output;
}

/**
 * Slider
 * @return array slider options
 */
function kids_education_enable_disable_options() {
  $kids_education_enable_disable_options = array(
    'static-frontpage'  => __( 'Static Frontpage', 'kids-education' ),
    'disabled'          => __( 'Disabled', 'kids-education' ),
  );

  $output = apply_filters( 'kids_education_enable_disable_options', $kids_education_enable_disable_options );

  return $output;
}


/**
 * Returns list for recent section content type
 * @return array content type
 */
function kids_education_recent_content_type(){

    $choices        = array(
      'post'        => __( 'Post', 'kids-education' ),
    );
    $custom_choices = array();
    if ( class_exists( 'TP_Education' ) ) {
      $custom_choices = array(
        'class'       => __( 'Class', 'kids-education' ),
        'course'      => __( 'Course', 'kids-education' ),
        'event'       => __( 'Event', 'kids-education' ),
        'excursion'   => __( 'Excursion', 'kids-education' ),
      );
    }
    $choices = array_merge( $choices, $custom_choices );
    $output = apply_filters( 'kids_education_recent_content_type', $choices );
    if ( ! empty( $output ) ) {
      ksort( $output );
    }
    return $output;

}
