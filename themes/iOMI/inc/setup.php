<?php

// Setup theme
if (!function_exists('themeiOMI')) :
    function themeiOMI(){

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        
        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.   
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
    }
endif;
add_action('after_setup_theme', 'themeiOMI');

// Disable Guteneberg
add_filter('use_block_editor_for_post', '__return_false');

add_action('after_setup_theme', function () {
        // Remove type in style and script
        add_theme_support('html5', ['script', 'style']);
        // Disable Gutenberg Duotone Filter
        remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
        remove_action('in_admin_header', 'wp_global_styles_render_svg_filters');
    }
);

// Remove dashboard menu items
function remove_menu_items() {
    remove_menu_page('edit.php'); // corresponde a la página de entradas
    remove_menu_page('edit-comments.php'); // corresponde a la página de Comentarios
}
add_action('admin_menu', 'remove_menu_items');


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
/** Load default admin page **/
function cambiar_pagina_por_defecto() {
    wp_safe_redirect(admin_url("edit.php?post_type=pedido"));
    exit;
}
add_action('load-index.php', 'cambiar_pagina_por_defecto');

// Remove submenu add new pedido
function remove_add_new_pedido_subpage() {
    remove_submenu_page('edit.php?post_type=pedido', 'post-new.php?post_type=pedido');
}

add_action('admin_menu', 'remove_add_new_pedido_subpage');

// Remove add new pedido button
function remove_add_new_pedido_button() {
    global $post_type;

    if ('pedido' === $post_type) {
        echo '<style>.page-title-action { display: none; }</style>';
    }
}
add_action('admin_head', 'remove_add_new_pedido_button');