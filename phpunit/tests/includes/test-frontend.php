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

	/**
	 * Test Variant Sorting
	 */
	public function test_variant_sorting() {
		// Broken Links.
		// https://fonts.googleapis.com/css2?display=swap&family=Raleway:wght@300;500;regular&family=Quattrocento
		// https://fonts.googleapis.com/css2?display=swap&family=Raleway:wght@500;600;300&family=Vollkorn+SC:wght@600
		// https://fonts.googleapis.com/css2?display=swap&family=Open+Sans:wght@regular;600
		$variants = [
			300,
			'600italic',
			500,
			'400',
			'italic',
		];

		usort(
			$variants,
			function( $a, $b ) {
				$a = \str_replace( 'italic', '', $a );
				$b = \str_replace( 'italic', '', $b );

				$font_weight_a = empty( $a ) ? '400' : $a;
				$font_weight_b = empty( $b ) ? '400' : $b;

				if ( $font_weight_a === $font_weight_b ) {
					return 0;
				}

				return ( $font_weight_a < $font_weight_b ) ? -1 : 1;
			}
		);

		$this->assertEquals(
			$variants,
			[
				300,
				'400',
				'italic',
				500,
				'600italic',
			]
		);
	}
}
