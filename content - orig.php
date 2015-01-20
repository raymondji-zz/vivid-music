<?php
/**
 * @package VividMusic
 */
?>

<article id="post-<?php the_ID(); ?>" class="index-article col-md-6">
	
	<!--Post Category-->
	<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ' ', 'vivid' ) );
				if ( $categories_list && vivid_categorized_blog() ) :
			?>
				<span class="cat-links">
				<?php echo($categories_list); ?>
				</span>
			<?php endif; // End if categories ?>
	<?php endif; ?>

	<div class="song-links">
		
		

		<!--POST IMAGE-->
		<!--If the post has a featured image-->
		<?php if (has_post_thumbnail( $post->ID ) ): ?>
				<!--Get the featured image URL and set it as $image-->
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ); ?>
					<div class="post-image post-image-index" style="background-image: url('<?php echo $image[0]; ?>')" >
						<?php if (!empty(get_post_meta( $post->ID, "custom_meta_songname", true))): ?>
							<h3 class="song-name song-info"><?php echo get_post_meta( $post->ID, "custom_meta_songname", true ); ?></h3>
							<h4 class="song-artist song-info"><?php echo get_post_meta( $post->ID, "custom_meta_songartist", true ); ?></h4>
						<?php endif; ?>

						<!--Get data for this post-->
						<?php if (!empty(get_post_meta( $post->ID, "custom_meta_songlink", true ))): ?>
							<?php $next_post = get_next_post(); $prev_post = get_previous_post(); ?>
							<button class="fa fa-play-circle-o sc-iframe-link" 
							data-current-soundcloud='<?php echo get_post_meta( $post->ID, "custom_meta_songlink", true ); ?>' 
							data-current-post-id='<?php echo $post->ID; ?>' 
							data-current-post-link = "<?php echo get_permalink( $post->ID, false ); ?>"
							></button> 	
						<?php endif; ?>
					</div><!--end post-image sc-iframe-link-->
		<?php else : ?>
			<div class="post-image post-image-index post-image-none"></div><!--end post-image post-image-index-->
		<?php endif; ?><!--if featured image exists-->

		
	  
				
		<!--POST TEXT-->
		<div class="post-text ">
			<header class="entry-header">
				<?php if ( 'post' == get_post_type() ) : ?>
				<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
				<div class="entry-meta">
					<?php vivid_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'vivid' ) ); ?>
				<?php
					wp_link_pages( array( 
						'before' => '<div class="page-links">' . __( 'Pages:', 'vivid' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		</div><!--end post-text-->
	</div><!--end song-links-->
</article><!-- #post-## -->
