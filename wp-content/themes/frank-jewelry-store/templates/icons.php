<?php
/**
 * The template to displaying popup with Theme Icons
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

$frank_jewelry_store_icons = frank_jewelry_store_get_list_icons();
if (is_array($frank_jewelry_store_icons)) {
	?>
	<div class="frank_jewelry_store_list_icons">
		<?php
		foreach($frank_jewelry_store_icons as $icon) {
			?><span class="<?php echo esc_attr($icon); ?>" title="<?php echo esc_attr($icon); ?>"></span><?php
		}
		?>
	</div>
	<?php
}
?>