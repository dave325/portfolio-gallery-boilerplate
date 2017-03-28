<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://daviddataram.com/portfolio/plugin/portfolio-gallery
 * @since      1.0.0
 *
 * @package    Portfolio_gallery
 * @subpackage Portfolio_gallery/public/partials
 */
?>
<?php

/*
 *
 * Nes tthe foreach loops to search fro specific keys
 *
 *
 */
function multiKeyExists(Array $array, $key, $subKey) {
	foreach ( $array as $k => $v ) {
		foreach ( $array [$k] as $key => $value ) {
			if ($key === $subKey) {
				return true;
			}
		}
	}
	return false;
}
function display_public_page($atts) {
	$plugin_options = get_option ( 'ddata_plugin_options' );
	$gallery_items = array ();
	$link_image = array ();
	$output = '';
	$defaults = shortcode_atts ( array (
			'title' => $plugin_options ['ddata_title'],
			'gallery' => $plugin_options ['ddata_amount'] 
	), $atts );
	$i = 1;
	$output .= "<h2>{$defaults['title']} </h2>";
	if (isset ( $plugin_options ['ddata_gallery_selection_rows'] )) {
		$amount_of_rows = $plugin_options ['ddata_gallery_selection_rows'];
		$output .= "<div class='gallery row-{$amount_of_rows}' id='ddata-portfolio-container'>";
	} else {
		$output .= "<div class='gallery row' id='ddata-portfolio-container' style='height:100%;'>";
	}
	foreach ( $plugin_options as $key => $value ) {
		$ddata_image = $defaults ['title'] . '_Image_';
		// adds the link sub array values
		if (substr ( $key, 6, 4 ) === 'link') {
			$link_number = substr ( $key, - 1 ); // gets the link number for the array
			                                     // check to see if $link_image array has the image key in it
			if (! array_key_exists ( $ddata_image . $link_number, $link_image )) {
				// Use the function to chekc if the $link_image sub array has the desired image key
				if (multiKeyExists ( $link_image, $ddata_image . $link_number, 'link' ) == false) { // if the array does not exist then...
					if (isset ( $link_image [$ddata_image . $link_number] )) { // check to see if the $link_image array is set
						
						if (isset ( $link_image [$ddata_image . $link_number] ['link'] )) { // check to see if the link sub array is set
							$link_image [$ddata_image . $link_number] ['link'] = $value; // adds the link sub array value to teh link sub array
						}
						continue; // continue with the code if the link sub array is set
					} else {
						$link_image [$ddata_image . $link_number] ['link'] = $value; // adds the link sub array value to teh link sub array
					}
				} else {
					$link_image [$ddata_image . $link_number] ['link'] = $value; // adds the link sub array value to teh link sub array
				}
			}
		}
		// adds the image sub array values
		if (substr ( $key, 6, 5 ) === 'image') {
			$image_number = substr ( $key, - 1 ); // gets the image number for the array
			                                      // check to see if $link_image array has the image key in it
			if (! array_key_exists ( $ddata_image . $image_number, $link_image )) {
				// Use the function to check if the $link_image sub array has the desired image key
				if (multiKeyExists ( $link_image, $ddata_image . $image_number, 'image' ) == false) { // if the array does not exist then...
					if (isset ( $link_image [$ddata_image . $image_number] )) { // check to see if the $link_image array is set
						if (isset ( $link_image [$ddata_image . $image_number] ['image'] )) { // check to see if the image sub array is set
							continue; // continue with the code if image sub array is set
						} else {
							$link_image [$ddata_image . $image_number] ['image'] = $value; // adds the image sub array value to the image sub array
						}
					} else {
						continue;
					}
				}
			} else {
				if (multiKeyExists ( $link_image, $ddata_image . $image_number, 'image' ) == false) { // if th earay does not exist then...
					if (isset ( $link_image [$ddata_image . $image_number] )) { // if the $link_image array is set
						if (isset ( $link_image [$ddata_image . $image_number] ['image'] )) { // check to see if image sub array is set
							continue; // continue with the code if image sub array is set
						} else {
							$link_image [$ddata_image . $image_number] ['image'] = $value; // adds the image sub array to the image sub array
						}
					} else {
						continue;
					}
				} else {
					$link_image [$ddata_image . $image_number] ['image'] = $value; // adds the image sub array to the image sub array
				}
			}
		}
		if (substr ( $key, 12, 6 ) === 'height') {
			$height_number = substr ( $key, - 1 ); // gets the height number for the array
			$link_image [$ddata_image . $height_number] ['height'] = $value; // adds the height sub array value to teh height sub array
		}
		if (substr ( $key, 12, 5 ) === 'width') {
			$width_number = substr ( $key, - 1 ); // gets the width number for the array
			$link_image [$ddata_image . $width_number] ['width'] = $value; // adds the width sub array value to the width sub array
		}
	}
	// loop through $link_image array to output images
	foreach ( $link_image as $k => $v ) {
		if ($amount_of_rows == 2) {
			if ($i % 2 == 1) {
				$output .= "<div class='portfolio-row' style='height:{$v['height']}px;'>";
			}
		}
		if ($amount_of_rows == 3) {
			if ($i % 3 == 1) {
				$output .= "<div class='portfolio-row' style='height:{$v['height']}px;'>";
			}
		}
		if ($amount_of_rows == 4) {
			if ($i % 4 == 1) {
				$output .= "<div class='portfolio-row' style='height:{$v['height']}px;'>";
			}
		}
		if (isset ( $v ['link'] ) && strlen ( $v ['link'] ) > 4) {
			$output .= "<a href='{$v['link']}' target='blank'>";
		}
		if ($amount_of_rows == 2) {
			if ($i % 2 == 1) {
				$output .= "<img src='{$v['image']}' alt='{$k}' class='pull-left' id='{$key}'height='{$v['height']}px' width='{$v['width']}%' />";
			}
			if ($i % 2 == 0) {
				$output .= "<img src='{$v['image']}' alt='{$k}' class='pull-right' height='{$v['height']}px' width='{$v['width']}%'/>";
			}
		}
		if ($amount_of_rows == 3 || $amount_of_rows == 4) {
			$output .= "<img src='{$v['image']}' alt='{$k}' height='{$v['height']}px' width='{$v['width']}%' />";
		}
		if (isset ( $v ['link'] ) && strlen ( $v ['link'] ) > 4) {
			$output .= "</a>";
		}
		if ($amount_of_rows == 2) {
			if ($i % 2 == 0) {
				$output .= "</div>";
			}
		}
		if ($amount_of_rows == 3) {
			if ($i % 3 == 0) {
				$output .= "</div>";
			}
		}
		if ($amount_of_rows == 4) {
			if ($i % 4 == 1) {
				$output .= "</div>";
			}
		}
		$i ++;
	}
	$output .= "<br/>";
	$output .= "</div>";
	return $output;
}
add_shortcode ( 'ddata_gallery', 'display_public_page' );
?>