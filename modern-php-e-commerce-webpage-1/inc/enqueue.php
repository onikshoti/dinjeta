<?php
function modern_php_ecommerce_enqueue_scripts() {
    // Enqueue styles
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('editor-style', get_template_directory_uri() . '/assets/css/editor-style.css');

    // Enqueue scripts
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'modern_php_ecommerce_enqueue_scripts');
?>