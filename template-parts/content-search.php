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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'turbo-search-result' ); ?>>
	<header class="turbo-entry-header">
		<?php the_title( '<h2 class="turbo-entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
	</header>

	<div class="turbo-entry-summary">
		<?php the_excerpt(); ?>
	</div>
</article>
