<?php
/**
 * The Classic template for displaying content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

$frank_jewelry_store_blog_style = explode('_', frank_jewelry_store_get_theme_option('blog_style'));
$frank_jewelry_store_columns = empty($frank_jewelry_store_blog_style[1]) ? 2 : max(2, $frank_jewelry_store_blog_style[1]);
$frank_jewelry_store_expanded = !frank_jewelry_store_sidebar_present() && frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('expand_content'));
$frank_jewelry_store_post_format = get_post_format();
$frank_jewelry_store_post_format = empty($frank_jewelry_store_post_format) ? 'standard' : str_replace('post-format-', '', $frank_jewelry_store_post_format);
$frank_jewelry_store_animation = frank_jewelry_store_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($frank_jewelry_store_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_classic post_layout_classic_'.esc_attr($frank_jewelry_store_columns).' post_format_'.esc_attr($frank_jewelry_store_post_format) ); ?>
	<?php echo (!frank_jewelry_store_is_off($frank_jewelry_store_animation) ? ' data-animation="'.esc_attr(frank_jewelry_store_get_animation_classes($frank_jewelry_store_animation)).'"' : ''); ?>
	>

	<?php

	// Featured image
	frank_jewelry_store_show_post_featured( array( 'thumb_size' => frank_jewelry_store_get_thumb_size(
													strpos(frank_jewelry_store_get_theme_option('body_style'), 'full')!==false 
														? ( $frank_jewelry_store_columns > 2 ? 'big' : 'huge' )
														: (	$frank_jewelry_store_columns > 2
															? ($frank_jewelry_store_expanded ? 'med' : 'small')
															: ($frank_jewelry_store_expanded ? 'big' : 'med')
															)
														)
										) );

	if ( !in_array($frank_jewelry_store_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('frank_jewelry_store_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('frank_jewelry_store_action_before_post_meta'); 

			// Post meta
			frank_jewelry_store_show_post_meta(array(
				'categories' => false,
				'date' => true,
				'edit' => $frank_jewelry_store_columns < 3,
				'seo' => false,
				'share' => false,
				'counters' => 'comments',
				)
			);
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$frank_jewelry_store_show_learn_more = !in_array($frank_jewelry_store_post_format, array('link', 'aside', 'status', 'quote'));
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($frank_jewelry_store_post_format, array('link', 'aside', 'status', 'quote'))) {
				the_content();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($frank_jewelry_store_post_format, array('link', 'aside', 'status', 'quote'))) {
			frank_jewelry_store_show_post_meta(array(
				'share' => false,
				'counters' => 'comments'
				)
			);
		}
		// More button
		if ( $frank_jewelry_store_show_learn_more ) {
			?><p class="sc_item_button"><a class="sc_button sc_button_border3 sc_button_size_small" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read More', 'frank-jewelry-store'); ?><span class="sc_button_iconed"></span></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>