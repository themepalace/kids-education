<?php
/**
 * The Home template file.
 *
 * This template file works when we select static frontpage as latest-posts and also 
 * for blog page.
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
    <div id="primary" class="content-area os-animation" data-os-animation="fadeIn">
      <main id="main" class="site-main">
        <nav class="portfolio-filter">
            <ul>
            <?php $categories_list = get_categories(); ?>
                <li class="active"><a href="#" data-filter="*"><?php _e('Filter all', 'kids-education'); ?></a></li>
                <?php foreach ( $categories_list as $key => $category) {
	            	echo '<li><a href="#" data-filter=".'. esc_attr( $category->slug ) .'">'. esc_html( $category->name ) .'</a></li>';
                }?>
            </ul>
        </nav><!-- .portfolio-filter -->

        <div id="two-column" class="blog-portfolio">
         <?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) : the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'blog' );

				endwhile;
           		wp_reset_postdata();

			else :

			get_template_part( 'template-parts/content', 'none' );

			endif; ?>
        </div><!-- end portfolio -->

       	<?php do_action( 'kids_education_action_pagination' ); ?>
      </main>
    </div><!-- #primary -->

<?php 
/**
 * kids_education_page_section_end hook
 *
 * @hooked kids_education_page_section_end -  10
 *
 */
do_action( 'kids_education_page_section_end' ); 

get_footer();



	