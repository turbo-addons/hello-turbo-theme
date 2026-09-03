<?php
/**
 * The footer for the theme.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
		</div><!-- .turbo-container -->
	</div><!-- #content -->

	<?php
	/**
	 * Hook: turbo_theme_before_footer.
	 */
	do_action( 'turbo_theme_before_footer' );
	?>

	<?php if ( apply_filters( 'turbo_theme_show_default_footer', true ) ) : ?>
		<footer id="colophon" class="turbo-footer">
			<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
				<div class="turbo-footer-widgets">
					<div class="turbo-container">
						<div class="turbo-footer-widgets-grid turbo-footer-col-<?php echo esc_attr( get_theme_mod( 'turbo_footer_columns', '4' ) ); ?>">
							<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
								<div class="turbo-footer-widget-area">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
								<div class="turbo-footer-widget-area">
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
								<div class="turbo-footer-widget-area">
									<?php dynamic_sidebar( 'footer-3' ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</footer>
	<?php endif; ?>

	<?php
	/**
	 * Hook: turbo_theme_after_footer.
	 */
	do_action( 'turbo_theme_after_footer' );
	?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
