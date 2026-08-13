<?php
/**
 * The 404 page template.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="turbo-main-content">
	<section class="turbo-error-404">
		<header class="turbo-page-header">
			<h1 class="turbo-page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'helloturbo' ); ?></h1>
		</header>

		<div class="turbo-page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'helloturbo' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</section>
</main>

<?php
get_footer();
