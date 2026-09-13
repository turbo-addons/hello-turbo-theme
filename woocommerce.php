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

<main id="primary" class="helloturbo-main-content" tabindex="-1">
	<div class="helloturbo-entry-content">
		<?php woocommerce_content(); ?>
	</div>
</main>

<?php
if ( 'none' !== helloturbo_get_current_sidebar_layout() ) {
	get_sidebar();
}
get_footer();
