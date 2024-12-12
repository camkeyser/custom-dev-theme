<?php
// Require ACF Block Registration & Render Callbacks
require_once get_template_directory() . '/inc/admin.php';
require_once get_template_directory() . '/inc/block-registration.php';
require_once get_template_directory() . '/inc/render-callbacks.php';
require_once get_template_directory() . '/inc/enqueue-scripts.php';
require_once get_template_directory() . '/inc/menu.php';

// Add theme support
function custom_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'custom_theme_setup' );


