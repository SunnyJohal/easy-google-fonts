<?php
/**
 * Test Data Functionality
 *
 * Test posttype registration and any CRUD
 * functionality.
 *
 * @package easy-google-fonts
 */

use EGF\Data as Data;

/**
 * Class ECS_Test_Data
 */
class EGF_Test_Data extends WP_UnitTestCase {
	/**
	 * ID of font control instance.
	 *
	 * @var int $post_id
	 */
	protected static $post_id;

	/**
	 * ID of temp user created for tests.
	 *
	 * @var int $user_id
	 */
	protected static $user_id;

	/**
	 * Setup before any class tests are run.
	 *
	 * @param object $factory Factory obj for generating WordPress fixtures.
	 */
	public static function wpSetUpBeforeClass( $factory ) {
		self::$post_id = $factory->post->create( [ 'post_type' => 'tt_font_control' ] );
	}

	/**
	 * Clean up after all class tests are run.
	 */
	public static function wpTearDownAfterClass() {
		wp_delete_post( self::$post_id, true );
	}

	/**
	 * Test Posttype Creation for font controls.
	 */
	public function test_register_post_type_for_font_controls() {
		$this->assertTrue(
			post_type_exists( 'tt_font_control' ),
			'Failed to register the post type.'
		);
	}

	/**
	 * Test Posttype supported features.
	 */
	public function test_supported_features() {
		$this->assertTrue(
			post_type_supports( 'tt_font_control', 'title' ),
			'Font controls needs to opt in for title support.'
		);

		$this->assertTrue(
			post_type_supports( 'tt_font_control', 'custom-fields' ),
			'Font control post type needs to opt in for custom field support.'
		);
	}

	/**
	 * Test Get Font Control ID
	 */
	public function test_get_font_control_id() {
		$font_control_id = Data\get_font_control_id( self::$post_id );

		$this->assertEquals(
			$font_control_id,
			'egf-font-control-' . self::$post_id
		);
	}

	/**
	 * Test Get Font Control Description
	 */
	public function test_get_font_control_description() {
		$description = 'This is an example font control description';
		update_post_meta( self::$post_id, 'control_description', $description );

		// Valid font control id.
		$this->assertEquals(
			Data\get_font_control_description( self::$post_id ),
			$description
		);

		// Invalid font control id.
		$this->assertEquals(
			Data\get_font_control_description( 0 ),
			false
		);
	}

	/**
	 * Test Get Font Control Selectors
	 */
	public function test_get_font_control_selectors() {
		$selectors = [ '.test-class .with-selector', '#random-id' ];

		// Ensure arr when no value is passed.
		$this->assertIsArray( Data\get_font_control_selectors( self::$post_id ) );

		update_post_meta( self::$post_id, 'control_selectors', $selectors );

		$this->assertEquals(
			Data\get_font_control_selectors( self::$post_id ),
			$selectors
		);
	}
}

