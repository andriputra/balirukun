<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('frank_jewelry_store_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'frank_jewelry_store_essential_grid_theme_setup9', 9 );
	function frank_jewelry_store_essential_grid_theme_setup9() {
		if (frank_jewelry_store_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'frank_jewelry_store_essential_grid_frontend_scripts', 1100 );
			add_filter( 'frank_jewelry_store_filter_merge_styles',					'frank_jewelry_store_essential_grid_merge_styles' );
			add_filter( 'frank_jewelry_store_filter_get_css',						'frank_jewelry_store_essential_grid_get_css', 10, 3 );
		}
		if (is_admin()) {
			add_filter( 'frank_jewelry_store_filter_tgmpa_required_plugins',		'frank_jewelry_store_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'frank_jewelry_store_exists_essential_grid' ) ) {
	function frank_jewelry_store_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'frank_jewelry_store_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('frank_jewelry_store_filter_tgmpa_required_plugins',	'frank_jewelry_store_essential_grid_tgmpa_required_plugins');
	function frank_jewelry_store_essential_grid_tgmpa_required_plugins($list=array()) {
		if (in_array('essential-grid', frank_jewelry_store_storage_get('required_plugins'))) {
			$path = frank_jewelry_store_get_file_dir('plugins/essential-grid/essential-grid.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' => esc_html__('Essential Grid', 'frank-jewelry-store'),
					'slug' => 'essential-grid',
					'source'	=> $path,
					'required' => false
				);
			}
		}
		return $list;
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'frank_jewelry_store_essential_grid_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'frank_jewelry_store_essential_grid_frontend_scripts', 1100 );
	function frank_jewelry_store_essential_grid_frontend_scripts() {
		if (frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('debug_mode')) && file_exists(frank_jewelry_store_get_file_dir('plugins/essential-grid/essential-grid.css')))
			frank_jewelry_store_enqueue_style( 'frank_jewelry_store-essential-grid',  frank_jewelry_store_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'frank_jewelry_store_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('frank_jewelry_store_filter_merge_styles', 'frank_jewelry_store_essential_grid_merge_styles');
	function frank_jewelry_store_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}



// Add plugin's specific styles into color scheme
//------------------------------------------------------------------------

// Add styles into CSS
if ( !function_exists( 'frank_jewelry_store_essential_grid_get_css' ) ) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_get_css', 'frank_jewelry_store_essential_grid_get_css', 10, 3 );
	function frank_jewelry_store_essential_grid_get_css($css, $colors, $fonts) {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
.eg-store-grid-fixed-wrapper .esg-cc > div a,
.eg-store-grid-fixed-wrapper .esg-cc > div a:hover,
.esg-grid .add_to_cart_button,
.esg-grid .add_to_cart_button:hover,
.eg-store-grid-wrapper .eg-store-grid-element-28-a a:hover,
.eg-store-grid-wrapper .eg-store-grid-element-28-a a,
.eg-store-grid-wrapper .eg-store-grid-element-0-a a,
.eg-store-grid-min-wrapper .eg-store-grid-min-element-28-a a:hover,
.eg-store-grid-min-wrapper .eg-store-grid-min-element-28-a a,
.eg-store-grid-min-wrapper .eg-store-grid-min-element-0-a a,
.eg-store-grid-min-dark-wrapper .eg-store-grid-min-dark-element-28-a a:hover,
.eg-store-grid-min-dark-wrapper .eg-store-grid-min-dark-element-28-a a,
.eg-store-grid-min-dark-wrapper .eg-store-grid-min-dark-element-0-a a,
.eg-store-grid-fixed-wrapper .eg-store-grid-fixed-element-0-a a:hover,
.eg-store-grid-fixed-wrapper .eg-store-grid-fixed-element-0-a a {
	{$fonts['h1_font-family']}
}

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS


.minimal-light .esg-filterbutton, .minimal-light .esg-navigationbutton, .minimal-light .esg-sortbutton, .minimal-light .esg-cartbutton a {
	color: {$colors['text']} !important;
	border-color: {$colors['bd_color']} !important;
}
.minimal-light .esg-navigationbutton:hover, .minimal-light .esg-filterbutton:hover, .minimal-light .esg-sortbutton:hover, .minimal-light .esg-sortbutton-order:hover, .minimal-light .esg-cartbutton a:hover, .minimal-light .esg-filterbutton.selected {
	color: {$colors['inverse_text']} !important;
	background-color: {$colors['text_hover']} !important;
	border-color: {$colors['text_hover']} !important;
}
.sc_content.sc_align_center .esg-navigationbutton i:hover:before {
	color: {$colors['text_hover']};
}
.esg-starring .star-rating span,
.esg-starring .star-rating:before {
    color: {$colors['text_hover']};
}
.esg-grid li.eg-store-grid-fixed-wrapper .esg-entry-cover {
	border-color: {$colors['text_hover']};
}

CSS;
		}
		
		return $css;
	}
}
?>