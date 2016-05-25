<?php
/**
 * Some Theme Customizer.
 *
 * @package Some
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function some_customize_register( $wp_customize ) {
	
	// Add the theme panel.
	$wp_customize->add_panel(
		'theme',
		array(
			'title'    => esc_html__( 'Theme Settings', 'some' ),
			'priority' => 10
		)
	);
	
	// Add the front-page section.
	$wp_customize->add_section(
		'front-page',
		array(
			'title'       => esc_html__( 'Front Page', 'some' ),
			'priority'    => 20,
			'panel'       => 'theme'
		)
	);
	
	// Add the blog area title setting.
	$wp_customize->add_setting(
		'blog_area_title',
		array(
			'default'           => esc_html__( 'Blog', 'some' ),
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
 	
	// Add the blog area title control.
	$wp_customize->add_control(
		'blog_area_title',
		array(
			'label'    => esc_html__( 'Blog title', 'some' ),
			'section'  => 'front-page',
			'priority' => 10,
			'type'     => 'text'
		)
	);
	
	// Add the blog area text setting.
	$wp_customize->add_setting(
		'blog_area_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'some_sanitize_textarea'
		)
	);
 	
	// Add the blog area text control.
	$wp_customize->add_control(
		'blog_area_text',
		array(
			'label'    => esc_html__( 'Blog text', 'some' ),
			'section'  => 'front-page',
			'priority' => 10,
			'type'     => 'textarea'
		)
	);
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'some_customize_register' );

/**
 * Sanitizes the footer content on the customize screen. Users with the 'unfiltered_html' cap can post 
 * anything. For other users, wp_filter_post_kses() is ran over the setting.
 *
 * @since 1.0.0
 */
function some_sanitize_textarea( $setting, $object ) {
	
	// Make sure we kill evil scripts from users without the 'unfiltered_html' cap.
	if ( 'blog_area_text' == $object->id && ! current_user_can( 'unfiltered_html' ) ) {
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
	}
	// Return the sanitized setting.
	return $setting;
	
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function some_customize_preview_js() {
	wp_enqueue_script( 'some_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'some_customize_preview_js' );
