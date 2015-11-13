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
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);