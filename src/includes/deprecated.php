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
