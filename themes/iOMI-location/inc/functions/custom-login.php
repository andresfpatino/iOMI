<?php 

function custom_login() {
    $logo = get_field('logo', 'option');
    $logo_url = $logo['url'];

    echo '<style>';   
        echo 'body.login { background-color: #3f2560; }';
        echo '.login h1 a { background-image: url("' . esc_url($logo_url) . '") !important; width: 220px !important; height: 100px !important; background-size: contain !important; }';
        echo '.login #backtoblog a, .login #nav a, .language-switcher label .dashicons { display: block; text-align:center; color: #fff !important; }';
        echo '.login form { border-radius: 10px; }';
        echo '#wp-submit { transition: background-color 0.5s ease-in-out; background-color: #3f2560; text-transform: uppercase; font-weight: bold;border: none;border-radius: 5px;padding: 6px 24px;float: none;width: 100%;margin-top: 24px; }';
        echo '#wp-submit:hover {background-color: #673f9b;}';
        echo '.language-switcher {display: none;}';
     echo '</style>';
}

add_action('login_enqueue_scripts', 'custom_login');


function custom_login_logo_url($url) {
    return get_site_url();
}
add_filter('login_headerurl', 'custom_login_logo_url');