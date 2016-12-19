<?php
/**
* Customizer validation functions
*
* @package Theme Palace
* @subpackage Kids Education
* @since Kids Education 0.1
*/

function kids_education_validate_long_excerpt( $validity, $value ){
       $value = intval( $value );
   if ( empty( $value ) || ! is_numeric( $value ) ) {
       $validity->add( 'required', __( 'You must supply a valid number.', 'kids-education' ) );
   } elseif ( $value < 5 ) {
       $validity->add( 'min_no_of_words', __( 'Minimum no of words is 5', 'kids-education' ) );
   } elseif ( $value > 100 ) {
       $validity->add( 'max_no_of_words', __( 'Maximum no of words is 100', 'kids-education' ) );
   }
   return $validity;
}

function kids_education_validate_short_excerpt( $validity, $value ){
       $value = intval( $value );
   if ( empty( $value ) || ! is_numeric( $value ) ) {
       $validity->add( 'required', __( 'You must supply a valid number.', 'kids-education' ) );
   } elseif ( $value < 5 ) {
       $validity->add( 'min_no_of_words', __( 'Minimum no of words is 5', 'kids-education' ) );
   } elseif ( $value > 25 ) {
       $validity->add( 'max_no_of_words', __( 'Maximum no of words is 25', 'kids-education' ) );
   }
   return $validity;
}
