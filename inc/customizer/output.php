<?php
/**
 * Dynamic CSS output from all Customizer settings.
 * Outputs CSS variables on :root and targeted rules.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get a sanitized hex color theme mod, with a fallback default.
 *
 * @param string $key           Theme mod key.
 * @param string $default_value Fallback hex color.
 * @return string
 */
function turbo_theme_color_mod( $key, $default_value ) {
	$color = sanitize_hex_color( get_theme_mod( $key, $default_value ) );
	return $color ? $color : $default_value;
}

/**
 * Get an integer theme mod.
 *
 * @param string $key           Theme mod key.
 * @param int    $default_value Fallback integer.
 * @return int
 */
function turbo_theme_int_mod( $key, $default_value ) {
	return absint( get_theme_mod( $key, $default_value ) );
}

/**
 * Get a numeric (float) theme mod.
 *
 * @param string $key           Theme mod key.
 * @param float  $default_value Fallback value.
 * @return float
 */
function turbo_theme_float_mod( $key, $default_value ) {
	$value = get_theme_mod( $key, $default_value );
	return is_numeric( $value ) ? (float) $value : (float) $default_value;
}

/**
 * Get a sanitized font-weight theme mod.
 *
 * @param string $key           Theme mod key.
 * @param string $default_value Fallback weight.
 * @return string
 */
function turbo_theme_weight_mod( $key, $default_value ) {
	$value = get_theme_mod( $key, $default_value );
	$valid = array( '100', '200', '300', '400', '500', '600', '700', '800', '900', 'normal', 'bold' );
	return in_array( (string) $value, $valid, true ) ? $value : $default_value;
}

/**
 * Generate and inject dynamic CSS.
 */
function turbo_dynamic_css() {
	$css = '';

	// --- CSS Custom Properties (design tokens) ---
	$palette_defaults = array( '#2563eb', '#1e40af', '#111827', '#1f2937', '#6b7280', '#f9fafb', '#ffffff', '#f3f4f6', '#e5e7eb' );
	$palette          = array();
	for ( $i = 0; $i < 9; $i++ ) {
		$palette[ $i ] = turbo_theme_color_mod( "turbo_palette_color_{$i}", $palette_defaults[ $i ] );
	}

	$body_font     = get_theme_mod( 'turbo_body_font_family', 'system' );
	$heading_font  = get_theme_mod( 'turbo_heading_font_family', 'system' );
	$body_stack    = turbo_get_font_stack( $body_font );
	$heading_stack = turbo_get_font_stack( $heading_font );

	$container_width = turbo_theme_int_mod( 'turbo_container_width', 1200 );
	$body_size       = turbo_theme_int_mod( 'turbo_body_font_size', 16 );
	$body_lh         = turbo_theme_float_mod( 'turbo_body_line_height', '1.65' );
	$body_weight     = turbo_theme_weight_mod( 'turbo_body_font_weight', '400' );
	$heading_weight  = turbo_theme_weight_mod( 'turbo_heading_font_weight', '700' );
	$heading_lh      = turbo_theme_float_mod( 'turbo_heading_line_height', '1.3' );

	$link_color = turbo_theme_color_mod( 'turbo_color_link', '#2563eb' );
	$link_hover = turbo_theme_color_mod( 'turbo_color_link_hover', '#1e40af' );
	$site_bg    = turbo_theme_color_mod( 'turbo_color_bg_site', '#ffffff' );
	$content_bg = turbo_theme_color_mod( 'turbo_color_bg_content', '#ffffff' );

	$css .= ":root {\n";
	$css .= "  --turbo-primary: {$palette[0]};\n";
	$css .= "  --turbo-secondary: {$palette[1]};\n";
	$css .= "  --turbo-heading-color: {$palette[2]};\n";
	$css .= "  --turbo-text-color: {$palette[3]};\n";
	$css .= "  --turbo-meta-color: {$palette[4]};\n";
	$css .= "  --turbo-light-bg: {$palette[5]};\n";
	$css .= "  --turbo-white: {$palette[6]};\n";
	$css .= "  --turbo-border: {$palette[7]};\n";
	$css .= "  --turbo-border-subtle: {$palette[8]};\n";
	$css .= "  --turbo-link: {$link_color};\n";
	$css .= "  --turbo-link-hover: {$link_hover};\n";
	$css .= "  --turbo-site-bg: {$site_bg};\n";
	$css .= "  --turbo-content-bg: {$content_bg};\n";
	$css .= "  --turbo-container: {$container_width}px;\n";
	$css .= "  --turbo-font-body: {$body_stack};\n";
	$css .= "  --turbo-font-heading: {$heading_stack};\n";
	$css .= "  --turbo-body-size: {$body_size}px;\n";
	$css .= "  --turbo-body-lh: {$body_lh};\n";
	$css .= "  --turbo-body-weight: {$body_weight};\n";
	$css .= "  --turbo-heading-weight: {$heading_weight};\n";
	$css .= "  --turbo-heading-lh: {$heading_lh};\n";

	// Heading sizes.
	$h_defaults = array(
		'h1' => 40,
		'h2' => 32,
		'h3' => 26,
		'h4' => 22,
		'h5' => 18,
		'h6' => 16,
	);
	foreach ( $h_defaults as $tag => $def ) {
		$size = turbo_theme_int_mod( "turbo_{$tag}_font_size", $def );
		$css .= "  --turbo-{$tag}-size: {$size}px;\n";
	}

	// Button vars.
	$css .= '  --turbo-btn-color: ' . turbo_theme_color_mod( 'turbo_btn_color', '#ffffff' ) . ";\n";
	$css .= '  --turbo-btn-bg: ' . turbo_theme_color_mod( 'turbo_btn_bg', '#2563eb' ) . ";\n";
	$css .= '  --turbo-btn-hover-color: ' . turbo_theme_color_mod( 'turbo_btn_hover_color', '#ffffff' ) . ";\n";
	$css .= '  --turbo-btn-hover-bg: ' . turbo_theme_color_mod( 'turbo_btn_hover_bg', '#1e40af' ) . ";\n";
	$css .= '  --turbo-btn-radius: ' . turbo_theme_int_mod( 'turbo_btn_radius', 4 ) . "px;\n";
	$css .= '  --turbo-btn-padding: ' . turbo_theme_int_mod( 'turbo_btn_padding_v', 12 ) . 'px ' . turbo_theme_int_mod( 'turbo_btn_padding_h', 24 ) . "px;\n";
	$css .= '  --turbo-btn-font-size: ' . turbo_theme_int_mod( 'turbo_btn_font_size', 15 ) . "px;\n";
	$css .= '  --turbo-btn-weight: ' . turbo_theme_weight_mod( 'turbo_btn_font_weight', '500' ) . ";\n";

	// Header vars.
	$css .= '  --turbo-header-height: ' . turbo_theme_int_mod( 'turbo_header_height', 70 ) . "px;\n";
	$css .= '  --turbo-header-bg: ' . turbo_theme_color_mod( 'turbo_header_bg', '#ffffff' ) . ";\n";
	$css .= '  --turbo-menu-color: ' . turbo_theme_color_mod( 'turbo_menu_color', '#1f2937' ) . ";\n";
	$css .= '  --turbo-menu-hover: ' . turbo_theme_color_mod( 'turbo_menu_hover_color', '#2563eb' ) . ";\n";
	$css .= '  --turbo-mobile-break: ' . turbo_theme_int_mod( 'turbo_mobile_breakpoint', 992 ) . "px;\n";
	$css .= "}\n";

	// --- Header ---
	$header_border       = turbo_theme_int_mod( 'turbo_header_border_bottom', 1 );
	$header_border_color = turbo_theme_color_mod( 'turbo_header_border_color', '#e5e7eb' );
	$css                .= ".turbo-header { min-height: var(--turbo-header-height); background: var(--turbo-header-bg); border-bottom: {$header_border}px solid {$header_border_color}; }\n";

	// Sticky.
	if ( get_theme_mod( 'turbo_sticky_header', false ) ) {
		$css .= ".turbo-header { position: sticky; top: 0; z-index: 999; }\n";
	}

	// Transparent.
	if ( get_theme_mod( 'turbo_transparent_header', false ) ) {
		$css .= ".turbo-header { position: absolute; width: 100%; background: transparent; border-bottom: none; }\n";
	}

	// Above header.
	if ( get_theme_mod( 'turbo_above_header_enable', false ) ) {
		$ah_bg    = turbo_theme_color_mod( 'turbo_above_header_bg', '#f3f4f6' );
		$ah_color = turbo_theme_color_mod( 'turbo_above_header_text_color', '#6b7280' );
		$ah_h     = turbo_theme_int_mod( 'turbo_above_header_height', 40 );
		$ah_bb    = turbo_theme_int_mod( 'turbo_above_header_border_bottom', 1 );
		$ah_bc    = turbo_theme_color_mod( 'turbo_above_header_border_color', '#e5e7eb' );
		$css     .= ".turbo-above-header { display: flex; min-height: {$ah_h}px; background: {$ah_bg}; color: {$ah_color}; border-bottom: {$ah_bb}px solid {$ah_bc}; }\n";
	}

	// Below header.
	if ( get_theme_mod( 'turbo_below_header_enable', false ) ) {
		$bh_bg = turbo_theme_color_mod( 'turbo_below_header_bg', '#ffffff' );
		$bh_h  = turbo_theme_int_mod( 'turbo_below_header_height', 50 );
		$css  .= ".turbo-below-header { display: flex; align-items: center; min-height: {$bh_h}px; background: {$bh_bg}; }\n";
	}

	// Menu.
	$menu_size      = turbo_theme_int_mod( 'turbo_menu_font_size', 15 );
	$menu_weight    = turbo_theme_weight_mod( 'turbo_menu_font_weight', '500' );
	$menu_transform = get_theme_mod( 'turbo_menu_text_transform', 'none' );
	if ( ! in_array( $menu_transform, array( 'none', 'capitalize', 'uppercase', 'lowercase' ), true ) ) {
		$menu_transform = 'none';
	}
	$css .= ".turbo-nav-menu > li > a { font-size: {$menu_size}px; font-weight: {$menu_weight}; text-transform: {$menu_transform}; color: var(--turbo-menu-color); }\n";
	$css .= ".turbo-nav-menu > li > a:hover, .turbo-nav-menu > li.current-menu-item > a { color: var(--turbo-menu-hover); }\n";

	// Submenu.
	$submenu_bg          = turbo_theme_color_mod( 'turbo_submenu_bg', '#ffffff' );
	$submenu_color       = turbo_theme_color_mod( 'turbo_submenu_color', '#374151' );
	$submenu_hover_color = turbo_theme_color_mod( 'turbo_submenu_hover_color', '#2563eb' );
	$submenu_hover_bg    = turbo_theme_color_mod( 'turbo_submenu_hover_bg', '#f9fafb' );
	$css                .= ".turbo-nav-menu .sub-menu { background: {$submenu_bg}; }\n";
	$css                .= ".turbo-nav-menu .sub-menu a { color: {$submenu_color}; }\n";
	$css                .= ".turbo-nav-menu .sub-menu a:hover { color: {$submenu_hover_color}; background: {$submenu_hover_bg}; }\n";

	// Mobile menu.
	$hamburger_color = turbo_theme_color_mod( 'turbo_hamburger_color', '#111827' );
	$mobile_menu_bg  = turbo_theme_color_mod( 'turbo_mobile_menu_bg', '#ffffff' );
	$mobile_menu_clr = turbo_theme_color_mod( 'turbo_mobile_menu_color', '#1f2937' );
	$css            .= ".turbo-hamburger { background: {$hamburger_color}; }\n";
	$css            .= ".turbo-main-navigation.is-open .turbo-nav-menu { background: {$mobile_menu_bg}; }\n";
	$css            .= ".turbo-main-navigation.is-open .turbo-nav-menu > li > a { color: {$mobile_menu_clr}; }\n";

	// --- Footer ---
	if ( get_theme_mod( 'turbo_footer_widgets_enable', true ) ) {
		$fw_bg      = turbo_theme_color_mod( 'turbo_footer_widgets_bg', '#1f2937' );
		$fw_text    = turbo_theme_color_mod( 'turbo_footer_widgets_text', '#d1d5db' );
		$fw_heading = turbo_theme_color_mod( 'turbo_footer_widgets_heading', '#ffffff' );
		$fw_link    = turbo_theme_color_mod( 'turbo_footer_widgets_link', '#93c5fd' );
		$fw_padding = turbo_theme_int_mod( 'turbo_footer_widgets_padding', 60 );
		$css       .= ".turbo-footer-widgets { background: {$fw_bg}; color: {$fw_text}; padding: {$fw_padding}px 0; }\n";
		$css       .= ".turbo-footer-widgets .widget-title { color: {$fw_heading}; }\n";
		$css       .= ".turbo-footer-widgets a { color: {$fw_link}; }\n";
		$css       .= '.turbo-footer-widgets a:hover { color: ' . turbo_theme_color_mod( 'turbo_footer_widgets_link_hover', '#ffffff' ) . "; }\n";
	}

	// Footer bar.
	$fb_bg      = turbo_theme_color_mod( 'turbo_footer_bar_bg', '#111827' );
	$fb_color   = turbo_theme_color_mod( 'turbo_footer_bar_text_color', '#9ca3af' );
	$fb_link    = turbo_theme_color_mod( 'turbo_footer_bar_link_color', '#93c5fd' );
	$fb_padding = turbo_theme_int_mod( 'turbo_footer_bar_padding', 15 );
	$fb_bt      = turbo_theme_int_mod( 'turbo_footer_bar_border_top', 1 );
	$fb_bc      = turbo_theme_color_mod( 'turbo_footer_bar_border_color', '#374151' );
	$css       .= ".turbo-footer-bar { background: {$fb_bg}; color: {$fb_color}; padding: {$fb_padding}px 0; border-top: {$fb_bt}px solid {$fb_bc}; }\n";
	$css       .= ".turbo-footer-bar a { color: {$fb_link}; }\n";
	$css       .= '.turbo-footer-bar a:hover { color: ' . turbo_theme_color_mod( 'turbo_footer_bar_link_hover', '#ffffff' ) . "; }\n";

	// --- Content / Container ---
	$content_padding_top    = turbo_theme_int_mod( 'turbo_content_padding_top', 40 );
	$content_padding_bottom = turbo_theme_int_mod( 'turbo_content_padding_bottom', 40 );
	$css                   .= ".turbo-site-content { padding-top: {$content_padding_top}px; padding-bottom: {$content_padding_bottom}px; }\n";

	// Sidebar width.
	$sidebar_width = turbo_theme_int_mod( 'turbo_sidebar_width', 30 );
	$sidebar_width = max( 0, min( 100, $sidebar_width ) );
	$content_width = 100 - $sidebar_width;
	$css          .= ".turbo-has-sidebar .turbo-main-content { width: {$content_width}%; }\n";
	$css          .= ".turbo-has-sidebar .turbo-sidebar { width: {$sidebar_width}%; }\n";

	// Boxed layout.
	if ( 'boxed' === get_theme_mod( 'turbo_site_layout', 'full-width' ) ) {
		$css .= "body { background: var(--turbo-light-bg); }\n";
		$css .= ".turbo-site { max-width: var(--turbo-container); margin: 0 auto; background: var(--turbo-site-bg); box-shadow: 0 0 20px rgba(0,0,0,0.05); }\n";
	}

	// Narrow layout.
	$narrow = turbo_theme_int_mod( 'turbo_narrow_width', 750 );
	$css   .= ".turbo-narrow .turbo-main-content { max-width: {$narrow}px; margin: 0 auto; }\n";

	wp_add_inline_style( 'helloturbo-style', $css );
}
add_action( 'wp_enqueue_scripts', 'turbo_dynamic_css', 20 );

/**
 * Customizer preview JS for live updates.
 */
function turbo_customizer_preview_js() {
	wp_enqueue_script(
		'turbo-customizer-preview',
		TURBO_THEME_URI . '/assets/js/customizer-preview.js',
		array( 'customize-preview' ),
		TURBO_THEME_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'turbo_customizer_preview_js' );
