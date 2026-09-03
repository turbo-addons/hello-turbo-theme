<?php
/**
 * Customizer helper functions.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get system font stack.
 */
function turbo_system_font_stack() {
	return 'system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif';
}

/**
 * Available font family stacks (system fonts only, no external requests).
 */
function turbo_font_stacks_list() {
	return array(
		'system'    => 'System Default (Sans)',
		'helvetica' => 'Helvetica / Arial (Sans)',
		'georgia'   => 'Georgia (Serif)',
		'mono'      => 'Monospace',
	);
}

/**
 * Resolve a font stack key to its CSS font-family value.
 *
 * @param string $key Font stack key.
 * @return string CSS font-family value.
 */
function turbo_get_font_stack( $key ) {
	$stacks = array(
		'system'    => turbo_system_font_stack(),
		'helvetica' => '"Helvetica Neue", Helvetica, Arial, sans-serif',
		'georgia'   => 'Georgia, "Times New Roman", Times, serif',
		'mono'      => '"Courier New", Courier, monospace',
	);

	return isset( $stacks[ $key ] ) ? $stacks[ $key ] : turbo_system_font_stack();
}

/**
 * Register panels used across sections.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function turbo_register_customizer_panels( $wp_customize ) {
	$wp_customize->add_panel(
		'turbo_global',
		array(
			'title'    => __( 'Global', 'helloturbo' ),
			'priority' => 20,
		)
	);

	$wp_customize->add_panel(
		'turbo_header_builder',
		array(
			'title'    => __( 'Header Builder', 'helloturbo' ),
			'priority' => 25,
		)
	);

	$wp_customize->add_panel(
		'turbo_footer_builder',
		array(
			'title'    => __( 'Footer Builder', 'helloturbo' ),
			'priority' => 26,
		)
	);

	$wp_customize->add_panel(
		'turbo_blog',
		array(
			'title'    => __( 'Blog / Archive', 'helloturbo' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_panel(
		'turbo_single_post',
		array(
			'title'    => __( 'Single Post', 'helloturbo' ),
			'priority' => 31,
		)
	);
}
add_action( 'customize_register', 'turbo_register_customizer_panels', 5 );
