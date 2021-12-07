<?php
/**
 * Gutenberg Block Editor
 *
 * Enqueues scripts and styles and declares
 * any features that the theme supports.
 *
 * @package easy-google-fonts
 * @author  Sunny Johal - Titanium Themes <support@titaniumthemes.com>
 */

namespace EGF\BlockEditor;

/**
 * Inject Inline Styles
 */
add_filter(
	'pre_http_request',
	function( $response, $parsed_args, $url ) {
		return $response;
	}
);
