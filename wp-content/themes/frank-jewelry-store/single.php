<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', get_post_format() );

	// Previous/next post navigation.
	if(false){
		?><div class="nav-links-single"><?php
			the_post_navigation( array(
				'next_text' => '<span class="nav-arrow"></span>'
					. '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'frank-jewelry-store' ) . '</span> '
					. '<h6 class="post-title">%title</h6>'
					. '<span class="post_date">%date</span>',
				'prev_text' => '<span class="nav-arrow"></span>'
					. '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'frank-jewelry-store' ) . '</span> '
					. '<h6 class="post-title">%title</h6>'
					. '<span class="post_date">%date</span>'
			) );
		?></div><?php
	}

	// Related posts
	frank_jewelry_store_show_related_posts(array(
										'orderby' => 'post_date',	// put here 'rand' if you want to show posts in random order
										'order' => 'DESC',
										'numberposts' => 2
										), 2);

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
?>