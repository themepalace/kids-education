<?php
/**
 * Footer Navigation
 *
 * This is the template for all registered menus
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

if ( ! function_exists( 'kids_education_footer_section' ) ) :
	/**
	 * Add primary menu
	 *
	 * @since  Kids Education 1.0
	 *
	 */
	function kids_education_footer_section() {
    $options = kids_education_get_theme_options(); // Get theme options 
		?>
		<footer id="colophon" class="site-footer os-animation" data-os-animation="fadeIn">
        <?php  if( is_active_sidebar( 'sidebar-footer' ) ): ?>
            <div class="container">
                <?php  dynamic_sidebar( 'sidebar-footer' ); ?>
            </div><!-- .container -->
        <?php endif; ?>

            <div class="spacer"></div>

            <div class="bottom-footer two-columns">
                <div class="container">
                    <?php if( has_nav_menu( 'footer-menu' ) ):
                    $footer_menu_args = array(
                      'theme_location' => 'footer-menu', 
                      'menu_id'        => '', 
                      'menu_class'     => '',
                      'container'      => 'div',
                      'container_class' => 'column-wrapper',
                    );
                    wp_nav_menu( $footer_menu_args );
                    endif;
                    ?>
                    <div class="column-wrapper">
                        <div class="site-info text-right">
                        <?php
                            $kids_education_footer_site_info = kids_education_get_content();
                            echo $kids_education_footer_site_info['left'] . ' &#124; ' .  $kids_education_footer_site_info['right'];
                        ?>
                        </div><!-- .site-info -->
                    </div><!-- .column-wrapper -->
                </div><!-- .container -->
            </div><!-- .bottom-footer -->
        </footer><!-- .site-footer -->
        <div class="backtotop"><i class="fa fa-angle-up"></i></div><!--end .backtotop-->
    <?php }
endif;
add_action( 'kids_education_footer_content', 'kids_education_footer_section', 10 );