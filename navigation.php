<nav id="navbar" class="navbar">

	<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
		<label>
			<input type="search" class="search-field" placeholder="Search" value="" name="s" title="Search for:" />
		</label>
		<button type="submit" class="search-submit fa fa-search"></button>
	</form>

	<?php
	    wp_nav_menu( array(
	        'menu'              => 'primary',
	        'theme_location'    => 'primary',
	        'depth'             => 2,
	        'menu_class'        => 'side-nav col-sm-6',
	    ));
	?>

	

	 <?php 
		 $args = array(
			'show_option_all'    => 'All',
			'orderby'            => 'name',
			'order'              => 'ASC',
			'style'              => 'list',
			'show_count'         => 0,
			'hide_empty'         => 1,
			'use_desc_for_title' => 1,
			'child_of'           => 0,
			'feed'               => '',
			'feed_type'          => '',
			'feed_image'         => '',
			'exclude'            => '',
			'exclude_tree'       => '',
			'include'            => '',
			'hierarchical'       => 0,
			'title_li'           => __( '' ),
			'show_option_none'   => __( 'No genres' ),
			'number'             => null,
			'echo'               => 1,
			'depth'              => 0,
			'current_category'   => 0,
			'pad_counts'         => 0,
			'taxonomy'           => 'category',
			'walker'             => null
		);
	?> 

	<ul id="categories-list" class="categories col-sm-6">
		<?php wp_list_categories( $args ); ?>
	</ul><!--end categories-->
</nav><!--end navbar-->