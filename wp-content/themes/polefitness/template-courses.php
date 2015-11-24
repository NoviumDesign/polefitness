<?php
/**
 * Template Name: Courses
 * @package polefitness
 */

get_header(); ?>

<?php
  $monday_args = array(
    'post_type' => 'courses',
    'posts_per_page' => 25,
    'orderby' => 'menu_order',
    'meta_query'  => array(
      'relation'    => 'AND',
      array(
        'key'   => 'weekday',
        'value'   => 'Måndag',
        'compare' => '='
      ),
      array(
        'key'   => 'upcoming_course',
        'value'   => TRUE,
        'compare' => '='
      )
    )
  );
  $monday_items = new WP_Query( $monday_args );

  $tuesday_args = array(
    'post_type' => 'courses',
    'posts_per_page' => 25,
    'orderby' => 'menu_order',
    'meta_query'  => array(
      'relation'    => 'AND',
      array(
        'key'   => 'weekday',
        'value'   => 'Tisdag',
        'compare' => '='
      ),
      array(
        'key'   => 'upcoming_course',
        'value'   => TRUE,
        'compare' => '='
      )
    )
  );
  $tuesday_items = new WP_Query( $tuesday_args );

  $wednesday_args = array(
    'post_type' => 'courses',
    'posts_per_page' => 25,
    'orderby' => 'menu_order',
    'meta_query'  => array(
      'relation'    => 'AND',
      array(
        'key'   => 'weekday',
        'value'   => 'Onsdag',
        'compare' => '='
      ),
      array(
        'key'   => 'upcoming_course',
        'value'   => TRUE,
        'compare' => '='
      )
    )
  );
  $wednesday_items = new WP_Query( $wednesday_args );

?>

  <div id="subpage">

    <?php while ( have_posts() ) : the_post(); ?>

      <ul class="accordion">
        <li>
          <a href="javascript:void(0)" class="js-accordion-trigger">
            <div class="time">Måndag</div>
            <div class="link">Kurs</div>
            <div class="instructor">Instruktör</div>
          </a>
          <ul class="accordion-content">
            <?php while ( $monday_items->have_posts() ) : $monday_items->the_post(); ?>
              <li class="item">
                <a href="<?php the_permalink( $post->ID ); ?>">
                  <div class="time"><?php the_field('time'); ?></div>
                  <div class="link"><?php echo get_the_title( $post->ID ); ?></div>
                  <div class="instructor"><?php the_field('instructor'); ?></div>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
        </li>

        <li>
          <a href="javascript:void(0)" class="js-accordion-trigger">
            <div class="time">Tisdag</div>
            <div class="link">Kurs</div>
            <div class="instructor">Instruktör</div>
          </a>
          <ul class="accordion-content">
            <?php while ( $tuesday_items->have_posts() ) : $tuesday_items->the_post(); ?>
              <li class="item">
                <a href="<?php the_permalink( $post->ID ); ?>">
                  <div class="time"><?php the_field('time'); ?></div>
                  <div class="link"><?php echo get_the_title( $post->ID ); ?></div>
                  <div class="instructor"><?php the_field('instructor'); ?></div>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
        </li>
      </ul>

    <?php endwhile; // End of the loop. ?>

</div>
<?php get_footer(); ?>
