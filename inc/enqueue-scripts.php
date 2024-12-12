<?php
// Enqueue styles and scripts
function custom_theme_enqueue_assets() {
    // Enqueue Google Fonts
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Righteous&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap', array(), null );

    // Enqueue header styles
    wp_enqueue_style( 'header-style', get_template_directory_uri() . '/css/header.css' );

    // Enqueue main styles
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/css/style.css' );

    // Enqueue block folder styles
    $block_css_files = glob(get_template_directory() . '/css/blocks/*.css');
    foreach ($block_css_files as $file) {
        $file_name = basename($file, '.css');
        wp_enqueue_style($file_name, get_template_directory_uri() . '/css/blocks/' . $file_name . '.css');
    }

    // Enqueue footer styles
    wp_enqueue_style( 'footer-style', get_template_directory_uri() . '/css/footer.css' );

    // Enqueue Splide CSS
    wp_enqueue_style( 'splide-css', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.0/dist/css/splide.min.css', array(), '4.1.0' );

    // Enqueue Splide JS
    wp_enqueue_script( 'splide-js', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.0/dist/js/splide.min.js', array(), '4.1.0', true );

    // Enqueue GSAP and ScrollTrigger
    wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js', array(), '3.11.4', true );
    wp_enqueue_script( 'gsap-scrolltrigger-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js', array('gsap-js'), '3.11.4', true );

    // Enqueue Feather icons and initialize
    wp_enqueue_script( 'feather-icons', 'https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js', array(), null, true );
    wp_add_inline_script( 'feather-icons', 'feather.replace()' );

    // Enqueue Fancybox CSS and JS
    wp_enqueue_style( 'fancybox-css', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css', array(), '5.0' );
    wp_enqueue_script( 'fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array(), '5.0', true );

    // Enqueue Lottie JS
    wp_enqueue_script( 'lottie-js', 'https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js', array(), '5.9.6', true );

    // Enqueue custom script
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array('splide-js', 'gsap-js', 'gsap-scrolltrigger-js', 'feather-icons', 'fancybox-js', 'lottie-js'), null, true );

    // Localize script to pass theme URL and fallback images to JS
    wp_localize_script( 'main-js', 'themeData', array(
        'themeUrl' => get_template_directory_uri(),
        'fallbackImages' => array(
            'page' => get_template_directory_uri() . '/img/search-icon-page.png',
            'post' => get_template_directory_uri() . '/img/search-icon-blog.png'
        ),
    ));
}
add_action( 'wp_enqueue_scripts', 'custom_theme_enqueue_assets' );

// Enqueue editor styles for custom blocks
function my_enqueue_block_editor_assets() {
    wp_enqueue_style( 'my-block-editor-styles', get_template_directory_uri() . '/css/editor-styles.css', array(), '1.0' );
}
add_action( 'enqueue_block_editor_assets', 'my_enqueue_block_editor_assets' );