<?php 
/*
 * Template part for blog content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */
	$options       = kids_education_get_theme_options(); // get theme options 
	$categories    =  get_the_category( get_the_id() ); 
	$category_list = '';
	
	foreach ($categories as $key => $category) {
        $category_list .= $category->slug . ' ';
	}
?>
<article id="post-<?php the_ID(); ?>" class="blog-item has-post-thumbnail hentry <?php echo esc_attr( $category_list ); ?>">
    <div class="blog-post-wrap">
        <?php kids_education_get_thumbnail_image(); // get thumbnail image ?>

        <header class="entry-header">
          	<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

          <p class="entry-meta">
           	<?php kids_education_posted_on(); ?>
          </p><!-- .entry-meta -->
        </header><!-- .entry-header -->

	    <div class="entry-content">
	      	<p>
	      	<?php
				kids_education_custom_excerpt( 'kids_education_excerpt_length' );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kids-education' ),
					'after'  => '</div>',
				) );
			?>
			</p> 
	      	<?php if( !empty( $options['read_more_text'] ) ): ?>
          		<a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html(  $options['read_more_text'] ); ?></a>
          	<?php endif; ?>
	    </div><!-- .entry-content -->
	</div><!-- .blog-post-wrap -->
</article>