<?php

// Register navigation menus
function register_theme_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'custom-dev-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'register_theme_menus' );


// Add search icon to the end of the primary menu
function add_search_icon_to_menu($items, $args) {
    if ($args->theme_location == 'primary') {
        $search_icon = '<li class="menu-item search-icon"><a href="#" class="search-toggle" aria-label="Search"><i data-feather="search"></i></a></li>';
        $items .= $search_icon;
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_icon_to_menu', 10, 2);

// Add block labels in the editor
function my_add_block_label( $block_name ) {
    if ( function_exists( 'is_admin' ) && is_admin() && function_exists( 'wp_is_block_editor' ) && wp_is_block_editor() ) {
        echo '<div class="custom-block-label">' . esc_html( $block_name ) . '</div>';
    }
}

// Suppress ACF Prompts
function hide_acf_admin_warnings() {
    echo '<style>
        .acf-admin-notice { display: none !important; }
        .btn-upgrade.acf-admin-toolbar-upgrade-btn { display: none !important; }
        #tmpl-acf-field-group-pro-features { display: none !important; }
    </style>';
}
add_action('admin_head', 'hide_acf_admin_warnings');

// Disable AJAX Search Updates to prevent overrides 
// Disable updates for Ajax Search Lite plugin
function disable_ajax_search_lite_updates($value) {
    if (isset($value) && is_object($value)) {
        if (isset($value->response['ajax-search-lite/ajax-search-lite.php'])) {
            unset($value->response['ajax-search-lite/ajax-search-lite.php']);
        }
    }
    return $value;
}
add_filter('site_transient_update_plugins', 'disable_ajax_search_lite_updates');

// Remove plugin from update checks
function exclude_ajax_search_lite_from_update_check($r, $url) {
    if (0 !== strpos($url, 'https://api.wordpress.org/plugins/update-check')) {
        return $r;
    }

    $plugins = json_decode($r['body']['plugins']);
    unset($plugins->plugins->{'ajax-search-lite/ajax-search-lite.php'});
    unset($plugins->active[array_search('ajax-search-lite/ajax-search-lite.php', $plugins->active)]);
    $r['body']['plugins'] = json_encode($plugins);
    return $r;
}
add_filter('http_request_args', 'exclude_ajax_search_lite_from_update_check', 10, 2);

// Disable auto-updates specifically for Ajax Search Lite
function disable_ajax_search_lite_auto_updates($auto_update, $plugin_file) {
    if ('ajax-search-lite/ajax-search-lite.php' === $plugin_file) {
        return false;
    }
    return $auto_update;
}
add_filter('plugin_auto_update_setting_html', 'remove_auto_update_toggle', 10, 2);
add_filter('auto_update_plugin', 'disable_ajax_search_lite_auto_updates', 10, 2);

// Remove the auto-update toggle from the plugins page
function remove_auto_update_toggle($html, $plugin_file) {
    if ('ajax-search-lite/ajax-search-lite.php' === $plugin_file) {
        return '';
    }
    return $html;
}

// Hide update notices and auto-update UI
function hide_ajax_search_lite_update_notices() {
    remove_all_actions('after_plugin_row_ajax-search-lite/ajax-search-lite.php');
    echo '<style>
        .update-message[data-plugin="ajax-search-lite/ajax-search-lite.php"],
        .update-nag[data-plugin="ajax-search-lite/ajax-search-lite.php"],
        .plugin-auto-update-status[data-plugin="ajax-search-lite/ajax-search-lite.php"],
        [data-plugin="ajax-search-lite/ajax-search-lite.php"] .update-link,
        [data-plugin="ajax-search-lite/ajax-search-lite.php"] .update-now { 
            display: none !important; 
        }
    </style>';
}
add_action('admin_head', 'hide_ajax_search_lite_update_notices');

// Force disable auto-updates in WordPress options
function force_disable_auto_updates_option() {
    $auto_updates = get_site_option('auto_update_plugins', array());
    if (($key = array_search('ajax-search-lite/ajax-search-lite.php', $auto_updates)) !== false) {
        unset($auto_updates[$key]);
        update_site_option('auto_update_plugins', $auto_updates);
    }
}
add_action('admin_init', 'force_disable_auto_updates_option');

// Enqueue custom admin styles for the menu page
function my_admin_menu_styles() {
    $screen = get_current_screen();
    if ( 'nav-menus' === $screen->id ) {
        wp_enqueue_style( 'custom-admin-menu-styles', get_template_directory_uri() . '/css/admin-menu-styles.css', array(), '1.0' );
    }
}
add_action( 'admin_enqueue_scripts', 'my_admin_menu_styles' );