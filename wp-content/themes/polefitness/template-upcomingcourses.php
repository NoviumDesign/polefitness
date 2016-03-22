<?php
/**
 * Template Name: Upcoming courses
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
        'key'   => 'upcoming_event',
        'value'   => 'TRUE',
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
        'key'   => 'upcoming_event',
        'value'   => 'TRUE',
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
        'key'   => 'upcoming_event',
        'value'   => 'TRUE',
        'compare' => '='
      )
    )
  );
  $wednesday_items = new WP_Query( $wednesday_args );

  $thursday_args = array(
    'post_type' => 'courses',
    'posts_per_page' => 25,
    'orderby' => 'menu_order',
    'meta_query'  => array(
      'relation'    => 'AND',
      array(
        'key'   => 'weekday',
        'value'   => 'Torsdag',
        'compare' => '='
      ),
      array(
        'key'   => 'upcoming_event',
        'value'   => 'TRUE',
        'compare' => '='
      )
    )
  );
  $thursday_items = new WP_Query( $thursday_args );

  $friday_args = array(
    'post_type' => 'courses',
    'posts_per_page' => 25,
    'orderby' => 'menu_order',
    'meta_query'  => array(
      'relation'    => 'AND',
      array(
        'key'   => 'weekday',
        'value'   => 'Fredag',
        'compare' => '='
      ),
      array(
        'key'   => 'upcoming_event',
        'value'   => 'TRUE',
        'compare' => '='
      )
    )
  );
  $friday_items = new WP_Query( $friday_args );

  $saturday_args = array(
    'post_type' => 'courses',
    'posts_per_page' => 25,
    'orderby' => 'menu_order',
    'meta_query'  => array(
      'relation'    => 'AND',
      array(
        'key'   => 'weekday',
        'value'   => 'Lördag',
        'compare' => '='
      ),
      array(
        'key'   => 'upcoming_event',
        'value'   => 'TRUE',
        'compare' => '='
      )
    )
  );
  $saturday_items = new WP_Query( $saturday_args );

  $sunday_args = array(
    'post_type' => 'courses',
    'posts_per_page' => 25,
    'orderby' => 'menu_order',
    'meta_query'  => array(
      'relation'    => 'AND',
      array(
        'key'   => 'weekday',
        'value'   => 'Söndag',
        'compare' => '='
      ),
      array(
        'key'   => 'upcoming_event',
        'value'   => 'TRUE',
        'compare' => '='
      )
    )
  );
  $sunday_items = new WP_Query( $sunday_args );

?>
<div id="subpage">
  <?php while ( have_posts() ) : the_post(); ?>

    <div class="content-area subpage-content">
      <main id="main" class="site-main" role="main">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php if (has_post_thumbnail( $post->ID ) ): ?>
          <?php
            $thumb_id = get_post_thumbnail_id();
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
            $thumb_url = $thumb_url_array[0];
          ?>
        <?php endif; ?>

        <header class="entry-header" 
          <?php if (has_post_thumbnail( $post->ID ) ): ?>
            style="background-image:url('<?php echo $thumb_url ?>')"
          <?php endif; ?>
        >
          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header>

          <div class="entry-content">
            <?php the_content(); ?>
            <?php
              wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'polefitness' ),
                'after'  => '</div>',
              ) );
            ?>

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
                        <div class="time"><?php the_field('time'); ?></div>
                        <div class="link"><?php echo get_the_title( $post->ID ); ?></div>
                        <div class="instructor"><?php the_field('instructor'); ?></div>
                        <div class="register">
                        <?php
                          if( get_field('no_instructor') )
                          {
                              echo "Ingen anmälan krävs";
                          }
                          else
                          { ?>
                            <a href="<?php the_permalink( $post->ID ); ?>">Anmälan</a>
                          <?php } ?>
                        </div>
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
                        <div class="time"><?php the_field('time'); ?></div>
                        <div class="link"><?php echo get_the_title( $post->ID ); ?></div>
                        <div class="instructor"><?php the_field('instructor'); ?></div>
                        <div class="register">
                        <?php
                          if( get_field('no_instructor') )
                          {
                              echo "Ingen anmälan krävs";
                          }
                          else
                          { ?>
                            <a href="<?php the_permalink( $post->ID ); ?>">Anmälan</a>
                          <?php } ?>                          
                        </div>
                    </li>
                  <?php endwhile; ?>
                </ul>
              </li>

              <li>
                <a href="javascript:void(0)" class="js-accordion-trigger">
                  <div class="time">Onsdag</div>
                  <div class="link">Kurs</div>
                  <div class="instructor">Instruktör</div>
                </a>
                <ul class="accordion-content">
                  <?php while ( $wednesday_items->have_posts() ) : $wednesday_items->the_post(); ?>
                    <li class="item">
                        <div class="time"><?php the_field('time'); ?></div>
                        <div class="link"><?php echo get_the_title( $post->ID ); ?></div>
                        <div class="instructor"><?php the_field('instructor'); ?></div>
                        <div class="register"><a href="<?php the_permalink( $post->ID ); ?>">Anmälan</a></div>
                    </li>
                  <?php endwhile; ?>
                </ul>
              </li>

              <li>
                <a href="javascript:void(0)" class="js-accordion-trigger">
                  <div class="time">Torsdag</div>
                  <div class="link">Kurs</div>
                  <div class="instructor">Instruktör</div>
                </a>
                <ul class="accordion-content">
                  <?php while ( $thursday_items->have_posts() ) : $thursday_items->the_post(); ?>
                    <li class="item">
                        <div class="time"><?php the_field('time'); ?></div>
                        <div class="link"><?php echo get_the_title( $post->ID ); ?></div>
                        <div class="instructor"><?php the_field('instructor'); ?></div>
                        <div class="register">
                        <?php
                          if( get_field('no_instructor') )
                          {
                              echo "Ingen anmälan krävs";
                          }
                          else
                          { ?>
                            <a href="<?php the_permalink( $post->ID ); ?>">Anmälan</a>
                          <?php } ?>                          
                        </div>
                    </li>
                  <?php endwhile; ?>
                </ul>
              </li>

              <li>
                <a href="javascript:void(0)" class="js-accordion-trigger">
                  <div class="time">Fredag</div>
                  <div class="link">Kurs</div>
                  <div class="instructor">Instruktör</div>
                </a>
                <ul class="accordion-content">
                  <?php while ( $friday_items->have_posts() ) : $friday_items->the_post(); ?>
                    <li class="item">
                        <div class="time"><?php the_field('time'); ?></div>
                        <div class="link"><?php echo get_the_title( $post->ID ); ?></div>
                        <div class="instructor"><?php the_field('instructor'); ?></div>
                        <div class="register">
                        <?php
                          if( get_field('no_instructor') )
                          {
                              echo "Ingen anmälan krävs";
                          }
                          else
                          { ?>
                            <a href="<?php the_permalink( $post->ID ); ?>">Anmälan</a>
                        <?php } ?>                          
                        </div>
                    </li>
                  <?php endwhile; ?>
                </ul>
              </li>

              <li>
                <a href="javascript:void(0)" class="js-accordion-trigger">
                  <div class="time">Lördag</div>
                  <div class="link">Kurs</div>
                  <div class="instructor">Instruktör</div>
                </a>
                <ul class="accordion-content">
                  <?php while ( $saturday_items->have_posts() ) : $saturday_items->the_post(); ?>
                    <li class="item">
                        <div class="time"><?php the_field('time'); ?></div>
                        <div class="link"><?php echo get_the_title( $post->ID ); ?></div>
                        <div class="instructor"><?php the_field('instructor'); ?></div>
                        <div class="register">
                          <?php
                            if( get_field('no_instructor') )
                            {
                                echo "Ingen anmälan krävs";
                            }
                            else
                            { ?>
                              <a href="<?php the_permalink( $post->ID ); ?>">Anmälan</a>
                          <?php } ?>                          
                        </div>
                    </li>
                  <?php endwhile; ?>
                </ul>
              </li>

              <li>
                <a href="javascript:void(0)" class="js-accordion-trigger">
                  <div class="time">Söndag</div>
                  <div class="link">Kurs</div>
                  <div class="instructor">Instruktör</div>
                </a>
                <ul class="accordion-content">
                  <?php while ( $sunday_items->have_posts() ) : $sunday_items->the_post(); ?>
                    <li class="item">
                        <div class="time"><?php the_field('time'); ?></div>
                        <div class="link"><?php echo get_the_title( $post->ID ); ?></div>
                        <div class="instructor"><?php the_field('instructor'); ?></div>
                        <div class="register">
                          <?php
                            if( get_field('no_instructor') )
                            {
                                echo "Ingen anmälan krävs";
                            }
                            else
                            { ?>
                              <a href="<?php the_permalink( $post->ID ); ?>">Anmälan</a>
                          <?php } ?>                            
                        </div>
                    </li>
                  <?php endwhile; ?>
                </ul>
              </li>
            </ul>



          </div><!-- .entry-content -->
        </article>
      </main>
    </div>

  <?php endwhile; // End of the loop. ?>
</div>

<?php get_footer(); ?>
