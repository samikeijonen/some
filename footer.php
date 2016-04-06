<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Some
 */

?>

	</div><!-- #content -->
	
	<?php get_sidebar( 'footer' ); // Loads the sidebar-footer.php template. ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'some' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'some' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'some' ), 'some', '<a href="https://foxland.fi/" rel="designer">Sami Keijonen</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
