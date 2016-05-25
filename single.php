<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Some
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'some' ) . '</span> ' .
					'<span class="post-title">' . wp_trim_words( get_next_post_link( $format = '%link' ), 5, _x( '&hellip;', 'dots after next post link', 'some' ) ) . '</span>' .
					' <span class="meta-nav" aria-hidden="true">' . some_get_svg( $args = array( 'icon' => 'chevron-circle-right' ) ) . '</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . some_get_svg( $args = array( 'icon' => 'chevron-circle-left' ) ) . '</span>' .
					'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'some' ) . '</span> ' .
					'<span class="post-title">' . wp_trim_words( get_previous_post_link( $format = '%link' ), 5, _x( '&hellip;', 'dots after previous post link', 'some' ) ) . '</span>',
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
