<?php
/**
 * Elementor compatibility module.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Elementor locations for Theme Builder support.
 *
 * @param \ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager Elementor locations manager.
 */
function helloturbo_theme_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'helloturbo_theme_elementor_locations' );

/**
 * Add theme support for Elementor header/footer.
 * Works with Header Footer Builder for Elementor plugin.
 */
function helloturbo_theme_elementor_header_footer_support() {
	// Check if Header Footer Builder plugin is active.
	if ( ! function_exists( 'hfe_render_header' ) ) {
		return;
	}

	// Override theme header with HFE header.
	add_action( 'helloturbo_theme_before_header', 'helloturbo_theme_render_hfe_header', 5 );
	add_action( 'helloturbo_theme_after_footer', 'helloturbo_theme_render_hfe_footer', 5 );
}
add_action( 'wp', 'helloturbo_theme_elementor_header_footer_support' );

/**
 * Render HFE header and hide default theme header.
 */
function helloturbo_theme_render_hfe_header() {
	if ( function_exists( 'hfe_render_header' ) && hfe_header_enabled() ) {
		// Add a filter to skip the default header.
		add_filter( 'helloturbo_theme_show_default_header', '__return_false' );
		hfe_render_header();
	}
}

/**
 * Render HFE footer and hide default theme footer.
 */
function helloturbo_theme_render_hfe_footer() {
	if ( function_exists( 'hfe_render_footer' ) && hfe_footer_enabled() ) {
		// Add a filter to skip the default footer.
		add_filter( 'helloturbo_theme_show_default_footer', '__return_false' );
		hfe_render_footer();
	}
}

/**
 * Disable default sidebar on Elementor pages.
 *
 * @param bool $show_sidebar Whether to show the sidebar.
 * @return bool
 */
function helloturbo_theme_elementor_disable_sidebar( $show_sidebar ) {
	if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
		return $show_sidebar;
	}

	if ( \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() ) ) {
		return false;
	}

	return $show_sidebar;
}
add_filter( 'helloturbo_theme_show_sidebar', 'helloturbo_theme_elementor_disable_sidebar' );

/**
 * Add Elementor-specific body classes.
 *
 * @param array $classes Body classes.
 * @return array
 */
function helloturbo_theme_elementor_classes( $classes ) {
	if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
		return $classes;
	}

	// Check if using Elementor canvas template.
	$page_template = get_page_template_slug();
	if ( 'page-templates/template-canvas.php' === $page_template ) {
		$classes[] = 'helloturbo-elementor-canvas';
	}

	if ( 'page-templates/template-elementor-fullwidth.php' === $page_template ) {
		$classes[] = 'helloturbo-elementor-full-width';
	}

	return $classes;
}
add_filter( 'body_class', 'helloturbo_theme_elementor_classes' );

/**
 * Ensure Elementor container width matches theme settings.
 */
function helloturbo_theme_elementor_container_width() {
	if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
		return;
	}

	$container_width = get_theme_mod( 'helloturbo_container_width', '1200' );

	if ( 'full-width' === $container_width ) {
		$css = '.elementor-section.elementor-section-boxed > .elementor-container { max-width: 100%; }';
	} else {
		$css = sprintf(
			'.elementor-section.elementor-section-boxed > .elementor-container { max-width: %dpx; }',
			absint( $container_width )
		);
	}

	wp_add_inline_style( 'helloturbo-style', $css );
}
add_action( 'wp_enqueue_scripts', 'helloturbo_theme_elementor_container_width', 20 );
