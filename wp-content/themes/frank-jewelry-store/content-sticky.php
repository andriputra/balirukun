<?php
/**
 * The Sticky template for displaying sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

$frank_jewelry_store_columns = 1;
$frank_jewelry_store_post_format = get_post_format();
$frank_jewelry_store_post_format = empty($frank_jewelry_store_post_format) ? 'standard' : str_replace('post-format-', '', $frank_jewelry_store_post_format);
$frank_jewelry_store_animation = frank_jewelry_store_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($frank_jewelry_store_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($frank_jewelry_store_post_format) ); ?>
	<?php echo (!frank_jewelry_store_is_off($frank_jewelry_store_animation) ? ' data-animation="'.esc_attr(frank_jewelry_store_get_animation_classes($frank_jewelry_store_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	frank_jewelry_store_show_post_featured(array(
		'thumb_size' => frank_jewelry_store_get_thumb_size($frank_jewelry_store_columns==1 ? 'big' : ($frank_jewelry_store_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($frank_jewelry_store_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			frank_jewelry_store_show_post_meta();
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>