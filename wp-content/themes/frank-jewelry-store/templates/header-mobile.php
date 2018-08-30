<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile
scheme_<?php echo esc_attr(frank_jewelry_store_is_inherit(frank_jewelry_store_get_theme_option('menu_scheme'))
	? (frank_jewelry_store_is_inherit(frank_jewelry_store_get_theme_option('header_scheme'))
		? frank_jewelry_store_get_theme_option('color_scheme')
		: frank_jewelry_store_get_theme_option('header_scheme'))
	: frank_jewelry_store_get_theme_option('menu_scheme')); ?>
">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a><?php

		// Logo
		get_template_part( 'templates/header-logo' );

		// Main menu
		frank_jewelry_store_show_layout(apply_filters('frank_jewelry_store_filter_menu_mobile_layout', str_replace(
					array('id="menu_main', 'id="menu-', 'class="menu_main'),
					array('id="menu_mobile', 'id="menu_mobile-', 'class="menu_mobile'),
					get_query_var('frank_jewelry_store_menu_main')
					)));
	
		// Search field
		?>
		<div class="search_mobile">
			<div class="search_form_wrap">
				<form role="search" method="get" class="search_form" action="<?php echo esc_url(home_url('/')); ?>">
					<input type="text" class="search_field" placeholder="<?php esc_attr_e('Search ...', 'frank-jewelry-store'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
					<button type="submit" class="search_submit icon-search" title="<?php esc_attr_e('Start search', 'frank-jewelry-store'); ?>"></button>
				</form>
			</div>
		</div>
		<?php
		
		// Social icons
		frank_jewelry_store_show_layout(frank_jewelry_store_get_socials_links(), '<div class="socials_mobile">', '</div>');
		?>
	</div>
</div>
