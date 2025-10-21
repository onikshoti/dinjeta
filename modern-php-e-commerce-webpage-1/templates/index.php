<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php get_header(); ?>

    <main id="main" class="site-main">
        <h1>Welcome to Our E-Commerce Store</h1>
        <p>Explore our range of products and enjoy a seamless shopping experience.</p>
        <!-- Add your main content here -->
    </main>

    <?php get_footer(); ?>