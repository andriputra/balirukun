<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the Visual Composer to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$frank_jewelry_store_content = '';
$frank_jewelry_store_blog_archive_mask = '%%CONTENT%%';
$frank_jewelry_store_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $frank_jewelry_store_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($frank_jewelry_store_content = apply_filters('the_content', get_the_content())) != '') {
		if (($frank_jewelry_store_pos = strpos($frank_jewelry_store_content, $frank_jewelry_store_blog_archive_mask)) !== false) {
			$frank_jewelry_store_content = preg_replace('/(\<p\>\s*)?'.$frank_jewelry_store_blog_archive_mask.'(\s*\<\/p\>)/i', $frank_jewelry_store_blog_archive_subst, $frank_jewelry_store_content);
		} else
			$frank_jewelry_store_content .= $frank_jewelry_store_blog_archive_subst;
		$frank_jewelry_store_content = explode($frank_jewelry_store_blog_archive_mask, $frank_jewelry_store_content);
	}
}

// Make new query
$frank_jewelry_store_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$frank_jewelry_store_args = frank_jewelry_store_query_add_posts_and_cats($frank_jewelry_store_args, '', frank_jewelry_store_get_theme_option('post_type'), frank_jewelry_store_get_theme_option('parent_cat'));
$frank_jewelry_store_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($frank_jewelry_store_page_number > 1) {
	$frank_jewelry_store_args['paged'] = $frank_jewelry_store_page_number;
	$frank_jewelry_store_args['ignore_sticky_posts'] = true;
}
$frank_jewelry_store_ppp = frank_jewelry_store_get_theme_option('posts_per_page');
if ((int) $frank_jewelry_store_ppp != 0)
	$frank_jewelry_store_args['posts_per_page'] = (int) $frank_jewelry_store_ppp;

query_posts( $frank_jewelry_store_args );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($frank_jewelry_store_content) && count($frank_jewelry_store_content) == 2) {
	set_query_var('blog_archive_start', $frank_jewelry_store_content[0]);
	set_query_var('blog_archive_end', $frank_jewelry_store_content[1]);
}

get_template_part('index');
?>