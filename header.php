<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Some
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
<?php
	// Include SVG images.
	$svg_icons = get_template_directory() . '/assets/images/svg-icons.svg';
	require_once( $svg_icons );
?>
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'some' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php if ( has_nav_menu( 'primary' ) ) : // Check do we have primary menu. ?>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'some' ); ?></button>
				<?php wp_nav_menu( array( 'container_class' => 'primary-menu-wrapper', 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->

		<?php endif; // End check for primary menu. ?>

		<div class="site-branding">
			<div class="wrapper grid-wrapper">

				<div class="site-title-description">

					<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php
					endif;

				echo '</div><!-- .site-title-description -->';

				get_template_part( 'menus/menu', 'social' ); // Loads the menus/menu-social.php template.

				?>

			</div><!-- .wrapper -->
		</div><!-- .site-branding -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
