<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://daviddataram.com/portfolio/plugin/portfolio-gallery
 * @since      1.0.0
 *
 * @package    Portfolio_Gsllery
 * @subpackage Portfolio_Gallery/admin/partials
 */
?>
<?php
class ddata_Options{
	private $options;
	public function __construct(){
		add_action('admin_menu', function(){
			$this->add_menu_page();	
		});
			add_action('admin_init',function(){
				$this->options = get_option('ddata_plugin_options');
				$this->register_settings_and_fields();
			});
	}
	/**
	 * The reference to the function that adds the menu page to the dashboard.
	 *
	 * @since     1.0.0
	 */
	public function add_menu_page(){
		$icon = '';
		add_menu_page('Theme Options', 'Gallery', 'administrator', __FILE__, array($this, 'display_options_page'), '' , '59');
	}
	/**
	 * The reference to the function that displays the menu page to the admin page.
	 *
	 * @since     1.0.0
	 */
	public function display_options_page(){
		?>
		<div class="wrap">
			<?php settings_errors();?>
			<?php screen_icon();?>
			<h2>Portfolio Gallery Options</h2>
			<p>To activate plugin on your website, please add "[ddata_gallery]" onto the page you wish for the contact form to appear on.</p>
			
			<form method="POST" action="options.php" id="ddata-portfolio-form" enctype="multipart/form-data">
				<?php settings_fields('ddata_plugin_section');?>
				<?php do_settings_sections(__FILE__);?>
				
				<input type="submit" id="submit" class="button-primary" value="Save Changes" />
			</form>
		</div>
		<?php
	}
	/**
	 * The reference to the function that registers the fields and properties to the plugin.
	 *
	 * @since     1.0.0
	 */
	public function register_settings_and_fields(){
		register_setting('ddata_plugin_section' , 'ddata_plugin_options', array($this,'ddata_plugin_validate'));
		add_settings_section('ddata_portfolio', 'Portfolio Gallery', array($this,'ddata_main_section_cb'), __FILE__ );
		add_settings_field('ddata_title', 'Image Title', array($this, 'ddata_title'), __FILE__, 'ddata_portfolio', array('label_for' => 'ddata-title'));
		add_settings_field('ddata_amount', 'Number of Images', array($this, 'ddata_gallery_amount'), __FILE__, 'ddata_portfolio', array('label_for' => 'ddata-amount'));
		add_settings_field('ddata_gallery_style', 'Portfolio Style', array($this, 'ddata_gallery_style'), __FILE__, 'ddata_portfolio', array('label_for' => 'ddata-gallery-style'));
		add_settings_field('ddata_gallery_selection_rows', 'Number of items per row', array($this, 'ddata_gallery_selction_rows'), __FILE__, 'ddata_portfolio', array('label_for' => 'ddata-gallery-row'));
		if (isset($this->options['ddata_amount'])){
			$gallery_fields = $this->options['ddata_amount'];
			$i = 1;
			while ($i <= $gallery_fields){
				add_settings_section('ddata_gallery_' . $i, 'Gallery Image ' .$i, array($this,'ddata_main_section_cb'), __FILE__ );
				$args = array('ddata_image_' . $i, 'label_for' => 'ddata_image_' . $i);
				$link_args = array('ddata_link_' . $i, 'label_for' => 'ddata_link_question' . $i);
				$height_args = array('ddata_image_height_' . $i, 'label_for' => 'ddata_image_height_' . $i);
				$width_args = array('ddata_image_width_' . $i, 'label_for' => 'ddata_image_width_' . $i);
				add_settings_field("ddata_gallery-" . $i , 'Gallery Image ' . $i, array($this, 'ddata_gallery'), __FILE__, 'ddata_gallery_' . $i, $args);
				add_settings_field("ddata_gallery-link-" . $i , 'Link to image' . $i .' (if applicable)' , array($this, 'ddata_link'), __FILE__, 'ddata_gallery_' . $i, $link_args);
				add_settings_field("ddata_gallery-height-" . $i , 'Gallery Image Height ' . $i, array($this, 'ddata_gallery_height'), __FILE__, 'ddata_gallery_' . $i, $height_args);
				add_settings_field("ddata_gallery-width-" . $i , 'Gallery Image Width ' . $i, array($this, 'ddata_gallery_width'), __FILE__, 'ddata_gallery_' . $i, $width_args);
				$i++;
			}
		}
		
	}
	/**
	 * The reference to the function that validates the images uploaded to the admin page.
	 *
	 * @since     1.0.0
	 */
	public function ddata_plugin_validate($plugin_options){
		//Code for the images of the gallery are located here 
		if (isset($this->options['ddata_amount'])){
			$gallery_fields = $this->options['ddata_amount'];
			$i = 1;
			$gallery = array();
			while ($i <= $gallery_fields){
				$gallery_id = 'ddata_image_' . $i;
				array_push($gallery, $gallery_id);
				$i++;
			}
			foreach ($gallery as $key=>$value){
				if(!empty($_FILES[$value]['tmp_name'])){
					$override = array('test_form'=>false);
					$file = wp_handle_upload($_FILES[$value], $override);
					$plugin_options[$value] = $file['url'];
				}else{
						$plugin_options[$value] = $this->options[$value];
				}
			}
		}		
		return $plugin_options;
	}
	public function ddata_main_section_cb(){
		//optional
	}
	/**
	 * The reference to the function that adds the title field to the admin page.
	 *
	 * @since     1.0.0
	 */
	public function ddata_title(){
		if (isset($this->options['ddata_title'])){
		echo "<input required='required' id='ddata_title' name='ddata_plugin_options[ddata_title]' type='text' value='{$this->options['ddata_title']}'/>";
		}else{
			echo "<input required='required' id='ddata_title' name='ddata_plugin_options[ddata_title]' type='text' value=''/>";
		}
	}
	/**
	 * The reference to the function that adds the gallery amount field to the admin page form.
	 *
	 * @since     1.0.0
	 */
	public function ddata_gallery_amount(){	
		if (isset($this->options['ddata_amount'])){
			echo "<input required='required'  id='ddata_amount' type='number' name='ddata_plugin_options[ddata_amount]' min='1' max='10' value='{$this->options['ddata_amount']}'/>";	
		}else {
			echo "<input required='required' type='number' id='ddata_amount' name='ddata_plugin_options[ddata_amount]' min='1' max='10' value=''/>";
		}
		echo "<button id='update-button' class='button-primary'>Update</button>";
	}
	/**
	 * The reference to the function that add the gallery style field to the admin page.
	 *
	 * @since     1.0.0
	 */
	public function ddata_gallery_style(){
		$items = array('Gallery' , 'Slideshow');
		echo "<select required='required' id='ddata-gallery-style' name='ddata_plugin_options[ddata_gallery_style]'>";
		foreach ($items as $item){
			if ($this->options['ddata_gallery_style'] === $item){
				echo "<option value='$item' selected='selected'>$item</option> ";
			}else{
				echo "<option value='$item'>$item</option> ";
			}
		}
		echo "</select>";
	}
	/**
	 * The reference to the function that adds the gallery fields to the admin page.
	 *
	 * @since     1.0.0
	 */
	public function ddata_gallery($args){
		foreach ($args as $key ){
			$name = $key;
		}
		if(isset($this->options[$name])){
			echo "<input id='{$name}-file' type='file' name='{$name}'/>";
			echo "<img id='img-{$name}' src='{$this->options[$name]}' alt='' class='gallery-thumbnail'/>";
		}else{
			echo "<input id='{$name}-file' type='file' name='{$name}'/>";
		}
	}
	/**
	 * The reference to the function that adds the gallery images link field to the admin page.
	 *
	 * @since     1.0.0
	 */
	public function ddata_link($link_args){
		foreach ($link_args as $key ){
			$name = $key;
		}
		if(isset($this->options[$name])){
			echo "<input id='{$name}-link' type='url' name='ddata_plugin_options[$name]' value='{$this->options[$name]}'/>";
		}else{
			echo "<input id='{$name}-link' type='url' name='ddata_plugin_options[$name]' value=''/>";
		}
	}
	/**
	 * The reference to the function that adds the gallery image height field to the admin page.
	 *
	 * @since     1.0.0
	 */
	public function ddata_gallery_height($height_args){
		foreach ($height_args as $key ){
			$name = $key;
		}
		if(isset($this->options[$name])){
			echo "<input id='{$name}-height' type='number' name='ddata_plugin_options[$name]' min='40' max='400' value='{$this->options[$name]}'/>";
		}else{
			echo "<input id='{$name}-height' type='number' name='ddata_plugin_options[$name]' min='40' max='400'/>";
		}
	}
	/**
	 * The reference to the function that adds the gallery image width field to the admin page.
	 *
	 * @since     1.0.0
	 */
	public function ddata_gallery_width($width_args){
		foreach ($width_args as $key ){
			$name = $key;
		}
		if(isset($this->options[$name])){
			echo "<input id='{$name}-height' type='number' name='ddata_plugin_options[$name]' min='2' max='400' value='{$this->options[$name]}'/>";
		}else{
			echo "<input id='{$name}-height' type='number' name='ddata_plugin_options[$name]' min='2' max='400'/>";
		}
	}
	/**
	 * The reference to the function that adds the gallery selection row field to the admin page.
	 *
	 * @since     1.0.0
	 */
	public function ddata_gallery_selction_rows(){
			if(isset($this->options['ddata_gallery_selection_rows'])){
				echo "<input id='ddata_gallery_row' class='selection-rows' type='number' name='ddata_plugin_options[ddata_gallery_selection_rows]' min='2' max='4' value='{$this->options['ddata_gallery_selection_rows']}'/>" ;
			}else{
				echo "<input id='ddata_gallery_row' class='selection-rows' type='number' name='ddata_plugin_options[ddata_gallery_selection_rows] min='2' max='4' value=''/>" ;
			}
	}
}
?>