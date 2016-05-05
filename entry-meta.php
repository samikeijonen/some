<?php 
/**
 * Entry meta content for displaying post date and author.
 *
 * @package Some
 */
 
if ( 'post' === get_post_type() ) : ?>
	<div class="entry-meta">
		<?php some_posted_on(); ?>
	</div><!-- .entry-meta -->
<?php endif; ?>