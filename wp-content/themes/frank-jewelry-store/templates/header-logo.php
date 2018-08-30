<?php
/**
 * The template for displaying Logo or Site name and slogan in the Header
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

// Site logo
$frank_jewelry_store_logo_image = '';
if (frank_jewelry_store_get_retina_multiplier(2) > 1)
	$frank_jewelry_store_logo_image = frank_jewelry_store_get_theme_option( 'logo_retina' );
if (empty($frank_jewelry_store_logo_image)) 
	$frank_jewelry_store_logo_image = frank_jewelry_store_get_theme_option( 'logo' );
$frank_jewelry_store_logo_text   = get_bloginfo( 'name' );
$frank_jewelry_store_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($frank_jewelry_store_logo_image) || !empty($frank_jewelry_store_logo_text)) {
	?><a class="logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($frank_jewelry_store_logo_image)) {
			$frank_jewelry_store_attr = frank_jewelry_store_getimagesize($frank_jewelry_store_logo_image);
			echo '<img src="'.esc_url($frank_jewelry_store_logo_image).'" class="logo_main" alt=""'.(!empty($frank_jewelry_store_attr[3]) ? sprintf(' %s', $frank_jewelry_store_attr[3]) : '').'>' ;
		} else {
			frank_jewelry_store_show_layout(frank_jewelry_store_prepare_macros($frank_jewelry_store_logo_text), '<span class="logo_text">', '</span>');
			frank_jewelry_store_show_layout(frank_jewelry_store_prepare_macros($frank_jewelry_store_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>