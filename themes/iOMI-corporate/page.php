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
			
            if ($sites) {
				echo '<div class="sites-grid">';
					foreach ($sites as $site) {
						$site_id = $site->blog_id;
					
						if ($current_site_id == $site_id) {
							continue;
						}
					
						switch_to_blog($site_id);				
							$site_details = get_blog_details($site_id);
							$site_name = $site_details->blogname;
							$site_logo = get_field('logo', 'option');				
						restore_current_blog(); 
				
						if (!empty($site_logo)) {
							echo '<div class="site"><a href="' . $site_details->siteurl . '"><img src="' . $site_logo['url'] . '" alt="' . $site_name . '">' . $site_name . '</a></div>';
						} else {
							echo '<div class="site"><a href="' . $site_details->siteurl . '">' . $site_name . '</a></div>';
						}
					}
				echo '</div>';
            } else {
              echo 'No hay sitios secundarios disponibles.';
            }
			
        endwhile; ?>
    </div>
</div>

<?php
get_footer();