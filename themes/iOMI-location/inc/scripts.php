<?php
function themeiOMI_scripts($hook){
    wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap');
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/dist/css/app.css', array(), '1.1', 'all');
    wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/assets/dist/js/app.js', array('jquery'), '1.1', true);
}
add_action('wp_enqueue_scripts', 'themeiOMI_scripts');