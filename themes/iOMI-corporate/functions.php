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