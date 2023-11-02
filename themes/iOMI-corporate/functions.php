<?php

/**
 * themeiOMI First functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package themeiOMI
 */


/** Enqueue scripts and styles.**/
require_once 'inc/scripts.php';

// Disable Guteneberg
add_filter('use_block_editor_for_post', '__return_false');

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