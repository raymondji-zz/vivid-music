<?php 
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package VividMusic
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'vivid' ); ?></a>

	
	<header id="masthead" class="site-header" role="banner">
			<div class="container">
				<button class="nav-expand fa fa-bars" id="nav-expand-btn"></button>
			    <a href="<?php bloginfo('url')?>">
			    	<img class="logo"  src="<?php bloginfo('template_directory'); ?>/img/logo.png">
			    </a>
				<?php 
				$args = array(
				'posts_per_page'   => -1,
				'offset'           => 0,
				'category'         => '',
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'include'          => '',
				'exclude'          => '',
				'meta_key'         => '',
				'meta_value'       => '',
				'post_type'        => 'post',
				'post_mime_type'   => '',
				'post_parent'      => '',
				'post_status'      => 'publish',
				'suppress_filters' => true ); 

				$posts_array = get_posts( $args ); 
				?>

				<div class="music-player" id="music-player" 
				data-post-links = '<?php 
					$numSongs = 0;
					foreach ($posts_array as $post) {
						$t=get_post_meta( $post->ID, "custom_meta_songlink", true );
					if (!empty($t)) {
						if ($numSongs < 20) {
							echo get_permalink( $post, false ).",";
							$numSongs ++;
						}
					}} ?>'
				data-post-soundclouds = '<?php 
					$numSongs = 0;
					foreach ($posts_array as $post) {
						$t=get_post_meta( $post->ID, "custom_meta_songlink", true );
					if (!empty($t)) {
						if ($numSongs < 20) {
							echo get_post_meta( $post->ID, "custom_meta_songlink", true ).",";
							$numSongs ++;
						}
					}} ?>'
				data-post-ids = '<?php 
					$numSongs = 0;
					foreach ($posts_array as $post) {
						$t=get_post_meta( $post->ID, "custom_meta_songlink", true );
					if (!empty($t)) {
						if ($numSongs < 20) {
							echo $post->ID.",";
							$numSongs ++;
						}
					}} ?>'>
					<div id="load-sc-iframe"></div>
					<section class="music-buttons">
						<button class="fa fa-forward music-player-buttons"id="play-next"></button>
						<a class="fa fa-eye music-player-buttons read-button" id="read-current"></a>
						<button class="fa fa-backward music-player-buttons" id="play-prev"></button>
					</section><!--end music-buttons-->
				</div><!--end music-player-->	
			</div><!--end container-->
	</header><!-- #masthead -->
	 
	<div class="container">
	 <?php require('navigation.php'); ?>
	</div>

	<div id="content" class="site-content container">


