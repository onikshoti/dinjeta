<?php 


get_header() ?>

<main id="main" class="site-main" role="main">
    <section class="search-intro">
        <h2> 
            <?php _e("search posts",'your-textdomain');?>
        </h2>
        <p> <?php _e('use the form below to search posts','your-textdomain');?> 
    </p>
    </section>


    <?php get_search_form(); ?>
</main>
    
<?php get_footer(); ?>