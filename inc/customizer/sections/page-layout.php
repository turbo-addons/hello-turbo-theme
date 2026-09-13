<?php
/**
 * Page Layout — Content width per content type, page title, etc.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Page layout settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function helloturbo_customizer_page_layout( $wp_customize ) {

	$wp_customize->add_section(
		'helloturbo_page_layout',
		array(
			'title'    => __( 'Page Layout', 'helloturbo' ),
			'priority' => 29,
		)
	);

	// Page content layout.
	$wp_customize->add_setting(
		'helloturbo_page_content_layout',
		array(
			'default'           => 'normal',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_page_content_layout',
		array(
			'label'   => __( 'Page Content Layout', 'helloturbo' ),
			'section' => 'helloturbo_page_layout',
			'type'    => 'select',
			'choices' => array(
				'normal'     => __( 'Normal', 'helloturbo' ),
				'narrow'     => __( 'Narrow', 'helloturbo' ),
				'full-width' => __( 'Full Width / Stretched', 'helloturbo' ),
			),
		)
	);

	// Page title.
	$wp_customize->add_setting(
		'helloturbo_page_title_enable',
		array(
			'default'           => true,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_page_title_enable',
		array(
			'label'   => __( 'Show Page Title', 'helloturbo' ),
			'section' => 'helloturbo_page_layout',
			'type'    => 'checkbox',
		)
	);

	// Page title style.
	$wp_customize->add_setting(
		'helloturbo_page_title_style',
		array(
			'default'           => 'inline',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_page_title_style',
		array(
			'label'   => __( 'Page Title Style', 'helloturbo' ),
			'section' => 'helloturbo_page_layout',
			'type'    => 'select',
			'choices' => array(
				'inline' => __( 'Inline (inside content)', 'helloturbo' ),
				'banner' => __( 'Full-width Banner', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_page_title_align',
		array(
			'default'           => 'left',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_page_title_align',
		array(
			'label'   => __( 'Page Title Alignment', 'helloturbo' ),
			'section' => 'helloturbo_page_layout',
			'type'    => 'select',
			'choices' => array(
				'left'   => __( 'Left', 'helloturbo' ),
				'center' => __( 'Center', 'helloturbo' ),
				'right'  => __( 'Right', 'helloturbo' ),
			),
		)
	);

	// Featured image on pages.
	$wp_customize->add_setting(
		'helloturbo_page_featured_image',
		array(
			'default'           => false,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_page_featured_image',
		array(
			'label'   => __( 'Show Featured Image on Pages', 'helloturbo' ),
			'section' => 'helloturbo_page_layout',
			'type'    => 'checkbox',
		)
	);

	// Comments on pages.
	$wp_customize->add_setting(
		'helloturbo_page_comments',
		array(
			'default'           => true,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_page_comments',
		array(
			'label'   => __( 'Enable Comments on Pages', 'helloturbo' ),
			'section' => 'helloturbo_page_layout',
			'type'    => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'helloturbo_customizer_page_layout' );
