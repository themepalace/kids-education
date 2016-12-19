<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-post-wrap">
		<?php kids_education_get_thumbnail_image(); // get thumbnail images ?>
		<header class="entry-header">
			<?php
			if ( 'post' === get_post_type() ) : ?>
			<p class="entry-meta">
				<?php 
					kids_education_posted_on();
					kids_education_tags_list(); 
				?>
			</p><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'kids-education' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kids-education' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php
			/**
			 * Hook kids_education_author_profile
			 *  
			 * @hooked kids_education_get_author_profile 
			 */
			 do_action( 'kids_education_author_profile' );
		?>
		<footer class="entry-footer">
			<?php kids_education_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .blog-post-wrap -->
</article><!-- #post-## -->
