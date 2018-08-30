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
$frank_jewelry_store_columns = empty($frank_jewelry_store_blog_style[1]) ? 1 : max(1, $frank_jewelry_store_blog_style[1]);
$frank_jewelry_store_expanded = !frank_jewelry_store_sidebar_present() && frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('expand_content'));
$frank_jewelry_store_post_format = get_post_format();
$frank_jewelry_store_post_format = empty($frank_jewelry_store_post_format) ? 'standard' : str_replace('post-format-', '', $frank_jewelry_store_post_format);
$frank_jewelry_store_animation = frank_jewelry_store_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($frank_jewelry_store_columns).' post_format_'.esc_attr($frank_jewelry_store_post_format) ); ?>
	<?php echo (!frank_jewelry_store_is_off($frank_jewelry_store_animation) ? ' data-animation="'.esc_attr(frank_jewelry_store_get_animation_classes($frank_jewelry_store_animation)).'"' : ''); ?>
	>

	<?php
	// Add anchor
	if ($frank_jewelry_store_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Featured image
	frank_jewelry_store_show_post_featured( array(
											'class' => $frank_jewelry_store_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => frank_jewelry_store_get_thumb_size(
																	strpos(frank_jewelry_store_get_theme_option('body_style'), 'full')!==false
																		? ( $frank_jewelry_store_columns > 1 ? 'big' : 'original' )
																		: (	$frank_jewelry_store_columns > 1 ? 'med' : 'big')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('frank_jewelry_store_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('frank_jewelry_store_action_before_post_meta'); 

			// Post meta
			$frank_jewelry_store_post_meta = frank_jewelry_store_show_post_meta(array(
									'categories' => false,
									'date' => true,
									'edit' => $frank_jewelry_store_columns == 1,
									'seo' => false,
									'share' => false,
									'counters' => $frank_jewelry_store_columns < 3 ? 'comments' : '',
									'echo' => false
									)
								);
			frank_jewelry_store_show_layout($frank_jewelry_store_post_meta);
		?></div><!-- .entry-header -->
	
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
				frank_jewelry_store_show_layout($frank_jewelry_store_post_meta);
			}
			// More button
			if ( $frank_jewelry_store_show_learn_more ) {
				?><p class="sc_item_button"><a class="sc_button sc_button_border3 sc_button_size_small" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read More', 'frank-jewelry-store'); ?><span class="sc_button_iconed"></span></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>