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


  <div class="employees-grid"><!-- employee-grid -->
    <?php
      $args = array( 'post_type' => 'employees', 'posts_per_page' => 25, 'orderby' => 'menu_order' );
      $loop = new WP_Query( $args );
      while ( $loop->have_posts() ) : $loop->the_post();
    ?>

    <div class="employee">
        <?php
            $instagram = get_post_custom_values('instagram', get_the_ID());

            if (null !== $instagram) {
                $instagram = array_pop($instagram);
            }
        ?>

        <?php the_post_thumbnail( 'employees' ); ?>

        <h3><?php the_title(); ?></h3>

        <?php if ($instagram !== null): ?>
            <a href="https://www.instagram.com/<?php echo $instagram; ?>">@<?php echo $instagram; ?></a>
        <?php endif; ?>

        <?php the_content(); ?>

    </div>

    <?php endwhile; ?>

  </div><!-- employee-grid END -->

</div>

<?php get_footer(); ?>