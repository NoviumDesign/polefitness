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

  <div id="secondary" class="widget-area">

    <aside>
      <h2>Din varukorg</h2>
      <?php
          global $woocommerce;
          $items = $woocommerce->cart->get_cart();
            echo "<ul>";
              foreach($items as $item => $values) { 
                  $_product = $values['data']->post;
                  //product image
                  $getProductDetail = wc_get_product( $values['product_id'] );
                  echo '<li class="mini_cart_item">';
                    echo $getProductDetail->get_image(); // accepts 2 arguments ( size, attr )

                    echo "<strong>".$_product->post_title.'</strong> '.'<br>';
                    echo $values['variation']["attribute_storlek"] . "<br>";
                    $price = get_post_meta($values['product_id'] , '_price', true);
                    echo $values['quantity'] . " × " . $price. "kr" ."<br>";

              }
            echo "</ul>";
      ?>
    </aside>

    <?php dynamic_sidebar( 'checkout-sidebar' ); ?>

  </div>

</div>
<pre width="100%"><?php var_dump($items) ?></pre>
<h2>Dump av $getProductDetail</h2>
<pre width="100%"><?php var_dump($getProductDetail)?></pre>
<?php get_footer(); ?>
