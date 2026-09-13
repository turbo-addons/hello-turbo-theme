<?php
/**
 * Global Colors — Color palette + surface colors.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Global colors settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function helloturbo_customizer_global_colors( $wp_customize ) {

	$wp_customize->add_section(
		'helloturbo_global_colors',
		array(
			'title'    => __( 'Colors', 'helloturbo' ),
			'panel'    => 'helloturbo_global',
			'priority' => 10,
		)
	);

	// --- Global Color Palette (9 slots like Astra) ---
	$palette_defaults = array(
		'#2563eb', // Primary.
		'#1e40af', // Secondary.
		'#111827', // Heading.
		'#1f2937', // Body text.
		'#6b7280', // Meta / muted.
		'#f9fafb', // Light background.
		'#ffffff', // White.
		'#f3f4f6', // Border/divider.
		'#e5e7eb', // Subtle border.
	);

	$palette_labels = array(
		__( 'Primary', 'helloturbo' ),
		__( 'Secondary', 'helloturbo' ),
		__( 'Heading', 'helloturbo' ),
		__( 'Body Text', 'helloturbo' ),
		__( 'Meta / Muted', 'helloturbo' ),
		__( 'Light Background', 'helloturbo' ),
		__( 'White', 'helloturbo' ),
		__( 'Border', 'helloturbo' ),
		__( 'Subtle Border', 'helloturbo' ),
	);

	for ( $i = 0; $i < 9; $i++ ) {
		$wp_customize->add_setting(
			"helloturbo_palette_color_{$i}",
			array(
				'default'           => $palette_defaults[ $i ],
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				"helloturbo_palette_color_{$i}",
				array(
					'label'   => $palette_labels[ $i ],
					'section' => 'helloturbo_global_colors',
				)
			)
		);
	}

	// --- Surface Colors ---
	$surfaces = array(
		'helloturbo_color_bg_site'    => array( '#ffffff', __( 'Site Background', 'helloturbo' ) ),
		'helloturbo_color_bg_content' => array( '#ffffff', __( 'Content Background', 'helloturbo' ) ),
		'helloturbo_color_link'       => array( '#2563eb', __( 'Link Color', 'helloturbo' ) ),
		'helloturbo_color_link_hover' => array( '#1e40af', __( 'Link Hover Color', 'helloturbo' ) ),
	);

	foreach ( $surfaces as $id => $data ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $data[0],
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$id,
				array(
					'label'   => $data[1],
					'section' => 'helloturbo_global_colors',
				)
			)
		);
	}
}
add_action( 'customize_register', 'helloturbo_customizer_global_colors' );
