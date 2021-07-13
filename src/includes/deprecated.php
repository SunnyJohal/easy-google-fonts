<?php
/**
 * Backward Compatibility
 *
 * Preserves data for font controls created in versions
 * of easy google fonts prior to v2.0.0.
 *
 * @package easy-google-fonts
 * @author  Sunny Johal - Titanium Themes <support@titaniumthemes.com>
 */

namespace EGF\Deprecated;

use EGF\Settings as Settings;

/**
 * Preserve Legacy Font Control IDs
 *
 * Handle legacy font control ids, new ids will be
 * generated dynamically from the post id.
 *
 * @param string $font_control_id_id Generated font control id.
 * @param int    $post_id ID of a 'tt_font_control' post.
 */
add_filter(
	'egf_font_control_id',
	function( $font_control_id, $post_id ) {
		$old_font_control_id = get_post_meta( $post_id, 'control_id', true );

		if ( ! empty( $old_font_control_id ) ) {
			return $old_font_control_id;
		}

		return $font_control_id;
	},
	10,
	2
);

/**
 * Add Default Weight Variants
 */
add_filter(
	'egf_get_default_fonts',
	function ( $fonts ) {
		foreach ( $fonts as $id => $props ) {
			if ( isset( $fonts[ $id ]['weights'] ) ) {
				$fonts[ $id ]['variants'] = $fonts[ $id ]['weights'];
			}
		}
		return $fonts;
	},
	100,
	1
);

/**
 * Config Parameters Backwards Compatibility
 */
add_filter(
	'egf_get_config_parameters',
	function( $default_config ) {
		return apply_filters( 'tt_font_get_option_parameters', $default_config );
	},
	10,
	1
);

/**
 * Get Sections Backwards Compatibility
 */
add_filter(
	'egf_customizer_get_sections',
	function( $sections ) {
		return apply_filters( 'tt_font_get_settings_page_tabs', $sections );
	},
	10,
	1
);

/**
 * Get Panels Backwards Compatibility
 */
add_filter(
	'egf_customizer_get_panels',
	function( $panels ) {
		return apply_filters( 'tt_font_get_panels', $panels );
	},
	10,
	1
);
