<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themeiOMI
 */

get_header(); ?>

<div class="index__container">
    <div class="container"> 
        <?php
        while (have_posts()) :
             the_post();
        endwhile;
        ?>
    </div>
</div>

<?php
get_footer();