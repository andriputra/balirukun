<?php
/* Configure ThemeREX Addons components: CV, CPT, Widgets and Shortcodes
------------------------------------------------------------------------------- */

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if (!function_exists('frank_jewelry_store_trx_addons_theme_setup1')) {
	add_action( 'after_setup_theme', 'frank_jewelry_store_trx_addons_theme_setup1', 1 );
	add_action( 'trx_addons_action_save_options', 'frank_jewelry_store_trx_addons_theme_setup1', 8 );
	function frank_jewelry_store_trx_addons_theme_setup1() {
		add_filter( 'frank_jewelry_store_filter_list_sidebars', 'frank_jewelry_store_trx_addons_list_sidebars' );
		if (frank_jewelry_store_exists_trx_addons()) {
			add_filter( 'trx_addons_cv_enable',				'frank_jewelry_store_trx_addons_cv_enable');
			add_filter( 'trx_addons_cpt_list',				'frank_jewelry_store_trx_addons_cpt_list');
			add_filter( 'trx_addons_sc_list',				'frank_jewelry_store_trx_addons_sc_list');
			add_filter( 'trx_addons_widgets_list',			'frank_jewelry_store_trx_addons_widgets_list');
			add_filter( 'frank_jewelry_store_filter_list_posts_types',	'frank_jewelry_store_trx_addons_list_post_types');
		}
	}
}

// Enable/Disable CV
if ( !function_exists( 'frank_jewelry_store_trx_addons_cv_enable' ) ) {
	//Handler of the add_filter( 'trx_addons_cv_enable', 'frank_jewelry_store_trx_addons_cv_enable');
	function frank_jewelry_store_trx_addons_cv_enable($enable=false) {
		// To do: return false if theme not use CV functionality
		return false;
	}
}

// Enable/Disable CPT
if ( !function_exists( 'frank_jewelry_store_trx_addons_cpt_list' ) ) {
	//Handler of the add_filter('trx_addons_cpt_list',	'frank_jewelry_store_trx_addons_cpt_list');
	function frank_jewelry_store_trx_addons_cpt_list($list=array()) {
		// To do: Enable/Disable CPT via add/remove it in the list
		unset($list['courses']);
		unset($list['portfolio']);
		unset($list['resume']);
		unset($list['team']);
		unset($list['certificates']);
		return $list;
	}
}

// Add/Remove shortcodes
if ( !function_exists( 'frank_jewelry_store_trx_addons_sc_list' ) ) {
	//Handler of the add_filter('trx_addons_sc_list',	'frank_jewelry_store_trx_addons_sc_list');
	function frank_jewelry_store_trx_addons_sc_list($list=array()) {
		// To do: Add/Remove shortcodes into list
		// If you add new shortcode - in the theme's folder must exists /trx_addons/shortcodes/new_sc_name/new_sc_name.php
		return $list;
	}
}

// Add/Remove widgets
if ( !function_exists( 'frank_jewelry_store_trx_addons_widgets_list' ) ) {
	//Handler of the add_filter('trx_addons_widgets_list',	'frank_jewelry_store_trx_addons_widgets_list');
	function frank_jewelry_store_trx_addons_widgets_list($list=array()) {
		// To do: Add/Remove widgets into list
		// If you add widget - in the theme's folder must exists /trx_addons/widgets/new_widget_name/new_widget_name.php
		if (is_array($list) && count($list) > 0) {
			$new = array();
			foreach ($list as $cpt)
				if (!in_array($cpt, array('contacts','categories_list','aboutme')))
					$new[] = $cpt;
			$list = $new;
		}
		return $list;
	}
}

// Add sidebar
if ( !function_exists( 'frank_jewelry_store_trx_addons_list_sidebars' ) ) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_list_sidebars', 'frank_jewelry_store_trx_addons_list_sidebars' );
	function frank_jewelry_store_trx_addons_list_sidebars($list=array()) {
		//$list['trx_addons_courses_widgets'] = esc_html__('Courses Widgets', 'frank-jewelry-store');
		return $list;
	}
}



/* Add options in the Theme Options Customizer
------------------------------------------------------------------------------- */

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('frank_jewelry_store_trx_addons_theme_setup3')) {
	add_action( 'after_setup_theme', 'frank_jewelry_store_trx_addons_theme_setup3', 3 );
	function frank_jewelry_store_trx_addons_theme_setup3() {
		if (frank_jewelry_store_exists_courses()) {
			frank_jewelry_store_storage_merge_array('options', '', array(
				// Section 'Courses' - settings for show pages
				'courses' => array(
					"title" => esc_html__('Courses', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Select parameters to display the courses pages', 'frank-jewelry-store') ),
					"type" => "section"
					),
				'expand_content_courses' => array(
					"title" => esc_html__('Expand content', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'frank-jewelry-store') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'header_widgets_courses' => array(
					"title" => esc_html__('Header widgets', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the courses pages', 'frank-jewelry-store') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
					"type" => "select"
					),
				'sidebar_widgets_courses' => array(
					"title" => esc_html__('Sidebar widgets', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Select sidebar to show on the courses pages', 'frank-jewelry-store') ),
					"std" => 'courses_widgets',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
					"type" => "select"
					),
				'sidebar_position_courses' => array(
					"title" => esc_html__('Sidebar position', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the courses pages', 'frank-jewelry-store') ),
					"refresh" => false,
					"std" => 'left',
					"options" => frank_jewelry_store_get_list_sidebars_positions(),
					"type" => "select"
					),
				'widgets_above_page_courses' => array(
					"title" => esc_html__('Widgets above the page', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'frank-jewelry-store') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
					"type" => "select"
					),
				'widgets_above_content_courses' => array(
					"title" => esc_html__('Widgets above the content', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'frank-jewelry-store') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
					"type" => "select"
					),
				'widgets_below_content_courses' => array(
					"title" => esc_html__('Widgets below the content', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'frank-jewelry-store') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
					"type" => "select"
					),
				'widgets_below_page_courses' => array(
					"title" => esc_html__('Widgets below the page', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'frank-jewelry-store') ),
					"std" => 'hide',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
					"type" => "select"
					),
				'footer_scheme_courses' => array(
					"title" => esc_html__('Footer Color Scheme', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'frank-jewelry-store') ),
					"std" => 'dark',
					"options" => frank_jewelry_store_get_list_schemes(true),
					"type" => "select"
					),
				'footer_widgets_courses' => array(
					"title" => esc_html__('Footer widgets', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'frank-jewelry-store') ),
					"std" => 'footer_widgets',
					"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
					"type" => "select"
					),
				'footer_columns_courses' => array(
					"title" => esc_html__('Footer columns', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'frank-jewelry-store') ),
					"dependency" => array(
						'footer_widgets_courses' => array('^hide')
					),
					"std" => 0,
					"options" => frank_jewelry_store_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_courses' => array(
					"title" => esc_html__('Footer fullwide', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'frank-jewelry-store') ),
					"std" => 0,
					"type" => "checkbox"
					)
				)
			);
		}
	}
}



/* ThemeREX Addons support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('frank_jewelry_store_trx_addons_theme_setup9')) {
	add_action( 'after_setup_theme', 'frank_jewelry_store_trx_addons_theme_setup9', 9 );
	function frank_jewelry_store_trx_addons_theme_setup9() {
		if (frank_jewelry_store_exists_trx_addons()) {
			add_filter( 'trx_addons_sc_atts',							'frank_jewelry_store_trx_addons_sc_atts', 10, 2);
			add_filter( 'trx_addons_sc_output',							'frank_jewelry_store_trx_addons_sc_output', 10, 4);
			add_filter( 'trx_addons_filter_add_thumb_sizes',			'frank_jewelry_store_trx_addons_add_thumb_sizes');
			add_filter( 'trx_addons_filter_get_thumb_size',				'frank_jewelry_store_trx_addons_get_thumb_size');
			add_filter( 'trx_addons_filter_team_thumb_size',			'frank_jewelry_store_trx_addons_team_thumb_size', 10, 2);
			add_filter( 'trx_addons_filter_sc_item_title_tag',			'frank_jewelry_store_trx_addons_sc_item_title_tag');
			add_filter( 'trx_addons_filter_sc_item_button_args',		'frank_jewelry_store_trx_addons_sc_item_button_args', 10, 2);
			add_filter( 'trx_addons_filter_sc_googlemap_styles',		'frank_jewelry_store_trx_addons_sc_googlemap_styles');
			add_filter( 'trx_addons_filter_featured_image',				'frank_jewelry_store_trx_addons_featured_image', 10, 2);
			add_filter( 'trx_addons_filter_no_image',					'frank_jewelry_store_trx_addons_no_image' );
			add_filter( 'trx_addons_filter_get_list_icons',				'frank_jewelry_store_trx_addons_get_list_icons', 10, 2 );
			add_filter( 'trx_addons_filter_slider_title',				'frank_jewelry_store_trx_addons_slider_title', 10, 2 );
			add_filter( 'trx_addons_filter_meta_box_fields',			'frank_jewelry_store_trx_addons_meta_box_fields', 10, 2);
			add_action( 'wp_enqueue_scripts', 							'frank_jewelry_store_trx_addons_frontend_scripts', 1100 );
			add_filter( 'frank_jewelry_store_filter_localize_script',				'frank_jewelry_store_trx_addons_localize_script' );
			add_filter( 'frank_jewelry_store_filter_query_sort_order',	 			'frank_jewelry_store_trx_addons_query_sort_order', 10, 3);
			add_filter( 'frank_jewelry_store_filter_merge_styles',					'frank_jewelry_store_trx_addons_merge_styles');
			add_filter( 'frank_jewelry_store_filter_merge_scripts',					'frank_jewelry_store_trx_addons_merge_scripts');
			add_filter( 'frank_jewelry_store_filter_get_css',						'frank_jewelry_store_trx_addons_get_css', 10, 3);
			add_filter( 'frank_jewelry_store_filter_get_post_categories',		 	'frank_jewelry_store_trx_addons_get_post_categories');
			add_filter( 'frank_jewelry_store_filter_get_post_date',		 			'frank_jewelry_store_trx_addons_get_post_date');
			add_filter( 'frank_jewelry_store_filter_post_type_taxonomy',			'frank_jewelry_store_trx_addons_post_type_taxonomy', 10, 2 );
			if (is_admin()) {
				add_filter( 'frank_jewelry_store_filter_allow_meta_box', 			'frank_jewelry_store_trx_addons_allow_meta_box', 10, 2);
				add_filter( 'trx_addons_sc_type',						'frank_jewelry_store_trx_addons_sc_type', 10, 2);
				add_filter( 'trx_addons_sc_map',						'frank_jewelry_store_trx_addons_sc_map', 10, 2);
			} else {
				add_filter( 'frank_jewelry_store_filter_detect_blog_mode',			'frank_jewelry_store_trx_addons_detect_blog_mode' );
				add_filter( 'frank_jewelry_store_filter_get_blog_all_posts_link', 	'frank_jewelry_store_trx_addons_get_blog_all_posts_link');
				add_filter( 'frank_jewelry_store_filter_get_blog_title', 			'frank_jewelry_store_trx_addons_get_blog_title');
				add_filter( 'frank_jewelry_store_filter_need_page_title', 			'frank_jewelry_store_trx_addons_need_page_title');
				add_filter( 'frank_jewelry_store_filter_sidebar_present',			'frank_jewelry_store_trx_addons_sidebar_present' );
				add_filter( 'frank_jewelry_store_filter_allow_override_header_image','frank_jewelry_store_trx_addons_allow_override_header_image' );
			}
		}
		if (is_admin()) {
			add_filter( 'frank_jewelry_store_filter_tgmpa_required_plugins',		'frank_jewelry_store_trx_addons_tgmpa_required_plugins' );
			add_action( 'admin_enqueue_scripts', 						'frank_jewelry_store_trx_addons_editor_load_scripts_admin');
			add_filter( 'tiny_mce_before_init', 						'frank_jewelry_store_trx_addons_editor_init', 11);
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'frank_jewelry_store_trx_addons_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('frank_jewelry_store_filter_tgmpa_required_plugins',	'frank_jewelry_store_trx_addons_tgmpa_required_plugins');
	function frank_jewelry_store_trx_addons_tgmpa_required_plugins($list=array()) {
		if (in_array('trx_addons', frank_jewelry_store_storage_get('required_plugins'))) {
			$path = frank_jewelry_store_get_file_dir('plugins/trx_addons/trx_addons.zip');
			if (file_exists($path)) {
				$list[] = array(
						'name' 		=> esc_html__('ThemeREX Addons', 'frank-jewelry-store'),
						'slug' 		=> 'trx_addons',
						'version'	=> '10.10.11',
						'source'	=> $path,
						'required' 	=> true
					);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'frank_jewelry_store_exists_trx_addons' ) ) {
	function frank_jewelry_store_exists_trx_addons() {
		return defined('TRX_ADDONS_VERSION');
	}
}

// Return true if team is supported
if ( !function_exists( 'frank_jewelry_store_exists_team' ) ) {
	function frank_jewelry_store_exists_team() {
		return defined('TRX_ADDONS_CPT_TEAM_PT');
	}
}

// Return true if services is supported
if ( !function_exists( 'frank_jewelry_store_exists_services' ) ) {
	function frank_jewelry_store_exists_services() {
		return defined('TRX_ADDONS_CPT_SERVICES_PT');
	}
}

// Return true if portfolio is supported
if ( !function_exists( 'frank_jewelry_store_exists_portfolio' ) ) {
	function frank_jewelry_store_exists_portfolio() {
		return defined('TRX_ADDONS_CPT_PORTFOLIO_PT');
	}
}

// Return true if courses is supported
if ( !function_exists( 'frank_jewelry_store_exists_courses' ) ) {
	function frank_jewelry_store_exists_courses() {
		return defined('TRX_ADDONS_CPT_COURSES_PT');
	}
}

// Return true if it's team page
if ( !function_exists( 'frank_jewelry_store_is_team_page' ) ) {
	function frank_jewelry_store_is_team_page() {
		return defined('TRX_ADDONS_CPT_TEAM_PT') 
					&& !is_search()
					&& (
						(is_single() && get_post_type()==TRX_ADDONS_CPT_TEAM_PT)
						|| is_post_type_archive(TRX_ADDONS_CPT_TEAM_PT)
						|| is_tax(TRX_ADDONS_CPT_TEAM_TAXONOMY)
						);
	}
}

// Return true if it's services page
if ( !function_exists( 'frank_jewelry_store_is_services_page' ) ) {
	function frank_jewelry_store_is_services_page() {
		return defined('TRX_ADDONS_CPT_SERVICES_PT') 
					&& !is_search()
					&& (
						(is_single() && get_post_type()==TRX_ADDONS_CPT_SERVICES_PT)
						|| is_post_type_archive(TRX_ADDONS_CPT_SERVICES_PT)
						|| is_tax(TRX_ADDONS_CPT_SERVICES_TAXONOMY)
						);
	}
}

// Return true if it's portfolio page
if ( !function_exists( 'frank_jewelry_store_is_portfolio_page' ) ) {
	function frank_jewelry_store_is_portfolio_page() {
		return defined('TRX_ADDONS_CPT_PORTFOLIO_PT') 
					&& !is_search()
					&& (
						(is_single() && get_post_type()==TRX_ADDONS_CPT_PORTFOLIO_PT)
						|| is_post_type_archive(TRX_ADDONS_CPT_PORTFOLIO_PT)
						|| is_tax(TRX_ADDONS_CPT_PORTFOLIO_TAXONOMY)
						);
	}
}

// Return true if it's courses page
if ( !function_exists( 'frank_jewelry_store_is_courses_page' ) ) {
	function frank_jewelry_store_is_courses_page() {
		return defined('TRX_ADDONS_CPT_COURSES_PT') 
					&& !is_search()
					&& (
						(is_single() && get_post_type()==TRX_ADDONS_CPT_COURSES_PT)
						|| is_post_type_archive(TRX_ADDONS_CPT_COURSES_PT)
						|| is_tax(TRX_ADDONS_CPT_COURSES_TAXONOMY)
						);
	}
}


// Enqueue custom styles
if ( !function_exists( 'frank_jewelry_store_trx_addons_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'frank_jewelry_store_trx_addons_frontend_scripts', 1100 );
	function frank_jewelry_store_trx_addons_frontend_scripts() {
		if (frank_jewelry_store_exists_trx_addons()) {
			if (frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('debug_mode')) && file_exists(frank_jewelry_store_get_file_dir('plugins/trx_addons/trx_addons.css')))
				frank_jewelry_store_enqueue_style( 'frank_jewelry_store-trx_addons',  frank_jewelry_store_get_file_url('plugins/trx_addons/trx_addons.css'), array(), null );
			if (frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('debug_mode')) && file_exists(frank_jewelry_store_get_file_dir('plugins/trx_addons/trx_addons.js')))
				frank_jewelry_store_enqueue_script( 'frank_jewelry_store-trx_addons', frank_jewelry_store_get_file_url('plugins/trx_addons/trx_addons.js'), array('jquery') );
		}
	}
}

// Add vars into localize array
if (!function_exists('frank_jewelry_store_trx_addons_localize_script')) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_localize_script','frank_jewelry_store_trx_addons_localize_script' );
	function frank_jewelry_store_trx_addons_localize_script($arr) {
		$arr['alter_link_color'] = frank_jewelry_store_get_scheme_color('alter_link');
		return $arr;
	}
}
	
// Merge custom styles
if ( !function_exists( 'frank_jewelry_store_trx_addons_merge_styles' ) ) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_merge_styles', 'frank_jewelry_store_trx_addons_merge_styles');
	function frank_jewelry_store_trx_addons_merge_styles($list) {
		$list[] = 'plugins/trx_addons/trx_addons.css';
		return $list;
	}
}
	
// Merge custom scripts
if ( !function_exists( 'frank_jewelry_store_trx_addons_merge_scripts' ) ) {
	//Handler of the add_filter('frank_jewelry_store_filter_merge_scripts', 'frank_jewelry_store_trx_addons_merge_scripts');
	function frank_jewelry_store_trx_addons_merge_scripts($list) {
		$list[] = 'plugins/trx_addons/trx_addons.js';
		return $list;
	}
}

// Detect current blog mode
if ( !function_exists( 'frank_jewelry_store_trx_addons_detect_blog_mode' ) ) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_detect_blog_mode', 'frank_jewelry_store_trx_addons_detect_blog_mode' );
	function frank_jewelry_store_trx_addons_detect_blog_mode($mode='') {
		if ( frank_jewelry_store_is_team_page() )
			$mode = 'team';
		else if ( frank_jewelry_store_is_services_page() )
			$mode = 'services';
		else if ( frank_jewelry_store_is_portfolio_page() )
			$mode = 'portfolio';
		else if ( frank_jewelry_store_is_courses_page() )
			$mode = 'courses';
		return $mode;
	}
}

// Return taxonomy for current post type
if ( !function_exists( 'frank_jewelry_store_trx_addons_post_type_taxonomy' ) ) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_post_type_taxonomy',	'frank_jewelry_store_trx_addons_post_type_taxonomy', 10, 2 );
	function frank_jewelry_store_trx_addons_post_type_taxonomy($tax='', $post_type='') {
		if ( defined('TRX_ADDONS_CPT_TEAM_PT') && $post_type == TRX_ADDONS_CPT_TEAM_PT )
			$tax = TRX_ADDONS_CPT_TEAM_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_SERVICES_PT') && $post_type == TRX_ADDONS_CPT_SERVICES_PT )
			$tax = TRX_ADDONS_CPT_SERVICES_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_PORTFOLIO_PT') && $post_type == TRX_ADDONS_CPT_PORTFOLIO_PT )
			$tax = TRX_ADDONS_CPT_PORTFOLIO_TAXONOMY;
		else if ( defined('TRX_ADDONS_CPT_COURSES_PT') && $post_type == TRX_ADDONS_CPT_COURSES_PT )
			$tax = TRX_ADDONS_CPT_COURSES_TAXONOMY;
		return $tax;
	}
}

// Return link to the all courses, team, etc. for the breadcrumbs
if ( !function_exists( 'frank_jewelry_store_trx_addons_get_blog_all_posts_link' ) ) {
	//Handler of the add_filter('frank_jewelry_store_filter_get_blog_all_posts_link', 'frank_jewelry_store_trx_addons_get_blog_all_posts_link');
	function frank_jewelry_store_trx_addons_get_blog_all_posts_link($link='') {
		if ($link=='') {
			if (frank_jewelry_store_is_courses_page() && !is_post_type_archive(TRX_ADDONS_CPT_COURSES_PT))
				$link = '<a href="'.esc_url(get_post_type_archive_link( TRX_ADDONS_CPT_COURSES_PT )).'">'.esc_html__('All Courses', 'frank-jewelry-store').'</a>';
			else if (frank_jewelry_store_is_services_page() && !is_post_type_archive(TRX_ADDONS_CPT_SERVICES_PT))
				$link = '<a href="'.esc_url(get_post_type_archive_link( TRX_ADDONS_CPT_SERVICES_PT )).'">'.esc_html__('All Services', 'frank-jewelry-store').'</a>';
			else if (frank_jewelry_store_is_portfolio_page() && !is_post_type_archive(TRX_ADDONS_CPT_PORTFOLIO_PT))
				$link = '<a href="'.esc_url(get_post_type_archive_link( TRX_ADDONS_CPT_PORTFOLIO_PT )).'">'.esc_html__('All Portfolio Items', 'frank-jewelry-store').'</a>';
			else if (frank_jewelry_store_is_team_page() && !is_post_type_archive(TRX_ADDONS_CPT_TEAM_PT))
				$link = '<a href="'.esc_url(get_post_type_archive_link( TRX_ADDONS_CPT_TEAM_PT )).'">'.esc_html__('All Team Members', 'frank-jewelry-store').'</a>';
		}
		return $link;
	}
}

// Return current page title
if ( !function_exists( 'frank_jewelry_store_trx_addons_get_blog_title' ) ) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_get_blog_title', 'frank_jewelry_store_trx_addons_get_blog_title');
	function frank_jewelry_store_trx_addons_get_blog_title($title='') {

		if ( defined('TRX_ADDONS_CPT_TEAM_PT') ) {
			if (is_single() && get_post_type()==TRX_ADDONS_CPT_TEAM_PT)
				$title = esc_html__('Team Member', 'frank-jewelry-store');
			else if ( is_post_type_archive(TRX_ADDONS_CPT_TEAM_PT) )
				$title = esc_html__('All Team Members', 'frank-jewelry-store');

		}

		if ( defined('TRX_ADDONS_CPT_SERVICES_PT') ) {
			if ( is_post_type_archive(TRX_ADDONS_CPT_SERVICES_PT) )
				$title = esc_html__('All Services', 'frank-jewelry-store');

		}

		if ( defined('TRX_ADDONS_CPT_PORTFOLIO_PT') ) {
			if ( is_post_type_archive(TRX_ADDONS_CPT_PORTFOLIO_PT) )
				$title = esc_html__('All Portfolio Items', 'frank-jewelry-store');

		}
		
		if ( defined('TRX_ADDONS_CPT_COURSES_PT') ) {
			if (is_single() && get_post_type()==TRX_ADDONS_CPT_COURSES_PT) {
				$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
				$title = array(
					'text' => get_the_title(),
					'class' => 'courses_page_title'
				);
				if (!empty($meta['product']) && (int) $meta['product'] > 0) {
					$title['link'] = get_permalink($meta['product']);
					$title['link_text'] = esc_html__('Join the Course', 'frank-jewelry-store');
				}
			} else if ( is_post_type_archive(TRX_ADDONS_CPT_COURSES_PT) )
				$title = esc_html__('All Courses', 'frank-jewelry-store');
		}
		return $title;
	}
}

// Return true if page title section is allowed
if ( !function_exists( 'frank_jewelry_store_trx_addons_need_page_title' ) ) {
	//Handler of the add_filter('frank_jewelry_store_filter_need_page_title', 'frank_jewelry_store_trx_addons_need_page_title');
	function frank_jewelry_store_trx_addons_need_page_title($need=false) {
		if (!$need)
			$need = frank_jewelry_store_is_team_page() || frank_jewelry_store_is_services_page() || frank_jewelry_store_is_portfolio_page() || frank_jewelry_store_is_courses_page();
		return $need;
	}
}

// Disable override header image on team pages
if ( !function_exists( 'frank_jewelry_store_trx_addons_allow_override_header_image' ) ) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_allow_override_header_image', 'frank_jewelry_store_trx_addons_allow_override_header_image' );
	function frank_jewelry_store_trx_addons_allow_override_header_image($allow) {
		return frank_jewelry_store_is_team_page() || frank_jewelry_store_is_portfolio_page() ? false : $allow;
	}
}

// Hide sidebar on the team pages
if ( !function_exists( 'frank_jewelry_store_trx_addons_sidebar_present' ) ) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_sidebar_present', 'frank_jewelry_store_trx_addons_sidebar_present' );
	function frank_jewelry_store_trx_addons_sidebar_present($present) {
		return frank_jewelry_store_is_team_page() || frank_jewelry_store_is_portfolio_page() ? false : $present;
	}
}

// Show categories of the team, courses, etc.
if ( !function_exists( 'frank_jewelry_store_trx_addons_get_post_categories' ) ) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_get_post_categories', 		'frank_jewelry_store_trx_addons_get_post_categories');
	function frank_jewelry_store_trx_addons_get_post_categories($cats='') {

		if ( defined('TRX_ADDONS_CPT_TEAM_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_TEAM_PT) {
				$cats = frank_jewelry_store_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_TEAM_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_SERVICES_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_SERVICES_PT) {
				$cats = frank_jewelry_store_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_SERVICES_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_PORTFOLIO_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_PORTFOLIO_PT) {
				$cats = frank_jewelry_store_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_PORTFOLIO_TAXONOMY);
			}
		}
		if ( defined('TRX_ADDONS_CPT_COURSES_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_COURSES_PT) {
				$cats = frank_jewelry_store_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_COURSES_TAXONOMY);
			}
		}
		return $cats;
	}
}

// Show categories of the team, courses, etc.
if ( !function_exists( 'frank_jewelry_store_trx_addons_get_post_date' ) ) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_get_post_date', 'frank_jewelry_store_trx_addons_get_post_date');
	function frank_jewelry_store_trx_addons_get_post_date($dt='') {

		if ( defined('TRX_ADDONS_CPT_COURSES_PT') ) {
			if (get_post_type()==TRX_ADDONS_CPT_COURSES_PT) {
				$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
				$dt = $meta['date'];
				$dt = sprintf($dt < date('Y-m-d') 
						? esc_html__('Started on %s', 'frank-jewelry-store') 
						: esc_html__('Starting %s', 'frank-jewelry-store'), 
						date(get_option('date_format'), strtotime($dt)));
			}
		}
		return $dt;
	}
}

// Show categories of the team, courses, etc.
if ( !function_exists( 'frank_jewelry_store_trx_addons_list_post_types' ) ) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_list_posts_types', 'frank_jewelry_store_trx_addons_list_post_types');
	function frank_jewelry_store_trx_addons_list_post_types($list=array()) {
		if (function_exists('trx_addons_get_cpt_list')) {
			$cpt_list = trx_addons_get_cpt_list();
			foreach ($cpt_list as $cpt => $title) {
				if (   (defined('TRX_ADDONS_CPT_COURSES_PT') && $cpt == TRX_ADDONS_CPT_COURSES_PT)
					|| (defined('TRX_ADDONS_CPT_PORTFOLIO_PT') && $cpt == TRX_ADDONS_CPT_PORTFOLIO_PT)
					|| (defined('TRX_ADDONS_CPT_SERVICES_PT') && $cpt == TRX_ADDONS_CPT_SERVICES_PT)
					)
					$list[$cpt] = $title;
			}
		}
		return $list;
	}
}

// Check if meta box is allowed
if (!function_exists('frank_jewelry_store_trx_addons_allow_meta_box')) {
	//Handler of the add_filter( 'frank_jewelry_store_filter_allow_meta_box', 'frank_jewelry_store_trx_addons_allow_meta_box', 10, 2);
	function frank_jewelry_store_trx_addons_allow_meta_box($allow, $post_type) {
		return $allow
					|| (defined('TRX_ADDONS_CPT_TEAM_PT') && $post_type==TRX_ADDONS_CPT_TEAM_PT) 
					|| (defined('TRX_ADDONS_CPT_SERVICES_PT') && $post_type==TRX_ADDONS_CPT_SERVICES_PT) 
					|| (defined('TRX_ADDONS_CPT_RESUME_PT') && $post_type==TRX_ADDONS_CPT_RESUME_PT) 
					|| (defined('TRX_ADDONS_CPT_PORTFOLIO_PT') && $post_type==TRX_ADDONS_CPT_PORTFOLIO_PT) 
					|| (defined('TRX_ADDONS_CPT_COURSES_PT') && $post_type==TRX_ADDONS_CPT_COURSES_PT) ;
	}
}

// Add fields into meta box
if (!function_exists('frank_jewelry_store_trx_addons_meta_box_fields')) {
	//Handler of the add_filter( 'trx_addons_filter_meta_box_fields', 'frank_jewelry_store_trx_addons_meta_box_fields', 10, 2);
	function frank_jewelry_store_trx_addons_meta_box_fields($mb, $post_type) {
		if (defined('TRX_ADDONS_CPT_TEAM_PT') && $post_type==TRX_ADDONS_CPT_TEAM_PT) {
			$mb['email'] = array(
				"title" => esc_html__("E-mail",  'frank-jewelry-store'),
				"desc" => wp_kses_data( __("Team member's email", 'frank-jewelry-store') ),
				"std" => "",
				"details" => true,
				"type" => "text"
			);

		}
		return $mb;
	}
}



// WP Editor addons
//------------------------------------------------------------------------

// Load required styles and scripts for admin mode
if ( !function_exists( 'frank_jewelry_store_trx_addons_editor_load_scripts_admin' ) ) {
	//Handler of the add_action("admin_enqueue_scripts", 'frank_jewelry_store_trx_addons_editor_load_scripts_admin');
	function frank_jewelry_store_trx_addons_editor_load_scripts_admin() {
		// Add styles in the WP text editor
		add_editor_style( array(
							frank_jewelry_store_get_file_url('plugins/trx_addons/trx_addons.editor.css')
							)
						 );	
	}
}

if ( !function_exists( 'frank_jewelry_store_trx_addons_editor_init' ) ) {
	//Handler of the add_filter( 'tiny_mce_before_init', 'frank_jewelry_store_trx_addons_editor_init', 11);
	function frank_jewelry_store_trx_addons_editor_init($opt) {
		if (!empty($opt['style_formats'])) {
			$style_formats = json_decode($opt['style_formats'], true);
			if (is_array($style_formats) && count($style_formats)>0 ) {
				foreach ($style_formats as $k=>$v) {
					if ( $v['title'] == esc_html__('List styles', 'frank-jewelry-store') ) {
						$style_formats[$k]['items'][] = array(
									'title' => esc_html__('Arrow', 'frank-jewelry-store'),
									'selector' => 'ul',
									'classes' => 'trx_addons_list trx_addons_list_arrow'
								);
					}
				}
				$opt['style_formats'] = json_encode( $style_formats );		
			}
		}
		return $opt;
	}
}



// Thumb sizes
//------------------------------------------------------------------------

// Add thumb sizes
if ( !function_exists( 'frank_jewelry_store_trx_addons_add_thumb_sizes' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_add_thumb_sizes', 'frank_jewelry_store_trx_addons_add_thumb_sizes');
	function frank_jewelry_store_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// Get thumb size
if ( !function_exists( 'frank_jewelry_store_trx_addons_get_thumb_size' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_get_thumb_size', 'frank_jewelry_store_trx_addons_get_thumb_size');
	function frank_jewelry_store_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'frank_jewelry_store-thumb-huge',
							'frank_jewelry_store-thumb-huge-@retina',
							'frank_jewelry_store-thumb-big',
							'frank_jewelry_store-thumb-big-@retina',
							'frank_jewelry_store-thumb-med',
							'frank_jewelry_store-thumb-med-@retina',
							'frank_jewelry_store-thumb-tiny',
							'frank_jewelry_store-thumb-tiny-@retina',
							'frank_jewelry_store-thumb-masonry-big',
							'frank_jewelry_store-thumb-masonry-big-@retina',
							'frank_jewelry_store-thumb-masonry',
							'frank_jewelry_store-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}

// Get thumb size for the team items
if ( !function_exists( 'frank_jewelry_store_trx_addons_team_thumb_size' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_team_thumb_size',	'frank_jewelry_store_trx_addons_team_thumb_size', 10, 2);
	function frank_jewelry_store_trx_addons_team_thumb_size($thumb_size='', $team_type='') {
		return $team_type == 'default' ? frank_jewelry_store_get_thumb_size('med') : $thumb_size;
	}
}

// Return tag for the item's title
if ( !function_exists( 'frank_jewelry_store_trx_addons_sc_item_title_tag' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_sc_item_title_tag', 'frank_jewelry_store_trx_addons_sc_item_title_tag');
	function frank_jewelry_store_trx_addons_sc_item_title_tag($tag='') {
		return $tag=='h1' ? 'h2' : $tag;
	}
}

// Return args for the item's button
if ( !function_exists( 'frank_jewelry_store_trx_addons_sc_item_button_args' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_sc_item_button_args', 'frank_jewelry_store_trx_addons_sc_item_button_args');
	function frank_jewelry_store_trx_addons_sc_item_button_args($args, $sc='') {
		if (false && $sc != 'sc_button') {
			$args['type'] = 'simple';
			$args['icon_type'] = 'fontawesome';
			$args['icon_fontawesome'] = 'icon-down-big';
			$args['icon_position'] = 'top';
		}
		return $args;
	}
}

// Return theme specific layout of the featured image block
if ( !function_exists( 'frank_jewelry_store_trx_addons_featured_image' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_featured_image', 'frank_jewelry_store_trx_addons_featured_image', 10, 2);
	function frank_jewelry_store_trx_addons_featured_image($processed=false, $args=array()) {
		$args['show_no_image'] = true;
		$args['singular'] = false;
		$args['hover'] = frank_jewelry_store_get_theme_option('image_hover');
		frank_jewelry_store_show_post_featured($args);
		return true;
	}
}

// Return theme specific 'no-image' picture
if ( !function_exists( 'frank_jewelry_store_trx_addons_no_image' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_no_image', 'frank_jewelry_store_trx_addons_no_image');
	function frank_jewelry_store_trx_addons_no_image($no_image='') {
		return frank_jewelry_store_get_no_image_placeholder($no_image);
	}
}



// Shortcodes support
//------------------------------------------------------------------------

// Add params into shortcode's atts
if ( !function_exists( 'frank_jewelry_store_trx_addons_sc_atts' ) ) {
	//Handler of the add_filter( 'trx_addons_sc_atts', 'frank_jewelry_store_trx_addons_sc_atts', 10, 2);
	function frank_jewelry_store_trx_addons_sc_atts($atts, $sc) {
		
		// Param 'scheme'
		if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_events', 'trx_sc_form', 'trx_sc_googlemap',
								'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo', 'trx_sc_services', 'trx_sc_team', 'trx_sc_testimonials', 'trx_sc_title',
								'trx_widget_audio', 'trx_widget_twitter')))
			$atts['scheme'] = 'inherit';
		return $atts;
	}
}

// Add params into shortcodes VC map
if ( !function_exists( 'frank_jewelry_store_trx_addons_sc_map' ) ) {
	//Handler of the add_filter( 'trx_addons_sc_map', 'frank_jewelry_store_trx_addons_sc_map', 10, 2);
	function frank_jewelry_store_trx_addons_sc_map($params, $sc) {

		// Param 'scheme'
		if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_events', 'trx_sc_form', 'trx_sc_googlemap',
								'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo', 'trx_sc_services', 'trx_sc_team', 'trx_sc_testimonials', 'trx_sc_title',
								'trx_widget_audio', 'trx_widget_twitter'))) {
			$params['params'][] = array(
					"param_name" => "scheme",
					"heading" => esc_html__("Color scheme", 'frank-jewelry-store'),
					"description" => wp_kses_data( __("Select color scheme to decorate this block", 'frank-jewelry-store') ),
					"group" => esc_html__('Colors', 'frank-jewelry-store'),
					"admin_label" => true,
					"value" => array_flip(frank_jewelry_store_get_list_schemes(true)),
					"type" => "dropdown"
				);
		}
		return $params;
	}
}

// Add params into shortcode's output
if ( !function_exists( 'frank_jewelry_store_trx_addons_sc_output' ) ) {
	//Handler of the add_filter( 'trx_addons_sc_output', 'frank_jewelry_store_trx_addons_sc_output', 10, 4);
	function frank_jewelry_store_trx_addons_sc_output($output, $sc, $atts, $content) {
		
		// Param 'scheme'
		if (in_array($sc, array('trx_sc_action'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_action ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_action ', $output);
		} else if (in_array($sc, array('trx_sc_blogger'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_blogger ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_blogger ', $output);
		} else if (in_array($sc, array('trx_sc_courses'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_courses ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_courses ', $output);
		} else if (in_array($sc, array('trx_sc_content'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_content ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_content ', $output);
		} else if (in_array($sc, array('trx_sc_form'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_form ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_form ', $output);
		} else if (in_array($sc, array('trx_sc_googlemap'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_googlemap_content', 'class="scheme_'.esc_attr($atts['scheme']).' sc_googlemap_content', $output);
		} else if (in_array($sc, array('trx_sc_portfolio'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_portfolio ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_portfolio ', $output);
		} else if (in_array($sc, array('trx_sc_price'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_price ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_price ', $output);
		} else if (in_array($sc, array('trx_sc_promo'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_promo ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_promo ', $output);
		} else if (in_array($sc, array('trx_sc_services'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_services ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_services ', $output);
		} else if (in_array($sc, array('trx_sc_team'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_team ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_team ', $output);
		} else if (in_array($sc, array('trx_sc_testimonials'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_testimonials ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_testimonials ', $output);
		} else if (in_array($sc, array('trx_sc_title'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_title ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_title ', $output);
		} else if (in_array($sc, array('trx_sc_events'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_events ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_events ', $output);
		} else if (in_array($sc, array('trx_widget_audio'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('sc_widget_audio', 'scheme_'.esc_attr($atts['scheme']).' sc_widget_audio', $output);
		} else if (in_array($sc, array('trx_widget_twitter'))) {
			if (!empty($atts['scheme']) && !frank_jewelry_store_is_inherit($atts['scheme']))
				$output = str_replace('sc_widget_twitter', 'scheme_'.esc_attr($atts['scheme']).' sc_widget_twitter', $output);
		}
		return $output;
	}
}

// Add new types in the shortcodes
if ( !function_exists( 'frank_jewelry_store_trx_addons_sc_type' ) ) {
	function frank_jewelry_store_trx_addons_sc_type($list, $sc) {
		return $list;
	}
}

// Add new types in the shortcodes
if ( !function_exists( 'frank_jewelry_store_trx_addons_sc_googlemap_styles' ) ) {
	function frank_jewelry_store_trx_addons_sc_googlemap_styles($list) {
		$list[esc_html__('Dark', 'frank-jewelry-store')] = 'dark';
		$list[esc_html__('NEW', 'frank-jewelry-store')] = 'new';
		return $list;
	}
}

// Return theme-specific icons
if ( !function_exists( 'frank_jewelry_store_trx_addons_get_list_icons' ) ) {
	function frank_jewelry_store_trx_addons_get_list_icons($list, $prepend_inherit) {
		return frank_jewelry_store_get_list_icons($prepend_inherit);
	}
}

// Return theme specific title layout for the slider
if ( !function_exists( 'frank_jewelry_store_trx_addons_slider_title' ) ) {
	function frank_jewelry_store_trx_addons_slider_title($title, $data) {
		$title = '';
		if (!empty($data['title'])) 
			$title .= '<h3 class="slide_title">'
						. (!empty($data['link']) ? '<a href="'.esc_url($data['link']).'">' : '')
						. esc_html($data['title'])
						. (!empty($data['link']) ? '</a>' : '')
						. '</h3>';
		if (!empty($data['cats']))
			$title .= sprintf('<div class="slide_cats">%s</div>', $data['cats']);
		return $title;
	}
}



// Plugin API - theme-specific wrappers for plugin functions
//------------------------------------------------------------------------

// Debug functions wrappers
if (!function_exists('ddo')) { function ddo($obj, $level=-1) { return var_dump($obj); } }
if (!function_exists('dco')) { function dco($obj, $level=-1) { print_r($obj); } }
if (!function_exists('dcl')) { function dcl($msg, $level=-1) { echo '<br><pre>$msg</pre><br>'; } }
if (!function_exists('dfo')) { function dfo($obj, $level=-1) {} }
if (!function_exists('dfl')) { function dfl($msg, $level=-1) {} }

// Return image size multiplier
if (!function_exists('frank_jewelry_store_get_retina_multiplier')) {
	function frank_jewelry_store_get_retina_multiplier($force_retina=0) {
		static $mult = 0;
		if ($mult == 0) $mult = function_exists('trx_addons_get_retina_multiplier') ? trx_addons_get_retina_multiplier($force_retina) : 1;
		return max(1, $mult);
	}
}

// Return slider layout
if (!function_exists('frank_jewelry_store_build_slider_layout')) {
	function frank_jewelry_store_build_slider_layout($args) {
		return function_exists('trx_addons_build_slider_layout') 
					? trx_addons_build_slider_layout($args) 
					: '';
	}
}

// Return links to the social profiles
if (!function_exists('frank_jewelry_store_get_socials_links')) {
	function frank_jewelry_store_get_socials_links($style='icons') {
		return function_exists('trx_addons_get_socials_links') 
					? trx_addons_get_socials_links($style)
					: '';
	}
}

// Return links to share post
if (!function_exists('frank_jewelry_store_get_share_links')) {
	function frank_jewelry_store_get_share_links($args=array()) {
		return function_exists('trx_addons_get_share_links') 
					? trx_addons_get_share_links($args)
					: '';
	}
}

// Display links to share post
if (!function_exists('frank_jewelry_store_show_share_links')) {
	function frank_jewelry_store_show_share_links($args=array()) {
		if (function_exists('trx_addons_get_share_links')) {
			$args['echo'] = true;
			trx_addons_get_share_links($args);
		}
	}
}


// Return image from the category
if (!function_exists('frank_jewelry_store_get_category_image')) {
	function frank_jewelry_store_get_category_image($term_id=0) {
		return function_exists('trx_addons_get_category_image') 
					? trx_addons_get_category_image($term_id)
					: '';
	}
}

// Return small image (icon) from the category
if (!function_exists('frank_jewelry_store_get_category_icon')) {
	function frank_jewelry_store_get_category_icon($term_id=0) {
		return function_exists('trx_addons_get_category_icon') 
					? trx_addons_get_category_icon($term_id)
					: '';
	}
}

// Return string with counters items
if (!function_exists('frank_jewelry_store_get_post_counters')) {
	function frank_jewelry_store_get_post_counters($counters='views') {
		return function_exists('trx_addons_get_post_counters')
					? str_replace('post_counters_item', 'post_meta_item post_counters_item', trx_addons_get_post_counters($counters))
					: '';
	}
}

// Return string with the likes counter for the specified comment
if (!function_exists('frank_jewelry_store_get_comment_counters')) {
	function frank_jewelry_store_get_comment_counters($counters = 'likes') {
		return function_exists('trx_addons_get_comment_counters') 
					? trx_addons_get_comment_counters($counters)
					: '';
	}
}

// Display likes counter for the specified comment
if (!function_exists('frank_jewelry_store_show_comment_counters')) {
	function frank_jewelry_store_show_comment_counters($counters = 'likes') {
		if (function_exists('trx_addons_get_comment_counters'))
			trx_addons_get_comment_counters($counters, true);
	}
}

// Add query params to sort posts by views or likes
if (!function_exists('frank_jewelry_store_trx_addons_query_sort_order')) {
	function frank_jewelry_store_trx_addons_query_sort_order($q=array(), $orderby='date', $order='desc') {
		if ($orderby == 'views') {
			$q['orderby'] = 'meta_value_num';
			$q['meta_key'] = 'trx_addons_post_views_count';
		} else if ($orderby == 'likes') {
			$q['orderby'] = 'meta_value_num';
			$q['meta_key'] = 'trx_addons_post_likes_count';
		}
		return $q;
	}
}

// Show contact form from plugin
if (!function_exists('frank_jewelry_store_show_contact_form')) {
	function frank_jewelry_store_show_contact_form($args=array()) {
		if (function_exists('trx_addons_show_contact_form')) 
			trx_addons_show_contact_form($args);
	}
}


// Add plugin-specific rules into custom CSS
//------------------------------------------------------------------------

// Add css styles into global CSS stylesheet
if (!function_exists('frank_jewelry_store_trx_addons_get_css')) {
	function frank_jewelry_store_trx_addons_get_css($css, $colors, $fonts) {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

.sc_skills_pie.sc_skills_compact_off .sc_skills_item_title,
.sc_services_iconed .sc_services_item_title,
ul.trx_addons_list_parameters > li em {
	{$fonts['p_font-family']}
}
.toc_menu_item .toc_menu_description,
.sc_recent_news .post_item .post_footer .post_counters .post_counters_item,
.sc_item_subtitle.sc_item_title_style_shadow,
.sc_item_button a,
.sc_form button,
.sc_button_simple,
.sc_action_item_link,
.sc_icons_title,
.sc_price_title, .sc_price_price, .sc_price_link,
.sc_courses_default .sc_courses_item_price,
.sc_courses_default .trx_addons_hover_content .trx_addons_hover_links a,
.sc_promo_modern .sc_promo_link2 span+span,
.sc_skills_counter .sc_skills_total,
.sc_skills_pie.sc_skills_compact_off .sc_skills_total,
.slider_swiper .slide_info.slide_info_large .slide_title,
.slider_style_modern .slider_controls_label span + span,
.slider_pagination_wrap,
.sc_slider_controller_info {
	{$fonts['h5_font-family']}
}
.sc_blogger_plain .time .first,
.sc_action_item .sc_action_item_subtitle,
.sc_action_item .sc_action_item_title,
.sc_title > .sc_item_descr,
.sc_promo_title > i,
.sc_promo .sc_promo_descr,
.sc_testimonials_item_content,
.sc_testimonials_item_author_title,
.sc_skills_counter .sc_skills_item_title,
.sc_price,
.sc_price_description,
.sc_price_details,
.trx_addons_audio_player .audio_author {
	{$fonts['h1_font-family']}
}


.sc_item_subtitle,
.sc_item_button .sc_button_simple,
.sc_recent_news .post_item .post_meta,
.sc_action_item_description,
.sc_courses_default .sc_courses_item_date,
.sc_promo_modern .sc_promo_link2 span,
.slider_style_modern .slider_controls_label span,
.slider_titles_outside_wrap .slide_cats,
.slider_titles_outside_wrap .slide_subtitle,
.sc_team .sc_team_item_subtitle,
.sc_services .sc_services_item_subtitle,
.team_member_page .team_member_brief_info_text,
.sc_testimonials_item_content:before {
	{$fonts['info_font-family']}
}

CSS;
		}
		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.trx_addons_cv_resume_style_services .trx_addons_cv_resume_item_icon:hover,
.trx_addons_cv_resume_style_services .trx_addons_cv_resume_item_text a:hover {
	color: {$colors['text_hover']};
}
.trx_addons_cv_resume_style_services .trx_addons_cv_resume_item_title > a:hover:after {
	border-color: {$colors['text_hover']};
}

/* User styles */
.trx_addons_accent,
.trx_addons_accent > * {
	color: {$colors['text_link']};
}
.trx_addons_accent_bg {
	background-color: {$colors['text_link']};
	color: {$colors['inverse_text']};
}
.trx_addons_inverse {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
.trx_addons_dark,
.trx_addons_dark > a {
	color: {$colors['text_dark']};
}
.trx_addons_dark > a:hover {
	color: {$colors['text_link']};
}

.trx_addons_inverse,
.trx_addons_inverse > a {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
.trx_addons_inverse > a:hover {
	color: {$colors['inverse_hover']};
}

.trx_addons_dropcap_style_1 {
	color: {$colors['text_hover']};
}
.trx_addons_dropcap_style_2 {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_hover']};
}

.trx_addons_tooltip {
	color: {$colors['text']};
}
.trx_addons_tooltip:before {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_hover']};
}
.trx_addons_tooltip:after {
	border-top-color: {$colors['text_hover']};
}

ul.trx_addons_list_circle > li:before {
	color: {$colors['text_hover']};
}
ul.trx_addons_list_dot > li:before {
	background-color: {$colors['text_link']};
}
ul.trx_addons_list_arrow > li:before,
ul.trx_addons_list_asterisk > li:before {
	color: {$colors['text_link']};
}

blockquote.trx_addons_blockquote_style_1:before,
blockquote.trx_addons_blockquote_style_1 {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
blockquote.trx_addons_blockquote_style_1 a,
blockquote.trx_addons_blockquote_style_1 cite {
	color: {$colors['text_link']};
}
blockquote.trx_addons_blockquote_style_1 a:hover {
	color: {$colors['bg_color']};
}
blockquote.trx_addons_blockquote_style_2 {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
blockquote.trx_addons_blockquote_style_2:before,
blockquote.trx_addons_blockquote_style_2 a,
blockquote.trx_addons_blockquote_style_2 cite {
	color: {$colors['inverse_link']};
}
blockquote.trx_addons_blockquote_style_2 a:hover {
	color: {$colors['inverse_hover']};
}

.trx_addons_hover_mask {
	background-color: {$colors['text_link_07']};
}
.trx_addons_hover_title {
	color: {$colors['inverse_text']};
}
.trx_addons_hover_text {
	color: {$colors['text_light']};
}
.trx_addons_hover_icon,
.trx_addons_hover_links a {
	color: {$colors['inverse_text']};
	background-color: {$colors['alter_link']};
}
.trx_addons_hover_icon:hover,
.trx_addons_hover_links a:hover {
	color: {$colors['alter_link']} !important;
	background-color: {$colors['alter_bg_color']};
}

/* Tabs */
.widget .trx_addons_tabs .trx_addons_tabs_titles li a {
	color: {$colors['bg_color']};
	background-color: {$colors['alter_bd_color']};
}
.widget .trx_addons_tabs .trx_addons_tabs_titles li.ui-state-active a,
.widget .trx_addons_tabs .trx_addons_tabs_titles li a:hover {
	color: {$colors['inverse_text']};
	background-color: {$colors['alter_link']};
}


/* Posts slider */
.slider_swiper .slide_info.slide_info_large {
	background-color: {$colors['bg_color_07']};
}
.slider_swiper .slide_info.slide_info_large:hover {
	background-color: {$colors['bg_color']};
}
.slider_swiper .slide_info.slide_info_large .slide_cats a {
	color: {$colors['text_link']};
}
.slider_swiper .slide_info.slide_info_large .slide_title a {
	color: {$colors['text_dark']};
}
.slider_swiper .slide_info.slide_info_large .slide_date {
	color: {$colors['text']};
}
.slider_swiper .slide_info.slide_info_large:hover .slide_date {
	color: {$colors['text_light']};
}
.slider_swiper .slide_info.slide_info_large .slide_cats a:hover,
.slider_swiper .slide_info.slide_info_large .slide_title a:hover {
	color: {$colors['text_hover']};
}
.slider_swiper.slider_multi .slide_cats a:hover,
.slider_swiper.slider_multi .slide_title a:hover,
.slider_swiper.slider_multi a:hover .slide_title {
	color: {$colors['text_hover']};
}

.slider_swiper.slider_controls_side .slider_controls_wrap > a,
.slider_outer_controls_side .slider_controls_wrap > a {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
}
.slider_swiper.slider_controls_side .slider_controls_wrap > a:hover,
.slider_outer_controls_side .slider_controls_wrap > a:hover {
	color: {$colors['text_hover']};
	background-color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}


.slider_outer_controls_side.slider_style_default .slider_controls_wrap > a {
	color: {$colors['inverse_text']};
}
.slider_outer_controls_side.slider_style_default .slider_controls_wrap > a:hover {
	color: {$colors['text_hover']};
}


.slider_swiper.slider_controls_bottom .slider_controls_wrap > a,
.slider_outer_controls_bottom .slider_controls_wrap > a {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
}
.slider_swiper.slider_controls_bottom .slider_controls_wrap > a:hover,
.slider_outer_controls_bottom .slider_controls_wrap > a:hover {
	color: {$colors['bg_color']};
	border-color: {$colors['text_link']};
	background-color: {$colors['text_link']};
}

.slider_swiper .slider_pagination_wrap .swiper-pagination-bullet.swiper-pagination-bullet-active,
.slider_swiper_outer .slider_pagination_wrap .swiper-pagination-bullet.swiper-pagination-bullet-active,
.slider_swiper .slider_pagination_wrap .swiper-pagination-bullet:hover,
.slider_swiper_outer .slider_pagination_wrap .swiper-pagination-bullet:hover {
	border-color: {$colors['text_link']};
	background-color: {$colors['text_link']};
}

.slider_titles_outside_wrap .slide_title a {
	color: {$colors['text_dark']};
}
.slider_titles_outside_wrap .slide_title a:hover {
	color: {$colors['text_link']};
}
.slider_titles_outside_wrap .slide_cats,
.slider_titles_outside_wrap .slide_subtitle {
	color: {$colors['text_link']};
}

.slider_style_modern .slider_controls_label {
	color: {$colors['bg_color']};
}
.slider_style_modern .slider_pagination_wrap {
	color: {$colors['text_light']};
}
.slider_style_modern .swiper-pagination-current {
	color: {$colors['text_dark']};
}

.sc_slider_controller .swiper-slide.swiper-slide-active {
	border-color: {$colors['text_link']};
}
.sc_slider_controller_titles .swiper-slide {
	background-color: {$colors['alter_bg_color']};
}
.sc_slider_controller_titles .swiper-slide:after {
	background-color: {$colors['alter_bd_color']};
}
.sc_slider_controller_titles .swiper-slide.swiper-slide-active {
	background-color: {$colors['bg_color']};
}
.sc_slider_controller_titles .sc_slider_controller_info_title {
	color: {$colors['alter_dark']};
}
.sc_slider_controller_titles .sc_slider_controller_info_number {
	color: {$colors['alter_light']};
}
.sc_slider_controller_titles .slider_controls_wrap > a {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.sc_slider_controller_titles .slider_controls_wrap > a:hover {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}


/* Widgets 
--------------------------------------------------- */

/* Audio */
.trx_addons_audio_player.without_cover {
	background-color: {$colors['text_dark']};
}
.trx_addons_audio_player .audio_caption {
	color: {$colors['inverse_text']};
}
.trx_addons_audio_player .audio_author {
	color: {$colors['alter_link']};
}
.trx_addons_audio_player .mejs-container .mejs-controls .mejs-time {
	color: {$colors['text']};
}


/* Categories list */
.widget_categories_list .categories_list_style_2 .categories_list_title a:hover {
	color: {$colors['text_dark']};
}

/* Contacts */
.widget_contacts .contacts_info {
	color: {$colors['text']};
}
.widget_contacts .contacts_info span:before {
	color: {$colors['text_link']};
}
.widget_contacts .contacts_info span a,
.widget_contacts .socials_wrap.contacts_socials a {
	color: {$colors['text_dark']};
}
.widget_contacts .contacts_info span a:hover,
.widget_contacts .socials_wrap.contacts_socials a:hover {
	color: {$colors['text_link']};
}

/* Socials */
.widget_socials .social_item a {
	color: {$colors['alter_light']};
}
.widget_socials .social_item a:hover {
	color: {$colors['text_link']};
}


.slider_engine_revo .widget_socials .social_item a {
	color: {$colors['text_dark']};
}
.slider_engine_revo .widget_socials .social_item a:hover {
	color: {$colors['text_link']};
}

/* Recent News */
.sc_recent_news_header {
	border-color: {$colors['text_dark']};
}
.sc_recent_news_header_category_item_more {
	color: {$colors['text_link']};
}
.sc_recent_news_header_more_categories {
	border-color: {$colors['alter_bd_color']};
	background-color:{$colors['alter_bg_color']};
}
.sc_recent_news_header_more_categories > a {
	color:{$colors['alter_link']};
}
.sc_recent_news_header_more_categories > a:hover {
	color:{$colors['alter_hover']};
	background-color:{$colors['alter_bg_hover']};
}
.sc_recent_news .post_counters_item,
.sc_recent_news .post_counters .post_counters_edit a {
	color:{$colors['inverse_text']};
	background-color:{$colors['text_link']};
}
.sc_recent_news .post_counters_item:hover,
.sc_recent_news .post_counters .post_counters_edit a:hover {
	color:{$colors['bg_color']};
	background-color:{$colors['text_dark']};
}
.sidebar_inner .sc_recent_news .post_counters_item:hover,
.sidebar_inner .sc_recent_news .post_counters .post_counters_edit a:hover {
	color:{$colors['alter_dark']};
	background-color:{$colors['alter_bg_color']};
}
.sc_recent_news_style_news-magazine .post_accented_border {
	border-color: {$colors['bd_color']};
}
.sc_recent_news_style_news-excerpt .post_item {
	border-color: {$colors['bd_color']};
}

/* Twitter */
.widget_twitter .widget_content .sc_twitter_item,
.widget_twitter .widget_content li {
	color: {$colors['text']};
}
.widget_twitter .widget_content .sc_twitter_item .sc_twitter_item_icon {
	color: {$colors['text_link']} !important;
}
.widget_twitter .swiper-pagination-bullet {
	background-color: {$colors['text_light']};
}
.widget_twitter .swiper-pagination-bullet-active {
	background-color: {$colors['text_link']};
}

/* Video */
.trx_addons_video_player.with_cover .video_hover {
	color: {$colors['inverse_text']};
	border-color: {$colors['inverse_text']};
}
.trx_addons_video_player.with_cover .video_hover:hover {
	color: {$colors['text_hover']};
	border-color: {$colors['text_hover']};
}
.sidebar_inner .trx_addons_video_player.with_cover .video_hover {
	color: {$colors['inverse_text']};
	border-color: {$colors['inverse_text']};
}
.sidebar_inner .trx_addons_video_player.with_cover .video_hover:hover {
	color: {$colors['text_hover']};
	border-color: {$colors['text_hover']};
}



/* Shortcodes
--------------------------------------------------- */
.sc_item_descr,
.sc_item_subtitle {
	color:{$colors['text_link']};
}
.sc_item_subtitle.sc_item_title_style_shadow {
	color:{$colors['text_light']};
}
.sc_button.sc_button_default {
	border-color: {$colors['text_hover']};
	background-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}
.sc_button.sc_button_default:hover {
	border-color: {$colors['text_link']};
	background-color: {$colors['inverse_link']};
	color: {$colors['text_link']};
}


.sc_button.sc_button_border {
	border-color: {$colors['text_link']};
	color: {$colors['text_link']};
}
.sc_button.sc_button_border:hover {
	border-color: {$colors['text_link']};
	background-color: {$colors['text_link']};
	color: {$colors['inverse_link']};
}
.sc_button.sc_button_border2 {
	border-color: {$colors['text_hover']};
	color: {$colors['text_hover']};
}
.sc_button.sc_button_border2:hover {
	border-color: {$colors['text_link']};
	background-color: {$colors['text_link']};
	color: {$colors['inverse_link']};
}


.sc_button .sc_button_iconed:after {
	color: {$colors['inverse_link']};
}
.sc_button:hover .sc_button_iconed:after {
	color: {$colors['text_link']};
}
.sc_button .sc_button_iconed:before {
	color: {$colors['text_link']};
}
.sc_button:hover .sc_button_iconed:before {
	color: {$colors['text_hover']};
}

.sc_button.sc_button_border .sc_button_iconed:after {
	color: {$colors['text_link']};
}
.sc_button.sc_button_border:hover .sc_button_iconed:after {
	color: {$colors['inverse_link']};
}
.sc_button.sc_button_border .sc_button_iconed:before {
	color: {$colors['text_hover']};
}
.sc_button.sc_button_border:hover .sc_button_iconed:before {
	color: {$colors['text_hover']};
}

.sc_button.sc_button_border2 .sc_button_iconed:after {
	color: {$colors['text_link']};
}
.sc_button.sc_button_border2:hover .sc_button_iconed:after {
	color: {$colors['inverse_link']};
}
.sc_button.sc_button_border2 .sc_button_iconed:before {
	color: {$colors['text_hover']};
}
.sc_button.sc_button_border2:hover .sc_button_iconed:before {
	color: {$colors['text_hover']};
}

.sc_button.sc_button_border3 {
	border-color: {$colors['text_link']};
	background-color: {$colors['text_link']};
	color: {$colors['inverse_link']};
}
.sc_button.sc_button_border3:hover {
	border-color: {$colors['text_link']};
	background-color: {$colors['inverse_link']};
	color: {$colors['text_link']};
}
.sc_button.sc_button_border3 .sc_button_iconed:after {
	color: {$colors['inverse_link']};
}
.sc_button.sc_button_border3:hover .sc_button_iconed:after {
	color: {$colors['text_link']};
}
.sc_button.sc_button_border3 .sc_button_iconed:before {
	color: {$colors['text_hover']};
}
.sc_button.sc_button_border3:hover .sc_button_iconed:before {
	color: {$colors['text_hover']};
}




.trx_addons_hover_content .trx_addons_hover_links a {
	color:{$colors['inverse_text']};
	background-color:{$colors['text_link']};
}
.trx_addons_hover_content .trx_addons_hover_links a:hover {
	color:{$colors['text_link']} !important;
	background-color:{$colors['inverse_text']};
}

/* Action */
.sc_action_item_simple.with_image .sc_action_item_icon,
.sc_action_item_simple.with_image .sc_action_item_title,
.sc_action_item .sc_action_item_subtitle {
	color:{$colors['text_link']};
}
.sc_action_item_date,
.sc_action_item_info {
	color:{$colors['text_dark']};
	border-color:{$colors['text']};
}
.sc_action_item_description {
	color:{$colors['text']};
}
.sc_action_item .sc_action_item_link {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.sc_action_item .sc_action_item_link:hover {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
.sc_action_item_event.with_image .sc_action_item_inner {
	background-color:{$colors['bg_color']};
}

/* Anchor */
.toc_menu_item .toc_menu_icon {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_link']};
}
.toc_menu_item:hover .toc_menu_icon,
.toc_menu_item_active .toc_menu_icon {
	background-color: {$colors['text_link']};
	color: {$colors['inverse_text']};
}
.toc_menu_icon_default:before {
	background-color: {$colors['text_link']};
}
.toc_menu_item:hover .toc_menu_icon_default:before,
.toc_menu_item_active .toc_menu_icon_default:before {
	background-color: {$colors['text_dark']};
}
.toc_menu_item .toc_menu_description {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}

/* Blogger */
.sc_blogger.slider_swiper .swiper-pagination-bullet {
	border-color: {$colors['text_light']};
}

.sc_blogger_item {
	background-color: {$colors['alter_bg_color']};
}
.sc_blogger_post_meta {
	color: {$colors['alter_light']};
}
.sc_blogger_item_title a {
	color: {$colors['text_link']};
}
.sc_blogger_item_title a:hover {
	color: {$colors['text_hover']};
}
.sc_blogger_post_meta {
	color: {$colors['alter_light']};
}
.sc_blogger_item_content {
	color: {$colors['alter_text']};
}
.sc_blogger_item .more-link {
	color: {$colors['alter_link']};
}
.sc_blogger_item .more-link:hover {
	color: {$colors['alter_dark']};
}
.sc_blogger_item_button .sc_button {
	color: {$colors['text_hover']};
}
.sc_blogger_item_button .sc_button:hover {
	color: {$colors['text_link']};
}
.sc_blogger_item_content .time .second,
.sc_blogger_item_content .time .first {
	color: {$colors['text_link']};
}


/* Countdown */
.sc_countdown_default .sc_countdown_digits span {
	color: {$colors['inverse_text']};
	border-color: {$colors['text_hover']};
	background-color: {$colors['text_link']};
}
.sc_countdown_circle .sc_countdown_digits {
	color: {$colors['alter_link']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color']};
}

/* Courses */
.sc_courses.slider_swiper .swiper-pagination-bullet {
	border-color: {$colors['text_light']};
}

.sc_courses_default .sc_courses_item {
	background-color: {$colors['alter_bg_color']};
}
.sc_courses_default .sc_courses_item_categories {
	background-color: {$colors['alter_dark']};
}
.sc_courses_default .sc_courses_item_categories a {
	color: {$colors['bg_color']};
}
.sc_courses_default .sc_courses_item_categories a:hover {
	color: {$colors['alter_link']};
}
.sc_courses_default .sc_courses_item_meta {
	color: {$colors['alter_light']};
}
.sc_courses_default .sc_courses_item_date {
	color: {$colors['alter_dark']};
}
.sc_courses_default .sc_courses_item_price {
	color: {$colors['alter_link']};
}
.sc_courses_default .sc_courses_item_period {
	color: {$colors['alter_light']};
}


/* Events */
.sc_events.slider_swiper .swiper-pagination-bullet {
	border-color: {$colors['text_light']};
}

.sc_events_default .sc_events_item {
	background-color: {$colors['alter_bg_color']};
}
.sc_events_default .sc_events_item_date {
	background-color: {$colors['alter_link']};
	color: {$colors['inverse_text']};
}
.sc_events_default .sc_events_item:hover .sc_events_item_date {
	background-color: {$colors['alter_dark']};
}
.sc_events_default .sc_events_item_title {
	color: {$colors['alter_dark']};
}
.sc_events_default .sc_events_item:hover .sc_events_item_title {
	color: {$colors['alter_link']};
}
.sc_events_default .sc_events_item_button {
	color: {$colors['alter_link']};
}
.sc_events_default .sc_events_item:hover .sc_events_item_button {
	color: {$colors['alter_dark']};
}

.sc_events_detailed .sc_events_item,
.sc_events_detailed .sc_events_item_time_wrap:before,
.sc_events_detailed .sc_events_item_button_wrap:before {
	border-color: {$colors['text_link']};
}
.sc_events_detailed .sc_events_item_date,
.sc_events_detailed .sc_events_item_button {
	color: {$colors['text_link']};
}
.sc_events_detailed .sc_events_item_title {
	color: {$colors['text_dark']};
}
.sc_events_detailed .sc_events_item_time {
	color: {$colors['text']};
}
.sc_events_detailed .sc_events_item:hover {
	background-color: {$colors['text_link']};
	color: {$colors['inverse_text']};
}
.sc_events_detailed .sc_events_item:hover,
.sc_events_detailed .sc_events_item:hover .sc_events_item_date,
.sc_events_detailed .sc_events_item:hover .sc_events_item_button,
.sc_events_detailed .sc_events_item:hover .sc_events_item_title,
.sc_events_detailed .sc_events_item:hover .sc_events_item_time {
	color: {$colors['inverse_text']};
}
.sc_events_detailed .sc_events_item:hover,
.sc_events_detailed .sc_events_item:hover .sc_events_item_date_wrap,
.sc_events_detailed .sc_events_item:hover .sc_events_item_time_wrap:before,
.sc_events_detailed .sc_events_item:hover .sc_events_item_button_wrap:before {
	border-color: {$colors['inverse_text']};
}

/* Form */
.scheme_self.sc_form {
	background-color: {$colors['bg_color']};
}
.sc_form_field_title {
	color: {$colors['text_dark']};
}
select,
.sc_form .sc_form_field input[type="text"],
.sc_form .sc_form_field input[type="password"],
.sc_form .sc_form_field input[type="email"],
.sc_form .sc_form_field input[type="number"],
.sc_form .sc_form_field input[type="tel"],
.sc_form .sc_form_field input[type="search"],
.sc_form .sc_form_field textarea {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}
.sc_form .sc_form_field input[type="text"]:focus,
.sc_form .sc_form_field input[type="password"]:focus,
.sc_form .sc_form_field input[type="email"]:focus,
.sc_form .sc_form_field input[type="number"]:focus,
.sc_form .sc_form_field input[type="tel"]:focus,
.sc_form .sc_form_field input[type="search"]:focus,
.sc_form .sc_form_field textarea:focus {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
	background-color: {$colors['input_bg_hover']};
}

.sc_form .sc_form_info_icon {
	color: {$colors['text_link']};
}
.sc_form .sc_form_info_data > a,
.sc_form .sc_form_info_data > span {
	color: {$colors['text_dark']};
}
.sc_form .sc_form_info_data > a:hover {
	color: {$colors['text_link']};
}


/* input hovers */
[class*="sc_input_hover_"] .sc_form_field_content {
	color: {$colors['text_dark']};
}
.sc_input_hover_accent input[type="text"]:focus,
.sc_input_hover_accent input[type="number"]:focus,
.sc_input_hover_accent input[type="email"]:focus,
.sc_input_hover_accent input[type="password"]:focus,
.sc_input_hover_accent input[type="search"]:focus,
.sc_input_hover_accent select:focus,
.sc_input_hover_accent textarea:focus {
	/*box-shadow: 0px 0px 0px 2px {$colors['text_link']};*/
	border-color: {$colors['text_link']} !important;
}
.sc_input_hover_accent .sc_form_field_hover:before {
	color: {$colors['text_link_02']};
}

.sc_input_hover_path .sc_form_field_graphic {
	stroke: {$colors['input_bd_color']};
}

.sc_input_hover_jump .sc_form_field_content {
	color: {$colors['input_dark']};
}
.sc_input_hover_jump .sc_form_field_content:before {
	color: {$colors['text_link']};
}
.sc_input_hover_jump input[type="text"],
.sc_input_hover_jump input[type="number"],
.sc_input_hover_jump input[type="email"],
.sc_input_hover_jump input[type="password"],
.sc_input_hover_jump input[type="search"],
.sc_input_hover_jump textarea {
	border-color: {$colors['input_bd_color']};
}
.sc_input_hover_jump input[type="text"]:focus,
.sc_input_hover_jump input[type="number"]:focus,
.sc_input_hover_jump input[type="email"]:focus,
.sc_input_hover_jump input[type="password"]:focus,
.sc_input_hover_jump input[type="search"]:focus,
.sc_input_hover_jump textarea:focus {
	border-color: {$colors['text_link']} !important;
}

.sc_input_hover_underline .sc_form_field_hover:before {
	background-color: {$colors['input_bd_color']};
}
.sc_input_hover_underline input:focus + .sc_form_field_hover:before,
.sc_input_hover_underline textarea:focus + .sc_form_field_hover:before,
.sc_input_hover_underline input.filled + .sc_form_field_hover:before,
.sc_input_hover_underline textarea.filled + .sc_form_field_hover:before {
	background-color: {$colors['text_link']};
}
.sc_input_hover_underline .sc_form_field_content {
	color: {$colors['input_dark']};
}
.sc_input_hover_underline input:focus,
.sc_input_hover_underline textarea:focus,
.sc_input_hover_underline input.filled,
.sc_input_hover_underline textarea.filled,
.sc_input_hover_underline input:focus + .sc_form_field_hover > .sc_form_field_content,
.sc_input_hover_underline textarea:focus + .sc_form_field_hover > .sc_form_field_content,
.sc_input_hover_underline input.filled + .sc_form_field_hover > .sc_form_field_content,
.sc_input_hover_underline textarea.filled + .sc_form_field_hover > .sc_form_field_content {
	color: {$colors['text_link']} !important;
}

.sc_input_hover_iconed .sc_form_field_hover {
	color: {$colors['input_text']};
}
.sc_input_hover_iconed input:focus + .sc_form_field_hover,
.sc_input_hover_iconed textarea:focus + .sc_form_field_hover,
.sc_input_hover_iconed input.filled + .sc_form_field_hover,
.sc_input_hover_iconed textarea.filled + .sc_form_field_hover {
	color: {$colors['input_dark']};
}

/* Googlemap */
.sc_googlemap_content,
.scheme_self.sc_googlemap_content {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}
.sc_googlemap_content b,
.sc_googlemap_content strong,
.scheme_self.sc_googlemap_content b,
.scheme_self.sc_googlemap_content strong {
	color: {$colors['text_dark']};
}
.sc_googlemap_content_detailed:before {
	background-color: {$colors['text_link']};
}

/* Icons */
.sc_icons .sc_icons_icon {
	color: {$colors['text_link']};
}
.sc_icons .sc_icons_item_linked:hover .sc_icons_icon {
	color: {$colors['text_dark']};
}
.sc_icons .sc_icons_title {
	color: {$colors['text_link']};
}
.sc_icons_description,
.sc_icons_modern .sc_icons_description {
	color: {$colors['text_dark']};
}

/* Price */
.scheme_self.sc_price {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.scheme_self.sc_price .sc_price_icon {
	color: {$colors['text_link']};
}
.scheme_self.sc_price .sc_price_icon:hover {
	color: {$colors['text_hover']};
}
.sc_price_info .sc_price_subtitle {
	color: {$colors['text_dark']};
}
.sc_price_info .sc_price_title {
	color: {$colors['text_link']};
}
.sc_price_info .sc_price_price {
	color: {$colors['text_dark']};
}
.sc_price_info .sc_price_description,
.sc_price_info .sc_price_details {
	color: {$colors['text_dark']};
}
.sc_price_default .sc_price_link .sc_button_iconed:after {
	color: {$colors['text_link']};
}
.sc_price_default .sc_price_link .sc_button_iconed:before {
	color: {$colors['text_hover']};
}
.sc_price_default .sc_price_link:hover .sc_button_iconed:after {
	color: {$colors['inverse_text']};
}
.sc_price_default .sc_price_link {
	border-color: {$colors['text_link']};
}
.sc_price_default .sc_price_link:hover {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}



.sc_price.sc_price_extra {
	background-color: {$colors['text_dark']};
}
.sc_price_extra .sc_price_info .sc_price_subtitle {
	color: {$colors['inverse_text']};
}
.sc_price_extra .sc_price_info .sc_price_title a,
.sc_price_extra .sc_price_info .sc_price_title {
	color: {$colors['inverse_text']};
}
.sc_price_extra .sc_price_info .sc_price_title a:hover {
	color: {$colors['text_hover']};
}
.sc_price_extra .sc_price_info .sc_price_price {
	color: {$colors['inverse_text']};
}
.sc_price_extra .sc_price_info .sc_price_description,
.sc_price_extra .sc_price_info .sc_price_details {
	color: {$colors['inverse_text']};
}
.sc_price_extra .sc_price_info .sc_price_link {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.sc_price_extra .sc_price_info .sc_price_link:hover {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}




/* Promo */
/*
.sc_promo_button .sc_button {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.sc_promo_button .sc_button:hover {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
*/
.scheme_self.sc_promo .sc_promo_title {
	color:{$colors['text_dark']};
}
.scheme_self.sc_promo .sc_promo_descr {
	color:{$colors['text_dark']};
}

.sc_promo_modern .sc_promo_link2 {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']} !important;
}
.sc_promo_modern .sc_promo_link2:hover {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
.scheme_self.sc_promo.sc_promo_size_normal .sc_promo_title {
	color:{$colors['text_dark']};
}
.scheme_self.sc_promo.sc_promo_size_normal .sc_promo_descr {
	color:{$colors['text_dark']};
}

/* Services */
.sc_services_default .sc_services_item {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.sc_services_default .sc_services_item_icon {
	color: {$colors['alter_link']};
	border-color: {$colors['alter_link']};
}
.sc_services_default .sc_services_item:hover .sc_services_item_icon {
	color: {$colors['inverse_dark']};
	background-color: {$colors['alter_link']};
	border-color: {$colors['alter_link']};
}
.sc_services_default .sc_services_item_subtitle {
	color: {$colors['alter_link']};
}

.sc_services_default .sc_services_item_featured_left,
.sc_services_default .sc_services_item_featured_right,
.sc_services_list .sc_services_item {
	color: {$colors['text']};
	background-color: transparent;
}
.sc_services_default .sc_services_item_featured_left .sc_services_item_icon,
.sc_services_default .sc_services_item_featured_right .sc_services_item_icon,
.sc_services_list .sc_services_item_featured_left .sc_services_item_icon,
.sc_services_list .sc_services_item_featured_right .sc_services_item_icon {
	color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}
.sc_services_default .sc_services_item_featured_left:hover .sc_services_item_icon,
.sc_services_default .sc_services_item_featured_right:hover .sc_services_item_icon,
.sc_services_list .sc_services_item_featured_left:hover .sc_services_item_icon,
.sc_services_list .sc_services_item_featured_right:hover .sc_services_item_icon {
	color: {$colors['inverse_dark']};
	background-color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}
.sc_services_default .sc_services_item_featured_left .sc_services_item_subtitle,
.sc_services_default .sc_services_item_featured_right .sc_services_item_subtitle {
	color: {$colors['text_link']};
}

.sc_services_iconed .sc_services_item {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.sc_services_iconed .sc_services_item_header {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
.sc_services_iconed .sc_services_item_icon,
.sc_services_iconed .sc_services_item_subtitle a {
	color: {$colors['bg_color']};
}
.sc_services_iconed .sc_services_item_icon:hover,
.sc_services_iconed .sc_services_item:hover .sc_services_item_icon,
.sc_services_iconed .sc_services_item_subtitle a:hover,
.sc_services_iconed .sc_services_item:hover .sc_services_item_subtitle a {
	color: {$colors['text_link']};
}
.sc_services_iconed .sc_services_item_title a {
	color: {$colors['text_link']};
}
.sc_services_iconed .sc_services_item_title a:hover,
.sc_services_iconed .sc_services_item:hover .sc_services_item_title a {
	color: {$colors['bg_color']};
}
.sc_services.slider_swiper .swiper-pagination-bullet {
	border-color: {$colors['text_light']};
}

/* Skills (Counters) */
.sc_skills_counter .sc_skills_icon {
	color:{$colors['text_dark']};
}
.sc_skills .sc_skills_total {
	color:{$colors['text_link']};
}
.sc_skills_pie.sc_skills_compact_off .sc_skills_total {
	color:{$colors['text_hover']};
}
.sc_skills .sc_skills_item_title,
.sc_skills .sc_skills_legend_title,
.sc_skills .sc_skills_legend_value {
	color:{$colors['text_dark']};
}
.sc_skills_counter .sc_skills_column:before {
	background-color: {$colors['bd_color']};
}

/* Socials */
.sc_socials .socials_wrap a {
	color: {$colors['alter_light']};
}
.sc_socials .socials_wrap a:hover {
	color: {$colors['text_link']};
}

/* Testimonials */
.sc_testimonials_item_content {
	color: {$colors['text_dark']};
}
.sc_testimonials_item_content:before {
	color: {$colors['text_link']};
}
.sc_testimonials_item_author_title {
	color: {$colors['text_link']};
}
.sc_testimonials_item_author_subtitle {
	color: {$colors['text_dark']};
}
.sc_testimonials_simple .sc_testimonials_item_author_data:before  {
	background-color: {$colors['text']};
}
.sc_testimonials .swiper-pagination-bullet {
	background-color: {$colors['text_light']};
}
.sc_testimonials .swiper-pagination-bullet-active {
	background-color: {$colors['text_link']};
}
.sc_testimonials_extra .sc_testimonials_item,
.sc_testimonials_default .sc_testimonials_item {
	background-color: {$colors['alter_bg_color']};
}
.sc_testimonials_extra .sc_testimonials_item:before,
.sc_testimonials_default .sc_testimonials_item:before {
	color: {$colors['text_hover']};
}
.sc_testimonials_extra .sc_testimonials_item .sc_testimonials_item_author_avatar {
	background-color: {$colors['text_dark']};
}


/* Team */
.sc_team_default .sc_team_item {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.sc_team_default .sc_team_item_subtitle {
	color: {$colors['alter_link']};
}
.sc_team_default .sc_team_item_socials .social_item a,
.team_member_page .team_member_socials .social_item a {
	color: {$colors['inverse_text']};
	background-color: {$colors['alter_link']};
}
.sc_team_default .sc_team_item_socials .social_item a:hover,
.team_member_page .team_member_socials .social_item a:hover {
	color: {$colors['alter_bg_color']};
	background-color: {$colors['alter_dark']};
}
.sc_team .sc_team_item_thumb .sc_team_item_title a,
.sc_team .sc_team_item_thumb .sc_team_item_subtitle a,
.sc_team .sc_team_item_thumb .sc_team_item_content a {
	color: {$colors['inverse_text']};
}
.sc_team .sc_team_item_thumb .sc_team_item_title a:hover,
.sc_team .sc_team_item_thumb .sc_team_item_subtitle a:hover,
.sc_team .sc_team_item_thumb .sc_team_item_content a:hover {
	color: {$colors['inverse_text']};
}
.sc_team .sc_team_item_thumb .sc_team_item_socials .social_item a {
	color: {$colors['inverse_text']};
	border-color: {$colors['inverse_text']};
}
.sc_team .sc_team_item_thumb .sc_team_item_socials .social_item a:hover {
	color: {$colors['text_link']};
	background-color: {$colors['inverse_text']};
}
.team_member_page .team_member_featured .team_member_avatar {
	border-color: {$colors['bd_color']};
}
.sc_team_short .sc_team_item_thumb {
	border-color: {$colors['text_link']};
}
.sc_team.slider_swiper .swiper-pagination-bullet {
	border-color: {$colors['text_light']};
}


/* Utils
--------------------------------------------------- */
.trx_addons_tabs .trx_addons_tabs_titles li.ui-tabs-active:after {
	background-color: {$colors['text_hover']};
}
/* Scroll to top */
.trx_addons_scroll_to_top,
.trx_addons_cv .trx_addons_scroll_to_top {
	border-color: {$colors['text_link']};
	background-color: {$colors['text_link']};
	color: {$colors['text_hover']};
}
.trx_addons_scroll_to_top:hover,
.trx_addons_cv .trx_addons_scroll_to_top:hover {
	border-color: {$colors['text_hover']};
	background-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}


/* Login and Register */
.trx_addons_popup {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_text']};
}
.trx_addons_popup .mfp-close {
	background-color: {$colors['alter_bg_hover']};
	border-color: {$colors['alter_bd_hover']};
	color:{$colors['alter_text']};
}
.trx_addons_popup .mfp-close:hover {
	background-color: {$colors['alter_dark']};
	color: {$colors['alter_bg_color']};
}
.trx_addons_popup .trx_addons_tabs_title {
	background-color:{$colors['alter_bg_hover']};
	border-color: {$colors['alter_bd_hover']};
}
.trx_addons_popup .trx_addons_tabs_title.ui-tabs-active {
	background-color:{$colors['alter_bg_color']};
	border-bottom-color: transparent;
}
.trx_addons_popup .trx_addons_tabs_title a,
.trx_addons_popup .trx_addons_tabs_title a > i {
	color:{$colors['alter_text']};
}
.trx_addons_popup .trx_addons_tabs_title a:hover,
.trx_addons_popup .trx_addons_tabs_title a:hover > i {
	color:{$colors['alter_link']};
}
.trx_addons_popup .trx_addons_tabs_title[data-disabled="true"] a,
.trx_addons_popup .trx_addons_tabs_title[data-disabled="true"] a > i,
.trx_addons_popup .trx_addons_tabs_title[data-disabled="true"] a:hover,
.trx_addons_popup .trx_addons_tabs_title[data-disabled="true"] a:hover > i {
	color:{$colors['alter_light']};
}
.trx_addons_popup .trx_addons_tabs_title.ui-tabs-active a,
.trx_addons_popup .trx_addons_tabs_title.ui-tabs-active a > i,
.trx_addons_popup .trx_addons_tabs_title.ui-tabs-active a:hover,
.trx_addons_popup .trx_addons_tabs_title.ui-tabs-active a:hover > i {
	color:{$colors['alter_dark']};
}

/* Profiler */
.trx_addons_profiler {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_hover']};
}
.trx_addons_profiler_title {
	color: {$colors['alter_dark']};
}
.trx_addons_profiler table td,
.trx_addons_profiler table th {
	border-color: {$colors['alter_bd_color']};
}
.trx_addons_profiler table td {
	color: {$colors['alter_text']};
}
.trx_addons_profiler table th {
	background-color: {$colors['alter_bg_hover']};
	color: {$colors['alter_dark']};
}



/* CV */
.trx_addons_cv,
.trx_addons_cv_body_wrap {
	color: {$colors['alter_text']};
	background-color:{$colors['alter_bg_color']};
}
.trx_addons_cv a {
	color: {$colors['alter_link']};
}
.trx_addons_cv a:hover {
	color: {$colors['alter_hover']};
}

.trx_addons_cv_header {
	background-color: {$colors['bg_color']};
}
.trx_addons_cv_header_image img {
	border-color: {$colors['text_dark']};
}
.trx_addons_cv_header .trx_addons_cv_header_letter,
.trx_addons_cv_header .trx_addons_cv_header_text {
	color: {$colors['text_dark']};
}
.trx_addons_cv_header .trx_addons_cv_header_socials .social_item > a {
	color: {$colors['text_dark_07']};	
}
.trx_addons_cv_header .trx_addons_cv_header_socials .social_item > a:hover {
	color: {$colors['text_dark']};	
}
/*
.trx_addons_cv_header_letter,
.trx_addons_cv_header_text,
.trx_addons_cv_header_socials .social_item > a {
	text-shadow: 1px 1px 6px {$colors['bg_color']};
}

.trx_addons_cv_tint_dark .trx_addons_cv_header_letter,
.trx_addons_cv_tint_dark .trx_addons_cv_header_text,
.trx_addons_cv_tint_dark .trx_addons_cv_header_socials .social_item > a {
	color: {$colors['bg_color']};	
	text-shadow: 1px 1px 3px {$colors['text_dark']};
}
.trx_addons_cv_tint_dark .trx_addons_cv_header_socials .social_item > a:hover {
	text-shadow: 1px 1px 3px {$colors['text']};
}
*/

.trx_addons_cv_navi_buttons .trx_addons_cv_navi_buttons_area .trx_addons_cv_navi_buttons_item {
	color: {$colors['alter_light']};
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['bg_color']};
}
.trx_addons_cv_navi_buttons .trx_addons_cv_navi_buttons_area .trx_addons_cv_navi_buttons_item_active,
.trx_addons_cv_navi_buttons .trx_addons_cv_navi_buttons_area .trx_addons_cv_navi_buttons_item:hover {
	color: {$colors['alter_dark']};
	border-color: {$colors['alter_bg_color']};
}


.trx_addons_cv .trx_addons_cv_section_title,
.trx_addons_cv .trx_addons_cv_section_title a {
	color: {$colors['alter_dark']};
}
.trx_addons_cv_section_title.ui-state-active {
	border-color: {$colors['alter_dark']};
}
.trx_addons_cv_section_content .trx_addons_tabs .trx_addons_tabs_titles li > a {
	color: {$colors['alter_light']};
}
.trx_addons_cv_section_content .trx_addons_tabs .trx_addons_tabs_titles li.ui-state-active > a,
.trx_addons_cv_section_content .trx_addons_tabs .trx_addons_tabs_titles li > a:hover {
	color: {$colors['alter_dark']};
}
.trx_addons_cv_section .trx_addons_pagination > * {
	color:{$colors['alter_text']};
}
.trx_addons_cv_section .trx_addons_pagination > a:hover {
	color: {$colors['alter_dark']};
}
.trx_addons_pagination > span.active {
	color: {$colors['alter_dark']};
	border-color: {$colors['alter_dark']};
}
.trx_addons_cv_breadcrumbs .trx_addons_cv_breadcrumbs_item {
	color: {$colors['alter_light']};
}
.trx_addons_cv_breadcrumbs a.trx_addons_cv_breadcrumbs_item:hover {
	color: {$colors['alter_dark']};
}
.trx_addons_cv_single .trx_addons_cv_single_title {
	color: {$colors['alter_dark']};
}
.trx_addons_cv_single .trx_addons_cv_single_subtitle {
	color: {$colors['alter_light']};
}

.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_2 .trx_addons_cv_resume_column:nth-child(2n+2) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_3 .trx_addons_cv_resume_column:nth-child(3n+2) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_3 .trx_addons_cv_resume_column:nth-child(3n+3) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_4 .trx_addons_cv_resume_column:nth-child(4n+2) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_4 .trx_addons_cv_resume_column:nth-child(4n+3) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_4 .trx_addons_cv_resume_column:nth-child(4n+4) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_2 .trx_addons_cv_resume_column:nth-child(2n+3) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_2 .trx_addons_cv_resume_column:nth-child(2n+4) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_3 .trx_addons_cv_resume_column:nth-child(3n+4) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_3 .trx_addons_cv_resume_column:nth-child(3n+5) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_3 .trx_addons_cv_resume_column:nth-child(3n+6) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_4 .trx_addons_cv_resume_column:nth-child(4n+5) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_4 .trx_addons_cv_resume_column:nth-child(4n+6) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_4 .trx_addons_cv_resume_column:nth-child(4n+7) .trx_addons_cv_resume_item,
.trx_addons_tabs_content_delimiter .trx_addons_cv_resume_columns_4 .trx_addons_cv_resume_column:nth-child(4n+8) .trx_addons_cv_resume_item {
	border-color: {$colors['alter_bd_color']};
}
.trx_addons_cv_resume_item_meta {
	color: {$colors['alter_dark']};
}
.trx_addons_cv_resume_item .trx_addons_cv_resume_item_title,
.trx_addons_cv_resume_item .trx_addons_cv_resume_item_title a {
	color: {$colors['alter_dark']};
}
.trx_addons_cv_resume_item_subtitle {
	color: {$colors['alter_light']};
}
.trx_addons_cv_resume_style_skills .trx_addons_cv_resume_item_skills {
	color: {$colors['alter_dark']};
}
.trx_addons_cv_resume_style_skills .trx_addons_cv_resume_item_skill:after {
	border-color: {$colors['alter_dark']};
}
.trx_addons_cv_resume_style_education .trx_addons_cv_resume_item_number {
	color: {$colors['alter_light']};
}
.trx_addons_cv_resume_style_services .trx_addons_cv_resume_item_icon {
	color: {$colors['alter_dark']};
}
.trx_addons_cv_resume_style_services .trx_addons_cv_resume_item_title > a:after {
	border-top-color: {$colors['alter_dark']};
}
.trx_addons_cv_resume_style_services .trx_addons_cv_resume_item_text a {
	color: {$colors['alter_dark']};
}

.trx_addons_cv_portfolio_item .trx_addons_cv_portfolio_item_title,
.trx_addons_cv_portfolio_item .trx_addons_cv_portfolio_item_title a {
	color: {$colors['alter_dark']};
}

.trx_addons_cv_testimonials_item .trx_addons_cv_testimonials_item_title,
.trx_addons_cv_testimonials_item .trx_addons_cv_testimonials_item_title a {
	color: {$colors['alter_dark']};
}

.trx_addons_cv_certificates_item .trx_addons_cv_certificates_item_title,
.trx_addons_cv_certificates_item .trx_addons_cv_certificates_item_title a {
	color: {$colors['alter_dark']};
}

/* Contact form */
.trx_addons_cv .trx_addons_contact_form .trx_addons_contact_form_title {
	color: {$colors['alter_dark']};
}
.trx_addons_cv .trx_addons_contact_form_field_title {
	color: {$colors['alter_dark']};
}
.trx_addons_contact_form .trx_addons_contact_form_field input[type="text"],
.trx_addons_contact_form .trx_addons_contact_form_field textarea {
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_text']};
}
.trx_addons_contact_form .trx_addons_contact_form_field input[type="text"]:focus,
.trx_addons_contact_form .trx_addons_contact_form_field textarea:focus {
	background-color: {$colors['alter_bg_hover']};
	color: {$colors['alter_dark']};
}
.trx_addons_contact_form_field button {
	background-color: {$colors['alter_dark']};
	border-color: {$colors['alter_dark']};
	color: {$colors['bg_color']};
}
.trx_addons_contact_form_field button:hover {
	color: {$colors['alter_dark']};
}
.trx_addons_contact_form_info_icon {
	color: {$colors['alter_light']};
}
.trx_addons_contact_form_info_area {
	color: {$colors['alter_dark']};
}
.trx_addons_contact_form_info_item_phone .trx_addons_contact_form_info_data {
	color: {$colors['alter_dark']} !important;
}

/* Page About Me */
.trx_addons_cv_about_page .trx_addons_cv_single_title {
	color: {$colors['alter_dark']};
}

CSS;
		}

		return $css;
	}
}
?>