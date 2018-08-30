<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

$frank_jewelry_store_blog_style = explode('_', frank_jewelry_store_get_theme_option('blog_style'));
$frank_jewelry_store_columns = empty($frank_jewelry_store_blog_style[1]) ? 2 : max(2, $frank_jewelry_store_blog_style[1]);
$frank_jewelry_store_post_format = get_post_format();
$frank_jewelry_store_post_format = empty($frank_jewelry_store_post_format) ? 'standard' : str_replace('post-format-', '', $frank_jewelry_store_post_format);
$frank_jewelry_store_animation = frank_jewelry_store_get_theme_option('blog_animation');
$frank_jewelry_store_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($frank_jewelry_store_columns).' post_format_'.esc_attr($frank_jewelry_store_post_format) ); ?>
	<?php echo (!frank_jewelry_store_is_off($frank_jewelry_store_animation) ? ' data-animation="'.esc_attr(frank_jewelry_store_get_animation_classes($frank_jewelry_store_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($frank_jewelry_store_image[1]) && !empty($frank_jewelry_store_image[2])) echo intval($frank_jewelry_store_image[1]) .'x' . intval($frank_jewelry_store_image[2]); ?>"
	data-src="<?php if (!empty($frank_jewelry_store_image[0])) echo esc_url($frank_jewelry_store_image[0]); ?>"
	>

	<?php
	$frank_jewelry_store_image_hover = 'icon';
	if (in_array($frank_jewelry_store_image_hover, array('icons', 'zoom'))) $frank_jewelry_store_image_hover = 'dots';
	// Featured image
	frank_jewelry_store_show_post_featured(array(
		'hover' => $frank_jewelry_store_image_hover,
		'thumb_size' => frank_jewelry_store_get_thumb_size( strpos(frank_jewelry_store_get_theme_option('body_style'), 'full')!==false || $frank_jewelry_store_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. frank_jewelry_store_show_post_meta(array(
									'categories' => true,
									'date' => true,
									'edit' => false,
									'seo' => false,
									'share' => true,
									'counters' => 'comments',
									'echo' => false
									))
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'frank-jewelry-store') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>