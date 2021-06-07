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
