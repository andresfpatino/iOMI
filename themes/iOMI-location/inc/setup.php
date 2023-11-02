<?php

// Setup theme
if (!function_exists('themeiOMI')) :
    function themeiOMI(){

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

        register_nav_menus(array(
            'menu' => esc_html__('Header', 'iOMI'),
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

if (is_main_site()){ 
    /** Load default admin page **/
    function cambiar_pagina_por_defecto() {
        wp_safe_redirect(admin_url("edit.php?post_type=pedido"));
        exit;
    }
    add_action('load-index.php', 'cambiar_pagina_por_defecto');
}

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

// Menu items frontend
function menu_item($field_name, $show_label = true) {
    $field_data = get_field_object($field_name);
    $field_values = get_field($field_name);

    if ($field_values) {
        echo '<li>';
        
        // Verifica si $show_label es verdadero antes de mostrar la etiqueta
        if ($show_label) {
            echo '<strong>' . esc_html($field_data['label']) . ':</strong>';
        }

        // Verifica si $field_values es un array
        if (is_array($field_values)) {
            foreach ($field_values as $value) {
                echo '<p>' . ucfirst(strtolower(get_the_title($value->ID))) . '</p>';

                $excerpt = get_the_excerpt($value->ID);
                if (!empty($excerpt)) {
                    echo '<p><i>' . $excerpt . '</i></p>';
                }
            }
        } else { // Si no es un array, es un solo objeto
            echo '<p>' . ucfirst(strtolower(get_the_title($field_values->ID))) . '</p>';

            $excerpt = get_the_excerpt($field_values->ID);
            if (!empty($excerpt)) {
                echo '<p><i>' . $excerpt . '</i></p>';
            }
        }

        echo '</li>';
    }
}


function mostrar_campos_acf($campo_name, $legend_text) {
    $campos = get_field($campo_name);
    if ($campos) :
        echo '<fieldset class="form-group data">';
        echo '<legend>' . esc_html($legend_text) . '</legend>';
        foreach ($campos as $campo) :
            $title = get_the_title($campo->ID);
            $formatted_title = ucfirst(strtolower($title));
            echo '<span class="form-field">';
            echo '<label>';
            echo '<input type="radio" name="' . esc_attr($campo_name) . '" value="' . esc_attr($formatted_title) . '"> ' . esc_html($formatted_title);
            echo '</label>';
            echo '</span>';
        endforeach;
        echo '</fieldset>';
    endif;
}