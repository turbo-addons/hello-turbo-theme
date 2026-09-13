<?php
/**
 * Blog / Archive — Layout, post structure, meta elements, pagination.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Blog / Archive layout settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function helloturbo_customizer_blog_archive( $wp_customize ) {

	// =============================================
	// Section: Blog Layout
	// =============================================
	$wp_customize->add_section(
		'helloturbo_blog_layout',
		array(
			'title'    => __( 'Blog Layout', 'helloturbo' ),
			'panel'    => 'helloturbo_blog',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'helloturbo_blog_style',
		array(
			'default'           => 'list',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_style',
		array(
			'label'   => __( 'Blog Layout Style', 'helloturbo' ),
			'section' => 'helloturbo_blog_layout',
			'type'    => 'select',
			'choices' => array(
				'list'    => __( 'List', 'helloturbo' ),
				'grid-2'  => __( 'Grid – 2 Columns', 'helloturbo' ),
				'grid-3'  => __( 'Grid – 3 Columns', 'helloturbo' ),
				'grid-4'  => __( 'Grid – 4 Columns', 'helloturbo' ),
				'masonry' => __( 'Masonry – 3 Columns', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_blog_image_position',
		array(
			'default'           => 'top',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_image_position',
		array(
			'label'   => __( 'Featured Image Position (List)', 'helloturbo' ),
			'section' => 'helloturbo_blog_layout',
			'type'    => 'select',
			'choices' => array(
				'top'  => __( 'Above Title', 'helloturbo' ),
				'left' => __( 'Left of Content', 'helloturbo' ),
				'none' => __( 'Hidden', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_blog_image_ratio',
		array(
			'default'           => '16-9',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_image_ratio',
		array(
			'label'   => __( 'Image Aspect Ratio', 'helloturbo' ),
			'section' => 'helloturbo_blog_layout',
			'type'    => 'select',
			'choices' => array(
				'16-9' => '16:9',
				'4-3'  => '4:3',
				'1-1'  => '1:1 (Square)',
				'3-2'  => '3:2',
				'auto' => __( 'Original', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_blog_gap',
		array(
			'default'           => 30,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_gap',
		array(
			'label'       => __( 'Grid Gap (px)', 'helloturbo' ),
			'section'     => 'helloturbo_blog_layout',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 80,
				'step' => 5,
			),
		)
	);

	// =============================================
	// Section: Post Structure & Meta
	// =============================================
	$wp_customize->add_section(
		'helloturbo_blog_post_structure',
		array(
			'title'    => __( 'Post Content & Meta', 'helloturbo' ),
			'panel'    => 'helloturbo_blog',
			'priority' => 20,
		)
	);

	// Post content type.
	$wp_customize->add_setting(
		'helloturbo_blog_content_type',
		array(
			'default'           => 'excerpt',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_content_type',
		array(
			'label'   => __( 'Post Content', 'helloturbo' ),
			'section' => 'helloturbo_blog_post_structure',
			'type'    => 'select',
			'choices' => array(
				'excerpt' => __( 'Excerpt', 'helloturbo' ),
				'full'    => __( 'Full Content', 'helloturbo' ),
				'none'    => __( 'None (Title Only)', 'helloturbo' ),
			),
		)
	);

	$wp_customize->add_setting(
		'helloturbo_blog_excerpt_length',
		array(
			'default'           => 30,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_excerpt_length',
		array(
			'label'       => __( 'Excerpt Word Length', 'helloturbo' ),
			'section'     => 'helloturbo_blog_post_structure',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 5,
				'max'  => 100,
				'step' => 5,
			),
		)
	);

	// Read more button.
	$wp_customize->add_setting(
		'helloturbo_blog_readmore',
		array(
			'default'           => true,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_readmore',
		array(
			'label'   => __( 'Show Read More Link', 'helloturbo' ),
			'section' => 'helloturbo_blog_post_structure',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_blog_readmore_text',
		array(
			'default'           => 'Read More',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_readmore_text',
		array(
			'label'   => __( 'Read More Text', 'helloturbo' ),
			'section' => 'helloturbo_blog_post_structure',
			'type'    => 'text',
		)
	);

	// Meta elements.
	$wp_customize->add_setting(
		'helloturbo_blog_meta_author',
		array(
			'default'           => true,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_meta_author',
		array(
			'label'   => __( 'Show Author', 'helloturbo' ),
			'section' => 'helloturbo_blog_post_structure',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_blog_meta_date',
		array(
			'default'           => true,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_meta_date',
		array(
			'label'   => __( 'Show Date', 'helloturbo' ),
			'section' => 'helloturbo_blog_post_structure',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_blog_meta_category',
		array(
			'default'           => true,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_meta_category',
		array(
			'label'   => __( 'Show Category', 'helloturbo' ),
			'section' => 'helloturbo_blog_post_structure',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_blog_meta_comments',
		array(
			'default'           => true,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_meta_comments',
		array(
			'label'   => __( 'Show Comment Count', 'helloturbo' ),
			'section' => 'helloturbo_blog_post_structure',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'helloturbo_blog_meta_reading_time',
		array(
			'default'           => false,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_blog_meta_reading_time',
		array(
			'label'   => __( 'Show Reading Time', 'helloturbo' ),
			'section' => 'helloturbo_blog_post_structure',
			'type'    => 'checkbox',
		)
	);

	// =============================================
	// Section: Pagination
	// =============================================
	$wp_customize->add_section(
		'helloturbo_blog_pagination',
		array(
			'title'    => __( 'Pagination', 'helloturbo' ),
			'panel'    => 'helloturbo_blog',
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'helloturbo_pagination_style',
		array(
			'default'           => 'numbers',
			'sanitize_callback' => 'helloturbo_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'helloturbo_pagination_style',
		array(
			'label'   => __( 'Pagination Style', 'helloturbo' ),
			'section' => 'helloturbo_blog_pagination',
			'type'    => 'select',
			'choices' => array(
				'numbers'   => __( 'Page Numbers', 'helloturbo' ),
				'prev-next' => __( 'Previous / Next', 'helloturbo' ),
				'load-more' => __( 'Load More Button', 'helloturbo' ),
				'infinite'  => __( 'Infinite Scroll', 'helloturbo' ),
			),
		)
	);

	// Archive title.
	$wp_customize->add_setting(
		'helloturbo_archive_title_prefix',
		array(
			'default'           => true,
			'sanitize_callback' => 'helloturbo_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'helloturbo_archive_title_prefix',
		array(
			'label'       => __( 'Show Archive Title Prefix', 'helloturbo' ),
			'description' => __( 'e.g. "Category:", "Tag:", "Author:" before the title.', 'helloturbo' ),
			'section'     => 'helloturbo_blog_pagination',
			'type'        => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'helloturbo_customizer_blog_archive' );
