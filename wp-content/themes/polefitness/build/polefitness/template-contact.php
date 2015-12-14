<?php
/**
 * Template Name: Kontakt
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


  <div class="contact-information">
    <ul>
      <li class="adress">
        <?php the_field('adress'); ?>
      </li>
      <li class="email"><a href=="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a></li>
      <li class="phone"><?php the_field('phone'); ?></li>
    </ul>
  </div>

</div>

<?php get_footer(); ?>