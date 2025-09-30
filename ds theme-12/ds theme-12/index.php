<?php get_header(); ?>


<!-- Movie Search Form -->
<form method="get" class="mb-4" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="input-group">
    <input type="text" class="form-control" name="movie_search" placeholder="Search movies by name..." value="<?php echo isset($_GET['movie_search']) ? esc_attr($_GET['movie_search']) : ''; ?>">
    <button class="btn btn-primary" type="submit">Search</button>
  </div>
</form>

<!-- Movies by Picture -->
<?php
$search_term = isset($_GET['movie_search']) ? sanitize_text_field($_GET['movie_search']) : '';
$movies_query_args = [
  'post_type' => 'movies',
  'posts_per_page' => -1,
];
if ($search_term) {
  $movies_query_args['s'] = $search_term;
}
$movies_query = new WP_Query($movies_query_args);
if ($movies_query->have_posts()) : ?>
  <h2 class="mb-4">Movies</h2>
  <div class="row g-4 mb-5">
    <?php while ($movies_query->have_posts()) : $movies_query->the_post(); ?>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="card h-100">
          <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium_large', ['class' => 'card-img-top']); ?>
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
  <?php wp_reset_postdata(); ?>
<?php elseif ($search_term): ?>
  <p>No movies found for "<?php echo esc_html($search_term); ?>".</p>
<?php endif; ?>


<?php if ( have_posts() ) : ?>
  <div class="row">
    <div class="col-md-8">
      <div class="row g-4">
      <?php while ( have_posts() ) : the_post(); ?>
        <article <?php post_class('col-12'); ?> id="post-<?php the_ID(); ?>">
          <div class="card h-100">
            <?php if ( has_post_thumbnail() ) : ?>
              <div class="thumbnail-img"><?php the_post_thumbnail('medium_large', array('class'=>'card-img-top')); ?></div>
            <?php endif; ?>
            <div class="card-body">
              <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <small class="text-muted d-block mb-2">
                Posted on: <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?>, in <?php the_category(', '); ?>
              </small>
              <div class="card-text"><?php the_excerpt(); ?></div>
            </div>
          </div>
        </article>
      <?php endwhile; ?>
      </div>
      <div class="my-4"><?php mytheme_pagination(); ?></div>
    </div>
    <aside class="col-md-4">
      <?php get_sidebar( 'primary' ); ?>
    </aside>
  </div>
<?php else : ?>
  <p><?php _e('No posts found.', 'your-textdomain'); ?></p>
<?php endif; ?>

<!-- Demo boxes, outside the loop and after main content -->
<div class="box-rounded">This box has rounded corners.</div>
<div class="box-ellipse">Elliptical border radius.</div>
<div class="box-border-image">This box uses a border image.</div>
<div class="bg-example">Background with image + gradient overlay.</div>
<div class="shadow-box">Box with shadow.</div>
<div class="inner-shadow">Box with inner shadow.</div>

<?php get_footer(); ?>
