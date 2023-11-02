<?php 

function registrar_contador_pedidos() {
    add_option('contador_pedidos', 0);
}
add_action('init', 'registrar_contador_pedidos');

function actualizar_contador_pedidos($post_id) {
    if (get_post_type($post_id) === 'pedido') {
        $estado = get_post_status($post_id);
        $contador_actual = get_option('contador_pedidos');
        
        if ($estado === 'pending') {
            update_option('contador_pedidos', $contador_actual + 1);
        } elseif ($estado === 'publish' || $estado === 'trash' || $estado === 'auto-draft') {
            $pendientes = wp_count_posts('pedido')->pending;
            update_option('contador_pedidos', $pendientes);
        }
    }
}
add_action('save_post', 'actualizar_contador_pedidos');

function agregar_burbuja_pedidos_admin() {
    $contador_pedidos = get_option('contador_pedidos');
    
    if ($contador_pedidos > 0) { ?>
        <script>
            (function($) {
                $(document).ready(function() {
                    var contador = <?php echo $contador_pedidos; ?>;
                    var $menuPedido = $('#menu-posts-pedido');

                    // Remover badge existente y agregar el nuevo
                    $menuPedido.find('.contador-badge').remove();
                    $menuPedido.append('<span class="update-plugins count-' + contador + ' contador-badge" style="position: absolute; top: 6px; right: 20px;"><span class="plugin-count">' + contador + '</span></span>');
                });
            })(jQuery);
        </script>
        <?php
    }
}
add_action('admin_footer', 'agregar_burbuja_pedidos_admin');
