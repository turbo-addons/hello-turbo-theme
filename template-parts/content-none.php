<?php
/**
 * Template part for displaying when no content is found.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="helloturbo-no-results">
	<header class="helloturbo-page-header">
		<h1 class="helloturbo-page-title"><?php esc_html_e( 'Nothing Found', 'helloturbo' ); ?></h1>
	</header>

	<div class="helloturbo-page-content">
		<?php if ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'helloturbo' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'helloturbo' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>
