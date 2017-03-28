<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://daviddataram.com/portfolio/plugin/portfolio-gallery
 * @since             1.0.0
 * @package           Portfolio-Gallery Plugin 
 *
 * @wordpress-plugin
 * Plugin Name:       Portfolio-Galery Plugin 
 * Plugin URI:        http://daviddataram.com/portfolio/plugin/portfolio-gallery
 * Description:       This plugin allows the user to create either a portfolio or a gallery style layout for their images
 * Version:           1.0.0
 * Author:            Dataram Development
 * Author URI:        http://daviddataram.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       portfolio-gallery
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_portfolio_gallery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-portfolio-gallery-deactivator.php';
	ddata_Portfolio_Gallery_Deactivator::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivate_portfolio_gallery' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-portfolio-gallery.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_portfolio_gallery() {

	$plugin = new ddata_Portfolio_Gallery();
	$plugin->run();

}
run_portfolio_gallery();
