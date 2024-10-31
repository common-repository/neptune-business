<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themespla.net
 * @since             1.0.0
 * @package           Neptune_Busines
 *
 * @wordpress-plugin
 * Plugin Name:       Neptune Business
 * Plugin URI:        https://themespla.net/neptune
 * Description:       Add custom features to Neptune WP theme
 * Version:           1.0.1
 * Author:            Mike Aggrey
 * Author URI:        https://themespla.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       neptune-busines
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'NEPTUNE_BUSINESS', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-neptune-busines-activator.php
 */
function activate_neptune_busines() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-neptune-busines-activator.php';
	Neptune_Busines_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-neptune-busines-deactivator.php
 */
function deactivate_neptune_busines() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-neptune-busines-deactivator.php';
	Neptune_Busines_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_neptune_busines' );
register_deactivation_hook( __FILE__, 'deactivate_neptune_busines' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-neptune-busines.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_neptune_busines() {

	$plugin = new Neptune_Busines();
	$plugin->run();

}
run_neptune_busines();
