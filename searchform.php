<?php
/**
 * The template for displaying search form
 *
 * @package Theme Palace
 * @subpackage Kids Education 
 * @since Kids Education 0.1
 */

$options = kids_education_get_theme_options();
?>

<form action="<?php echo esc_url( home_url('/') ); ?>">
	<input type="search" name="s" placeholder="<?php echo esc_attr( $options['search_text'] ) ?>" value="<?php echo esc_attr( get_search_query() ); ?>" >
	<button type="submit" class="search-submit"></button>
	
</form>