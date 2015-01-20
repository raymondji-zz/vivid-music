<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package VividMusic
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'vivid' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'vivid' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vivid' ); ?></p>
			<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
				<label>
					<input type="search" class="search-field" placeholder="Search" value="" name="s" title="Search for:" />
				</label>
				<button type="submit" class="search-submit fa fa-search"></button>
			</form>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'vivid' ); ?></p>
			<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
				<label>
					<input type="search" class="search-field" placeholder="Search" value="" name="s" title="Search for:" />
				</label>
				<button type="submit" class="search-submit fa fa-search"></button>
			</form>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
