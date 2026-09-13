<?php
/**
 * Header Builder — Above Header, Primary Header, Below Header.
 * Each row has design controls (height, bg, border, padding).
 * Primary header has Logo, Menu, Search, Button, HTML elements.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Builder settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function helloturbo_customizer_header_builder( $wp_customize ) {

	// =============================================
	// Section: Above Header Row
	// =============================================
	$wp_customize->add_section(
		'helloturbo_above_header',
		array(
			'title'    => __( 'Above Header', 'helloturbo' ),
			'panel'    => 'helloturbo_header_builder',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'helloturbo_above_header_enable',
		array(
			'default'           => false,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_above_header_enable',
		array(
			'label'   => __( 'Enable Above Header', 'helloturbo' ),
			'section' => 'helloturbo_above_header',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_above_header_height',
		array(
			'default'           => 40,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_above_header_height',
		array(
			'label'       => __( 'Height (px)', 'helloturbo' ),
			'section'     => 'helloturbo_above_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 20,
				'max' => 100,
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_above_header_bg',
		array(
			'default'           => '#f3f4f6',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_above_header_bg',
			array(
				'label'   => __( 'Background Color', 'helloturbo' ),
				'section' => 'helloturbo_above_header',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_above_header_text_color',
		array(
			'default'           => '#6b7280',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_above_header_text_color',
			array(
				'label'   => __( 'Text Color', 'helloturbo' ),
				'section' => 'helloturbo_above_header',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_above_header_left',
		array(
			'default'           => 'text',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_above_header_left',
		array(
			'label'   => __( 'Left Section Content', 'helloturbo' ),
			'section' => 'helloturbo_above_header',
			'type'    => 'select',
			'choices' => array(
				'none'   => __( 'None', 'helloturbo' ),
				'text'   => __( 'Custom Text / HTML', 'helloturbo' ),
				'menu'   => __( 'Menu', 'helloturbo' ),
				'social' => __( 'Social Icons', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_above_header_left_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'helloturbo_above_header_left_text',
		array(
			'label'   => __( 'Left Section Text', 'helloturbo' ),
			'section' => 'helloturbo_above_header',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_above_header_right',
		array(
			'default'           => 'text',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_above_header_right',
		array(
			'label'   => __( 'Right Section Content', 'helloturbo' ),
			'section' => 'helloturbo_above_header',
			'type'    => 'select',
			'choices' => array(
				'none'   => __( 'None', 'helloturbo' ),
				'text'   => __( 'Custom Text / HTML', 'helloturbo' ),
				'menu'   => __( 'Menu', 'helloturbo' ),
				'social' => __( 'Social Icons', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_above_header_right_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'helloturbo_above_header_right_text',
		array(
			'label'   => __( 'Right Section Text', 'helloturbo' ),
			'section' => 'helloturbo_above_header',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_above_header_border_bottom',
		array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_above_header_border_bottom',
		array(
			'label'       => __( 'Bottom Border Width (px)', 'helloturbo' ),
			'section'     => 'helloturbo_above_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 0,
				'max' => 5,
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_above_header_border_color',
		array(
			'default'           => '#e5e7eb',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_above_header_border_color',
			array(
				'label'   => __( 'Border Color', 'helloturbo' ),
				'section' => 'helloturbo_above_header',
			)
		)
	);

	// =============================================
	// Section: Primary Header
	// =============================================
	$wp_customize->add_section(
		'helloturbo_primary_header',
		array(
			'title'    => __( 'Primary Header', 'helloturbo' ),
			'panel'    => 'helloturbo_header_builder',
			'priority' => 20,
		)
	);

	$wp_customize->add_setting(
		'helloturbo_header_layout',
		array(
			'default'           => 'logo-left',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_header_layout',
		array(
			'label'   => __( 'Header Layout', 'helloturbo' ),
			'section' => 'helloturbo_primary_header',
			'type'    => 'select',
			'choices' => array(
				'logo-left'   => __( 'Logo Left – Menu Right', 'helloturbo' ),
				'logo-center' => __( 'Logo Center – Menu Below', 'helloturbo' ),
				'logo-right'  => __( 'Menu Left – Logo Right', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_header_width',
		array(
			'default'           => 'contained',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_header_width',
		array(
			'label'   => __( 'Header Width', 'helloturbo' ),
			'section' => 'helloturbo_primary_header',
			'type'    => 'select',
			'choices' => array(
				'contained'  => __( 'Contained', 'helloturbo' ),
				'full-width' => __( 'Full Width', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_header_height',
		array(
			'default'           => 70,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_header_height',
		array(
			'label'       => __( 'Header Height (px)', 'helloturbo' ),
			'section'     => 'helloturbo_primary_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 40,
				'max'  => 200,
				'step' => 5,
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_header_bg',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_header_bg',
			array(
				'label'   => __( 'Header Background', 'helloturbo' ),
				'section' => 'helloturbo_primary_header',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_header_border_bottom',
		array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_header_border_bottom',
		array(
			'label'       => __( 'Bottom Border (px)', 'helloturbo' ),
			'section'     => 'helloturbo_primary_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 0,
				'max' => 5,
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_header_border_color',
		array(
			'default'           => '#e5e7eb',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_header_border_color',
			array(
				'label'   => __( 'Border Color', 'helloturbo' ),
				'section' => 'helloturbo_primary_header',
			)
		)
	);

	// Sticky header.
	$wp_customize->add_setting(
		'helloturbo_sticky_header',
		array(
			'default'           => false,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_sticky_header',
		array(
			'label'   => __( 'Enable Sticky Header', 'helloturbo' ),
			'section' => 'helloturbo_primary_header',
			'type'    => 'checkbox',
		)
	);

	// Transparent header.
	$wp_customize->add_setting(
		'helloturbo_transparent_header',
		array(
			'default'           => false,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_transparent_header',
		array(
			'label'   => __( 'Enable Transparent Header', 'helloturbo' ),
			'section' => 'helloturbo_primary_header',
			'type'    => 'checkbox',
		)
	);

	// Menu Typography.
	$wp_customize->add_setting(
		'helloturbo_menu_font_size',
		array(
			'default'           => 15,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_menu_font_size',
		array(
			'label'       => __( 'Menu Font Size (px)', 'helloturbo' ),
			'section'     => 'helloturbo_primary_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 11,
				'max'  => 22,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_menu_font_weight',
		array(
			'default'           => '500',
			'sanitize_callback' => 'helloturbo_sanitize_font_weight',
		)
	);
	$wp_customize->add_control(
		'helloturbo_menu_font_weight',
		array(
			'label'   => __( 'Menu Font Weight', 'helloturbo' ),
			'section' => 'helloturbo_primary_header',
			'type'    => 'select',
			'choices' => array(
				'400' => '400',
				'500' => '500',
				'600' => '600',
				'700' => '700',
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_menu_text_transform',
		array(
			'default'           => 'none',
			'sanitize_callback' => 'helloturbo_sanitize_text_transform',
		)
	);
	$wp_customize->add_control(
		'helloturbo_menu_text_transform',
		array(
			'label'   => __( 'Menu Text Transform', 'helloturbo' ),
			'section' => 'helloturbo_primary_header',
			'type'    => 'select',
			'choices' => array(
				'none'       => 'None',
				'capitalize' => 'Capitalize',
				'uppercase'  => 'Uppercase',
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_menu_color',
		array(
			'default'           => '#1f2937',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_menu_color',
			array(
				'label'   => __( 'Menu Link Color', 'helloturbo' ),
				'section' => 'helloturbo_primary_header',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_menu_hover_color',
		array(
			'default'           => '#2563eb',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_menu_hover_color',
			array(
				'label'   => __( 'Menu Link Hover Color', 'helloturbo' ),
				'section' => 'helloturbo_primary_header',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_menu_active_color',
		array(
			'default'           => '#2563eb',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_menu_active_color',
			array(
				'label'   => __( 'Menu Active Color', 'helloturbo' ),
				'section' => 'helloturbo_primary_header',
			)
		)
	);

	// Submenu.
	$wp_customize->add_setting(
		'helloturbo_submenu_bg',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_submenu_bg',
			array(
				'label'   => __( 'Submenu Background', 'helloturbo' ),
				'section' => 'helloturbo_primary_header',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_submenu_color',
		array(
			'default'           => '#374151',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_submenu_color',
			array(
				'label'   => __( 'Submenu Link Color', 'helloturbo' ),
				'section' => 'helloturbo_primary_header',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_submenu_hover_color',
		array(
			'default'           => '#2563eb',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_submenu_hover_color',
			array(
				'label'   => __( 'Submenu Link Hover', 'helloturbo' ),
				'section' => 'helloturbo_primary_header',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_submenu_hover_bg',
		array(
			'default'           => '#f9fafb',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_submenu_hover_bg',
			array(
				'label'   => __( 'Submenu Hover Background', 'helloturbo' ),
				'section' => 'helloturbo_primary_header',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_submenu_border',
		array(
			'default'           => true,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_submenu_border',
		array(
			'label'   => __( 'Show Submenu Border', 'helloturbo' ),
			'section' => 'helloturbo_primary_header',
			'type'    => 'checkbox',
		)
	);

	// Header button (CTA).
	$wp_customize->add_setting(
		'helloturbo_header_button_enable',
		array(
			'default'           => false,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_header_button_enable',
		array(
			'label'   => __( 'Show Header CTA Button', 'helloturbo' ),
			'section' => 'helloturbo_primary_header',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_header_button_text',
		array(
			'default'           => __( 'Get Started', 'helloturbo' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'helloturbo_header_button_text',
		array(
			'label'   => __( 'Button Text', 'helloturbo' ),
			'section' => 'helloturbo_primary_header',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_header_button_url',
		array(
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'helloturbo_header_button_url',
		array(
			'label'   => __( 'Button URL', 'helloturbo' ),
			'section' => 'helloturbo_primary_header',
			'type'    => 'url',
		)
	);

	// Header search.
	$wp_customize->add_setting(
		'helloturbo_header_search',
		array(
			'default'           => false,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_header_search',
		array(
			'label'   => __( 'Show Search Icon', 'helloturbo' ),
			'section' => 'helloturbo_primary_header',
			'type'    => 'checkbox',
		)
	);

	// =============================================
	// Section: Below Header Row
	// =============================================
	$wp_customize->add_section(
		'helloturbo_below_header',
		array(
			'title'    => __( 'Below Header', 'helloturbo' ),
			'panel'    => 'helloturbo_header_builder',
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'helloturbo_below_header_enable',
		array(
			'default'           => false,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_below_header_enable',
		array(
			'label'   => __( 'Enable Below Header', 'helloturbo' ),
			'section' => 'helloturbo_below_header',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_below_header_height',
		array(
			'default'           => 50,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_below_header_height',
		array(
			'label'       => __( 'Height (px)', 'helloturbo' ),
			'section'     => 'helloturbo_below_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 20,
				'max' => 120,
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_below_header_bg',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_below_header_bg',
			array(
				'label'   => __( 'Background Color', 'helloturbo' ),
				'section' => 'helloturbo_below_header',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_below_header_content',
		array(
			'default'           => 'menu',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_below_header_content',
		array(
			'label'   => __( 'Content', 'helloturbo' ),
			'section' => 'helloturbo_below_header',
			'type'    => 'select',
			'choices' => array(
				'none' => __( 'None', 'helloturbo' ),
				'menu' => __( 'Secondary Menu', 'helloturbo' ),
				'text' => __( 'Custom Text / HTML', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_below_header_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'helloturbo_below_header_text',
		array(
			'label'   => __( 'Custom Text', 'helloturbo' ),
			'section' => 'helloturbo_below_header',
			'type'    => 'textarea',
		)
	);

	// =============================================
	// Section: Mobile Header
	// =============================================
	$wp_customize->add_section(
		'helloturbo_mobile_header',
		array(
			'title'    => __( 'Mobile Header', 'helloturbo' ),
			'panel'    => 'helloturbo_header_builder',
			'priority' => 40,
		)
	);

	$wp_customize->add_setting(
		'helloturbo_mobile_breakpoint',
		array(
			'default'           => 992,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_mobile_breakpoint',
		array(
			'label'       => __( 'Mobile Breakpoint (px)', 'helloturbo' ),
			'section'     => 'helloturbo_mobile_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 600,
				'max'  => 1200,
				'step' => 10,
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_mobile_menu_style',
		array(
			'default'           => 'dropdown',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_mobile_menu_style',
		array(
			'label'   => __( 'Mobile Menu Style', 'helloturbo' ),
			'section' => 'helloturbo_mobile_header',
			'type'    => 'select',
			'choices' => array(
				'dropdown'   => __( 'Dropdown', 'helloturbo' ),
				'fullscreen' => __( 'Full Screen', 'helloturbo' ),
				'sidebar'    => __( 'Off Canvas (Sidebar)', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_mobile_menu_bg',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_mobile_menu_bg',
			array(
				'label'   => __( 'Mobile Menu Background', 'helloturbo' ),
				'section' => 'helloturbo_mobile_header',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_mobile_menu_color',
		array(
			'default'           => '#1f2937',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_mobile_menu_color',
			array(
				'label'   => __( 'Mobile Menu Link Color', 'helloturbo' ),
				'section' => 'helloturbo_mobile_header',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_hamburger_color',
		array(
			'default'           => '#111827',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_hamburger_color',
			array(
				'label'   => __( 'Hamburger Icon Color', 'helloturbo' ),
				'section' => 'helloturbo_mobile_header',
			)
		)
	);
}
add_action( 'customize_register', 'helloturbo_customizer_header_builder' );
