<?php
/**
 * Created by PhpStorm.
 * User: tomas
 * Date: 3/5/14
 * Time: 12:17 PM
 *
 * USES CRONTAB ENTRY: * * * * * /usr/bin/php /home/ubuntu/site/wp-content/plugins/woocommere-fortnox-interface-extendend/cron_job.php
 */
require_once( '../../../wp-load.php' );
include_once('class-woo-fortnox-controller.php');
$fortnox_interface = new WC_Fortnox_Controller();
$fortnox_interface->run_inventory_cron_job();