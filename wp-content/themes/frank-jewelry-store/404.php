<?php
/**
 * The template for displaying 404 page
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

// Tribe Events hack - create empty post object
if (!isset($GLOBALS['post'])) {
	$GLOBALS['post'] = new stdClass();
	$GLOBALS['post']->post_type = 'unknown';
}
// End Tribe Events hack

get_header(); 

get_template_part( 'content', '404' );

get_footer();
?>