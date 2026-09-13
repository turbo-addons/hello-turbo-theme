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
function helloturbo_theme_color_mod( $key, $default_value ) {
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
function helloturbo_theme_int_mod( $key, $default_value ) {
	return absint( get_theme_mod( $key, $default_value ) );
}

/**
 * Get a numeric (float) theme mod.
 *
 * @param string $key           Theme mod key.
 * @param float  $default_value Fallback value.
 * @return float
 */
function helloturbo_theme_float_mod( $key, $default_value ) {
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
function helloturbo_theme_weight_mod( $key, $default_value ) {
	$value = get_theme_mod( $key, $default_value );
	$valid = array( '100', '200', '300', '400', '500', '600', '700', '800', '900', 'normal', 'bold' );
	return in_array( (string) $value, $valid, true ) ? $value : $default_value;
}

/**
 * Generate and inject dynamic CSS.
 */
function helloturbo_dynamic_css() {
	$css = '';

	// --- CSS Custom Properties (design tokens) ---
	$palette_defaults = array( '#2563eb', '#1e40af', '#111827', '#1f2937', '#6b7280', '#f9fafb', '#ffffff', '#f3f4f6', '#e5e7eb' );
	$palette          = array();
	for ( $i = 0; $i < 9; $i++ ) {
		$palette[ $i ] = helloturbo_theme_color_mod( "helloturbo_palette_color_{$i}", $palette_defaults[ $i ] );
	}

	$body_font     = get_theme_mod( 'helloturbo_body_font_family', 'system' );
	$heading_font  = get_theme_mod( 'helloturbo_heading_font_family', 'system' );
	$body_stack    = helloturbo_get_font_stack( $body_font );
	$heading_stack = helloturbo_get_font_stack( $heading_font );

	$container_width = get_theme_mod( 'helloturbo_container_width', '1200' );
	$body_size       = helloturbo_theme_int_mod( 'helloturbo_body_font_size', 16 );
	$body_lh         = helloturbo_theme_float_mod( 'helloturbo_body_line_height', '1.65' );
	$body_weight     = helloturbo_theme_weight_mod( 'helloturbo_body_font_weight', '400' );
	$heading_weight  = helloturbo_theme_weight_mod( 'helloturbo_heading_font_weight', '700' );
	$heading_lh      = helloturbo_theme_float_mod( 'helloturbo_heading_line_height', '1.3' );

	$link_color = helloturbo_theme_color_mod( 'helloturbo_color_link', '#2563eb' );
	$link_hover = helloturbo_theme_color_mod( 'helloturbo_color_link_hover', '#1e40af' );
	$site_bg    = helloturbo_theme_color_mod( 'helloturbo_color_bg_site', '#ffffff' );
	$content_bg = helloturbo_theme_color_mod( 'helloturbo_color_bg_content', '#ffffff' );

	$css .= ":root {\n";
	$css .= "  --helloturbo-primary: {$palette[0]};\n";
	$css .= "  --helloturbo-secondary: {$palette[1]};\n";
	$css .= "  --helloturbo-heading-color: {$palette[2]};\n";
	$css .= "  --helloturbo-text-color: {$palette[3]};\n";
	$css .= "  --helloturbo-meta-color: {$palette[4]};\n";
	$css .= "  --helloturbo-light-bg: {$palette[5]};\n";
	$css .= "  --helloturbo-white: {$palette[6]};\n";
	$css .= "  --helloturbo-border: {$palette[7]};\n";
	$css .= "  --helloturbo-border-subtle: {$palette[8]};\n";
	$css .= "  --helloturbo-link: {$link_color};\n";
	$css .= "  --helloturbo-link-hover: {$link_hover};\n";
	$css .= "  --helloturbo-site-bg: {$site_bg};\n";
	$css .= "  --helloturbo-content-bg: {$content_bg};\n";
	if ( 'full-width' === $container_width ) {
		$css .= "  --helloturbo-container: 100%;\n";
	} else {
		$css .= '  --helloturbo-container: ' . absint( $container_width ) . "px;\n";
	}
	$css .= "  --helloturbo-font-body: {$body_stack};\n";
	$css .= "  --helloturbo-font-heading: {$heading_stack};\n";
	$css .= "  --helloturbo-body-size: {$body_size}px;\n";
	$css .= "  --helloturbo-body-lh: {$body_lh};\n";
	$css .= "  --helloturbo-body-weight: {$body_weight};\n";
	$css .= "  --helloturbo-heading-weight: {$heading_weight};\n";
	$css .= "  --helloturbo-heading-lh: {$heading_lh};\n";

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
		$size = helloturbo_theme_int_mod( "helloturbo_{$tag}_font_size", $def );
		$css .= "  --helloturbo-{$tag}-size: {$size}px;\n";
	}

	// Button vars.
	$css .= '  --helloturbo-btn-color: ' . helloturbo_theme_color_mod( 'helloturbo_btn_color', '#ffffff' ) . ";\n";
	$css .= '  --helloturbo-btn-bg: ' . helloturbo_theme_color_mod( 'helloturbo_btn_bg', '#2563eb' ) . ";\n";
	$css .= '  --helloturbo-btn-hover-color: ' . helloturbo_theme_color_mod( 'helloturbo_btn_hover_color', '#ffffff' ) . ";\n";
	$css .= '  --helloturbo-btn-hover-bg: ' . helloturbo_theme_color_mod( 'helloturbo_btn_hover_bg', '#1e40af' ) . ";\n";
	$css .= '  --helloturbo-btn-radius: ' . helloturbo_theme_int_mod( 'helloturbo_btn_radius', 4 ) . "px;\n";
	$css .= '  --helloturbo-btn-padding: ' . helloturbo_theme_int_mod( 'helloturbo_btn_padding_v', 12 ) . 'px ' . helloturbo_theme_int_mod( 'helloturbo_btn_padding_h', 24 ) . "px;\n";
	$css .= '  --helloturbo-btn-font-size: ' . helloturbo_theme_int_mod( 'helloturbo_btn_font_size', 15 ) . "px;\n";
	$css .= '  --helloturbo-btn-weight: ' . helloturbo_theme_weight_mod( 'helloturbo_btn_font_weight', '500' ) . ";\n";

	// Header vars.
	$css .= '  --helloturbo-header-height: ' . helloturbo_theme_int_mod( 'helloturbo_header_height', 70 ) . "px;\n";
	$css .= '  --helloturbo-header-bg: ' . helloturbo_theme_color_mod( 'helloturbo_header_bg', '#ffffff' ) . ";\n";
	$css .= '  --helloturbo-menu-color: ' . helloturbo_theme_color_mod( 'helloturbo_menu_color', '#1f2937' ) . ";\n";
	$css .= '  --helloturbo-menu-hover: ' . helloturbo_theme_color_mod( 'helloturbo_menu_hover_color', '#2563eb' ) . ";\n";
	$css .= '  --helloturbo-mobile-break: ' . helloturbo_theme_int_mod( 'helloturbo_mobile_breakpoint', 992 ) . "px;\n";
	$css .= "}\n";

	// --- Header ---
	$header_border       = helloturbo_theme_int_mod( 'helloturbo_header_border_bottom', 1 );
	$header_border_color = helloturbo_theme_color_mod( 'helloturbo_header_border_color', '#e5e7eb' );
	$css                .= ".helloturbo-header { min-height: var(--helloturbo-header-height); background: var(--helloturbo-header-bg); border-bottom: {$header_border}px solid {$header_border_color}; }\n";

	// Sticky.
	if ( get_theme_mod( 'helloturbo_sticky_header', false ) ) {
		$css .= ".helloturbo-header { position: sticky; top: 0; z-index: 999; }\n";
	}

	// Transparent.
	if ( get_theme_mod( 'helloturbo_transparent_header', false ) ) {
		$css .= ".helloturbo-header { position: absolute; width: 100%; background: transparent; border-bottom: none; }\n";
	}

	// Above header.
	if ( get_theme_mod( 'helloturbo_above_header_enable', false ) ) {
		$ah_bg    = helloturbo_theme_color_mod( 'helloturbo_above_header_bg', '#f3f4f6' );
		$ah_color = helloturbo_theme_color_mod( 'helloturbo_above_header_text_color', '#6b7280' );
		$ah_h     = helloturbo_theme_int_mod( 'helloturbo_above_header_height', 40 );
		$ah_bb    = helloturbo_theme_int_mod( 'helloturbo_above_header_border_bottom', 1 );
		$ah_bc    = helloturbo_theme_color_mod( 'helloturbo_above_header_border_color', '#e5e7eb' );
		$css     .= ".helloturbo-above-header { display: flex; min-height: {$ah_h}px; background: {$ah_bg}; color: {$ah_color}; border-bottom: {$ah_bb}px solid {$ah_bc}; }\n";
	}

	// Below header.
	if ( get_theme_mod( 'helloturbo_below_header_enable', false ) ) {
		$bh_bg = helloturbo_theme_color_mod( 'helloturbo_below_header_bg', '#ffffff' );
		$bh_h  = helloturbo_theme_int_mod( 'helloturbo_below_header_height', 50 );
		$css  .= ".helloturbo-below-header { display: flex; align-items: center; min-height: {$bh_h}px; background: {$bh_bg}; }\n";
	}

	// Menu.
	$menu_size      = helloturbo_theme_int_mod( 'helloturbo_menu_font_size', 15 );
	$menu_weight    = helloturbo_theme_weight_mod( 'helloturbo_menu_font_weight', '500' );
	$menu_transform = get_theme_mod( 'helloturbo_menu_text_transform', 'none' );
	if ( ! in_array( $menu_transform, array( 'none', 'capitalize', 'uppercase', 'lowercase' ), true ) ) {
		$menu_transform = 'none';
	}
	$css .= ".helloturbo-nav-menu > li > a { font-size: {$menu_size}px; font-weight: {$menu_weight}; text-transform: {$menu_transform}; color: var(--helloturbo-menu-color); }\n";
	$css .= ".helloturbo-nav-menu > li > a:hover, .helloturbo-nav-menu > li.current-menu-item > a { color: var(--helloturbo-menu-hover); }\n";

	// Submenu.
	$submenu_bg          = helloturbo_theme_color_mod( 'helloturbo_submenu_bg', '#ffffff' );
	$submenu_color       = helloturbo_theme_color_mod( 'helloturbo_submenu_color', '#374151' );
	$submenu_hover_color = helloturbo_theme_color_mod( 'helloturbo_submenu_hover_color', '#2563eb' );
	$submenu_hover_bg    = helloturbo_theme_color_mod( 'helloturbo_submenu_hover_bg', '#f9fafb' );
	$css                .= ".helloturbo-nav-menu .sub-menu { background: {$submenu_bg}; }\n";
	$css                .= ".helloturbo-nav-menu .sub-menu a { color: {$submenu_color}; }\n";
	$css                .= ".helloturbo-nav-menu .sub-menu a:hover { color: {$submenu_hover_color}; background: {$submenu_hover_bg}; }\n";

	// Mobile menu.
	$hamburger_color = helloturbo_theme_color_mod( 'helloturbo_hamburger_color', '#111827' );
	$mobile_menu_bg  = helloturbo_theme_color_mod( 'helloturbo_mobile_menu_bg', '#ffffff' );
	$mobile_menu_clr = helloturbo_theme_color_mod( 'helloturbo_mobile_menu_color', '#1f2937' );
	$css            .= ".helloturbo-hamburger { background: {$hamburger_color}; }\n";
	$css            .= ".helloturbo-main-navigation.is-open .helloturbo-nav-menu { background: {$mobile_menu_bg}; }\n";
	$css            .= ".helloturbo-main-navigation.is-open .helloturbo-nav-menu > li > a { color: {$mobile_menu_clr}; }\n";

	// --- Footer ---
	if ( get_theme_mod( 'helloturbo_footer_widgets_enable', true ) ) {
		$fw_bg      = helloturbo_theme_color_mod( 'helloturbo_footer_widgets_bg', '#1f2937' );
		$fw_text    = helloturbo_theme_color_mod( 'helloturbo_footer_widgets_text', '#d1d5db' );
		$fw_heading = helloturbo_theme_color_mod( 'helloturbo_footer_widgets_heading', '#ffffff' );
		$fw_link    = helloturbo_theme_color_mod( 'helloturbo_footer_widgets_link', '#93c5fd' );
		$fw_padding = helloturbo_theme_int_mod( 'helloturbo_footer_widgets_padding', 60 );
		$css       .= ".helloturbo-footer-widgets { background: {$fw_bg}; color: {$fw_text}; padding: {$fw_padding}px 0; }\n";
		$css       .= ".helloturbo-footer-widgets .widget-title { color: {$fw_heading}; }\n";
		$css       .= ".helloturbo-footer-widgets a { color: {$fw_link}; }\n";
		$css       .= '.helloturbo-footer-widgets a:hover { color: ' . helloturbo_theme_color_mod( 'helloturbo_footer_widgets_link_hover', '#ffffff' ) . "; }\n";
	}

	// Footer bar.
	$fb_bg      = helloturbo_theme_color_mod( 'helloturbo_footer_bar_bg', '#111827' );
	$fb_color   = helloturbo_theme_color_mod( 'helloturbo_footer_bar_text_color', '#9ca3af' );
	$fb_link    = helloturbo_theme_color_mod( 'helloturbo_footer_bar_link_color', '#93c5fd' );
	$fb_padding = helloturbo_theme_int_mod( 'helloturbo_footer_bar_padding', 15 );
	$fb_bt      = helloturbo_theme_int_mod( 'helloturbo_footer_bar_border_top', 1 );
	$fb_bc      = helloturbo_theme_color_mod( 'helloturbo_footer_bar_border_color', '#374151' );
	$css       .= ".helloturbo-footer-bar { background: {$fb_bg}; color: {$fb_color}; padding: {$fb_padding}px 0; border-top: {$fb_bt}px solid {$fb_bc}; }\n";
	$css       .= ".helloturbo-footer-bar a { color: {$fb_link}; }\n";
	$css       .= '.helloturbo-footer-bar a:hover { color: ' . helloturbo_theme_color_mod( 'helloturbo_footer_bar_link_hover', '#ffffff' ) . "; }\n";

	// --- Content / Container ---
	$content_padding_top    = helloturbo_theme_int_mod( 'helloturbo_content_padding_top', 40 );
	$content_padding_bottom = helloturbo_theme_int_mod( 'helloturbo_content_padding_bottom', 40 );
	$css                   .= ".helloturbo-site-content { padding-top: {$content_padding_top}px; padding-bottom: {$content_padding_bottom}px; }\n";

	// Sidebar width.
	$sidebar_width = helloturbo_theme_int_mod( 'helloturbo_sidebar_width', 30 );
	$sidebar_width = max( 0, min( 100, $sidebar_width ) );
	$content_width = 100 - $sidebar_width;
	$css          .= ".helloturbo-has-sidebar .helloturbo-main-content { width: {$content_width}%; }\n";
	$css          .= ".helloturbo-has-sidebar .helloturbo-sidebar { width: {$sidebar_width}%; }\n";

	// Boxed layout.
	if ( 'boxed' === get_theme_mod( 'helloturbo_site_layout', 'full-width' ) ) {
		$css .= "body { background: var(--helloturbo-light-bg); }\n";
		$css .= ".helloturbo-site { max-width: var(--helloturbo-container); margin: 0 auto; background: var(--helloturbo-site-bg); box-shadow: 0 0 20px rgba(0,0,0,0.05); }\n";
	}

	// Narrow layout.
	$narrow = helloturbo_theme_int_mod( 'helloturbo_narrow_width', 750 );
	$css   .= ".helloturbo-narrow .helloturbo-main-content { max-width: {$narrow}px; margin: 0 auto; }\n";

	wp_add_inline_style( 'helloturbo-style', $css );
}
add_action( 'wp_enqueue_scripts', 'helloturbo_dynamic_css', 20 );

/**
 * Customizer preview JS for live updates.
 */
function helloturbo_customizer_preview_js() {
	wp_enqueue_script(
		'helloturbo-customizer-preview',
		HELLOTURBO_THEME_URI . '/assets/js/customizer-preview.js',
		array( 'customize-preview' ),
		HELLOTURBO_THEME_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'helloturbo_customizer_preview_js' );
