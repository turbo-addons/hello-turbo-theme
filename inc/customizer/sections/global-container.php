<?php
/**
 * Global Container — Site-wide layout container settings.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Container settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function turbo_customizer_global_container( $wp_customize ) {

	$wp_customize->add_section(
		'turbo_global_container',
		array(
			'title'    => __( 'Container', 'helloturbo' ),
			'panel'    => 'turbo_global',
			'priority' => 40,
		)
	);

	// Site layout.
	$wp_customize->add_setting(
		'turbo_site_layout',
		array(
			'default'           => 'full-width',
			'sanitize_callback' => 'turbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'turbo_site_layout',
		array(
			'label'   => __( 'Site Layout', 'helloturbo' ),
			'section' => 'turbo_global_container',
			'type'    => 'select',
			'choices' => array(
				'full-width' => __( 'Full Width / Contained', 'helloturbo' ),
				'boxed'      => __( 'Boxed', 'helloturbo' ),
				'padded'     => __( 'Full Width / Padded', 'helloturbo' ),
			),
		)
	);

	// Container width.
	$wp_customize->add_setting(
		'turbo_container_width',
		array(
			'default'           => 1200,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'turbo_container_width',
		array(
			'label'       => __( 'Container Width (px)', 'helloturbo' ),
			'section'     => 'turbo_global_container',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 800,
				'max'  => 1920,
				'step' => 10,
			),
		)
	);

	// Content layout (default for all pages/posts).
	$wp_customize->add_setting(
		'turbo_default_content_layout',
		array(
			'default'           => 'normal',
			'sanitize_callback' => 'turbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'turbo_default_content_layout',
		array(
			'label'   => __( 'Default Content Layout', 'helloturbo' ),
			'section' => 'turbo_global_container',
			'type'    => 'select',
			'choices' => array(
				'normal'     => __( 'Normal (with container)', 'helloturbo' ),
				'narrow'     => __( 'Narrow', 'helloturbo' ),
				'full-width' => __( 'Full Width / Stretched', 'helloturbo' ),
			),
		)
	);

	// Narrow width.
	$wp_customize->add_setting(
		'turbo_narrow_width',
		array(
			'default'           => 750,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'turbo_narrow_width',
		array(
			'label'       => __( 'Narrow Content Width (px)', 'helloturbo' ),
			'section'     => 'turbo_global_container',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 500,
				'max'  => 1200,
				'step' => 10,
			),
		)
	);

	// Content top/bottom padding.
	$wp_customize->add_setting(
		'turbo_content_padding_top',
		array(
			'default'           => 40,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'turbo_content_padding_top',
		array(
			'label'       => __( 'Content Top Padding (px)', 'helloturbo' ),
			'section'     => 'turbo_global_container',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 200,
				'step' => 5,
			),
		)
	);

	$wp_customize->add_setting(
		'turbo_content_padding_bottom',
		array(
			'default'           => 40,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'turbo_content_padding_bottom',
		array(
			'label'       => __( 'Content Bottom Padding (px)', 'helloturbo' ),
			'section'     => 'turbo_global_container',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 200,
				'step' => 5,
			),
		)
	);
}
add_action( 'customize_register', 'turbo_customizer_global_container' );
