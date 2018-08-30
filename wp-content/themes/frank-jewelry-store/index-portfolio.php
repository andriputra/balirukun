<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

frank_jewelry_store_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
frank_jewelry_store_enqueue_script( 'classie', frank_jewelry_store_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
frank_jewelry_store_enqueue_script( 'imagesloaded', frank_jewelry_store_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
frank_jewelry_store_enqueue_script( 'masonry', frank_jewelry_store_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
frank_jewelry_store_enqueue_script( 'frank_jewelry_store-gallery-script', frank_jewelry_store_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$frank_jewelry_store_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$frank_jewelry_store_sticky_out = is_array($frank_jewelry_store_stickies) && count($frank_jewelry_store_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$frank_jewelry_store_show_filters = frank_jewelry_store_get_theme_option('show_filters');
	$frank_jewelry_store_tabs = array();
	if (!frank_jewelry_store_is_off($frank_jewelry_store_show_filters)) {
		$frank_jewelry_store_cat = frank_jewelry_store_get_theme_option('parent_cat');
		$frank_jewelry_store_post_type = frank_jewelry_store_get_theme_option('post_type');
		$frank_jewelry_store_taxonomy = frank_jewelry_store_get_post_type_taxonomy($frank_jewelry_store_post_type);
		$frank_jewelry_store_args = array(
			'type'			=> $frank_jewelry_store_post_type,
			'child_of'		=> $frank_jewelry_store_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $frank_jewelry_store_taxonomy,
			'pad_counts'	=> false
		);
		$frank_jewelry_store_portfolio_list = get_terms($frank_jewelry_store_args);
		if (is_array($frank_jewelry_store_portfolio_list) && count($frank_jewelry_store_portfolio_list) > 0) {
			$frank_jewelry_store_tabs[$frank_jewelry_store_cat] = esc_html__('All', 'frank-jewelry-store');
			foreach ($frank_jewelry_store_portfolio_list as $frank_jewelry_store_term) {
				if (isset($frank_jewelry_store_term->term_id)) $frank_jewelry_store_tabs[$frank_jewelry_store_term->term_id] = $frank_jewelry_store_term->name;
			}
		}
	}
	if (count($frank_jewelry_store_tabs) > 0) {
		$frank_jewelry_store_portfolio_filters_ajax = true;
		$frank_jewelry_store_portfolio_filters_active = $frank_jewelry_store_cat;
		$frank_jewelry_store_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters frank_jewelry_store_tabs frank_jewelry_store_tabs_ajax">
			<ul class="portfolio_titles frank_jewelry_store_tabs_titles">
				<?php
				foreach ($frank_jewelry_store_tabs as $frank_jewelry_store_id=>$frank_jewelry_store_title) {
					?><li><a href="<?php echo esc_url(frank_jewelry_store_get_hash_link(sprintf('#%s_%s_content', $frank_jewelry_store_portfolio_filters_id, $frank_jewelry_store_id))); ?>" data-tab="<?php echo esc_attr($frank_jewelry_store_id); ?>"><?php echo esc_html($frank_jewelry_store_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$frank_jewelry_store_ppp = frank_jewelry_store_get_theme_option('posts_per_page');
			if (frank_jewelry_store_is_inherit($frank_jewelry_store_ppp)) $frank_jewelry_store_ppp = '';
			foreach ($frank_jewelry_store_tabs as $frank_jewelry_store_id=>$frank_jewelry_store_title) {
				$frank_jewelry_store_portfolio_need_content = $frank_jewelry_store_id==$frank_jewelry_store_portfolio_filters_active || !$frank_jewelry_store_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $frank_jewelry_store_portfolio_filters_id, $frank_jewelry_store_id)); ?>"
					class="portfolio_content frank_jewelry_store_tabs_content"
					data-blog-template="<?php echo esc_attr(frank_jewelry_store_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(frank_jewelry_store_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($frank_jewelry_store_ppp); ?>"
					data-post-type="<?php echo esc_attr($frank_jewelry_store_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($frank_jewelry_store_taxonomy); ?>"
					data-cat="<?php echo esc_attr($frank_jewelry_store_id); ?>"
					data-parent-cat="<?php echo esc_attr($frank_jewelry_store_cat); ?>"
					data-need-content="<?php echo (false===$frank_jewelry_store_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($frank_jewelry_store_portfolio_need_content) 
						frank_jewelry_store_show_portfolio_posts(array(
							'cat' => $frank_jewelry_store_id,
							'parent_cat' => $frank_jewelry_store_cat,
							'taxonomy' => $frank_jewelry_store_taxonomy,
							'post_type' => $frank_jewelry_store_post_type,
							'page' => 1,
							'sticky' => $frank_jewelry_store_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		frank_jewelry_store_show_portfolio_posts(array(
			'cat' => isset($frank_jewelry_store_id) ? $frank_jewelry_store_id : '',
			'parent_cat' => isset($frank_jewelry_store_cat) ? $frank_jewelry_store_cat : '',
			'taxonomy' => isset($frank_jewelry_store_taxonomy) ? $frank_jewelry_store_taxonomy : '',
			'post_type' => isset($frank_jewelry_store_post_type) ? $frank_jewelry_store_post_type : '',
			'page' => 1,
			'sticky' => $frank_jewelry_store_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>