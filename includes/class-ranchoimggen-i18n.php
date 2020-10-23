<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/c-exe
 * @since      1.0.0
 *
 * @package    Ranchoimggen
 * @subpackage Ranchoimggen/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ranchoimggen
 * @subpackage Ranchoimggen/includes
 * @author     C Collingridge <chriscollingridge@oakleaf-enterprise.org>
 */
class Ranchoimggen_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ranchoimggen',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
