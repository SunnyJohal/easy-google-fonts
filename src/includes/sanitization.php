<?php
/**
 * Sanitization
 *
 * Defines all of the sanitization callbacks
 * available to sanitize field types. Every
 * setting type should have a sanitization
 * callback assigned to it.
 *
 * @package easy-google-fonts
 * @author  Sunny Johal - Titanium Themes <support@titaniumthemes.com>
 */

namespace EGF\Sanitization;

/**
 * Determine Sanitization Callback
 *
 * Used to determine the correct sanitization
 * callback for nested settings within another
 * setting.
 *
 * @param string $setting_prop_key Setting prop key to sanitize.
 */
function get_setting_prop_sanitization_callback( $setting_prop_key ) {
	$sanitize_callback = false;

	// $sanitize_callback = '\EGF\Sanitization\sanitize_font_control';

	switch ( $setting_prop_key ) {
		case 'value':
			break;

		default:
			break;
	}

	return $sanitize_callback;
}

function sanitize_font_control( $input, $setting ) {
	return $setting;
}
