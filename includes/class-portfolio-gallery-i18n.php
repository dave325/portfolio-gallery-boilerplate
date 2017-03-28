<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://daviddataram.com/portfolio/plugin/portfolio-gallery
 * @since      1.0.0
 *
 * @package    Portfolio_Gallery Plugin
 * @subpackage Portfolio_Gallery/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Portfolio_Gallery Plugin
 * @subpackage Portfolio_Gallery/includes
 * @author     David Dataram <davedataram@gmail.com>
 */
class ddata_Portfolio_Gallery_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'plugin-name',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
