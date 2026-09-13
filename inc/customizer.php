<?php
/**
 * Turbo Theme Customizer — Astra-level options.
 *
 * Panels: Global, Header Builder, Footer Builder, Blog/Archive,
 *         Single Post, Sidebar, Page Layout, Performance.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load sub-modules.
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sanitize.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/helpers.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sections/global-colors.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sections/global-typography.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sections/global-buttons.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sections/global-container.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sections/header-builder.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sections/footer-builder.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sections/sidebar.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sections/blog-archive.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sections/single-post.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sections/page-layout.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sections/breadcrumbs.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/sections/social-icons.php';
require_once HELLOTURBO_THEME_DIR . '/inc/customizer/output.php';
