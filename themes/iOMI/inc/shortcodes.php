<?php 

function mostrar_fecha_actual() {
    setlocale(LC_TIME, 'es_ES.UTF-8');
    $fecha_actual = strftime('%A, %e de %B');
    return ucfirst($fecha_actual);
}
add_shortcode('fecha_actual', 'mostrar_fecha_actual');