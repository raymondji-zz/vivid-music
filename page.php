<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package VividMusic
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php /* Start the Loop */ $counter = 0; ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (($counter % 2) == 0): ?>
					 <div class="row clearfix">
				<?php endif; ?> 
			
				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>
				<?php if (($counter % 2) != 0): ?>
					</div><!--end row-->
				<?php endif; ?>	
				<?php $counter++ ?>	
			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
