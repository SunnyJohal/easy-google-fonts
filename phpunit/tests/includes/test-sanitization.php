<?php
/**
 * Test Sanitization Functionality
 *
 * Test data sanitization for settings.
 *
 * @package easy-google-fonts
 */

use EGF\Sanitization as Sanitization;

/**
 * Class EGF_Test_Sanitization
 */
class EGF_Test_Sanitization extends WP_UnitTestCase {
	/**
	 * Test Get Settings Config
	 */
	public function test_sanitize_unit() {
		$valid_input = [
			'amount' => 12,
			'unit'   => 'px',
		];

		$this->assertIsArray( Sanitization\sanitize_unit( $valid_input, '_' ) );
		$this->assertArrayHasKey( 'amount', Sanitization\sanitize_unit( $valid_input, '_' ) );
		$this->assertArrayHasKey( 'unit', Sanitization\sanitize_unit( $valid_input, '_' ) );

		$invalid_input = [];
		$this->assertIsArray( Sanitization\sanitize_unit( $invalid_input, '_' ) );
		$this->assertArrayHasKey( 'amount', Sanitization\sanitize_unit( $invalid_input, '_' ) );
		$this->assertArrayHasKey( 'unit', Sanitization\sanitize_unit( $invalid_input, '_' ) );
	}

	/**
	 * Test Sanitize Color
	 */
	public function test_sanitize_color() {
		$hex_color  = '#C5000E';
		$rgb_color  = 'rgb(255, 196, 229)';
		$rgba_color = 'rgba(110, 87, 186, 0.7)';
		$hsl_color  = 'hsl(0, 100%, 50%)';
		$hsla_color = 'hsla(328, 100%, 44%, 0.77)';

		$this->assertEquals( Sanitization\sanitize_color( $hex_color, '_' ), $hex_color );
		$this->assertEquals( Sanitization\sanitize_color( $rgb_color, '_' ), $rgb_color );
		$this->assertEquals( Sanitization\sanitize_color( $rgba_color, '_' ), $rgba_color );
		$this->assertEquals( Sanitization\sanitize_color( $hsl_color, '_' ), $hsl_color );
		$this->assertEquals( Sanitization\sanitize_color( $hsla_color, '_' ), $hsla_color );
	}

	/**
	 * Test Sanitize Color
	 */
	public function test_sanitize_text_decoration() {
		$this->assertEquals( Sanitization\sanitize_text_decoration( 'none', '_' ), 'none' );
		$this->assertEquals( Sanitization\sanitize_text_decoration( 'underline', '_' ), 'underline' );
		$this->assertEquals( Sanitization\sanitize_text_decoration( 'line-through', '_' ), 'line-through' );
		$this->assertEquals( Sanitization\sanitize_text_decoration( 'overline', '_' ), 'overline' );
		$this->assertEquals( Sanitization\sanitize_text_decoration( 'invalid', '_' ), '' );
	}

	/**
	 * Test Sanitize Text Transform
	 */
	public function test_sanitize_text_transform() {
		$this->assertEquals( Sanitization\sanitize_text_transform( 'none', '_' ), 'none' );
		$this->assertEquals( Sanitization\sanitize_text_transform( 'uppercase', '_' ), 'uppercase' );
		$this->assertEquals( Sanitization\sanitize_text_transform( 'lowercase', '_' ), 'lowercase' );
		$this->assertEquals( Sanitization\sanitize_text_transform( 'capitalize', '_' ), 'capitalize' );
		$this->assertEquals( Sanitization\sanitize_text_transform( 'invalid', '_' ), '' );
	}

	/**
	 * Test Sanitize Line Height
	 */
	public function test_sanitize_line_height() {
		$this->assertEquals( Sanitization\sanitize_line_height( '1.1', '_' ), 1.1 );
		$this->assertEquals( Sanitization\sanitize_line_height( 2, '_' ), 2 );
		$this->assertEquals( Sanitization\sanitize_line_height( '0', '_' ), '' );
		$this->assertEquals( Sanitization\sanitize_line_height( 0, '_' ), '' );
		$this->assertEquals( Sanitization\sanitize_line_height( 'invalid', '_' ), '' );
	}

	/**
	 * Test Sanitize Display
	 */
	public function test_sanitize_display() {
		$this->assertEquals( Sanitization\sanitize_display( 'block', '_' ), 'block' );
		$this->assertEquals( Sanitization\sanitize_display( 'inline-block', '_' ), 'inline-block' );
		$this->assertEquals( Sanitization\sanitize_display( 'flex', '_' ), 'flex' );
		$this->assertEquals( Sanitization\sanitize_display( 'invalid', '_' ), '' );
	}

	/**
	 * Test Sanitize Border Style
	 */
	public function test_sanitize_border_style() {
		$this->assertEquals( Sanitization\sanitize_border_style( 'none', '_' ), 'none' );
		$this->assertEquals( Sanitization\sanitize_border_style( 'solid', '_' ), 'solid' );
		$this->assertEquals( Sanitization\sanitize_border_style( 'dashed', '_' ), 'dashed' );
		$this->assertEquals( Sanitization\sanitize_border_style( 'dotted', '_' ), 'dotted' );
		$this->assertEquals( Sanitization\sanitize_border_style( 'double', '_' ), 'double' );
		$this->assertEquals( Sanitization\sanitize_border_style( 'groove', '_' ), 'groove' );
		$this->assertEquals( Sanitization\sanitize_border_style( 'invalid', '_' ), '' );
	}
}
