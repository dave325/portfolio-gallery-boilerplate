<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://daviddataram.com/portfolio/plugin/portfolio-gallery
 * @since      1.0.0
 *
 * @package    Portfolio_Gallery_Plugin
 * @subpackage Portfolio_Gallery_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Portfolio_Gallery_Plugin
 * @subpackage Portfolio_Gallery_Plugin/admin
 * @author     David Dataram <davedataram@gmail.com>
 */
class ddata_Portfolio_Gallery_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $portfolio_gallery_plugin    The ID of this plugin.
	 */
	private $portfolio_gallery_plugin;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $portfolio_gallery_plugin       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $portfolio_gallery_plugin, $version ) {

		$this->portfolio_gallery_plugin = $portfolio_gallery_plugin;
		$this->version = $version;
		$this->add_menu_page();

	}
	/**
	 * Register the public display area for the plugin
	 *
	 * @since    1.0.0
	 */
	private function add_menu_page(){
		require_once 'partials/portfolio-gallery-admin-display.php';
		new ddata_Options();
	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Portfolio_Gallery_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Portfolio_Gallery_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->portfolio_gallery_plugin, plugin_dir_url( __FILE__ ) . 'css/portfolio-gallery-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Portfolio_Gallery_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Portfolio_Gallery_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		//wp_enqueue_script( $this->portfolio_gallery_plugin, plugin_dir_url( __FILE__ ) . 'js/portfolio-gallery-admin.js', array( 'jquery' ), $this->version, false );

	}
    
}
