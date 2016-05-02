<?php
/**
 * The template for displaying home pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package polefitness
 */

get_header(); ?>

<?php
  $promo_img = get_field('promo_img');
  $promo_img_thumb = $promo_img['sizes'][ 'front_page_promo' ];

  $box_1_img = get_field('box_1_img');
  $box_1_img_thumb = $box_1_img['sizes'][ 'front_box' ];

  $box_2_img = get_field('box_2_img');
  $box_2_img_thumb = $box_2_img['sizes'][ 'front_box' ];

  $box_3_img = get_field('box_3_img');
  $box_3_img_thumb = $box_3_img['sizes'][ 'front_box' ];
?>

<section class="promo" style="background-image: url('<?php echo $promo_img_thumb; ?>');">
  <div class="right">
    <ul class="checkmarks">
      <li><?php echo get_field('checkmark_1') ?></li>
      <?php if( !empty( get_field('checkmark_2') ) ): ?>
        <li><?php echo get_field('checkmark_2') ?></li>
      <?php endif; ?>
      <?php if( !empty( get_field('checkmark_3') ) ): ?>
        <li><?php echo get_field('checkmark_3') ?></li>
      <?php endif; ?>
    </ul>
    <div class="button-container">
      <a class="button wide" href="<?php echo get_field('button_link') ?>"><?php echo get_field('button_text') ?></a>
    </div>
  </div>
</section>

<section class="boxes">
  <div class="box">

    <a href="<?php the_field('box_1_link'); ?>">
      <?php
        if( !empty($box_1_img) ): ?>
        <div class="image-column">
          <img src="<?php echo $box_1_img_thumb; ?>"/>
        </div>
      <?php endif; ?>
    </a>
    <h2><?php the_field('box_1_title'); ?></h2>
    <?php the_field('box_1_text'); ?>
    <a href="<?php the_field('box_1_link'); ?>">Läs mer</a>

  </div>
  <div class="box">

    <a href="<?php the_field('box_2_link'); ?>">
      <?php
        if( !empty($box_2_img) ): ?>
        <div class="image-column">
          <img src="<?php echo $box_2_img_thumb; ?>"/>
        </div>
      <?php endif; ?>
    </a>
    <h2><?php the_field('box_2_title'); ?></h2>
    <?php the_field('box_2_text'); ?>
    <a href="<?php the_field('box_2_link'); ?>">Läs mer</a>

  </div>
  <div class="box">

    <a href="<?php the_field('box_3_link'); ?>">
      <?php
        if( !empty($box_3_img) ): ?>
        <div class="image-column">
          <img src="<?php echo $box_3_img_thumb; ?>"/>
        </div>
      <?php endif; ?>
    </a>
    <h2><?php the_field('box_3_title'); ?></h2>
    <?php the_field('box_3_text'); ?>
    <a href="<?php the_field('box_3_link'); ?>">Läs mer</a>

  </div>
</section>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <section class="front-page-content">

      <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'template-parts/content', 'front-page' ); ?>

        <?php
          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;
        ?>

      <?php endwhile; // End of the loop. ?>

    </section>



  </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>

<!-- newsletter cta block -->
<div class="newsletter-cta">
  <div class="newsletter-container">
    <div class="tagline">
      <h3><?php the_field('newsletter_tagline'); ?></h3>
    </div>
    <!-- Begin MailChimp Signup Form -->
    <div class="signup-form" id="mc_embed_signup">
      <form action="//vidapole.us12.list-manage.com/subscribe/post?u=c52e260043b6e21c50a734d61&amp;id=d78d9271f2" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <div id="mc_embed_signup_scroll">
          <div class="mc-field-group">
          	<input data-validation="email" data-validation-error-msg="Ange en korrekt e-postadress" placeholder="E-post" type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
            <button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe">Skicka</button>
          </div>
        	<div id="mce-responses" class="clear">
        		<div class="response" id="mce-error-response" style="display:none"></div>
        		<div class="response" id="mce-success-response" style="display:none"></div>
        	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
          <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_c52e260043b6e21c50a734d61_d78d9271f2" tabindex="-1" value=""></div>
        </div>
      </form>
    </div>
    <!--End mc_embed_signup-->
  </div>
</div>

<!-- contact block -->
<div class="contact" style="background-image:url('wp-content/themes/polefitness/images/map.jpg');">
  <div class="contact-content">
    <img src="wp-content/themes/polefitness/images/contact.svg" alt="Kontakta oss">
    <h2><?php the_field('contact_title') ?></h2>
    <p>
      <?php the_field('contact_text') ?>
    </p>
    <div class="contact-info">
      <?php the_field('contact_adress') ?>
    </div>
    <div class="contact-info">
      <ul>
        <li><?php the_field('contact_phone') ?></li>
        <li><a href="mailto:<?php the_field('contact_email') ?>"><?php the_field('contact_email') ?></a></li>
      </ul>
      <div class="social-media">
        <!--[if gte IE 10]><!--><a href="<?php the_field('facebook') ?>" target="_blank"><img src="wp-content/themes/polefitness/images/facebook.svg" alt="Facebook"></a><!--<![endif]-->
        <!--[if lt IE 10]><a href="<?php the_field('facebook') ?>" target="_blank"><img src="wp-content/themes/polefitness/images/facebook.png" alt="Facebook"></a><![endif]-->
        <!--[if gte IE 10]><!--><a href="<?php the_field('instagram') ?>" target="_blank"><img src="wp-content/themes/polefitness/images/instagram.svg" alt="Instagram"></a><!--<![endif]-->
        <!--[if lt IE 10]><a href="<?php the_field('instagram') ?>" target="_blank"><img src="wp-content/themes/polefitness/images/instagram.png" alt="Instagram"></a><![endif]-->
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
