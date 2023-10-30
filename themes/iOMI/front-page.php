<?php
/**
 * The template for displaying all pages
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package themeiOMI
 */

get_header();

setlocale(LC_TIME, 'es_ES.UTF-8');
$currentDate = date("Y-m-d");
$date = date("Y-m-d", strtotime($currentDate));
$fecha_seleccionada = isset($_GET['fecha_seleccionada']) ? sanitize_text_field($_GET['fecha_seleccionada']) : '';
$formulario_enviado = isset($_GET['fecha_seleccionada']) && empty($_GET['fecha_seleccionada']);
$dia_seleccionado = strftime("%A, %e de %B", strtotime($fecha_seleccionada)); ?>

<div class="content__page">
    <div class="content__page-wrap"> <?php 
    
        while (have_posts()) : the_post();
                the_content();
        endwhile;  ?>

        <!-- Formulario para seleccionar la fecha -->
        <form method="GET" class="search" action="<?= esc_url(home_url('/')); ?>">
            <input type="date" name="fecha_seleccionada" class="fecha_seleccionada" id="fecha_seleccionada" value="<?= $fecha_seleccionada; ?>">
            <input type="submit" value="Buscar">
        </form> <?php

        if ($formulario_enviado) {
            echo "<p class='error-message'>" . esc_html__('Por favor selecciona una fecha.', 'iOMI') . "</p>";
        } elseif (!empty($fecha_seleccionada)) {
            $args = array(
                'post_type' => 'menu',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'fecha',
                        'value' => $fecha_seleccionada,
                        'compare' => '=',
                        'type' => 'DATE',
                    ),
                ),
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    get_template_part('template-parts/form', 'content', array('fecha_seleccionada' => $fecha_seleccionada));
                endwhile;
                wp_reset_postdata();
            else :                
                echo "<p class='error-message'>" . sprintf(__('No hay menús disponibles para el día %s.', 'iOMI'), $dia_seleccionado) . "</p>";
            endif;
        }  ?>
    </div>
</div>

<?php
get_footer();