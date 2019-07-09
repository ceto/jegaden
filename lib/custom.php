<?php
    // 1. customize ACF path
    add_filter('acf/settings/path', 'jegaden_acf_settings_path');
    function jegaden_acf_settings_path( $path ) {
        $path = get_stylesheet_directory() . '/lib/acf/';
        return $path;
    }

    // 2. customize ACF dir
    add_filter('acf/settings/dir', 'jegaden_acf_settings_dir');
    function jegaden_acf_settings_dir( $dir ) {
    $dir = get_stylesheet_directory_uri() . '/lib/acf/';
    return $dir;
    }

    // 3. Hide ACF field group menu item
    //add_filter('acf/settings/show_admin', '__return_false');

    // 4. Include ACF
    include_once( get_stylesheet_directory() . '/lib/acf/acf.php' );

    // 5. Unhide native metabox
    add_filter('acf/settings/remove_wp_meta_box', '__return_false');

    /** Create Options Pages */
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title' 	=> 'Globals',
            'menu_title'	=> 'Globals',
            'menu_slug' 	=> 'globals',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ));
    }
