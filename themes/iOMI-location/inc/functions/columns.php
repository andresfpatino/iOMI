<?php 

add_filter('manage_pedido_posts_columns', 'reorganizar_agregar_columna_estado');
function reorganizar_agregar_columna_estado($columns) {
    $date_column = $columns['date'];
    unset($columns['date']);

    // Agregar las columnas personalizadas en el orden deseado
    $columns['numero_documento'] = 'Cód. Doc. Identidad';
    $columns['menu_seleccionado'] = 'Menú Seleccionado';
    $columns['estado'] = 'Estado';
    $columns['fecha_pedido'] = 'Fecha de entrega';

    // Agregar nuevamente la columna de fecha al final
    $columns['date'] = 'Fecha del pedido';

    return $columns;
}

add_action('manage_pedido_posts_custom_column', 'mostrar_valores_columnas_personalizadas_estado', 10, 2);
function mostrar_valores_columnas_personalizadas_estado($column, $post_id) {
    if ($column === 'numero_documento') {
        $numero_documento = get_post_meta($post_id, 'documento', true);
        echo $numero_documento;
    } elseif ($column === 'menu_seleccionado') {
        $menu_seleccionado = get_post_meta($post_id, 'menu', true);
        echo $menu_seleccionado;
    } elseif ($column === 'estado') {
        $post_status = get_post_status($post_id);

        if ($post_status === 'pending') {
            echo '<span style="background-color: orange; color: #fff; padding: 3px 6px; border-radius: 5px; width: 90px; text-transform: uppercase; display: inline-block; text-align: center;">Pendiente</span>';
        }
        if($post_status === 'publish') {
            echo '<span style="background-color: green; color: #fff; padding: 3px 6px; border-radius: 5px; width: 90px; text-transform: uppercase; display: inline-block; text-align: center;">Entregado</span>';
        }

        echo $estado_etiqueta;
    } elseif ($column === 'fecha_pedido') {
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $fecha_pedido =  get_post_meta($post_id, 'fecha_pedido', true);
        $fecha = date_create_from_format('Y-m-d', $fecha_pedido);
        $fecha_formateada = strftime('%e de %B %Y', $fecha->getTimestamp());
        echo $fecha_formateada;
    }
}