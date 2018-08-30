<?php
/**
 * Child-Theme functions and definitions
 */

function frank_jewelry_store_child_scripts() {
    wp_enqueue_style( 'frank-jewelry-store-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'frank_jewelry_store_child_scripts' );
 
?>