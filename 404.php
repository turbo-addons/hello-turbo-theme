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

<main id="primary" class="helloturbo-main-content" tabindex="-1">
	<section class="helloturbo-error-404">
		<header class="helloturbo-page-header">
			<h1 class="helloturbo-page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'helloturbo' ); ?></h1>
		</header>

		<div class="helloturbo-page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'helloturbo' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</section>
</main>

<?php
get_footer();
