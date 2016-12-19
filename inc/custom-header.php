<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

/**
 * Set up the WordPress core custom header feature.
 *
 */
function kids_education_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'kids_education_custom_header_args', array(
		'default-image'          => get_template_directory_uri() .'/assets/uploads/banner-01.jpg',
		'default-text-color'     => '66993E',
		'width'                  => 1000,
		'height'                 => 750,
		'flex-height'            => true
	) ) );
}
add_action( 'after_setup_theme', 'kids_education_custom_header_setup' );

if( !function_exists( 'kids_education_render_banner_section' ) ) :
	/**
	 * Hook to display banner section
	 *
	 * @since Kids Education 0.1
	 */
	function kids_education_render_banner_section() {
		global $wp_query, $post;
		
		$options = kids_education_get_theme_options(); // get theme options 	

		// Get front page ID
		$page_on_front	  = get_option('page_on_front');
		$page_for_posts   = get_option('page_for_posts');
		// Get Page ID outside Loop
		$page_id          = $wp_query->get_queried_object_id( $post );

		if( ( !is_home() && $page_on_front == $page_id ) || is_404() ) {
			return;
		}else {
			/**
			 * Filter the default twentysixteen custom header sizes attribute.
			 *
			 * @since Kids Education 0.1
			 *
			 */
			$header_image = get_header_image();

			$banner_image_class = ( '' != $header_image ) ? 'has-banner-image' : 'no-banner-image';
		}
	?>
	<section id="header-image" class="<?php echo esc_attr( $banner_image_class );?>">
			<?php if ( $header_image ) : ?>
				<img src="<?php echo $header_image; ?>" alt="<?php _e( 'banner-image', 'kids-education' ); ?>">
     	<div class="black-overlay"></div>
			<?php endif; // End header image check. ?>
      	<div class="container">
        	<div class="banner-wrapper">
          		<div class="page-title os-animation" data-os-animation="fadeInUp">
            		<header class="entry-header">
              		<h2 class="entry-title"><?php
	              	if ( is_home() && ! is_front_page() ) :
	              		single_post_title();

	              	elseif( is_singular() ) :
	              		single_post_title();

	              	elseif( is_home() ):
	              		esc_html_e( 'Latest blog', 'kids-education');

	              	elseif( is_search() ) :
	              		printf( esc_html__( 'Search Results for: %s', 'kids-education' ), '<span>' . esc_html( get_search_query() ). '</span>' );

	              	elseif( is_404() ) :
	              		esc_html_e( 'Oops! That page can&rsquo;t be found.', 'kids-education' );

	              	elseif( class_exists( 'WooCommerce' ) && is_shop() ):
						$shop_page_id = get_option( 'woocommerce_shop_page_id' );
						if( '' != $shop_page_id ){
							echo esc_html( get_the_title ( $shop_page_id ) );
						} else {
							esc_html_e( 'Shop', 'kids-education' );
						}

		            else:
		            	the_archive_title();
					endif; ?>
					</h2>
            		</header>
          		</div><!-- end .page-title -->

          	<?php do_action( 'kids_education_add_breadcrumb' ); // add breadcrum options ?>

        </div><!-- end .container -->
      </div><!-- end .banner-wrapper -->
    </section><!-- .banner-image -->
	
	<?php
	}
endif;
add_action( 'kids_education_header_action', 'kids_education_render_banner_section', 20 );