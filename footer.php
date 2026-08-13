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
			<div class="turbo-container">

				<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
					<div class="turbo-footer-widgets">
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
				<?php endif; ?>

				<div class="turbo-footer-bottom">
					<?php
					if ( has_nav_menu( 'footer' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'menu_class'     => 'turbo-footer-menu',
								'container'      => false,
								'depth'          => 1,
								'fallback_cb'    => false,
							)
						);
					}
					?>

					<div class="turbo-footer-copyright">
						<?php
						printf(
							/* translators: %1$s: current year, %2$s: site title */
							esc_html__( 'Copyright &copy; %1$s %2$s', 'helloturbo' ),
							esc_html( gmdate( 'Y' ) ),
							esc_html( get_bloginfo( 'name' ) )
						);
						?>
					</div>
				</div>

			</div>
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
