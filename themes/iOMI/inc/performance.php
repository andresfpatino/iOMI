<?php

add_action('wp_loaded', 'themeiOMI_prefix_output_buffer_start');
function themeiOMI_prefix_output_buffer_start(){
    ob_start("themeiOMI_prefix_output_callback");
}

add_action('shutdown', 'themeiOMI_prefix_output_buffer_end');
function themeiOMI_prefix_output_buffer_end(){
    ob_end_flush();
}

function themeiOMI_prefix_output_callback($buffer){
    return preg_replace("%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", '', $buffer);
}


// Add `loading="lazy"` attribute to images output by the_post_thumbnail().
function themeiOMI_modify_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr){
    return str_replace('<img', '<img loading="lazy"', $html);
}
add_filter('post_thumbnail_html', 'themeiOMI_modify_post_thumbnail_html', 10, 5);
