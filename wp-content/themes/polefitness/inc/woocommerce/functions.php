<?php
/**
 * Cart Fragments
 * Ensure cart contents update when products are added to the cart via AJAX
 * @param  array $fragments Fragments to refresh via AJAX
 * @return array            Fragments to refresh via AJAX
 */

if ( ! function_exists( 'polefitness_cart_link_fragment' ) ) {
  function polefitness_cart_link_fragment( $fragments ) {
    global $woocommerce;

    ob_start();

    polefitness_cart_link();

    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
  }
}

// Display 24 products per page.
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );