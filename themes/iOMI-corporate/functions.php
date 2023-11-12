<?php

/**
 * themeiOMI functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package themeiOMI
 */


// Setup theme
if (!function_exists('iOMI_corporate')) :
    function iOMI_corporate(){

        // Let WordPress manage the document title.
        add_theme_support('title-tag');
    }
endif;
add_action('after_setup_theme', 'iOMI_corporate');

// Disable Gutemeberg
add_filter('use_block_editor_for_post', '__return_false');


/** Enqueue scripts and styles.**/
function themeiOMI_location_scripts(){
    $theme_dir = '/wp-content/themes/iOMI-location';
    wp_enqueue_style( 'locationStyles', $theme_dir . '/assets/dist/css/app.css', array(), '1.0.0', 'all');
    wp_enqueue_script('locationScripts', $theme_dir . '/assets/dist/js/app.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'themeiOMI_location_scripts');


// Get ACF Image function
function iOMI_get_Image($image){
    if ($image){
        $img_url = $image['url'];
        $img_alt = $image['alt'];
        $img_width = round($image['width'] / 2);
        $img_height = round($image['height'] / 2);
        $html = '<img src="' . $img_url . '" alt="' . $img_alt . '" width="' . $img_width . '" height="' . $img_height . '" >';
        echo $html;
    }
}

// Custom login
function custom_login() {
    $logo = get_field('logo', 'option');
    $logo_url = $logo['url'];

    echo '<style>';   
        echo 'body.login { background-color: #3f2560; }';
        echo '.login h1 a { background-image: url("' . esc_url($logo_url) . '") !important; width: 220px !important; height: 100px !important; background-size: contain !important; }';
        echo '.login #backtoblog a, .login #nav a, .language-switcher label .dashicons { display: block; text-align:center; color: #fff !important; }';
        echo '.login form { border-radius: 10px; }';
        echo '#wp-submit { transition: background-color 0.5s ease-in-out; background-color: #3f2560; text-transform: uppercase; font-weight: bold;border: none;border-radius: 5px;padding: 6px 24px;float: none;width: 100%;margin-top: 24px; }';
        echo '#wp-submit:hover {background-color: #673f9b;}';
        echo '.language-switcher {display: none;}';
     echo '</style>';
}

add_action('login_enqueue_scripts', 'custom_login');


function custom_login_logo_url($url) {
    return get_site_url();
}
add_filter('login_headerurl', 'custom_login_logo_url');