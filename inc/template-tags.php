<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

if ( ! function_exists( 'kids_education_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function kids_education_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<span  class="screen-reader-text">'. __( 'Posted on', 'kids-education' ) .'</span>
					<a href="' . esc_url( get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) ) . '" rel="bookmark">' . $time_string . '</a>';

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	if( function_exists( 'tp_education_like_button' ) ){
		$like_string = tp_education_like_button();
		$like_string = '<span class="screen-reader-text">' . __( 'Likes', 'kids-education' ) . '</span>' . $like_string;
		echo wp_kses_post( $like_string );
	}

    $no_of_comment = get_comments_number(); // get no of comments in a post

    $comment_number = sprintf( '<span class="screen-reader-text">'. __( 'Comments', 'kids-education' ) .'</span>
                        <span class="comments-number">%s</span>', absint( $no_of_comment ) );

    echo '<span class="comments-links">'. $comment_number .'</span>';

}
endif;

if ( ! function_exists( 'kids_education_entry_footer' ) ) :
/**
 * Prints HTML page edit link.
 */
function kids_education_entry_footer() {
	
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'kids-education' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'kids_education_tags_list' ) ) :
/**
 * Prints tags assisgned to a post.
 */
function kids_education_tags_list() {
	$tags_list = get_the_tag_list( '', esc_html__( ', ', 'kids-education' ) ); //get tags lists

	if( !empty( $tags_list ) ){
		echo '<div class="tag-list">
		  		<span class="screen-reader-text">'. __( 'Tagged', 'kids-education') .' </span>';

		printf( '<span class="tags-links">Tags: ' . esc_html__( '%1$s', 'kids-education' ) . '</span>', $tags_list );
		echo '</div>';
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function kids_education_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'kids_education_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'kids_education_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so kids_education_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so kids_education_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in kids_education_categorized_blog.
 */
function kids_education_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'kids_education_categories' );
}
add_action( 'edit_category', 'kids_education_category_transient_flusher' );
add_action( 'save_post',     'kids_education_category_transient_flusher' );

