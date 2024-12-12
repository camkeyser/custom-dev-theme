<?php
// Render Callback Functions

// 1. Simple Text Block Render Callback
function my_simple_text_block_render_callback( $block ) {
    $header = get_field('simple_header');
    $text = get_field('simple_text') ?: 'Your simple text here...';
    $button = get_field('simple_button');
    $text = wpautop( wp_kses_post( $text ) );

    echo '<section class="simple-text-block">';
    
    if ( $header ) {
        echo '<h2>' . esc_html( $header ) . '</h2>';
    }

    echo $text;

    if ( $button ) {
        $button_url = esc_url( $button['url'] );
        $button_text = esc_html( $button['title'] );
        $button_target = $button['target'] ? ' target="' . esc_attr( $button['target'] ) . '"' : '';
        echo '<a class="simple-text-button" href="' . $button_url . '"' . $button_target . '>' . $button_text . '</a>';
    }

    echo '</section>';
}

// 2. Full Width Hero Image/Video Block Render Callback
function my_full_width_hero_image_render_callback( $block ) {
    $background_type = get_field('background_type');
    $image = get_field('hero_image');
    $video = get_field('hero_video');
    $heading = get_field('hero_heading');
    $content = get_field('hero_content');
    $button = get_field('hero_button');
    $layout = get_field('hero_layout') ?: 'centered';
    $tinted_overlay = get_field('tinted_overlay');
    $background_style = '';
    $video_element = '';

    // Determine background based on selected type
    if ($background_type === 'video' && $video) {
        $background_style = 'background-color: #0b1b2b;';
        $video_url = esc_url($video['url']);
        $video_element = '<video autoplay muted loop playsinline style="object-fit: cover; width: 100%; height: 100%; position: absolute; top: 0; left: 0; z-index: 0;"><source src="' . $video_url . '" type="' . esc_attr($video['mime_type']) . '"></video>';
    } elseif ($background_type === 'image' && $image) {
        $background_style = 'background-image: url(' . esc_url($image['url']) . ');';
    } else {
        // Fallback background color if no image or video is provided
        $background_style = 'background-color: #0b1b2b;';
    }

    echo '<section class="full-width-hero-image hero-layout-' . esc_attr($layout) . '" style="' . $background_style . '">';

    if ( $tinted_overlay ) {
        echo '<div class="hero-overlay tinted"></div>';
    }

    echo $video_element;
    echo '<div class="hero-flex">';

    if ( $heading ) {
        echo '<h1>' . esc_html($heading) . '</h1>';
    }

    if ( $content ) {
        echo '<p>' . esc_html($content) . '</p>';
    }

    if ( $button ) {
        $button_url = esc_url($button['url']);
        $button_text = esc_html($button['title']);
        $button_target = $button['target'] ? ' target="' . esc_attr($button['target']) . '"' : '';
        echo '<div class="hero-btn-contain"><a href="' . $button_url . '" class="hero-button"' . $button_target . '>' . $button_text . '</a></div>';
    }

    echo '</div></section>';
    echo '<section class="bc-container"><div class="breadcrumbs"><span>' . get_the_title() . '</span></div></section>';
}

// 3. Two-Column Block Render Callback
function my_two_column_section_render_callback( $block ) {
    $block_classes = isset($block['className']) ? esc_attr($block['className']) : '';
    
    $column_1_type = get_field('column_1_type');
    $column_1_text = get_field('column_1_text');
    $column_1_header = get_field('column_1_header');
    $column_1_image = get_field('column_1_image');
    
    $column_2_type = get_field('column_2_type');
    $column_2_text = get_field('column_2_text');
    $column_2_header = get_field('column_2_header');
    $column_2_image = get_field('column_2_image');

    // Append custom classes to the default class
    $section_classes = 'two-column-section ' . $block_classes;

    echo '<section class="' . $section_classes . '">';
    
    // Column 1
    echo '<div class="column column-1">';
    if ($column_1_type === 'text' && $column_1_text) {
        if ($column_1_header) {
            echo '<h2>' . esc_html($column_1_header) . '</h2>';
        }
        echo '<div class="column-text">' . wp_kses_post(wpautop($column_1_text)) . '</div>';
    } elseif ($column_1_type === 'image' && $column_1_image) {
        $file_url = esc_url($column_1_image['url']);
        $file_mime = esc_attr($column_1_image['mime_type']);

        // Check if the file is a WebM video
        if ($file_mime === 'video/webm') {
            echo '<div class="column-video">';
            echo '<video autoplay muted loop playsinline>';
            echo '<source src="' . $file_url . '" type="' . $file_mime . '">';
            echo 'Your browser does not support the WebM format.';
            echo '</video>';
            echo '</div>';
        } else {
            // Regular image
            echo '<div class="column-image">';
            echo '<img src="' . $file_url . '" alt="' . esc_attr($column_1_image['alt']) . '">';
            echo '</div>';
        }
    }
    echo '</div>';
    
    // Column 2
    echo '<div class="column column-2">';
    if ($column_2_type === 'text' && $column_2_text) {
        if ($column_2_header) {
            echo '<h2>' . esc_html($column_2_header) . '</h2>';
        }
        echo '<div class="column-text">' . wp_kses_post(wpautop($column_2_text)) . '</div>';
    } elseif ($column_2_type === 'image' && $column_2_image) {
        $file_url = esc_url($column_2_image['url']);
        $file_mime = esc_attr($column_2_image['mime_type']);

        // Check if the file is a WebM video
        if ($file_mime === 'video/webm') {
            echo '<div class="column-video">';
            echo '<video autoplay muted loop playsinline>';
            echo '<source src="' . $file_url . '" type="' . $file_mime . '">';
            echo 'Your browser does not support the WebM format.';
            echo '</video>';
            echo '</div>';
        } else {
            // Regular image
            echo '<div class="column-image">';
            echo '<img src="' . $file_url . '" alt="' . esc_attr($column_2_image['alt']) . '">';
            echo '</div>';
        }
    }
    echo '</div>';

    echo '</section>';
}

// 4. Accordion Block Render Callback
function my_accordion_block_render_callback( $block ) {
    $accordion_heading = get_field('accordion_heading');
    $accordion_items = get_field('accordion_items');
    $block_classes = isset($block['className']) ? esc_attr($block['className']) : '';

    if( $accordion_items ) {
        echo '<section class="accordion-block ' . $block_classes . '">';

        if ( $accordion_heading ) {
            echo '<h2 class="accordion-heading">' . esc_html( $accordion_heading ) . '</h2>';
        }

        foreach( $accordion_items as $item ) {
            echo '<div class="accordion-item">';
            echo '<button class="accordion-title">';
            echo esc_html( $item['title'] );
            echo '<i data-feather="chevron-down" class="accordion-icon"></i>';
            echo '</button>';
            echo '<div class="accordion-content">' . wp_kses_post( wpautop( $item['content'] ) ) . '</div>';
            echo '</div>';
        }

        echo '</section>';
    }
}

// 5. CTA Block Render Callback
function my_cta_block_render_callback( $block ) {
    $heading = get_field('cta_heading') ?: 'Your Heading Here';
    $description = get_field('cta_description');
    $button_text = get_field('cta_button_text') ?: 'Click Here';
    $button_url = get_field('cta_button_url') ?: '#';
    $background_image = get_field('cta_background_image');

    $background_style = '';
    if ( $background_image ) {
        $background_style = 'style="background-image: url(' . esc_url($background_image['url']) . ');"';
    }

    echo '<section class="cta-block" ' . $background_style . '>';
    echo '<div class="cta-content">';
    echo '<h2>' . esc_html($heading) . '</h2>';
    if ( $description ) {
        echo '<p>' . esc_html($description) . '</p>';
    }
    echo '<a class="cta-button" href="' . esc_url($button_url) . '">' . esc_html($button_text) . '</a>';
    echo '</div>';
    echo '</section>';
}

// 6. Gallery Grid Block Render Callback
function my_gallery_grid_block_render_callback( $block ) {
    $gallery_images = get_field('gallery_images');

    if ( $gallery_images ) {
        echo '<section class="gallery-grid-block">';
        echo '<div class="gallery-grid">';
        
        foreach ( $gallery_images as $image ) {
            echo '<div class="gallery-item">';
            echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '" data-fancybox="gallery" data-src="' . esc_url($image['url']) . '">';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</section>';
    }
}

// 7. Pricing Table Block Render Callback
function my_pricing_table_block_render_callback($block) {
    $table_heading = get_field('table_heading');
    $pricing_items = get_field('pricing_items');
    
    if ($pricing_items) {
        echo '<section class="pricing-table-block">';
        if ($table_heading) {
            echo '<h2 class="pricing-heading">' . esc_html($table_heading) . '</h2>';
        }
        echo '<div class="pricing-table">';
        
        foreach ($pricing_items as $index => $item) {
            $featured_class = !empty($item['is_featured']) ? ' pricing-item--featured' : '';
            
            echo '<div class="pricing-item' . $featured_class . '">';
            
            if (!empty($item['popular_tag'])) {
                echo '<span class="pricing-item__popular">Most Popular</span>';
            }
            
            echo '<div class="pricing-item__header">';
            echo '<h3 class="pricing-title">' . esc_html($item['item_name']) . '</h3>';
            echo '<div class="pricing-price-wrapper">';
            echo '<p class="pricing-price">' . esc_html($item['item_price']) . '</p>';
            if (!empty($item['price_period'])) {
                echo '<span class="pricing-period">' . esc_html($item['price_period']) . '</span>';
            }
            echo '</div>';
            echo '<p class="pricing-description">' . esc_html($item['item_description']) . '</p>';
            echo '</div>';

            if ($item['item_features']) {
                echo '<ul class="pricing-features">';
                foreach ($item['item_features'] as $feature) {
                    echo '<li class="pricing-feature-item">';
                    echo '<svg class="pricing-feature-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                    echo esc_html($feature['feature']);
                    echo '</li>';
                }
                echo '</ul>';
            }
            
            if (!empty($item['cta_button'])) {
                echo '<a href="' . esc_url($item['cta_button']['url']) . '" class="pricing-button">' . 
                     esc_html($item['cta_button']['title']) . '</a>';
            }
            
            echo '</div>';
        }
        echo '</div>';
        echo '</section>';
    }
}

// 8. Team Member Block Render Callback
function my_team_member_block_render_callback( $block ) {
    $team_heading = get_field('team_heading');
    $team_content = get_field('team_content');
    $team_members = get_field('team_members');

    if ( $team_members ) {
        echo '<div class="top-divide"></div>';
        echo '<section class="team-member-block">';
        
        if ( $team_heading ) {
            echo '<h2>' . esc_html( $team_heading ) . '</h2>';
        } else {
            echo '<h2>Meet Our Team</h2>';
        }

        if ( $team_content ) {
            echo '<div class="team-content">' . wp_kses_post( wpautop( $team_content ) ) . '</div>';
        }

        echo '<div class="team-member-grid">';

        foreach ( $team_members as $member ) {
            $image = $member['team_member_image'];
            $image_url = $image ? esc_url( $image['url'] ) : '';
            $name = esc_html( $member['team_member_name'] );
            $position = esc_html( $member['team_member_position'] );
            $bio = wp_kses_post( wpautop( $member['team_member_bio'] ) );
            $social_links = $member['team_member_social_links'];

            echo '<div class="team-member"><div class="blob-animation" style="width: 200px; height: 200px;"></div>';
            if ( $image_url ) {
                echo '<div class="team-member-image">';
                echo '<img src="' . $image_url . '" alt="' . $name . '">';
                echo '</div>';
            }
            echo '<div class="team-member-info">';
            echo '<h3><span class="position">' . $position . '</span>&nbsp; &nbsp;<br />' . $name . '</h3>';

            if ( $social_links ) {
                echo '<div class="social-links">';
                foreach ( $social_links as $link ) {
                    $link_url = $link['url'];
                    $icon_name = esc_attr( $link['icon'] );

                    // Adjust href for phone and email
                    if ( $icon_name === 'phone' ) {
                        $href = 'tel:' . preg_replace( '/[^0-9+]/', '', $link_url );
                        $href = esc_attr( $href );
                    } elseif ( $icon_name === 'mail' ) {
                        $email = sanitize_email( $link_url );
                        $href = 'mailto:' . $email;
                        $href = esc_attr( $href );
                    } else {
                        $href = esc_url( $link_url );
                    }

                    echo '<a href="' . $href . '" target="_blank" aria-label="' . esc_attr( ucfirst( $icon_name ) ) . '">';
                    echo '<i data-feather="' . $icon_name . '"></i>';
                    echo '</a>';
                }
                echo '</div>';
            }
            echo '<div class="bio">' . $bio . '</div>';

            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
        echo '</section>';
        echo '<div class="bot-divide"></div>';
    }
}

// 9. Content Cards Block Render Callback
function my_content_cards_block_render_callback($block) {
    $cards = get_field('cards');
    $columns = get_field('columns') ?: 3;
    $style = get_field('card_style') ?: 'default';
    $spacing = get_field('card_spacing') ?: 'normal';
    
    if ($cards) {
        $block_classes = array(
            'content-cards-block',
            'content-cards--cols-' . $columns,
            'content-cards--style-' . $style,
            'content-cards--spacing-' . $spacing
        );
        
        echo '<section class="' . esc_attr(implode(' ', $block_classes)) . '">';
        echo '<div class="content-cards-grid">';
        
        foreach ($cards as $index => $card) {
            $card_classes = array('content-card');
            $delay = $index * 0.1;
            $style_attr = 'style="--card-delay: ' . $delay . 's"';
            
            if (!empty($card['highlight_card'])) {
                $card_classes[] = 'content-card--highlighted';
            }
            
            echo '<div class="' . esc_attr(implode(' ', $card_classes)) . '" ' . $style_attr . '>';
            
            if (!empty($card['icon'])) {
                echo '<div class="content-card__icon">';
                echo wp_get_attachment_image($card['icon'], 'thumbnail');
                echo '</div>';
            }
            
            echo '<div class="content-card__content">';
            
            if (!empty($card['eyebrow'])) {
                echo '<div class="content-card__eyebrow">' . esc_html($card['eyebrow']) . '</div>';
            }
            
            echo '<h3 class="content-card__title">' . esc_html($card['title']) . '</h3>';
            
            if (!empty($card['text'])) {
                echo '<p class="content-card__text">' . esc_html($card['text']) . '</p>';
            }
            
            if (!empty($card['button_text']) && !empty($card['button_link'])) {
                echo '<a class="content-card__button" href="' . esc_url($card['button_link']) . '">';
                echo '<span>' . esc_html($card['button_text']) . '</span>';
                echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="content-card__button-icon" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
                echo '</a>';
            }
            
            echo '</div>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</section>';
    }
}

// 10. Recent Posts Block Render Callback
function my_recent_posts_block_render_callback( $block ) {
    $number_of_posts = get_field('number_of_posts') ?: 3;
    $show_excerpt = get_field('show_excerpt');

    // Calculate columns based on the number of posts, capped between 1 and 6
    $columns = min(max($number_of_posts, 1), 6);

    $recent_posts = new WP_Query(array(
        'posts_per_page' => $number_of_posts,
        'post_status'    => 'publish'
    ));

    if ($recent_posts->have_posts()) {
        echo '<section class="recent-posts-block">';
        echo '<h2>Recent Blog Posts</h2>';
        echo '<div class="recent-posts-grid" style="grid-template-columns: repeat(' . esc_attr($columns) . ', 1fr);">';
        while ($recent_posts->have_posts()) {
            $recent_posts->the_post();
            echo '<a href="' . get_permalink() . '" class="recent-post-card">';
            if (has_post_thumbnail()) {
                echo '<div class="post-thumbnail">';
                echo get_the_post_thumbnail(get_the_ID(), 'medium');
                echo '</div>';
            } else {
                echo '<div class="post-thumbnail">';
                echo '<img src="' . get_template_directory_uri() . '/img/blog-fb.jpg" alt="' . esc_attr(get_the_title()) . '">';
                echo '</div>';
            }
            echo '<div class="post-content">';
            echo '<h3 class="post-title">' . get_the_title() . '</h3>';
            if ($show_excerpt) {
                echo '<div class="post-excerpt">' . get_the_excerpt() . '</div>';
            }
            echo '</div>';
            echo '</a>';
        }
        echo '</div>';
        echo '</section>';
        wp_reset_postdata();
    } else {
        echo '<p>No recent posts available.</p>';
    }
}

// 11. Stats Counter Block Render Callback
function my_stats_counter_block_render_callback( $block ) {
    $counters = get_field('counters');
    $columns = get_field('columns') ?: '3';

    if( $counters ) {
        echo '<div class="stats-top-divide"></div>';
        echo '<section class="stats-counter-block">';
        echo '<h2>Our Achievements</h2>';
        echo '<div class="stats-grid" style="grid-template-columns: repeat(' . esc_attr($columns) . ', 1fr);">';

        foreach( $counters as $counter ) {
            $number_color = $counter['number_color'] ?: '#0f5fb5';
            $symbol_color = $counter['symbol_color'] ?: '#0f5fb5';
            $symbol = $counter['symbol'] ?: '';
            $symbol_position = $counter['symbol_position'] ?: 'before';

            echo '<div class="stats-item">';
            echo '<span class="stats-number" style="color: ' . esc_attr($number_color) . ';">';

            if ($symbol_position === 'before' && $symbol) {
                echo '<i data-feather="' . esc_attr($symbol) . '" style="color: ' . esc_attr($symbol_color) . ';"></i> ';
            }

            echo '<span class="stats-count" data-count="' . esc_attr($counter['number']) . '">0</span>';

            if ($symbol_position === 'after' && $symbol) {
                echo ' <i data-feather="' . esc_attr($symbol) . '" style="color: ' . esc_attr($symbol_color) . ';"></i>';
            }

            echo '</span>';
            echo '<span class="stats-label">' . esc_html($counter['label']) . '</span>';
            echo '</div>';
        }

        echo '</div>';
        echo '</section>';
        echo '<div class="stats-bot-divide"></div>';
    }
}

// 12. Video Embed Block Render Callback
function my_video_embed_block_render_callback( $block ) {
    $embed_code = get_field('embed_code');
    
    if ( $embed_code ) {
        echo '<section class="video-embed-block" style="max-width: 1000px; margin: 0 auto;">';
        echo $embed_code;
        echo '</section>';
    }
}

// 13. Full Width Parallax Section Block Render Callback
function my_full_width_parallax_section_render_callback( $block ) {
    $background_image = get_field('parallax_background_image');
    $title = get_field('parallax_title') ?: '';
    $content = get_field('parallax_content') ?: '';
    $animation = get_field('animations');
    $background_url = $background_image ? $background_image['url'] : '';

    if ( $background_url ) {
        $animation_class = '';
        if ( $animation && $animation !== 'none' ) {
            $animation_class = ' animation-' . esc_attr( $animation );
        }

        echo '<section class="full-width-parallax-section' . $animation_class . '" style="background-image: url(' . esc_url($background_url) . ');">';
        echo '<div class="parallax-content">';
        if ($title) {
            echo '<h2>' . esc_html($title) . '</h2>';
        }
        echo wpautop( wp_kses_post($content) );
        echo '</div>';
        echo '</section>';
    }
}

// 14. Image Slider Block Render Callback
function my_image_slider_render_callback( $block ) {
    $slider_id = 'splide-' . uniqid();
    $block_classes = isset($block['className']) ? esc_attr($block['className']) : '';

    if ( have_rows('slider_images') ) {
        echo '<section id="' . esc_attr( $slider_id ) . '" class="splide ' . $block_classes . '">';
        echo '<div class="splide__track">';
        echo '<ul class="splide__list">';

        while ( have_rows('slider_images') ) {
            the_row();
            $image = get_sub_field('image');

            if ( $image ) {
                if ( is_array( $image ) && isset( $image['url'] ) ) {
                    $image_url = $image['url'];
                    $image_alt = $image['alt'];
                } else {
                    continue;
                }

                echo '<li class="splide__slide">';
                echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $image_alt ) . '" data-fancybox="slider-gallery" data-src="' . esc_url( $image_url ) . '">';
                echo '</li>';
            }
        }

        echo '</ul>';
        echo '</div>';
        echo '</section>';
    }
}

// 15. List Block Render Callback
function my_list_block_render_callback( $block ) {
    $header = get_field('header');
    $text = get_field('text');
    $list_type = get_field('list_type');
    $column_count = get_field('column_count') ?: 'one';
    $list_items = get_field('list_items');
    $list_tag = ($list_type == 'ol') ? 'ol' : 'ul';
    $list_classes = ['list-items'];

    if ($list_type == 'none') {
        $list_classes[] = 'list-no-style';
    } elseif (in_array($list_type, ['check-circle', 'chevrons-right', 'circle', 'plus', 'shield', 'slash', 'star', 'zap'])) {
        $list_classes[] = 'list-no-style';
        $list_classes[] = 'list-icon';
        $list_classes[] = 'list-' . $list_type;
    }
    
    $column_class = 'columns-' . $column_count;
    
    echo '<section class="list-block-section ' . esc_attr($column_class) . '">';
    echo '<div class="list-block">';
    if ( $header ) {
        echo '<h2>' . esc_html( $header ) . '</h2>';
    }
    if ( $text ) {
        echo '<p>' . esc_html( $text ) . '</p>';
    }
    if ( $list_items ) {
        echo '<' . $list_tag . ' class="' . esc_attr(implode(' ', $list_classes)) . '">';
        foreach ( $list_items as $item ) {
            if (in_array($list_type, ['check-circle', 'chevrons-right', 'circle', 'plus', 'shield', 'slash', 'star', 'zap'])) {
                echo '<li><i data-feather="' . esc_attr($list_type) . '"></i>' . esc_html( $item['list_item'] ) . '</li>';
            } else {
                echo '<li>' . esc_html( $item['list_item'] ) . '</li>';
            }
        }
        echo '</' . $list_tag . '>';
    }
    echo '</div>';
    echo '</section>';
}

// 16. Map Embed Block Render Callback
function my_map_embed_block_render_callback( $block ) {
    $embed_code = get_field('map_embed_code');
    
    if ( $embed_code ) {
        echo '<section class="map-embed-block" style="width: 100%; height: 500px;">';
        echo $embed_code;
        echo '</section>';
    }
}