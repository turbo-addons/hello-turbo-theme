<?php
/**
 * Template Name: Elementor Canvas
 * Template Post Type: page, post
 *
 * A blank canvas template — no header, no footer, no sidebar.
 * Perfect for landing pages built entirely in Elementor.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'turbo-canvas' ); ?>>
<?php wp_body_open(); ?>

<div id="page" class="turbo-site turbo-canvas-page">
	<main id="primary" class="turbo-main-content" tabindex="-1">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</main>
</div>

<?php wp_footer(); ?>
</body>
</html>
