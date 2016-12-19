<?php
/**
 * kids_education woocommerce compatibility.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */


/**
 * Make theme WooCommerce ready
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);


add_action('woocommerce_before_main_content', 'kids_education_page_section', 10);
add_action('woocommerce_before_main_content', 'kids_education_primary_content_start', 20);

function kids_education_primary_content_start() {
  echo '<div id="primary" class="content-area os-animation animated fadeIn" data-os-animation="fadeIn">
		<main id="main" class="site-main" role="main">';
}

function kids_education_primary_content_end() {
  echo '</main>
  </div>';
}

add_action('woocommerce_after_main_content', 'kids_education_primary_content_end', 20);


// Change number or products per row to 3
add_filter('loop_shop_columns', 'kids_education_loop_columns');
if ( ! function_exists('kids_education_loop_columns')) {
	function kids_education_loop_columns() {
		return 3; // 3 products per row
	}
}

add_filter( 'woocommerce_sidebar', 'kids_education_end_sidebar', 20 );
function kids_education_end_sidebar() {
  echo '</div>
  </div>';
}

// change title
add_filter('woocommerce_shop_loop_item_title', 'kids_education_template_loop_product_title');
if (  ! function_exists( 'kids_education_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H3.
	 */
	function kids_education_template_loop_product_title( $post_id = '' ) {
		if ( empty( $post_id ) ) {
			GLOBAL $post;
			$post_id = $post->ID;
		}
		$taxonomy = 'product_cat';
		echo '<div class="product-description">
			<div class="product_meta">';
		$tp_taxonomies = wp_get_post_terms( $post_id, $taxonomy, array( "fields" => "all" ) );
		foreach ( $tp_taxonomies as $tp_taxonomy ) {
			echo '<a href="' . esc_url( get_term_link( $tp_taxonomy->slug, $taxonomy ) ) . '">' . esc_html( $tp_taxonomy->name ) . '</a>';
		}
		echo '</div>';
		echo '<h3><a href="' . esc_url( get_the_permalink() ) . '" >';
		echo esc_html( get_the_title() );
		echo '</a></h3>';
	}
}


// product opening tag
add_filter('woocommerce_before_shop_loop_item', 'kids_education_template_loop_product_open', 5 );
if ( ! function_exists( 'kids_education_template_loop_product_open' ) ) {

	function kids_education_template_loop_product_open() {
		echo '<div class="product-image">';
		
	}
}

// change position of add to cart button
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10);

// product closing tag
add_filter( 'woocommerce_before_shop_loop_item_title', 'kids_education_template_loop_product_close', 10 );
add_filter( 'woocommerce_after_shop_loop_item', 'kids_education_template_loop_product_close', 10 );
if ( ! function_exists( 'kids_education_template_loop_product_close' ) ) {

	function kids_education_template_loop_product_close() {
		echo '</div>';
	}
}


add_filter( 'woocommerce_output_related_products_args', 'kids_education_related_products_args' );
function kids_education_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}

// add excerpt
add_filter( 'woocommerce_after_shop_loop_item_title', 'kids_education_excerpt', 5 );
function kids_education_excerpt() {
	echo '<p class="product-detail">'. kids_education_trim_content( 20 ) .'</p>';
}

// pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'kids_education_wc_pagination', 10 );
function kids_education_wc_pagination() {
	global $wp_query;

	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}
	?>
	<nav class="woocommerce-pagination navigation pagination">
		<?php

			echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
				'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
				'format'       => '',
				'add_args'     => false,
				'current'      => max( 1, get_query_var( 'paged' ) ),
				'total'        => $wp_query->max_num_pages,
				'prev_text'    => 'Previous',
				'next_text'    => 'Next',
				'type'         => 'list',
				'end_size'     => 3,
				'mid_size'     => 3
			) ) );
		?>
	</nav>
<?php	
}
