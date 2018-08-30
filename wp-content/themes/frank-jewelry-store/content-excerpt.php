<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

$frank_jewelry_store_post_format = get_post_format();
$frank_jewelry_store_post_format = empty($frank_jewelry_store_post_format) ? 'standard' : str_replace('post-format-', '', $frank_jewelry_store_post_format);
$frank_jewelry_store_full_content = frank_jewelry_store_get_theme_option('blog_content') != 'excerpt' || in_array($frank_jewelry_store_post_format, array('link', 'aside', 'status', 'quote'));
$frank_jewelry_store_animation = frank_jewelry_store_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($frank_jewelry_store_post_format) ); ?>
	<?php echo (!frank_jewelry_store_is_off($frank_jewelry_store_animation) ? ' data-animation="'.esc_attr(frank_jewelry_store_get_animation_classes($frank_jewelry_store_animation)).'"' : ''); ?>
	><?php

	// Featured image
	frank_jewelry_store_show_post_featured(array( 'thumb_size' => frank_jewelry_store_get_thumb_size( strpos(frank_jewelry_store_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('frank_jewelry_store_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );

			do_action('frank_jewelry_store_action_before_post_meta'); 

			// Post meta
			frank_jewelry_store_show_post_meta(array(
				'categories' => false,
				'date' => true,
				'edit' => true,
				'seo' => false,
				'share' => false,
				'counters' => 'comments'	//comments,likes,views - comma separated in any combination
				)
			);
			?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	?><div class="post_content entry-content"><?php
		if ($frank_jewelry_store_full_content) {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'frank-jewelry-store' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'frank-jewelry-store' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$frank_jewelry_store_show_learn_more = !in_array($frank_jewelry_store_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($frank_jewelry_store_post_format, array('link', 'aside', 'status', 'quote'))) {
					the_content();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
			?></div><?php
			// More button
			if ( $frank_jewelry_store_show_learn_more ) {
				?><p class="sc_item_button"><a class="sc_button sc_button_border sc_button_size_normal" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read More', 'frank-jewelry-store'); ?><span class="sc_button_iconed"></span></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>