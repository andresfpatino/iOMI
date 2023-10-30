<?php $fecha_seleccionada = $args['fecha_seleccionada'];  ?>

<div class="fecha"><?= date_i18n('l, j \d\e F', $fecha_seleccionada); ?></div> 

<form class="form" method="POST">

    <div class="menu">
        <div class="menu-card">
            <h3><?php _e('Menu del día ', 'iOMI'); ?></h3>
            <ul> <?php                            
                menu_item('sopa_o_crema');
                menu_item('arroz');
                menu_item('proteinas');
                menu_item('farinaceo');
                menu_item('principio_grano');
                menu_item('principio_verdura');
                menu_item('ensalada');
                menu_item('postre');
                menu_item('bebida'); ?>
            </ul>
        </div>
        <div class="menu-card">
            <h3><?php _e('Menu alternativo', 'iOMI'); ?></h3>
            <ul>
                <?php menu_item('comida_rapida', false); ?>
            </ul>
        </div>
    </div> 

    <?php wp_nonce_field('pedido_form_nonce', 'pedido_form_nonce'); ?>

    <fieldset class="form-group">
        <legend><?php _e('Datos personales', 'iOMI'); ?></legend>
        <span class="form-field">
            <label for="nombre"> <?php _e('Nombre:', 'iOMI'); ?> </label>
            <input type="text" name="nombre" value="<?php echo do_shortcode('[um_user meta_key="first_name" ]'); ?>" required>
        </span>
        <span class="form-field">
            <label for="apellido"><?php _e('Apellido:', 'iOMI'); ?> </label>
            <input type="text" name="apellido" value="<?php echo do_shortcode('[um_user meta_key="last_name" ]'); ?>" required>
        </span>
        <span class="form-field">
            <label for="documento"><?php _e('Cód. Doc. Identidad:', 'iOMI'); ?> </label>
            <input type="text" name="documento" value="<?php echo do_shortcode('[um_user meta_key="documento_identidad" ]'); ?>" required>
        </span>
    </fieldset>

    <fieldset class="form-group data">
        <legend> <?php _e('¿Qué deseas comer hoy?', 'iOMI'); ?>   </legend>  
        <span class="form-field">          
            <label>
                <input type="radio" name="menu" required value="Menú del día"> <?php _e('Menú del día', 'iOMI'); ?> 
            </label>
        </span>
        <span class="form-field">
            <label>
                <input type="radio" name="menu" required value="Menú alternativo"><?php _e('Menú alternativo', 'iOMI'); ?>  
            </label>
        </span>
    </fieldset>

    <fieldset class="form-group" id="opciones-menu-dia"> <?php
        mostrar_campos_acf('sopa_o_crema', '¿Qué sopa quieres?');
        mostrar_campos_acf('proteinas', '¿Qué proteína quieres?'); ?>
    </fieldset>

    <button type="submit"><?php _e('Solicitar pedido', 'iOMI'); ?>   </button>
</form>