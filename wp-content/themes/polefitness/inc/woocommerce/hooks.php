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
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 11 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 12 );
add_filter( 'woocommerce_package_rates', 'hide_collect_when_dropshipping_is_available', 10, 2 );