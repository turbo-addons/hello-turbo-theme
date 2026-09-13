<?php
/**
 * Template part for displaying search results.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'helloturbo-search-result' ); ?>>
	<header class="helloturbo-entry-header">
		<?php the_title( '<h2 class="helloturbo-entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
	</header>

	<div class="helloturbo-entry-summary">
		<?php the_excerpt(); ?>
	</div>
</article>
