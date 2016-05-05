<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Some
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses some_header_style()
 */
function some_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'some_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 1920,
		'height'                 => 600,
		'flex-height'            => true,
		'wp-head-callback'       => 'some_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'some_custom_header_setup', 15 );

/**
 * Styles the header image and text displayed on the blog.
 *
 * @see some_custom_header_setup().
 */
function some_header_style() {
	
	// Header text color.
	$header_color = get_header_textcolor();
	
	// Header image.
	$header_image = esc_url( get_header_image() );
	
	// Start header styles.
	$style = '';
	
	// Header image height.
	$header_height = get_custom_header()->height;
	
	// Header image width.
	$header_width = get_custom_header()->width;
	
	// When to show header image.
	$min_width = absint( apply_filters( 'some_header_bg_show', 1 ) );
	
	// Background arguments.
	$background_arguments = esc_attr( apply_filters( 'some_header_bg_arguments', 'no-repeat 50% 50%' ) );
	
	if ( ! empty( $header_image ) ) {
		$style .= "@media screen and (min-width: {$min_width}em) { body.custom-header-image .site-header { background-image: url({$header_image}) } }";
	}
	
	/* Site title styles. */
	if ( display_header_text() ) {
		$style .= ".site-title, .site-title a, .site-description, .site-description a { color: #{$header_color} }";
		$style .= ".site-title a { border-color: #{$header_color} }";
	}
	
	if ( ! display_header_text() ) {
		$style .= ".site-title, .site-description { clip: rect(1px, 1px, 1px, 1px); position: absolute; }";	
	}
	
	/* Echo styles if it's not empty. */
	if ( ! empty( $style ) ) {
		echo "\n" . '<style type="text/css" id="custom-header-css">' . trim( $style ) . '</style>' . "\n";
	}

}
