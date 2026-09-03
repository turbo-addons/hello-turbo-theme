<?php
/**
 * The WooCommerce template.
 *
 * Wraps WooCommerce output in the theme's header and footer.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="turbo-main-content" tabindex="-1">
	<div class="turbo-entry-content">
		<?php woocommerce_content(); ?>
	</div>
</main>

<?php
if ( 'none' !== turbo_get_current_sidebar_layout() ) {
	get_sidebar();
}
get_footer();
