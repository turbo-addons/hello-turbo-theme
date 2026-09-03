<?php
/**
 * Customizer sanitization callbacks.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sanitize a checkbox value.
 *
 * @param mixed $val Value to sanitize.
 * @return bool
 */
function turbo_sanitize_checkbox( $val ) {
	return (bool) $val;
}

/**
 * Sanitize a select setting.
 *
 * @param mixed                $input   Value to sanitize.
 * @param WP_Customize_Setting $setting Setting object.
 * @return string
 */
function turbo_sanitize_select( $input, $setting ) {
	$control = $setting->manager->get_control( $setting->id );
	$choices = ( $control && isset( $control->choices ) ) ? $control->choices : array();
	return array_key_exists( $input, $choices ) ? $input : $setting->default;
}

/**
 * Sanitize a numeric value.
 *
 * @param mixed $val Value to sanitize.
 * @return float
 */
function turbo_sanitize_number( $val ) {
	return is_numeric( $val ) ? floatval( $val ) : 0;
}

/**
 * Sanitize a hex or rgba color value.
 *
 * @param string $val Color value.
 * @return string
 */
function turbo_sanitize_rgba( $val ) {
	if ( empty( $val ) ) {
		return '';
	}
	if ( preg_match( '/^#(?:[A-Fa-f0-9]{3}|[A-Fa-f0-9]{4}|[A-Fa-f0-9]{6}|[A-Fa-f0-9]{8})$/', $val ) ) {
		return $val;
	}
	if ( preg_match( '/^rgba?\(\s*\d{1,3}\s*,\s*\d{1,3}\s*,\s*\d{1,3}\s*(?:,\s*(?:0|1|0?\.\d+)\s*)?\)$/', $val ) ) {
		return $val;
	}
	return '';
}

/**
 * Sanitize a font-weight value.
 *
 * @param string $val Weight value.
 * @return string
 */
function turbo_sanitize_font_weight( $val ) {
	$valid = array( '100', '200', '300', '400', '500', '600', '700', '800', '900', 'normal', 'bold' );
	return in_array( (string) $val, $valid, true ) ? $val : '400';
}

/**
 * Sanitize a text-transform value.
 *
 * @param string $val Transform value.
 * @return string
 */
function turbo_sanitize_text_transform( $val ) {
	$valid = array( 'none', 'capitalize', 'uppercase', 'lowercase' );
	return in_array( $val, $valid, true ) ? $val : 'none';
}

/**
 * Sanitize a sortable list of values.
 *
 * @param array $val Value to sanitize.
 * @return array
 */
function turbo_sanitize_sortable( $val ) {
	if ( is_array( $val ) ) {
		return array_map( 'sanitize_text_field', $val );
	}
	return array();
}
