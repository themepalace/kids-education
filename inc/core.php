<?php
/**
 * Core file.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

/**
 * Include options function.
 */
require get_template_directory() . '/inc/options.php';


// Load customizer defaults values
require get_template_directory() . '/inc/customizer/defaults.php';


/**
 * Merge values from default options array and values from customizer
 *
 * @return array Values returned from customizer
 * @since Kids Education 0.1
 */
function kids_education_get_theme_options() {
  $kids_education_default_options = kids_education_get_default_theme_options();

  return array_merge( $kids_education_default_options , get_theme_mod( 'kids_education_theme_options', $kids_education_default_options ) ) ;
}


/**
  * Write message for featured image upload
  *
  * @return array Values returned from customizer
  * @since Kids Education 0.1
*/
function kids_education_slider_image_instruction( $content, $post_id ) {
  $allowed = array( 'page', 'post' );
  if ( in_array( get_post_type( $post_id ), $allowed ) ) {
    return $content .= '<p><b>' . __( 'Note', 'kids-education' ) . ':</b>' . __( ' The recommended size for image is 1350px by 550px while using it for slider', 'kids-education' ) . '</p>';
  } elseif ( 'jetpack-testimonial' == get_post_type( $post_id ) ) {
    return $content .= '<p><b>' . __( 'Note', 'kids-education' ) . ':</b>' . __( ' The recommended size for image is 340px by 340px while using it for testimonial', 'kids-education' ) . '</p>';
  }
   return $content;
}
add_filter( 'admin_post_thumbnail_html', 'kids_education_slider_image_instruction', 10, 2);

/**
* Breadcrumbs
*/
require get_template_directory() . '/inc/breadcrumb-class.php';

/**
 * Add helper functions.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Add structural hooks.
 */
require get_template_directory() . '/inc/structure.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Modules additions.
 */
require get_template_directory() . '/inc/modules/modules.php';

/**
 * Custom widget additions.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
* TGM plugin additions.
*/
require get_template_directory() . '/inc/tgm-plugin/tgm-hook.php';

/**
* Woocommerce additions.
*/
require get_template_directory() . '/inc/woocommerce.php';

