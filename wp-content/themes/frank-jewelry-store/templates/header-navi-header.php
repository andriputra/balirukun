<?php
/**
 * The template for displaying 'Header menu'
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

$frank_jewelry_store_header_image = get_query_var('frank_jewelry_store_header_image');

$frank_jewelry_store_frank_jewelry_store_menu_header = frank_jewelry_store_get_nav_menu('menu_header');

// Store menu layout for the mobile menu
set_query_var('frank_jewelry_store_menu_header', $frank_jewelry_store_frank_jewelry_store_menu_header);

if (!empty($frank_jewelry_store_frank_jewelry_store_menu_header)) {
	?>
	<div class="top_panel_navi_header 
				<?php if ($frank_jewelry_store_header_image!='') echo ' with_bg_image'; ?>
				scheme_<?php echo esc_attr(frank_jewelry_store_is_inherit(frank_jewelry_store_get_theme_option('header_scheme')) 
													? frank_jewelry_store_get_theme_option('color_scheme') 
													: frank_jewelry_store_get_theme_option('header_scheme')
											); ?>">
		<div class="menu_header_wrap clearfix menu_hover_<?php echo esc_attr(frank_jewelry_store_get_theme_option('menu_hover')); ?>">
			<div class="content_wrap">
				<?php frank_jewelry_store_show_layout($frank_jewelry_store_frank_jewelry_store_menu_header); ?>
			</div>
		</div>
	</div><!-- /.top_panel_navi_top -->
	<?php
}
?>