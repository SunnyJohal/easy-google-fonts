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

use EGF\Data as Data;

/**
 * Register Typography Settings
 */
function register_settings() {
	register_setting( 'tt_font_theme_options', 'tt_font_theme_options' );
}
add_action( 'admin_init', __NAMESPACE__ . '\\register_settings' );

/**
 * Get Plugin Settings Config
 *
 * All settings that are registered for this theme
 * are contained within this $settings array.
 *
 * @return array $settings All theme settings.
 */
function get_settings_config() {
	$default_config = [
		'tt_default_body'      => [
			'name'        => 'tt_default_body',
			'title'       => __( 'Paragraphs', 'easy-google-fonts' ),
			'description' => __( "Please select a font for the theme's body and paragraph text.", 'easy-google-fonts' ),
			'properties'  => [ 'selector' => 'p' ],
		],
		'tt_default_heading_1' => [
			'name'        => 'tt_default_heading_1',
			'title'       => __( 'Heading 1', 'easy-google-fonts' ),
			'description' => __( "Please select a font for the theme's heading 1 styles.", 'easy-google-fonts' ),
			'properties'  => [ 'selector' => 'h1' ],
		],
		'tt_default_heading_2' => [
			'name'        => 'tt_default_heading_2',
			'title'       => __( 'Heading 2', 'easy-google-fonts' ),
			'description' => __( "Please select a font for the theme's heading 2 styles.", 'easy-google-fonts' ),
			'properties'  => [ 'selector' => 'h2' ],
		],
		'tt_default_heading_3' => [
			'name'        => 'tt_default_heading_3',
			'title'       => __( 'Heading 3', 'easy-google-fonts' ),
			'description' => __( "Please select a font for the theme's heading 3 styles.", 'easy-google-fonts' ),
			'properties'  => [ 'selector' => 'h3' ],
		],
		'tt_default_heading_4' => [
			'name'        => 'tt_default_heading_4',
			'title'       => __( 'Heading 4', 'easy-google-fonts' ),
			'description' => __( "Please select a font for the theme's heading 4 styles.", 'easy-google-fonts' ),
			'properties'  => [ 'selector' => 'h4' ],
		],
		'tt_default_heading_5' => [
			'name'        => 'tt_default_heading_5',
			'title'       => __( 'Heading 5', 'easy-google-fonts' ),
			'description' => __( "Please select a font for the theme's heading 5 styles.", 'easy-google-fonts' ),
			'properties'  => [ 'selector' => 'h5' ],
		],
		'tt_default_heading_6' => [
			'name'        => 'tt_default_heading_6',
			'title'       => __( 'Heading 6', 'easy-google-fonts' ),
			'description' => __( "Please select a font for the theme's heading 6 styles.", 'easy-google-fonts' ),
			'properties'  => [ 'selector' => 'h6' ],
		],
	];

	$config = array_map(
		__NAMESPACE__ . '\\parse_config_args',
		wp_parse_args( $default_config, get_custom_settings_config() )
	);

	return apply_filters( 'egf_get_settings_config', $config );
}

/**
 * Get Custom Settings Config
 *
 * Gets any custom font controls created
 * by the user.
 *
 * @return array $settings All theme settings.
 */
function get_custom_settings_config() {
	$all_font_controls = new \WP_Query(
		[
			'post_type'      => 'tt_font_control',
			'posts_per_page' => -1,
			'order_by'       => 'title',
			'order'          => 'ASC',
			'fields'         => 'ids',
		]
	);

	return array_reduce(
		$all_font_controls->posts,
		function( $config, $font_control_id ) {
			$config[ Data\get_font_control_id( $font_control_id ) ] = [
				'name'        => Data\get_font_control_id( $font_control_id ),
				'type'        => 'font',
				'title'       => get_the_title( $font_control_id ),
				'description' => Data\get_font_control_description( $font_control_id ),
				'panel'       => 'egf_typography_panel',
				'section'     => 'theme_typography',
				'transport'   => 'postMessage',
				'properties'  => [
					'selector'     => \implode( ', ', Data\get_font_control_selectors( $font_control_id ) ),
					'force_styles' => Data\get_font_control_force_styles( $font_control_id ),
				],
			];

			return $config;
		},
		[]
	);
}

/**
 * Parse Settings Config
 *
 * Callback func to set all required props
 * for each setting config.Parses config
 * against a set of defaults (allowing devs
 * to quickly add config without setting
 * every property).
 *
 * @param array $config_arr Config properties.
 */
function parse_config_args( $config_arr ) {
	$defaults = [
		'title'             => __( 'Font Control', 'easy-google-fonts' ),
		'type'              => 'font',
		'description'       => '',
		'panel'             => 'egf_typography_panel',
		'section'           => 'typography',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'EGF\Sanitization\sanitize_font_control',
		'properties'        => [
			'selector'                 => '',
			'force_styles'             => apply_filters( 'tt_font_force_styles', false ),
			'font_size_min_range'      => apply_filters( 'tt_font_size_min_range', 10 ),
			'font_size_max_range'      => apply_filters( 'tt_font_size_max_range', 100 ),
			'font_size_step'           => apply_filters( 'tt_font_size_step', 1 ),
			'line_height_min_range'    => apply_filters( 'tt_font_line_height_min_range', 0.8 ),
			'line_height_max_range'    => apply_filters( 'tt_font_line_height_max_range', 4 ),
			'line_height_step'         => apply_filters( 'tt_font_line_height_step', 0.1 ),
			'letter_spacing_min_range' => apply_filters( 'tt_font_letter_spacing_min_range', -5 ),
			'letter_spacing_max_range' => apply_filters( 'tt_font_letter_spacing_max_range', 20 ),
			'letter_spacing_step'      => apply_filters( 'tt_font_letter_spacing_step', 1 ),
			'margin_min_range'         => apply_filters( 'tt_font_margin_min_range', 0 ),
			'margin_max_range'         => apply_filters( 'tt_font_margin_max_range', 400 ),
			'margin_step'              => apply_filters( 'tt_font_margin_step', 1 ),
			'padding_min_range'        => apply_filters( 'tt_font_padding_min_range', 0 ),
			'padding_max_range'        => apply_filters( 'tt_font_padding_max_range', 400 ),
			'padding_step'             => apply_filters( 'tt_font_padding_step', 1 ),
			'border_min_range'         => apply_filters( 'tt_font_border_min_range', 0 ),
			'border_max_range'         => apply_filters( 'tt_font_border_max_range', 100 ),
			'border_step'              => apply_filters( 'tt_font_border_step', 1 ),
			'border_radius_min_range'  => apply_filters( 'tt_font_border_radius_min_range', 0 ),
			'border_radius_max_range'  => apply_filters( 'tt_font_border_radius_max_range', 100 ),
			'border_radius_step'       => apply_filters( 'tt_font_border_radius_step', 1 ),
			'min_screen'               => [
				'amount' => '',
				'unit'   => 'px',
			],
			'max_screen'               => [
				'amount' => '',
				'unit'   => 'px',
			],
			'linked_control_id'        => false,
		],
		'default'           => [
			'subset'                     => 'latin,all',
			'font_id'                    => 'roboto',
			'font_name'                  => '',
			'font_color'                 => '',
			'font_weight'                => '',
			'font_style'                 => '',
			'font_weight_style'          => '',
			'background_color'           => '',
			'stylesheet_url'             => '',
			'text_decoration'            => '',
			'text_transform'             => '',
			'line_height'                => '',
			'display'                    => '',
			'font_size'                  => [
				'amount' => '',
				'unit'   => 'px',
			],
			'letter_spacing'             => [
				'amount' => '',
				'unit'   => 'px',
			],
			'margin_top'                 => [
				'amount' => '',
				'unit'   => 'px',
			],
			'margin_right'               => [
				'amount' => '',
				'unit'   => 'px',
			],
			'margin_bottom'              => [
				'amount' => '',
				'unit'   => 'px',
			],
			'margin_left'                => [
				'amount' => '',
				'unit'   => 'px',
			],
			'padding_top'                => [
				'amount' => '',
				'unit'   => 'px',
			],
			'padding_right'              => [
				'amount' => '',
				'unit'   => 'px',
			],
			'padding_bottom'             => [
				'amount' => '',
				'unit'   => 'px',
			],
			'padding_left'               => [
				'amount' => '',
				'unit'   => 'px',
			],
			'border_radius_top_left'     => [
				'amount' => '',
				'unit'   => 'px',
			],
			'border_radius_top_right'    => [
				'amount' => '',
				'unit'   => 'px',
			],
			'border_radius_bottom_right' => [
				'amount' => '',
				'unit'   => 'px',
			],
			'border_radius_bottom_left'  => [
				'amount' => '',
				'unit'   => 'px',
			],
			'border_top_color'           => '',
			'border_top_style'           => '',
			'border_top_width'           => [
				'amount' => '',
				'unit'   => 'px',
			],
			'border_bottom_color'        => '',
			'border_bottom_style'        => '',
			'border_bottom_width'        => [
				'amount' => '',
				'unit'   => 'px',
			],
			'border_left_color'          => '',
			'border_left_style'          => '',
			'border_left_width'          => [
				'amount' => '',
				'unit'   => 'px',
			],
			'border_right_color'         => '',
			'border_right_style'         => '',
			'border_right_width'         => [
				'amount' => '',
				'unit'   => 'px',
			],
		],
	];

	if ( isset( $config_arr['properties'] ) ) {
		$config_arr['properties'] = wp_parse_args( $config_arr['properties'], $defaults['properties'] );
	}

	if ( isset( $config_arr['default'] ) ) {
		$config_arr['default'] = wp_parse_args( $config_arr['default'], $defaults['properties'] );
	}

	return wp_parse_args( $config_arr, $defaults );
}

/**
 * Get Saved plugin Settings
 *
 * Returns the saved values for each setting in
 * the plugin. If no value exists for a particular
 * setting then it will use the default value as
 * as fallback.
 *
 * @return array Saved plugin settings.
 */
function get_saved_settings() {
	return apply_filters(
		'egf_get_saved_settings',
		get_option( 'tt_font_theme_options', [] )
	);
}

/**
 * Parse Options With Defaults
 */
add_filter(
	'egf_get_saved_settings',
	function( $settings ) {
		return array_intersect_key(
			wp_parse_args( $settings, get_setting_defaults() ),
			get_setting_defaults()
		);
	},
	10,
	1
);

/**
 * Get Default Theme Settings
 *
 * Returns all registered settings with their default
 * values in order to parse the currrent settings with
 * the defaults.
 *
 * @return array $default_settings - Associative array containing the setting id
 *                                   and its corresponding default value.
 */
function get_setting_defaults() {
	return array_map(
		function( $config ) {
			return $config['default'];
		},
		get_settings_config()
	);
}

/**
 * Get Linked Settings
 *
 * Gets settings that are designed to be
 * linked to one another.
 *
 * @param string $setting_key The key you want to fetch linked settings for.
 */
function get_linked_settings( $setting_key ) {
	return array_keys(
		array_filter(
			get_settings_config(),
			function( $config ) use ( $setting_key ) {
				return $setting_key === $config['properties']['linked_control_id'];
			}
		)
	);
}
