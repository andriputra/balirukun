<?php
/**
 * Generate custom CSS
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */


			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('frank_jewelry_store_customizer_add_theme_colors')) {
	function frank_jewelry_store_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = frank_jewelry_store_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = frank_jewelry_store_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = frank_jewelry_store_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = frank_jewelry_store_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['alter_bg_color_07']  = frank_jewelry_store_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = frank_jewelry_store_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = frank_jewelry_store_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = frank_jewelry_store_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['text_dark_07']  = frank_jewelry_store_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = frank_jewelry_store_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = frank_jewelry_store_hex2rgba( $colors['text_link'], 0.7 );
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('frank_jewelry_store_customizer_add_theme_fonts')) {
	function frank_jewelry_store_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !frank_jewelry_store_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !frank_jewelry_store_is_inherit($font['font-size'])
														? 'font-size:' . frank_jewelry_store_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !frank_jewelry_store_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !frank_jewelry_store_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !frank_jewelry_store_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !frank_jewelry_store_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !frank_jewelry_store_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !frank_jewelry_store_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !frank_jewelry_store_is_inherit($font['margin-top'])
														? 'margin-top:' . frank_jewelry_store_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !frank_jewelry_store_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . frank_jewelry_store_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}


// Return CSS with custom colors and fonts
if (!function_exists('frank_jewelry_store_customizer_get_css')) {

	function frank_jewelry_store_customizer_get_css($colors=null, $fonts=null, $minify=true, $only_scheme='') {

		$css = array(
			'fonts' => '',
			'colors' => ''
		);
		
		// Prepare fonts
		if ($fonts === null) {
			$fonts = frank_jewelry_store_get_theme_fonts();
		}
		
		if ($fonts) {

			// Make theme-specific fonts rules
			$fonts = frank_jewelry_store_customizer_add_theme_fonts($fonts);

			$rez = array();
			$rez['fonts'] = <<<CSS

body {
	{$fonts['p_font-family']}
	{$fonts['p_font-size']}
	{$fonts['p_font-weight']}
	{$fonts['p_font-style']}
	{$fonts['p_line-height']}
	{$fonts['p_text-decoration']}
	{$fonts['p_text-transform']}
	{$fonts['p_letter-spacing']}
}
p, ul, ol, dl, blockquote, address {
	{$fonts['p_margin-top']}
	{$fonts['p_margin-bottom']}
}

h1 {
	{$fonts['h1_font-family']}
	{$fonts['h1_font-size']}
	{$fonts['h1_font-weight']}
	{$fonts['h1_font-style']}
	{$fonts['h1_line-height']}
	{$fonts['h1_text-decoration']}
	{$fonts['h1_text-transform']}
	{$fonts['h1_letter-spacing']}
	{$fonts['h1_margin-top']}
	{$fonts['h1_margin-bottom']}
}
h2 {
	{$fonts['h2_font-family']}
	{$fonts['h2_font-size']}
	{$fonts['h2_font-weight']}
	{$fonts['h2_font-style']}
	{$fonts['h2_line-height']}
	{$fonts['h2_text-decoration']}
	{$fonts['h2_text-transform']}
	{$fonts['h2_letter-spacing']}
	{$fonts['h2_margin-top']}
	{$fonts['h2_margin-bottom']}
}
h3 {
	{$fonts['h3_font-family']}
	{$fonts['h3_font-size']}
	{$fonts['h3_font-weight']}
	{$fonts['h3_font-style']}
	{$fonts['h3_line-height']}
	{$fonts['h3_text-decoration']}
	{$fonts['h3_text-transform']}
	{$fonts['h3_letter-spacing']}
	{$fonts['h3_margin-top']}
	{$fonts['h3_margin-bottom']}
}
h4 {
	{$fonts['h4_font-family']}
	{$fonts['h4_font-size']}
	{$fonts['h4_font-weight']}
	{$fonts['h4_font-style']}
	{$fonts['h4_line-height']}
	{$fonts['h4_text-decoration']}
	{$fonts['h4_text-transform']}
	{$fonts['h4_letter-spacing']}
	{$fonts['h4_margin-top']}
	{$fonts['h4_margin-bottom']}
}
h5 {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-size']}
	{$fonts['h5_font-weight']}
	{$fonts['h5_font-style']}
	{$fonts['h5_line-height']}
	{$fonts['h5_text-decoration']}
	{$fonts['h5_text-transform']}
	{$fonts['h5_letter-spacing']}
	{$fonts['h5_margin-top']}
	{$fonts['h5_margin-bottom']}
}
h6 {
	{$fonts['h6_font-family']}
	{$fonts['h6_font-size']}
	{$fonts['h6_font-weight']}
	{$fonts['h6_font-style']}
	{$fonts['h6_line-height']}
	{$fonts['h6_text-decoration']}
	{$fonts['h6_text-transform']}
	{$fonts['h6_letter-spacing']}
	{$fonts['h6_margin-top']}
	{$fonts['h6_margin-bottom']}
}

input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="search"],
input[type="password"],
textarea,
textarea.wp-editor-area,
.select_container,
select,
.select_container select {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}

button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.gallery_preview_show .post_readmore,
.more-link,
.sc_button,
.frank_jewelry_store_tabs .frank_jewelry_store_tabs_titles li a {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}

.top_panel .slider_engine_revo .slide_title {
	{$fonts['h1_font-family']}
}

blockquote,
mark, ins,
.logo_text,
.top_panel_title_2_text,
.post_price.price,
.theme_scroll_down {
	{$fonts['h5_font-family']}
}

.post_meta {
	{$fonts['info_font-family']}
	{$fonts['info_font-size']}
	{$fonts['info_font-weight']}
	{$fonts['info_font-style']}
	{$fonts['info_line-height']}
	{$fonts['info_text-decoration']}
	{$fonts['info_text-transform']}
	{$fonts['info_letter-spacing']}
	{$fonts['info_margin-top']}
	{$fonts['info_margin-bottom']}
}

em, i,
.post-date, .rss-date 
.post_date, .post_meta_item, .post_counters_item,
.comments_list_wrap .comment_date,
.comments_list_wrap .comment_time,
.comments_list_wrap .comment_counters,
.top_panel .slider_engine_revo .slide_subtitle,
.logo_slogan,
fieldset legend,
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd,
.format-audio .post_featured .post_audio_author,
.post_item_single .post_content .post_meta,
.author_bio .author_link,
.comments_list_wrap .comment_posted,
.comments_list_wrap .comment_reply {
	{$fonts['info_font-family']}
}
.search_wrap .post_meta_item,
.search_wrap .post_counters_item {
	{$fonts['p_font-family']}
}

blockquote a,
blockquote cite {
	{$fonts['h1_font-family']}
}

.logo_text {
	{$fonts['logo_font-family']}
	{$fonts['logo_font-size']}
	{$fonts['logo_font-weight']}
	{$fonts['logo_font-style']}
	{$fonts['logo_line-height']}
	{$fonts['logo_text-decoration']}
	{$fonts['logo_text-transform']}
	{$fonts['logo_letter-spacing']}
}
.logo_footer_text {
	{$fonts['logo_font-family']}
}

.menu_main_nav_area,
.menu_header_nav_area {
	{$fonts['menu_font-size']}
	{$fonts['menu_line-height']}
}
.menu_main_nav > li,
.menu_main_nav > li > a,
.menu_header_nav > li,
.menu_header_nav > li > a {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_text-decoration']}
	{$fonts['menu_text-transform']}
	{$fonts['menu_letter-spacing']}
}
.menu_mobile .menu_mobile_nav_area > ul > li,
.menu_mobile .menu_mobile_nav_area > ul > li > a {
	{$fonts['menu_font-family']}
}

.menu_main_nav > li li {}
.menu_main_nav > li li > a {
	{$fonts['submenu_font-family']}
	{$fonts['submenu_font-size']}
	{$fonts['submenu_font-weight']}
	{$fonts['submenu_font-style']}
	{$fonts['submenu_line-height']}
	{$fonts['submenu_text-decoration']}
	{$fonts['submenu_text-transform']}
	{$fonts['submenu_letter-spacing']}
}
.menu_mobile .menu_mobile_nav_area > ul > li li,
.menu_mobile .menu_mobile_nav_area > ul > li li > a {
	{$fonts['submenu_font-family']}
}

.menu_footer_nav_area ul li {
	{$fonts['menu_font-family']}
}

.format-audio .post_featured .post_audio_author,
.format-audio .post_featured .post_audio_title,
.related_wrap .post_title,
.trx_addons_testimonial_item,
.trx_addons_price_block,
.trx_addons_audio .trx_addons_audio_title,
.trx_addons_audio .trx_addons_audio_author_name,
.trx_addons_skills_pie.trx_addons_skills_compact_off .trx_addons_skills_total,
.trx_addons_skills_counter .trx_addons_skills_item .trx_addons_skills_count,
.trx_addons_skills_counter .trx_addons_skills_item .trx_addons_skills_info,
.trx_addons_skills_bar .trx_addons_skills_total,
.trx_addons_skills_bar .trx_addons_skills_info,
figure figcaption,
.trx_addons_image figcaption,
blockquote,
.trx_addons_dropcap {
	{$fonts['h1_font-family']}
}


h1 em, h2 em, h3 em, h4 em, h5 em {
	{$fonts['h1_font-family']}
}


CSS;
			$rez = apply_filters('frank_jewelry_store_filter_get_css', $rez, false, $fonts, false);
			$css['fonts'] = $rez['fonts'];
		}

		if ($colors !== false) {
			$schemes = empty($only_scheme) ? array_keys(frank_jewelry_store_get_list_schemes()) : array($only_scheme);
	
			if (count($schemes) > 0) {
				$rez = array();
				foreach ($schemes as $scheme) {
					// Prepare colors
					if (empty($only_scheme)) $colors = frank_jewelry_store_get_scheme_colors($scheme);
	
					// Make theme-specific colors and tints
					$colors = frank_jewelry_store_customizer_add_theme_colors($colors);
			
					// Make styles
					$rez['colors'] = <<<CSS

/* Common tags */
h1, h2, h3, h4, h5, h6,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
li a {
	color: {$colors['text_dark']};
}
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
li a:hover {
	color: {$colors['text_hover']};
}

dt, b, strong, i, em, mark, ins {	
	color: {$colors['text_dark']};
}
s, strike, del {	
	color: {$colors['text_light']};
}

a {
	color: {$colors['text_link']};
}
a:hover {
	color: {$colors['text_hover']};
}

blockquote {
	color: {$colors['text_dark']};
}
blockquote:before,
blockquote cite,
blockquote a {
	color: {$colors['text_hover']};
}
blockquote a:hover {
	color: {$colors['text_link']};
}
table td, table th {
	color: {$colors['text']};
	border-color: {$colors['bd_color']};
}
table th {
	color: {$colors['text_dark']};
}
table th a:hover {
	color: {$colors['text_hover']};
}
.sc_table table tr td:first-child  {
	color: {$colors['text_link']};
}

hr {
	border-color: {$colors['bd_color']};
}
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd {
	background-color: {$colors['text_link']};
	color: {$colors['text']};
}
figure figcaption a,
.wp-caption .wp-caption-text a,
.wp-caption-overlay .wp-caption .wp-caption-text a{
	color: {$colors['inverse_text']};
}
ul > li:before {
	color: {$colors['text_link']};
}


/* Form fields */
fieldset {
	border-color: {$colors['bd_color']};
}
fieldset legend {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}
input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="search"],
input[type="password"],
.widget_search form,
.select_container,
.select_container:before,
.select2-container .select2-choice,
textarea,
textarea.wp-editor-area {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}
.select_container select {
	color: {$colors['input_text']};
}
input[type="text"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
input[type="search"]:focus,
input[type="password"]:focus,
.select_container:hover,
.select_container:hover:before,
select option:hover,
select option:focus,
.select2-container .select2-choice:hover,
textarea:focus,
textarea.wp-editor-area:focus {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
	background-color: {$colors['input_bg_hover']};
}
.select_container select:focus {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
}
.select_container:after {
	color: {$colors['input_light']};
}
.select_container:hover:after {
	color: {$colors['input_dark']};
}
.widget_search form:hover:after {
	color: {$colors['input_dark']};
}
input::-webkit-input-placeholder,
textarea::-webkit-input-placeholder {
	color: {$colors['input_light']};
}
input[type="radio"] + label:before,
input[type="checkbox"] + label:before {
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}
button,
input[type="reset"],
input[type="submit"],
input[type="button"] {
	border-color: {$colors['text_hover']};
	background-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}
input[type="submit"]:hover,
input[type="reset"]:hover,
input[type="button"]:hover,
button:hover,
input[type="submit"]:focus,
input[type="reset"]:focus,
input[type="button"]:focus,
button:focus {
	border-color: {$colors['text_link']};
	background-color: {$colors['inverse_link']};
	color: {$colors['text_link']};
}
.wp-editor-container input[type="button"] {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_dark']};
	-webkit-box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};
	   -moz-box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};
			box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};	
}
.wp-editor-container input[type="button"]:hover,
.wp-editor-container input[type="button"]:focus {
	background-color: {$colors['alter_bg_hover']};
	border-color: {$colors['alter_bd_hover']};
	color: {$colors['alter_link']};
}

.select2-results {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_hover']};
	background: {$colors['input_bg_color']};
}
.select2-results .select2-highlighted {
	color: {$colors['input_dark']};
	background: {$colors['input_bg_hover']};
}


/* WP Standard classes */
.sticky {
	border-color: {$colors['bd_color']};
}
.sticky .label_sticky {
	border-top-color: {$colors['text_link']};
}
	

/* Page */
body {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}
#page_preloader,
.scheme_self.header_position_under .page_content_wrap,
.page_wrap {
	background-color: {$colors['bg_color']};
}
.preloader_wrap > div {
	background-color: {$colors['text_link']};
}

/* Header */
.scheme_self.top_panel.with_bg_image:before {
	background-color: {$colors['bg_color_07']};
}
.top_panel .slider_engine_revo .slide_subtitle {
	color: {$colors['text_link']};
}

/* Logo */
.logo b {
	color: {$colors['text_dark']};
}
.logo i {
	color: {$colors['text_link']};
}
.logo_text {
	color: {$colors['text_link']};
}
.logo:hover .logo_text {
	color: {$colors['text_dark']};
}
.logo_slogan {
	color: {$colors['text']};
}

/* Social items */
.socials_wrap .social_item a,
.socials_wrap .social_item a i {
	color: {$colors['text_light']};
}
.socials_wrap .social_item a:hover,
.socials_wrap .social_item a:hover i {
	color: {$colors['text_dark']};
}

/* Search */
.search_wrap .search_field {
	color: {$colors['text']};
}
.search_wrap .search_field:focus {
	color: {$colors['text_dark']};
}
.search_wrap .search_submit {
	color: {$colors['alter_light']};
}
.search_wrap .search_submit:hover,
.search_wrap .search_submit:focus {
	color: {$colors['text_hover']};
}

.post_item_none_search .search_wrap .search_submit:hover, .post_item_none_search .search_wrap .search_submit:focus,
.post_item_none_archive .search_wrap .search_submit:hover, .post_item_none_archive .search_wrap .search_submit:focus {
	color: {$colors['text_link']};
	background-color: transparent;
}


/* Search style 'Expand' */
.search_style_expand.search_opened {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.search_style_expand.search_opened .search_submit {
	color: {$colors['text']};
}
.search_style_expand .search_submit:hover,
.search_style_expand .search_submit:focus {
	color: {$colors['text_hover']};
}

/* Search style 'Fullscreen' */
.search_style_fullscreen.search_opened .search_form_wrap {
	background-color: rgba(255,255,255,0.97);
}
.search_style_fullscreen.search_opened .search_form {
	border-color: {$colors['text_dark']};
}
.search_style_fullscreen.search_opened .search_close,
.search_style_fullscreen.search_opened .search_field,
.search_style_fullscreen.search_opened .search_submit {
	color: {$colors['input_dark']};
}
.search_style_fullscreen.search_opened .search_close:hover,
.search_style_fullscreen.search_opened .search_field:hover,
.search_style_fullscreen.search_opened .search_field:focus,
.search_style_fullscreen.search_opened .search_submit:hover,
.search_style_fullscreen.search_opened .search_submit:focus {
	color: {$colors['input_text']};
}
.search_style_fullscreen.search_opened input::-webkit-input-placeholder {color:{$colors['input_light']}; opacity: 1;}
.search_style_fullscreen.search_opened input::-moz-placeholder          {color:{$colors['input_light']}; opacity: 1;}/* Firefox 19+ */
.search_style_fullscreen.search_opened input:-moz-placeholder           {color:{$colors['input_light']}; opacity: 1;}/* Firefox 18- */
.search_style_fullscreen.search_opened input:-ms-input-placeholder      {color:{$colors['input_light']}; opacity: 1;}

/* Search results */
.search_wrap .search_results {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.search_wrap .search_results:after {
	background-color: {$colors['bg_color']};
	border-left-color: {$colors['bd_color']};
	border-top-color: {$colors['bd_color']};
}
.search_wrap .search_results .search_results_close {
	color: {$colors['text_light']};
}
.search_wrap .search_results .search_results_close:hover {
	color: {$colors['text_dark']};
}
.search_results.widget_area .post_item + .post_item {
	border-top-color: {$colors['bd_color']};
}


/* Main menu */


.menu_main_nav > li + li:before {
	border-color: {$colors['alter_bd_color']};
}
.menu_main_nav > li > a:before {
    background-color: {$colors['text_hover']} !important;
}
.menu_header_nav > li > a,
.menu_main_nav > li > a {
	color: {$colors['text_link']};
}

.menu_header_nav > li.current-menu-item > a,
.menu_header_nav > li.current-menu-parent > a,
.menu_header_nav > li.current-menu-ancestor > a,
.menu_main_nav > li.current-menu-item > a,
.menu_main_nav > li.current-menu-parent > a,
.menu_main_nav > li.current-menu-ancestor > a {
	color: {$colors['text_link']};
}

.menu_header_nav > li > a:hover,
.menu_header_nav > li.sfHover > a,
.menu_main_nav > li > a:hover,
.menu_main_nav > li.sfHover > a {
	color: {$colors['text_hover']};
}

.menu_main_nav > li.current-menu-item.sfHover > a,
.menu_main_nav > li.current-menu-parent.sfHover > a,
.menu_main_nav > li.current-menu-ancestor.sfHover > a,
.menu_main_nav > li.current-menu-item > a:hover,
.menu_main_nav > li.current-menu-parent > a:hover,
.menu_main_nav > li.current-menu-ancestor > a:hover {
	color: {$colors['text_link']};
}

/* Submenu */
.menu_main_nav > li ul {
	color: {$colors['text']};
	border-color: {$colors['text_hover']};
	background-color: {$colors['text_hover']};
}




.menu_main_nav > li ul li a:hover,
.menu_main_nav > li ul li.current-menu-item > a,
.menu_main_nav > li ul li.current-menu-ancestor > a {

}

.menu_main_nav > li.current-menu-item.sfHover > a,
.menu_main_nav > li.current-menu-parent.sfHover > a,
.menu_main_nav > li.current-menu-ancestor.sfHover > a,
.menu_main_nav > li.current-menu-item > a:hover,
.menu_main_nav > li.current-menu-parent > a:hover,
.menu_main_nav > li.current-menu-ancestor > a:hover {
	color: {$colors['text_link']};
}

.menu_main_nav > li li > a {
	color: {$colors['inverse_text']};
}
.menu_main_nav > li li > a:hover,
.menu_main_nav > li li.sfHover > a {

}

.menu_main_nav > li li.current-menu-item > a,
.menu_main_nav > li li.current-menu-parent > a,
.menu_main_nav > li li.current-menu-ancestor > a {

}
.menu_main_nav > li li[class*="icon-"]:before {
	color: {$colors['text']};
}
.menu_main_nav > li li[class*="icon-"]:hover:before,
.menu_main_nav > li li[class*="icon-"].shHover:before,
.menu_main_nav > li li.current-menu-item:before,
.menu_main_nav > li li.current-menu-parent:before,
.menu_main_nav > li li.current-menu-ancestor:before {

}


.scheme_self.top_panel_navi.state_fixed .menu_main_wrap {
	background-color: {$colors['bg_color']};
}
.scheme_self.top_panel_navi {
	background-color: {$colors['bg_color']};
}
.scheme_self.top_panel_top {
	background-color: {$colors['bg_color']};
}



.scheme_self.top_panel_top {
	border-color: {$colors['bd_color']};
}

.menu_top_nav > li > a {
	color: {$colors['text_link']};
}
.menu_top_nav > li > a:hover {
	color: {$colors['text_hover']};
}
.top_panel_top .menu_user_cart ul.sidebar_cart,
.menu_top_nav > li ul {
	color: {$colors['inverse_text']};
	border-color: {$colors['text_hover']};
	background-color: {$colors['text_hover']};
}
.menu_top_nav > li ul li a {
	color: {$colors['inverse_text']};
}
.menu_top_nav > li ul li a:hover,
.menu_top_nav > li ul li.current-menu-item > a,
.menu_top_nav > li ul li.current-menu-ancestor > a {
}
.menu_top_nav > li.menu_user_controls .user_avatar {
	border-color: {$colors['bd_color']};
}
.top_panel_cart_button .cart_summa {
	color: {$colors['text_hover']}
}
.menu_top_nav .chosen-container .chosen-results li.highlighted {
	/*color: {$colors['text_hover']}*/
}
.chosen-container-single .chosen-single {
	color: {$colors['text_link']};
}
.chosen-container-single .chosen-single:hover {
	color: {$colors['text_hover']};
}
.accent_hover a,
.accent_hover {
 	color: {$colors['text_hover']} !important;
}
.accent_hover a:hover {
	color: {$colors['text_link']} !important;
}
.menu_top_nav > li.current-menu-item a,
.menu_top_nav > li.current-menu-parent.sfHover > a,
.menu_top_nav > li.current-menu-ancestor.sfHover > a,
.menu_top_nav > li.current-menu-item > a:hover,
.menu_top_nav > li.current-menu-parent > a:hover,
.menu_top_nav > li.current-menu-ancestor > a:hover {
	color: {$colors['text_hover']};
}


.top_panel_top .woocommerce div.product p.price, .scheme_dark .woocommerce div.product span.price,
.top_panel_top .woocommerce span.amount, .scheme_dark .woocommerce-page span.amount {
	color: {$colors['inverse_text']};
}

/* Mobile menu */
.scheme_self.menu_side_wrap .menu_side_button {
	color: {$colors['alter_dark']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color_07']};
}
.scheme_self.menu_side_wrap .menu_side_button:hover {
	color: {$colors['inverse_text']};
	border-color: {$colors['alter_hover']};
	background-color: {$colors['alter_link']};
}
.menu_side_inner {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.menu_mobile_inner {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}
.menu_mobile_button {
	color: {$colors['text_hover']};
}
.menu_mobile_button:hover {
	color: {$colors['text_hover']};
}
.menu_mobile_close:before,
.menu_mobile_close:after {
	border-color: {$colors['alter_dark']};
}
.menu_mobile_close:hover:before,
.menu_mobile_close:hover:after {
	border-color: {$colors['text_hover']};
}
.menu_mobile_inner a {
	color: {$colors['alter_dark']};
}
.menu_mobile_inner a:hover,
.menu_mobile_inner .current-menu-ancestor > a,
.menu_mobile_inner .current-menu-item > a {
	color: {$colors['text_hover']};
}
.menu_mobile_inner .search_mobile .search_submit {
	color: {$colors['input_light']};
}
.menu_mobile_inner .search_mobile .search_submit:focus,
.menu_mobile_inner .search_mobile .search_submit:hover {
	color: {$colors['text_hover']};
}

.menu_mobile_inner .social_item a {
	color: {$colors['text_link']};
}
.menu_mobile_inner .social_item a:hover {
	color: {$colors['text_hover']};
}

/* Page title and breadcrumbs */
.top_panel_title .post_meta {
	color: {$colors['text']};
}
.breadcrumbs {
	color: {$colors['text']};
}
.breadcrumbs a {
	color: {$colors['text_dark']};
}
.breadcrumbs a:hover {
	color: {$colors['text_hover']};
}

/* Page image and text */
.top_panel_title_2_text {
	color: {$colors['text_dark']};
}


/* Tabs */
.frank_jewelry_store_tabs .frank_jewelry_store_tabs_titles li a {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}
.frank_jewelry_store_tabs .frank_jewelry_store_tabs_titles li a:hover {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.frank_jewelry_store_tabs .frank_jewelry_store_tabs_titles li.ui-state-active a {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}

/* Post layouts */
.post_item {
	color: {$colors['text']};
}
.post_meta,
.post_meta_item,
.post_meta_item a,
.post_meta_item:before,
.post_meta_item:hover:before,
.post_date a,
.post_date:before,
.post_info .post_info_item,
.post_info .post_info_item a,
.post_info_counters .post_counters_item,
.post_counters .socials_share .socials_caption:before,
.post_counters .socials_share .socials_caption:hover:before {
	color: {$colors['alter_text']};
}
.post_date a:hover,
a.post_meta_item:hover,
.post_meta_item a:hover,
.post_info .post_info_item a:hover,
.post_info_counters .post_counters_item:hover {
	color: {$colors['text_dark']};
}

.post_item .post_title a:hover {
	color: {$colors['text_hover']};
}

.post_meta_item.post_categories,
.post_meta_item.post_categories a {
	color: {$colors['text_link']};
}
.post_meta_item.post_categories a:hover {
	color: {$colors['text_hover']};
}

.post_meta_item .socials_share .social_items {
	background-color: {$colors['bg_color']};
}
.post_meta_item .social_items,
.post_meta_item .social_items:before {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_light']};
}

.post_layout_excerpt + .post_layout_excerpt {
	border-color: {$colors['bd_color']};
}
.post_layout_classic {
	border-color: {$colors['bd_color']};
}

.scheme_self.gallery_preview:before {
	background-color: {$colors['bg_color']};
}
.scheme_self.gallery_preview {
	color: {$colors['text']};
}

.post_featured:after {
	background-color: {$colors['bg_color']};
}

/* Post Formats */

.format-audio .post_featured .post_audio_author {
	color: {$colors['text_hover']};
}
.format-audio .post_featured.without_thumb .post_audio {
	border-color: {$colors['bd_color']};
}
.mejs-container .mejs-controls .mejs-time {
	color: {$colors['text']};
}
/*
.format-audio .post_featured.without_thumb .post_audio_title,
.without_thumb .mejs-controls .mejs-currenttime,
.without_thumb .mejs-controls .mejs-duration {
	color: {$colors['text_dark']};
}
*/

.mejs-controls .mejs-button,
.mejs-controls .mejs-time-rail .mejs-time-current,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
	color: {$colors['inverse_text']};
}
.mejs-controls .mejs-button:hover {
	color: {$colors['text_hover']};
}


.format-aside .post_content_inner {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}

.format-link .post_content_inner,
.format-status .post_content_inner {
	color: {$colors['text_dark']};
}

.format-chat p > b,
.format-chat p > strong {
	color: {$colors['text_dark']};
}

.post_layout_chess .post_content_inner:after {
	background: linear-gradient(to top, {$colors['bg_color']} 0%, {$colors['bg_color_0']} 100%) no-repeat scroll right top / 100% 100% {$colors['bg_color_0']};
}
.post_layout_chess_1 .post_meta:before {
	background-color: {$colors['bd_color']};
}

/* Pagination */
.nav-links-old {
	color: {$colors['text_dark']};
}
.nav-links-old a:hover {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
}

.page_links > a,
.nav-links .page-numbers {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
}
.page_links > a:hover,
.nav-links a.page-numbers:hover,
.page_links > span:not(.page_links_title),
.nav-links .page-numbers.current {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_hover']};
	border-color: {$colors['text_hover']};
}

/* Single post */
.post_item_single .post_header .post_date {
	color: {$colors['text_light']};
}
.post_item_single .post_header .post_categories,
.post_item_single .post_header .post_categories a {
	color: {$colors['text_link']};
}
.post_item_single .post_header .post_meta_item,
.post_item_single .post_header .post_meta_item:before,
.post_item_single .post_header .post_meta_item:hover:before,
.post_item_single .post_header .post_meta_item a,
.post_item_single .post_header .post_meta_item a:before,
.post_item_single .post_header .post_meta_item a:hover:before,
.post_item_single .post_header .post_meta_item .socials_caption,
.post_item_single .post_header .post_meta_item .socials_caption:before,
.post_item_single .post_header .post_edit a {
	color: {$colors['alter_text']};
	/*color: #6b6b6b;*/
}
.post_item_single a.post_meta_item:hover,
.post_item_single .post_meta_item > a:hover,
.post_item_single .post_meta_item .socials_caption:hover,
.post_item_single .post_edit a:hover {
	color: {$colors['text_hover']};
}
.post_item_single .post_meta_item.post_categories:hover > span {
	color: {$colors['text']};
}
.post_item_single .post_content .post_meta_label,
.post_item_single .post_content .post_meta_item:hover .post_meta_label {
	color: {$colors['text_dark']};
}
.post_item_single .post_content .post_tags,
.post_item_single .post_content .post_tags a {
	color: {$colors['text_link']};
}
.post_item_single .post_content .post_tags a:hover {
	color: {$colors['text_hover']};
}
.post_item_single .post_content .post_meta .post_share .social_item a {
	color: {$colors['inverse_text']} !important;
	background-color: {$colors['text_link']};
}
.post_item_single .post_content .post_meta .post_share .social_item a:hover {
	background-color: {$colors['text_hover']} !important;
}

.post_item_single .post_content > .post_meta_single .post_tags a {
	border-color: {$colors['input_bd_color']};
	color: {$colors['text']};
}
.post_item_single .post_content > .post_meta_single .post_tags a:hover {
	border-color: {$colors['text_hover']};
	background: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}

/* Single post navi */
.nav-links-single .nav-links {
	border-color: {$colors['bd_color']};
}
.nav-links-single .nav-links a .meta-nav {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a .post_date {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a:hover .meta-nav,
.nav-links-single .nav-links a:hover .post_date {
	color: {$colors['text_dark']};
}
.nav-links-single .nav-links a:hover .post-title {
	color: {$colors['text_link']};
}

/* Author info */
.scheme_self.author_info {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}
.scheme_self.author_info .author_title {
	color: {$colors['text_link']};
}
.scheme_self.author_info a {
	color: {$colors['text_dark']};
}
.scheme_self.author_info a:hover {
	color: {$colors['text_link']};
}

/* Related posts */
.related_wrap {
	border-color: {$colors['bd_color']};
}
.related_wrap .related_item_style_1 .post_header {
	background-color: {$colors['bg_color_07']};
}
.related_wrap .related_item_style_1:hover .post_header {
	background-color: {$colors['bg_color']};
}
.related_wrap .related_item_style_1 .post_date a {
	color: {$colors['text']};
}
.related_wrap .related_item_style_1:hover .post_date a {
	color: {$colors['text_light']};
}
.related_wrap .related_item_style_1:hover .post_date a:hover {
	color: {$colors['text_dark']};
}
.related_wrap .related_item_style_2 .post_date a {
	color: {$colors['text']};
}
.related_wrap .related_item_style_2 .post_date a:hover {
	color: {$colors['text_hover']};
}

/* Comments */
.comments_list_wrap,
.comments_list_wrap > ul {
	border-color: {$colors['bd_color']};
}
.comments_list_wrap li + li,
.comments_list_wrap li ul {
	border-color: {$colors['bd_color']};
}
.comments_list_wrap .comment_info {
	color: {$colors['text_dark']};
}
.comments_list_wrap .comment_counters a {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_counters a:before {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_counters a:hover:before,
.comments_list_wrap .comment_counters a:hover {
	color: {$colors['text_hover']};
}
.comments_list_wrap .comment_text {
	color: {$colors['text']};
}
.comments_list_wrap .comment_reply a {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_reply a:hover {
	color: {$colors['text_hover']};
}
.comments_form_wrap {
	border-color: {$colors['bd_color']};
}
.comments_wrap .comments_notes {
	color: {$colors['text_light']};
}


/* Page 404 */
.post_item_404 .page_title {
	color: {$colors['text_light']};
}
.post_item_404 .page_description {
	color: {$colors['text']};
}
.post_item_404 .page_description a {
	color: {$colors['text_hover']};
}
.post_item_404 .page_description a:hover {
	color: {$colors['text_link']};
}
.post_item_404 .go_home {
	border-color: {$colors['text_dark']};
}

/* Sidebar */
.sidebar_inner {
	background-color: {$colors['bg_color']};
	color: {$colors['text']};
}
.sidebar_inner aside + aside {
	border-color: {$colors['alter_bd_color']};
}
.sidebar_inner h1, .sidebar_inner h2, .sidebar_inner h3, .sidebar_inner h4, .sidebar_inner h5, .sidebar_inner h6,
.sidebar_inner h1 a, .sidebar_inner h2 a, .sidebar_inner h3 a, .sidebar_inner h4 a, .sidebar_inner h5 a, .sidebar_inner h6 a {
	color: {$colors['alter_dark']};
}
.sidebar_inner h1 a:hover, .sidebar_inner h2 a:hover, .sidebar_inner h3 a:hover, .sidebar_inner h4 a:hover, .sidebar_inner h5 a:hover, .sidebar_inner h6 a:hover {
	color: {$colors['alter_link']};
}


/* Widgets */
aside {
	color: {$colors['text']};
}
aside li:before {
	background-color: {$colors['alter_link']};
}
aside a {
	color: {$colors['text_link']};
}
aside a:hover {
	color: {$colors['text_hover']};
}
.widget_calendar caption,
aside li > a {
	/*color: {$colors['text']};*/
	color: {$colors['alter_text']};
}
aside li > a:hover {
	color: {$colors['text_hover']};
}


.widget_area .widget_product_search .search-field,
.widget_area .widget_search .search-field {
	color: {$colors['text_dark']};
}

/* Archive */
.widget_archive li {
	color: {$colors['alter_dark']};
}

/* Calendar */
.widget_calendar caption,
.widget_calendar tbody td a,
.widget_calendar th {
	color: {$colors['alter_dark']};
}
.widget_calendar tbody td {
	color: {$colors['alter_text']} !important;
}
.widget_calendar tbody td a:hover {
	color: {$colors['alter_link']};
}
.widget_calendar tbody td a:after {
	background-color: {$colors['alter_link']};
}
.widget_calendar td#today {
	color: {$colors['inverse_text']} !important;
}
.widget_calendar td#today a {
	color: {$colors['inverse_link']};
}
.widget_calendar td#today a:hover {
	color: {$colors['inverse_hover']};
}
.widget_calendar td#today:before {
	background-color: {$colors['alter_link']};
}
.widget_calendar td#today a:after {
	background-color: {$colors['inverse_link']};
}
.widget_calendar td#today a:hover:after {
	background-color: {$colors['inverse_hover']};
}
.widget_calendar #prev a,
.widget_calendar #next a {
	color: {$colors['alter_link']};
}
.widget_calendar #prev a:hover,
.widget_calendar #next a:hover {
	color: {$colors['alter_hover']};
}
.widget_calendar td#prev a:before,
.widget_calendar td#next a:before {
	background-color: {$colors['alter_bg_color']};
}

/* Categories */
.widget_categories li {
	color: {$colors['alter_dark']};
}

/* Tag cloud */
.widget_product_tag_cloud a,
.widget_tag_cloud a {
	border-color: {$colors['bd_color']};
	color: {$colors['text']};
}
.widget_product_tag_cloud a:hover,
.widget_tag_cloud a:hover {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_hover']};
	border-color: {$colors['text_hover']};
}

/* RSS */
.widget_rss .widget_title a:first-child {
	color: {$colors['alter_link']};
}
.widget_rss .widget_title a:first-child:hover {
	color: {$colors['alter_hover']};
}
.widget_rss .rss-date {
	color: {$colors['alter_light']};
}

/* Footer */
.scheme_self.site_footer_wrap {
	background-color: {$colors['bg_color']};
	color: {$colors['text']};
}
.scheme_self.site_footer_wrap aside {
	border-color: {$colors['alter_bd_color']};
}
.scheme_self.site_footer_wrap h1, .scheme_self.site_footer_wrap h2, .scheme_self.site_footer_wrap h3, .scheme_self.site_footer_wrap h4, .scheme_self.site_footer_wrap h5, .scheme_self.site_footer_wrap h6,
.scheme_self.site_footer_wrap h1 a, .scheme_self.site_footer_wrap h2 a, .scheme_self.site_footer_wrap h3 a, .scheme_self.site_footer_wrap h4 a, .scheme_self.site_footer_wrap h5 a, .scheme_self.site_footer_wrap h6 a {
	color: {$colors['text_link']};
}
.scheme_self.site_footer_wrap h1 a:hover, .scheme_self.site_footer_wrap h2 a:hover, .scheme_self.site_footer_wrap h3 a:hover, .scheme_self.site_footer_wrap h4 a:hover, .scheme_self.site_footer_wrap h5 a:hover, .scheme_self.site_footer_wrap h6 a:hover {
	color: {$colors['alter_link']};
}
.logo_footer_wrap_inner {
	border-color: {$colors['alter_bd_color']};
}
.logo_footer_wrap_inner:after {
	background-color: {$colors['alter_text']};
}
.socials_footer_wrap_inner .social_item .social_icons {
	border-color: {$colors['alter_text']};
	color: {$colors['alter_text']};
}
.socials_footer_wrap_inner .social_item .social_icons:hover {
	border-color: {$colors['alter_dark']};
	color: {$colors['alter_dark']};
}
.menu_footer_nav_area ul li a {
	color: {$colors['text_link']};
}
.menu_footer_nav_area ul li a:hover {
	color: {$colors['text_hover']};
}
.menu_footer_nav_area ul li+li:before {
	border-color: {$colors['alter_light']};
}

.copyright_wrap_inner {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_dark']};
}
.copyright_wrap_inner a {
	color: {$colors['text_hover']};
}
.copyright_wrap_inner a:hover {
	color: {$colors['text_link']};
}
.copyright_wrap_inner .copyright_text {
	color: {$colors['text']};
}

/* Buttons */
.theme_button,
.more-link,
.socials_share:not(.socials_type_drop) .social_icons {
	color: {$colors['inverse_text']} !important;
	background-color: {$colors['text_link']} !important;
}
.theme_button:hover,
.more-link:hover,
.socials_share:not(.socials_type_drop) .social_icons:hover {
	color: {$colors['bg_color']} !important;
	background-color: {$colors['text_dark']} !important;
}

.format-video .post_featured.with_thumb .post_video_hover {
	color: {$colors['inverse_text']};
	border-color: {$colors['inverse_text']};
}
.format-video .post_featured.with_thumb .post_video_hover:hover {
	color: {$colors['text_hover']};
	border-color: {$colors['text_hover']};
}

.theme_scroll_down:hover {
	color: {$colors['text_link']};
}

/* Third-party plugins */

.mfp-bg {
	background-color: rgba(255,255,255,0.97);
}
.mfp-image-holder .mfp-close,
.mfp-iframe-holder .mfp-close {
	color: {$colors['text_dark']};
}
.mfp-image-holder .mfp-close:hover,
.mfp-iframe-holder .mfp-close:hover {
	color: {$colors['text_link']};
}




CSS;
				
					$rez = apply_filters('frank_jewelry_store_filter_get_css', $rez, $colors, false, $scheme);
					$css['colors'] .= $rez['colors'];
				}
			}
		}
				
		$css_str = (!empty($css['fonts']) ? $css['fonts'] : '')
				. (!empty($css['colors']) ? $css['colors'] : '');
		return $minify ? frank_jewelry_store_minify_css($css_str) : $css_str;
	}
}
?>