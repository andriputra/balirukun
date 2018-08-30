<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

frank_jewelry_store_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	?><div class="posts_container"><?php
	
	$frank_jewelry_store_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$frank_jewelry_store_sticky_out = is_array($frank_jewelry_store_stickies) && count($frank_jewelry_store_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($frank_jewelry_store_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($frank_jewelry_store_sticky_out && !is_sticky()) {
			$frank_jewelry_store_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $frank_jewelry_store_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($frank_jewelry_store_sticky_out) {
		$frank_jewelry_store_sticky_out = false;
		?></div><?php
	}
	
	?></div><?php

	frank_jewelry_store_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>