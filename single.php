<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

get_header(); 

/**
 * kids_education_page_section hook
 *
 * @hooked kids_education_page_section -  10
 *
 */
do_action( 'kids_education_page_section' ); ?>

<div id="primary" class="content-area os-animation animated fadeIn" data-os-animation="fadeIn">
	<main id="main" class="site-main" role="main">

	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'single' );

		/**
		 * Hook kids_education_related_posts
		 *  
		 * @hooked kids_education_get_related_posts 
		 */
		do_action( 'kids_education_related_posts' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	/**
	 * Hook kids_education_action_post_pagination
	 *  
	 * @hooked kids_education_post_pagination 
	 */
	do_action( 'kids_education_action_post_pagination' );
	?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_sidebar();

/**
 * kids_education_page_section_end hook
 *
 * @hooked kids_education_page_section_end -  10
 *
 */
do_action( 'kids_education_page_section_end' ); 
get_footer();
