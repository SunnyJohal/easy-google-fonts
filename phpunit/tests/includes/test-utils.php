<?php
/**
 * Test Utils Functionality
 *
 * Test helper functionality.
 *
 * @package easy-google-fonts
 */

use EGF\Utils as Utils;

/**
 * Class EGF_Test_Utils
 */
class EGF_Test_Utils extends WP_UnitTestCase {
	/**
	 * Test get linked settings.
	 */
	public function test_get_google_api_key() {
		$api_key = 'test-api-key';

		update_option( 'tt-font-google-api-key', $api_key );

		$this->assertEquals(
			Utils\get_google_api_key(),
			$api_key
		);
	}

	/**
	 * Test get key from setting id.
	 */
	public function test_get_key_from_setting_id() {
		$this->assertEquals(
			Utils\get_key_from_setting_id( 'tt_font_theme_options[setting_key]' ),
			'setting_key'
		);

		$this->assertEquals(
			Utils\get_key_from_setting_id( 'test_option_prefix[setting_key]', 'test_option_prefix' ),
			'setting_key'
		);

		$this->assertEquals(
			Utils\get_key_from_setting_id( 'test_option_prefix[setting_key][with_prop]', 'test_option_prefix' ),
			'setting_key'
		);
	}

	/**
	 * Test Get Default Fonts
	 */
	public function test_get_default_fonts() {
		$default_fonts = Utils\get_default_fonts();

		$this->assertIsArray( $default_fonts );

		foreach ( $default_fonts as $id => $props ) {
			$this->assertArrayHasKey( 'name', $props );
			$this->assertArrayHasKey( 'variants', $props );
		}
	}

	/**
	 * Test Get Color Palette
	 */
	public function test_get_theme_color_palette() {
		$default_colors = $this->get_default_color_palette();
		$custom_colors  = $this->get_custom_color_palette();

		// Theme that hasn't declared editor-color-palette support.
		$this->assertIsArray( Utils\get_theme_color_palette() );
		$this->assertEquals(
			Utils\get_theme_color_palette(),
			$default_colors
		);

		// Theme that has declared editor-color-palette support.
		add_theme_support( 'editor-color-palette', $custom_colors );

		$this->assertIsArray( Utils\get_theme_color_palette() );
		$this->assertEquals(
			Utils\get_theme_color_palette(),
			$custom_colors
		);
	}

	/**
	 * Get Default Color Palette
	 */
	public function get_default_color_palette() {
		return [
			[
				'name'  => 'Black',
				'color' => '#000000',
			],
			[
				'name'  => 'White',
				'color' => '#ffffff',
			],
			[
				'name'  => 'Red',
				'color' => '#f44336',
			],
			[
				'name'  => 'Orange',
				'color' => '#ff5722',
			],
			[
				'name'  => 'Yellow',
				'color' => '#ffeb3b',
			],
			[
				'name'  => 'Green',
				'color' => '#4caf50',
			],
			[
				'name'  => 'Blue',
				'color' => '#2196f3',
			],
			[
				'name'  => 'Purple',
				'color' => '#673ab7',
			],
		];
	}

	/**
	 * Get Custom Color Palette
	 */
	public function get_custom_color_palette() {
		return [
			[
				'name'  => 'Black',
				'color' => '#000000',
			],
			[
				'name'  => 'Dark gray',
				'color' => '#28303D',
			],
			[
				'name'  => 'Gray',
				'color' => '#39414D',
			],
			[
				'name'  => 'Green',
				'color' => '#D1E4DD',
			],
			[
				'name'  => 'Blue',
				'color' => '#D1DFE4',
			],
			[
				'name'  => 'Purple',
				'color' => '#D1D1E4',
			],
			[
				'name'  => 'Red',
				'color' => '#E4D1D1',
			],
			[
				'name'  => 'Orange',
				'color' => '#E4DAD1',
			],
			[
				'name'  => 'Yellow',
				'color' => '#EEEADD',
			],
			[
				'name'  => 'White',
				'color' => '#FFFFFF',
			],
		];
	}
}
