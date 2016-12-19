<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
		if ( have_posts() ) : ?>
			<div id="two-column" class="two-columns archive">
			<?php
			/* Start the Loop */
			$count = 1;
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

				if( $count % 2 == 0 )
				echo '<div class="clear"></div>';
			$count++;

			endwhile; 
			?>
			</div><!-- .archive -->
			<?php 
			/**
			* Hook - kids_education_action_pagination.
			*
			* @hooked kids_education_pagination 
			*/
			do_action( 'kids_education_action_pagination' );
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; 
		
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
