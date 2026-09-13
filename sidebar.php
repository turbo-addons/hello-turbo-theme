<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="helloturbo-sidebar widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
