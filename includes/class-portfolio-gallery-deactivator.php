<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://daviddataram.com/portfolio/plugin/portfolio-gallery
 * @since      1.0.0
 *
 * @package    Portfolio-Gallery Plugin
 * @subpackage Portoflio_Gallery/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Portfolio-Gallery Plugin
 * @subpackage Portfolio_Gallery/includes
 * @author     David Dataram <davedataram@gmail.com>
 */
class ddata_Portfolio_Gallery_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
			delete_option('ddata_plugin_options');
	}

}
