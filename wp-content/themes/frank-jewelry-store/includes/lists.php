<?php
/**
 * Theme lists
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }



// Return numbers range
if ( !function_exists( 'frank_jewelry_store_get_list_range' ) ) {
	function frank_jewelry_store_get_list_range($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = $i;
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}



// Return styles list
if ( !function_exists( 'frank_jewelry_store_get_list_styles' ) ) {
	function frank_jewelry_store_get_list_styles($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = sprintf(esc_html__('Style %d', 'frank-jewelry-store'), $i);
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}

// Return list with 'Yes' and 'No' items
if ( !function_exists( 'frank_jewelry_store_get_list_yesno' ) ) {
	function frank_jewelry_store_get_list_yesno($prepend_inherit=false) {
		$list = array(
			"yes"	=> esc_html__("Yes", 'frank-jewelry-store'),
			"no"	=> esc_html__("No", 'frank-jewelry-store')
		);
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}

// Return list with 'On' and 'Of' items
if ( !function_exists( 'frank_jewelry_store_get_list_onoff' ) ) {
	function frank_jewelry_store_get_list_onoff($prepend_inherit=false) {
		$list = array(
			"on"	=> esc_html__("On", 'frank-jewelry-store'),
			"off"	=> esc_html__("Off", 'frank-jewelry-store')
		);
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}

// Return list with 'Show' and 'Hide' items
if ( !function_exists( 'frank_jewelry_store_get_list_showhide' ) ) {
	function frank_jewelry_store_get_list_showhide($prepend_inherit=false) {
		$list = array(
			"show" => esc_html__("Show", 'frank-jewelry-store'),
			"hide" => esc_html__("Hide", 'frank-jewelry-store')
		);
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}

// Return list with 'Horizontal' and 'Vertical' items
if ( !function_exists( 'frank_jewelry_store_get_list_directions' ) ) {
	function frank_jewelry_store_get_list_directions($prepend_inherit=false) {
		$list = array(
			"horizontal" => esc_html__("Horizontal", 'frank-jewelry-store'),
			"vertical"   => esc_html__("Vertical", 'frank-jewelry-store')
		);
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}

// Return list of the animations
if ( !function_exists( 'frank_jewelry_store_get_list_animations' ) ) {
	function frank_jewelry_store_get_list_animations($prepend_inherit=false) {
		$list = array(
			'none'			=> esc_html__('- None -',	'frank-jewelry-store'),
			'bounced'		=> esc_html__('Bounced',	'frank-jewelry-store'),
			'elastic'		=> esc_html__('Elastic',	'frank-jewelry-store'),
			'flash'			=> esc_html__('Flash',		'frank-jewelry-store'),
			'flip'			=> esc_html__('Flip',		'frank-jewelry-store'),
			'pulse'			=> esc_html__('Pulse',		'frank-jewelry-store'),
			'rubberBand'	=> esc_html__('Rubber Band','frank-jewelry-store'),
			'shake'			=> esc_html__('Shake',		'frank-jewelry-store'),
			'swing'			=> esc_html__('Swing',		'frank-jewelry-store'),
			'tada'			=> esc_html__('Tada',		'frank-jewelry-store'),
			'wobble'		=> esc_html__('Wobble',		'frank-jewelry-store')
		);
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}


// Return list of the enter animations
if ( !function_exists( 'frank_jewelry_store_get_list_animations_in' ) ) {
	function frank_jewelry_store_get_list_animations_in($prepend_inherit=false) {
		$list = array(
			'none'				=> esc_html__('- None -',			'frank-jewelry-store'),
			'bounceIn'			=> esc_html__('Bounce In',			'frank-jewelry-store'),
			'bounceInUp'		=> esc_html__('Bounce In Up',		'frank-jewelry-store'),
			'bounceInDown'		=> esc_html__('Bounce In Down',		'frank-jewelry-store'),
			'bounceInLeft'		=> esc_html__('Bounce In Left',		'frank-jewelry-store'),
			'bounceInRight'		=> esc_html__('Bounce In Right',	'frank-jewelry-store'),
			'elastic'			=> esc_html__('Elastic In',			'frank-jewelry-store'),
			'fadeIn'			=> esc_html__('Fade In',			'frank-jewelry-store'),
			'fadeInUp'			=> esc_html__('Fade In Up',			'frank-jewelry-store'),
			'fadeInUpSmall'		=> esc_html__('Fade In Up Small',	'frank-jewelry-store'),
			'fadeInUpBig'		=> esc_html__('Fade In Up Big',		'frank-jewelry-store'),
			'fadeInDown'		=> esc_html__('Fade In Down',		'frank-jewelry-store'),
			'fadeInDownBig'		=> esc_html__('Fade In Down Big',	'frank-jewelry-store'),
			'fadeInLeft'		=> esc_html__('Fade In Left',		'frank-jewelry-store'),
			'fadeInLeftBig'		=> esc_html__('Fade In Left Big',	'frank-jewelry-store'),
			'fadeInRight'		=> esc_html__('Fade In Right',		'frank-jewelry-store'),
			'fadeInRightBig'	=> esc_html__('Fade In Right Big',	'frank-jewelry-store'),
			'flipInX'			=> esc_html__('Flip In X',			'frank-jewelry-store'),
			'flipInY'			=> esc_html__('Flip In Y',			'frank-jewelry-store'),
			'lightSpeedIn'		=> esc_html__('Light Speed In',		'frank-jewelry-store'),
			'rotateIn'			=> esc_html__('Rotate In',			'frank-jewelry-store'),
			'rotateInUpLeft'	=> esc_html__('Rotate In Down Left','frank-jewelry-store'),
			'rotateInUpRight'	=> esc_html__('Rotate In Up Right',	'frank-jewelry-store'),
			'rotateInDownLeft'	=> esc_html__('Rotate In Up Left',	'frank-jewelry-store'),
			'rotateInDownRight'	=> esc_html__('Rotate In Down Right','frank-jewelry-store'),
			'rollIn'			=> esc_html__('Roll In',			'frank-jewelry-store'),
			'slideInUp'			=> esc_html__('Slide In Up',		'frank-jewelry-store'),
			'slideInDown'		=> esc_html__('Slide In Down',		'frank-jewelry-store'),
			'slideInLeft'		=> esc_html__('Slide In Left',		'frank-jewelry-store'),
			'slideInRight'		=> esc_html__('Slide In Right',		'frank-jewelry-store'),
			'wipeInLeftTop'		=> esc_html__('Wipe In Left Top',	'frank-jewelry-store'),
			'zoomIn'			=> esc_html__('Zoom In',			'frank-jewelry-store'),
			'zoomInUp'			=> esc_html__('Zoom In Up',			'frank-jewelry-store'),
			'zoomInDown'		=> esc_html__('Zoom In Down',		'frank-jewelry-store'),
			'zoomInLeft'		=> esc_html__('Zoom In Left',		'frank-jewelry-store'),
			'zoomInRight'		=> esc_html__('Zoom In Right',		'frank-jewelry-store')
		);
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}


// Return list of the out animations
if ( !function_exists( 'frank_jewelry_store_get_list_animations_out' ) ) {
	function frank_jewelry_store_get_list_animations_out($prepend_inherit=false) {
		$list = array(
			'none'			=> esc_html__('- None -',			'frank-jewelry-store'),
			'bounceOut'		=> esc_html__('Bounce Out',			'frank-jewelry-store'),
			'bounceOutUp'	=> esc_html__('Bounce Out Up',		'frank-jewelry-store'),
			'bounceOutDown'	=> esc_html__('Bounce Out Down',	'frank-jewelry-store'),
			'bounceOutLeft'	=> esc_html__('Bounce Out Left',	'frank-jewelry-store'),
			'bounceOutRight'=> esc_html__('Bounce Out Right',	'frank-jewelry-store'),
			'fadeOut'		=> esc_html__('Fade Out',			'frank-jewelry-store'),
			'fadeOutUp'		=> esc_html__('Fade Out Up',		'frank-jewelry-store'),
			'fadeOutUpBig'	=> esc_html__('Fade Out Up Big',	'frank-jewelry-store'),
			'fadeOutDownSmall'	=> esc_html__('Fade Out Down Small','frank-jewelry-store'),
			'fadeOutDownBig'=> esc_html__('Fade Out Down Big',	'frank-jewelry-store'),
			'fadeOutDown'	=> esc_html__('Fade Out Down',		'frank-jewelry-store'),
			'fadeOutLeft'	=> esc_html__('Fade Out Left',		'frank-jewelry-store'),
			'fadeOutLeftBig'=> esc_html__('Fade Out Left Big',	'frank-jewelry-store'),
			'fadeOutRight'	=> esc_html__('Fade Out Right',		'frank-jewelry-store'),
			'fadeOutRightBig'=> esc_html__('Fade Out Right Big','frank-jewelry-store'),
			'flipOutX'		=> esc_html__('Flip Out X',			'frank-jewelry-store'),
			'flipOutY'		=> esc_html__('Flip Out Y',			'frank-jewelry-store'),
			'hinge'			=> esc_html__('Hinge Out',			'frank-jewelry-store'),
			'lightSpeedOut'	=> esc_html__('Light Speed Out',	'frank-jewelry-store'),
			'rotateOut'		=> esc_html__('Rotate Out',			'frank-jewelry-store'),
			'rotateOutUpLeft'	=> esc_html__('Rotate Out Down Left',	'frank-jewelry-store'),
			'rotateOutUpRight'	=> esc_html__('Rotate Out Up Right',	'frank-jewelry-store'),
			'rotateOutDownLeft'	=> esc_html__('Rotate Out Up Left',		'frank-jewelry-store'),
			'rotateOutDownRight'=> esc_html__('Rotate Out Down Right',	'frank-jewelry-store'),
			'rollOut'			=> esc_html__('Roll Out',		'frank-jewelry-store'),
			'slideOutUp'		=> esc_html__('Slide Out Up',	'frank-jewelry-store'),
			'slideOutDown'		=> esc_html__('Slide Out Down',	'frank-jewelry-store'),
			'slideOutLeft'		=> esc_html__('Slide Out Left',	'frank-jewelry-store'),
			'slideOutRight'		=> esc_html__('Slide Out Right','frank-jewelry-store'),
			'zoomOut'			=> esc_html__('Zoom Out',		'frank-jewelry-store'),
			'zoomOutUp'			=> esc_html__('Zoom Out Up',	'frank-jewelry-store'),
			'zoomOutDown'		=> esc_html__('Zoom Out Down',	'frank-jewelry-store'),
			'zoomOutLeft'		=> esc_html__('Zoom Out Left',	'frank-jewelry-store'),
			'zoomOutRight'		=> esc_html__('Zoom Out Right',	'frank-jewelry-store')
		);
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}

// Return classes list for the specified animation
if (!function_exists('frank_jewelry_store_get_animation_classes')) {
	function frank_jewelry_store_get_animation_classes($animation, $speed='normal', $loop='none') {
		// speed:	fast=0.5s | normal=1s | slow=2s
		// loop:	none | infinite
		return frank_jewelry_store_is_off($animation) ? '' : 'animated '.esc_attr($animation).' '.esc_attr($speed).(!frank_jewelry_store_is_off($loop) ? ' '.esc_attr($loop) : '');
	}
}

// Return custom sidebars list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'frank_jewelry_store_get_list_sidebars' ) ) {
	function frank_jewelry_store_get_list_sidebars($prepend_inherit=false) {
		if (($list = frank_jewelry_store_storage_get('list_sidebars'))=='') {
			$list = apply_filters('frank_jewelry_store_filter_list_sidebars', array(
				'sidebar_widgets'		=> esc_html__('Sidebar Widgets', 'frank-jewelry-store'),
				'header_widgets'		=> esc_html__('Header Widgets', 'frank-jewelry-store'),
				'above_page_widgets'	=> esc_html__('Above Page Widgets', 'frank-jewelry-store'),
				'above_content_widgets' => esc_html__('Above Content Widgets', 'frank-jewelry-store'),
				'below_content_widgets' => esc_html__('Below Content Widgets', 'frank-jewelry-store'),
				'below_page_widgets' 	=> esc_html__('Below Page Widgets', 'frank-jewelry-store'),
				'footer_widgets'		=> esc_html__('Footer Widgets', 'frank-jewelry-store')
				)
			);
			$custom_sidebars_number = max(0, min(10, frank_jewelry_store_get_theme_setting('custom_sidebars')));
			if (count($custom_sidebars_number) > 0) {
				for ($i=1; $i <= $custom_sidebars_number; $i++) {
					$list['custom_widgets_'.intval($i)] = sprintf(esc_html__('Custom Widgets %d', 'frank-jewelry-store'), $i);
				}
			}
			frank_jewelry_store_storage_set('list_sidebars', $list);
		}
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}

// Return sidebars positions
if ( !function_exists( 'frank_jewelry_store_get_list_sidebars_positions' ) ) {
	function frank_jewelry_store_get_list_sidebars_positions($prepend_inherit=false) {
		$list = array(
			'left'  => esc_html__('Left',  'frank-jewelry-store'),
			'right' => esc_html__('Right', 'frank-jewelry-store')
		);
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}

// Return blog styles list, prepended inherit
if ( !function_exists( 'frank_jewelry_store_get_list_blog_styles' ) ) {
	function frank_jewelry_store_get_list_blog_styles($prepend_inherit=false) {
		$list = array(
			'excerpt'	=> esc_html__('Excerpt','frank-jewelry-store'),
			'classic_2'	=> esc_html__('Classic /2 columns/',	'frank-jewelry-store'),
			'classic_3'	=> esc_html__('Classic /3 columns/',	'frank-jewelry-store'),
			'portfolio_2' => esc_html__('Portfolio /2 columns/','frank-jewelry-store'),
			'portfolio_3' => esc_html__('Portfolio /3 columns/','frank-jewelry-store'),
			'portfolio_4' => esc_html__('Portfolio /4 columns/','frank-jewelry-store'),
			'gallery_2' => esc_html__('Gallery /2 columns/',	'frank-jewelry-store'),
			'gallery_3' => esc_html__('Gallery /3 columns/',	'frank-jewelry-store'),
			'gallery_4' => esc_html__('Gallery /4 columns/',	'frank-jewelry-store'),
			'chess_1'	=> esc_html__('Chess /2 column/',		'frank-jewelry-store'),
			'chess_2'	=> esc_html__('Chess /4 columns/',		'frank-jewelry-store'),
			'chess_3'	=> esc_html__('Chess /6 columns/',		'frank-jewelry-store')
		);
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}


// Return list of categories
if ( !function_exists( 'frank_jewelry_store_get_list_categories' ) ) {
	function frank_jewelry_store_get_list_categories($prepend_inherit=false) {
		if (($list = frank_jewelry_store_storage_get('list_categories'))=='') {
			$list = array();
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'category',
				'pad_counts'               => false );
			$taxonomies = get_categories( $args );
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;
				}
			}
			frank_jewelry_store_storage_set('list_categories', $list);
		}
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}


// Return list of taxonomies
if ( !function_exists( 'frank_jewelry_store_get_list_terms' ) ) {
	function frank_jewelry_store_get_list_terms($prepend_inherit=false, $taxonomy='category') {
		if (($list = frank_jewelry_store_storage_get('list_taxonomies_'.($taxonomy)))=='') {
			$list = array();
			$args = array(
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => $taxonomy,
				'pad_counts'               => false );
			$taxonomies = get_terms( $taxonomy, $args );
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;	// . ($taxonomy!='category' ? ' /'.($cat->taxonomy).'/' : '');
				}
			}
			frank_jewelry_store_storage_set('list_taxonomies_'.($taxonomy), $list);
		}
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}

// Return list of post's types
if ( !function_exists( 'frank_jewelry_store_get_list_posts_types' ) ) {
	function frank_jewelry_store_get_list_posts_types($prepend_inherit=false) {
		if (($list = frank_jewelry_store_storage_get('list_posts_types'))=='') {
			$list = apply_filters('frank_jewelry_store_filter_list_posts_types', array(
				'post' => esc_html('Post', 'frank_jewelry_store')
			));
			frank_jewelry_store_storage_set('list_posts_types', $list);
		}
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}


// Return list post items from any post type and taxonomy
if ( !function_exists( 'frank_jewelry_store_get_list_posts' ) ) {
	function frank_jewelry_store_get_list_posts($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'taxonomy'			=> 'category',
			'taxonomy_value'	=> '',
			'posts_per_page'	=> -1,
			'orderby'			=> 'post_date',
			'order'				=> 'desc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));

		$hash = 'list_posts_'.($opt['post_type']).'_'.($opt['taxonomy']).'_'.($opt['taxonomy_value']).'_'.($opt['orderby']).'_'.($opt['order']).'_'.($opt['return']).'_'.($opt['posts_per_page']);
		if (($list = frank_jewelry_store_storage_get($hash))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'frank-jewelry-store');
			$args = array(
				'post_type' => $opt['post_type'],
				'post_status' => $opt['post_status'],
				'posts_per_page' => $opt['posts_per_page'],
				'ignore_sticky_posts' => true,
				'orderby'	=> $opt['orderby'],
				'order'		=> $opt['order']
			);
			if (!empty($opt['taxonomy_value'])) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $opt['taxonomy'],
						'field' => (int) $opt['taxonomy_value'] > 0 ? 'id' : 'slug',
						'terms' => $opt['taxonomy_value']
					)
				);
			}
			$posts = get_posts( $args );
			if (is_array($posts) && count($posts) > 0) {
				foreach ($posts as $post) {
					$list[$opt['return']=='id' ? $post->ID : $post->post_title] = $post->post_title;
				}
			}
			frank_jewelry_store_storage_set($hash, $list);
		}
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}


// Return list of registered users
if ( !function_exists( 'frank_jewelry_store_get_list_users' ) ) {
	function frank_jewelry_store_get_list_users($prepend_inherit=false, $roles=array('administrator', 'editor', 'author', 'contributor', 'shop_manager')) {
		if (($list = frank_jewelry_store_storage_get('list_users'))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'frank-jewelry-store');
			$args = array(
				'orderby'	=> 'display_name',
				'order'		=> 'ASC' );
			$users = get_users( $args );
			if (is_array($users) && count($users) > 0) {
				foreach ($users as $user) {
					$accept = true;
					if (is_array($user->roles)) {
						if (is_array($user->roles) && count($user->roles) > 0) {
							$accept = false;
							foreach ($user->roles as $role) {
								if (in_array($role, $roles)) {
									$accept = true;
									break;
								}
							}
						}
					}
					if ($accept) $list[$user->user_login] = $user->display_name;
				}
			}
			frank_jewelry_store_storage_set('list_users', $list);
		}
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}

// Return menus list, prepended inherit
if ( !function_exists( 'frank_jewelry_store_get_list_menus' ) ) {
	function frank_jewelry_store_get_list_menus($prepend_inherit=false) {
		if (($list = frank_jewelry_store_storage_get('list_menus'))=='') {
			$list = array();
			$list['default'] = esc_html__("Default", 'frank-jewelry-store');
			$menus = wp_get_nav_menus();
			if (is_array($menus) && count($menus) > 0) {
				foreach ($menus as $menu) {
					$list[$menu->slug] = $menu->name;
				}
			}
			frank_jewelry_store_storage_set('list_menus', $list);
		}
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}

// Return iconed classes list
if ( !function_exists( 'frank_jewelry_store_get_list_icons' ) ) {
	function frank_jewelry_store_get_list_icons($prepend_inherit=false) {
		static $list = false;
		if (!is_array($list)) 
			$list = !is_admin() ? array() : frank_jewelry_store_parse_icons_classes(frank_jewelry_store_get_file_dir("css/fontello/css/fontello-codes.css"));
		return $prepend_inherit ? frank_jewelry_store_array_merge(array('inherit' => esc_html__("Inherit", 'frank-jewelry-store')), $list) : $list;
	}
}
?>