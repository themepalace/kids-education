<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */
get_header();
if ( true === apply_filters( 'kids_education_filter_frontpage_content_enable', true ) ) : 

	/**
	 * kids_education_page_section hook
	 *
	 * @hooked kids_education_page_section -  10
	 *
	 */
	do_action( 'kids_education_page_section' ); 
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
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

endif;
get_footer();
