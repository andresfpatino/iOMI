<?php

/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package themeiOMI
 */
?>
<!doctype html>

<html <?php language_attributes(); ?>>

<head>

    <?php get_template_part('inc/functions/datalayer', 'info'); ?>

    <!--/Google Tag Manager-->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="icon" href="<?php the_field('favicon', 'option'); ?>">

    <meta name="msapplication-TileColor" content="#3F2460">
    <meta name="theme-color" content="#3F2460">

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site">

        <!-- Header -->
        <header class="site-header">
            <div class="container">               
                <div class="sitelogo"> <?php
                    $GETlogo = get_field('logo', 'option');    ?>
                    <a href="<?php echo esc_url(get_bloginfo('url')); ?>">
                        <?php if ($GETlogo) {
                            iOMI_get_Image($GETlogo);
                        } else {
                            echo "<h3 class='mb-0'>" . get_bloginfo('name') . "</h3>";
                        } ?>
                    </a>
                </div>
            </div>
        </header>
        
        <!-- Content Page -->
        <div id="content" class="site-content">