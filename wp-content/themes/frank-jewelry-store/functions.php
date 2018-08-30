<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

// Theme storage
$FRANK_JEWELRY_STORE_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array(
		// Required plugins
		// DON'T COMMENT OR REMOVE NEXT LINES!
		'trx_addons',
		// Recommended (supported) plugins
		// If plugin not need - comment (or remove) it
		'essential-grid',
		'instagram-feed',
		'js_composer',
		'revslider',
		'woocommerce'
		)
);


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

if ( !function_exists('frank_jewelry_store_theme_setup1') ) {
	add_action( 'after_setup_theme', 'frank_jewelry_store_theme_setup1', 1 );
	function frank_jewelry_store_theme_setup1() {
		// Set theme content width
		$GLOBALS['content_width'] = apply_filters( 'frank_jewelry_store_filter_content_width', 1170 );
	}
}

if ( !function_exists('frank_jewelry_store_theme_setup') ) {
	add_action( 'after_setup_theme', 'frank_jewelry_store_theme_setup' );
	function frank_jewelry_store_theme_setup() {

		// Add default posts and comments RSS feed links to head 
		add_theme_support( 'automatic-feed-links' );
		
		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('frank_jewelry_store_filter_add_thumb_sizes', array(
			'frank_jewelry_store-thumb-huge'		=> array(1170, 658, true),
			'frank_jewelry_store-thumb-big' 		=> array( 870, 490, true),
			'frank_jewelry_store-thumb-med' 		=> array( 420, 300, true),
			'frank_jewelry_store-thumb-tiny' 		=> array(  90,  90, true),
			'frank_jewelry_store-thumb-masonry-big' => array( 770,   0, false),		// Only downscale, not crop
			'frank_jewelry_store-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = frank_jewelry_store_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'frank_jewelry_store_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}
		
		// Custom header setup
		add_theme_support( 'custom-header', array(
			'header-text'=>false
			)
		);

		// Custom backgrounds setup
		add_theme_support( 'custom-background', array()	);
		
		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') ); 
 
 		// Autogenerate title tag
		add_theme_support('title-tag');
 		
		// Add theme menus
		add_theme_support('nav-menus');
		
		// Switch default markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
		
		// WooCommerce Support
		add_theme_support( 'woocommerce' );
		
		// Editor custom stylesheet - for user
		add_editor_style( array_merge(
			array(
				'css/editor-style.css',
				frank_jewelry_store_get_file_url('css/fontello/css/fontello-embedded.css')
			),
			frank_jewelry_store_theme_fonts_for_editor()
			)
		);	
		
		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'frank-jewelry-store', frank_jewelry_store_get_folder_dir('languages') );
	
		// Register navigation menu
		register_nav_menus(array(
			'menu_top' => esc_html__('Top Menu', 'frank-jewelry-store'),
			'menu_main' => esc_html__('Main Menu', 'frank-jewelry-store'),
			'menu_header' => esc_html__('Header Menu', 'frank-jewelry-store'),
			'menu_footer' => esc_html__('Footer Menu', 'frank-jewelry-store')
			)
		);

		// Excerpt filters
		add_filter( 'excerpt_length',						'frank_jewelry_store_excerpt_length' );
		add_filter( 'excerpt_more',							'frank_jewelry_store_excerpt_more' );
		
		// Add required meta tags in the head
		add_action('wp_head',		 						'frank_jewelry_store_wp_head', 1);
		
		// Add custom inline styles
		add_action('wp_footer',		 						'frank_jewelry_store_wp_footer');
		add_action('admin_footer',	 						'frank_jewelry_store_wp_footer');

		// Enqueue scripts and styles for frontend
		add_action('wp_enqueue_scripts', 					'frank_jewelry_store_wp_scripts', 1000);			//priority 1000 - load styles before the plugin's support custom styles (priority 1100)
		add_action('wp_enqueue_scripts', 					'frank_jewelry_store_wp_scripts_responsive', 2000);	//priority 2000 - load responsive after all other styles
		
		// Add body classes
		add_filter( 'body_class',							'frank_jewelry_store_add_body_classes' );

		// Register sidebars
		add_action('widgets_init', 							'frank_jewelry_store_widgets_init');
	}

}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------
if ( !function_exists('frank_jewelry_store_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'frank_jewelry_store_image_sizes' );
	function frank_jewelry_store_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('frank_jewelry_store_filter_add_thumb_sizes', array(
			'frank_jewelry_store-thumb-huge'		=> esc_html__( 'Fullsize image', 'frank-jewelry-store' ),
			'frank_jewelry_store-thumb-big'			=> esc_html__( 'Large image', 'frank-jewelry-store' ),
			'frank_jewelry_store-thumb-med'			=> esc_html__( 'Medium image', 'frank-jewelry-store' ),
			'frank_jewelry_store-thumb-tiny'		=> esc_html__( 'Small square avatar', 'frank-jewelry-store' ),
			'frank_jewelry_store-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'frank-jewelry-store' ),
			'frank_jewelry_store-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'frank-jewelry-store' ),
			)
		);
		$mult = frank_jewelry_store_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'frank-jewelry-store' );
		}
		return $sizes;
	}
}


//-------------------------------------------------------
//-- Theme scripts and styles
//-------------------------------------------------------

// Load frontend scripts
if ( !function_exists( 'frank_jewelry_store_wp_scripts' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'frank_jewelry_store_wp_scripts', 1000);
	function frank_jewelry_store_wp_scripts() {
		
		// Enqueue styles
		//------------------------
		
		// Links to selected fonts
		$links = frank_jewelry_store_theme_fonts_links();
		if (count($links) > 0) {
			foreach ($links as $slug => $link) {
				frank_jewelry_store_enqueue_style( sprintf('frank_jewelry_store-font-%s', $slug), $link );
			}
		}
		
		// Fontello styles must be loaded before main stylesheet
		// This style NEED the theme prefix, because style 'fontello' in some plugin contain different set of characters
		// and can't be used instead this style!
		frank_jewelry_store_enqueue_style( 'frank_jewelry_store-fontello',  frank_jewelry_store_get_file_url('css/fontello/css/fontello-embedded.css') );

		// Load main stylesheet
		$main_stylesheet = get_template_directory_uri() . '/style.css';
		frank_jewelry_store_enqueue_style( 'frank_jewelry_store-main', $main_stylesheet, array(), null );

		// Load child stylesheet (if different) after the main stylesheet and fontello icons (important!)
		$child_stylesheet = get_stylesheet_directory_uri() . '/style.css';
		if ($child_stylesheet != $main_stylesheet) {
			frank_jewelry_store_enqueue_style( 'frank_jewelry_store-child', $child_stylesheet, array('frank_jewelry_store-main'), null );
		}
		
		// Animations
		if ( (frank_jewelry_store_get_theme_option('blog_animation')!='none' || frank_jewelry_store_get_theme_option('menu_animation_in')!='none' || frank_jewelry_store_get_theme_option('menu_animation_out')!='none') && (frank_jewelry_store_get_theme_option('animation_on_mobile')=='yes' || !wp_is_mobile()) && (!function_exists('frank_jewelry_store_vc_is_frontend') || !frank_jewelry_store_vc_is_frontend()))
			frank_jewelry_store_enqueue_style( 'frank_jewelry_store-animation',	frank_jewelry_store_get_file_url('css/animation.css') );

		// Custom colors
		if ( !is_customize_preview() && !isset($_GET['color_scheme']) && frank_jewelry_store_is_off(frank_jewelry_store_get_theme_option('debug_mode')) )
			frank_jewelry_store_enqueue_style( 'frank_jewelry_store-colors', frank_jewelry_store_get_file_url('css/__colors.css') );
		else
			wp_add_inline_style( 'frank_jewelry_store-main', frank_jewelry_store_customizer_get_css() );

		// Merged styles
		if ( frank_jewelry_store_is_off(frank_jewelry_store_get_theme_option('debug_mode')) )
			frank_jewelry_store_enqueue_style( 'frank_jewelry_store-styles', frank_jewelry_store_get_file_url('css/__styles.css') );

		// Add post nav background
		frank_jewelry_store_add_bg_in_post_nav();

		// Disable loading JQuery UI CSS
		wp_deregister_style('jquery_ui');
		wp_deregister_style('date-picker-css');


		// Enqueue scripts	
		//------------------------
		
		// Modernizr will load in head before other scripts and styles
		if ( substr(frank_jewelry_store_get_theme_option('blog_style'), 0, 7) == 'gallery' || substr(frank_jewelry_store_get_theme_option('blog_style'), 0, 9) == 'portfolio' )
			frank_jewelry_store_enqueue_script( 'modernizr', frank_jewelry_store_get_file_url('js/theme.gallery/modernizr.min.js'), array(), null, false );
		
		// Merged scripts
		if ( frank_jewelry_store_is_off(frank_jewelry_store_get_theme_option('debug_mode')) )
			frank_jewelry_store_enqueue_script( 'frank_jewelry_store-init', frank_jewelry_store_get_file_url('js/__scripts.js'), array('jquery') );
		else {
			// Skip link focus
			frank_jewelry_store_enqueue_script( 'skip-link-focus-fix', frank_jewelry_store_get_file_url('js/skip-link-focus-fix.js') );
			// Superfish Menu
			frank_jewelry_store_enqueue_script( 'superfish', frank_jewelry_store_get_file_url('js/superfish.js'), array('jquery') );
			// Background video
			$header_video = frank_jewelry_store_get_theme_option('header_video');
			if (!empty($header_video) && !frank_jewelry_store_is_inherit($header_video))
				frank_jewelry_store_enqueue_script( 'bideo', frank_jewelry_store_get_file_url('js/bideo.js'), array() );
			// Theme scripts
			frank_jewelry_store_enqueue_script( 'frank_jewelry_store-utils', frank_jewelry_store_get_file_url('js/_utils.js'), array('jquery') );
			frank_jewelry_store_enqueue_script( 'frank_jewelry_store-init', frank_jewelry_store_get_file_url('js/_init.js'), array('jquery') );	
		}
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Media elements library	
		if (frank_jewelry_store_get_theme_setting('use_mediaelements')) {
			wp_enqueue_style ( 'mediaelement' );
			wp_enqueue_style ( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}

		wp_localize_script( 'frank_jewelry_store-init', 'FRANK_JEWELRY_STORE_STORAGE', apply_filters( 'frank_jewelry_store_filter_localize_script', array(
			// AJAX parameters
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			
			// Site base url
			'site_url' => get_site_url(),
			
			// User logged in
			'user_logged_in' => is_user_logged_in() ? true : false,
			
			// Menu width for mobile mode
			'mobile_layout_width' => max(480, frank_jewelry_store_get_theme_option('mobile_layout_width')),

			// Use menu cache
			'menu_cache' => frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('menu_cache')),

			// Stretch sidemenu to window height
			'menu_stretch' => frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('menu_stretch')),

			// Menu animation
			'menu_animation_in' => frank_jewelry_store_get_theme_option('menu_animation_in'),
            'menu_animation_out' => frank_jewelry_store_get_theme_option('menu_animation_out'),

			// Video background
			'background_video' => frank_jewelry_store_get_theme_option('header_video'),

			// Video and Audio tag wrapper
			'use_mediaelements' => frank_jewelry_store_get_theme_setting('use_mediaelements') ? true : false,

			// Messages max length
			'message_maxlength'	=> intval(frank_jewelry_store_get_theme_setting('message_maxlength')),
						
			// Site color scheme
			'site_scheme' => sprintf('scheme_%s', frank_jewelry_store_get_theme_option('color_scheme')),

			
			// Internal vars - do not change it!
			
			// Flag for review mechanism
			'admin_mode' => false,

			// E-mail mask
			'email_mask' => '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$',
			
			// Strings for translation
			'strings' => array(
					'ajax_error'		=> esc_html__('Invalid server answer!', 'frank-jewelry-store'),
					'error_global'		=> esc_html__('Error data validation!', 'frank-jewelry-store'),
					'name_empty' 		=> esc_html__("The name can't be empty", 'frank-jewelry-store'),
					'name_long'			=> esc_html__('Too long name', 'frank-jewelry-store'),
					'email_empty'		=> esc_html__('Too short (or empty) email address', 'frank-jewelry-store'),
					'email_long'		=> esc_html__('Too long email address', 'frank-jewelry-store'),
					'email_not_valid'	=> esc_html__('Invalid email address', 'frank-jewelry-store'),
					'text_empty'		=> esc_html__("The message text can't be empty", 'frank-jewelry-store'),
					'text_long'			=> esc_html__('Too long message text', 'frank-jewelry-store'),
					'search_error'		=> esc_html__('Search error! Try again later.', 'frank-jewelry-store'),
					'send_complete'		=> esc_html__("Send message complete!", 'frank-jewelry-store'),
					'send_error'		=> esc_html__('Transmit failed!', 'frank-jewelry-store')
					)
			))
		);
	}
}

// Load responsive styles (priority 2000 - load it after main styles and plugins custom styles)
if ( !function_exists( 'frank_jewelry_store_wp_scripts_responsive' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'frank_jewelry_store_wp_scripts_responsive', 2000);
	function frank_jewelry_store_wp_scripts_responsive() {
		frank_jewelry_store_enqueue_style( 'frank_jewelry_store-responsive', frank_jewelry_store_get_file_url('css/responsive.css') );
	}
}

//  Add meta tags and inline scripts in the header for frontend
if (!function_exists('frank_jewelry_store_wp_head')) {
	//Handler of the add_action('wp_head',	'frank_jewelry_store_wp_head', 1);
	function frank_jewelry_store_wp_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
}

// Add theme specified classes to the body
if ( !function_exists('frank_jewelry_store_add_body_classes') ) {
	//Handler of the add_filter( 'body_class', 'frank_jewelry_store_add_body_classes' );
	function frank_jewelry_store_add_body_classes( $classes ) {
		$blog_mode = frank_jewelry_store_storage_get('blog_mode');
		$classes[] = 'blog_mode_' . esc_attr($blog_mode);
		$classes[] = 'body_tag';	// Need for the .scheme_self
		$classes[] = 'body_style_' . esc_attr(frank_jewelry_store_get_theme_option('body_style'));
		$classes[] = 'scheme_' . esc_attr(frank_jewelry_store_get_theme_option('color_scheme'));
		if (in_array($blog_mode, array('post', 'page'))) {
			$classes[] = 'is_single';
		} else {
			$classes[] = ' is_stream';
			$classes[] = 'blog_style_'.esc_attr(frank_jewelry_store_get_theme_option('blog_style'));
		}
		if (frank_jewelry_store_sidebar_present()) {
			$classes[] = 'sidebar_show sidebar_' . esc_attr(frank_jewelry_store_get_theme_option('sidebar_position')) ;
		} else {
			$classes[] = 'sidebar_hide';
			if (frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('expand_content')))
				 $classes[] = 'expand_content';
		}
		if (frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('remove_margins')))
			 $classes[] = 'remove_margins';

		$classes[] = 'header_style_' . esc_attr(frank_jewelry_store_get_theme_option("header_style"));
		$classes[] = 'header_position_' . esc_attr(frank_jewelry_store_get_theme_option("header_position"));
		$classes[] = 'header_title_' . esc_attr(frank_jewelry_store_need_page_title() ? 'on' : 'off');

		$menu_style= frank_jewelry_store_get_theme_option("menu_style");
		$classes[] = 'menu_style_' . esc_attr($menu_style) . (in_array($menu_style, array('left', 'right'))	? ' menu_style_side' : '');
		$classes[] = 'no_layout';
		
		return $classes;
	}
}
	
// Load inline styles
if ( !function_exists( 'frank_jewelry_store_wp_footer' ) ) {
	//Handler of the add_action('wp_footer', 'frank_jewelry_store_wp_footer');
	//and add_action('admin_footer', 'frank_jewelry_store_wp_footer');
	function frank_jewelry_store_wp_footer() {
		// Get inline styles from storage
		if (($css = frank_jewelry_store_storage_get('inline_styles')) != '') {
			frank_jewelry_store_enqueue_style(  'frank_jewelry_store-inline-styles',  frank_jewelry_store_get_file_url('css/__inline.css') );
			wp_add_inline_style( 'frank_jewelry_store-inline-styles', $css );
		}
	}
}


//-------------------------------------------------------
//-- Sidebars and widgets
//-------------------------------------------------------

// Register widgetized areas
if ( !function_exists('frank_jewelry_store_widgets_init') ) {
	// add_action('widgets_init', 'frank_jewelry_store_widgets_init');
	function frank_jewelry_store_widgets_init() {
		$sidebars = frank_jewelry_store_get_list_sidebars();
		if (is_array($sidebars) && count($sidebars) > 0) {
			foreach ($sidebars as $id=>$name) {
				register_sidebar( array(
										'name'          => $name,
										'id'            => $id,
										'before_widget' => '<aside id="%1$s" class="widget %2$s">',
										'after_widget'  => '</aside>',
										'before_title'  => '<h5 class="widget_title">',
										'after_title'   => '</h5>'
										)
								);
			}
		}
	}
}


//-------------------------------------------------------
//-- Theme fonts
//-------------------------------------------------------

// Return links for all theme fonts
if ( !function_exists('frank_jewelry_store_theme_fonts_links') ) {
	function frank_jewelry_store_theme_fonts_links() {
		$links = array();
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$google_fonts_enabled = ( 'off' !== _x( 'on', 'Google fonts: on or off', 'frank-jewelry-store' ) );
		$custom_fonts_enabled = ( 'off' !== _x( 'on', 'Custom fonts (included in the theme): on or off', 'frank-jewelry-store' ) );
		
		if ( ($google_fonts_enabled || $custom_fonts_enabled) && !frank_jewelry_store_storage_empty('load_fonts') ) {
			$load_fonts = frank_jewelry_store_storage_get('load_fonts');
			if (count($load_fonts) > 0) {
				$google_fonts = '';
				foreach ($load_fonts as $font) {
					$slug = frank_jewelry_store_get_load_fonts_slug($font['name']);
					$url  = frank_jewelry_store_get_file_url( sprintf('css/font-face/%s/stylesheet.css', $slug));
					if ($url != '') {
						if ($custom_fonts_enabled) {
							$links[$slug] = $url;
						}
					} else {
						if ($google_fonts_enabled) {
							$google_fonts .= ($google_fonts ? '%7C' : '') // |
											. str_replace(' ', '+', $font['name'])
											. ':' 
											. (empty($font['styles']) ? '400,400italic,700,700italic' : $font['styles']);
						}
					}
				}
				if ($google_fonts && $google_fonts_enabled) {
					$links['google_fonts'] = sprintf('%s://fonts.googleapis.com/css?family=%s&subset=%s', frank_jewelry_store_get_protocol(), $google_fonts, frank_jewelry_store_get_theme_option('load_fonts_subset'));
				}
			}
		}
		return $links;
	}
}

// Return links for WP Editor
if ( !function_exists('frank_jewelry_store_theme_fonts_for_editor') ) {
	function frank_jewelry_store_theme_fonts_for_editor() {
		$links = array_values(frank_jewelry_store_theme_fonts_links());
		if (is_array($links) && count($links) > 0) {
			for ($i=0; $i<count($links); $i++) {
				$links[$i] = str_replace(',', '%2C', $links[$i]);
			}
		}
		return $links;
	}
}


//-------------------------------------------------------
//-- The Excerpt
//-------------------------------------------------------
if ( !function_exists('frank_jewelry_store_excerpt_length') ) {
	function frank_jewelry_store_excerpt_length( $length ) {
		return max(1, frank_jewelry_store_get_theme_setting('max_excerpt_length'));
	}
}

if ( !function_exists('frank_jewelry_store_excerpt_more') ) {
	function frank_jewelry_store_excerpt_more( $more ) {
		return '&hellip;';
	}
}



//-------------------------------------------------------
//-- Include theme (or child) PHP-files
//-------------------------------------------------------

require_once trailingslashit( get_template_directory() ) . 'includes/utils.php';
require_once trailingslashit( get_template_directory() ) . 'includes/storage.php';
require_once trailingslashit( get_template_directory() ) . 'includes/lists.php';
require_once trailingslashit( get_template_directory() ) . 'includes/wp.php';

require_once trailingslashit( get_template_directory() ) . 'includes/theme.tags.php';
require_once trailingslashit( get_template_directory() ) . 'includes/theme.hovers/theme.hovers.php';

if (is_admin()) {
	require_once trailingslashit( get_template_directory() ) . 'includes/tgmpa/class-tgm-plugin-activation.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/admin.php';
}

require_once trailingslashit( get_template_directory() ) . 'theme-options/theme.customizer.php';

// Plugins support
if (is_array($FRANK_JEWELRY_STORE_STORAGE['required_plugins']) && count($FRANK_JEWELRY_STORE_STORAGE['required_plugins']) > 0) {
	foreach ($FRANK_JEWELRY_STORE_STORAGE['required_plugins'] as $plugin_slug) {
		$plugin_slug = frank_jewelry_store_esc($plugin_slug);
		$plugin_path = trailingslashit( get_template_directory() ) . sprintf('plugins/%s/%s.php', $plugin_slug, $plugin_slug);
		if (file_exists($plugin_path)) { require_once $plugin_path; }
	}
}
?>