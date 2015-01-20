<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package VividMusic
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="site-info">
				<h4>Vivid Music 2014</h4>
				<!--<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'vivid' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'vivid' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'vivid' ), 'VividMusic', '<a href="http://underscores.me/" rel="designer">RJ</a>' ); ?>
				-->
			</div><!-- .site-info -->
			<div class="social-media-icons">
				<a class="fa fa-facebook" href="https://www.facebook.com/VividEveryday?fref=ts" target="none" title="Vivid facebook link"></a>
				<a class="fa fa-twitter" href="https://twitter.com/vividdmusic" target="none" title="Vivid twitter link"></a>
				<a class="fa fa-youtube"></a>
				<a class="fa fa-soundcloud"></a>
			</div><!--end social-media-icons-->
		</div><!--container-->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
