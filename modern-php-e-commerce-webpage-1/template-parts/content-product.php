<?php
/**
 * Template part for displaying individual products in the e-commerce section.
 *
 * @package Modern_PHP_E_Commerce_Webpage
 */

?>

<div class="product">
    <h2 class="product-title"><?php the_title(); ?></h2>
    <div class="product-image">
        <?php if ( has_post_thumbnail() ) {
            the_post_thumbnail('medium');
        } ?>
    </div>
    <div class="product-price">
        <?php echo get_post_meta(get_the_ID(), '_price', true); ?>
    </div>
    <div class="product-description">
        <?php the_excerpt(); ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="button">View Product</a>
</div>