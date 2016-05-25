<?php
/**
 * Template Name: Front Page
 *
 * This is the template displaying custom front page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Some
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<div class="front-page-content front-page-section" id="front-page-content">
			<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
			?>
			</div><!-- .front-page-content -->
			
			<?php
			// Portfolio Posts Query. 
			$portfolio_content = new WP_Query( apply_filters( 'some_portfolio_posts_arguments', array(
				'post_type'      => 'portfolio_project',
				'posts_per_page' => 4,
				'no_found_rows'  => true,
			) ) );
			
			if ( $portfolio_content->have_posts() && post_type_exists( 'portfolio_project' ) ) : ?>
			
			<div class="front-page-portfolio front-page-section" id="front-page-portfolio">
				
				<?php if( function_exists( 'ccp_get_portfolio_title' ) && function_exists( 'ccp_get_portfolio_description' ) ) : ?>
				
					<header class="page-header">
					<?php
						echo '<h2 class="page-title">' . ccp_get_portfolio_title() . '</h2>';
						
						// Get portfolio description.
						$portfolio_description = ccp_get_portfolio_description();
						if ( isset( $portfolio_description ) && $portfolio_description ) :
							echo '<div class="taxonomy-description">' . wp_kses_post( $portfolio_description ) . '</div>';
						endif;
					?>
					</header><!-- .page-header -->
					
				<?php endif; ?>
			
				<div class="grid-wrapper">
				
				<?php while ( $portfolio_content->have_posts() ) : $portfolio_content->the_post(); ?>
				
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
						<div class="entry-inner">
		
							<?php if ( has_post_thumbnail() ) : ?>
								<a class="post-thumbnail" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
								</a>
							<?php endif; ?>
		
							<header class="entry-header">
								<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
							</header><!-- .entry-header -->
			
						</div><!-- .entry-inner -->	
				
					</article><!-- #post-## -->
				
				<?php endwhile; ?>
				
				</div><!-- .grid-wrapper -->
				
			</div><!-- .front-page-portfolio -->
				
			<?php	
			endif; // End loop.
			wp_reset_postdata(); // Reset post data.
			
			// Blog Posts Query. 
			$blog_content = new WP_Query( apply_filters( 'some_blog_posts_arguments', array(
				'post_type'      => 'post',
				'posts_per_page' => 4,
				'no_found_rows'  => true,
			) ) );
			
			if ( $blog_content->have_posts() ) : ?>
			
			<div class="front-page-blog front-page-section" id="front-page-blog">
			
				<header class="page-header">
				<?php
					// Get blog title and text from the Customizer.
					$blog_title = get_theme_mod( 'blog_area_title', esc_html__( 'Blog', 'some' ) );
					$blog_text  = get_theme_mod( 'blog_area_text', esc_html__( 'Read blog posts', 'some' ) );
					echo '<h2 class="page-title">' . esc_html( $blog_title ) . '</h2>';
					echo '<div class="taxonomy-description">' . wp_kses_post( $blog_text ) . '</div>';
				?>
				</header><!-- .page-header -->
			
				<div class="grid-wrapper">
				
				<?php while ( $blog_content->have_posts() ) : $blog_content->the_post(); ?>
				
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
						<div class="entry-inner">
		
							<header class="entry-header">
							<?php
								the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
								get_template_part( 'entry-meta' );
							?>
							</header><!-- .entry-header -->
		
							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->
			
						</div><!-- .entry-inner -->		
				
					</article><!-- #post-## -->
				
				<?php endwhile; ?>
				
				</div><!-- .grid-wrapper -->
				
			</div><!-- .front-page-blog -->
				
			<?php	
			endif; // End loop.
			wp_reset_postdata(); // Reset post data.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
