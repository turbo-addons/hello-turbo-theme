<?php
/**
 * Template part for displaying page content.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'turbo-page-article' ); ?>>
	<header class="turbo-entry-header">
		<?php the_title( '<h1 class="turbo-entry-title">', '</h1>' ); ?>
	</header>

	<div class="turbo-entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'helloturbo' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>
