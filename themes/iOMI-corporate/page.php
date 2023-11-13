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
		$sites = get_sites();
		
		$active_sites_found = false; // Variable para rastrear si se encontraron sitios activos
		
		if ($sites) {
			echo '<div class="sites-grid">';
			foreach ($sites as $site) {
				$site_id = $site->blog_id;

				// Obtener el estado del sitio (archivado o borrado)
				$site_status = get_blog_status($site_id, 'archived');
				if (!$site_status) {
					$site_status = get_blog_status($site_id, 'deleted');
				}

				// Si el sitio está archivado o borrado, omitirlo
				if ($site_status) {
					continue;
				}

				if ($current_site_id == $site_id) {
					continue;
				}

				// Si llegamos aquí, encontramos al menos un sitio activo
				$active_sites_found = true;

				switch_to_blog($site_id);				
				$site_details = get_blog_details($site_id);
				$site_name = $site_details->blogname;
				$site_logo = get_field('logo', 'option');				
				restore_current_blog(); 

				if (!empty($site_logo)) {
					echo '<div class="site"><a href="' . $site_details->siteurl . '" target="_blank"><img src="' . $site_logo['url'] . '" alt="' . $site_name . '">' . $site_name . '</a></div>';
				} else {
					echo '<div class="site"><a href="' . $site_details->siteurl . '" target="_blank">' . $site_name . '</a></div>';
				}
			}
			echo '</div>';
		}

		// Mostrar el mensaje solo si no se encontraron sitios activos
		if (!$active_sites_found) {
			echo '<p style="color: #C74A4A;font-weight: 700;margin: 0;">Disculpa, no hay sitios disponibles a mostrar.</p>';
		}
		
		endwhile; ?>
    </div>
</div>

<?php
get_footer();