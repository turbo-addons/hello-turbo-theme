<?php
/**
 * Header / Footer Builder — front-end rendering.
 *
 * Wires the Customizer settings to the template hooks defined in
 * header.php and footer.php.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the social links configured in the Customizer.
 *
 * @return array List of ['url' => string, 'label' => string, 'network' => string].
 */
function helloturbo_get_social_links() {
	$networks = array(
		'facebook'  => __( 'Facebook', 'helloturbo' ),
		'twitter'   => __( 'Twitter', 'helloturbo' ),
		'instagram' => __( 'Instagram', 'helloturbo' ),
		'youtube'   => __( 'YouTube', 'helloturbo' ),
		'linkedin'  => __( 'LinkedIn', 'helloturbo' ),
	);

	$links = array();
	foreach ( $networks as $slug => $label ) {
		$url = get_theme_mod( "helloturbo_social_{$slug}", '' );
		if ( $url ) {
			$links[] = array(
				'url'     => $url,
				'label'   => $label,
				'network' => $slug,
			);
		}
	}

	return $links;
}

/**
 * Get the inline SVG icon for a social network.
 *
 * @param string $network Network slug.
 * @return string
 */
function helloturbo_social_icon_svg( $network ) {
	$svg = array(
		'facebook'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M13.5 21v-7h2.5l.5-3h-3V9c0-.9.3-1.5 1.7-1.5H17V4.8c-.3 0-1.3-.1-2.4-.1-2.4 0-4 1.4-4 4V11H8v3h2.6v7h2.9z"/></svg>',
		'twitter'   => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M22 5.9c-.7.3-1.5.5-2.3.6.8-.5 1.5-1.3 1.8-2.2-.8.5-1.7.8-2.6 1a4 4 0 0 0-6.8 3.7A11.4 11.4 0 0 1 3.8 4.8a4 4 0 0 0 1.2 5.4c-.6 0-1.2-.2-1.8-.5v.1c0 2 1.4 3.6 3.2 4-.6.2-1.2.2-1.8.1.5 1.6 2 2.8 3.8 2.8A8 8 0 0 1 2 18.6a11.3 11.3 0 0 0 6.1 1.8c7.3 0 11.3-6 11.3-11.3v-.5c.8-.6 1.4-1.3 2-2.1z"/></svg>',
		'instagram' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M12 4.3c2.5 0 2.8 0 3.8.1 2.5.1 3.7 1.3 3.8 3.8.1 1 .1 1.3.1 3.8s0 2.8-.1 3.8c-.1 2.5-1.3 3.7-3.8 3.8-1 .1-1.3.1-3.8.1s-2.8 0-3.8-.1c-2.5-.1-3.7-1.3-3.8-3.8-.1-1-.1-1.3-.1-3.8s0-2.8.1-3.8c.1-2.5 1.3-3.7 3.8-3.8 1-.1 1.3-.1 3.8-.1zM12 2c-2.6 0-2.9 0-3.9.1-3.4.2-5.4 2.2-5.6 5.6C2.4 8.8 2.4 9.1 2.4 12s0 3.2.1 4.3c.2 3.4 2.2 5.4 5.6 5.6 1 .1 1.3.1 3.9.1s2.9 0 3.9-.1c3.4-.2 5.4-2.2 5.6-5.6.1-1.1.1-1.4.1-4.3s0-3.2-.1-4.3c-.2-3.4-2.2-5.4-5.6-5.6C14.9 2 14.6 2 12 2zm0 5.5a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9zm0 7.4a2.9 2.9 0 1 1 0-5.8 2.9 2.9 0 0 1 0 5.8zm5.7-7.5a1 1 0 1 0 0-2.1 1 1 0 0 0 0 2.1z"/></svg>',
		'youtube'   => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M23 12s0-3.2-.4-4.7c-.2-.8-.9-1.5-1.7-1.7C19.4 5.2 12 5.2 12 5.2s-7.4 0-8.9.4c-.8.2-1.5.9-1.7 1.7C1 8.8 1 12 1 12s0 3.2.4 4.7c.2.8.9 1.5 1.7 1.7 1.5.4 8.9.4 8.9.4s7.4 0 8.9-.4c.8-.2 1.5-.9 1.7-1.7.4-1.5.4-4.7.4-4.7zM9.8 15.3V8.7l5.8 3.3-5.8 3.3z"/></svg>',
		'linkedin'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V23h-4V8zm7.5 0h3.8v2.1h.1c.5-1 1.8-2.1 3.7-2.1 4 0 4.7 2.6 4.7 6V23h-4v-6.6c0-1.6 0-3.6-2.2-3.6s-2.5 1.7-2.5 3.5V23h-4V8z"/></svg>',
	);

	return isset( $svg[ $network ] ) ? $svg[ $network ] : '';
}

/**
 * Render a row of social icon links.
 */
function helloturbo_render_social_icons() {
	$links = helloturbo_get_social_links();
	if ( empty( $links ) ) {
		return;
	}
	?>
	<div class="helloturbo-social-icons">
		<?php foreach ( $links as $link ) : ?>
			<a class="helloturbo-social-icon helloturbo-social-icon--<?php echo esc_attr( $link['network'] ); ?>" href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" rel="noopener noreferrer">
				<span class="screen-reader-text"><?php echo esc_html( $link['label'] ); ?></span>
				<?php echo helloturbo_social_icon_svg( $link['network'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		<?php endforeach; ?>
	</div>
	<?php
}

/**
 * Render a header builder content slot.
 *
 * @param string $type      Content type: none|text|menu|social.
 * @param string $text_mod  Theme mod key for the custom text.
 * @param string $location  Menu location.
 * @param string $menu_class CSS class for the menu.
 */
function helloturbo_render_header_content( $type, $text_mod, $location, $menu_class ) {
	switch ( $type ) {
		case 'text':
			echo wp_kses_post( get_theme_mod( $text_mod, '' ) );
			break;

		case 'menu':
			if ( has_nav_menu( $location ) ) {
				wp_nav_menu(
					array(
						'theme_location' => $location,
						'container'      => false,
						'menu_class'     => $menu_class,
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
			}
			break;

		case 'social':
			helloturbo_render_social_icons();
			break;
	}
}

/**
 * Render the "Above Header" row.
 */
function helloturbo_theme_above_header() {
	if ( ! get_theme_mod( 'helloturbo_above_header_enable', false ) ) {
		return;
	}
	?>
	<div class="helloturbo-above-header">
		<div class="helloturbo-container">
			<div class="helloturbo-above-header-inner">
				<div class="helloturbo-above-header-left">
					<?php helloturbo_render_header_content( get_theme_mod( 'helloturbo_above_header_left', 'text' ), 'helloturbo_above_header_left_text', 'above-header', 'helloturbo-inline-menu' ); ?>
				</div>
				<div class="helloturbo-above-header-right">
					<?php helloturbo_render_header_content( get_theme_mod( 'helloturbo_above_header_right', 'text' ), 'helloturbo_above_header_right_text', 'above-header', 'helloturbo-inline-menu' ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'helloturbo_theme_before_header', 'helloturbo_theme_above_header' );

/**
 * Render the "Below Header" row.
 */
function helloturbo_theme_below_header() {
	if ( ! get_theme_mod( 'helloturbo_below_header_enable', false ) ) {
		return;
	}

	$content = get_theme_mod( 'helloturbo_below_header_content', 'menu' );
	if ( 'none' === $content ) {
		return;
	}
	?>
	<div class="helloturbo-below-header">
		<div class="helloturbo-container">
			<div class="helloturbo-below-header-inner">
				<?php helloturbo_render_header_content( $content, 'helloturbo_below_header_text', 'secondary', 'helloturbo-nav-menu' ); ?>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'helloturbo_theme_after_header', 'helloturbo_theme_below_header', 5 );

/**
 * Replace dynamic tags in copyright text.
 *
 * @param string $text Raw text.
 * @return string
 */
function helloturbo_replace_copyright_tags( $text ) {
	$replace = array(
		'{year}'       => esc_html( gmdate( 'Y' ) ),
		'{site_title}' => esc_html( get_bloginfo( 'name' ) ),
	);

	return strtr( $text, $replace );
}

/**
 * Render the footer copyright bar.
 */
function helloturbo_theme_footer_bar() {
	$left        = get_theme_mod( 'helloturbo_copyright_text_left', __( 'Copyright {year} {site_title}. All rights reserved.', 'helloturbo' ) );
	$right       = get_theme_mod( 'helloturbo_copyright_text_right', __( 'Powered by HelloTurbo', 'helloturbo' ) );
	$layout      = get_theme_mod( 'helloturbo_footer_bar_layout', 'two-columns' );
	$show_menu   = get_theme_mod( 'helloturbo_footer_bar_menu', false );
	$show_social = get_theme_mod( 'helloturbo_footer_social_enable', false );

	if ( ! $left && ! $right && ! $show_menu && ! $show_social ) {
		return;
	}
	?>
	<div class="helloturbo-footer-bar helloturbo-footer-bar--<?php echo esc_attr( $layout ); ?>">
		<div class="helloturbo-container">
			<div class="helloturbo-footer-bar-inner">
				<div class="helloturbo-footer-bar-left">
					<?php
					if ( $show_menu && has_nav_menu( 'footer' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'container'      => false,
								'menu_class'     => 'helloturbo-footer-menu',
								'depth'          => 1,
								'fallback_cb'    => false,
							)
						);
					}
					if ( $left ) {
						echo '<div class="helloturbo-footer-copyright">' . wp_kses_post( helloturbo_replace_copyright_tags( $left ) ) . '</div>';
					}
					?>
				</div>
				<div class="helloturbo-footer-bar-right">
					<?php
					if ( $right ) {
						echo '<div class="helloturbo-footer-credit">' . wp_kses_post( helloturbo_replace_copyright_tags( $right ) ) . '</div>';
					}
					if ( $show_social ) {
						helloturbo_render_social_icons();
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'helloturbo_theme_after_footer', 'helloturbo_theme_footer_bar' );
