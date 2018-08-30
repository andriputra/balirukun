<?php
/**
 * The template for displaying posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

$frank_jewelry_store_post_id    = get_the_ID();
$frank_jewelry_store_post_date  = frank_jewelry_store_get_date();
$frank_jewelry_store_post_title = get_the_title();
$frank_jewelry_store_post_link  = get_permalink();
$frank_jewelry_store_post_author_id   = get_the_author_meta('ID');
$frank_jewelry_store_post_author_name = get_the_author_meta('display_name');
$frank_jewelry_store_post_author_url  = get_author_posts_url($frank_jewelry_store_post_author_id, '');

$frank_jewelry_store_args = get_query_var('frank_jewelry_store_args_widgets_posts');
$frank_jewelry_store_show_date = isset($frank_jewelry_store_args['show_date']) ? (int) $frank_jewelry_store_args['show_date'] : 1;
$frank_jewelry_store_show_image = isset($frank_jewelry_store_args['show_image']) ? (int) $frank_jewelry_store_args['show_image'] : 1;
$frank_jewelry_store_show_author = isset($frank_jewelry_store_args['show_author']) ? (int) $frank_jewelry_store_args['show_author'] : 1;
$frank_jewelry_store_show_counters = isset($frank_jewelry_store_args['show_counters']) ? (int) $frank_jewelry_store_args['show_counters'] : 1;
$frank_jewelry_store_show_categories = isset($frank_jewelry_store_args['show_categories']) ? (int) $frank_jewelry_store_args['show_categories'] : 1;

$frank_jewelry_store_output = frank_jewelry_store_storage_get('frank_jewelry_store_output_widgets_posts');

$frank_jewelry_store_post_counters_output = '';
if ( $frank_jewelry_store_show_counters ) {
	$frank_jewelry_store_post_counters_output = '<span class="post_info_item post_info_counters">'
								. frank_jewelry_store_get_post_counters('comments')
							. '</span>';
}


$frank_jewelry_store_output .= '<article class="post_item with_thumb">';

if ($frank_jewelry_store_show_image) {
	$frank_jewelry_store_post_thumb = get_the_post_thumbnail($frank_jewelry_store_post_id, frank_jewelry_store_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($frank_jewelry_store_post_thumb) $frank_jewelry_store_output .= '<div class="post_thumb">' . ($frank_jewelry_store_post_link ? '<a href="' . esc_url($frank_jewelry_store_post_link) . '">' : '') . ($frank_jewelry_store_post_thumb) . ($frank_jewelry_store_post_link ? '</a>' : '') . '</div>';
}

$frank_jewelry_store_output .= '<div class="post_content">'
			. ($frank_jewelry_store_show_categories 
					? '<div class="post_categories">'
						. frank_jewelry_store_get_post_categories()
						. $frank_jewelry_store_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($frank_jewelry_store_post_link ? '<a href="' . esc_url($frank_jewelry_store_post_link) . '">' : '') . ($frank_jewelry_store_post_title) . ($frank_jewelry_store_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('frank_jewelry_store_filter_get_post_info', 
								'<div class="post_info">'
									. ($frank_jewelry_store_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($frank_jewelry_store_post_link ? '<a href="' . esc_url($frank_jewelry_store_post_link) . '" class="post_info_date">' : '') 
											. esc_html($frank_jewelry_store_post_date) 
											. ($frank_jewelry_store_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($frank_jewelry_store_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'frank-jewelry-store') . ' ' 
											. ($frank_jewelry_store_post_link ? '<a href="' . esc_url($frank_jewelry_store_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($frank_jewelry_store_post_author_name) 
											. ($frank_jewelry_store_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$frank_jewelry_store_show_categories && $frank_jewelry_store_post_counters_output
										? $frank_jewelry_store_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
frank_jewelry_store_storage_set('frank_jewelry_store_output_widgets_posts', $frank_jewelry_store_output);
?>