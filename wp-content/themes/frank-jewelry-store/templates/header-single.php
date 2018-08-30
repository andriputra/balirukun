<?php
/**
 * The template for displaying Featured image in the single post
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

if ( get_query_var('frank_jewelry_store_header_image')=='' && is_singular() && has_post_thumbnail() && in_array(get_post_type(), array('post', 'page')) )  {
	set_query_var('frank_jewelry_store_featured_showed', true);
	$frank_jewelry_store_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if (!empty($frank_jewelry_store_src[0])) {
		?><div class="post_featured post_featured_fullwide <?php echo esc_attr(frank_jewelry_store_add_inline_style('background-image:url('.esc_url($frank_jewelry_store_src[0]).');')); ?>"></div><?php
	}
}
?>