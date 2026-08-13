<?php
/**
 * Customizer sanitization callbacks.
 *
 * @package Turbo_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function turbo_sanitize_checkbox( $val ) {
	return (bool) $val;
}

function turbo_sanitize_select( $input, $setting ) {
	$control = $setting->manager->get_control( $setting->id );
	$choices = ( $control && isset( $control->choices ) ) ? $control->choices : array();
	return array_key_exists( $input, $choices ) ? $input : $setting->default;
}

function turbo_sanitize_number( $val ) {
	return is_numeric( $val ) ? floatval( $val ) : 0;
}

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

function turbo_sanitize_font_weight( $val ) {
	$valid = array( '100', '200', '300', '400', '500', '600', '700', '800', '900', 'normal', 'bold' );
	return in_array( (string) $val, $valid, true ) ? $val : '400';
}

function turbo_sanitize_text_transform( $val ) {
	$valid = array( 'none', 'capitalize', 'uppercase', 'lowercase' );
	return in_array( $val, $valid, true ) ? $val : 'none';
}

function turbo_sanitize_sortable( $val ) {
	if ( is_array( $val ) ) {
		return array_map( 'sanitize_text_field', $val );
	}
	return array();
}
