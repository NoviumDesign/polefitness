<?php
/**
 * @package polefitness
 */

get_header(); ?>

  <div id="primary" class="content-area subpage-content">
    <main id="main" class="site-main" role="main">

      <iframe width="100%" height="1000" frameborder="0" allowTransparency="true" src="https://dinkurs.se/appliance/?event_id=<?php the_field('course_ID'); ?>"></iframe>
    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_footer(); ?>
