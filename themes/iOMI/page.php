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

acf_form_head();
get_header(); ?>

<div class="py-8 content__page">
    <div class="container mx-auto">
        <div class="flex flex-wrap px-4">
            <div class="w-full"> <?php 
            
                while (have_posts()) : the_post();

                   the_content();


                endwhile; ?>






            </div>
        </div>
    </div>
</div>
<?php
get_footer();
