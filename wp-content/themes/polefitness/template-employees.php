<?php
/**
 * Template Name: Medarbetare
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


  <div class="employees-grid">
    <?php
      $args = array( 'post_type' => 'employees', 'posts_per_page' => 25, 'orderby' => 'menu_order' );
      $loop = new WP_Query( $args );
      while ( $loop->have_posts() ) : $loop->the_post();
    ?>

    <div class="employee">

      <?php the_post_thumbnail(); ?> 

      <h3><?php the_title(); ?></h3>

      <?php the_content(); ?>

    </div>

    <?php endwhile; ?>

  </div>

</div>

<?php get_footer(); ?>