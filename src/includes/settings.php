<?php
/**
 * Theme Settings
 *
 * Contains the logic to hold the theme
 * typography settings for the plugin.
 *
 * @package easy-google-fonts
 * @author  Sunny Johal - Titanium Themes <support@titaniumthemes.com>
 */

namespace EGF\Settings;

/**
 * Register Typography Settings
 */
function register_settings() {
	register_setting(
		'tt_font_theme_options',
		'tt_font_theme_options',
		__NAMESPACE__ . '\\validate_settings'
	);
}
add_action( 'admin_init', __NAMESPACE__ . '\\register_settings' );

/**
 * Validate Settings
 *
 * @param array $input Plugin settings.
 * @return array $input Sanitized plugin settings.
 */
function validate_settings( $input ) {
	return $input;
}

function get_settings() {}
function get_setting_defaults() {}
function add_settings_section() {}
