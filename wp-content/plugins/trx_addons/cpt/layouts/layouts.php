<?php
/**
 * ThemeREX Addons Custom post type: Layouts
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// -----------------------------------------------------------------
// -- Custom post type registration
// -----------------------------------------------------------------

// Define Custom post type and taxonomy constants
if ( ! defined('TRX_ADDONS_CPT_LAYOUTS_PT') ) define('TRX_ADDONS_CPT_LAYOUTS_PT', trx_addons_cpt_param('layouts', 'post_type'));


// Register post type and taxonomy (if need)
if (!function_exists('trx_addons_cpt_layouts_init')) {
	add_action( 'init', 'trx_addons_cpt_layouts_init' );
	function trx_addons_cpt_layouts_init() {

		// Add Testimonials to the Meta Box support
		global $TRX_ADDONS_STORAGE;	// Need to declare global, because this file included inside autoload function!
		$TRX_ADDONS_STORAGE['post_types'][] = TRX_ADDONS_CPT_TESTIMONIALS_PT;
		$TRX_ADDONS_STORAGE['meta_box_'.TRX_ADDONS_CPT_TESTIMONIALS_PT] = array(
			"layout_type" => array(
				"title" => esc_html__("Type of the layout",  'trx_addons'),
				"desc" => wp_kses_data( __("Select the type of this layout", 'trx_addons') ),
				"std" => "horizontal",
				"options" => array(
					'horizontal' => esc_html__('Horizontal', 'trx_addons'),
					'vertical' => esc_html__('Vertical', 'trx_addons')
				),
				"type" => "select"
			)
		);

		// Register post type and taxonomy
		register_post_type( TRX_ADDONS_CPT_LAYOUTS_PT, array(
			'label'               => esc_html__( 'Layout', 'trx_addons' ),
			'description'         => esc_html__( 'Layout Description', 'trx_addons' ),
			'labels'              => array(
				'name'                => esc_html__( 'Layouts', 'trx_addons' ),
				'singular_name'       => esc_html__( 'Layout', 'trx_addons' ),
				'menu_name'           => esc_html__( 'Layouts', 'trx_addons' ),
				'parent_item_colon'   => esc_html__( 'Parent Item:', 'trx_addons' ),
				'all_items'           => esc_html__( 'All Layouts', 'trx_addons' ),
				'view_item'           => esc_html__( 'View Layout', 'trx_addons' ),
				'add_new_item'        => esc_html__( 'Add New Layout', 'trx_addons' ),
				'add_new'             => esc_html__( 'Add New', 'trx_addons' ),
				'edit_item'           => esc_html__( 'Edit Layout', 'trx_addons' ),
				'update_item'         => esc_html__( 'Update Layout', 'trx_addons' ),
				'search_items'        => esc_html__( 'Search Layout', 'trx_addons' ),
				'not_found'           => esc_html__( 'Not found', 'trx_addons' ),
				'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'trx_addons' ),
			),
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail'),
			'public'              => false,
			'hierarchical'        => false,
			'has_archive'         => false,
			'can_export'          => true,
			'show_in_admin_bar'   => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => '51.0',
			'menu_icon'			  => 'dashicons-editor-kitchensink',
			'capability_type'     => 'post',
			'rewrite'             => array( 'slug' => trx_addons_cpt_param('layouts', 'post_type_slug') )
			)
		);
	}
}

	
// Load required styles and scripts for the frontend
if ( !function_exists( 'trx_addons_cpt_layouts_load_scripts_front' ) ) {
	add_action("wp_enqueue_scripts", 'trx_addons_cpt_layouts_load_scripts_front');
	function trx_addons_cpt_layouts_load_scripts_front() {
		if (trx_addons_is_on(trx_addons_get_option('debug_mode'))) {
			trx_addons_enqueue_style( 'trx_addons-cpt_layouts', trx_addons_get_file_url('cpt/layouts/layouts.css'), array(), null );
		}
	}
}

	
// Merge shortcode's specific styles into single stylesheet
if ( !function_exists( 'trx_addons_cpt_layouts_merge_styles' ) ) {
	add_action("trx_addons_filter_merge_styles", 'trx_addons_cpt_layouts_merge_styles');
	function trx_addons_cpt_layouts_merge_styles($list) {
		$list[] = 'cpt/layouts/layouts.css';
		return $list;
	}
}



// Admin utils
// -----------------------------------------------------------------

// Create additional column in the posts list
if (!function_exists('trx_addons_cpt_layouts_add_custom_column')) {
	add_filter('manage_edit-'.trx_addons_cpt_param('layouts', 'post_type').'_columns',	'trx_addons_cpt_layouts_add_custom_column', 9);
	function trx_addons_cpt_layouts_add_custom_column( $columns ){
		if (is_array($columns) && count($columns)>0) {
			$new_columns = array();
			foreach($columns as $k=>$v) {
				if ($k=='title') {
					$new_columns['cpt_layouts_image'] = esc_html__('Image', 'trx_addons');
				}
				$new_columns[$k] = $v;
			}
			$columns = $new_columns;
		}
		return $columns;
	}
}

// Fill image column in the posts list
if (!function_exists('trx_addons_cpt_layouts_fill_custom_column')) {
	//add_filter('manage_post_custom_column',	'trx_addons_cpt_layouts_fill_custom_column', 9, 3);
	function trx_addons_cpt_layouts_fill_custom_column($column_name='', $post_id=0) {
		if ($column_name == 'cpt_layouts_image') {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'tiny' );
			if (!empty($image[0])) {
				?><img class="trx_addons_cpt_layouts_image_preview" src="<?php echo esc_url($image[0]); ?>" alt=""<?php if (!empty($image[1])) echo ' width="'.intval($image[1]).'"'; ?><?php if (!empty($image[2])) echo ' height="'.intval($image[2]).'"'; ?>><?php
			}
		}
	}
}



// trx_sc_layouts
//-------------------------------------------------------------
/*
[trx_sc_layouts id="unique_id" layout="layout_id"]
*/
if ( !function_exists( 'trx_addons_sc_layouts' ) ) {
	function trx_addons_sc_layouts($atts, $content=null) {	
		$atts = trx_addons_sc_prepare_atts('trx_sc_layouts', $atts, array(
			// Individual params
			"type" => "default",
			"layout_id" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
			)
		);

		ob_start();
		set_query_var('trx_addons_args_sc_layouts', $atts);
		if (($fdir = trx_addons_get_file_dir('cpt/layouts/tpl.'.trx_addons_esc($atts['type']).'.php')) != '') { include $fdir; }
		else if (($fdir = trx_addons_get_file_dir('cpt/layouts/tpl.default.php')) != '') { include $fdir; }
		$output = ob_get_contents();
		ob_end_clean();
		
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_layouts', $atts, $content);
	}
	if (trx_addons_exists_visual_composer()) add_shortcode("trx_sc_layouts", "trx_addons_sc_layouts");
}


// Add [trx_sc_layouts] in the VC shortcodes list
if (!function_exists('trx_addons_sc_layouts_add_in_vc')) {
	function trx_addons_sc_layouts_add_in_vc() {

		if (!trx_addons_exists_visual_composer()) return;

		vc_map( apply_filters('trx_addons_sc_map', array(
				"base" => "trx_sc_layouts",
				"name" => esc_html__("Layouts", 'trx_addons'),
				"description" => wp_kses_data( __("Display previously created layout (header, footer, etc.)", 'trx_addons') ),
				"category" => esc_html__('ThemeREX', 'trx_addons'),
				"icon" => 'icon_trx_sc_layouts',
				"class" => "trx_sc_layouts",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "type",
						"heading" => esc_html__("Type", 'trx_addons'),
						"description" => wp_kses_data( __("Select shortcodes's type", 'trx_addons') ),
						"std" => "default",
						"value" => apply_filters('trx_addons_sc_type', array(
							esc_html__('Default', 'trx_addons') => 'default',
						), 'trx_sc_layouts' ),
						"type" => "dropdown"
					),
					array(
						"param_name" => "layout",
						"heading" => esc_html__("Layout", 'trx_addons'),
						"description" => wp_kses_data( __("Layout", 'trx_addons') ),
						"value" => array_flip(trx_addons_get_list_posts(false, TRX_ADDONS_CPT_LAYOUTS_PT)),
						"type" => "dropdown"
					),
					// Common VC parameters
					'id' => array(
						"param_name" => "id",
						"heading" => esc_html__("Element ID", 'trx_addons'),
						"description" => wp_kses_data( __("ID for current element", 'trx_addons') ),
						"group" => esc_html__('ID &amp; Class', 'trx_addons'),
						"admin_label" => true,
						"type" => "textfield"
					),
					'class' => array(
						"param_name" => "class",
						"heading" => esc_html__("Element CSS class", 'trx_addons'),
						"description" => wp_kses_data( __("CSS class for current element", 'trx_addons') ),
						"group" => esc_html__('ID &amp; Class', 'trx_addons'),
						"admin_label" => true,
						"type" => "textfield"
					),
					'css' => array(
						'param_name' => 'css',
						'heading' => __( 'CSS box', 'trx_addons' ),
						'group' => __( 'Design Options', 'trx_addons' ),
						'type' => 'css_editor'
					)
				)
			), 'trx_sc_testimonials' ) );
			
		class WPBakeryShortCode_Trx_Sc_Layouts extends WPBakeryShortCode {}

	}
	add_action('after_setup_theme', 'trx_addons_sc_layouts_add_in_vc', 11);
}
?>