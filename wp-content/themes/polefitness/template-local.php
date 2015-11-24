<?php
/**
 * Template Name: Lokal
 *
 * @package polefitness
 */

get_header(); ?>
      
<div id="subpage">
  <?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'template-parts/content', 'page' ); ?>

    <?php
      // If comments are open or we have at least one comment, load up the comment template.
      if ( comments_open() || get_comments_number() ) :
        comments_template();
      endif;
    ?>

  <?php endwhile; // End of the loop. ?>


  <div class="local-carousel"><!-- local-carousel -->

    <?php
      $args = array( 'post_type' => 'local-media', 'posts_per_page' => 25, 'orderby' => 'menu_order' );
      $loop = new WP_Query( $args );
      while ( $loop->have_posts() ) : $loop->the_post();
    ?>

      <div> <?php the_post_thumbnail(); ?>  </div>

    <?php endwhile; ?>

  </div><!-- local-carousel END -->

</div>

<?php get_footer(); ?>