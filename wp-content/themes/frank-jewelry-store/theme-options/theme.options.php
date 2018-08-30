<?php
/**
 * Default Theme Options and Internal Theme Settings
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

// -----------------------------------------------------------------
// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
// -- Internal theme settings
// -----------------------------------------------------------------
frank_jewelry_store_storage_set('settings', array(
	
	'custom_sidebars'			=> 8,							// How many custom sidebars will be registered (in addition to theme preset sidebars): 0 - 10

	'ajax_views_counter'		=> true,						// Use AJAX for increment posts counter (if cache plugins used) 
																// or increment posts counter then loading page (without cache plugin)
	'disable_jquery_ui'			=> false,						// Prevent loading custom jQuery UI libraries in the third-party plugins

	'max_load_fonts'			=> 3,							// Max fonts number to load from Google fonts or from uploaded fonts

	'breadcrumbs_max_level' 	=> 3,							// Max number of the nested categories in the breadcrumbs (0 - unlimited)

	'use_mediaelements'			=> true,						// Load script "Media Elements" to play video and audio

	'max_excerpt_length'		=> 60,							// Max words number for the excerpt in the blog style 'Excerpt'.
																// For style 'Classic' - get half from this value
	'message_maxlength'			=> 1000							// Max length of the message from contact form
	
));



// -----------------------------------------------------------------
// -- Theme fonts (Google and/or custom fonts)
// -----------------------------------------------------------------

// Fonts to load when theme start
// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
frank_jewelry_store_storage_set('load_fonts', array(
	array(
		'name'	 => 'Playfair Display',
		'family' => 'serif',
		'styles' => '400,400i,700,700i'
		),
	array(
		'name'   => 'Open Sans',
		'family' => 'sans-serif'
		)
));

// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
frank_jewelry_store_storage_set('load_fonts_subset', 'latin,latin-ext');

// Settings of the main tags
frank_jewelry_store_storage_set('theme_fonts', array(
	'p' => array(
		'title'				=> esc_html__('Main text', 'frank-jewelry-store'),
		'description'		=> esc_html__('Font settings of the main text of the site', 'frank-jewelry-store'),
		'font-family'		=> '"Open Sans", sans-serif',
		'font-size' 		=> '16px',
		'font-weight'		=> '400',
		'font-style'		=> 'normal',
		'line-height'		=> '1.63em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> '0',
		'margin-top'		=> '0',
		'margin-bottom'		=> '1.5em'
		),
	'h1' => array(
		'title'				=> esc_html__('Heading 1', 'frank-jewelry-store'),
		'font-family'		=> '"Playfair Display", serif',
		'font-size' 		=> '2.250em',
		'font-weight'		=> '700',
		'font-style'		=> 'normal',
		'line-height'		=> '1.18em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0.15em',
		'margin-top'		=> '1.35em',
		'margin-bottom'		=> '1.35em'
		),
	'h2' => array(
		'title'				=> esc_html__('Heading 2', 'frank-jewelry-store'),
		'font-family'		=> '"Playfair Display", serif',
		'font-size' 		=> '1.875em',
		'font-weight'		=> '700',
		'font-style'		=> 'normal',
		'line-height'		=> '1.35em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0.15em',
		'margin-top'	    => '1.7em',
		'margin-bottom'	    => '1.2em'
		),
	'h3' => array(
		'title'				=> esc_html__('Heading 3', 'frank-jewelry-store'),
		'font-family'		=> '"Playfair Display", serif',
//		'font-size' 		=> '1.875em',
		'font-size' 		=> '2em',
//		'font-weight'		=> '700',
		'font-weight'		=> '500',
		'font-style'		=> 'normal',
		'line-height'		=> '1.3em',
		'text-decoration'	=> 'none',
		'text-transform'	=> '',
		'letter-spacing'	=> '0',
		'margin-top'	    => '1.4em',
		'margin-bottom'	    => '0.75em'
		),
	'h4' => array(
		'title'				=> esc_html__('Heading 4', 'frank-jewelry-store'),
		'font-family'		=> '"Playfair Display", serif',
		'font-size' 		=> '1.625em',
//		'font-weight'		=> '700',
		'font-weight'		=> '500',
		'font-style'		=> 'normal',
		'line-height'		=> '1.3em',
		'text-decoration'	=> 'none',
		'text-transform'	=> '',
		'letter-spacing'	=> '0',
		'margin-top'	    => '1.6em',
		'margin-bottom'	    => '0.75em'
		),
	'h5' => array(
		'title'				=> esc_html__('Heading 5', 'frank-jewelry-store'),
		'font-family'		=> '"Playfair Display", serif',
		'font-size' 		=> '1.500em',
		'font-weight'		=> '400',
		'font-style'		=> 'italic',
		'line-height'		=> '1.3em',
		'text-decoration'	=> 'none',
		'text-transform'	=> '',
		'letter-spacing'	=> '0',
		'margin-top'	    => '1.5em',
		'margin-bottom'	    => '0.75em'
		),
	'h6' => array(
		'title'				=> esc_html__('Heading 6', 'frank-jewelry-store'),
		'font-family'		=> '"Open Sans", sans-serif',
		'font-size' 		=> '0.875em',
		'font-weight'		=> '700',
		'font-style'		=> 'normal',
		'line-height'		=> '1.4em',
		'text-decoration'	=> 'none',
		'text-transform'	=> '',
		'letter-spacing'	=> '0',
		'margin-top'	    => '2em',
		'margin-bottom'	    => '1.05em'
		),
	'logo' => array(
		'title'				=> esc_html__('Logo text', 'frank-jewelry-store'),
		'description'		=> esc_html__('Font settings of the text case of the logo', 'frank-jewelry-store'),
		'font-family'		=> '',
		'font-size' 		=> '1.6em',
		'font-weight'		=> '700',
		'font-style'		=> 'normal',
		'line-height'		=> '1em',
		'text-decoration'	=> 'none',
		'text-transform'	=> '',
		'letter-spacing'	=> '0'
		),
	'button' => array(
		'title'				=> esc_html__('Buttons', 'frank-jewelry-store'),
		'font-family'		=> '"Playfair Display", serif',
		'font-size' 		=> '14px',
		'font-weight'		=> '700',
		'font-style'		=> 'italic',
		'line-height'		=> '1.4em',
		'text-decoration'	=> 'none',
		'text-transform'	=> '',
		'letter-spacing'	=> '0.1em'
		),
	'input' => array(
		'title'				=> esc_html__('Input fields', 'frank-jewelry-store'),
		'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'frank-jewelry-store'),
		'font-family'		=> '"Playfair Display", serif',
		'font-size' 		=> '1.125em',
		'font-weight'		=> '400',
		'font-style'		=> 'italic',
		'line-height'		=> '1.2857em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'none',
		'letter-spacing'	=> ''
		),
	'info' => array(
		'title'				=> esc_html__('Post meta', 'frank-jewelry-store'),
		'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'frank-jewelry-store'),
		'font-family'		=> '"Open Sans", sans-serif',
		'font-size' 		=> '11px',
		'font-weight'		=> '400',
		'font-style'		=> 'normal',
		'line-height'		=> '1.2857em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '0.1em',
		'margin-top'		=> '',
		'margin-bottom'		=> '2.8em'
		),
	'menu' => array(
		'title'				=> esc_html__('Main menu', 'frank-jewelry-store'),
		'description'		=> esc_html__('Font settings of the main menu items', 'frank-jewelry-store'),
		'font-family'		=> '"Playfair Display", serif',
		'font-size' 		=> '12px',
		'font-weight'		=> '400',
		'font-style'		=> 'normal',
		'line-height'		=> '1.3em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '1.2px'
		),
	'submenu' => array(
		'title'				=> esc_html__('Dropdown menu', 'frank-jewelry-store'),
		'description'		=> esc_html__('Font settings of the dropdown menu items', 'frank-jewelry-store'),
		'font-family'		=> '"Playfair Display", serif',
		'font-size' 		=> '12px',
		'font-weight'		=> '400',
		'font-style'		=> 'normal',
		'line-height'		=> '1.3em',
		'text-decoration'	=> 'none',
		'text-transform'	=> 'uppercase',
		'letter-spacing'	=> '1.1px'
		)
));


// -----------------------------------------------------------------
// -- Theme colors for customizer
// -- Attention! Inner scheme must be last in the array below
// -----------------------------------------------------------------
frank_jewelry_store_storage_set('schemes', array(

	// Color scheme: 'default'
	'default' => array(
		'title'	 => esc_html__('Default', 'frank-jewelry-store'),
		'colors' => array(
			
			// Whole block border and background
			'bg_color'				=> '#ffffff',
			'bd_color'				=> '#f1f2f4', //ok

			// Text and links colors
			'text'					=> '#919191', //ok
			'text_light'			=> '#dadada', //ok
			'text_dark'				=> '#00111a', //ok
			'text_link'				=> '#00111a', //ok
			'text_hover'			=> '#ff3b18', //ok

			// Alternative blocks (submenu, buttons, tabs, etc.)
			'alter_bg_color'		=> '#f5f7fa', //ok
			'alter_bg_hover'		=> '#f0f0f0',
			'alter_bd_color'		=> '#c8c9cc', //ok
			'alter_bd_hover'		=> '#bbbbbb',
			'alter_text'			=> '#6b6b6b',
			'alter_light'			=> '#dadada', //ok
			'alter_dark'			=> '#232a34',
			'alter_link'			=> '#ff3b18',
			'alter_hover'			=> '#00111a',

			// Input fields (form's fields and textarea)
			'input_bg_color'		=> '#ffffff', //ok
			'input_bg_hover'		=> '#ffffff', //ok
			'input_bd_color'		=> '#e8ebed', //ok
			'input_bd_hover'		=> '#919191', //ok
			'input_text'			=> '#919191', //ok
			'input_light'			=> '#dadada', //ok
			'input_dark'			=> '#00111a', //ok
			
			// Inverse blocks (text and links on accented bg)
			'inverse_text'			=> '#ffffff',
			'inverse_light'			=> '#ffffff',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#ffffff',
			'inverse_hover'			=> '#ffffff',

			// Additional accented colors (if used in the current theme)
			// For example:
			//'accent'				=> '3fb9be'
		
		)
	),

	// Color scheme: 'light'
	'light' => array(
		'title'	 => esc_html__('Light', 'frank-jewelry-store'),
		'colors' => array(
			
			// Whole block border and background
			'bg_color'				=> '#e7eef2',
			'bd_color'				=> '#dae1e5',

			// Text and links colors
			'text'					=> '#3f4346',
			'text_light'			=> '#a0b2be',
			'text_dark'				=> '#13162b',
			'text_link'				=> '#3fb9be',
			'text_hover'			=> '#13162b',

			// Alternative blocks (submenu, buttons, tabs, etc.)
			'alter_bg_color'		=> '#ffffff',
			'alter_bg_hover'		=> '#f7f7f7',
			'alter_bd_color'		=> '#f0f0f0',
			'alter_bd_hover'		=> '#e0e0e0',
			'alter_text'			=> '#3f4346',
			'alter_light'			=> '#a0b2be',
			'alter_dark'			=> '#13162b',
			'alter_link'			=> '#3fb9be',
			'alter_hover'			=> '#13162b',

			// Input fields (form's fields and textarea)
			'input_bg_color'		=> '#f4f9fc',
			'input_bg_hover'		=> '#ebf4fa',
			'input_bd_color'		=> '#f4f9fc',
			'input_bd_hover'		=> '#dae9f2',
			'input_text'			=> '#a0b2be',
			'input_light'			=> '#b6cad9',
			'input_dark'			=> '#8b9ba6',
			
			// Inverse blocks (text and links on accented bg)
			'inverse_text'			=> '#f0f0f0',
			'inverse_light'			=> '#f7f7f7',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#ffffff',
			'inverse_hover'			=> '#13162b',

			// Additional accented colors (if used in the current theme)
			// For example:
			//'accent'				=> '3fb9be'
		
		)
	),

	// Color scheme: 'side'
	'side' => array(
		'title'  => esc_html__('Side', 'frank-jewelry-store'),
		'colors' => array(
			
			// Whole block border and background
			'bg_color'				=> '#0d101f',
			'bd_color'				=> '#2b2e41',

			// Text and links colors
			'text'					=> '#969fa6',
			'text_light'			=> '#b8c3cc',
			'text_dark'				=> '#ffffff',
			'text_link'				=> '#3fb9be',
			'text_hover'			=> '#ffffff',

			// Alternative blocks (submenu, buttons, tabs, etc.)
			'alter_bg_color'		=> '#13162b',
			'alter_bg_hover'		=> '#1a1e3b',
			'alter_bd_color'		=> '#2b2e41',
			'alter_bd_hover'		=> '#32364d',
			'alter_text'			=> '#969fa6',
			'alter_light'			=> '#b8c3cc',
			'alter_dark'			=> '#ffffff',
			'alter_link'			=> '#3fb9be',
			'alter_hover'			=> '#ffffff',

			// Input fields (form's fields and textarea)
			'input_bg_color'		=> '#13162b',
			'input_bg_hover'		=> '#1a1e3b',
			'input_bd_color'		=> '#1a1e3b',
			'input_bd_hover'		=> '#1a1e3b',
			'input_text'			=> '#969fa6',
			'input_light'			=> '#b8c3cc',
			'input_dark'			=> '#ffffff',
			
			// Inverse blocks (text and links on accented bg)
			'inverse_text'			=> '#f0f0f0',
			'inverse_light'			=> '#f7f7f7',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#ffffff',
			'inverse_hover'			=> '#13162b',
		
			// Additional accented colors (if used in the current theme)
			// For example:
			//'accent'				=> '3fb9be'

		)
	),

	// Color scheme: 'dark'
	'dark' => array(
		'title'  => esc_html__('Dark', 'frank-jewelry-store'),
		'colors' => array(
			
			// Whole block border and background
			'bg_color'				=> '#000000', //ok
			'bd_color'				=> '#182730', //ok

			// Text and links colors
			'text'					=> '#919191', //ok
			'text_light'			=> '#a0a0a0',
			'text_dark'				=> '#ffffff', //ok
			'text_link'				=> '#ffffff', //ok
			'text_hover'			=> '#ff3b18', //ok

			// Alternative blocks (submenu, buttons, tabs, etc.)
			'alter_bg_color'		=> '#666666',
			'alter_bg_hover'		=> '#505050',
			'alter_bd_color'		=> '#3c4950', //ok
			'alter_bd_hover'		=> '#888888',
			'alter_text'			=> '#999999',
			'alter_light'			=> '#aaaaaa',
			'alter_dark'			=> '#d0d0d0',
			'alter_link'			=> '#ff3b18',
			'alter_hover'			=> '#29fbff',

			// Input fields (form's fields and textarea)
			'input_bg_color'		=> '#666666',
			'input_bg_hover'		=> '#505050',
			'input_bd_color'		=> '#909090',
			'input_bd_hover'		=> '#888888',
			'input_text'			=> '#999999',
			'input_light'			=> '#aaaaaa',
			'input_dark'			=> '#d0d0d0',
			
			// Inverse blocks (text and links on accented bg)
			'inverse_text'			=> '#f0f0f0',
			'inverse_light'			=> '#e0e0e0',
			'inverse_dark'			=> '#ffffff',
			'inverse_link'			=> '#00111a', //ok
			'inverse_hover'			=> '#e5e5e5',
		
			// Additional accented colors (if used in the current theme)
			// For example:
			//'accent'				=> '3fb9be'

		)
	)

));



// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('frank_jewelry_store_options_create')) {

	function frank_jewelry_store_options_create() {

		frank_jewelry_store_storage_set('options', array(
		
			// Section 'Title & Tagline' - add theme options in the standard WP section
			'title_tagline' => array(
				"title" => esc_html__('Title, Tagline & Site icon', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Specify site title and tagline (if need) and upload the site icon', 'frank-jewelry-store') ),
				"type" => "section"
				),
		
		
			// Section 'Header' - add theme options in the standard WP section
			'header_image' => array(
				"title" => esc_html__('Header', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select or upload logo images, select header type and widgets set for the header', 'frank-jewelry-store') ),
				"type" => "section"
				),

/*
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
				),
				"std" => 0,
//				"type" => "checkbox"
				"type" => "hidden"
				),
			'header_video' => array(
				"title" => esc_html__('Header video', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
				),
				"std" => '',
//				"type" => "video"
				"type" => "hidden"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Fullheight Header', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
				),
				"std" => 0,
//				"type" => "checkbox"
				"type" => "hidden"
				),
*/
			'header_top_panel' => array(
				"title" => esc_html__('Header Panel', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Show Header Top Panel', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
				),
				"std" => 0,
				"type" => "checkbox"
			),

			'header_style' => array(
				"title" => esc_html__('Header style', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
				),
				"std" => 'header-1',
				"options" => array(
					'header-1'	=> esc_html__('Header 1',	'frank-jewelry-store'),
					'header-2'	=> esc_html__('Header 2',	'frank-jewelry-store'),
					'header-hide'	=> esc_html__('Hide',	'frank-jewelry-store')
				),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
				),
				"std" => 'default',
				"options" => array(
					'default' => esc_html__('Default','frank-jewelry-store'),
					'over' => esc_html__('Over',	'frank-jewelry-store'),
					'under' => esc_html__('Under',	'frank-jewelry-store')
				),
				"type" => "select"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select color scheme to decorate header area', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
				),
				"std" => 'inherit',
				"options" => frank_jewelry_store_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'frank-jewelry-store')
				),
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select color scheme to decorate main menu area', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
				),
				"std" => 'inherit',
				"options" => frank_jewelry_store_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'menu_cache' => array(
				"title" => esc_html__('Use menu cache', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Use cache for the menu (increase theme speed, decrease queries number). Attention! Please, save menu again after change permalink settings!', 'frank-jewelry-store') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'menu_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'frank-jewelry-store') ),
				"std" => 1,
				"type" => "checkbox"
				),
			'search_style' => array(
				"title" => esc_html__('Search in the header', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select style of the search field in the header', 'frank-jewelry-store') ),
				"std" => 'fullscreen',
				"options" => array(
					'expand' => esc_html__('Expand', 'frank-jewelry-store'),
					'fullscreen' => esc_html__('Fullscreen', 'frank-jewelry-store')
				),
				"type" => "switch"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'frank-jewelry-store') ),
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
				),
				"dependency" => array(
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => frank_jewelry_store_get_list_range(0,6),
				"type" => "select"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'show_page_title' => array(
				"title" => esc_html__('Show Page Title', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Do you want to show page title area (page/post/category title and breadcrumbs)?', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'show_breadcrumbs' => array(
				"title" => esc_html__('Show breadcrumbs', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Do you want to show breadcrumbs in the page title area?', 'frank-jewelry-store') ),
				"std" => 1,
				"type" => "checkbox"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'frank-jewelry-store') ),
				"std" => '',
				"type" => "image",
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
					)
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'frank-jewelry-store') ),
				"std" => '',
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'frank-jewelry-store')
					),
				"type" => "image"
				),
			'header_title_image' => array(
				"title" => esc_html__('Header title image', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select image to insert into the Header "Style 2"', 'frank-jewelry-store') ),
				"std" => '',
				"type" => "hidden"
				),
			'header_title_text' => array(
				"title" => esc_html__('Header title text', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Put here text to insert into the Header "Style 2"', 'frank-jewelry-store') ),
				"std" => '',
				"type" => "hidden"
				),
			'mobile_layout_width' => array(
				"title" => esc_html__('Mobile layout from', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Window width to show mobile layout of the header', 'frank-jewelry-store') ),
				"std" => 959,
				"type" => "text"
				),
			
		
		
			// Section 'Content'
			'content' => array(
				"title" => esc_html__('Content', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Options for the content area', 'frank-jewelry-store') ),
				"type" => "section",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select width of the body content', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Content', 'frank-jewelry-store')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'frank-jewelry-store'),
					'wide'		=> esc_html__('Wide',		'frank-jewelry-store'),
					'fullwide'	=> esc_html__('Fullwide',	'frank-jewelry-store'),
					'fullscreen'=> esc_html__('Fullscreen',	'frank-jewelry-store')
				),
				"type" => "select"
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site. Attention! Case "Inherit" can be used only for custom pages, not for root site content in the Appearance - Customize', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'frank-jewelry-store')
				),
				"std" => 'default',
				"options" => frank_jewelry_store_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Content', 'frank-jewelry-store')
				),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Content', 'frank-jewelry-store')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'frank-jewelry-store') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'no_image' => array(
				"title" => esc_html__('No image placeholder', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select or upload image, used as placeholder for the posts without featured image', 'frank-jewelry-store') ),
				"std" => '',
				"type" => "image"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Widgets', 'frank-jewelry-store')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Color Scheme', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select color scheme to decorate sidebar', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Widgets', 'frank-jewelry-store')
				),
				"std" => 'inherit',
				"options" => frank_jewelry_store_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Widgets', 'frank-jewelry-store')
				),
				"refresh" => false,
				"std" => 'right',
				"options" => frank_jewelry_store_get_list_sidebars_positions(),
				"type" => "select"
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets above the page', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'frank-jewelry-store')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'frank-jewelry-store')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'frank-jewelry-store')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets below the page', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'frank-jewelry-store')
				),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
		
		
		
			// Section 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number for the site footer', 'frank-jewelry-store') ),
				"type" => "section"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Footer', 'frank-jewelry-store')
				),
				"std" => 'inherit',
				"options" => frank_jewelry_store_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Footer', 'frank-jewelry-store')
				),
				"std" => 'footer_widgets',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Footer', 'frank-jewelry-store')
				),
				"dependency" => array(
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => frank_jewelry_store_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Footer', 'frank-jewelry-store')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'image_in_footer' => array(
				"title" => esc_html__('Footer image', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select image to insert into the footer', 'frank-jewelry-store') ),
				"std" => '',
				"type" => "image",
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses',
					'section' => esc_html__('Footer', 'frank-jewelry-store')
					)
				),
			'hide_footer' => array(
				"title" => esc_html__('Hide footer', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Hide footer', 'frank-jewelry-store') ),
				'refresh' => false,
				"std" => 0,
				"type" => "checkbox",
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Footer', 'frank-jewelry-store')
				)
			),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'frank-jewelry-store') ),
				'refresh' => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'frank-jewelry-store') ),
				"dependency" => array(
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'frank-jewelry-store') ),
				"dependency" => array(
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'frank-jewelry-store') ),
				"std" => 0,
				"type" => "checkbox",
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Copyright text in the footer', 'frank-jewelry-store') ),
				"std" => esc_html__('{Y}. All rights reserved. Terms of use and Privacy Policy', 'frank-jewelry-store'),
				"refresh" => false,
				"type" => "textarea"
				),
		
		
		
			// Section 'Homepage' - settings for home page
			'homepage' => array(
				"title" => esc_html__('Homepage', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select blog style and widgets to display on the homepage', 'frank-jewelry-store') ),
				"type" => "section"
				),
			'expand_content_home' => array(
				"title" => esc_html__('Expand content', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the Homepage', 'frank-jewelry-store') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style_home' => array(
				"title" => esc_html__('Blog style', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select posts style for the homepage', 'frank-jewelry-store') ),
				"std" => 'excerpt',
				"options" => frank_jewelry_store_get_list_blog_styles(),
				"type" => "select"
				),
			'first_post_large_home' => array(
				"title" => esc_html__('First post large', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of the Homepage', 'frank-jewelry-store') ),
				"dependency" => array(
					'blog_style_home' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_widgets_home' => array(
				"title" => esc_html__('Header widgets', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the homepage', 'frank-jewelry-store') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_widgets_home' => array(
				"title" => esc_html__('Sidebar widgets', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select sidebar to show on the homepage', 'frank-jewelry-store') ),
				"std" => 'sidebar_widgets',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_position_home' => array(
				"title" => esc_html__('Sidebar position', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the homepage', 'frank-jewelry-store') ),
				"refresh" => false,
				"std" => 'right',
				"options" => frank_jewelry_store_get_list_sidebars_positions(),
				"type" => "select"
				),
			'widgets_above_page_home' => array(
				"title" => esc_html__('Widgets above the page', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'frank-jewelry-store') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_above_content_home' => array(
				"title" => esc_html__('Widgets above the content', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'frank-jewelry-store') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_content_home' => array(
				"title" => esc_html__('Widgets below the content', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'frank-jewelry-store') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_page_home' => array(
				"title" => esc_html__('Widgets below the page', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'frank-jewelry-store') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			
		
		
			// Section 'Blog archive'
			'blog' => array(
				"title" => esc_html__('Blog archive', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Options for the blog archive', 'frank-jewelry-store') ),
				"type" => "section",
				),
			'expand_content_blog' => array(
				"title" => esc_html__('Expand content', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the blog archive', 'frank-jewelry-store') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style' => array(
				"title" => esc_html__('Blog style', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select posts style for the blog archive', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'frank-jewelry-store')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"std" => 'excerpt',
				"options" => frank_jewelry_store_get_list_blog_styles(),
				"type" => "select"
				),
			'blog_columns' => array(
				"title" => esc_html__('Blog columns', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'frank-jewelry-store') ),
				"std" => 2,
				"options" => frank_jewelry_store_get_list_range(2,4),
				"type" => "hidden"
				),
			'post_type' => array(
				"title" => esc_html__('Post type', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'frank-jewelry-store')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"linked" => 'parent_cat',
				"refresh" => false,
				"hidden" => true,
				"std" => 'post',
				"options" => frank_jewelry_store_get_list_posts_types(),
				"type" => "select"
				),
			'parent_cat' => array(
				"title" => esc_html__('Category to show', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select category to show in the blog archive', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'frank-jewelry-store')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"refresh" => false,
				"hidden" => true,
				"std" => '0',
				"options" => frank_jewelry_store_array_merge(array(0 => esc_html__('- Select category -', 'frank-jewelry-store')), frank_jewelry_store_get_list_categories()),
				"type" => "select"
				),
			'posts_per_page' => array(
				"title" => esc_html__('Posts per page', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'frank-jewelry-store')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"hidden" => true,
				"std" => '10',
				"type" => "text"
				),
			"blog_pagination" => array( 
				"title" => esc_html__('Pagination style', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'frank-jewelry-store')
				),
				"std" => "links",
				"options" => array(
					'pages'	=> esc_html__("Page numbers", 'frank-jewelry-store'),
					'links'	=> esc_html__("Older/Newest", 'frank-jewelry-store'),
					'more'	=> esc_html__("Load more", 'frank-jewelry-store'),
					'infinite' => esc_html__("Infinite scroll", 'frank-jewelry-store')
				),
				"type" => "select"
				),
			'show_filters' => array(
				"title" => esc_html__('Show filters', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'frank-jewelry-store')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
					'blog_style' => array('portfolio', 'gallery')
				),
				"hidden" => true,
				"std" => 0,
				"type" => "checkbox"
				),
			'first_post_large' => array(
				"title" => esc_html__('First post large', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of blog archive', 'frank-jewelry-store') ),
				"dependency" => array(
					'blog_style' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			"blog_content" => array( 
				"title" => esc_html__('Posts content', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __("Show full post's content in the blog or only post's excerpt", 'frank-jewelry-store') ),
				"std" => "excerpt",
				"options" => array(
					'excerpt'	=> esc_html__('Excerpt',	'frank-jewelry-store'),
					'fullpost'	=> esc_html__('Full post',	'frank-jewelry-store')
				),
				"type" => "select"
				),
			'time_diff_before' => array(
				"title" => esc_html__('Time difference', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __("How many days show time difference instead post's date", 'frank-jewelry-store') ),
				"std" => 5,
				"type" => "text"
				),
			'related_posts' => array(
				"title" => esc_html__('Related posts', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('How many related posts should be displayed in the single post?', 'frank-jewelry-store') ),
				"std" => 2,
				"options" => frank_jewelry_store_get_list_range(2,4),
				"type" => "select"
				),
			"blog_animation" => array( 
				"title" => esc_html__('Animation for posts', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'frank-jewelry-store')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"std" => "none",
				"options" => frank_jewelry_store_get_list_animations_in(),
				"type" => "select"
				),
			"animation_on_mobile" => array( 
				"title" => esc_html__('Allow animation on mobile', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Allow extended animation effects on mobile devices', 'frank-jewelry-store') ),
				"std" => 'yes',
				"dependency" => array(
					'blog_animation' => array('^none')
				),
				"options" => frank_jewelry_store_get_list_yesno(),
				"type" => "switch"
				),
			'header_widgets_blog' => array(
				"title" => esc_html__('Header widgets', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the blog archive', 'frank-jewelry-store') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_widgets_blog' => array(
				"title" => esc_html__('Sidebar widgets', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select sidebar to show on the blog archive', 'frank-jewelry-store') ),
				"std" => 'sidebar_widgets',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'sidebar_position_blog' => array(
				"title" => esc_html__('Sidebar position', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the blog archive', 'frank-jewelry-store') ),
				"refresh" => false,
				"std" => 'right',
				"options" => frank_jewelry_store_get_list_sidebars_positions(),
				"type" => "select"
				),
			'widgets_above_page_blog' => array(
				"title" => esc_html__('Widgets above the page', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'frank-jewelry-store') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_above_content_blog' => array(
				"title" => esc_html__('Widgets above the content', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'frank-jewelry-store') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_content_blog' => array(
				"title" => esc_html__('Widgets below the content', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'frank-jewelry-store') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			'widgets_below_page_blog' => array(
				"title" => esc_html__('Widgets below the page', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'frank-jewelry-store') ),
				"std" => 'hide',
				"options" => array_merge(array('hide'=>esc_html__('- Select widgets -', 'frank-jewelry-store')), frank_jewelry_store_get_list_sidebars()),
				"type" => "select"
				),
			
		
		
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('* Color scheme editor', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __("<b>Simple settings</b> - you can change only accented color, used for links, buttons and some accented areas.", 'frank-jewelry-store') )
						. '<br>'
						. wp_kses_data( __("<b>Advanced settings</b> - change all scheme's colors and get full control over the appearance of your site!", 'frank-jewelry-store') ),
				"priority" => 1000,
				"type" => "section"
				),
		
			'color_settings' => array(
				"title" => esc_html__('Color settings', 'frank-jewelry-store'),
				"desc" => '',
				"std" => 'simple',
				"options" => array(
					"simple"  => esc_html__("Simple", 'frank-jewelry-store'),
					"advanced" => esc_html__("Advanced", 'frank-jewelry-store')
				),
				"refresh" => false,
				"type" => "switch"
				),
		
			'color_scheme_editor' => array(
				"title" => esc_html__('Color Scheme', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Select color scheme to edit colors', 'frank-jewelry-store') ),
				"std" => 'default',
				"options" => frank_jewelry_store_get_list_schemes(),
				"refresh" => false,
				"type" => "select"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Colors storage', 'frank-jewelry-store'),
				"desc" => esc_html__('Hidden storage of the all color from the all color shemes (only for internal usage)', 'frank-jewelry-store'),
				"std" => '',
				"refresh" => false,
				"type" => "hidden"
				),
		
			'scheme_info_single' => array(
				"title" => esc_html__('Colors for single post/page', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Specify colors for single post/page (not for alter blocks)', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
				
			'bg_color' => array(
				"title" => esc_html__('Background color', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Background color of the whole page', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'bd_color' => array(
				"title" => esc_html__('Border color', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the bordered elements, separators, etc.', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'text' => array(
				"title" => esc_html__('Text', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Plain text color on single page/post', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_light' => array(
				"title" => esc_html__('Light text', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the post meta: post date and author, comments number, etc.', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_dark' => array(
				"title" => esc_html__('Dark text', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the headers, strong text, etc.', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_link' => array(
				"title" => esc_html__('Links', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of links and accented areas', 'frank-jewelry-store') ),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_hover' => array(
				"title" => esc_html__('Links hover', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Hover color for links and accented areas', 'frank-jewelry-store') ),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_alter' => array(
				"title" => esc_html__('Colors for alternative blocks', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Specify colors for alternative blocks - rectangular blocks with its own background color (posts in homepage, blog archive, search results, widgets on sidebar, footer, etc.)', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'alter_bg_color' => array(
				"title" => esc_html__('Alter background color', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Background color of the alternative blocks', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bg_hover' => array(
				"title" => esc_html__('Alter hovered background color', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Background color for the hovered state of the alternative blocks', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_color' => array(
				"title" => esc_html__('Alternative border color', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Border color of the alternative blocks', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_hover' => array(
				"title" => esc_html__('Alternative hovered border color', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Border color for the hovered state of the alter blocks', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_text' => array(
				"title" => esc_html__('Alter text', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Text color of the alternative blocks', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_light' => array(
				"title" => esc_html__('Alter light', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with alternative background', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_dark' => array(
				"title" => esc_html__('Alter dark', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the headers inside block with alternative background', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_link' => array(
				"title" => esc_html__('Alter link', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the links inside block with alternative background', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_hover' => array(
				"title" => esc_html__('Alter hover', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with alternative background', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_input' => array(
				"title" => esc_html__('Colors for the form fields', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Specify colors for the form fields and textareas', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'input_bg_color' => array(
				"title" => esc_html__('Inactive background', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Background color of the inactive form fields', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bg_hover' => array(
				"title" => esc_html__('Active background', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Background color of the focused form fields', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_color' => array(
				"title" => esc_html__('Inactive border', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the border in the inactive form fields', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_hover' => array(
				"title" => esc_html__('Active border', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the border in the focused form fields', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_text' => array(
				"title" => esc_html__('Inactive field', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the text in the inactive fields', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_light' => array(
				"title" => esc_html__('Disabled field', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the disabled field', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_dark' => array(
				"title" => esc_html__('Active field', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the active field', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_inverse' => array(
				"title" => esc_html__('Colors for inverse blocks', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Specify colors for inverse blocks, rectangular blocks with background color equal to the links color or one of accented colors (if used in the current theme)', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'inverse_text' => array(
				"title" => esc_html__('Inverse text', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the text inside block with accented background', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_light' => array(
				"title" => esc_html__('Inverse light', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with accented background', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_dark' => array(
				"title" => esc_html__('Inverse dark', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the headers inside block with accented background', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_link' => array(
				"title" => esc_html__('Inverse link', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the links inside block with accented background', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_hover' => array(
				"title" => esc_html__('Inverse hover', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with accented background', 'frank-jewelry-store') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$frank_jewelry_store_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),


			// Section 'Hidden' - internal options
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),
			'media_title' => array(
				"title" => esc_html__('Media title', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'frank-jewelry-store')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'frank-jewelry-store') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'frank-jewelry-store')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// Panel 'Fonts' - manage fonts loading and set parameters of the base theme elements
			'fonts' => array(
				"title" => esc_html__('* Fonts settings', 'frank-jewelry-store'),
				"desc" => '',
				"priority" => 1500,
				"type" => "panel"
				),

			// Section 'Load_fonts'
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'frank-jewelry-store') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'frank-jewelry-store') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'frank-jewelry-store'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'frank-jewelry-store') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'frank-jewelry-store') ),
				"refresh" => false,
				"std" => '$frank_jewelry_store_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=frank_jewelry_store_get_theme_setting('max_load_fonts'); $i++) {
			$fonts["load_fonts-{$i}-info"] = array(
				"title" => esc_html(sprintf(__('Font %s', 'frank-jewelry-store'), $i)),
				"desc" => '',
				"type" => "info",
				);
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'frank-jewelry-store'),
				"desc" => '',
				"refresh" => false,
				"std" => '$frank_jewelry_store_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'frank-jewelry-store'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'frank-jewelry-store') )
							: '',
				"refresh" => false,
				"std" => '$frank_jewelry_store_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'frank-jewelry-store'),
					'serif' => esc_html__('serif', 'frank-jewelry-store'),
					'sans-serif' => esc_html__('sans-serif', 'frank-jewelry-store'),
					'monospace' => esc_html__('monospace', 'frank-jewelry-store'),
					'cursive' => esc_html__('cursive', 'frank-jewelry-store'),
					'fantasy' => esc_html__('fantasy', 'frank-jewelry-store')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'frank-jewelry-store'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'frank-jewelry-store') )
											. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'frank-jewelry-store') )
							: '',
				"refresh" => false,
				"std" => '$frank_jewelry_store_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Sections with font's attributes for each theme element
		$theme_fonts = frank_jewelry_store_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(__('%s settings', 'frank-jewelry-store'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'frank-jewelry-store'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = frank_jewelry_store_get_list_load_fonts(true);
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'frank-jewelry-store'),
						'100' => esc_html__('100 (Light)', 'frank-jewelry-store'), 
						'200' => esc_html__('200 (Light)', 'frank-jewelry-store'), 
						'300' => esc_html__('300 (Thin)',  'frank-jewelry-store'),
						'400' => esc_html__('400 (Normal)', 'frank-jewelry-store'),
						'500' => esc_html__('500 (Semibold)', 'frank-jewelry-store'),
						'600' => esc_html__('600 (Semibold)', 'frank-jewelry-store'),
						'700' => esc_html__('700 (Bold)', 'frank-jewelry-store'),
						'800' => esc_html__('800 (Black)', 'frank-jewelry-store'),
						'900' => esc_html__('900 (Black)', 'frank-jewelry-store')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'frank-jewelry-store'),
						'normal' => esc_html__('Normal', 'frank-jewelry-store'), 
						'italic' => esc_html__('Italic', 'frank-jewelry-store')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'frank-jewelry-store'),
						'none' => esc_html__('None', 'frank-jewelry-store'), 
						'underline' => esc_html__('Underline', 'frank-jewelry-store'),
						'overline' => esc_html__('Overline', 'frank-jewelry-store'),
						'line-through' => esc_html__('Line-through', 'frank-jewelry-store')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'frank-jewelry-store'),
						'none' => esc_html__('None', 'frank-jewelry-store'), 
						'uppercase' => esc_html__('Uppercase', 'frank-jewelry-store'),
						'lowercase' => esc_html__('Lowercase', 'frank-jewelry-store'),
						'capitalize' => esc_html__('Capitalize', 'frank-jewelry-store')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"refresh" => false,
					"std" => '$frank_jewelry_store_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters into Theme Options
		frank_jewelry_store_storage_merge_array('options', '', $fonts);
	}
}




// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('frank_jewelry_store_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'frank_jewelry_store_options_theme_setup2', 2 );
	function frank_jewelry_store_options_theme_setup2() {
		frank_jewelry_store_options_create();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('frank_jewelry_store_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'frank_jewelry_store_options_theme_setup5', 5 );
	function frank_jewelry_store_options_theme_setup5() {
		frank_jewelry_store_storage_set('options_reloaded', false);
		frank_jewelry_store_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('frank_jewelry_store_load_custom_options')) {
		add_action( 'wp_loaded', 'frank_jewelry_store_load_custom_options' );
		function frank_jewelry_store_load_custom_options() {
			if (!frank_jewelry_store_storage_get('options_reloaded')) {
				frank_jewelry_store_storage_set('options_reloaded', true);
				frank_jewelry_store_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('frank_jewelry_store_load_theme_options') ) {
	function frank_jewelry_store_load_theme_options() {
		$options = frank_jewelry_store_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				if (strpos($v['std'], '$frank_jewelry_store_')!==false) {
					$func = substr($v['std'], 1);
					if (function_exists($func)) {
						$v['std'] = $func($k);
					}
				}
				$value = $v['std'];
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = $_GET[$k];
					else {
						$tmp = get_theme_mod($k, -987654321);
						if ($tmp != -987654321) $value = $tmp;
					}
				}
				frank_jewelry_store_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			frank_jewelry_store_customizer_save_css();
		} else {
			do_action('frank_jewelry_store_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('frank_jewelry_store_override_theme_options') ) {
	add_action( 'wp', 'frank_jewelry_store_override_theme_options', 1 );
	function frank_jewelry_store_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			frank_jewelry_store_storage_set('blog_archive', true);
			frank_jewelry_store_storage_set('blog_template', get_the_ID());
		}
		frank_jewelry_store_storage_set('blog_mode', frank_jewelry_store_detect_blog_mode());
		if (is_singular()) {
			frank_jewelry_store_storage_set('options_meta', get_post_meta(get_the_ID(), 'frank_jewelry_store_options', true));
		}
	}
}


// Return customizable option value
if (!function_exists('frank_jewelry_store_get_theme_option')) {
	function frank_jewelry_store_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;
		if ($post_id > 0) {
			if (!frank_jewelry_store_storage_isset('post_options_meta', $post_id))
				frank_jewelry_store_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'frank_jewelry_store_options', true));
			if (frank_jewelry_store_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = frank_jewelry_store_storage_get_array('post_options_meta', $post_id, $name);
				if (!frank_jewelry_store_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}
		if (!$from_post_meta && frank_jewelry_store_storage_isset('options')) {
			if ( !frank_jewelry_store_storage_isset('options', $name) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						$s = debug_backtrace();
						//array_shift($s);
						$s = array_shift($s);
						echo '<pre>' . sprintf(esc_html__('Undefined option "%s" called from:', 'frank-jewelry-store'), $name);
						if (function_exists('dco')) dco($s);
						else print_r($s);
						echo '</pre>';
						die();
					} else
						$rez = $defa;
				}
			} else {
				$blog_mode = frank_jewelry_store_storage_get('blog_mode');
				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = $_REQUEST[$name . '_' . $blog_mode];
				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = $_REQUEST[$name];
				// Override option from current page settings (if exists)
				} else if (frank_jewelry_store_storage_isset('options_meta', $name) && !frank_jewelry_store_is_inherit(frank_jewelry_store_storage_get_array('options_meta', $name))) {
					$rez = frank_jewelry_store_storage_get_array('options_meta', $name);
				// Override option from current blog mode settings: 'home', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && frank_jewelry_store_storage_isset('options', $name . '_' . $blog_mode, 'val') && !frank_jewelry_store_is_inherit(frank_jewelry_store_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = frank_jewelry_store_storage_get_array('options', $name . '_' . $blog_mode, 'val');
				// Get saved option value
				} else if (frank_jewelry_store_storage_isset('options', $name, 'val')) {
					$rez = frank_jewelry_store_storage_get_array('options', $name, 'val');
				// Get ThemeREX Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);
				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('frank_jewelry_store_check_theme_option')) {
	function frank_jewelry_store_check_theme_option($name) {
		return frank_jewelry_store_storage_isset('options', $name);
	}
}

// Get dependencies list from the Theme Options
if ( !function_exists('frank_jewelry_store_get_theme_dependencies') ) {
	function frank_jewelry_store_get_theme_dependencies() {
		$options = frank_jewelry_store_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}

// Return internal theme setting value
if (!function_exists('frank_jewelry_store_get_theme_setting')) {
	function frank_jewelry_store_get_theme_setting($name) {
		return frank_jewelry_store_storage_isset('settings', $name) ? frank_jewelry_store_storage_get_array('settings', $name) : false;
	}
}


// Set theme setting
if ( !function_exists( 'frank_jewelry_store_set_theme_setting' ) ) {
	function frank_jewelry_store_set_theme_setting($option_name, $value) {
		if (frank_jewelry_store_storage_isset('settings', $option_name))
			frank_jewelry_store_storage_set_array('settings', $option_name, $value);
	}
}
?>