<?php
/**
 * WooCommerce hooks
 *
 * @package storefront
 */

/**
 * Header
 * @see  storefront_product_search()
 * @see  storefront_header_cart()
 */

add_action( 'polefitness_header', 'polefitness_header_cart', 60 );