<?php
// This is the main template file for the theme.

// Load the header
get_header(); ?>

<main id="main" class="site-main">
    <?php
    // Start the loop
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            // Include the content template for the current post
            get_template_part( 'template-parts/content', get_post_type() );
        endwhile;

        // Pagination
        the_posts_navigation();
    else :
        // If no content, include the "No posts found" template
        get_template_part( 'template-parts/content', 'none' );
    endif;
    ?>
</main>

<?php
// Load the footer
get_footer();
?>