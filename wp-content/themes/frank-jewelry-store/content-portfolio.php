<?php
/**
 * The Portfolio template for displaying content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($frank_jewelry_store_columns).' post_format_'.esc_attr($frank_jewelry_store_post_format) ); ?>
	<?php echo (!frank_jewelry_store_is_off($frank_jewelry_store_animation) ? ' data-animation="'.esc_attr(frank_jewelry_store_get_animation_classes($frank_jewelry_store_animation)).'"' : ''); ?>
	>

	<?php
	$frank_jewelry_store_image_hover = frank_jewelry_store_get_theme_option('image_hover');
	// Featured image
	frank_jewelry_store_show_post_featured(array(
		'thumb_size' => frank_jewelry_store_get_thumb_size(strpos(frank_jewelry_store_get_theme_option('body_style'), 'full')!==false || $frank_jewelry_store_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $frank_jewelry_store_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $frank_jewelry_store_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>