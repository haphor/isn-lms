<?php use Inc\Init;

/**
 * @package           ISN Learning
 *
 *
 * Plugin Name:       ISN Learning
 * Plugin URI:        https://#
 * Description:       Learning plugin
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Opeyemi Ibrahim
 * Author URI:        https://#
 * Text Domain:       isn-learning
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  This file can\'t be accessed. Go away you sly fox';
	exit;
}

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


/**
 * The code that runs during plugin activation
 */
function activate_isn_learning_plugin() {
	Inc\Base\Activate::activate();
	Inc\Base\LoginController::isn_plugin_activation();
    ( new Inc\Base\DataController )->isnPluginUserTable();
}
register_activation_hook( __FILE__, 'activate_isn_learning_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_isn_learning_plugin() {
	Inc\Base\Deactivate::deactivate();
	Inc\Base\LoginController::isn_delete_all_pages();
}
register_deactivation_hook( __FILE__, 'deactivate_isn_learning_plugin' );


/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( Init::class ) ) {
	Inc\Init::register_services();
}