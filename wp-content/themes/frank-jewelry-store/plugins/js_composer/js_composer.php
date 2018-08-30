<?php
/* Visual Composer support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('frank_jewelry_store_vc_theme_setup9')) {
	add_action( 'after_setup_theme', 'frank_jewelry_store_vc_theme_setup9', 9 );
	function frank_jewelry_store_vc_theme_setup9() {
		if (frank_jewelry_store_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'frank_jewelry_store_vc_frontend_scripts', 1100 );
			add_filter( 'frank_jewelry_store_filter_merge_styles',						'frank_jewelry_store_vc_merge_styles' );
			add_filter( 'frank_jewelry_store_filter_merge_scripts',						'frank_jewelry_store_vc_merge_scripts' );
			add_filter( 'frank_jewelry_store_filter_get_css',							'frank_jewelry_store_vc_get_css', 10, 3 );
	
			// Add/Remove params in the standard VC shortcodes
			//-----------------------------------------------------
			add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,					'frank_jewelry_store_vc_add_params_classes', 10, 3 );
			
			// Color scheme
			$scheme = array(
				"param_name" => "scheme",
				"heading" => esc_html__("Color scheme", 'frank-jewelry-store'),
				"description" => wp_kses_data( __("Select color scheme to decorate this block", 'frank-jewelry-store') ),
				"group" => esc_html__('Colors', 'frank-jewelry-store'),
				"admin_label" => true,
				"value" => array_flip(frank_jewelry_store_get_list_schemes(true)),
				"type" => "dropdown"
			);
			vc_add_param("vc_row", $scheme);
			vc_add_param("vc_row_inner", $scheme);
			vc_add_param("vc_column", $scheme);
			vc_add_param("vc_column_inner", $scheme);
			vc_add_param("vc_column_text", $scheme);
			
			// Alter height and hide on mobile for Empty Space
			vc_add_param("vc_empty_space", array(
				"param_name" => "alter_height",
				"heading" => esc_html__("Alter height", 'frank-jewelry-store'),
				"description" => wp_kses_data( __("Select alternative height instead value from the field above", 'frank-jewelry-store') ),
				"admin_label" => true,
				"value" => array(
					esc_html__('Tiny', 'frank-jewelry-store') => 'tiny',
					esc_html__('Small', 'frank-jewelry-store') => 'small',
					esc_html__('Medium', 'frank-jewelry-store') => 'medium',
					esc_html__('Large', 'frank-jewelry-store') => 'large',
					esc_html__('Huge', 'frank-jewelry-store') => 'huge',
					esc_html__('From the value above', 'frank-jewelry-store') => 'none'
				),
				"type" => "dropdown"
			));
			vc_add_param("vc_empty_space", array(
				"param_name" => "hide_on_mobile",
				"heading" => esc_html__("Hide on mobile", 'frank-jewelry-store'),
				"description" => wp_kses_data( __("Hide this block on the mobile devices, when the columns are arranged one under another", 'frank-jewelry-store') ),
				"admin_label" => true,
				"std" => 0,
				"value" => array(
					esc_html__("Hide on mobile", 'frank-jewelry-store') => "1",
					esc_html__("Hide on notebook", 'frank-jewelry-store') => "2" 
					),
				"type" => "checkbox"
			));
			
			// Add Narrow style to the Progress bars
			vc_add_param("vc_progress_bar", array(
				"param_name" => "narrow",
				"heading" => esc_html__("Narrow", 'frank-jewelry-store'),
				"description" => wp_kses_data( __("Use narrow style for the progress bar", 'frank-jewelry-store') ),
				"std" => 0,
				"value" => array(esc_html__("Narrow style", 'frank-jewelry-store') => "1" ),
				"type" => "checkbox"
			));
			
			// Add param 'Closeable' to the Message Box
			vc_add_param("vc_message", array(
				"param_name" => "closeable",
				"heading" => esc_html__("Closeable", 'frank-jewelry-store'),
				"description" => wp_kses_data( __("Add 'Close' button to the message box", 'frank-jewelry-store') ),
				"std" => 0,
				"value" => array(esc_html__("Closeable", 'frank-jewelry-store') => "1" ),
				"type" => "checkbox"
			));
		}
		if (is_admin()) {
			add_filter( 'frank_jewelry_store_filter_tgmpa_required_plugins',		'frank_jewelry_store_vc_tgmpa_required_plugins' );
			add_filter( 'vc_iconpicker-type-fontawesome',				'frank_jewelry_store_vc_iconpicker_type_fontawesome' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'frank_jewelry_store_vc_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('frank_jewelry_store_filter_tgmpa_required_plugins',	'frank_jewelry_store_vc_tgmpa_required_plugins');
	function frank_jewelry_store_vc_tgmpa_required_plugins($list=array()) {
		if (in_array('js_composer', frank_jewelry_store_storage_get('required_plugins'))) {
			$path = frank_jewelry_store_get_file_dir('plugins/js_composer/js_composer.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' => esc_html__('Visual Composer', 'frank-jewelry-store'),
					'slug' => 'js_composer',
					'source' => $path,
					'required' => false
				);
			}
		}
		return $list;
	}
}

// Check if Visual Composer installed and activated
if ( !function_exists( 'frank_jewelry_store_exists_visual_composer' ) ) {
	function frank_jewelry_store_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if Visual Composer in frontend editor mode
if ( !function_exists( 'frank_jewelry_store_vc_is_frontend' ) ) {
	function frank_jewelry_store_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
		//return function_exists('vc_is_frontend_editor') && vc_is_frontend_editor();
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'frank_jewelry_store_vc_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'frank_jewelry_store_vc_frontend_scripts', 1100 );
	function frank_jewelry_store_vc_frontend_scripts() {
		if (frank_jewelry_store_exists_visual_composer()) {
			if (frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('debug_mode')) && file_exists(frank_jewelry_store_get_file_dir('plugins/js_composer/js_composer.css')))
				frank_jewelry_store_enqueue_style( 'frank_jewelry_store-js_composer',  frank_jewelry_store_get_file_url('plugins/js_composer/js_composer.css'), array(), null );
			if (frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('debug_mode')) && file_exists(frank_jewelry_store_get_file_dir('plugins/js_composer/js_composer.js')))
				frank_jewelry_store_enqueue_script( 'frank_jewelry_store-js_composer', frank_jewelry_store_get_file_url('plugins/js_composer/js_composer.js'), array('jquery') );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'frank_jewelry_store_vc_merge_styles' ) ) {
	//Handler of the add_filter('frank_jewelry_store_filter_merge_styles', 'frank_jewelry_store_vc_merge_styles');
	function frank_jewelry_store_vc_merge_styles($list) {
		$list[] = 'plugins/js_composer/js_composer.css';
		return $list;
	}
}
	
// Merge custom scripts
if ( !function_exists( 'frank_jewelry_store_vc_merge_scripts' ) ) {
	//Handler of the add_filter('frank_jewelry_store_filter_merge_scripts', 'frank_jewelry_store_vc_merge_scripts');
	function frank_jewelry_store_vc_merge_scripts($list) {
		$list[] = 'plugins/js_composer/js_composer.js';
		return $list;
	}
}
	
// Add theme icons into VC iconpicker list
if ( !function_exists( 'frank_jewelry_store_vc_iconpicker_type_fontawesome' ) ) {
	//Handler of the add_filter( 'vc_iconpicker-type-fontawesome',	'frank_jewelry_store_vc_iconpicker_type_fontawesome' );
	function frank_jewelry_store_vc_iconpicker_type_fontawesome($icons) {
		$list = frank_jewelry_store_get_list_icons();
		if (!is_array($list) || count($list) == 0) return $icons;
		$rez = array();
		foreach ($list as $icon)
			$rez[] = array($icon => str_replace('icon-', '', $icon));
		return array_merge( $icons, array(esc_html__('Theme Icons', 'frank-jewelry-store') => $rez) );
	}
}



// Shortcodes
//------------------------------------------------------------------------

// Add params to the standard VC shortcodes
if ( !function_exists( 'frank_jewelry_store_vc_add_params_classes' ) ) {
	//Handler of the add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,				'frank_jewelry_store_vc_add_params_classes', 10, 3 );
	function frank_jewelry_store_vc_add_params_classes($classes, $sc, $atts) {
		if (in_array($sc, array('vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$classes .= ($classes ? ' ' : '') . 'scheme_' . $atts['scheme'];
		} else if (in_array($sc, array('vc_empty_space'))) {
			if (!empty($atts['alter_height']) && !frank_jewelry_store_is_off($atts['alter_height']))
				$classes .= ($classes ? ' ' : '') . 'height_' . $atts['alter_height'];
			if (!empty($atts['hide_on_mobile'])) {
				if (strpos($atts['hide_on_mobile'], '1')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_mobile';
				if (strpos($atts['hide_on_mobile'], '2')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_notebook';
			}
		} else if (in_array($sc, array('vc_progress_bar'))) {
			if (!empty($atts['narrow']) && (int) $atts['narrow']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_progress_bar_narrow';
		} else if (in_array($sc, array('vc_message'))) {
			if (!empty($atts['closeable']) && (int) $atts['closeable']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_message_box_closeable';
		}
		return $classes;
	}
}


// Add VC specific styles into color scheme
//------------------------------------------------------------------------

// Add styles into CSS
if ( !function_exists( 'frank_jewelry_store_vc_get_css' ) ) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_get_css', 'frank_jewelry_store_vc_get_css', 10, 3 );
	function frank_jewelry_store_vc_get_css($css, $colors, $fonts) {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
.vc_tta.vc_tta-accordion .vc_tta-panel-title .vc_tta-title-text {
	{$fonts['p_font-family']}
}
.vc_general.vc_cta3.vc_cta3-color-classic.vc_cta3-style-classic .vc_btn3-style-classic,
.vc_general.vc_cta3.vc_cta3-color-classic.vc_cta3-style-flat .vc_btn3-style-classic,
.vc_general.vc_cta3.vc_cta3-style-classic .vc_cta3-content header + p *,
.vc_general.vc_cta3.vc_cta3-style-classic .vc_cta3-content header + p,
.vc_general.vc_cta3.vc_cta3-style-flat .vc_cta3-content header + p *,
.vc_general.vc_cta3.vc_cta3-style-flat .vc_cta3-content header + p,
.vc_tta.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a,
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label .vc_label_units,
.vc_progress_bar .vc_single_bar .vc_label {
	{$fonts['h1_font-family']}
}

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Row and columns */
.scheme_self.wpb_row,
.scheme_self.wpb_column > .vc_column-inner > .wpb_wrapper,
.scheme_self.wpb_text_column {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}
.scheme_self.vc_row.vc_parallax[class*="scheme_"] .vc_parallax-inner:before {
	background-color: {$colors['bg_color_08']};
}


.vc_general.vc_cta3.vc_cta3-color-classic.vc_cta3-style-classic .vc_cta3-content-header,
.vc_general.vc_cta3.vc_cta3-color-classic.vc_cta3-style-classic,
.vc_general.vc_cta3.vc_cta3-color-classic.vc_cta3-style-classic *,
.vc_general.vc_cta3.vc_cta3-color-classic.vc_cta3-style-classic i {
    color: {$colors['text_link']};
}


/* Accordion */
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_dark']};
}
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:before,
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:after {
	border-color: {$colors['inverse_text']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a {
	color: {$colors['text_dark']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover {
	color: {$colors['text_link']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover .vc_tta-controls-icon {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon:before,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon:after {
	border-color: {$colors['inverse_text']};
}

/* Tabs */
.vc_tta.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_dark']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a:hover,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab.vc_active > a {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_dark']};
}

.vc_tta.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a:before {
	background-color: {$colors['text_hover']};
}

/* Separator */
.vc_separator.vc_sep_color_grey .vc_sep_line {
	border-color: {$colors['bd_color']};
}

/* Progress bar */
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar {
	background-color: {$colors['alter_bg_color']};
}
.vc_progress_bar.vc_progress_bar_narrow.vc_progress-bar-color-bar_red .vc_single_bar .vc_bar {
	background-color: {$colors['alter_link']};
}
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label {
	color: {$colors['text_dark']};
}
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label .vc_label_units {
	color: {$colors['text_dark']};
}

CSS;
		}
		
		return $css;
	}
}
?>