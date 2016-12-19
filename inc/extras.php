<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kids_education_body_classes( $classes ) {
	$options = kids_education_get_theme_options();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if( is_home() || is_404() ){
		$classes[] = 'no-sidebar';
	}
	elseif ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'right-sidebar';
	} else {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'kids_education_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function kids_education_single_page_class( $classes ) {
    global $post;
    if( is_archive() || is_search() ){
        $classes[] = 'column-wrapper';
    }
    if( is_home() ){
    	 $classes[] = 'blog-item';
    }
    return $classes;
}
add_filter( 'post_class', 'kids_education_single_page_class' );
