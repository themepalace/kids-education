
<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

/**
* kids_education_primary_content_footer hook
*
* @hooked kids_education_add_category_blog_section - 10
*
*/
do_action( 'kids_education_primary_content_footer' );

/**
 * kids_education_content_end_action hook
 *
 * @hooked kids_education_content_end -  10
 *
 */
do_action( 'kids_education_content_end_action' );

/**
 * kids_education_footer_divider hook
 *
 * @hooked kids_education_get_footer_divider -  10
 *
 */
do_action( 'kids_education_footer_divider' );

/**
 * kids_education_footer_content hook
 *
 * @hooked kids_education_footer_section -  10
 *
 */
do_action( 'kids_education_footer_content' );

/**
 * kids_education_page_end_action hook
 *
 * @hooked kids_education_page_end -  10
 *
 */
do_action( 'kids_education_page_end_action' ); 
?>

<?php wp_footer(); ?>

</body>
</html>
