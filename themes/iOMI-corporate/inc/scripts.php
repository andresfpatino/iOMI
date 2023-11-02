<?php

function themeiOMI_location_scripts(){

    $parenthandle = 'iOMI';

    wp_enqueue_style($parenthandle, get_template_directory_uri() . '/assets/dist/css/app.css', array(), '1.0.0', 'all');
    wp_enqueue_script($parenthandle, get_template_directory_uri() . '/assets/dist/js/app.js', array('jquery'), '1.0', true);
    wp_enqueue_style('locationStyles', get_stylesheet_directory_uri() . '/assets/dist/css/app.css', array($parenthandle), '1.0');
    wp_enqueue_script('locationScripts', get_stylesheet_directory_uri() . '/assets/dist/js/app.js', array('jquery'), '1.0', true);

}
add_action('wp_enqueue_scripts', 'themeiOMI_location_scripts');