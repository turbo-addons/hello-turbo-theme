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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'helloturbo-page-article' ); ?>>
	<?php if ( get_theme_mod( 'helloturbo_page_title_enable', true ) ) : ?>
		<header class="helloturbo-entry-header">
			<?php the_title( '<h1 class="helloturbo-entry-title">', '</h1>' ); ?>
		</header>
	<?php endif; ?>

	<div class="helloturbo-entry-content">
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
