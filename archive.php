<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Some
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			echo '<div class="grid-wrapper">';
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;
			echo '</div><!-- .grid-wrapper -->';

			/* Translators: The %s is an arrow (SVG image). */
			the_posts_navigation( array(
				'prev_text' => sprintf( esc_html__( '%s Older writings', 'some' ), some_get_svg( $args = array( 'icon' => 'chevron-circle-left' ) ) ),
				'next_text' => sprintf( esc_html__( 'Newer writings %s', 'some' ), some_get_svg( $args = array( 'icon' => 'chevron-circle-right' ) )  ),
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
