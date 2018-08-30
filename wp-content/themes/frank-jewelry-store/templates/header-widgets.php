<?php
/**
 * The template for displaying Header widgets area
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

// Header sidebar
$frank_jewelry_store_header_name = frank_jewelry_store_get_theme_option('header_widgets');
$frank_jewelry_store_header_present = !frank_jewelry_store_is_off($frank_jewelry_store_header_name) && is_active_sidebar($frank_jewelry_store_header_name);
if ($frank_jewelry_store_header_present) { 
	frank_jewelry_store_storage_set('current_sidebar', 'header');
	$frank_jewelry_store_header_wide = frank_jewelry_store_get_theme_option('header_wide');
	ob_start();
	do_action( 'frank_jewelry_store_action_before_sidebar' );
	if ( !dynamic_sidebar($frank_jewelry_store_header_name) ) {
		// Put here html if user no set widgets in sidebar
	}
	do_action( 'frank_jewelry_store_action_after_sidebar' );
	$frank_jewelry_store_widgets_output = ob_get_contents();
	ob_end_clean();
	$frank_jewelry_store_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $frank_jewelry_store_widgets_output);
	$frank_jewelry_store_need_columns = strpos($frank_jewelry_store_widgets_output, 'columns_wrap')===false;
	if ($frank_jewelry_store_need_columns) {
		$frank_jewelry_store_columns = max(0, (int) frank_jewelry_store_get_theme_option('header_columns'));
		if ($frank_jewelry_store_columns == 0) $frank_jewelry_store_columns = min(6, max(1, substr_count($frank_jewelry_store_widgets_output, '<aside ')));
		if ($frank_jewelry_store_columns > 1)
			$frank_jewelry_store_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($frank_jewelry_store_columns).' widget ', $frank_jewelry_store_widgets_output);
		else
			$frank_jewelry_store_need_columns = false;
	}
	?>
	<div class="header_widgets_wrap widget_area<?php echo !empty($frank_jewelry_store_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
		<div class="header_widgets_wrap_inner widget_area_inner">
			<?php 
			if (!$frank_jewelry_store_header_wide) { 
				?><div class="content_wrap"><?php
			}
			if ($frank_jewelry_store_need_columns) {
				?><div class="columns_wrap"><?php
			}
			frank_jewelry_store_show_layout($frank_jewelry_store_widgets_output);
			if ($frank_jewelry_store_need_columns) {
				?></div>	<!-- /.columns_wrap --><?php
			}
			if (!$frank_jewelry_store_header_wide) {
				?></div>	<!-- /.content_wrap --><?php
			}
			?>
		</div>	<!-- /.header_widgets_wrap_inner -->
	</div>	<!-- /.header_widgets_wrap -->
<?php
}
?>