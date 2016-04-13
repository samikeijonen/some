<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Some
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'some' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<div class="grid-wrapper">
						
						<div class="404-image">
							<p><?php echo some_get_svg( array( 'icon' => '404', 'aria_hidden' => false, 'title' => esc_html__( '404 image', 'some' ) ) ); ?></p>
						</div>
						<div class="404-search">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'some' ); ?></p>
							<?php get_search_form(); ?>
						</div>
						<?php

							the_widget( 'WP_Widget_Recent_Posts' );

							// Only show the widget if site has multiple categories.
							if ( some_categorized_blog() ) :
						?>

						<div class="widget widget_categories">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'some' ); ?></h2>
							<ul>
							<?php
								wp_list_categories( array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								) );
							?>
							</ul>
						</div><!-- .widget -->

						<?php
							endif;

							/* translators: %1$s: smiley */
							$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'some' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

							the_widget( 'WP_Widget_Tag_Cloud' );
						?>
					</div><!-- .grid-wrapper -->
				</div><!-- .page-content -->
				
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
