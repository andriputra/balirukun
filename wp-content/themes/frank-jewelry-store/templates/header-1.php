<?php
/**
 * The template to display "Header 1"
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

$frank_jewelry_store_header_css = $frank_jewelry_store_header_image = '';
$frank_jewelry_store_header_video = wp_is_mobile() ? '' : frank_jewelry_store_get_theme_option('header_video');
if (true || empty($frank_jewelry_store_header_video)) {
	$frank_jewelry_store_header_image = get_header_image();
	if (frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('header_image_override')) && apply_filters('frank_jewelry_store_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($frank_jewelry_store_cat_img = frank_jewelry_store_get_category_image()) != '')
				$frank_jewelry_store_header_image = $frank_jewelry_store_cat_img;
		} else if (is_singular() || frank_jewelry_store_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$frank_jewelry_store_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($frank_jewelry_store_header_image)) $frank_jewelry_store_header_image = $frank_jewelry_store_header_image[0];
			} else
				$frank_jewelry_store_header_image = '';
		}
	}
}

// Store header image for navi
set_query_var('frank_jewelry_store_header_image', $frank_jewelry_store_header_image || $frank_jewelry_store_header_video);

?><header class="top_panel top_panel_style_1<?php
					echo !empty($frank_jewelry_store_header_image) || !empty($frank_jewelry_store_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($frank_jewelry_store_header_video!='') echo ' with_bg_video';
					if ($frank_jewelry_store_header_image!='') echo ' '.esc_attr(frank_jewelry_store_add_inline_style('background-image: url('.esc_url($frank_jewelry_store_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
					?>"><?php

	// Top panel
	get_template_part( 'templates/header-top-panel' );

	// Main menu
	if (frank_jewelry_store_get_theme_option("menu_style") == 'top') {
		// Mobile menu button
		?><a class="menu_mobile_button icon-menu-2"></a><?php
		// Navigation panel
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	get_template_part( 'templates/header-single' );

?></header>