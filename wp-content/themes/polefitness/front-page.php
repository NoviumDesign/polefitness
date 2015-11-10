<?php
/**
 * The template for displaying home pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package polefitness
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <section class="promo">
        <div class="left">
          <?php 
            $promo_img = get_field('promo_img');
            $promo_img_thumb = $promo_img['sizes'][ 'front_page_promo' ];

            if( !empty($promo_img) ): ?>
            <div class="image-column">
              <img src="<?php echo $promo_img_thumb; ?>" alt="<?php echo $promo_image['alt']; ?>" />
            </div>
          <?php endif; ?>          
        </div>
        <div class="right">
          <?php the_field('promo_text'); ?>
        </div>
      </section>
      <section class="boxes">
        <div><?php the_field('puff_1_img'); ?></div>
        <div><?php the_field('puff_2_img'); ?></div>
        <div><?php the_field('puff_2_img'); ?></div>
      </section>
      <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'template-parts/content', 'page' ); ?>

        <?php
          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;
        ?>

      <?php endwhile; // End of the loop. ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
