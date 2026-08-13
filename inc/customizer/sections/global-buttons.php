<?php
/**
 * Global Buttons — Colors, border-radius, padding, typography.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function turbo_customizer_global_buttons( $wp_customize ) {

	$wp_customize->add_section( 'turbo_global_buttons', array(
		'title'    => __( 'Buttons', 'helloturbo' ),
		'panel'    => 'turbo_global',
		'priority' => 30,
	) );

	// Colors.
	$btn_colors = array(
		'turbo_btn_color'       => array( '#ffffff', __( 'Button Text Color', 'helloturbo' ) ),
		'turbo_btn_bg'          => array( '#2563eb', __( 'Button Background', 'helloturbo' ) ),
		'turbo_btn_hover_color' => array( '#ffffff', __( 'Button Hover Text', 'helloturbo' ) ),
		'turbo_btn_hover_bg'    => array( '#1e40af', __( 'Button Hover Background', 'helloturbo' ) ),
		'turbo_btn_border_color'      => array( '#2563eb', __( 'Button Border Color', 'helloturbo' ) ),
		'turbo_btn_hover_border_color' => array( '#1e40af', __( 'Button Hover Border', 'helloturbo' ) ),
	);

	foreach ( $btn_colors as $id => $data ) {
		$wp_customize->add_setting( $id, array(
			'default' => $data[0], 'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, $id, array(
				'label'   => $data[1],
				'section' => 'turbo_global_buttons',
			)
		) );
	}

	// Border radius.
	$wp_customize->add_setting( 'turbo_btn_radius', array(
		'default' => 4, 'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'turbo_btn_radius', array(
		'label'       => __( 'Border Radius (px)', 'helloturbo' ),
		'section'     => 'turbo_global_buttons',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 0, 'max' => 50, 'step' => 1 ),
	) );

	// Border width.
	$wp_customize->add_setting( 'turbo_btn_border_width', array(
		'default' => 0, 'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'turbo_btn_border_width', array(
		'label'       => __( 'Border Width (px)', 'helloturbo' ),
		'section'     => 'turbo_global_buttons',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 0, 'max' => 10, 'step' => 1 ),
	) );

	// Padding.
	$wp_customize->add_setting( 'turbo_btn_padding_v', array(
		'default' => 12, 'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'turbo_btn_padding_v', array(
		'label'       => __( 'Button Vertical Padding (px)', 'helloturbo' ),
		'section'     => 'turbo_global_buttons',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 4, 'max' => 40, 'step' => 1 ),
	) );

	$wp_customize->add_setting( 'turbo_btn_padding_h', array(
		'default' => 24, 'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'turbo_btn_padding_h', array(
		'label'       => __( 'Button Horizontal Padding (px)', 'helloturbo' ),
		'section'     => 'turbo_global_buttons',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 8, 'max' => 60, 'step' => 1 ),
	) );

	// Font size.
	$wp_customize->add_setting( 'turbo_btn_font_size', array(
		'default' => 15, 'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'turbo_btn_font_size', array(
		'label'       => __( 'Button Font Size (px)', 'helloturbo' ),
		'section'     => 'turbo_global_buttons',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 10, 'max' => 28, 'step' => 1 ),
	) );

	// Font weight.
	$wp_customize->add_setting( 'turbo_btn_font_weight', array(
		'default' => '500', 'sanitize_callback' => 'turbo_sanitize_font_weight',
	) );
	$wp_customize->add_control( 'turbo_btn_font_weight', array(
		'label'   => __( 'Button Font Weight', 'helloturbo' ),
		'section' => 'turbo_global_buttons',
		'type'    => 'select',
		'choices' => array(
			'400' => '400', '500' => '500', '600' => '600', '700' => '700',
		),
	) );

	// Text transform.
	$wp_customize->add_setting( 'turbo_btn_text_transform', array(
		'default' => 'none', 'sanitize_callback' => 'turbo_sanitize_text_transform',
	) );
	$wp_customize->add_control( 'turbo_btn_text_transform', array(
		'label'   => __( 'Button Text Transform', 'helloturbo' ),
		'section' => 'turbo_global_buttons',
		'type'    => 'select',
		'choices' => array(
			'none' => 'None', 'capitalize' => 'Capitalize', 'uppercase' => 'Uppercase',
		),
	) );
}
add_action( 'customize_register', 'turbo_customizer_global_buttons' );
