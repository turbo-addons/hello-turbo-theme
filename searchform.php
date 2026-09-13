<?php
/**
 * The search form template.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$helloturbo_search_id = wp_unique_id( 'search-form-' );
?>
<form role="search" method="get" class="helloturbo-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $helloturbo_search_id ); ?>">
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'helloturbo' ); ?></span>
	</label>
	<input type="search" id="<?php echo esc_attr( $helloturbo_search_id ); ?>" class="helloturbo-search-field" placeholder="<?php esc_attr_e( 'Search &hellip;', 'helloturbo' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	<button type="submit" class="helloturbo-search-submit"><?php esc_html_e( 'Search', 'helloturbo' ); ?></button>
</form>
