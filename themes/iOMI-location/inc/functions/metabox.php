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
    $sopa = get_post_meta($post->ID, 'sopa_o_crema', true);
    $arroz = get_post_meta($post->ID, 'arroz', true);
    $proteina = get_post_meta($post->ID, 'proteinas', true);
    $farinaceo = get_post_meta($post->ID, 'farinaceo', true);
    $principio_grano = get_post_meta($post->ID, 'principio_grano', true);
    $principio_verdura =  get_post_meta($post->ID, 'principio_verdura', true);
    $ensalada = get_post_meta($post->ID, 'ensalada', true);
    $postre = get_post_meta($post->ID, 'postre', true);
    $bebida = get_post_meta($post->ID, 'bebida', true);
    $comida_rapida =  get_post_meta($post->ID, 'comida_rapida', true);

    echo "<p><strong>Nombre Completo: </strong>" . esc_attr($nombre_completo) . "</p>";
    echo "<p><strong>Código / Documento: </strong>" . esc_attr($codigo_documento) . "</p>";
    echo "<p><strong>Menu seleccionado: </strong>" . esc_attr($menu) . "</p>";

    echo "<hr>";
    
    if ( $menu === 'Menú del día') { 
        if( $sopa ){
            echo  "<p><strong>Sopa: </strong>" . esc_attr(ucfirst(strtolower($sopa))) . "</p>";
        }
        if($arroz ){
            echo  "<p><strong>Arroz: </strong>" . esc_attr(ucfirst(strtolower($arroz))) . "</p>";
        }
        if($proteina ){
            echo  "<p><strong>Proteína: </strong>" . esc_attr(ucfirst(strtolower($proteina))) . "</p>";
        }
        if($farinaceo ){
            echo  "<p><strong>Farináceo: </strong>" . esc_attr(ucfirst(strtolower($farinaceo))) . "</p>";
        }
        if($principio_grano ){
            echo  "<p><strong>Principio grano: </strong>" . esc_attr(ucfirst(strtolower($principio_grano))) . "</p>";
        }
        if($principio_verdura ){
            echo  "<p><strong>Principio verdura: </strong>" . esc_attr(ucfirst(strtolower($principio_verdura))) . "</p>";
        }

        if($ensalada ){
            echo  "<p><strong>Ensalada: </strong>" . esc_attr(ucfirst(strtolower($ensalada))) . "</p>";
        }
        if($postre ){
            echo  "<p><strong>Postre: </strong>" . esc_attr(ucfirst(strtolower($postre))) . "</p>";
        }
        if($bebida ){
            echo  "<p><strong>Bebida: </strong>" . esc_attr(ucfirst(strtolower($bebida))) . "</p>";
        }
    } else {       
        if( $comida_rapida ) {
            echo  "<p><strong>Menú alternativo: </strong>" . esc_attr(ucfirst(strtolower($comida_rapida))) . "</p>";
        }
    }
}