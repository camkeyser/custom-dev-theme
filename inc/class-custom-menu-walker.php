<?php
class Custom_Menu_Walker extends Walker_Nav_Menu {
    // Start of an element
    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        // Get the custom fields
        $icon_id = get_post_meta($item->ID, '_menu_item_icon', true);
        $description = get_post_meta($item->ID, '_menu_item_description', true);

        // Get the icon image URL or use a random fallback if not set
        $icon_url = $icon_id ? wp_get_attachment_url($icon_id) : $this->get_random_fallback_icon();

        // Generate classes for the menu item
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // If it's a submenu item, add a specific class
        if ($depth > 0) {
            $classes[] = 'sub-menu-item';
        }

        // Build the opening tag
        $output .= '<li class="' . implode(' ', $classes) . '">';

        // Build the menu item
        $attributes = '';
        !empty($item->attr_title) && $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
        !empty($item->target) && $attributes .= ' target="' . esc_attr($item->target) . '"';
        !empty($item->xfn) && $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
        !empty($item->url) && $attributes .= ' href="' . esc_url($item->url) . '"';

        // Start building the item output
        $item_output = $args->before;

        if ($depth > 0) {
            // For submenu items

            // Start the link
            $item_output .= '<a' . $attributes . ' class="submenu-item-link">';

            // Start the submenu item content container
            $item_output .= '<div class="submenu-item-content">';

            // Icon
            if ($icon_url) {
                $item_output .= '<img src="' . esc_url($icon_url) . '" alt="' . esc_attr($item->title) . '" class="menu-item-icon">';
            }

            // Text container
            $item_output .= '<div class="submenu-item-text">';

            // Title
            $item_output .= '<span class="menu-item-title">' . $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . '</span>';

            // Description
            if ($description) {
                // Limit the description to a certain number of words
                $max_words = 11; // Adjust as needed
                $trimmed_description = wp_trim_words($description, $max_words, '...');
                $item_output .= '<p class="menu-item-description">' . esc_html($trimmed_description) . '</p>';
            }

            $item_output .= '</div>'; // Close submenu-item-text

            $item_output .= '</div>'; // Close submenu-item-content

            $item_output .= '</a>'; // Close link

        } else {
            // For top-level items, output as usual
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
        }

        $item_output .= $args->after;

        // Append to the output
        $output .= $item_output;
    }

    // Start of a submenu
    public function start_lvl(&$output, $depth = 0, $args = []) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    // Function to get a random fallback icon
    private function get_random_fallback_icon() {
        $fallback_icons = array(
            get_template_directory_uri() . '/img/nav-item-icon1.png',
            get_template_directory_uri() . '/img/nav-item-icon2.png',
            get_template_directory_uri() . '/img/nav-item-icon3.png'
        );

        return $fallback_icons[array_rand($fallback_icons)];
    }
}