<?php 

function mostrar_fecha_actual($atts) {
    $defaults = array(
        'hora' => 'false', // Valor por defecto: no mostrar la hora
    );
    $atts = shortcode_atts($defaults, $atts);

    $fecha_actual = date_i18n('l, j \d\e F', current_time('timestamp'));
    $output = '<div class="fecha-hora-actual">';
    $output .= '<p class="fecha">' . ucfirst($fecha_actual) . '</p>';

    if ($atts['hora'] === 'true') {
        $output .= '<p id="hora-actual" class="hora"></p>';
    }

    $output .= '</div>';
    return $output;
}
add_shortcode('fecha_actual', 'mostrar_fecha_actual');