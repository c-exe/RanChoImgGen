<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/c-exe
 * @since             1.0.0
 * @package           Ranchoimggen
 * @copyright         2020 c-exe
 *
 * @wordpress-plugin
 * Plugin Name:       Randomly Chosen Image Generator
 * Plugin URI:        https://github.com/c-exe/RanChoImgGen
 * Description:       Randomly picks and shows 3 images from a given gallery.
 * Version:           1.0.0
 * Author:            C Collingridge
 * Author URI:        https://github.com/c-exe
 * Requires PHP:      7.0
 * License:           MIT
 * License URI:       https://github.com/c-exe/RanChoImgGen/blob/main/LICENSE
 * Text Domain:       ranchoimggen
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Put in wp-config.php for debugging:  define('WP_DEBUG', true)

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'RANCHOIMGGEN_VERSION', '1.0.0' );



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ranchoimggen-activator.php
 */
function activate_ranchoimggen() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ranchoimggen-activator.php';
	Ranchoimggen_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ranchoimggen-deactivator.php
 */
function deactivate_ranchoimggen() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ranchoimggen-deactivator.php';
	Ranchoimggen_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ranchoimggen' );
register_deactivation_hook( __FILE__, 'deactivate_ranchoimggen' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ranchoimggen.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ranchoimggen() {

	$plugin = new Ranchoimggen();
	$plugin->run();

}
run_ranchoimggen();
