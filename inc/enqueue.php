<?php
// Kadence charge déjà ses propres styles : le style.css parent n'est plus nécessaire.
add_action('wp_enqueue_scripts', function () {
    $dir  = get_stylesheet_directory();
    $uri  = get_stylesheet_directory_uri();
    $path = $dir . '/assets/css/main.css';

    if (file_exists($path)) {
        wp_enqueue_style('kadence-child-main', $uri . '/assets/css/main.css', [], filemtime($path));
    }
});
