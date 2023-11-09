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


// Ultimate Member - User Meta Shortcode
function um_user_shortcode( $atts ) {

    if( ! class_exists( "UM" ) ) return;

	$atts = extract( shortcode_atts( array(
		'user_id' => um_profile_id(),
		'meta_key' => '',
	), $atts ) );
	
	if ( empty( $meta_key ) ) return;
	
	if( empty( $user_id ) ) $user_id = um_profile_id(); 
    
    $meta_value = get_user_meta( $user_id, $meta_key, true );
    if( is_serialized( $meta_value ) ){
       $meta_value = unserialize( $meta_value );
    } 
    if( is_array( $meta_value ) ){
         $meta_value = implode(",",$meta_value );
    }  
    return apply_filters("um_user_shortcode_filter__{$meta_key}", $meta_value );
 
}
add_shortcode( 'um_user', 'um_user_shortcode' );

add_filter('wp_nav_menu_items', 'do_shortcode');


// generate post name del menu
function auto_generate_post_title_from_acf($data, $postarr) {
    // Comprueba si estás editando un nuevo post o actualizando uno existente.
    if ($postarr['post_status'] == 'auto-draft' || isset($postarr['acf'])) {
        // Obtiene el valor del campo personalizado ACF 'fecha' para el nuevo título.
        $fecha = get_field('fecha', $postarr['ID']);

        // Si se encontró un valor en el campo 'fecha', lo convierte al formato deseado en español.
        if (!empty($fecha)) {
            // Configura la localización en español
            setlocale(LC_TIME, 'es_ES.UTF-8');
            
            // Formatea la fecha con el nombre del mes en español
            $fecha_formateada = strftime('%A, %e de %B del %Y', strtotime($fecha));
            
            $data['post_title'] = $fecha_formateada;
        }
    }
    return $data;
}

add_filter('wp_insert_post_data', 'auto_generate_post_title_from_acf', 10, 2);


/* Add fields to account page */
function showUMExtraFields() {
    $id = um_user('ID');
    $output = '';
    $names = array('phone_number', 'documento_identidad');

    $fields = array(); 
    foreach( $names as $name )
        $fields[ $name ] = UM()->builtin()->get_specific_field( $name );
    $fields = apply_filters('um_account_secure_fields', $fields, $id);
    foreach( $fields as $key => $data )
        $output .= UM()->fields()->edit_field( $key, $data );
  echo $output;
}
add_action('um_after_account_general', 'showUMExtraFields', 100);



function getUMFormData(){
    $id = um_user('ID');
    $names = array('phone_number', 'documento_identidad');

    foreach( $names as $name )
        update_user_meta( $id, $name, $_POST[$name] );
}
add_action('um_account_pre_update_profile', 'getUMFormData', 100);