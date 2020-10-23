<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/c-exe
 * @since      1.0.0
 *
 * @package    Ranchoimggen
 * @subpackage Ranchoimggen/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ranchoimggen
 * @subpackage Ranchoimggen/includes
 * @author     C Collingridge <chriscollingridge@oakleaf-enterprise.org>
 */
class Ranchoimggen_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
          add_shortcode('ranchoimggen', 'Ranchoimggen::ranchoimggen_shortcode');
	}

}
