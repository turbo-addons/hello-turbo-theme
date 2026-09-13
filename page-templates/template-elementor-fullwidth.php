<?php
/**
 * Template Name: Elementor Full Width
 * Template Post Type: page, post
 *
 * Full-width page with header and footer but no container constraints.
 * Content stretches edge-to-edge — designed for Elementor sections.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="helloturbo-main-content helloturbo-elementor-fullwidth" tabindex="-1">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php
get_footer();
