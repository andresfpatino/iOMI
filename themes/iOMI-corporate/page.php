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
            

            $current_site_id = get_current_blog_id();

            // Obtiene la lista de sitios secundarios
            $sites = get_sites();
            
            if ($sites) {
              echo '<ul>';
              foreach ($sites as $site) {
                $site_id = $site->blog_id;
            
                // Omitir el sitio actual
                if ($current_site_id == $site_id) {
                  continue;
                }
            
                // Cambia al contexto del sitio secundario
                switch_to_blog($site_id);
            
                $site_details = get_blog_details($site_id);
                $site_name = $site_details->blogname;
                $site_logo = get_field('logo', 'option'); // Reemplaza 'logo' con el nombre correcto del campo ACF
            
                restore_current_blog(); // Vuelve al contexto del sitio principal
            
                if (!empty($site_logo)) {
                  echo '<li><a href="' . $site_details->siteurl . '"><img src="' . $site_logo['url'] . '" alt="' . $site_name . '">' . $site_name . '</a></li>';
                } else {
                  echo '<li><a href="' . $site_details->siteurl . '">' . $site_name . '</a></li>';
                }
              }
              echo '</ul>';
            } else {
              echo 'No hay sitios secundarios disponibles.';
            }


        endwhile; ?>
    </div>
</div>

<?php
get_footer();