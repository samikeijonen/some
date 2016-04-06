<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Some
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function some_body_classes( $classes ) {
	
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	// Footer widget area count.
	$footer_widget_count = 0;
	if( is_active_sidebar( 'footer-1' ) ) {
		$footer_widget_count++;
	}
	if( is_active_sidebar( 'footer-2' ) ) {
		$footer_widget_count++;
	}
	if( is_active_sidebar( 'footer-3' ) ) {
		$footer_widget_count++;
	}
	
	$classes[] = 'footer-widgets-' . $footer_widget_count;
	
	return $classes;
}
add_filter( 'body_class', 'some_body_classes' );
