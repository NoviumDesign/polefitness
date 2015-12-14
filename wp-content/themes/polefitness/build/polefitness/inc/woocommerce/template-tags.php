<?php
/**
 * Custom template tags used to integrate this theme with WooCommerce.
 *
 * @package polefitness
 */

/**
 * Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 * @param  array $settings Settings
 * @return array           Settings
 * @since  1.0.0
 */
if ( ! function_exists( 'polefitness_cart_link' ) ) {
  function polefitness_cart_link() {
    ?>
      <a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'Visa varukorgen', 'polefitness' ); ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/images/cart.svg" height="16" width="16">
        <span class="count">
          <?php 
            $product = wp_kses_data( sprintf( '%d', WC()->cart->get_cart_contents_count() ) );
            if($product == 1) {
              echo $product . ' <span class="product">vara</span>';
            }
            else {
              echo $product . ' <span class="product">varor</span>';
            }
          ?>
        </span>
        <span class="amount">
          (<?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?>)
        </span>
      </a>
    <?php
  }
}

/**
 * Display Header Cart
 * @since  1.0.0
 * @uses  is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */
if ( ! function_exists( 'polefitness_header_cart' ) ) {
  function polefitness_header_cart() {
    if ( is_woocommerce_activated() ) {
      if ( is_cart() ) {
        $class = 'current-menu-item';
      } else {
        $class = '';
      }
    ?>
    <ul class="site-header-cart menu">
      <li class="<?php echo esc_attr( $class ); ?>">
        <?php polefitness_cart_link(); ?>
      </li>
      <li>
        <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
      </li>
    </ul>
    <?php
    }
  }
}