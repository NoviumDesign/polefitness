<?php
/**
 * Template Name: Checkout
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
  <aside>
    <h2>I varukorgen</h2>
    <?php
        global $woocommerce;
        $items = $woocommerce->cart->get_cart();

            foreach($items as $item => $values) { 
                $_product = $values['data']->post; 
                echo "<b>".$_product->post_title.'</b>  <br> Quantity: '.$values['quantity'].'<br>'; 
                $price = get_post_meta($values['product_id'] , '_price', true);
                echo "  Price: ".$price."<br>";
            }
    ?>
  </aside>
</div>
<pre width="100%"><?php var_dump($items) ?></pre>
<?php get_footer(); ?>
