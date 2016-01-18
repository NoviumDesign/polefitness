<?php
require_once( 'wp-load.php' );
include_once('wp-content/plugins/woocommerce-fortnox-integration/class-woo-fortnox-controller.php');
$fortnox_interface = new WC_Fortnox_Controller();
$fortnox_interface->run_inventory_cron_job();