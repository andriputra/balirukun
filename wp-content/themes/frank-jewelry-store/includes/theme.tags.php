<?php
/**
 * Theme tags
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */


//----------------------------------------------------------------------
//-- Common tags
//----------------------------------------------------------------------

// Return true if current page need title
if ( !function_exists('frank_jewelry_store_need_page_title') ) {
	function frank_jewelry_store_need_page_title() {
		return frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('show_page_title')) 
					&& !is_front_page() 
					&& apply_filters('frank_jewelry_store_filter_need_page_title', frank_jewelry_store_storage_isset('blog_archive') || is_page() || is_single() || is_category() || is_tag() || is_year() || is_month() || is_day() || is_author() || is_search());
	}
}

// Show content with the html layout (if not empty)
if ( !function_exists('frank_jewelry_store_show_layout') ) {
	function frank_jewelry_store_show_layout($layout, $before='', $after='') {
		if (!empty($layout)) {
			printf("%s%s%s", $before, $layout, $after);
		}
	}
}


//----------------------------------------------------------------------
//-- Post parts
//----------------------------------------------------------------------

// Show post meta block: post date, author, categories, counters, etc.
if ( !function_exists('frank_jewelry_store_show_post_meta') ) {
	function frank_jewelry_store_show_post_meta($args=array()) {
		$args = array_merge(array(
			'categories' => true,
			'date' => true,
			'edit' => true,
			'seo' => false,
			'share' => true,
			'counters' => 'comments',
			'echo' => true
			), $args);

		if (!$args['echo']) ob_start();

		?><div class="post_meta"><?php

			// Post date
			if ( !empty($args['date']) && !is_attachment() && !is_page() ) {
				$dt = get_post_type()=='post' ? frank_jewelry_store_get_date() : apply_filters('frank_jewelry_store_filter_get_post_date', '');
				if (!empty($dt)) {
					?>
					<span class="post_meta_item post_date<?php if (!empty($args['seo'])) echo ' date updated'; ?>"<?php if (!empty($args['seo'])) echo ' itemprop="datePublished"'; ?>><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($dt); ?></a></span>
					<?php
				}
			}

			// Post categories
			if ( !empty($args['categories']) && !is_attachment() && !is_page() ) {
				$cats = get_post_type()=='post' ? get_the_category_list(', ') : apply_filters('frank_jewelry_store_filter_get_post_categories', '');
				if (!empty($cats)) {
					?>
					<span class="post_meta_item post_categories"><span><?php esc_html_e('IN ','frank-jewelry-store'); ?></span><?php frank_jewelry_store_show_layout($cats); ?></span>
				<?php
				}
			}
			
			// Post counters
			frank_jewelry_store_show_layout(frank_jewelry_store_get_post_counters($args['counters']));

			// Socials share
			if ( !empty($args['share']) ) {
				frank_jewelry_store_show_share_links(array(
						'type' => 'drop',
						'caption' => esc_html__('Share', 'frank-jewelry-store'),
						'before' => '<span class="post_meta_item post_share">',
						'after' => '</span>'
					));
			}
			// Edit page link
			if ( !empty($args['edit']) ) {
				edit_post_link( esc_html__( 'Edit', 'frank-jewelry-store' ), '<span class="post_meta_item post_edit icon-pencil">', '</span>' );
			}
		?></div><!-- .post_meta --><?php
		
		if (!$args['echo']) {
			$rez = ob_get_contents();
			ob_end_clean();
			return $rez;
		}
	}
}

// Show post featured block: image, video, audio, etc.
if ( !function_exists('frank_jewelry_store_show_post_featured') ) {
	function frank_jewelry_store_show_post_featured($args=array()) {

		$args = array_merge(array(
			'hover' => frank_jewelry_store_get_theme_option('image_hover'),	// Hover effect
			'class' => '',									// Additional Class for featured block
			'post_info' => '',								// Additional layout after hover
			'thumb_bg' => false,							// Put thumb image as block background
			'thumb_size' => '',								// Image size
			'thumb_only' => false,							// Display only thumb (without post formats)
			'show_no_image' => false,						// Display 'no-image.jpg' if post haven't thumbnail
			'seo' => frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('seo_snippets')),
			'singular' => is_singular()						// Current page is singular (true) or blog/shortcode (false)
			), $args);

		if ( post_password_required() ) return;

		$thumb_size = !empty($args['thumb_size']) ? $args['thumb_size'] : frank_jewelry_store_get_thumb_size(is_attachment() ? 'full' : (is_single() ? 'huge' : 'big'));
		$post_format = str_replace('post-format-', '', get_post_format());
		if ($args['thumb_bg']) {
			if (has_post_thumbnail()) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $thumb_size );
				$image = $image[0];
			} else if ($post_format == 'image') {
				$image = frank_jewelry_store_get_post_image();
				if (!empty($image)) 
					$image = frank_jewelry_store_add_thumb_size($image, $thumb_size);
			}
			if (empty($image))
				$image = frank_jewelry_store_get_no_image_placeholder();
			$args['class'] .= ($args['class'] ? ' ' : '') . 'post_featured_bg' . ' ' . frank_jewelry_store_add_inline_style('background-image: url('.esc_url($image).');');
		}

		if ( $args['singular'] ) {
			
			if ( is_attachment() ) {
				?>
				<div class="post_featured post_attachment<?php if ($args['class']) echo ' '.esc_attr($args['class']); ?>">

					<?php if (!$args['thumb_bg']) echo wp_get_attachment_image( get_the_ID(), $thumb_size ); ?>

					<nav id="image-navigation" class="navigation image-navigation">
						<div class="nav-previous"><?php previous_image_link( false, '' ); ?></div>
						<div class="nav-next"><?php next_image_link( false, '' ); ?></div>
					</nav><!-- .image-navigation -->
				
				</div><!-- .post_featured -->
				
				<?php
				if ( has_excerpt() ) {
					?><div class="entry-caption"><?php the_excerpt(); ?></div><!-- .entry-caption --><?php
				}
	
			} else if ( has_post_thumbnail() || !empty($args['show_no_image']) ) {

				?>
				<div class="post_featured<?php if ($args['class']) echo ' '.esc_attr($args['class']); ?>"<?php if ($args['seo']) echo ' itemscope itemprop="image" itemtype="http://schema.org/ImageObject"'; ?>>
					<?php
					if (has_post_thumbnail() && $args['seo']) {
						$frank_jewelry_store_attr = frank_jewelry_store_getimagesize( wp_get_attachment_url( get_post_thumbnail_id() ) );
						?>
						<meta itemprop="width" content="<?php echo esc_attr($frank_jewelry_store_attr[0]); ?>">
						<meta itemprop="height" content="<?php echo esc_attr($frank_jewelry_store_attr[1]); ?>">
						<?php
					}
					if (!$args['thumb_bg']) {
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( $thumb_size, array(
								'alt' => get_the_title(),
								'itemprop' => 'url'
								)
							);
						} else {
							?><img<?php if ($args['seo']) echo ' itemprop="url"'; ?> src="<?php echo esc_url(frank_jewelry_store_get_no_image_placeholder()); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"><?php
						}
					}
					?>
				</div><!-- .post_featured -->
				<?php

			}
	
		} else {
	
			if (empty($post_format)) $post_format='standard';
			$has_thumb = has_post_thumbnail();
			$post_info = !empty($args['post_info']) ? $args['post_info'] : '';

			if ($has_thumb || !empty($args['show_no_image']) || (!$args['thumb_only'] && in_array($post_format, array('gallery', 'image', 'audio', 'video')))) {
	
				?><div class="post_featured <?php echo (!empty($has_thumb) || $post_format == 'image' || !empty($args['show_no_image']) 
														? ('with_thumb' . ($args['thumb_only'] || !in_array($post_format, array('audio', 'video', 'gallery')) || ($post_format=='gallery' && ($has_thumb || $args['thumb_bg']))
																				? ' hover_'.esc_attr($args['hover'])
																				: (in_array($post_format, array('video')) ? ' hover_play' : '')
																			)
															)
														: 'without_thumb')
													. (!empty($args['class']) ? ' '.esc_attr($args['class']) : '');
								?>"><?php 

				// Put the thumb or gallery or image or video from the post
				if ( $args['thumb_bg'] ) {
					?><div class="mask"></div><?php
					if (!in_array($post_format, array('audio', 'video'))) {
						frank_jewelry_store_hovers_add_icons($args['hover']);
					}

				} else if ( $has_thumb ) {
					the_post_thumbnail( $thumb_size, array( 'alt' => get_the_title() ) );
					?><div class="mask"></div><?php
					if ($args['thumb_only'] || !in_array($post_format, array('audio', 'video'))) {
						frank_jewelry_store_hovers_add_icons($args['hover']);
					}
	
				} else if ($post_format == 'gallery' && !$args['thumb_only']) {

					if ( ($output = frank_jewelry_store_build_slider_layout(array('thumb_size' => $thumb_size, 'controls' => 'yes', 'pagination' => 'yes'))) != '' )
						frank_jewelry_store_show_layout($output);
	
				} else if ($post_format == 'image') {
					$image = frank_jewelry_store_get_post_image();
					if (!empty($image)) {
						$image = frank_jewelry_store_add_thumb_size($image, $thumb_size);
						?>
						<img src="<?php echo esc_url($image); ?>" alt="<?php echo get_the_title(); ?>">
						<div class="mask"></div>
						<?php 
						frank_jewelry_store_hovers_add_icons($args['hover'], array('image' => $image));
					}
				} else if (!empty($args['show_no_image'])) {
					?>
					<img src="<?php echo esc_url(frank_jewelry_store_get_no_image_placeholder()); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
					<div class="mask"></div>
					<?php 
					frank_jewelry_store_hovers_add_icons($args['hover']);
				}
				
				// Put video under the thumb
				if ($post_format == 'video' && !$args['thumb_only']) {
					$video = frank_jewelry_store_get_post_video('', false);
					if (empty($video))
						$video = frank_jewelry_store_get_post_iframe('', false);
					if (!empty($video)) {
						if ( $has_thumb ) {
							$video = frank_jewelry_store_make_video_autoplay($video);
							?><div class="post_video_hover" data-video="<?php echo esc_attr($video); ?>"></div><?php 
						}
						?><div class="post_video video_frame"><?php 
							if ( !$has_thumb ) {
								frank_jewelry_store_show_layout($video);
							}
						?></div><?php
					}
	
				}
				
				// Put audio over the thumb
				if ($post_format == 'audio' && !$args['thumb_only']) {
					$audio = frank_jewelry_store_get_post_audio('', false);
					if (empty($audio))
						$audio = frank_jewelry_store_get_post_iframe('', false);
					if (!empty($audio)) {
						//Show metadata (for the future version)
						if (false && function_exists('wp_read_audio_metadata')) {
							$src = frank_jewelry_store_get_post_audio($audio);
							$uploads = wp_upload_dir();
							if (strpos($src, $uploads['baseurl'])!==false) {
								$metadata = wp_read_audio_metadata( $src );
							}
						}
						?><div class="post_audio<?php if (strpos($audio, 'soundcloud')!==false) echo ' with_iframe'; ?>"><?php 
							$media_author = frank_jewelry_store_get_theme_option('media_author', '', false, get_the_ID());
							$media_title = frank_jewelry_store_get_theme_option('media_title', '', false, get_the_ID());
							if ( !frank_jewelry_store_is_inherit($media_author) ) {
								?><div class="post_audio_author"><?php frank_jewelry_store_show_layout($media_author); ?></div><?php
							}
							if ( !frank_jewelry_store_is_inherit($media_title) ) {
								?><h5 class="post_audio_title"><?php frank_jewelry_store_show_layout($media_title); ?></h5><?php
							}
							frank_jewelry_store_show_layout($audio); 
						?></div><?php
					}
				}
				
				// Put optional info block over the thumb
				frank_jewelry_store_show_layout($post_info);
				?></div><?php
			}
		}
	}
}


// Return path to the 'no-image'
if ( !function_exists('frank_jewelry_store_get_no_image_placeholder') ) {
	function frank_jewelry_store_get_no_image_placeholder($no_image='') {
		static $img = '';
		if (empty($img)) {
			$img = frank_jewelry_store_get_theme_option( 'no_image' );
			//if (empty($img)) $img = frank_jewelry_store_get_file_url('images/no-image.jpg');
		}
		if (!empty($img)) $no_image = $img;
		return $no_image;
	}
}


// Add featured image as background image to post navigation elements.
if ( !function_exists('frank_jewelry_store_add_bg_in_post_nav') ) {
	function frank_jewelry_store_add_bg_in_post_nav() {
		if ( ! is_single() ) return;
	
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		$css      = '';
		$noimg    = frank_jewelry_store_get_no_image_placeholder();
		
		if ( is_attachment() && $previous->post_type == 'attachment' ) return;
	
		if ( $previous ) {
			if ( has_post_thumbnail( $previous->ID ) ) {
				$img = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), frank_jewelry_store_get_thumb_size('med') );
				$img = $img[0];
			} else
				$img = $noimg;
			if ( !empty($img) )
				$css .= '.post-navigation .nav-previous a .nav-arrow { background-image: url(' . esc_url( $img ) . '); }';
			else
				$css .= '.post-navigation .nav-previous a .nav-arrow { background-color: rgba(128,128,128,0.05); border-color:rgba(128,128,128,0.1); }';
		}
	
		if ( $next ) {
			if ( has_post_thumbnail( $next->ID ) ) {
				$img = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), frank_jewelry_store_get_thumb_size('med') );
				$img = $img[0];
			} else
				$img = $noimg;
			if ( !empty($img) )
				$css .= '.post-navigation .nav-next a .nav-arrow { background-image: url(' . esc_url( $img ) . '); }';
			else
				$css .= '.post-navigation .nav-next a .nav-arrow { background-color: rgba(128,128,128,0.05); border-color:rgba(128,128,128,0.1); }';
		}
	
		wp_add_inline_style( 'frank_jewelry_store-main', $css );
	}
}

// Show related posts
if ( !function_exists('frank_jewelry_store_show_related_posts') ) {
	function frank_jewelry_store_show_related_posts($args=array(), $style=1, $title='') {
		$args = array_merge(array(
			'numberposts' => max(2, min(4, frank_jewelry_store_get_theme_option('related_posts'))),
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'post',
			'post_status' => 'publish',
			'post__not_in' => array(),
			'category__in' => array()
			), $args);
		
		$args['post__not_in'][] = get_the_ID();
		
		if (empty($args['category__in']) || is_array($args['category__in']) && count($args['category__in']) == 0) {
			$post_categories_ids = array();
			$post_cats = get_the_category(get_the_ID());
			if (is_array($post_cats) && !empty($post_cats)) {
				foreach ($post_cats as $cat) {
					$post_categories_ids[] = $cat->cat_ID;
				}
			}
			$args['category__in'] = $post_categories_ids;
		}
		
		$recent_posts = wp_get_recent_posts( $args, OBJECT );

		if (is_array($recent_posts) && count($recent_posts) > 0) {
			?>
			<section class="related_wrap">
				<h3 class="section title related_wrap_title"><?php
					if (!empty($title))
						echo esc_html($title);
					else
						esc_html_e('Related Posts', 'frank-jewelry-store');
				?></h3>
				<div class="columns_wrap posts_container">
					<?php
					global $post;
					foreach( $recent_posts as $post ) {
						setup_postdata($post);
						?><div class="column-1_<?php echo intval(max(2, $args['numberposts'])); ?>"><?php
							 get_template_part('templates/related-posts', $style);
						?></div><?php
					}
					wp_reset_postdata();
					?>
				</div>
			</section>
		<?php
		}
	}
}


// Show portfolio posts
if ( !function_exists('frank_jewelry_store_show_portfolio_posts') ) {
	function frank_jewelry_store_show_portfolio_posts($args=array()) {
		$args = array_merge(array(
			'cat' => 0,
			'parent_cat' => 0,
			'taxonomy' => 'category',
			'post_type' => 'post',
			'page' => 1,
			'sticky' => false,
			'blog_style' => '',
			'echo' => true
			), $args);

		$blog_style = explode('_', empty($args['blog_style']) ? frank_jewelry_store_get_theme_option('blog_style') : $args['blog_style']);
		$style = $blog_style[0];
		$columns = empty($blog_style[1]) ? 2 : max(2, $blog_style[1]);

		if ( !$args['echo'] ) {
			ob_start();

			$q_args = array(
				'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
			);
			$q_args = frank_jewelry_store_query_add_posts_and_cats($q_args, '', $args['post_type'], $args['cat'], $args['taxonomy']);
			if ($args['page'] > 1) {
				$q_args['paged'] = $args['page'];
				$q_args['ignore_sticky_posts'] = true;
			}
			$ppp = frank_jewelry_store_get_theme_option('posts_per_page');
			if ((int) $ppp != 0)
				$q_args['posts_per_page'] = (int) $ppp;

			query_posts( $q_args );
		}

		// Show posts
		$class = sprintf('portfolio_wrap posts_container portfolio_%s', $columns)
				. ($style!='portfolio' ? sprintf(' %s_wrap %s_%s', $style, $style, $columns) : '');
		if ($args['sticky']) {
			?><div class="columns_wrap sticky_wrap"><?php	
		} else {
			?><div class="<?php echo esc_attr($class); ?>"><?php	
		}
	
		while ( have_posts() ) { the_post(); 
			if ($args['sticky'] && !is_sticky()) {
				$args['sticky'] = false;
				?></div><div class="<?php echo esc_attr($class); ?>"><?php
			}
			get_template_part( 'content', $args['sticky'] && is_sticky() ? 'sticky' : ($style == 'gallery' ? 'portfolio-gallery' : $style) );
		}
		
		?></div><?php
	
		frank_jewelry_store_show_pagination();
		
		if (!$args['echo']) {
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
}

// AJAX handler for the frank_jewelry_store_ajax_get_posts action
if ( !function_exists( 'frank_jewelry_store_ajax_get_posts_callback' ) ) {
	add_action('wp_ajax_frank_jewelry_store_ajax_get_posts',			'frank_jewelry_store_ajax_get_posts_callback');
	add_action('wp_ajax_nopriv_frank_jewelry_store_ajax_get_posts',	'frank_jewelry_store_ajax_get_posts_callback');
	function frank_jewelry_store_ajax_get_posts_callback() {
		if ( !wp_verify_nonce( frank_jewelry_store_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			die();
	
		$id = !empty($_REQUEST['blog_template']) ? $_REQUEST['blog_template'] : 0;
		if ($id > 0) {
			frank_jewelry_store_storage_set('blog_archive', true);
			frank_jewelry_store_storage_set('blog_mode', 'blog');
			frank_jewelry_store_storage_set('options_meta', get_post_meta($id, 'frank_jewelry_store_options', true));
		}

		$response = array(
			'error'=>'', 
			'data' => frank_jewelry_store_show_portfolio_posts(array(
							'cat' => (int) $_REQUEST['cat'],
							'parent_cat' => (int) $_REQUEST['parent_cat'],
							'page' => (int) $_REQUEST['page'],
							'post_type' => trim($_REQUEST['post_type']),
							'taxonomy' => trim($_REQUEST['taxonomy']),
							'blog_style' => trim($_REQUEST['blog_style']),
							'echo' => false
							)
						)
		);

		if (empty($response['data'])) {
			$response['error'] = esc_html__('Sorry, but nothing matched your search criteria.', 'frank-jewelry-store');
		}
		
		echo json_encode($response);
		die();
	}
}


// Show pagination
if ( !function_exists('frank_jewelry_store_show_pagination') ) {
	function frank_jewelry_store_show_pagination() {
		global $wp_query;
		// Pagination
		$pagination = frank_jewelry_store_get_theme_option('blog_pagination');
		if ($pagination == 'pages') {
			the_posts_pagination( array(
				'mid_size'  => 2,
				'prev_text' => esc_html__( '<', 'frank-jewelry-store' ),
				'next_text' => esc_html__( '>', 'frank-jewelry-store' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'frank-jewelry-store' ) . ' </span>',
			) );
		} else if ($pagination == 'more' || $pagination == 'infinite') {
			$page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
			if ($page_number < $wp_query->max_num_pages) {
				?>
				<div class="nav-links-more<?php if ($pagination == 'infinite') echo ' nav-links-infinite'; ?>">
					<a class="nav-load-more" href="#" 
						data-page="<?php echo esc_attr($page_number); ?>" 
						data-max-page="<?php echo esc_attr($wp_query->max_num_pages); ?>"
						><span><?php esc_html_e('Load more posts', 'frank-jewelry-store'); ?></span></a>
				</div>
				<?php
			}
		} else if ($pagination == 'links') {
			?>
			<div class="nav-links-old">
				<span class="nav-prev"><?php previous_posts_link( is_search() ? esc_html__('Previous posts', 'frank-jewelry-store') : esc_html__('Newest posts', 'frank-jewelry-store') ); ?></span>
				<span class="nav-next"><?php next_posts_link( is_search() ? esc_html__('Next posts', 'frank-jewelry-store') : esc_html__('Older posts', 'frank-jewelry-store'), $wp_query->max_num_pages ); ?></span>
			</div>
			<?php
		}
	}
}
?>