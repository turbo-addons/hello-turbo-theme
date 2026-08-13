<?php
/**
 * Template Name: Full Width
 * Template Post Type: page, post
 *
 * A full-width template without sidebar — ideal for page builders.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="turbo-main-content turbo-full-width">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php
get_footer();
