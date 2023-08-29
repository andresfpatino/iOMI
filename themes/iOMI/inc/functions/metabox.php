<?php 

function agregar_metabox() {
    add_meta_box(
        'datos_pedido',          
        'Datos del Pedido',          
        'mostrar_metabox_pedido', 
        'pedido',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'agregar_metabox');

function mostrar_metabox_pedido($post) {

    $nombre_completo = $post->post_title;
    $codigo_documento = get_post_meta($post->ID, 'documento', true); 
    $menu = get_post_meta($post->ID, 'menu', true);
    $sopa = get_post_meta($post->ID, 'sopa', true);
    $arroz = get_field('arroz', 'option');
    $proteina = get_post_meta($post->ID, 'proteina', true);
    $farinaceo = get_field('farinaceo', 'option');
    $principio_grano = get_field('principio_grano', 'option');
    $principio_verdura = get_field('principio_verdura', 'option');
    $ensalada = get_field('ensalada', 'option');
    $postre = get_field('postre', 'option');
    $bebida = get_field('bebida', 'option');    
    $comida_rapida = get_field('comida_rapida', 'option'); 

    echo "<p><strong>Nombre Completo: </strong>" . esc_attr($nombre_completo) . "</p>";
    echo "<p><strong>Código / Documento: </strong>" . esc_attr($codigo_documento) . "</p>";
    echo "<p><strong>Menu seleccionado: </strong>" . esc_attr($menu) . "</p>";

    echo "<hr>";
    
    if ( $menu === 'Menú del día') { 
        if( $sopa ){
            echo  "<p><strong>Sopa: </strong>" . esc_attr(ucfirst(strtolower($sopa))) . "</p>";
        }
        if($arroz ){
            echo  "<p><strong>Arroz: </strong>" . esc_attr(ucfirst(strtolower($arroz->post_title))) . "</p>";
        }
        if($proteina ){
            echo  "<p><strong>Proteína: </strong>" . esc_attr(ucfirst(strtolower($proteina))) . "</p>";
        }
        if($farinaceo ){
            echo  "<p><strong>Farináceo: </strong>" . esc_attr(ucfirst(strtolower($farinaceo->post_title))) . "</p>";
        }
        if($principio_grano ){
            echo  "<p><strong>Principio grano: </strong>" . esc_attr(ucfirst(strtolower($principio_grano->post_title))) . "</p>";
        }
        if($principio_verdura ){
            echo  "<p><strong>Principio verdura: </strong>" . esc_attr(ucfirst(strtolower($principio_verdura->post_title))) . "</p>";
        }

        if($ensalada ){
            echo  "<p><strong>Ensalada: </strong>" . esc_attr(ucfirst(strtolower($ensalada->post_title))) . "</p>";
        }
        if($postre ){
            echo  "<p><strong>Postre: </strong>" . esc_attr(ucfirst(strtolower($postre->post_title))) . "</p>";
        }
        if($bebida ){
            echo  "<p><strong>Bebida: </strong>" . esc_attr(ucfirst(strtolower($bebida->post_title))) . "</p>";
        }
    } else {       
        if( $comida_rapida ) {
            echo  "<p><strong>Menú alternativo: </strong>" . esc_attr(ucfirst(strtolower($comida_rapida->post_title))) . "</p>";
        }
    }
}