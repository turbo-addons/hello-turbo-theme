<?php
/**
 * Turbo Theme functions and definitions.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Theme version constant.
define( 'HELLOTURBO_THEME_VERSION', '1.1.0' );
define( 'HELLOTURBO_THEME_DIR', get_template_directory() );
define( 'HELLOTURBO_THEME_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function helloturbo_theme_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'helloturbo', HELLOTURBO_THEME_DIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary'      => esc_html__( 'Primary Menu', 'helloturbo' ),
			'secondary'    => esc_html__( 'Secondary Menu', 'helloturbo' ),
			'above-header' => esc_html__( 'Above Header Menu', 'helloturbo' ),
			'footer'       => esc_html__( 'Footer Menu', 'helloturbo' ),
			'mobile'       => esc_html__( 'Mobile Menu', 'helloturbo' ),
		)
	);

	// Switch core markup to HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Custom logo support.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Custom background support.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'ffffff',
		)
	);

	// Custom header support.
	add_theme_support(
		'custom-header',
		array(
			'default-image' => '',
			'width'         => 1920,
			'height'        => 400,
			'flex-width'    => true,
			'flex-height'   => true,
		)
	);

	// Block styles support.
	add_theme_support( 'wp-block-styles' );

	// Wide alignment support for Gutenberg.
	add_theme_support( 'align-wide' );

	// Responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Editor styles.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );

	// WooCommerce support.
	add_theme_support( 'woocommerce' );

	// Set content width.
	if ( ! isset( $GLOBALS['content_width'] ) ) {
		$GLOBALS['content_width'] = 1200;
	}
}
add_action( 'after_setup_theme', 'helloturbo_theme_setup' );

/**
 * Register widget areas.
 */
function helloturbo_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'helloturbo' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in the sidebar.', 'helloturbo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widget 1', 'helloturbo' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'First footer widget area.', 'helloturbo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widget 2', 'helloturbo' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Second footer widget area.', 'helloturbo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widget 3', 'helloturbo' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Third footer widget area.', 'helloturbo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'helloturbo_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function helloturbo_theme_scripts() {
	// Root stylesheet (required by WordPress).
	wp_enqueue_style(
		'helloturbo-root',
		get_stylesheet_uri(),
		array(),
		HELLOTURBO_THEME_VERSION
	);

	// Main theme stylesheet.
	wp_enqueue_style(
		'helloturbo-style',
		HELLOTURBO_THEME_URI . '/assets/css/theme.css',
		array(),
		HELLOTURBO_THEME_VERSION
	);

	// Navigation script.
	wp_enqueue_script(
		'helloturbo-navigation',
		HELLOTURBO_THEME_URI . '/assets/js/navigation.js',
		array(),
		HELLOTURBO_THEME_VERSION,
		true
	);

	// Comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'helloturbo_theme_scripts' );

/**
 * Load Customizer settings.
 */
require HELLOTURBO_THEME_DIR . '/inc/customizer.php';

/**
 * Load admin dashboard and AJAX handlers.
 */
if ( is_admin() ) {
	require HELLOTURBO_THEME_DIR . '/inc/admin/class-helloturbo-admin.php';
}

/**
 * Load Elementor compatibility.
 */
require HELLOTURBO_THEME_DIR . '/inc/elementor-compat.php';

/**
 * Load front-end Header / Footer Builder rendering.
 */
require HELLOTURBO_THEME_DIR . '/inc/template-render.php';

/**
 * Elementor full-width support — remove sidebar on Elementor pages.
 *
 * @param array $classes Body classes.
 * @return array
 */
function helloturbo_theme_elementor_body_class( $classes ) {
	if ( defined( 'ELEMENTOR_VERSION' ) ) {
		if ( \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() ) ) {
			$classes[] = 'helloturbo-elementor-page';
		}
	}
	return $classes;
}
add_filter( 'body_class', 'helloturbo_theme_elementor_body_class' );

/**
 * Add skip link for accessibility.
 */
function helloturbo_theme_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#primary">' . esc_html__( 'Skip to content', 'helloturbo' ) . '</a>';
}
add_action( 'wp_body_open', 'helloturbo_theme_skip_link' );

/**
 * Add body classes based on Customizer layout settings.
 *
 * @param array $classes Body classes.
 * @return array
 */
function helloturbo_theme_body_classes( $classes ) {
	// Determine sidebar position.
	$sidebar = helloturbo_get_current_sidebar_layout();
	if ( 'none' !== $sidebar ) {
		$classes[] = 'helloturbo-has-sidebar';
		$classes[] = 'helloturbo-sidebar-' . $sidebar;
	}

	// Site layout.
	$site_layout = get_theme_mod( 'helloturbo_site_layout', 'full-width' );
	$classes[]   = 'helloturbo-layout-' . $site_layout;

	// Content layout.
	$content_layout = get_theme_mod( 'helloturbo_default_content_layout', 'normal' );
	if ( is_page() ) {
		$content_layout = get_theme_mod( 'helloturbo_page_content_layout', 'normal' );
	}
	if ( 'narrow' === $content_layout ) {
		$classes[] = 'helloturbo-narrow';
	}

	// Sticky header class.
	if ( get_theme_mod( 'helloturbo_sticky_header', false ) ) {
		$classes[] = 'helloturbo-sticky-header';
	}

	// Mobile menu style.
	$mobile_style = get_theme_mod( 'helloturbo_mobile_menu_style', 'dropdown' );
	if ( in_array( $mobile_style, array( 'dropdown', 'fullscreen', 'sidebar' ), true ) ) {
		$classes[] = 'helloturbo-mobile-' . $mobile_style;
	}

	return $classes;
}
add_filter( 'body_class', 'helloturbo_theme_body_classes' );

/**
 * Determine the current sidebar layout based on context.
 *
 * @return string right|left|none
 */
function helloturbo_get_current_sidebar_layout() {
	$default = get_theme_mod( 'helloturbo_sidebar_default', 'right' );
	$layout  = $default;

	if ( is_page() ) {
		$layout = get_theme_mod( 'helloturbo_sidebar_page', 'none' );
	} elseif ( is_single() ) {
		$layout = get_theme_mod( 'helloturbo_sidebar_single', 'right' );
	} elseif ( is_archive() || is_home() ) {
		$layout = get_theme_mod( 'helloturbo_sidebar_archive', 'right' );
	} elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		$layout = get_theme_mod( 'helloturbo_sidebar_woo', 'none' );
	}

	if ( 'default' === $layout ) {
		$layout = $default;
	}

	if ( ! apply_filters( 'helloturbo_theme_show_sidebar', true ) ) {
		return 'none';
	}

	return $layout;
}

/**
 * Custom excerpt length.
 *
 * @return int
 */
function helloturbo_theme_excerpt_length() {
	$custom = get_theme_mod( 'helloturbo_blog_excerpt_length', 30 );
	return absint( $custom );
}
add_filter( 'excerpt_length', 'helloturbo_theme_excerpt_length' );

/**
 * Custom excerpt more text.
 *
 * @return string
 */
function helloturbo_theme_excerpt_more() {
	if ( get_theme_mod( 'helloturbo_blog_readmore', true ) ) {
		$text = get_theme_mod( 'helloturbo_blog_readmore_text', __( 'Read More &raquo;', 'helloturbo' ) );
		return ' <a class="helloturbo-read-more" href="' . esc_url( get_permalink() ) . '">' . esc_html( $text ) . '</a>';
	}
	return '&hellip;';
}
add_filter( 'excerpt_more', 'helloturbo_theme_excerpt_more' );

/**
 * Render breadcrumbs if enabled.
 */
function helloturbo_theme_breadcrumbs() {
	if ( ! get_theme_mod( 'helloturbo_breadcrumbs_enable', false ) ) {
		return;
	}

	// Check hide conditions.
	if ( is_front_page() && get_theme_mod( 'helloturbo_breadcrumbs_hide_home', true ) ) {
		return;
	}
	if ( is_home() && get_theme_mod( 'helloturbo_breadcrumbs_hide_blog', false ) ) {
		return;
	}
	if ( is_single() && get_theme_mod( 'helloturbo_breadcrumbs_hide_single', false ) ) {
		return;
	}

	$source = get_theme_mod( 'helloturbo_breadcrumbs_source', 'built-in' );
	$sep    = get_theme_mod( 'helloturbo_breadcrumbs_separator', '»' );

	echo '<div class="helloturbo-breadcrumbs"><div class="helloturbo-container">';

	switch ( $source ) {
		case 'yoast':
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb( '<nav aria-label="breadcrumbs">', '</nav>' );
			}
			break;
		case 'rankmath':
			if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
				rank_math_the_breadcrumbs();
			}
			break;
		case 'navxt':
			if ( function_exists( 'bcn_display' ) ) {
				echo '<nav aria-label="breadcrumbs">';
				bcn_display();
				echo '</nav>';
			}
			break;
		default:
			// Built-in simple breadcrumbs.
			helloturbo_theme_built_in_breadcrumbs( $sep );
			break;
	}

	echo '</div></div>';
}
add_action( 'helloturbo_theme_after_header', 'helloturbo_theme_breadcrumbs' );

/**
 * Simple built-in breadcrumbs.
 *
 * @param string $sep Separator character.
 */
function helloturbo_theme_built_in_breadcrumbs( $sep ) {
	echo '<nav aria-label="' . esc_attr__( 'Breadcrumbs', 'helloturbo' ) . '">';
	echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'helloturbo' ) . '</a>';
	echo '<span class="separator"> ' . esc_html( $sep ) . ' </span>';

	if ( is_category() || is_single() ) {
		$cats = get_the_category();
		if ( ! empty( $cats ) ) {
			echo '<a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '">' . esc_html( $cats[0]->name ) . '</a>';
			if ( is_single() ) {
				echo '<span class="separator"> ' . esc_html( $sep ) . ' </span>';
				echo '<span class="current">' . esc_html( get_the_title() ) . '</span>';
			}
		}
	} elseif ( is_page() ) {
		echo '<span class="current">' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_archive() ) {
		the_archive_title( '<span class="current">', '</span>' );
	} elseif ( is_search() ) {
		echo '<span class="current">' . esc_html__( 'Search Results', 'helloturbo' ) . '</span>';
	}

	echo '</nav>';
}
