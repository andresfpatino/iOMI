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
    </div>
</div>

<?php
get_footer();