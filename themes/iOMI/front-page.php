<?php

/**
 * The template for displaying all pages
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package themeiOMI
 */

get_header(); ?>

<div class="content__page">
    <div class="content__page-wrap"> <?php 
        
        while (have_posts()) : the_post();
            the_content();
        endwhile; ?>

        <div class="menu">
            <div class="menu-card">
                <h3>Menu del día</h3>
                <ul> <?php
                    $menu_components = [
                        'sopa_o_crema',
                        'arroz',
                        'proteinas',
                        'farinaceo',
                        'principio_grano',
                        'principio_verdura',
                        'ensalada',
                        'postre',
                        'bebida',
                    ];

                   foreach ($menu_components as $component) {
                        $items = get_field($component, 'option');
                        
                        if ($items): ?>
                            <li>
                                <strong><?php echo ucwords(str_replace('_', ' ', $component)); ?>:</strong> <?php 
                                foreach ($items as $post) {
                                    setup_postdata($post);
                                    $title = ucfirst(strtolower(get_the_title()));
                                    $excerpt = get_the_excerpt();
                                    
                                    if (!empty($title) || !empty($excerpt)) {                                       
                                        if (!empty($title)) {
                                            echo '<p>' . $title . '</p>';
                                        }
                                        if (!empty($excerpt)) {
                                            echo '<p><i>' . $excerpt . '</i></p>';
                                        }
                                    }
                                }
                                wp_reset_postdata(); ?>
                            </li> <?php 
                        endif;
                    } ?>
                </ul>
            </div>
            <div class="menu-card">
                <h3>Comida rápida del día</h3>                        
                <ul> <?php
                    $comida_rapida = get_field('comida_rapida', 'option');
                    if( $comida_rapida ): ?>
                        <li>
                            <p><?php echo esc_html( $comida_rapida->post_title ); ?></p>
                            <i> <?php echo esc_html( $comida_rapida->post_excerpt ); ?> </i>
                        </li>
                    <?php endif; ?>             
                </ul>
            </div>
        </div>

        <form class="form" method="post">

            <?php wp_nonce_field('pedido_form_nonce', 'pedido_form_nonce'); ?>

            <fieldset class="form-group">
                <legend>Datos personales</legend>
                <span class="form-field">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" required>
                </span>
                <span class="form-field">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" required>
                </span>
                <span class="form-field">
                    <label for="documento">Cód. Doc. Identidad:</label>
                    <input type="text" name="documento" pattern="[0-9]+" required>
                </span>
            </fieldset>

            <fieldset class="form-group data">
                <legend>¿Qué deseas comer hoy?</legend>  
                <span class="form-field">          
                    <label>
                        <input type="radio" name="menu" required value="Menú del día"> Menú del día
                    </label>
                </span>
                <span class="form-field">
                    <label>
                        <input type="radio" name="menu" required value="Comida rápida"> Comida rápida
                    </label>
                </span>
            </fieldset>

            <fieldset class="form-group" id="opciones-menu-dia"> <?php

                $sopas = get_field('sopa_o_crema', 'option');
                if( $sopas ): ?>
                    <fieldset class="form-group data">
                        <legend>¿Qué sopa quieres?</legend> 
                        <?php foreach( $sopas as $sopa ): 
                            $title = get_the_title( $sopa->ID ); ?>
                            <span class="form-field">          
                                <label>
                                    <input type="radio" name="sopa" value="<?php echo ucfirst(strtolower($title)); ?>"> <?php echo ucfirst(strtolower($title)); ?>
                                </label>
                            </span>
                        <?php endforeach; ?>
                    </fieldset> <?php
                endif; 

                $proteinas = get_field('proteinas', 'option');
                if( $proteinas ): ?>
                    <fieldset class="form-group data">
                        <legend>¿Qué proteína quieres?</legend> 
                        <?php foreach( $proteinas as $proteina ): 
                            $title = get_the_title( $proteina->ID ); ?>
                            <span class="form-field">          
                                <label>
                                    <input type="radio" name="proteina" value="<?php echo ucfirst(strtolower($title)); ?>"> <?php echo ucfirst(strtolower($title)); ?>
                                </label>
                            </span>
                        <?php endforeach; ?>
                    </fieldset> <?php 
                endif; ?>
            
            </fieldset>
            
            <button type="submit">Solicitar pedido</button>
        </form>
    </div>
</div>
<?php
get_footer();
