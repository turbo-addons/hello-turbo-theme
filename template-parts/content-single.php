<?php
/**
 * Template part for displaying single posts.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'turbo-single-post' ); ?>>
	<header class="turbo-entry-header">
		<?php the_title( '<h1 class="turbo-entry-title">', '</h1>' ); ?>

		<div class="turbo-entry-meta">
			<span class="turbo-posted-on">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
					<?php echo esc_html( get_the_date() ); ?>
				</time>
			</span>
			<span class="turbo-posted-by">
				<?php echo esc_html( get_the_author() ); ?>
			</span>
			<?php if ( has_category() ) : ?>
				<span class="turbo-post-categories">
					<?php the_category( ', ' ); ?>
				</span>
			<?php endif; ?>
		</div>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="turbo-featured-image">
			<?php the_post_thumbnail( 'large' ); ?>
		</div>
	<?php endif; ?>

	<div class="turbo-entry-content">
		<?php
		the_content(
			sprintf(
				/* translators: %s: Post title. Only visible to screen readers. */
				esc_html__( 'Continue reading %s', 'helloturbo' ),
				'<span class="screen-reader-text">' . esc_html( get_the_title() ) . '</span>'
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'helloturbo' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<footer class="turbo-entry-footer">
		<?php
		$turbo_tags = get_the_tag_list( '', esc_html_x( ', ', 'tag separator', 'helloturbo' ) );
		if ( $turbo_tags ) {
			printf( '<span class="turbo-tags-links">%s: %s</span>', esc_html__( 'Tags', 'helloturbo' ), $turbo_tags ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
	</footer>
</article>
