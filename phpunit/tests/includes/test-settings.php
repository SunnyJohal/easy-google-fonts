<?php
/**
 * Test Settings
 *
 * Test plugin settings and defaults.
 *
 * @package easy-google-fonts
 */

use EGF\Settings as Settings;

/**
 * Class EGF_Test_Settings
 */
class EGF_Test_Settings extends WP_UnitTestCase {

	/**
	 * Test Get Settings Config
	 */
	public function test_get_settings_config() {
		$config = Settings\get_settings_config();
		$keys   = [
			'tt_default_body',
			'tt_default_heading_1',
			'tt_default_heading_2',
			'tt_default_heading_3',
			'tt_default_heading_4',
			'tt_default_heading_5',
			'tt_default_heading_6',
		];

		$this->assertIsArray( $config );

		foreach ( $keys as $key ) {
			$this->assertIsArray( $config[ $key ] );
			$this->assertNotEmpty( $config[ $key ]['name'] );
			$this->assertNotEmpty( $config[ $key ]['title'] );
			$this->assertNotEmpty( $config[ $key ]['description'] );
			$this->assertNotEmpty( $config[ $key ]['properties'] );
			$this->assertNotEmpty( $config[ $key ]['properties']['selector'] );

			$this->assertArrayHasKey( 'type', $config[ $key ] );
		}
	}

	/**
	 * Test Get Custom Settings Config
	 */
	public function test_get_custom_settings_config() {
		// No controls.
		$this->assertIsArray( Settings\get_custom_settings_config() );
		$this->assertSame( count( Settings\get_custom_settings_config() ), 0 );

		self::factory()->post->create_many( 3, [ 'post_type' => 'tt_font_control' ] );
		$font_controls = Settings\get_custom_settings_config();

		$this->assertIsArray( $font_controls );
		$this->assertSame( count( $font_controls ), 3 );
	}

	/**
	 * Test Parse Config Args
	 */
	public function test_parse_config_args() {
		$config = [
			'test_config' => [
				'name'       => 'test_config',
				'title'      => 'Test Config',
				'desciption' => 'Example description',
				'properties' => [ 'selector' ],
			],
		];

		$parsed_config = array_map(
			'EGF\Settings\parse_config_args',
			$config
		);

		$this->assertIsArray( $parsed_config );
		$this->assertArrayHasKey( 'test_config', $parsed_config );
		$this->assertIsArray( $parsed_config['test_config'] );

		// Test the parsed array.
		$test_config_props = $parsed_config['test_config'];
		$this->assertArrayHasKey( 'title', $test_config_props );
		$this->assertArrayHasKey( 'type', $test_config_props );
		$this->assertArrayHasKey( 'description', $test_config_props );
		$this->assertArrayHasKey( 'panel', $test_config_props );
		$this->assertArrayHasKey( 'section', $test_config_props );
		$this->assertArrayHasKey( 'transport', $test_config_props );

		// Properties.
		$this->assertArrayHasKey( 'properties', $test_config_props );
		$this->assertIsArray( $test_config_props['properties'] );
		$this->assertArrayHasKey( 'selector', $test_config_props['properties'] );
		$this->assertArrayHasKey( 'force_styles', $test_config_props['properties'] );
		$this->assertArrayHasKey( 'min_screen', $test_config_props['properties'] );
		$this->assertArrayHasKey( 'amount', $test_config_props['properties']['min_screen'] );
		$this->assertArrayHasKey( 'unit', $test_config_props['properties']['min_screen'] );
		$this->assertArrayHasKey( 'max_screen', $test_config_props['properties'] );
		$this->assertArrayHasKey( 'amount', $test_config_props['properties']['max_screen'] );
		$this->assertArrayHasKey( 'unit', $test_config_props['properties']['max_screen'] );
		$this->assertArrayHasKey( 'linked_control_id', $test_config_props['properties'] );

		// Defaults.
		$this->assertArrayHasKey( 'default', $test_config_props );
		$this->assertIsArray( $test_config_props['default'] );
		$this->assertArrayHasKey( 'subset', $test_config_props['default'] );
		$this->assertArrayHasKey( 'font_id', $test_config_props['default'] );
		$this->assertArrayHasKey( 'font_name', $test_config_props['default'] );
		$this->assertArrayHasKey( 'font_color', $test_config_props['default'] );
		$this->assertArrayHasKey( 'font_weight', $test_config_props['default'] );
		$this->assertArrayHasKey( 'font_style', $test_config_props['default'] );
		$this->assertArrayHasKey( 'font_weight_style', $test_config_props['default'] );
		$this->assertArrayHasKey( 'background_color', $test_config_props['default'] );
		$this->assertArrayHasKey( 'stylesheet_url', $test_config_props['default'] );
		$this->assertArrayHasKey( 'text_decoration', $test_config_props['default'] );
		$this->assertArrayHasKey( 'text_transform', $test_config_props['default'] );
		$this->assertArrayHasKey( 'line_height', $test_config_props['default'] );
		$this->assertArrayHasKey( 'display', $test_config_props['default'] );
		$this->assertArrayHasKey( 'font_size', $test_config_props['default'] );
		$this->assertArrayHasKey( 'letter_spacing', $test_config_props['default'] );
		$this->assertArrayHasKey( 'margin_top', $test_config_props['default'] );
		$this->assertArrayHasKey( 'margin_right', $test_config_props['default'] );
		$this->assertArrayHasKey( 'margin_bottom', $test_config_props['default'] );
		$this->assertArrayHasKey( 'margin_left', $test_config_props['default'] );
		$this->assertArrayHasKey( 'padding_top', $test_config_props['default'] );
		$this->assertArrayHasKey( 'padding_right', $test_config_props['default'] );
		$this->assertArrayHasKey( 'padding_bottom', $test_config_props['default'] );
		$this->assertArrayHasKey( 'padding_left', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_radius_top_left', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_radius_top_right', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_radius_bottom_right', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_radius_bottom_left', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_top_color', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_top_style', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_top_width', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_bottom_color', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_bottom_style', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_bottom_width', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_left_color', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_left_style', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_left_width', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_right_color', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_right_style', $test_config_props['default'] );
		$this->assertArrayHasKey( 'border_right_width', $test_config_props['default'] );
	}

	/**
	 * Test Parse Config Args
	 */
	public function test_get_settings() {
		$settings = Settings\get_saved_settings();
		$this->assertIsArray( $settings );

		// Test defaults.
		$this->assertArrayHasKey( 'tt_default_body', $settings );
		$this->assertArrayHasKey( 'tt_default_heading_1', $settings );
		$this->assertArrayHasKey( 'tt_default_heading_2', $settings );
		$this->assertArrayHasKey( 'tt_default_heading_3', $settings );
		$this->assertArrayHasKey( 'tt_default_heading_4', $settings );
		$this->assertArrayHasKey( 'tt_default_heading_5', $settings );
		$this->assertArrayHasKey( 'tt_default_heading_6', $settings );

		// Set option and test the font creation option.
		$settings['option_to_prune'] = [];
		update_option( 'tt_font_theme_options', $settings );

		$updated_settings = Settings\get_saved_settings();
		$this->assertArrayNotHasKey( 'option_to_prune', $updated_settings );
	}

	/**
	 * Test Settings Defaults
	 */
	public function test_setting_defaults() {
		$config   = Settings\get_settings_config();
		$defaults = Settings\get_setting_defaults();

		$this->assertIsArray( $defaults );

		foreach ( $config as $setting_key => $props ) {
			$this->assertArrayHasKey( $setting_key, $defaults );
		}
	}

	/**
	 * Test get linked settings.
	 */
	public function test_get_linked_settings() {
		add_filter(
			'egf_get_settings_config',
			function( $config ) {
				$config['tt_default_heading_1']['properties']['linked_control_id'] = 'tt_default_body';
				return $config;
			},
			10,
			1
		);

		$linked_settings = Settings\get_linked_settings( 'tt_default_body' );

		$this->assertIsArray( $linked_settings );
		$this->assertContains( 'tt_default_heading_1', $linked_settings );
		$this->assertNotContains( 'tt_default_body', $linked_settings );
		$this->assertNotContains( 'tt_default_heading_2', $linked_settings );
		$this->assertNotContains( 'tt_default_heading_3', $linked_settings );
		$this->assertNotContains( 'tt_default_heading_4', $linked_settings );
		$this->assertNotContains( 'tt_default_heading_5', $linked_settings );
		$this->assertNotContains( 'tt_default_heading_6', $linked_settings );
	}
}
