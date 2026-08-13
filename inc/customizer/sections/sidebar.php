<?php
/**
 * Sidebar settings — position, width, per-content-type overrides.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function turbo_customizer_sidebar( $wp_customize ) {

	$wp_customize->add_section( 'turbo_sidebar', array(
		'title'    => __( 'Sidebar', 'helloturbo' ),
		'priority' => 28,
	) );

	// Default sidebar position.
	$wp_customize->add_setting( 'turbo_sidebar_default', array(
		'default' => 'right', 'sanitize_callback' => 'turbo_sanitize_select',
	) );
	$wp_customize->add_control( 'turbo_sidebar_default', array(
		'label'   => __( 'Default Sidebar Position', 'helloturbo' ),
		'section' => 'turbo_sidebar',
		'type'    => 'select',
		'choices' => array(
			'right' => __( 'Right Sidebar', 'helloturbo' ),
			'left'  => __( 'Left Sidebar', 'helloturbo' ),
			'none'  => __( 'No Sidebar', 'helloturbo' ),
		),
	) );

	// Sidebar width.
	$wp_customize->add_setting( 'turbo_sidebar_width', array(
		'default' => 30, 'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'turbo_sidebar_width', array(
		'label'       => __( 'Sidebar Width (%)', 'helloturbo' ),
		'section'     => 'turbo_sidebar',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 15, 'max' => 50, 'step' => 1 ),
	) );

	// Page sidebar.
	$wp_customize->add_setting( 'turbo_sidebar_page', array(
		'default' => 'none', 'sanitize_callback' => 'turbo_sanitize_select',
	) );
	$wp_customize->add_control( 'turbo_sidebar_page', array(
		'label'   => __( 'Pages Sidebar', 'helloturbo' ),
		'section' => 'turbo_sidebar',
		'type'    => 'select',
		'choices' => array(
			'default' => __( 'Use Default', 'helloturbo' ),
			'right'   => __( 'Right', 'helloturbo' ),
			'left'    => __( 'Left', 'helloturbo' ),
			'none'    => __( 'No Sidebar', 'helloturbo' ),
		),
	) );

	// Single post sidebar.
	$wp_customize->add_setting( 'turbo_sidebar_single', array(
		'default' => 'right', 'sanitize_callback' => 'turbo_sanitize_select',
	) );
	$wp_customize->add_control( 'turbo_sidebar_single', array(
		'label'   => __( 'Single Post Sidebar', 'helloturbo' ),
		'section' => 'turbo_sidebar',
		'type'    => 'select',
		'choices' => array(
			'default' => __( 'Use Default', 'helloturbo' ),
			'right'   => __( 'Right', 'helloturbo' ),
			'left'    => __( 'Left', 'helloturbo' ),
			'none'    => __( 'No Sidebar', 'helloturbo' ),
		),
	) );

	// Archive sidebar.
	$wp_customize->add_setting( 'turbo_sidebar_archive', array(
		'default' => 'right', 'sanitize_callback' => 'turbo_sanitize_select',
	) );
	$wp_customize->add_control( 'turbo_sidebar_archive', array(
		'label'   => __( 'Archive / Blog Sidebar', 'helloturbo' ),
		'section' => 'turbo_sidebar',
		'type'    => 'select',
		'choices' => array(
			'default' => __( 'Use Default', 'helloturbo' ),
			'right'   => __( 'Right', 'helloturbo' ),
			'left'    => __( 'Left', 'helloturbo' ),
			'none'    => __( 'No Sidebar', 'helloturbo' ),
		),
	) );

	// WooCommerce sidebar.
	$wp_customize->add_setting( 'turbo_sidebar_woo', array(
		'default' => 'none', 'sanitize_callback' => 'turbo_sanitize_select',
	) );
	$wp_customize->add_control( 'turbo_sidebar_woo', array(
		'label'   => __( 'WooCommerce Sidebar', 'helloturbo' ),
		'section' => 'turbo_sidebar',
		'type'    => 'select',
		'choices' => array(
			'default' => __( 'Use Default', 'helloturbo' ),
			'right'   => __( 'Right', 'helloturbo' ),
			'left'    => __( 'Left', 'helloturbo' ),
			'none'    => __( 'No Sidebar', 'helloturbo' ),
		),
	) );

	// Sticky sidebar.
	$wp_customize->add_setting( 'turbo_sidebar_sticky', array(
		'default' => false, 'sanitize_callback' => 'turbo_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'turbo_sidebar_sticky', array(
		'label'   => __( 'Enable Sticky Sidebar', 'helloturbo' ),
		'section' => 'turbo_sidebar',
		'type'    => 'checkbox',
	) );
}
add_action( 'customize_register', 'turbo_customizer_sidebar' );
