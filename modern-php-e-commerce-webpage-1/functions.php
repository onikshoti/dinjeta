<?php
// functions.php

// Theme setup function
function modern_php_ecommerce_setup() {
    // Add support for post thumbnails
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'modern-php-e-commerce-webpage'),
        'footer' => __('Footer Menu', 'modern-php-e-commerce-webpage'),
    ));
}
add_action('after_setup_theme', 'modern_php_ecommerce_setup');

// Enqueue styles and scripts
function modern_php_ecommerce_enqueue_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('main-style', get_stylesheet_uri());

    // Enqueue additional styles and scripts as needed
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'modern_php_ecommerce_enqueue_scripts');
?>