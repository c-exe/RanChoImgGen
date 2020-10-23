<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/c-exe
 * @since      1.0.0
 *
 * @package    Ranchoimggen
 * @subpackage Ranchoimggen/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Ranchoimggen
 * @subpackage Ranchoimggen/includes
 * @author     C Collingridge <chriscollingridge@oakleaf-enterprise.org>
 */
class Ranchoimggen_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
	  if (shortcode_exists('ranchoimggen'))
	  {
	    remove_shortcode('ranchoimggen');
	  }
	}

}
