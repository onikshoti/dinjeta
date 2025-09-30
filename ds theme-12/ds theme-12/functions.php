<?php
/**
 * DS Theme complete with Bootstrap via CDN
 */

// Enqueue styles & scripts (Bootstrap 5 CDN + theme CSS)
function ds_enqueue_assets() {
  // Bootstrap CSS
  wp_enqueue_style( 'bootstrap-cdn', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' );

  // Main stylesheet
  wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.2', 'all' );

  // Bootstrap JS (bundle includes Popper) in footer
  wp_enqueue_script( 'bootstrap-cdn', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), null, true );


  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'ds_enqueue_assets' );

function ds_setup() {
  add_theme_support( 'menus' );
  register_nav_menu( 'primary', 'Primary Navigation' );
  register_nav_menu( 'footer', 'Footer Navigation' );

  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'post-formats', array( 'aside', 'image', 'video' ) );
}
add_action( 'init', 'ds_setup' );

function ds_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Primary Sidebar', 'dstheme' ),
    'id'            => 'primary',
    'description'   => __( 'Main sidebar that appears on the right.', 'dstheme' ),
    'class'         => 'sidebar-primary',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Secondary Sidebar', 'dstheme' ),
    'id'            => 'secondary',
    'description'   => __( 'Optional secondary sidebar (e.g., footer or left side).', 'dstheme' ),
    'class'         => 'sidebar-secondary',
    'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
    'after_widget'  => '</li></ul>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
}
add_action( 'widgets_init', 'ds_widgets_init' );


class DS_Simple_Text_Widget extends WP_Widget {

  public function __construct() {
    parent::__construct(
      'ds_simple_text', // Base ID
      __( 'DS Simple Text', 'dstheme' ), // Name
      array( 'description' => __( 'A simple text widget for DS Theme.', 'dstheme' ) )
    );
  }

  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $text  = ! empty( $instance['text'] ) ? $instance['text'] : '';
    if ( ! empty( $title ) ) {
      $title = apply_filters( 'widget_title', $title );
      echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
    }
    if ( ! empty( $text ) ) {
      echo '<div class="textwidget">' . wp_kses_post( $text ) . '</div>';
    }
    echo $args['after_widget'];
  }

  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $text  = ! empty( $instance['text'] ) ? $instance['text'] : '';
    ?>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'dstheme' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
             name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
             value="<?php echo esc_attr( $title ); ?>">
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text:', 'dstheme' ); ?></label>
      <textarea class="widefat" rows="5" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"
                name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_textarea( $text ); ?></textarea>
    </p>
    <?php
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = (! empty( $new_instance['title'] )) ? sanitize_text_field( $new_instance['title'] ) : '';
    $instance['text']  = (! empty( $new_instance['text'] )) ? wp_kses_post( $new_instance['text'] ) : '';
    return $instance;
  }
}

add_action( 'widgets_init', function() {
  register_widget( 'DS_Simple_Text_Widget' );
} );

function mytheme_pagination( $query = null, $args = array() ) {

    if ( $query instanceof WP_Query ) {
        $q = $query;
    } else {
        global $wp_query;
        $q = $wp_query;
    }

    if ( empty( $q->max_num_pages ) || $q->max_num_pages < 2 ) {
        return;
    }

    $big     = 999999999;
    $current = max( 1, get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' ) );

    $defaults = array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => $current,
        'total'     => (int) $q->max_num_pages,
        'mid_size'  => 2,
        'end_size'  => 1,
        'prev_text' => __('« Previous', 'yourtheme'),
        'next_text' => __('Next »', 'yourtheme'),
        'type'      => 'array', 
    );

    $settings = wp_parse_args( $args, $defaults );
    $links    = paginate_links( $settings );

    if ( empty( $links ) ) {
        return;
    }

    echo '<nav class="pagination" role="navigation" aria-label="' . esc_attr__( 'Posts Pagination', 'yourtheme' ) . '">';
    echo '<span class="screen-reader-text">' . esc_html__( 'Navigimi i faqeve', 'yourtheme' ) . '</span>';
    echo '<ul class="pagination__list">';

    foreach ( $links as $link ) {
        $active = strpos( $link, 'current' ) !== false ? ' is-active' : '';
        echo '<li class="pagination__item' . $active . '">' . $link . '</li>';
    }

    echo '</ul>';
    echo '</nav>';
}


function create_post_type(){
    register_post_type('movies',
    array(
        'labels' => array(
            'name' => __('movies'),
            'singular_name' => __('movies')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'movie'),
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail')
    )
    );
}

function register_texonomy_movie_genres() {
    $labels = array(
        'name'              => _x( 'Movie Genres', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Movie Genre', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Movie Genres', 'textdomain' ),
        'all_items'         => __( 'All Movie Genres', 'textdomain' ),
        'parent_item'       => __( 'Parent Movie Genre', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Movie Genre:', 'textdomain' ),
        'edit_item'         => __( 'Edit Movie Genre', 'textdomain' ),
        'update_item'       => __( 'Update Movie Genre', 'textdomain' ),
        'add_new_item'      => __( 'Add New Movie Genre', 'textdomain' ),
        'new_item_name'     => __( 'New Movie Genre Name', 'textdomain' ),
        'menu_name'         => __( 'Movie Genres', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'movie-genre' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'movie_genre', array( 'movies' ), $args );
}

// Front-end Add Movie Tab (for logged-in users)
function ds_add_movie_tab() {
  if (!is_user_logged_in()) return;
  // Get genres for dropdown
  $genres = get_terms(['taxonomy' => 'movie_genre', 'hide_empty' => false]);
?>
  <div class="mb-4">
    <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#addMovieForm" aria-expanded="false" aria-controls="addMovieForm">
      Add Movie
    </button>
    <div class="collapse mt-3" id="addMovieForm">
      <form method="post" enctype="multipart/form-data">
        <div class="mb-2">
          <input type="text" name="ds_movie_title" class="form-control" placeholder="Movie Title" required>
        </div>
        <div class="mb-2">
          <textarea name="ds_movie_desc" class="form-control" placeholder="Description" required></textarea>
        </div>
        <div class="mb-2">
          <input type="number" name="ds_movie_year" class="form-control" placeholder="Year" min="1900" max="<?php echo date('Y'); ?>" required>
        </div>
        <div class="mb-2">
          <select name="ds_movie_genre" class="form-select" required>
            <option value="">Select Genre</option>
            <?php foreach ($genres as $genre): ?>
              <option value="<?php echo esc_attr($genre->term_id); ?>"><?php echo esc_html($genre->name); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-2">
          <input type="number" name="ds_movie_price" class="form-control" placeholder="Price" step="0.01" min="0" required>
        </div>
        <div class="mb-2">
          <select name="ds_movie_currency" class="form-select" required>
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="GBP">GBP</option>
          </select>
        </div>
        <div class="mb-2">
          <input type="file" name="ds_movie_image" class="form-control" accept="image/*">
        </div>
        <button type="submit" name="ds_add_movie" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  <?php
  // Handle form submission
  if (isset($_POST['ds_add_movie'])) {
    $title = sanitize_text_field($_POST['ds_movie_title']);
    $desc = sanitize_textarea_field($_POST['ds_movie_desc']);
    $year = intval($_POST['ds_movie_year']);
    $genre_id = intval($_POST['ds_movie_genre']);
    $price = floatval($_POST['ds_movie_price']);
    $currency = sanitize_text_field($_POST['ds_movie_currency']);
    $errors = [];
    if (!$title) $errors[] = 'Title is required.';
    if (!$desc) $errors[] = 'Description is required.';
    if ($year < 1900 || $year > intval(date('Y'))) $errors[] = 'Year is invalid.';
    if (!$genre_id) $errors[] = 'Genre is required.';
    if ($price < 0) $errors[] = 'Price must be positive.';
    if (!$currency) $errors[] = 'Currency is required.';
    if ($errors) {
      echo '<div class="alert alert-danger mt-2">' . implode('<br>', $errors) . '</div>';
    } else {
      $new_movie = [
        'post_title'   => $title,
        'post_content' => $desc,
        'post_type'    => 'movies',
        'post_status'  => 'publish',
      ];
      $movie_id = wp_insert_post($new_movie);
      if ($movie_id) {
        // Save meta
        update_post_meta($movie_id, 'ds_movie_price', $price);
        update_post_meta($movie_id, 'ds_movie_currency', $currency);
        update_post_meta($movie_id, 'ds_movie_year', $year);
        // Assign genre
        wp_set_object_terms($movie_id, [$genre_id], 'movie_genre');
        // Handle image upload
        if (!empty($_FILES['ds_movie_image']['name'])) {
          require_once(ABSPATH . 'wp-admin/includes/image.php');
          require_once(ABSPATH . 'wp-admin/includes/file.php');
          require_once(ABSPATH . 'wp-admin/includes/media.php');
          $attachment_id = media_handle_upload('ds_movie_image', $movie_id);
          if (is_numeric($attachment_id)) {
            set_post_thumbnail($movie_id, $attachment_id);
          }
        }
        $genre_obj = get_term($genre_id);
        echo '<div class="alert alert-success mt-2">Movie added!<br>';
        echo '<strong>Title:</strong> ' . esc_html($title) . '<br>';
        echo '<strong>Year:</strong> ' . esc_html($year) . '<br>';
        echo '<strong>Genre:</strong> ' . esc_html($genre_obj ? $genre_obj->name : '') . '<br>';
        echo '<strong>Price:</strong> ' . esc_html($price) . ' ' . esc_html($currency) . '</div>';
      }
    }
  }
}
add_action('wp_head', 'ds_add_movie_tab');

// Movies Tab: grid + add form
function ds_movies_tab() {
  echo '<div class="ds-movies-tab">';
  echo '<h2 class="mb-4">Movies</h2>';
  // Add Movie Form
  ds_add_movie_tab();
  // Genre Tabs
  $genres = get_terms(['taxonomy' => 'movie_genre', 'hide_empty' => false]);
  $active_genre = isset($_GET['ds_genre']) ? intval($_GET['ds_genre']) : 0;
  echo '<ul class="nav nav-tabs mb-4">';
  echo '<li class="nav-item"><a class="nav-link' . ($active_genre ? '' : ' active') . '" href="' . esc_url(add_query_arg('ds_genre', 0)) . '">All</a></li>';
  foreach ($genres as $genre) {
    $active = ($active_genre === $genre->term_id) ? ' active' : '';
    echo '<li class="nav-item"><a class="nav-link' . $active . '" href="' . esc_url(add_query_arg('ds_genre', $genre->term_id)) . '">' . esc_html($genre->name) . '</a></li>';
  }
  echo '</ul>';
  // Movies Grid (filtered by genre)
  $movies_args = [
    'post_type' => 'movies',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
  ];
  if ($active_genre) {
    $movies_args['tax_query'] = [
      [
        'taxonomy' => 'movie_genre',
        'field' => 'term_id',
        'terms' => $active_genre,
      ]
    ];
  }
  $movies_query = new WP_Query($movies_args);
  if ($movies_query->have_posts()) {
    echo '<div class="row g-4 mb-5">';
    while ($movies_query->have_posts()) {
      $movies_query->the_post();
      $year = get_post_meta(get_the_ID(), 'ds_movie_year', true);
      $price = get_post_meta(get_the_ID(), 'ds_movie_price', true);
      $currency = get_post_meta(get_the_ID(), 'ds_movie_currency', true);
      $genres = wp_get_post_terms(get_the_ID(), 'movie_genre');
      echo '<div class="col-6 col-md-4 col-lg-3">';
      echo '<div class="card h-100">';
      if (has_post_thumbnail()) {
        the_post_thumbnail('medium_large', ['class' => 'card-img-top']);
      }
      echo '<div class="card-body">';
      echo '<h5 class="card-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>';
      if ($year) echo '<div><strong>Year:</strong> ' . esc_html($year) . '</div>';
      if ($genres) {
        $genre_names = array_map(function($g){return esc_html($g->name);}, $genres);
        echo '<div><strong>Genre:</strong> ' . implode(', ', $genre_names) . '</div>';
      }
      if ($price) echo '<div><strong>Price:</strong> ' . esc_html($price) . ' ' . esc_html($currency) . '</div>';
      // Delete button for logged-in users
      if (is_user_logged_in()) {
        echo '<form method="post" style="margin-top:10px;">';
        echo '<input type="hidden" name="ds_delete_movie_id" value="' . get_the_ID() . '">' ;
        echo wp_nonce_field('ds_delete_movie_' . get_the_ID(), 'ds_delete_movie_nonce', true, false);
        echo '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this movie?\');">Delete</button>';
        echo '</form>';
      }
      echo '</div></div></div>';
    }
    echo '</div>';
    wp_reset_postdata();
  } else {
    echo '<p>No movies found.</p>';
  }
  echo '</div>';
}

// Handle movie deletion
  if (is_user_logged_in() && isset($_POST['ds_delete_movie_id'], $_POST['ds_delete_movie_nonce'])) {
    $delete_id = intval($_POST['ds_delete_movie_id']);
    if (wp_verify_nonce($_POST['ds_delete_movie_nonce'], 'ds_delete_movie_' . $delete_id)) {
      $post = get_post($delete_id);
      if ($post && $post->post_type === 'movies') {
        wp_delete_post($delete_id, true);
        echo '<div class="alert alert-warning mt-2">Movie deleted.</div>';
      }
    }
  }
