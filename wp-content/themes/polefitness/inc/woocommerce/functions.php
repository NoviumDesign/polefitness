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

// Display x products per page.
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 100;' ), 20 );
 
/**
 * Hide shipping rates when free shipping is available
 *
 * @param array $rates Array of rates found for the package
 * @param array $package The package array/object being shipped
 * @return array of modified rates
 */
function hide_collect_when_dropshipping_is_available( $rates, $package ) {
  
  // Only modify rates if free_shipping is present
    if ( isset( $rates['per_product'] ) ) {
      
      // To unset all methods except for free_shipping, do the following
      $per_product          = $rates['per_product'];
      $rates                = array();
      $rates['per_product'] = $per_product;
  }
  
  return $rates;
}