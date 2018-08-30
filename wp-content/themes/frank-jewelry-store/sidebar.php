<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

$frank_jewelry_store_sidebar_position = frank_jewelry_store_get_theme_option('sidebar_position');
if (frank_jewelry_store_sidebar_present()) {
	$frank_jewelry_store_sidebar_name = frank_jewelry_store_get_theme_option('sidebar_widgets');
	frank_jewelry_store_storage_set('current_sidebar', 'sidebar');
	?>
	<div class="sidebar <?php echo esc_attr($frank_jewelry_store_sidebar_position); ?> widget_area<?php if (!frank_jewelry_store_is_inherit(frank_jewelry_store_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(frank_jewelry_store_get_theme_option('sidebar_scheme')); ?>" role="complementary">
		<div class="sidebar_inner">
			<?php
			ob_start();
			do_action( 'frank_jewelry_store_action_before_sidebar' );
			if ( !dynamic_sidebar($frank_jewelry_store_sidebar_name) ) {
				// Put here html if user no set widgets in sidebar
			}
			do_action( 'frank_jewelry_store_action_after_sidebar' );
			$frank_jewelry_store_out = ob_get_contents();
			ob_end_clean();
			frank_jewelry_store_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $frank_jewelry_store_out));
			?>
		</div><!-- /.sidebar_inner -->
	</div><!-- /.sidebar -->
	<?php
}
?>