<?php
/**
 * Custom background feature
 *
 * @package Some
 */

/**
 * Adds support for the WordPress 'custom-background' theme feature.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function some_custom_background_setup() {

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'some_custom_background_args', array(
		'default-color' => '32313b',
		'default-image' => '',
	) ) );
	
}
add_action( 'after_setup_theme', 'some_custom_background_setup', 15 );
