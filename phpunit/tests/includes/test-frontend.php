<?php
/**
 * Test Frontend Functionality
 *
 * Test posttype registration and any CRUD
 * functionality.
 *
 * @package easy-google-fonts
 */

use EGF\Frontend as Frontend;

/**
 * Class EGF_Test_Frontend
 */
class EGF_Test_Frontend extends WP_UnitTestCase {
	/**
	 * Test Prop Has Units
	 */
	public function test_prop_has_units() {
		$this->assertIsBool( Frontend\prop_has_units( 'invalid' ) );
		$this->assertIsBool( Frontend\prop_has_units( 'font_size' ) );
	}
}
