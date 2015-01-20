<?php
/**
 * The template for displaying search results pages.
 *
 * @package VividMusic
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="search-page-title">
					<i class="fa fa-search"></i>
					<?php printf( __( 'Search Results for: %s', 'vivid' ), '<br /> <span class = "search-query">' . 
					get_search_query() . '</span>' ); ?>
				</h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (($counter % 2) == 0): ?>
					 <div class="row clearfix">
				<?php endif; ?> 

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

				<?php if (($counter % 2) != 0): ?>
					</div><!--end row-->
				<?php endif; ?>	
				<?php $counter++ ?>

			<?php endwhile; ?>

			<?php vivid_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
