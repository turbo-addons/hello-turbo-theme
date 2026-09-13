<?php
/**
 * Breadcrumbs — Position, source, separator, styling.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Breadcrumbs settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function helloturbo_customizer_breadcrumbs( $wp_customize ) {

	$wp_customize->add_section(
		'helloturbo_breadcrumbs',
		array(
			'title'    => __( 'Breadcrumbs', 'helloturbo' ),
			'priority' => 32,
		)
	);

	$wp_customize->add_setting(
		'helloturbo_breadcrumbs_enable',
		array(
			'default'           => false,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_breadcrumbs_enable',
		array(
			'label'   => __( 'Enable Breadcrumbs', 'helloturbo' ),
			'section' => 'helloturbo_breadcrumbs',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_breadcrumbs_position',
		array(
			'default'           => 'after-header',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_breadcrumbs_position',
		array(
			'label'   => __( 'Position', 'helloturbo' ),
			'section' => 'helloturbo_breadcrumbs',
			'type'    => 'select',
			'choices' => array(
				'after-header' => __( 'After Header', 'helloturbo' ),
				'before-title' => __( 'Before Page Title', 'helloturbo' ),
				'inside-title' => __( 'Inside Title Banner', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_breadcrumbs_source',
		array(
			'default'           => 'built-in',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_breadcrumbs_source',
		array(
			'label'   => __( 'Breadcrumbs Source', 'helloturbo' ),
			'section' => 'helloturbo_breadcrumbs',
			'type'    => 'select',
			'choices' => array(
				'built-in' => __( 'Built-in', 'helloturbo' ),
				'yoast'    => __( 'Yoast SEO', 'helloturbo' ),
				'rankmath' => __( 'Rank Math', 'helloturbo' ),
				'navxt'    => __( 'Breadcrumb NavXT', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_breadcrumbs_separator',
		array(
			'default'           => '»',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'helloturbo_breadcrumbs_separator',
		array(
			'label'   => __( 'Separator Character', 'helloturbo' ),
			'section' => 'helloturbo_breadcrumbs',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_breadcrumbs_font_size',
		array(
			'default'           => 13,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_breadcrumbs_font_size',
		array(
			'label'       => __( 'Font Size (px)', 'helloturbo' ),
			'section'     => 'helloturbo_breadcrumbs',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 18,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_breadcrumbs_text_color',
		array(
			'default'           => '#6b7280',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_breadcrumbs_text_color',
			array(
				'label'   => __( 'Text Color', 'helloturbo' ),
				'section' => 'helloturbo_breadcrumbs',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_breadcrumbs_link_color',
		array(
			'default'           => '#2563eb',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_breadcrumbs_link_color',
			array(
				'label'   => __( 'Link Color', 'helloturbo' ),
				'section' => 'helloturbo_breadcrumbs',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_breadcrumbs_bg',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_breadcrumbs_bg',
			array(
				'label'   => __( 'Background Color', 'helloturbo' ),
				'section' => 'helloturbo_breadcrumbs',
			)
		)
	);

	// Hide on specific pages.
	$wp_customize->add_setting(
		'helloturbo_breadcrumbs_hide_home',
		array(
			'default'           => true,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_breadcrumbs_hide_home',
		array(
			'label'   => __( 'Hide on Homepage', 'helloturbo' ),
			'section' => 'helloturbo_breadcrumbs',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_breadcrumbs_hide_blog',
		array(
			'default'           => false,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_breadcrumbs_hide_blog',
		array(
			'label'   => __( 'Hide on Blog / Posts Page', 'helloturbo' ),
			'section' => 'helloturbo_breadcrumbs',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_breadcrumbs_hide_single',
		array(
			'default'           => false,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_breadcrumbs_hide_single',
		array(
			'label'   => __( 'Hide on Single Posts', 'helloturbo' ),
			'section' => 'helloturbo_breadcrumbs',
			'type'    => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'helloturbo_customizer_breadcrumbs' );
