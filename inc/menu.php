<?php
// Add custom menu item fields
add_filter('wp_nav_menu_objects', 'add_custom_nav_fields', 10, 2);
function add_custom_nav_fields($items, $args) {
    foreach ($items as &$item) {
        $item->icon = get_post_meta($item->ID, '_menu_item_icon', true);
        $item->description = get_post_meta($item->ID, '_menu_item_description', true);
    }
    return $items;
}

// Save custom menu item fields
add_action('wp_update_nav_menu_item', 'update_custom_nav_fields', 10, 3);
function update_custom_nav_fields($menu_id, $menu_item_db_id, $args) {
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    $check = array(
        'menu-item-icon' => 'icon',
        'menu-item-description' => 'description',
    );

    foreach ($check as $key => $var) {
        if (!isset($_POST[$key][$menu_item_db_id])) {
            continue;
        }
        $value = sanitize_text_field($_POST[$key][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_' . $var, $value);
    }
}

// Add custom fields to menu item edit form
add_filter('wp_setup_nav_menu_item', 'add_custom_nav_fields_to_edit_form');
function add_custom_nav_fields_to_edit_form($menu_item) {
    $menu_item->icon = get_post_meta($menu_item->ID, '_menu_item_icon', true);
    $menu_item->description = get_post_meta($menu_item->ID, '_menu_item_description', true);
    return $menu_item;
}

add_action('wp_nav_menu_item_custom_fields', 'render_custom_nav_fields', 10, 4);
function render_custom_nav_fields($item_id, $item, $depth, $args) {
    if ($depth > 0) { 
        ?>
        <div class="menu-item-custom-fields">
            <div class="menu-item-icon-container">
                <label for="menu-item-icon-<?php echo $item_id; ?>">Icon:</label>
                <img src="<?php echo wp_get_attachment_url($item->icon); ?>" alt="Menu Item Icon" class="menu-item-icon-preview" <?php echo $item->icon ? '' : 'style="display:none;"'; ?>>
                <input type="hidden" id="menu-item-icon-<?php echo $item_id; ?>" class="menu-item-icon" name="menu-item-icon[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->icon); ?>">
                <button class="button menu-item-icon-button">Choose Icon</button>
            </div>
            <div class="menu-item-description-container">
                <label for="menu-item-description-<?php echo $item_id; ?>">Description:</label>
                <input type="text" id="menu-item-description-<?php echo $item_id; ?>" class="menu-item-description" name="menu-item-description[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->description); ?>">
            </div>
        </div>
        <?php
    }
}

add_action('admin_enqueue_scripts', 'enqueue_custom_nav_fields_assets');
function enqueue_custom_nav_fields_assets() {
    wp_enqueue_media();
    wp_enqueue_script('custom-nav-fields', get_template_directory_uri() . '/js/custom-nav-fields.js', array(), '1.0', true);
}