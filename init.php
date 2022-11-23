<?php
/**
 * Plugin Name:  WordPress Queue
 * Description:  REST API
 * Version:     1.0
 * Author:      Jignashu Solanki
 * @package WP_Queue
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
// require plugin_dir_path( __FILE__ ) . 'constants.php';
require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
require plugin_dir_path( __FILE__ ) . 'defs.php';
require plugin_dir_path( __FILE__ ) . 'queue-exceptions.php';
require plugin_dir_path( __FILE__ ) . 'class-whj-http-requests.php';
require plugin_dir_path( __FILE__ ) . 'helpers.php';

wp_queue()->cron( WHJ_DEFAULT_ATTEMPTS, WHJ_DEFAULT_INTERVAL );

register_activation_hook( __FILE__, 'whj_queue_plugin_activate' );
function whj_queue_plugin_activate() {
	wp_queue_install_tables();
}
