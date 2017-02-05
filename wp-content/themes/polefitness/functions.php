<?php
/**
 * polefitness functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package polefitness
 */

if ( ! function_exists( 'polefitness_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function polefitness_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on polefitness, use a find and replace
	 * to change 'polefitness' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'polefitness', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'polefitness' ),
    'footer' => esc_html__( 'Footer Menu', 'polefitness' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'polefitness_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // polefitness_setup
add_action( 'after_setup_theme', 'polefitness_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function polefitness_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'polefitness_content_width', 640 );
}
add_action( 'after_setup_theme', 'polefitness_content_width', 0 );

/**
 * Extend Recent Posts Widget
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */

Class Custom_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

  function widget($args, $instance) {

    extract( $args );

    $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);

    if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
      $number = 5;

    $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
    if( $r->have_posts() ) :

      echo $before_widget;
      if( $title ) echo $before_title . $title . $after_title; ?>

      <ul class="widget-recent-posts">
        <?php while( $r->have_posts() ) : $r->the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_the_post_thumbnail() ?></a>
          <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
          <p><?php echo wp_trim_words( get_the_content(), 15, '...' ); ?></p>
        </li>
        <?php endwhile; ?>
      </ul>

      <?php
      echo $after_widget;

    wp_reset_postdata();

    endif;
  }
}
function custom_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('Custom_Recent_Posts_Widget');
}
add_action('widgets_init', 'custom_recent_widget_registration');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function polefitness_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'polefitness' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Checkout', 'polefitness' ),
		'id'            => 'checkout-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

  register_sidebar( array(
    'name'          => esc_html__( 'Footer', 'polefitness' ),
    'id'            => 'footer-widget',
    'description'   => '',
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h6 class="widget-title">',
    'after_title'   => '</h6>',
  ) );

}
add_action( 'widgets_init', 'polefitness_widgets_init' );

/**
 * Adjust image sizes for this webpage
 */


add_action( 'after_setup_theme', 'vida_theme_setup' );
function vida_theme_setup() {
    add_image_size ( 'employees', 300, 444, true );
    add_image_size ( 'blog_overview', 465, 237, true );
    add_image_size ( 'blog_single', 465, 237, true );
    add_image_size ( 'front_page_promo', 1000, 350, true);
    add_image_size ( 'front_box', 344, 243, true);

}


add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Disable all woocommerce auto-css. We rely on our own coding skills. #coolness
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/**
 * Tell WooCommerce that we know what we are doing and our theme is configurated to use WooCommerce.
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


// Custom posttype
add_action( 'init', 'create_posttype' );
function create_posttype() {
  register_post_type( 'courses',
    array(
      'labels' => array(
        'name' => __( 'Kurser' ),
        'singular_name' => __( 'Kurs' )
      ),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'kurs'),
      'supports' => array( 'title', 'page-attributes'),
      'hierarchical' => false
    )
  );
  register_post_type( 'faq',
    array(
      'labels' => array(
        'name' => __( 'Vanliga frågor' ),
        'singular_name' => __( 'Vanlig fråga' )
      ),
      'supports' => array(
        'title',
        'editor',
        'page-attributes'
      ),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'faq'),
      'hierarchical' => false
    )
  );
  register_post_type( 'employees',
    array(
      'labels' => array(
        'name' => __( 'Instruktörer' ),
        'singular_name' => __( 'Intruktör' )
      ),
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'page-attributes'
      ),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'instruktorer'),
      'hierarchical' => false
    )
  );
}

/**
 * Enqueue scripts and styles.
 */
function polefitness_scripts() {
	wp_enqueue_style( 'polefitness-style', get_stylesheet_uri() );
	wp_enqueue_style('fullcalendar', 'https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.css');

	wp_enqueue_script( 'jquery-2', get_template_directory_uri() . '/js/vendor/jquery-2.1.4.min.js', array(), '2.1.4', true );
	wp_enqueue_script( 'jquery-form-validator', '//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js', array(), '2.2.8', true );
  wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/vendor/owl.carousel.min.js', array(), '2.0.0-beta.2.4', true );
    wp_enqueue_script( 'moment', '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js', array(), '2.9.0', true);
    wp_enqueue_script( 'fullcalendar', 'https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js', array(), '3.1.0', true );
    wp_enqueue_script( 'polefitness-app', get_template_directory_uri() . '/js/app.js', array(), '0001', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'polefitness_scripts' );

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/functions/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/woocommerce/hooks.php';
require get_template_directory() . '/inc/woocommerce/template-tags.php';
require get_template_directory() . '/inc/woocommerce/functions.php';
