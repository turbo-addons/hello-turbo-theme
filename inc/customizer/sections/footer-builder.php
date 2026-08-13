<?php
/**
 * Footer Builder — Above Footer, Primary Footer (widgets), Below Footer (copyright bar).
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function turbo_customizer_footer_builder( $wp_customize ) {

	// =============================================
	// Section: Footer Widgets Area
	// =============================================
	$wp_customize->add_section( 'turbo_footer_widgets', array(
		'title' => __( 'Footer Widgets', 'helloturbo' ),
		'panel' => 'turbo_footer_builder',
		'priority' => 10,
	) );

	$wp_customize->add_setting( 'turbo_footer_widgets_enable', array(
		'default' => true, 'sanitize_callback' => 'turbo_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'turbo_footer_widgets_enable', array(
		'label'   => __( 'Enable Footer Widgets Area', 'helloturbo' ),
		'section' => 'turbo_footer_widgets',
		'type'    => 'checkbox',
	) );

	$wp_customize->add_setting( 'turbo_footer_columns', array(
		'default' => '4', 'sanitize_callback' => 'turbo_sanitize_select',
	) );
	$wp_customize->add_control( 'turbo_footer_columns', array(
		'label'   => __( 'Number of Columns', 'helloturbo' ),
		'section' => 'turbo_footer_widgets',
		'type'    => 'select',
		'choices' => array(
			'1' => '1', '2' => '2', '3' => '3', '4' => '4',
		),
	) );

	$wp_customize->add_setting( 'turbo_footer_widgets_bg', array(
		'default' => '#1f2937', 'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'turbo_footer_widgets_bg', array(
			'label'   => __( 'Background Color', 'helloturbo' ),
			'section' => 'turbo_footer_widgets',
		)
	) );

	$wp_customize->add_setting( 'turbo_footer_widgets_text', array(
		'default' => '#d1d5db', 'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'turbo_footer_widgets_text', array(
			'label'   => __( 'Text Color', 'helloturbo' ),
			'section' => 'turbo_footer_widgets',
		)
	) );

	$wp_customize->add_setting( 'turbo_footer_widgets_link', array(
		'default' => '#93c5fd', 'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'turbo_footer_widgets_link', array(
			'label'   => __( 'Link Color', 'helloturbo' ),
			'section' => 'turbo_footer_widgets',
		)
	) );

	$wp_customize->add_setting( 'turbo_footer_widgets_link_hover', array(
		'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'turbo_footer_widgets_link_hover', array(
			'label'   => __( 'Link Hover Color', 'helloturbo' ),
			'section' => 'turbo_footer_widgets',
		)
	) );

	$wp_customize->add_setting( 'turbo_footer_widgets_heading', array(
		'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'turbo_footer_widgets_heading', array(
			'label'   => __( 'Widget Title Color', 'helloturbo' ),
			'section' => 'turbo_footer_widgets',
		)
	) );

	$wp_customize->add_setting( 'turbo_footer_widgets_padding', array(
		'default' => 60, 'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'turbo_footer_widgets_padding', array(
		'label'       => __( 'Vertical Padding (px)', 'helloturbo' ),
		'section'     => 'turbo_footer_widgets',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 10, 'max' => 150, 'step' => 5 ),
	) );

	// =============================================
	// Section: Copyright Bar (Below Footer)
	// =============================================
	$wp_customize->add_section( 'turbo_footer_bar', array(
		'title' => __( 'Copyright Bar', 'helloturbo' ),
		'panel' => 'turbo_footer_builder',
		'priority' => 20,
	) );

	$wp_customize->add_setting( 'turbo_footer_bar_layout', array(
		'default' => 'two-columns', 'sanitize_callback' => 'turbo_sanitize_select',
	) );
	$wp_customize->add_control( 'turbo_footer_bar_layout', array(
		'label'   => __( 'Layout', 'helloturbo' ),
		'section' => 'turbo_footer_bar',
		'type'    => 'select',
		'choices' => array(
			'one-column'  => __( 'Centered', 'helloturbo' ),
			'two-columns' => __( 'Left & Right', 'helloturbo' ),
		),
	) );

	$wp_customize->add_setting( 'turbo_copyright_text_left', array(
		'default'           => 'Copyright {year} {site_title}. All rights reserved.',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'turbo_copyright_text_left', array(
		'label'       => __( 'Left / Center Text', 'helloturbo' ),
		'description' => __( 'Use {site_title}, {year} as dynamic tags.', 'helloturbo' ),
		'section'     => 'turbo_footer_bar',
		'type'        => 'textarea',
	) );

	$wp_customize->add_setting( 'turbo_copyright_text_right', array(
		'default' => __( 'Powered by HelloTurbo', 'helloturbo' ),
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'turbo_copyright_text_right', array(
		'label'   => __( 'Right Section Text', 'helloturbo' ),
		'section' => 'turbo_footer_bar',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'turbo_footer_bar_bg', array(
		'default' => '#111827', 'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'turbo_footer_bar_bg', array(
			'label'   => __( 'Background Color', 'helloturbo' ),
			'section' => 'turbo_footer_bar',
		)
	) );

	$wp_customize->add_setting( 'turbo_footer_bar_text_color', array(
		'default' => '#9ca3af', 'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'turbo_footer_bar_text_color', array(
			'label'   => __( 'Text Color', 'helloturbo' ),
			'section' => 'turbo_footer_bar',
		)
	) );

	$wp_customize->add_setting( 'turbo_footer_bar_link_color', array(
		'default' => '#93c5fd', 'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'turbo_footer_bar_link_color', array(
			'label'   => __( 'Link Color', 'helloturbo' ),
			'section' => 'turbo_footer_bar',
		)
	) );

	$wp_customize->add_setting( 'turbo_footer_bar_link_hover', array(
		'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'turbo_footer_bar_link_hover', array(
			'label'   => __( 'Link Hover Color', 'helloturbo' ),
			'section' => 'turbo_footer_bar',
		)
	) );

	$wp_customize->add_setting( 'turbo_footer_bar_border_top', array(
		'default' => 1, 'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'turbo_footer_bar_border_top', array(
		'label'       => __( 'Top Border (px)', 'helloturbo' ),
		'section'     => 'turbo_footer_bar',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 0, 'max' => 5 ),
	) );

	$wp_customize->add_setting( 'turbo_footer_bar_border_color', array(
		'default' => '#374151', 'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'turbo_footer_bar_border_color', array(
			'label'   => __( 'Border Color', 'helloturbo' ),
			'section' => 'turbo_footer_bar',
		)
	) );

	$wp_customize->add_setting( 'turbo_footer_bar_padding', array(
		'default' => 15, 'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'turbo_footer_bar_padding', array(
		'label'       => __( 'Vertical Padding (px)', 'helloturbo' ),
		'section'     => 'turbo_footer_bar',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 5, 'max' => 60, 'step' => 5 ),
	) );

	// Footer menu.
	$wp_customize->add_setting( 'turbo_footer_bar_menu', array(
		'default' => false, 'sanitize_callback' => 'turbo_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'turbo_footer_bar_menu', array(
		'label'   => __( 'Show Footer Menu in Bar', 'helloturbo' ),
		'section' => 'turbo_footer_bar',
		'type'    => 'checkbox',
	) );

	// Social icons in footer.
	$wp_customize->add_setting( 'turbo_footer_social_enable', array(
		'default' => false, 'sanitize_callback' => 'turbo_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'turbo_footer_social_enable', array(
		'label'   => __( 'Show Social Icons', 'helloturbo' ),
		'section' => 'turbo_footer_bar',
		'type'    => 'checkbox',
	) );
}
add_action( 'customize_register', 'turbo_customizer_footer_builder' );
