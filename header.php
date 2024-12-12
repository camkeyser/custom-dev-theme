<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(); ?></title>    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="container">
            <div class="site-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?>">
                </a>
            </div>
            <nav class="site-navigation">
                <?php
                    // Include the custom walker class
                    require_once get_template_directory() . '/inc/class-custom-menu-walker.php';

                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'primary-menu',
                        'container'      => false,
                        'walker'         => new Custom_Menu_Walker(),
                    ) );
                ?>
                <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
            </nav>
            
            <!-- Hamburger Menu -->
            <div class="hamburger-icon" aria-label="Toggle Navigation" role="button" tabindex="0">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

     <!-- Placeholder for Header -->
     <div class="header-placeholder"></div>

    <!-- Full-Screen Mobile Menu -->
    <div class="fullscreen-menu">
        <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => 'fullscreen-menu-list',
                'container'      => false,
            ) );
        ?>
        <div class="ham-socials">
            <div class="hs-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" xml:space="preserve" enable-background="new 0 0 24 24"><path d="M14.095 10.316 22.286 1h-1.94L13.23 9.088 7.551 1H1l8.59 12.231L1 23h1.94l7.51-8.543L16.45 23H23l-8.905-12.684zm-2.658 3.022-.872-1.218L3.64 2.432h2.98l5.59 7.821.869 1.219 7.265 10.166h-2.982l-5.926-8.3z" fill="#ffffff" class="fill-000000"></path></svg>
            </div>
            <div class="hs-icon">
                <svg data-name="Google alt" width="24px" height="24px" viewBox="0 0 420 419.997" xmlns="http://www.w3.org/2000/svg"><path d="M342.818 100.279a24.3 24.3 0 1 1-24.295-24.295 24.3 24.3 0 0 1 24.295 24.295ZM420 209.999l-.005.306-1.38 88.105a121.58 121.58 0 0 1-120.2 120.2L210 419.999l-.306-.006-88.105-1.376a121.586 121.586 0 0 1-120.206-120.2L0 209.999l.006-.306 1.376-88.108a121.59 121.59 0 0 1 120.206-120.2L210-.001l.306.006 88.105 1.376a121.584 121.584 0 0 1 120.2 120.2Zm-39.112 0-1.374-87.8A82.654 82.654 0 0 0 297.8 40.484L210 39.113l-87.8 1.371a82.658 82.658 0 0 0-81.716 81.715l-1.371 87.8 1.371 87.8a82.655 82.655 0 0 0 81.716 81.715l87.8 1.371 87.8-1.371a82.651 82.651 0 0 0 81.714-81.715Zm-63.048 0A107.841 107.841 0 1 1 210 102.158a107.962 107.962 0 0 1 107.84 107.841Zm-39.107 0A68.734 68.734 0 1 0 210 278.733a68.812 68.812 0 0 0 68.732-68.734Z" fill="#ffffff" class="fill-000000"></path></svg>
            </div>
            <div class="hs-icon">
                <svg width="24px" height="24px" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"><path d="m374.245 285.825 14.104-91.961h-88.233v-59.677c0-25.159 12.325-49.682 51.845-49.682h40.117V6.214S355.67 0 320.864 0c-72.67 0-120.165 44.042-120.165 123.775v70.089h-80.777v91.961h80.777v222.31A320.442 320.442 0 0 0 250.408 512a320.42 320.42 0 0 0 49.708-3.865v-222.31h74.129Z" fill="#ffffff" fill-rule="nonzero" class="fill-1877f2"></path></svg>
            </div>
        </div>
    </div>