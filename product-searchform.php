<?php
/**
 * The template for displaying product search form
 *
 * @package Theme Palace
 * @subpackage Kids Education 
 * @since Kids Education 0.1
 */
?>
<form role="search" method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field"><?php _e( 'Search for:', 'kids-education' ); ?></label>
	<input type="search" id="woocommerce-product-search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'kids-education' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'kids-education' ); ?>" />
	<input type="hidden" name="post_type" value="product" />
</form>

