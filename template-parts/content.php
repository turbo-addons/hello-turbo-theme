<?php
/**
 * Template part for displaying posts in loops.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'turbo-post-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="turbo-post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium_large' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="turbo-post-content">
		<header class="turbo-entry-header">
			<?php the_title( '<h2 class="turbo-entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>

			<div class="turbo-entry-meta">
				<span class="turbo-posted-on">
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
						<?php echo esc_html( get_the_date() ); ?>
					</time>
				</span>
				<span class="turbo-posted-by">
					<?php echo esc_html( get_the_author() ); ?>
				</span>
			</div>
		</header>

		<div class="turbo-entry-summary">
			<?php the_excerpt(); ?>
		</div>

		<footer class="turbo-entry-footer">
			<?php
			$turbo_categories = get_the_category_list( esc_html__( ', ', 'helloturbo' ) );
			if ( $turbo_categories ) {
				printf( '<span class="turbo-cat-links">%s</span>', $turbo_categories ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
		</footer>
	</div>
</article>
