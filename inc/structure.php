<?php
/**
 * Kids Educationbasic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

$options = kids_education_get_theme_options();


if ( ! function_exists( 'kids_education_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Kids Education 0.1
	 */
	function kids_education_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'kids_education_doctype', 'kids_education_doctype', 10 );


if ( ! function_exists( 'kids_education_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Kids Education 0.1
	 *
	 */
	function kids_education_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'kids_education_before_wp_head', 'kids_education_head', 10 );

if ( ! function_exists( 'kids_education_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Kids Education 0.1
	 *
	 */
	function kids_education_page_start() {
		?>
		<div id="page" class="site">
			<div class="site-inner">
				<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'kids-education' ); ?></a>

		<?php
	}
endif;

add_action( 'kids_education_page_start_action', 'kids_education_page_start', 10 );

if ( ! function_exists( 'kids_education_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since Kids Education 0.1
	 *
	 */
	function kids_education_page_end() {
		?>
			</div><!-- .site-inner -->
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'kids_education_page_end_action', 'kids_education_page_end', 10 );

if ( ! function_exists( 'kids_education_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Kids Education 0.1
	 *
	 */
	function kids_education_content_start() {
		if( is_front_page() && !is_home() ){
			$content_enabled = kids_education_check_top_section();
			$content_class   = !empty( $content_enabled ) ? $content_enabled : '';
		} else{
			$content_class = '';
		}
	?>			
		<div id="content" class="site-content <?php echo esc_attr( $content_class ); ?>">
		<?php
	}
endif;
add_action( 'kids_education_content_start_action', 'kids_education_content_start', 10 );

if ( ! function_exists( 'kids_education_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Kids Education 0.1
	 *
	 */
	function kids_education_content_end() {
		?>
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'kids_education_content_end_action', 'kids_education_content_end', 10 );


if ( ! function_exists( 'kids_education_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since Kids Education 0.1
	 */
	function kids_education_add_breadcrumb() {
		$options = kids_education_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		// Bail if Home Page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		echo '<div id="breadcrumb-list" class="os-animation" data-os-animation="fadeInUp">
			<div class="container">';
				/**
				 * kids_education_simple_breadcrumb hook
				 *
				 * @hooked kids_education_simple_breadcrumb -  10
				 *
				 */
				do_action( 'kids_education_simple_breadcrumb' );
		echo '</div><!-- .container -->
			</div><!-- #breadcrumb-list -->';
		return;
	}

endif;
add_action( 'kids_education_add_breadcrumb', 'kids_education_add_breadcrumb' , 20 );


if ( ! function_exists( 'kids_education_page_section' ) ) :
	/**
	 * Start div class .container .page-section
	 *
	 * @since Kids Education 0.1
	 *
	 */
	function kids_education_page_section() {
		?>
		<div class="cloud-background page-section">
			<div class="container">
		<?php
	}
endif;
add_action( 'kids_education_page_section', 'kids_education_page_section', 10 );


if ( ! function_exists( 'kids_education_page_section_end' ) ) :
	/**
	 * Start div class .container .page-section
	 *
	 * @since Kids Education 0.1
	 *
	 */
	function kids_education_page_section_end() {
		?>
			</div><!-- .container -->
		</div><!-- end .page-section" -->
		<?php
	}
endif;
add_action( 'kids_education_page_section_end', 'kids_education_page_section_end', 10 );

if ( ! function_exists( 'kids_education_get_footer_divider' ) ) :
	/**
	 * Div content for footer divider
	 *
	 * @since Kids Education 0.1
	 *
	 */
	function kids_education_get_footer_divider() {
		?>
		<div class="footer-divider">
      		<img src="<?php echo get_template_directory_uri(); ?>/assets/uploads/footer-divider.png" alt="<?php _e( 'footer divider', 'kids-education' ); ?>">
    	</div>
		<?php
	}
endif;
add_action( 'kids_education_footer_divider', 'kids_education_get_footer_divider', 10 );
