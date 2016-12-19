<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @@package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 * 
 */

get_header(); ?>
    <section class="error-404 not-found os-animation">
        <header class="page-header os-animation" data-os-animation="fadeInUp">
         	<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'kids-education' ); ?></h1>
        </header><!-- .page-header -->

        <div class="page-content os-animation" data-os-animation="fadeInUp">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/uploads/error404.png" alt="<?php _e( 'Oops! That page can not be found.', 'kids-education' ); ?>">
          <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'kids-education' ); ?></p>

         <?php get_search_form(); ?>
          <a href="<?php echo esc_url( home_url('/' ) ); ?>" class="btn btn-blue"><?php _e( 'Back to Homepage!', 'kids-education' ); ?></a>
        </div><!-- .page-content -->
     </section>

<?php
get_footer();