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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'helloturbo-post-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="helloturbo-post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium_large' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="helloturbo-post-content">
		<header class="helloturbo-entry-header">
			<?php the_title( '<h2 class="helloturbo-entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>

			<div class="helloturbo-entry-meta">
				<span class="helloturbo-posted-on">
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
						<?php echo esc_html( get_the_date() ); ?>
					</time>
				</span>
				<span class="helloturbo-posted-by">
					<?php echo esc_html( get_the_author() ); ?>
				</span>
			</div>
		</header>

		<div class="helloturbo-entry-summary">
			<?php the_excerpt(); ?>
		</div>

		<footer class="helloturbo-entry-footer">
			<?php
			$helloturbo_categories = get_the_category_list( esc_html__( ', ', 'helloturbo' ) );
			if ( $helloturbo_categories ) {
				printf( '<span class="helloturbo-cat-links">%s</span>', $helloturbo_categories ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
		</footer>
	</div>
</article>
