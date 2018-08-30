<?php
/**
 * WP tags and utils
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

// Theme init
if (!function_exists('frank_jewelry_store_wp_theme_setup')) {
	add_action( 'after_setup_theme', 'frank_jewelry_store_wp_theme_setup' );
	function frank_jewelry_store_wp_theme_setup() {

		// AJAX: Incremental search
		add_action('wp_ajax_ajax_search',			'frank_jewelry_store_callback_ajax_search');
		add_action('wp_ajax_nopriv_ajax_search',	'frank_jewelry_store_callback_ajax_search');

		// Remove macros from title
		add_filter('wp_title',						'frank_jewelry_store_wp_title');
		add_filter('wp_title_parts',				'frank_jewelry_store_wp_title');
		add_filter('document_title_parts',			'frank_jewelry_store_wp_title');

		// Clear menu cache
		add_action('wp_update_nav_menu',			'frank_jewelry_store_clear_menu_cache', 10, 2);

		// Breadcrumbs link 'All posts'
		add_filter('post_type_archive_link',		'frank_jewelry_store_get_template_page_link', 10, 2 );
		add_filter('frank_jewelry_store_filter_get_blog_all_posts_link', 'frank_jewelry_store_get_blog_all_posts_link');
	}
}


/* Blog utilities
-------------------------------------------------------------------------------- */

// Detect current blog mode to get correspond options (post | page | search | blog | home)
if (!function_exists('frank_jewelry_store_detect_blog_mode')) {
	function frank_jewelry_store_detect_blog_mode() {
		if (is_front_page())
			$mode = 'home';
		else if (is_single())
			$mode = 'post';
		else if (is_page() && !frank_jewelry_store_storage_isset('blog_archive'))
			$mode = 'page';
		else
			$mode = 'blog';
		return apply_filters('frank_jewelry_store_filter_detect_blog_mode', $mode);
	}
}
	
// Return ID for the page with specified template
if (!function_exists('frank_jewelry_store_get_template_page_id')) {
	function frank_jewelry_store_get_template_page_id($args=array()) {
		$args = array_merge(array(
			'template' => 'blog.php',
			'post_type' => 'post'
		), $args);
		$q_args = array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'posts_per_page' => 1,
			'meta_query' => array('relation' => 'AND')
			);
		if (!empty($args['template'])) {
			$q_args['meta_query'][] = array(
				'key' => '_wp_page_template',
				'value' => $args['template'],
				'compare' => '='
			);
		}
		if (!empty($args['post_type'])) {
			$q_args['meta_query'][] = array(
				'key' => 'frank_jewelry_store_options_post_type',
				'value' => $args['post_type'],
				'compare' => '='
			);
		}
		$q_args['meta_query'][] = array(
			'key' => 'frank_jewelry_store_options_parent_cat',
			'value' => 1,
			'compare' => '<'
		);
		$id = 0;
		$query = new WP_Query( $q_args );
		while ( $query->have_posts() ) { $query->the_post();
			$id = get_the_ID();
			break;
		}
		wp_reset_postdata();
		return $id;
	}
}

// Return link to the page with theme specific $post_type archive template page:
// page_template == blog.php and 'post_type'== $post_type and 'parent_cat' == 0
if ( !function_exists( 'frank_jewelry_store_get_template_page_link' ) ) {
	//Handler of the add_filter('post_type_archive_link', 'frank_jewelry_store_get_template_page_link', 10, 2 );
	function frank_jewelry_store_get_template_page_link($link='', $post_type='') {
		if (!empty($post_type)) {
			$id = frank_jewelry_store_get_template_page_id(array('post_type'=>$post_type));
			if ($id > 0) $link = get_permalink($id);
		}
		return $link;
	}
}

// Return link to the main posts page for the breadcrumbs
if ( !function_exists( 'frank_jewelry_store_get_blog_all_posts_link' ) ) {
	//Handler of the add_filter('frank_jewelry_store_filter_get_blog_all_posts_link', 'frank_jewelry_store_get_blog_all_posts_link');
	function frank_jewelry_store_get_blog_all_posts_link($link='') {
		if ($link=='') {
			if (frank_jewelry_store_is_posts_page() && !is_home())	//!is_post_type_archive('post'))
				$link = '<a href="'.esc_url(get_post_type_archive_link( 'post' )).'">'.esc_html__('All Posts', 'frank-jewelry-store').'</a>';
		}
		return $link;
	}
}

// Return true if it's 'posts' page
if ( !function_exists( 'frank_jewelry_store_is_posts_page' ) ) {
	function frank_jewelry_store_is_posts_page() {
		return !is_search()
					&& (
						(is_single() && get_post_type()=='post')
						|| is_category()
						);
	}
}


// Return current site protocol
if (!function_exists('frank_jewelry_store_get_protocol')) {
	function frank_jewelry_store_get_protocol() {
		return is_ssl() ? 'https' : 'http';
	}
}

// Return internal page link - if is customize mode - full url else only hash part
if (!function_exists('frank_jewelry_store_get_hash_link')) {
	function frank_jewelry_store_get_hash_link($hash) {
		if (strpos($hash, 'http')!==0) {
			if ($hash[0]!='#') $hash = '#'.$hash;
			if (is_customize_preview()) {
				$url = frank_jewelry_store_get_current_url();
				if (($pos=strpos($url, '#'))!==false) $url = substr($url, 0, $pos);
				$hash = $url . $hash;
			}
		}
		return $hash;
	}
}

// Return URL to the current page
if (!function_exists('frank_jewelry_store_get_current_url')) {
	function frank_jewelry_store_get_current_url() {
		global $wp;
		// Attention! We don't need to process it with esc_url() 
		// since this url is being processed with esc_url() where it's used.
		return home_url(add_query_arg(array(), $wp->request));
	}
}

// Remove macros from the title
if ( !function_exists( 'frank_jewelry_store_wp_title' ) ) {
	// Handler of the add_filter( 'wp_title', 'frank_jewelry_store_wp_title');
	// Handler of the add_filter( 'wp_title_parts', 'frank_jewelry_store_wp_title');
	// Handler of the add_filter( 'document_title_parts', 'frank_jewelry_store_wp_title');
	function frank_jewelry_store_wp_title( $title ) {
		if (is_array($title)) {
			foreach ($title as $k=>$v)
				$title[$k] = frank_jewelry_store_remove_macros($v);
		} else
			$title = frank_jewelry_store_remove_macros($title);
		return $title;
	}
}

// Return blog title
if (!function_exists('frank_jewelry_store_get_blog_title')) {
	function frank_jewelry_store_get_blog_title() {

		if (is_front_page())
			$title = esc_html__( 'Home', 'frank-jewelry-store' );
		else if ( is_home() )
			$title = esc_html__( 'All Posts', 'frank-jewelry-store' );
		else if ( is_author() ) {
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			$title = sprintf(esc_html__('Author page: %s', 'frank-jewelry-store'), $curauth->display_name);
		} else if ( is_404() )
			$title = esc_html__('URL not found', 'frank-jewelry-store');
		else if ( is_search() )
			$title = sprintf( esc_html__( 'Search: %s', 'frank-jewelry-store' ), get_search_query() );
		else if ( is_day() )
			$title = sprintf( esc_html__( 'Daily Archives: %s', 'frank-jewelry-store' ), get_the_date() );
		else if ( is_month() )
			$title = sprintf( esc_html__( 'Monthly Archives: %s', 'frank-jewelry-store' ), get_the_date( 'F Y' ) );
		else if ( is_year() )
			$title = sprintf( esc_html__( 'Yearly Archives: %s', 'frank-jewelry-store' ), get_the_date( 'Y' ) );
		 else if ( is_category() )
			$title = sprintf( esc_html__( '%s', 'frank-jewelry-store' ), single_cat_title( '', false ) );
		else if ( is_tag() )
			$title = sprintf( esc_html__( 'Tag: %s', 'frank-jewelry-store' ), single_tag_title( '', false ) );
		else if ( is_tax() )
			$title = sprintf( esc_html__( '%s', 'frank-jewelry-store' ), single_term_title( '', false ) );
		else if ( is_attachment() )
			$title = sprintf( esc_html__( 'Attachment: %s', 'frank-jewelry-store' ), get_the_title());
		else if ( is_single() || is_page() )
			$title = get_the_title();
		else
			$title = get_the_title();	//get_bloginfo('name', 'raw');
		return apply_filters('frank_jewelry_store_filter_get_blog_title', $title);
	}
}

// Show breadcrumbs path
if (!function_exists('frank_jewelry_store_get_breadcrumbs')) {
	function frank_jewelry_store_get_breadcrumbs($args=array()) {
		global $wp_query, $post;
		
		$args = array_merge( array(
			'home' => esc_html__('Home', 'frank-jewelry-store'),		// Home page title (if empty - not showed)
			'home_link' => '',								// Home page link
			'truncate_title' => 50,					// Truncate all titles to this length (if 0 - no truncate)
			'truncate_add' => '...',				// Append truncated title with this string
			'delimiter' => '<span class="breadcrumbs_delimiter"></span>',			// Delimiter between breadcrumbs items
			'max_levels' => frank_jewelry_store_get_theme_setting('breadcrumbs_max_level'),		// Max categories in the path (0 - unlimited)
			), is_array($args) ? $args : array( 'home' => $args )
		);

		if ( is_front_page() ) return '';//is_home() || 

		if ( $args['max_levels']<=0 ) $args['max_levels'] = 999;

		$need_reset = true;
		$rez = $rez_parent = $rez_level = '';
		$cat = $parent_tax = '';
		$level = $parent = $post_id = 0;

		// Get current post ID and path to current post/page/attachment ( if it have parent posts/pages )
		if (is_page() || is_attachment() || is_single()) {
			$page_parent_id = apply_filters('frank_jewelry_store_filter_get_parent_id', isset($wp_query->post->post_parent) ? $wp_query->post->post_parent : 0, isset($wp_query->post->ID) ? $wp_query->post->ID : 0);
			$post_id = (is_attachment() ? $page_parent_id : (isset($wp_query->post->ID) ? $wp_query->post->ID : 0));
			while ($page_parent_id > 0) {
				$page_parent = get_post($page_parent_id);
				$level++;
				if ($level > $args['max_levels'])
					$rez_level = '...';
				else
					$rez_parent = '<a class="breadcrumbs_item cat_post" href="' . get_permalink($page_parent->ID) . '">' 
									. esc_html(frank_jewelry_store_strshort($page_parent->post_title, $args['truncate_title'], $args['truncate_add']))
									. '</a>' 
									. (!empty($rez_parent) ? $args['delimiter'] : '') 
									. ($rez_parent);
				if (($page_parent_id = apply_filters('frank_jewelry_store_filter_get_parent_id', $page_parent->post_parent, $page_parent_id)) > 0) $post_id = $page_parent_id;
			}
		}
		
		// Show parents
		$step = 0;
		do {
			if ($step++ == 0) {
				if (is_single() || is_attachment()) {
					$post_type = get_post_type();
					if ($post_type == 'post') {
						$cats = get_the_category();
						$cat = !empty($cats[0]) ? $cats[0] : false;
					} else {
						$tax = frank_jewelry_store_get_post_type_taxonomy($post_type);
						if (!empty($tax)) {
							$cats = get_the_terms(get_the_ID(), $tax);
							$cat = !empty($cats[0]) ? $cats[0] : false;
						}
					}
					if ($cat) {
						$level++;
						if ($level > $args['max_levels'])
							$rez_level = '...';
						else
							$rez_parent = '<a class="breadcrumbs_item cat_post" href="'.esc_url(get_category_link($cat->term_id)).'">' 
											. esc_html(frank_jewelry_store_strshort($cat->name, $args['truncate_title'], $args['truncate_add']))
											. '</a>' 
											. (!empty($rez_parent) ? $args['delimiter'] : '') 
											. ($rez_parent);
					}
				} else if ( is_category() ) {
					$cat_id = (int) get_query_var( 'cat' );
					if (empty($cat_id)) $cat_id = get_query_var( 'category_name' );
					$cat = get_term_by( (int) $cat_id > 0 ? 'id' : 'slug', $cat_id, 'category', OBJECT);
				} else if ( is_tag() ) {
					$cat = get_term_by( 'slug', get_query_var( 'post_tag' ), 'post_tag', OBJECT);
				} else if ( is_tax() ) {
					$tax = get_query_var('taxonomy');
					$cat = get_term_by( 'slug', get_query_var( $tax ), $tax, OBJECT);
				}
				if ($cat) {
					$parent = $cat->parent;
					$parent_tax = $cat->taxonomy;
				}
			}
			if ($parent) {
				$cat = get_term_by( 'id', $parent, $parent_tax, OBJECT);
				if ($cat) {
					$cat_link = get_term_link($cat->slug, $cat->taxonomy);
					$level++;
					if ($level > $args['max_levels'])
						$rez_level = '...';
					else
						$rez_parent = '<a class="breadcrumbs_item cat_parent" href="'.esc_url($cat_link).'">' 
										. esc_html(frank_jewelry_store_strshort($cat->name, $args['truncate_title'], $args['truncate_add']))
										. '</a>' 
										. (!empty($rez_parent) ? $args['delimiter'] : '') 
										. ($rez_parent);
					$parent = $cat->parent;
				}
			}
		} while ($parent);

		$rez_period = '';
		if ((is_day() || is_month()) && is_object($post)) {
			$year  = get_the_time('Y'); 
			$month = get_the_time('m'); 
			$rez_period = '<a class="breadcrumbs_item cat_parent" href="' . get_year_link( $year ) . '">' . ($year) . '</a>';
			if (is_day())
				$rez_period .= (!empty($rez_period) ? $args['delimiter'] : '') . '<a class="breadcrumbs_item cat_parent" href="' . esc_url(get_month_link( $year, $month )) . '">' . esc_html(get_the_date('F')) . '</a>';
		}
		
		// Get link to the 'All posts (products, events, etc.)' page
		$rez_all = apply_filters('frank_jewelry_store_filter_get_blog_all_posts_link', '');

		if (!is_front_page()) {	// && !is_home()

			$title = frank_jewelry_store_get_blog_title();
			if (is_array($title)) $title = $title['text'];
			$title = frank_jewelry_store_strshort($title, $args['truncate_title'], $args['truncate_add']);

			$rez .= (isset($args['home']) && $args['home']!='' 
					? '<a class="breadcrumbs_item home" href="' . esc_url($args['home_link'] ? $args['home_link'] : home_url('/')) . '">' . ($args['home']) . '</a>' . ($args['delimiter']) 
					: '') 
				. (!empty($rez_all)    ? ($rez_all)    . ($args['delimiter']) : '')
				. (!empty($rez_level)  ? ($rez_level)  . ($args['delimiter']) : '')
				. (!empty($rez_parent) ? ($rez_parent) . ($args['delimiter']) : '')
				. (!empty($rez_period) ? ($rez_period) . ($args['delimiter']) : '')
				. ($title ? '<span class="breadcrumbs_item current">' . ($title) . '</span>' : '');
		}

		return apply_filters('frank_jewelry_store_filter_get_breadcrumbs', $rez);
	}
}


// Return nav menu html
if ( !function_exists( 'frank_jewelry_store_get_nav_menu' ) ) {
	function frank_jewelry_store_get_nav_menu($slug='', $depth=11, $custom_walker=false) {
		$menu = '';	//!empty($slug) ? frank_jewelry_store_get_custom_option($slug) : '';
		$menu_cache = frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('menu_cache')) ? 'frank_jewelry_store_menu_'.get_option('stylesheet') : '';
		$list = $menu_cache ? get_transient($menu_cache) : array();
		if (!is_array($list)) $list = array();
		$html = '';
		if (!empty($slug) && !empty($list[$slug])) {
			$html = $list[$slug];
		}
		if (empty($html)) {
			$args = array(
				'menu'				=> empty($menu) || $menu=='default' || frank_jewelry_store_is_inherit($menu) ? '' : $menu,
				'container'			=> 'nav',
				'container_class'	=> (!empty($slug) ? $slug : 'menu_main') . '_nav_area',
				'container_id'		=> '',
				'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'menu_class'		=> (!empty($slug) ? $slug : 'menu_main') . '_nav',
				'menu_id'			=> (!empty($slug) ? $slug : 'menu_main'),
				'echo'				=> false,
				'fallback_cb'		=> '',
				'before'			=> '',
				'after'				=> '',
				'link_before'       => '<span>',
				'link_after'        => '</span>',
				'depth'             => $depth
			);
			if (!empty($slug))
				$args['theme_location'] = $slug;
			if ($custom_walker && class_exists('frank_jewelry_store_custom_menu_walker'))
				$args['walker'] = new frank_jewelry_store_custom_menu_walker;
			$html = wp_nav_menu(apply_filters('frank_jewelry_store_filter_get_nav_menu_args', $args));
			if (!empty($slug) && $menu_cache) {
				$list[$slug] = $html;
				set_transient($menu_cache, $list, 24*60*60);
			}
		}
		// Remove empty spaces between items
		$html = preg_replace(array("/>[\r\n\s]*<li/", "/>[\r\n\s]*<\\/ul>/"), array("><li", "></ul>"), $html);
		return apply_filters('frank_jewelry_store_filter_get_nav_menu', $html);
	}
}

// Clear cache with saved menu
if ( !function_exists( 'frank_jewelry_store_clear_menu_cache' ) ) {
	function frank_jewelry_store_clear_menu_cache($menu_id=0, $menu_data=array()) {
		delete_transient('frank_jewelry_store_menu_'.get_option('stylesheet'));
	}
}

// AJAX incremental search
if ( !function_exists( 'frank_jewelry_store_callback_ajax_search' ) ) {
	// Handler of the add_action('wp_ajax_ajax_search',			'frank_jewelry_store_callback_ajax_search');
	// Handler of the add_action('wp_ajax_nopriv_ajax_search',	'frank_jewelry_store_callback_ajax_search');
	function frank_jewelry_store_callback_ajax_search() {
		if ( !wp_verify_nonce( frank_jewelry_store_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			die();
	
		$response = array('error'=>'', 'data' => '');
		
		$s = $_REQUEST['text'];
	
		if (!empty($s)) {
			$args = apply_filters( 'frank_jewelry_store_ajax_search_query', array(
				'post_status' => 'publish',
				'orderby' => 'date',
				'order' => 'desc', 
				'posts_per_page' => 4,
				's' => esc_html($s),
				)
			);	

			$post_number = 0;
			frank_jewelry_store_storage_set('frank_jewelry_store_output_widgets_posts', '');
			$query = new WP_Query( $args );
			set_query_var('frank_jewelry_store_args_widgets_posts', array(
				'show_image' => 1,
				'show_date' => 1,
				'show_author' => 1,
				'show_counters' => 1,
                'show_categories' => 0
   	            )
       	    );
			while ( $query->have_posts() ) { $query->the_post();
				$post_number++;
				get_template_part('templates/widgets-posts');
			}
			$response['data'] = frank_jewelry_store_storage_get('frank_jewelry_store_output_widgets_posts');
			if (empty($response['data'])) {
				$response['data'] .= '<article class="post_item">' . esc_html__('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'frank-jewelry-store') . '</article>';
			} else {
				$response['data'] .= '<article class="post_item"><a href="#" class="post_more search_more">' . esc_html__('More results ...', 'frank-jewelry-store') . '</a></article>';
			}
			frank_jewelry_store_storage_set('output', '');
		} else {
			$response['error'] = '<article class="post_item">' . esc_html__('The query string is empty!', 'frank-jewelry-store') . '</article>';
		}
		
		echo json_encode($response);
		die();
	}
}

// Return string with categories links
if (!function_exists('frank_jewelry_store_get_post_categories')) {
	function frank_jewelry_store_get_post_categories($delimiter=', ', $id=false) {
		$output = '';
		$categories = get_the_category($id);
		if ( !empty( $categories ) ) {
			foreach( $categories as $category )
				$output .= ($output ? $delimiter : '') . '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . sprintf( esc_attr__( 'View all posts in %s', 'frank-jewelry-store' ), $category->name ) . '">' . esc_html( $category->name ) . '</a>';
		}
		return $output;
	}
}

// Return string with terms links
if (!function_exists('frank_jewelry_store_get_post_terms')) {
	function frank_jewelry_store_get_post_terms($delimiter=', ', $id=false, $taxonomy='category') {
		$output = '';
		$terms = get_the_terms($id, $taxonomy);
		if ( !empty( $terms ) ) {
			foreach( $terms as $term )
				$output .= ($output ? $delimiter : '') . '<a href="' . esc_url( get_term_link( $term->term_id, $taxonomy ) ) . '" title="' . sprintf( esc_attr__( 'View all posts in %s', 'frank-jewelry-store' ), $term->name ) . '">' . esc_html( $term->name ) . '</a>';
		}
		return $output;
	}
}

// Return taxonomy for current post type
if ( !function_exists( 'frank_jewelry_store_get_post_type_taxonomy' ) ) {
	function frank_jewelry_store_get_post_type_taxonomy($post_type) {
		return $post_type == 'post' ? 'category' : apply_filters( 'frank_jewelry_store_filter_post_type_taxonomy',	'', $post_type );
	}
}


/* Query manipulations
-------------------------------------------------------------------------------- */

// Add sorting parameter in query arguments
if (!function_exists('frank_jewelry_store_query_add_sort_order')) {
	function frank_jewelry_store_query_add_sort_order($args, $orderby='date', $order='desc') {
		$q = apply_filters('frank_jewelry_store_filter_query_sort_order', array(), $orderby, $order);
		$q['order'] = $order=='asc' ? 'asc' : 'desc';
		if (empty($q['orderby'])) {
			if ($orderby == 'comments') {
				$q['orderby'] = 'comment_count';
			} else if ($orderby == 'title' || $orderby == 'alpha') {
				$q['orderby'] = 'title';
			} else if ($orderby == 'rand' || $orderby == 'random')  {
				$q['orderby'] = 'rand';
			} else {
				$q['orderby'] = 'post_date';
			}
		}
		foreach ($q as $mk=>$mv) {
			if (is_array($args))
				$args[$mk] = $mv;
			else
				$args->set($mk, $mv);
		}
		return $args;
	}
}

// Add post type and posts list or categories list in query arguments
if (!function_exists('frank_jewelry_store_query_add_posts_and_cats')) {
	function frank_jewelry_store_query_add_posts_and_cats($args, $ids='', $post_type='', $cat='', $taxonomy='') {
		if (!empty($ids)) {
			$args['post_type'] = empty($args['post_type']) 
									? (empty($post_type) ? array('post', 'page') : $post_type)
									: $args['post_type'];
			$args['post__in'] = explode(',', str_replace(' ', '', $ids));
		} else {
			$args['post_type'] = empty($args['post_type']) 
									? (empty($post_type) ? 'post' : $post_type)
									: $args['post_type'];
			$post_type = is_array($args['post_type']) ? $args['post_type'][0] : $args['post_type'];
			if (!empty($cat)) {
				$cats = !is_array($cat) ? explode(',', $cat) : $cat;
				if (empty($taxonomy)) 
					$taxonomy = frank_jewelry_store_get_post_type_taxonomy($post_type);
				if ($taxonomy == 'category') {				// Add standard categories
					if (is_array($cats) && count($cats) > 1) {
						$cats_ids = array();
						foreach($cats as $c) {
							$c = trim($c);
							if (empty($c)) continue;
							if ((int) $c == 0) {
								$cat_term = get_term_by( 'slug', $c, $taxonomy, OBJECT);
								if ($cat_term) $c = $cat_term->term_id;
							}
							if ($c==0) continue;
							$cats_ids[] = (int) $c;
							$children = get_categories( array(
								'type'                     => $post_type,
								'child_of'                 => $c,
								'hide_empty'               => 0,
								'hierarchical'             => 0,
								'taxonomy'                 => $taxonomy,
								'pad_counts'               => false
							));
							if (is_array($children) && count($children) > 0) {
								foreach($children as $c) {
									if (!in_array((int) $c->term_id, $cats_ids)) $cats_ids[] = (int) $c->term_id;
								}
							}
						}
						if (count($cats_ids) > 0) {
							$args['category__in'] = $cats_ids;
						}
					} else {
						if ((int) $cat > 0) 
							$args['cat'] = (int) $cat;
						else
							$args['category_name'] = $cat;
					}
				} else {									// Add custom taxonomies
					if (!isset($args['tax_query']))
						$args['tax_query'] = array();
					$args['tax_query']['relation'] = 'AND';
					$args['tax_query'][] = array(
						'taxonomy' => $taxonomy,
						'include_children' => true,
						'field'    => (int) $cats[0] > 0 ? 'id' : 'slug',
						'terms'    => $cats
					);
				}
			}
		}
		return $args;
	}
}

// Add filters (meta parameters) in query arguments
if (!function_exists('frank_jewelry_store_query_add_filters')) {
	function frank_jewelry_store_query_add_filters($args, $filters=false) {
		if (!empty($filters)) {
			if (!is_array($filters)) $filters = array($filters);
			foreach ($filters as $v) {
				$found = false;
				if ($v=='thumbs') {							// Filter with meta_query
					if (!isset($args['meta_query']))
						$args['meta_query'] = array();
					else {
						for ($i=0; $i<count($args['meta_query']); $i++) {
							if ($args['meta_query'][$i]['meta_filter'] == $v) {
								$found = true;
								break;
							}
						}
					}
					if (!$found) {
						$args['meta_query']['relation'] = 'AND';
						if ($v == 'thumbs') {
							$args['meta_query'][] = array(
								'meta_filter' => $v,
								'key' => '_thumbnail_id',
								'value' => false,
								'compare' => '!='
							);
						}
					}
				} else if (in_array($v, array('video', 'audio', 'gallery'))) {			// Filter with tax_query
					if (!isset($args['tax_query']))
						$args['tax_query'] = array();
					else {
						for ($i=0; $i<count($args['tax_query']); $i++) {
							if ($args['tax_query'][$i]['tax_filter'] == $v) {
								$found = true;
								break;
							}
						}
					}
					if (!$found) {
						$args['tax_query']['relation'] = 'AND';
						if ($v == 'video') {
							$args['tax_query'][] = array(
								'tax_filter' => $v,
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-video' )
							);
						} else if ($v == 'audio') {
							$args['tax_query'] = array(
								'tax_filter' => $v,
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-audio' )
							);
						} else if ($v == 'gallery') {
							$args['tax_query'] = array(
								'tax_filter' => $v,
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => array( 'post-format-gallery' )
							);
						}
					}
				}
			}
		}
		return $args;
	}
}



	
/* Widgets utils
------------------------------------------------------------------------------------- */

// Create widgets area
if (!function_exists('frank_jewelry_store_create_widgets_area')) {
	function frank_jewelry_store_create_widgets_area($name, $add_classes='') {
		$widgets_name = frank_jewelry_store_get_theme_option($name);
		if (!frank_jewelry_store_is_off($widgets_name) && is_active_sidebar($widgets_name)) { 
			set_query_var('current_sidebar', $name);
			ob_start();
			do_action( 'frank_jewelry_store_action_before_sidebar' );
			if ( !dynamic_sidebar($widgets_name) ) {
				// Put here html if user no set widgets in sidebar
			}
			do_action( 'frank_jewelry_store_action_after_sidebar' );
			$out = ob_get_contents();
			ob_end_clean();
			$out = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $out);
			$need_columns = strpos($out, 'columns_wrap')===false;
			if ($need_columns) {
				$columns = min(3, max(1, substr_count($out, '<aside ')));
				$out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($columns).' widget ', $out);
			}
			?>
			<div class="<?php echo esc_attr($name); ?> <?php echo esc_attr($name); ?>_wrap widget_area">
				<div class="<?php echo esc_attr($name); ?>_inner <?php echo esc_attr($name); ?>_wrap_inner widget_area_inner">
					<?php
					frank_jewelry_store_show_layout($out,
										true==$need_columns ? '<div class="columns_wrap">' : '',
                                        true==$need_columns ? '</div>' : ''
                                        );
					?>
				</div> <!-- /.widget_area_inner -->
			</div> <!-- /.widget_area -->
			<?php
		}
	}
}

// Check if sidebar present
if (!function_exists('frank_jewelry_store_sidebar_present')) {
	function frank_jewelry_store_sidebar_present() {
		global $wp_query;
		$sidebar_name = frank_jewelry_store_get_theme_option('sidebar_widgets');
		return apply_filters('frank_jewelry_store_filter_sidebar_present', 
					!is_404() 
					&& (!is_search() || $wp_query->found_posts > 0) 
					&& !frank_jewelry_store_is_off($sidebar_name) 
					&& is_active_sidebar($sidebar_name)
					);
	}
}



	
/* Inline styles and scripts
------------------------------------------------------------------------------------- */

// Add inline styles and return class for it
if (!function_exists('frank_jewelry_store_sidebar_presen')) {
	function frank_jewelry_store_add_inline_style($css) {
		static $class_number = 0;
		$class_name = sprintf('frank_jewelry_store_inline_%d', mt_rand());
		//$class_name = sprintf('frank_jewelry_store_inline_%d', $class_number++);
		frank_jewelry_store_storage_concat( 'inline_styles', sprintf('.%s{%s}', $class_name, $css) );
		return $class_name;
	}
}

/* Date & Time
----------------------------------------------------------------------------------------------------- */

// Return post date
if (!function_exists('frank_jewelry_store_get_date')) {
	function frank_jewelry_store_get_date($dt='', $format='') {
		if ($dt == '') $dt = get_the_time('U');
		if (date('U') - $dt > intval(frank_jewelry_store_get_theme_option('time_diff_before'))*24*3600)
			//$dt = date($format=='' ? get_option('date_format') : $format, $dt);
			$dt = date_i18n($format=='' ? get_option('date_format') : $format, $dt);
	else
			$dt = sprintf( esc_html__('%s ago', 'frank-jewelry-store'), human_time_diff($dt) );
		return $dt;
	}
}
?>