<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Portfolio_gallery
 * @subpackage Portfolio_gallery/public/partials
 */
?>
<?php 
	function display_public_page($atts){
		$plugin_options = get_option('ddata_plugin_options');
		$gallery_items = array();
		$output ='';
		$defaults = shortcode_atts(array(
			'title' => $plugin_options['ddata_title'],
			'gallery' => $plugin_options['ddata_amount']
		), $atts);
		$output .= "<h2>{$defaults['title']} </h2>";
		$output .= "<div class='slideShow'>";
		foreach ($plugin_options as $key=>$value){
			if (strcasecmp(substr($key, 6, -1), 'gallery') == 0){
				if (strlen($value) > 0){
					$output .= "<img src='{$value}' alt='{$key}'/>";
				}
			}
		}
		$output .= "</div>";
		return $output;
	}
	add_shortcode('gallery', 'display_public_page');
?>