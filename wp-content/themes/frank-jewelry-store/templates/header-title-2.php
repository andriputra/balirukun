<?php
/**
 * The template to display image and page description
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

$frank_jewelry_store_image = frank_jewelry_store_get_theme_option('header_title_image');
$frank_jewelry_store_text = frank_jewelry_store_get_theme_option('header_title_text');
if (!empty($frank_jewelry_store_image) || !empty($frank_jewelry_store_text)) {
	?>
	<div class="top_panel_title_2_wrap">
		<div class="content_wrap">
			<div class="top_panel_title_2">
				<?php
				if (!empty($frank_jewelry_store_image)) {
					$frank_jewelry_store_attr = frank_jewelry_store_getimagesize($frank_jewelry_store_image);
					echo '<div class="top_panel_title_2_image"><img src="'.esc_url($frank_jewelry_store_image).'" alt=""'.(!empty($frank_jewelry_store_attr[3]) ? sprintf(' %s', $frank_jewelry_store_attr[3]) : '').'></div>';
				}
				frank_jewelry_store_show_layout($frank_jewelry_store_text, '<div class="top_panel_title_2_text">', '</div>');
				?>
			</div>
		</div>
	</div>
	<?php
}
?>