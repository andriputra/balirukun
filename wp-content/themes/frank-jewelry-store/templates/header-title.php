<?php
/**
 * The template for displaying Page title and Breadcrumbs
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

// Page (category, tag, archive, author) title

if ( frank_jewelry_store_need_page_title() ) {
	set_query_var('frank_jewelry_store_title_showed', true);
	$frank_jewelry_store_top_icon = frank_jewelry_store_get_category_icon();
	?>
	<div class="top_panel_title_wrap">
		<div class="content_wrap">
			<div class="top_panel_title">

				<?php
				// Breadcrumbs
				if (frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('show_breadcrumbs'))) {
					frank_jewelry_store_show_layout(frank_jewelry_store_get_breadcrumbs(), '<div class="breadcrumbs">', '</div>');
				}
				?>

				<div class="page_title">
					<?php

					// Blog/Post title
					$frank_jewelry_store_blog_title = frank_jewelry_store_get_blog_title();
					$frank_jewelry_store_blog_title_text = $frank_jewelry_store_blog_title_class = $frank_jewelry_store_blog_title_link = $frank_jewelry_store_blog_title_link_text = '';
					if (is_array($frank_jewelry_store_blog_title)) {
						$frank_jewelry_store_blog_title_text = $frank_jewelry_store_blog_title['text'];
						$frank_jewelry_store_blog_title_class = !empty($frank_jewelry_store_blog_title['class']) ? ' '.$frank_jewelry_store_blog_title['class'] : '';
						$frank_jewelry_store_blog_title_link = !empty($frank_jewelry_store_blog_title['link']) ? $frank_jewelry_store_blog_title['link'] : '';
						$frank_jewelry_store_blog_title_link_text = !empty($frank_jewelry_store_blog_title['link_text']) ? $frank_jewelry_store_blog_title['link_text'] : '';
					} else
						$frank_jewelry_store_blog_title_text = $frank_jewelry_store_blog_title;
					?>
					<h1 class="page_caption<?php echo esc_attr($frank_jewelry_store_blog_title_class); ?>"><?php
						if (!empty($frank_jewelry_store_top_icon)) {
							?><img src="<?php echo esc_url($frank_jewelry_store_top_icon); ?>" alt=""><?php
						}
						echo wp_kses_data($frank_jewelry_store_blog_title_text);
					?></h1>
					<?php
					if (!empty($frank_jewelry_store_blog_title_link) && !empty($frank_jewelry_store_blog_title_link_text)) {
						?><a href="<?php echo esc_url($frank_jewelry_store_blog_title_link); ?>" class="theme_button theme_button_small page_title_link"><?php echo esc_html($frank_jewelry_store_blog_title_link_text); ?></a><?php
					}
					
					// Category/Tag description
					if ( is_category() || is_tag() || is_tax() ) 
						the_archive_description( '<div class="page_description">', '</div>' );
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>