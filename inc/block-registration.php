<?php
// Register Custom Block Category
function my_custom_block_category( $categories, $post ) {
    return array_merge(
        array(
            array(
                'slug'  => 'custom-blocks',
                'title' => __( 'Custom Blocks', 'custom-dev-theme' ),
                'icon'  => null,
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'my_custom_block_category', 10, 2 );

// Register Custom Blocks
function my_acf_init() {
    if( function_exists('acf_register_block_type') ) {

        $blocks = array(
            array(
                'name'              => 'simple-text-block',
                'title'             => __('Simple Text Block'),
                'description'       => __('A simple block that displays text.'),
                'render_callback'   => 'my_simple_text_block_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'editor-paragraph',
                'keywords'          => array( 'text', 'paragraph' ),
            ),
            array(
                'name'              => 'full-width-hero-image',
                'title'             => __('Full Width Hero Image'),
                'description'       => __('A full-width hero image with overlay text.'),
                'render_callback'   => 'my_full_width_hero_image_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'format-image',
                'keywords'          => array( 'hero', 'image', 'full-width' ),
            ),
            array(
                'name'              => 'split-50-50-section',
                'title'             => __('Split 50/50 Section'),
                'description'       => __('A section split 50/50 between text and image.'),
                'render_callback'   => 'my_split_50_50_section_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'columns',
                'keywords'          => array( 'split', 'layout' ),
            ),
            array(
                'name'              => 'accordion-block',
                'title'             => __('Accordion Block'),
                'description'       => __('A block with multiple accordion items.'),
                'render_callback'   => 'my_accordion_block_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'list-view',
                'keywords'          => array( 'accordion', 'expandable' ),
            ),
            array(
                'name'              => 'cta-block',
                'title'             => __('Call to Action Block'),
                'description'       => __('A block for creating a call to action with a heading, button, description, and optional background image.'),
                'render_callback'   => 'my_cta_block_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'megaphone',
                'keywords'          => array( 'cta', 'call to action', 'button' ),
            ),
            array(
                'name'              => 'gallery-grid-block',
                'title'             => __('Gallery Grid Block'),
                'description'       => __('A block to display a grid of images.'),
                'render_callback'   => 'my_gallery_grid_block_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'images-alt2',
                'keywords'          => array( 'gallery', 'grid', 'images' ),
            ),
            array(
                'name'              => 'pricing-table-block',
                'title'             => __('Pricing Table Block'),
                'description'       => __('A block for displaying a pricing table with items, prices, and features.'),
                'render_callback'   => 'my_pricing_table_block_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'editor-table',
                'keywords'          => array( 'pricing', 'table', 'pricing table' ),
            ),
            array(
                'name'              => 'team-member-block',
                'title'             => __('Team Member Block'),
                'description'       => __('A block for displaying team members in a grid layout.'),
                'render_callback'   => 'my_team_member_block_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'groups',
                'keywords'          => array( 'team', 'member', 'grid' ),
            ),
            array(
                'name'              => 'content-cards',
                'title'             => __('Content Cards'),
                'description'       => __('A block displaying multiple content cards in a flexible grid layout.'),
                'render_callback'   => 'my_content_cards_block_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'grid-view',
                'keywords'          => array( 'cards', 'content', 'grid' ),
            ),
            array(
                'name'              => 'recent-posts-block',
                'title'             => __('Recent Posts Block'),
                'description'       => __('A block to display recent blog posts.'),
                'render_callback'   => 'my_recent_posts_block_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'admin-post',
                'keywords'          => array( 'recent', 'posts', 'blog' ),
            ),
            array(
                'name'              => 'stats-counter-block',
                'title'             => __('Stats/Counter Block'),
                'description'       => __('A block that displays multiple counters with numbers and labels.'),
                'render_callback'   => 'my_stats_counter_block_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'chart-bar',
                'keywords'          => array( 'stats', 'counter', 'numbers' ),
            ),
            array(
                'name'              => 'video-embed-block',
                'title'             => __('Video Embed Block'),
                'description'       => __('Embed YouTube or Vimeo videos with custom styling.'),
                'render_callback'   => 'my_video_embed_block_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'video-alt3',
                'keywords'          => array( 'video', 'embed', 'youtube', 'vimeo' ),
            ),
            array(
                'name'              => 'full-width-parallax-section',
                'title'             => __('Full Width Parallax Section'),
                'description'       => __('A full-width section with a parallax background image, title, and content.'),
                'render_callback'   => 'my_full_width_parallax_section_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'format-image',
                'keywords'          => array( 'parallax', 'background', 'section' ),
            ),
            array(
                'name'              => 'image-slider',
                'title'             => __('Image Slider'),
                'description'       => __('A carousel image slider block.'),
                'render_callback'   => 'my_image_slider_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'images-alt2',
                'keywords'          => array( 'slider', 'carousel', 'images' ),
            ),
            array(
                'name'              => 'two-column-section',
                'title'             => __('Two-Column Section'),
                'description'       => __('A flexible 2-column section with customizable content.'),
                'render_callback'   => 'my_two_column_section_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'columns',
                'keywords'          => array( '2-column', 'two', 'column' ),
            ),
            array(
                'name'              => 'list-block',
                'title'             => __('List Block'),
                'description'       => __('A customizable list block with options for ordered, unordered, or no-style lists.'),
                'render_callback'   => 'my_list_block_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'editor-ul',
                'keywords'          => array( 'list', 'items', 'content' ),
            ),
            array(
                'name'              => 'map-embed-block',
                'title'             => __('Map Embed Block'),
                'description'       => __('A full-width block for embedding maps.'),
                'render_callback'   => 'my_map_embed_block_render_callback',
                'category'          => 'custom-blocks',
                'icon'              => 'location-alt',
                'keywords'          => array( 'map', 'embed', 'location' ),
            ),
        );

        foreach( $blocks as $block ) {
            acf_register_block_type( $block );
        }
    }
}
add_action('acf/init', 'my_acf_init');