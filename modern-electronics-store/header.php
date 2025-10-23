<?php
function mes_enqueue_styles() {
    wp_enqueue_style( 'mes-style', get_stylesheet_directory_uri() . '/public/css/style.css', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'mes_enqueue_styles' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header container">
  <div class="site-brand">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
  </div>
</header>
<footer class="site-footer container">
  <p class="muted">&copy; <?php echo date_i18n( 'Y' ); ?> <?php bloginfo( 'name' ); ?></p>
</footer>
<?php wp_footer(); ?>
</body>
</html>