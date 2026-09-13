<?php
/**
 * Single Post — Title area, featured image, meta, author box, related posts, comments.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Single post settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function helloturbo_customizer_single_post( $wp_customize ) {

	// =============================================
	// Section: Title Area
	// =============================================
	$wp_customize->add_section(
		'helloturbo_single_title',
		array(
			'title'    => __( 'Title Area', 'helloturbo' ),
			'panel'    => 'helloturbo_single_post',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_title_layout',
		array(
			'default'           => 'inline',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_single_title_layout',
		array(
			'label'   => __( 'Title Layout', 'helloturbo' ),
			'section' => 'helloturbo_single_title',
			'type'    => 'select',
			'choices' => array(
				'inline'   => __( 'Inline (inside content)', 'helloturbo' ),
				'banner'   => __( 'Full-width Banner', 'helloturbo' ),
				'centered' => __( 'Centered with Background', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_banner_bg',
		array(
			'default'           => '#111827',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_single_banner_bg',
			array(
				'label'   => __( 'Banner Background Color', 'helloturbo' ),
				'section' => 'helloturbo_single_title',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_banner_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_single_banner_text_color',
			array(
				'label'   => __( 'Banner Text Color', 'helloturbo' ),
				'section' => 'helloturbo_single_title',
			)
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_banner_padding',
		array(
			'default'           => 60,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_single_banner_padding',
		array(
			'label'       => __( 'Banner Padding (px)', 'helloturbo' ),
			'section'     => 'helloturbo_single_title',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 20,
				'max'  => 150,
				'step' => 5,
			),
		)
	);

	// =============================================
	// Section: Featured Image
	// =============================================
	$wp_customize->add_section(
		'helloturbo_single_featured',
		array(
			'title'    => __( 'Featured Image', 'helloturbo' ),
			'panel'    => 'helloturbo_single_post',
			'priority' => 20,
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_featured_position',
		array(
			'default'           => 'below-title',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_single_featured_position',
		array(
			'label'   => __( 'Featured Image Position', 'helloturbo' ),
			'section' => 'helloturbo_single_featured',
			'type'    => 'select',
			'choices' => array(
				'above-title'  => __( 'Above Title', 'helloturbo' ),
				'below-title'  => __( 'Below Title', 'helloturbo' ),
				'behind-title' => __( 'Behind Title (Cover)', 'helloturbo' ),
				'none'         => __( 'Hidden', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_featured_width',
		array(
			'default'           => 'contained',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_single_featured_width',
		array(
			'label'   => __( 'Image Width', 'helloturbo' ),
			'section' => 'helloturbo_single_featured',
			'type'    => 'select',
			'choices' => array(
				'contained'  => __( 'Content Width', 'helloturbo' ),
				'full-width' => __( 'Full Width', 'helloturbo' ),
			),
		)
	);

	// =============================================
	// Section: Post Meta
	// =============================================
	$wp_customize->add_section(
		'helloturbo_single_meta',
		array(
			'title'    => __( 'Post Meta', 'helloturbo' ),
			'panel'    => 'helloturbo_single_post',
			'priority' => 30,
		)
	);

	$meta_items = array(
		'helloturbo_single_show_author'         => array( true, __( 'Show Author', 'helloturbo' ) ),
		'helloturbo_single_show_date'           => array( true, __( 'Show Date', 'helloturbo' ) ),
		'helloturbo_single_show_category'       => array( true, __( 'Show Categories', 'helloturbo' ) ),
		'helloturbo_single_show_tags'           => array( true, __( 'Show Tags', 'helloturbo' ) ),
		'helloturbo_single_show_comments_count' => array( true, __( 'Show Comments Count', 'helloturbo' ) ),
		'helloturbo_single_show_reading_time'   => array( false, __( 'Show Reading Time', 'helloturbo' ) ),
		'helloturbo_single_show_updated_date'   => array( false, __( 'Show Last Updated Date', 'helloturbo' ) ),
	);

	foreach ( $meta_items as $id => $data ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $data[0],
				'sanitize_callback' => 'helloturbo_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $data[1],
				'section' => 'helloturbo_single_meta',
				'type'    => 'checkbox',
			)
		);
	}

	// =============================================
	// Section: Author Box
	// =============================================
	$wp_customize->add_section(
		'helloturbo_single_author_box',
		array(
			'title'    => __( 'Author Box', 'helloturbo' ),
			'panel'    => 'helloturbo_single_post',
			'priority' => 40,
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_author_box_enable',
		array(
			'default'           => false,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_single_author_box_enable',
		array(
			'label'   => __( 'Show Author Box', 'helloturbo' ),
			'section' => 'helloturbo_single_author_box',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_author_box_bg',
		array(
			'default'           => '#f9fafb',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'helloturbo_single_author_box_bg',
			array(
				'label'   => __( 'Author Box Background', 'helloturbo' ),
				'section' => 'helloturbo_single_author_box',
			)
		)
	);

	// =============================================
	// Section: Related Posts
	// =============================================
	$wp_customize->add_section(
		'helloturbo_single_related',
		array(
			'title'    => __( 'Related Posts', 'helloturbo' ),
			'panel'    => 'helloturbo_single_post',
			'priority' => 50,
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_related_enable',
		array(
			'default'           => true,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_single_related_enable',
		array(
			'label'   => __( 'Show Related Posts', 'helloturbo' ),
			'section' => 'helloturbo_single_related',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_related_count',
		array(
			'default'           => 3,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_single_related_count',
		array(
			'label'       => __( 'Number of Posts', 'helloturbo' ),
			'section'     => 'helloturbo_single_related',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 2,
				'max'  => 8,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_related_columns',
		array(
			'default'           => 3,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_single_related_columns',
		array(
			'label'   => __( 'Columns', 'helloturbo' ),
			'section' => 'helloturbo_single_related',
			'type'    => 'select',
			'choices' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_related_by',
		array(
			'default'           => 'category',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_single_related_by',
		array(
			'label'   => __( 'Relation By', 'helloturbo' ),
			'section' => 'helloturbo_single_related',
			'type'    => 'select',
			'choices' => array(
				'category' => __( 'Category', 'helloturbo' ),
				'tag'      => __( 'Tag', 'helloturbo' ),
			),
		)
	);

	// =============================================
	// Section: Post Navigation
	// =============================================
	$wp_customize->add_section(
		'helloturbo_single_navigation',
		array(
			'title'    => __( 'Post Navigation', 'helloturbo' ),
			'panel'    => 'helloturbo_single_post',
			'priority' => 60,
		)
	);

	$wp_customize->add_setting(
		'helloturbo_single_nav_enable',
		array(
			'default'           => true,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_single_nav_enable',
		array(
			'label'   => __( 'Show Previous / Next Navigation', 'helloturbo' ),
			'section' => 'helloturbo_single_navigation',
			'type'    => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'helloturbo_customizer_single_post' );
