<?php

/**
 * themeiOMI First functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package themeiOMI
 */


/** Setup **/
require_once 'inc/setup.php';

/** Enqueue scripts and styles.**/
require_once 'inc/scripts.php';

/** Performance **/
require_once 'inc/performance.php';

/** Shortcodes **/
require_once 'inc/shortcodes.php';

/** Form submission **/
require_once 'inc/functions/form.php';

/** Metabox Pedido **/
require_once 'inc/functions/metabox.php';

/** Count de Pedidos **/
require_once 'inc/functions/count-pedidos.php';

/** Custom columns **/
require_once 'inc/functions/columns.php';

/** Custom login **/
require_once 'inc/functions/custom-login.php';

/** Custom label **/
function cambiar_texto_boton_publicar_js() {
    global $post;
    
    if (is_admin() && $post && $post->post_type == 'pedido') { ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var publishButton = document.querySelector('#publish');
                if (publishButton && publishButton.value === 'Publicar') {
                    publishButton.value = 'Entregar';
                }
            });
        </script> <?php
    }
}
add_action('admin_footer', 'cambiar_texto_boton_publicar_js');