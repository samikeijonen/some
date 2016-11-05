<?php
/**
 * Some functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Some
 */
 
/**
 * The suffix to use for scripts.
 */
if ( ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ) {
	define( 'SOME_SUFFIX', '' );
} else {
	define( 'SOME_SUFFIX', '.min' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function some_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Some, use a find and replace
	 * to change 'some' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'some', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 920, 575, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'some' ),
		'social'  => esc_html__( 'Social Links', 'some' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	// Add support for selective refresh widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// Add support for logo.
	add_theme_support( 'custom-logo', array(
		'height' => 180,
		'width'  => 180,
	) );
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css', some_fonts_url() ) );
}
add_action( 'after_setup_theme', 'some_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function some_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'some_content_width', 780 );
}
add_action( 'after_setup_theme', 'some_content_width', 0 );

/**
 * Register Google fonts.
 *
 * @since 1.0.0
 *
 * @return string Google fonts URL for the theme.
 */
function some_fonts_url() {

	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Source Sans Pro, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_attr_x( 'on', 'Source Sans Pro font: on or off', 'some' ) ) {
		$fonts[] = 'Source Sans Pro:400,600,700,400italic,600italic,700italic';
	}
	
	/* translators: If there are characters in your language that are not supported by Oxygen, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_attr_x( 'on', 'Oxygen font: on or off', 'some' ) ) {
		$fonts[] = 'Oxygen:400,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function some_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget area 1', 'some' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here for footer widget area 1.', 'some' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget area 2', 'some' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here for footer widget area 2.', 'some' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget area 3', 'some' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here for footer widget area 3.', 'some' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
}
add_action( 'widgets_init', 'some_widgets_init' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 */
function some_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'some_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function some_scripts() {
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'some-fonts', some_fonts_url(), array(), null );
	
	// Add parent theme styles if using child theme.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'some-parent-style', trailingslashit( get_template_directory_uri() ) . 'style' . SOME_SUFFIX . '.css', array(), null );
	}
	
	// Add theme styles.
	wp_enqueue_style( 'some-style', get_stylesheet_uri() );
	
	// Add theme scripts.
	wp_enqueue_script( 'some-navigation', get_template_directory_uri() . '/assets/js/navigation' . SOME_SUFFIX . '.js', array(), '20160405', true );
	
	// Add svgxuse polyfill.
	wp_enqueue_script( 'some-svgxuse', get_template_directory_uri() . '/assets/js/svgxuse' . SOME_SUFFIX . '.js', array(), '20160405', true );
	
	// Add comments scripts.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'some_scripts' );

/**
 * Change [...] to just "Read more".
 *
 * @since  1.0.0
 * @return string $more
 */
function some_excerpt_more() {

	/* Translators: The %s is the post title shown to screen readers. */
	$text = sprintf( esc_attr__( 'Read more %s', 'some' ), '<span class="screen-reader-text">' . get_the_title() ) . '</span>';
	$more = sprintf( '&hellip; <p><span class="icon-wrapper icon-wrapper-round">' . some_get_svg( array( 'icon' => 'next' ) ) . '</span><a href="%s" class="more-link">%s</a></p>', esc_url( get_permalink() ), $text );

	return $more;

}
add_filter( 'excerpt_more', 'some_excerpt_more' );

/**
 * Display SVG icons in social navigation.
 *
 * @since 1.0.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function some_nav_social_icons( $item_output, $item, $depth, $args ) {
	
	// Supported social icons.
	$social_icons = apply_filters( 'some_nav_social_icons', array(
		'codepen.io'      => 'codepen',
		'digg.com'        => 'digg',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'plus.google.com' => 'googleplus',
		'github.com'      => 'github',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin-alt',
		'mailto:'         => 'mail',
		'pinterest.com'   => 'pinterest-alt',
		'getpocket.com'   => 'pocket',
		'polldaddy.com'   => 'polldaddy',
		'reddit.com'      => 'reddit',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'soundcloud.com'  => 'cloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'youtube.com'     => 'youtube',
	) );
	
	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' == $args->theme_location ) {
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( $args->link_after, '</span>' . some_get_svg( array( 'icon' => esc_attr( $value ) ) ), $item_output );
			}
		}
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'some_nav_social_icons', 10, 4 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param  array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function some_widget_tag_cloud_args( $args ) {
	$args['largest']  = 0.875;
	$args['smallest'] = 0.875;
	$args['unit']     = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'some_widget_tag_cloud_args' );

/**
 * Add body classes.
 *
 * @param  array  $classes  body classes.
 * @return array  $classes  body classes.
 * @since  1.0.0
 */
function some_extra_layout_classes( $classes ) {
	
	// Add the '.custom-header-image' class if the user is using a custom header image.
	if ( get_header_image() ) {
		$classes[] = 'custom-header-image';
	}
	
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
add_filter( 'body_class', 'some_extra_layout_classes' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Custom Background feature.
 */
require get_template_directory() . '/inc/custom-background.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
