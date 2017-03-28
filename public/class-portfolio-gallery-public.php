<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Portfolio_Gallery_Plugin
 * @subpackage Plugin_Name/public
 * @author     Your Name <email@example.com>
 */
class ddata_Portfolio_Gallery_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	/**
	 * The options of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $options    The current option of this plugin.
	 */
	private $options;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options = get_option('ddata_plugin_options');
		$this->add_display_page();
	}
	/**
	 * Register the public display area for the plugin
	 *
	 * @since    1.0.0
	 */
	public function add_display_page(){
		if (strtolower($this->options['ddata_gallery_style']) === 'gallery'){
			include_once 'partials/portfolio-gallery-public-display.php';
		}else{
			include_once 'partials/portfolio-slideshow-public-display.php';
				
		}
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
	
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
	wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/portfolio-gallery-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if (strtolower($this->options['ddata_gallery_style']) === 'gallery'){
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/portfolio-gallery-public.js', array( 'jquery' ), $this->version, false );
		}else{
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/portfolio-slideshow-public.js', array( 'jquery' ), $this->version, false );
		}
	}
}
