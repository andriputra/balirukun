<?php
/**
 * The template for displaying main menu 2
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */
$frank_jewelry_store_header_image = get_query_var('frank_jewelry_store_header_image');
?>
<div class="top_panel_fixed_wrap"></div>
<div class="top_panel_navi 
			<?php if ($frank_jewelry_store_header_image!='') echo ' with_bg_image'; ?>
			scheme_<?php echo esc_attr(frank_jewelry_store_is_inherit(frank_jewelry_store_get_theme_option('menu_scheme')) 
												? (frank_jewelry_store_is_inherit(frank_jewelry_store_get_theme_option('header_scheme')) 
													? frank_jewelry_store_get_theme_option('color_scheme') 
													: frank_jewelry_store_get_theme_option('header_scheme')) 
												: frank_jewelry_store_get_theme_option('menu_scheme')); ?>">
	<div class="menu_main_wrap clearfix menu_hover_<?php echo esc_attr(frank_jewelry_store_get_theme_option('menu_hover')); ?>">
		<div class="content_wrap">
			<?php
			// Filter header components
			$frank_jewelry_store_header_parts = apply_filters('frank_jewelry_store_filter_header_parts', array(
				'logo' => true,
				'menu' => true,
				'search' => true
				),
				'menu_main');
			
			// Logo
			if (!empty($frank_jewelry_store_header_parts['logo'])) {
				get_template_part( 'templates/header-logo' );
			}
			
			// Main menu
			if (!empty($frank_jewelry_store_header_parts['menu'])) {
				$frank_jewelry_store_frank_jewelry_store_menu_main = frank_jewelry_store_get_nav_menu('menu_main');
				if (empty($frank_jewelry_store_frank_jewelry_store_menu_main)) $frank_jewelry_store_frank_jewelry_store_menu_main = frank_jewelry_store_get_nav_menu();
				frank_jewelry_store_show_layout($frank_jewelry_store_frank_jewelry_store_menu_main);
				// Store menu layout for the mobile menu
				set_query_var('frank_jewelry_store_menu_main', $frank_jewelry_store_frank_jewelry_store_menu_main);
			}
			?>
		</div>
	</div>
</div><!-- /.top_panel_navi -->