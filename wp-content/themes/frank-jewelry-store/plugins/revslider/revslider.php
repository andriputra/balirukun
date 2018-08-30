<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('frank_jewelry_store_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'frank_jewelry_store_revslider_theme_setup9', 9 );
	function frank_jewelry_store_revslider_theme_setup9() {
		if (is_admin()) {
			add_filter( 'frank_jewelry_store_filter_tgmpa_required_plugins',	'frank_jewelry_store_revslider_tgmpa_required_plugins' );
		}
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'frank_jewelry_store_exists_revslider' ) ) {
	function frank_jewelry_store_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'frank_jewelry_store_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('frank_jewelry_store_filter_tgmpa_required_plugins',	'frank_jewelry_store_revslider_tgmpa_required_plugins');
	function frank_jewelry_store_revslider_tgmpa_required_plugins($list=array()) {
		if (in_array('revslider', frank_jewelry_store_storage_get('required_plugins'))) {

			$path = frank_jewelry_store_get_file_dir('plugins/revslider/revslider.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' => esc_html__('Revolution Slider', 'frank-jewelry-store'),
					'slug' => 'revslider',
					'source'	=> $path,
					'required' => false
				);
			}
		}
		return $list;
	}
}
?>