<?php
/**
 * Template Name: FAQ
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


  <ul class="accordion faq">
    <?php
      $args = array( 'post_type' => 'faq', 'posts_per_page' => 25, 'orderby' => 'menu_order' );
      $loop = new WP_Query( $args );
      while ( $loop->have_posts() ) : $loop->the_post();
    ?>
      
      <li>

        <a href="javascript:void(0)" class="js-accordion-trigger">
          <?php the_title(); ?>
        </a>

        <div class="accordion-content">
          <?php the_content(); ?>
        </div>

      </li>


    <?php endwhile; ?>

  </ul>

  <?php get_sidebar(); ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>