<?php 

function custom_post_form_submission() {
    if (
        isset($_POST['pedido_form_nonce'], $_POST['nombre'], $_POST['apellido'], $_POST['documento'], $_POST['menu']) &&
        wp_verify_nonce($_POST['pedido_form_nonce'], 'pedido_form_nonce')
    ) {
        $logo = get_field('logo', 'option');
        $logo_url = $logo['url'];
        $siteURL = get_site_url();
        $nombre = sanitize_text_field($_POST['nombre']);
        $apellido = sanitize_text_field($_POST['apellido']);
        $post_title = $nombre . ' ' . $apellido;
        $menu = sanitize_text_field($_POST['menu']);
        $arroz = sanitize_text_field($_POST['arroz']);
        $farinaceo = sanitize_text_field($_POST['farinaceo']);
        $principioGrano = sanitize_text_field($_POST['principio_grano']);
        $principioVerdura =  sanitize_text_field($_POST['principio_verdura']);
        $ensalada = sanitize_text_field($_POST['ensalada']);
        $postre = sanitize_text_field($_POST['postre']);
        $bebida = sanitize_text_field($_POST['bebida']);
        $comida_rapida = sanitize_text_field($_POST['comida_rapida']);

        $post_data = array(
            'post_title'   => $post_title,
            'post_status'  => 'pending',
            'post_type'    => 'pedido',
        );

        $post_id = wp_insert_post($post_data);
        $pedidoURL = "$siteURL/wp-admin/post.php?post=$post_id&action=edit";

        update_post_meta($post_id, 'documento', sanitize_text_field($_POST['documento']));
        update_post_meta($post_id, 'menu', sanitize_text_field($_POST['menu']));
        update_post_meta($post_id, 'sopa_o_crema', sanitize_text_field($_POST['sopa_o_crema'] ?? ''));
        update_post_meta($post_id, 'proteinas', sanitize_text_field($_POST['proteinas'] ?? ''));
        update_post_meta($post_id, 'arroz', sanitize_text_field($_POST['arroz'] ?? ''));
        update_post_meta($post_id, 'farinaceo', sanitize_text_field($_POST['farinaceo'] ?? ''));
        update_post_meta($post_id, 'principio_grano', sanitize_text_field($_POST['principio_grano'] ?? ''));
        update_post_meta($post_id, 'principio_verdura', sanitize_text_field($_POST['principio_verdura'] ?? ''));
        update_post_meta($post_id, 'ensalada', sanitize_text_field($_POST['ensalada'] ?? ''));
        update_post_meta($post_id, 'postre', sanitize_text_field($_POST['postre'] ?? ''));
        update_post_meta($post_id, 'bebida', sanitize_text_field($_POST['bebida'] ?? ''));
        update_post_meta($post_id, 'comida_rapida', sanitize_text_field($_POST['comida_rapida'] ?? ''));
        update_post_meta($post_id, 'fecha_pedido', sanitize_text_field($_POST['fecha_pedido'] ?? ''));
               
        // Cuerpo del mensaje con formato HTML y estilos
        $message = "<html><body>";
        $message .= "<style>";
        $message .= "body { font-family: system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Ubuntu, \"Helvetica Neue\", sans-serif; background-color: #3f2560; margin: 0; padding: 0 24px; }";
        $message .= ".email-container { max-width: 550px; margin: 0 auto; padding: 20px; border-radius: 10px; color: #3F2460; background-color: #e9e6f1; }";
        $message .= ".logo-container { text-align: center; padding-top: 60px; margin-bottom: 30px; }";
        $message .= ".logo { width: 230px; height: 140px; object-fit: contain;}";
        $message .= "h3 { color: #3f2560; text-align: center; margin-top: 20px; }";
        $message .= "table { margin-top: 60px; border-collapse: collapse; width: 100%; }";
        $message .= "table td { padding: 8px; }";
        $message .= "table td:first-child { font-weight: bold; }";
        $message .= ".btn { background-color: #3f2560; color: #e9e6f1;padding: 12px 24px;text-decoration: none;text-transform: uppercase;font-weight: bold;border-radius: 6px;margin: 30px auto 15px;display: inline-block;}";
        $message .= "p.signature { margin-bottom: 0px; text-align: center; margin-top: 20px; border-top: 1px solid #3f2560; padding-top: 20px; }";
        $message .= "</style>";
        $message .= "<div class='logo-container'><a href='$siteURL' target='_blank'><img class='logo' src='$logo_url' alt='Logo'></a></div>";
        $message .= "<div class='email-container'>";
        $message .= "<h3>Detalles del pedido:</h3>";
        $message .= "<table>";
        $message .= "<tr><td>Nombre completo:</td><td>$post_title</td></tr>";
        $message .= "<tr><td>Cód. Doc. Identidad:</td><td>" . sanitize_text_field($_POST['documento']) . "</td></tr>";
        $message .= "<tr><td></td></tr>";
        $message .= "<tr style='border-bottom: 1px dashed #3f2560;'><td></td></tr>";
        $message .= "<tr><td></td></tr>";
        $message .= "<tr><td>Menú seleccionado:</td><td><strong>" . sanitize_text_field($_POST['menu']) . "</strong></td></tr>";
        if ($menu === 'Menú del día') {
            $message .= "<tr><td></td><td>" . sanitize_text_field(ucfirst(strtolower($_POST['sopa_o_crema'] ?? ''))) . "</td></tr>";
            $message .= "<tr><td></td><td>" . sanitize_text_field(ucfirst(strtolower($_POST['arroz'] ?? ''))) . "</td></tr>";
            $message .= "<tr><td></td><td>" . sanitize_text_field(ucfirst(strtolower($_POST['proteinas'] ?? ''))) . "</td></tr>";
            $message .= "<tr><td></td><td>" . sanitize_text_field(ucfirst(strtolower($_POST['farinaceo'] ?? ''))) . "</td></tr>";
            $message .= "<tr><td></td><td>" . sanitize_text_field(ucfirst(strtolower($_POST['principio_grano'] ?? ''))) . "</td></tr>";
            $message .= "<tr><td></td><td>" . sanitize_text_field(ucfirst(strtolower($_POST['principio_verdura'] ?? ''))) . "</td></tr>";
            $message .= "<tr><td></td><td>" . sanitize_text_field(ucfirst(strtolower($_POST['ensalada'] ?? ''))) . "</td></tr>";
            $message .= "<tr><td></td><td>" . sanitize_text_field(ucfirst(strtolower($_POST['postre'] ?? ''))) . "</td></tr>";
            $message .= "<tr><td></td><td>" . sanitize_text_field(ucfirst(strtolower($_POST['bebida'] ?? ''))) . "</td></tr>";
        } 
        if($menu === 'Menú alternativo'){
            $message .= "<tr><td></td><td>" . sanitize_text_field(ucfirst(strtolower($_POST['comida_rapida'] ?? ''))) . "</td></tr>"; 
        }
        $message .= "</table>";
        $message .= "<p style='text-align: center;'><a href='$pedidoURL' target='_blank' class='btn'>Gestionar pedido</a></p>";
        $message .= "<p class='signature'>Este es un mensaje automático, por favor no responder.</p>";
        $message .= "</div>";
        $message .= "</body></html>";
        
        // Configurar las cabeceras para el correo HTML
        $headers = array('Content-Type: text/html; charset=UTF-8');
        
        // Enviar el correo electrónico
        $email_address = get_field('email', 'option');
        wp_mail($email_address, 'Nuevo pedido (' . $menu . ')', $message, $headers);

        wp_redirect(home_url('/confirmacion/'));

        exit();
    }
}

add_action('template_redirect', 'custom_post_form_submission');