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
		</div><!-- .helloturbo-container -->
	</div><!-- #content -->

	<?php
	/**
	 * Hook: helloturbo_theme_before_footer.
	 */
	do_action( 'helloturbo_theme_before_footer' );
	?>

	<?php if ( apply_filters( 'helloturbo_theme_show_default_footer', true ) ) : ?>
		<footer id="colophon" class="helloturbo-footer">
			<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
				<div class="helloturbo-footer-widgets">
					<div class="helloturbo-container">
						<div class="helloturbo-footer-widgets-grid helloturbo-footer-col-<?php echo esc_attr( get_theme_mod( 'helloturbo_footer_columns', '4' ) ); ?>">
							<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
								<div class="helloturbo-footer-widget-area">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
								<div class="helloturbo-footer-widget-area">
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
								<div class="helloturbo-footer-widget-area">
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
	 * Hook: helloturbo_theme_after_footer.
	 */
	do_action( 'helloturbo_theme_after_footer' );
	?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
