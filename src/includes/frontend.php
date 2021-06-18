<?php
/**
 * Frontend Functionality
 *
 * Contains the logic to output styles
 * the frontend.
 *
 * @package easy-google-fonts
 * @author  Sunny Johal - Titanium Themes <support@titaniumthemes.com>
 */

namespace EGF\Frontend;

/**
 * Output preconnect tag
 */
function output_preconnect_tag() {
	?>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<?php
}
add_action( 'wp_head', __NAMESPACE__ . '\\output_preconnect_tag', 10 );


/**
 * Enqueue Stylesheets
 */
function enqueue_stylesheets() {
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_stylesheets' );

/**
 * Output Inline Styles In <head>
 */
function output_styles() {
}
add_action( 'wp_head', __NAMESPACE__ . '\\output_styles', 1000 );

/**
 * Get CSS Property Mapping
 */
function get_css_property_mappings() {
	return [
		'background_color'           => 'background-color',
		'display'                    => 'display',
		'font_color'                 => 'color',
		'font_name'                  => 'font-family',
		'font_size'                  => 'font-size',
		'font_style'                 => 'font-style',
		'font_weight'                => 'font-weight',
		'letter_spacing'             => 'letter-spacing',
		'line_height'                => 'line-height',
		'margin_top'                 => 'margin-top',
		'margin_bottom'              => 'margin-bottom',
		'margin_left'                => 'margin-left',
		'margin_right'               => 'margin-right',
		'padding_top'                => 'padding-top',
		'padding_bottom'             => 'padding-bottom',
		'padding_left'               => 'padding-left',
		'padding_right'              => 'padding-right',
		'text_decoration'            => 'text-decoration',
		'text_transform'             => 'text-transform',
		'border_top_color'           => 'border-top-color',
		'border_top_style'           => 'border-top-style',
		'border_top_width'           => 'border-top-width',
		'border_bottom_color'        => 'border-bottom-color',
		'border_bottom_style'        => 'border-bottom-style',
		'border_bottom_width'        => 'border-bottom-width',
		'border_left_color'          => 'border-left-color',
		'border_left_style'          => 'border-left-style',
		'border_left_width'          => 'border-left-width',
		'border_right_color'         => 'border-right-color',
		'border_right_style'         => 'border-right-style',
		'border_right_width'         => 'border-right-width',
		'border_radius_top_left'     => 'border-top-left-radius',
		'border_radius_top_right'    => 'border-top-right-radius',
		'border_radius_bottom_right' => 'border-bottom-right-radius',
		'border_radius_bottom_left'  => 'border-bottom-left-radius',
	];
}

/**
 * Field Has Units
 *
 * @param string $prop Font control setting prop to check.
 * @return boolean true if the prop has units, otherwise false.
 */
function prop_has_units( $prop ) {
	return in_array(
		$prop,
		[
			'font_size',
			'letter_spacing',
			'margin_top',
			'margin_bottom',
			'margin_left',
			'margin_right',
			'padding_top',
			'padding_bottom',
			'padding_left',
			'padding_right',
			'border_top_width',
			'border_bottom_width',
			'border_left_width',
			'border_right_width',
			'border_radius_top_left',
			'border_radius_top_right',
			'border_radius_bottom_right',
			'border_radius_bottom_left',
		],
		true
	);
}


