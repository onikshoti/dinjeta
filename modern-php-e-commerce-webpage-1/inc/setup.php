<?php
// Setup theme features and functionalities

function modern_php_ecommerce_setup() {
    // Add support for post thumbnails
    add_theme_support('post-thumbnails');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'modern-php-e-commerce-webpage'),
        'footer' => __('Footer Menu', 'modern-php-e-commerce-webpage'),
    ));
}

// Hook the setup function to the after_setup_theme action
add_action('after_setup_theme', 'modern_php_ecommerce_setup');
?>