<?php
/**
 * Template Name: Kalender
 *
 * @package polefitness
 */

get_header(); ?>
      
<div id="subpage">
  <?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'template-parts/content', 'page' ); ?>

  <?php endwhile; // End of the loop. ?>

    <div id="calendar"></div>

</div>

<?php get_footer(); ?>