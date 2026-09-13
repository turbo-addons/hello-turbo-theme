<?php
/**
 * The header for the theme.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="helloturbo-site">

	<?php
	/**
	 * Hook: helloturbo_theme_before_header.
	 */
	do_action( 'helloturbo_theme_before_header' );
	?>

	<?php if ( apply_filters( 'helloturbo_theme_show_default_header', true ) ) : ?>
		<header id="masthead" class="helloturbo-header helloturbo-header-layout-<?php echo esc_attr( get_theme_mod( 'helloturbo_header_layout', 'logo-left' ) ); ?> helloturbo-header-width-<?php echo esc_attr( get_theme_mod( 'helloturbo_header_width', 'contained' ) ); ?>">
			<div class="helloturbo-container">
				<div class="helloturbo-header-inner">

					<div class="helloturbo-site-branding">
						<?php if ( has_custom_logo() ) : ?>
							<?php the_custom_logo(); ?>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="helloturbo-site-title" rel="home">
								<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
							</a>
							<?php
							$helloturbo_description = get_bloginfo( 'description', 'display' );
							if ( $helloturbo_description || is_customize_preview() ) :
								?>
								<p class="helloturbo-site-description"><?php echo esc_html( $helloturbo_description ); ?></p>
							<?php endif; ?>
						<?php endif; ?>
					</div>

					<nav id="site-navigation" class="helloturbo-main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'helloturbo' ); ?>">
						<button class="helloturbo-menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'helloturbo' ); ?>">
							<span class="helloturbo-hamburger"></span>
						</button>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_id'        => 'primary-menu',
								'container'      => false,
								'menu_class'     => 'helloturbo-nav-menu',
								'fallback_cb'    => false,
							)
						);
						?>
					</nav>

					<?php if ( get_theme_mod( 'helloturbo_header_search', false ) || get_theme_mod( 'helloturbo_header_button_enable', false ) ) : ?>
						<div class="helloturbo-header-actions">
							<?php if ( get_theme_mod( 'helloturbo_header_search', false ) ) : ?>
								<button class="helloturbo-search-toggle" aria-expanded="false" aria-controls="helloturbo-header-search" aria-label="<?php esc_attr_e( 'Toggle search', 'helloturbo' ); ?>">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><circle cx="11" cy="11" r="7"></circle><path d="M21 21l-4.3-4.3"></path></svg>
								</button>
							<?php endif; ?>
							<?php if ( get_theme_mod( 'helloturbo_header_button_enable', false ) ) : ?>
								<a class="helloturbo-btn-theme helloturbo-header-cta" href="<?php echo esc_url( get_theme_mod( 'helloturbo_header_button_url', '#' ) ); ?>"><?php echo esc_html( get_theme_mod( 'helloturbo_header_button_text', __( 'Get Started', 'helloturbo' ) ) ); ?></a>
							<?php endif; ?>
						</div>
					<?php endif; ?>

				</div>
			</div>

			<?php if ( get_theme_mod( 'helloturbo_header_search', false ) ) : ?>
				<div id="helloturbo-header-search" class="helloturbo-header-search-form">
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
		</header>
	<?php endif; ?>

	<?php
	/**
	 * Hook: helloturbo_theme_after_header.
	 */
	do_action( 'helloturbo_theme_after_header' );
	?>

	<div id="content" class="helloturbo-site-content">
		<div class="helloturbo-container">
