<?php
/**
 * Social Icons — URL fields used across the Header and Footer Builder.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Social icons settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function helloturbo_customizer_social_icons( $wp_customize ) {

	$wp_customize->add_section(
		'helloturbo_social',
		array(
			'title'    => __( 'Social Icons', 'helloturbo' ),
			'panel'    => 'helloturbo_footer_builder',
			'priority' => 30,
		)
	);

	$networks = array(
		'facebook'  => __( 'Facebook URL', 'helloturbo' ),
		'twitter'   => __( 'Twitter URL', 'helloturbo' ),
		'instagram' => __( 'Instagram URL', 'helloturbo' ),
		'youtube'   => __( 'YouTube URL', 'helloturbo' ),
		'linkedin'  => __( 'LinkedIn URL', 'helloturbo' ),
	);

	foreach ( $networks as $slug => $label ) {
		$wp_customize->add_setting(
			"helloturbo_social_{$slug}",
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			"helloturbo_social_{$slug}",
			array(
				'label'   => $label,
				'section' => 'helloturbo_social',
				'type'    => 'url',
			)
		);
	}
}
add_action( 'customize_register', 'helloturbo_customizer_social_icons' );
