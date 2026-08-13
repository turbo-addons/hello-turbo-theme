<?php
/**
 * Global Typography — Body, Headings (H1-H6), responsive sizes.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function turbo_customizer_global_typography( $wp_customize ) {

	$wp_customize->add_section( 'turbo_global_typography', array(
		'title'    => __( 'Typography', 'helloturbo' ),
		'panel'    => 'turbo_global',
		'priority' => 20,
	) );

	$fonts = turbo_font_stacks_list();

	// --- Body Typography ---
	$wp_customize->add_setting( 'turbo_body_font_family', array(
		'default' => 'system', 'sanitize_callback' => 'turbo_sanitize_select',
	) );
	$wp_customize->add_control( 'turbo_body_font_family', array(
		'label'   => __( 'Body Font Family', 'helloturbo' ),
		'section' => 'turbo_global_typography',
		'type'    => 'select',
		'choices' => $fonts,
	) );

	$wp_customize->add_setting( 'turbo_body_font_weight', array(
		'default' => '400', 'sanitize_callback' => 'turbo_sanitize_font_weight',
	) );
	$wp_customize->add_control( 'turbo_body_font_weight', array(
		'label'   => __( 'Body Font Weight', 'helloturbo' ),
		'section' => 'turbo_global_typography',
		'type'    => 'select',
		'choices' => array(
			'300' => '300 (Light)', '400' => '400 (Normal)',
			'500' => '500 (Medium)', '600' => '600 (Semi-Bold)',
			'700' => '700 (Bold)',
		),
	) );

	$wp_customize->add_setting( 'turbo_body_font_size', array(
		'default' => 16, 'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'turbo_body_font_size', array(
		'label'       => __( 'Body Font Size (px)', 'helloturbo' ),
		'section'     => 'turbo_global_typography',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 12, 'max' => 24, 'step' => 1 ),
	) );

	$wp_customize->add_setting( 'turbo_body_line_height', array(
		'default' => '1.65', 'sanitize_callback' => 'turbo_sanitize_number',
	) );
	$wp_customize->add_control( 'turbo_body_line_height', array(
		'label'       => __( 'Body Line Height', 'helloturbo' ),
		'section'     => 'turbo_global_typography',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 1, 'max' => 3, 'step' => 0.05 ),
	) );

	$wp_customize->add_setting( 'turbo_body_text_transform', array(
		'default' => 'none', 'sanitize_callback' => 'turbo_sanitize_text_transform',
	) );
	$wp_customize->add_control( 'turbo_body_text_transform', array(
		'label'   => __( 'Body Text Transform', 'helloturbo' ),
		'section' => 'turbo_global_typography',
		'type'    => 'select',
		'choices' => array(
			'none' => 'None', 'capitalize' => 'Capitalize',
			'uppercase' => 'Uppercase', 'lowercase' => 'Lowercase',
		),
	) );

	// --- Heading Typography ---
	$wp_customize->add_setting( 'turbo_heading_font_family', array(
		'default' => 'system', 'sanitize_callback' => 'turbo_sanitize_select',
	) );
	$wp_customize->add_control( 'turbo_heading_font_family', array(
		'label'   => __( 'Heading Font Family', 'helloturbo' ),
		'section' => 'turbo_global_typography',
		'type'    => 'select',
		'choices' => $fonts,
	) );

	$wp_customize->add_setting( 'turbo_heading_font_weight', array(
		'default' => '700', 'sanitize_callback' => 'turbo_sanitize_font_weight',
	) );
	$wp_customize->add_control( 'turbo_heading_font_weight', array(
		'label'   => __( 'Heading Font Weight', 'helloturbo' ),
		'section' => 'turbo_global_typography',
		'type'    => 'select',
		'choices' => array(
			'400' => '400', '500' => '500',
			'600' => '600', '700' => '700', '800' => '800', '900' => '900',
		),
	) );

	$wp_customize->add_setting( 'turbo_heading_text_transform', array(
		'default' => 'none', 'sanitize_callback' => 'turbo_sanitize_text_transform',
	) );
	$wp_customize->add_control( 'turbo_heading_text_transform', array(
		'label'   => __( 'Heading Text Transform', 'helloturbo' ),
		'section' => 'turbo_global_typography',
		'type'    => 'select',
		'choices' => array(
			'none' => 'None', 'capitalize' => 'Capitalize',
			'uppercase' => 'Uppercase', 'lowercase' => 'Lowercase',
		),
	) );

	$wp_customize->add_setting( 'turbo_heading_line_height', array(
		'default' => '1.3', 'sanitize_callback' => 'turbo_sanitize_number',
	) );
	$wp_customize->add_control( 'turbo_heading_line_height', array(
		'label'       => __( 'Heading Line Height', 'helloturbo' ),
		'section'     => 'turbo_global_typography',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 1, 'max' => 2.5, 'step' => 0.05 ),
	) );

	// --- Individual Heading Sizes (H1-H6) ---
	$heading_defaults = array(
		'h1' => 40, 'h2' => 32, 'h3' => 26,
		'h4' => 22, 'h5' => 18, 'h6' => 16,
	);

	foreach ( $heading_defaults as $tag => $default_size ) {
		$wp_customize->add_setting( "turbo_{$tag}_font_size", array(
			'default' => $default_size, 'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( "turbo_{$tag}_font_size", array(
			'label'       => sprintf( __( '%s Font Size (px)', 'helloturbo' ), strtoupper( $tag ) ),
			'section'     => 'turbo_global_typography',
			'type'        => 'number',
			'input_attrs' => array( 'min' => 10, 'max' => 100, 'step' => 1 ),
		) );
	}
}
add_action( 'customize_register', 'turbo_customizer_global_typography' );
