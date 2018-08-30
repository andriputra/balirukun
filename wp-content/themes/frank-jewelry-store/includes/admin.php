<?php
/**
 * Admin utilities
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0.1
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('frank_jewelry_store_admin_theme_setup') ) {
	add_action( 'after_setup_theme', 'frank_jewelry_store_admin_theme_setup' );
	function frank_jewelry_store_admin_theme_setup() {
		// Add theme icons
		add_action('admin_footer',	 						'frank_jewelry_store_admin_footer');

		// Enqueue scripts and styles for admin
		add_action("admin_enqueue_scripts",					'frank_jewelry_store_admin_scripts');
		
		// Show admin notice
		add_action('admin_notices',							'frank_jewelry_store_admin_notice', 2);
		add_action('wp_ajax_frank_jewelry_store_hide_admin_notice',		'frank_jewelry_store_callback_hide_admin_notice');

		// TGM Activation plugin
		add_action('tgmpa_register',						'frank_jewelry_store_register_plugins');

		// Set options for importer (before other plugins)
		add_filter( 'trx_addons_filter_importer_options',	'frank_jewelry_store_importer_set_options', 9 );
	}
}

// Show admin notice
if ( !function_exists( 'frank_jewelry_store_admin_notice' ) ) {
	//Handler of the add_action('admin_notices', 'frank_jewelry_store_admin_notice', 2);
	function frank_jewelry_store_admin_notice() {
		$opt_name = 'frank_jewelry_store_admin_notice';
		$show = get_option('frank_jewelry_store_admin_notice');
		if ($show !== false && (int) $show == 0) return;
		get_template_part( 'templates/admin-notice' );
	}
}

// Hide admin notice
if ( !function_exists( 'frank_jewelry_store_callback_hide_admin_notice' ) ) {
	//Handler of the add_action('wp_ajax_frank_jewelry_store_hide_admin_notice', 'frank_jewelry_store_callback_hide_admin_notice');
	function frank_jewelry_store_callback_hide_admin_notice() {
		update_option('frank_jewelry_store_admin_notice', '0');
		exit;
	}
}


//-------------------------------------------------------
//-- Styles and scripts
//-------------------------------------------------------
	
// Load inline styles
if ( !function_exists( 'frank_jewelry_store_admin_footer' ) ) {
	//Handler of the add_action('admin_footer', 'frank_jewelry_store_admin_footer');
	function frank_jewelry_store_admin_footer() {
		// Get current screen
		$screen = get_current_screen();
		if ($screen->id=='nav-menus') {
			get_template_part( 'templates/icons' );
		}
	}
}
	
// Load required styles and scripts for admin mode
if ( !function_exists( 'frank_jewelry_store_admin_scripts' ) ) {
	//Handler of the add_action("admin_enqueue_scripts", 'frank_jewelry_store_admin_scripts');
	function frank_jewelry_store_admin_scripts() {

		// Add theme styles
		frank_jewelry_store_enqueue_style(  'frank_jewelry_store-admin',  frank_jewelry_store_get_file_url('css/admin.css') );

		// Links to selected fonts
		$screen = get_current_screen();
		if (frank_jewelry_store_allow_meta_box($screen->id) && frank_jewelry_store_allow_meta_box($screen->post_type)) {
			// Load fontello icons
			// This style NEED theme prefix, because style 'fontello' some plugin contain different set of characters
			// and can't be used instead this style!
			frank_jewelry_store_enqueue_style(  'frank_jewelry_store-fontello', frank_jewelry_store_get_file_url('css/fontello/css/fontello-embedded.css') );
			frank_jewelry_store_enqueue_style(  'frank_jewelry_store-fontello-animation', frank_jewelry_store_get_file_url('css/fontello/css/animation.css') );
			// Load theme fonts
			$links = frank_jewelry_store_theme_fonts_links();
			if (count($links) > 0) {
				foreach ($links as $slug => $link) {
					frank_jewelry_store_enqueue_style( sprintf('frank_jewelry_store-font-%s', $slug), $link );
				}
			}
		} else if (is_customize_preview() || $screen->id=='nav-menus') {
			// Load fontello icons
			// This style NEED theme prefix, because style 'fontello' some plugin contain different set of characters
			// and can't be used instead this style!
			frank_jewelry_store_enqueue_style(  'frank_jewelry_store-fontello', frank_jewelry_store_get_file_url('css/fontello/css/fontello-embedded.css') );
		}

		// Add theme scripts
		frank_jewelry_store_enqueue_script( 'frank_jewelry_store-utils', frank_jewelry_store_get_file_url('js/_utils.js'), array('jquery') );
		frank_jewelry_store_enqueue_script( 'frank_jewelry_store-admin', frank_jewelry_store_get_file_url('js/_admin.js'), array('jquery') );

		wp_localize_script( 'frank_jewelry_store-admin', 'FRANK_JEWELRY_STORE_STORAGE', apply_filters( 'frank_jewelry_store_filter_localize_script_admin', array(
			'admin_mode' => true,
			'screen_id' => esc_attr($screen->id),
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			'ajax_error_msg' => esc_html__('Server response error', 'frank-jewelry-store'),
			'icon_selector_msg' => esc_html__('Select the icon for this menu item', 'frank-jewelry-store'),
			'user_logged_in' => true
			))
		);
	}
}



//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'frank_jewelry_store_importer_set_options' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_importer_options',	'frank_jewelry_store_importer_set_options', 9 );
	function frank_jewelry_store_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Prepare demo data
			$options['demo_url'] = esc_url(frank_jewelry_store_get_protocol() . '://frank-jewelry-store.themerex.net/demo/');
			// Required plugins
			$options['required_plugins'] = frank_jewelry_store_storage_get('required_plugins');
			// Default demo
			$options['files']['default']['title'] = esc_html__('Basekit Demo', 'frank-jewelry-store');
			$options['files']['default']['domain_dev'] = esc_url(frank_jewelry_store_get_protocol().'://frank-jewelry-store.themerex.net');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(frank_jewelry_store_get_protocol().'://frank-jewelry-store.themerex.net');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			// For example:
			// 		$options['files']['dark_demo'] = $options['files']['default'];
			// 		$options['files']['dark_demo']['title'] = esc_html__('Dark Demo', 'frank-jewelry-store');
		}
		return $options;
	}
}



//-------------------------------------------------------
//-- Third party plugins
//-------------------------------------------------------

// Register optional plugins
if ( !function_exists( 'frank_jewelry_store_register_plugins' ) ) {
	function frank_jewelry_store_register_plugins() {
		tgmpa(	apply_filters('frank_jewelry_store_filter_tgmpa_required_plugins', array(
				// Plugins to include in the autoinstall queue.
				)),
				array(
					'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
					'default_path' => '',                      // Default absolute path to bundled plugins.
					'menu'         => 'tgmpa-install-plugins', // Menu slug.
					'parent_slug'  => 'themes.php',            // Parent menu slug.
					'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
					'has_notices'  => true,                    // Show admin notices or not.
					'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
					'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
					'is_automatic' => true,                    // Automatically activate plugins after installation or not.
					'message'      => ''                       // Message to output right before the plugins table.
				)
			);
	}
}
?>