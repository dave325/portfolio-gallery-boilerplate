<?php
if (isset($this->options['ddata_amount'])){
	$gallery_fields = $this->options['ddata_amount'];
	$i = 1;
	$gallery = array();
	while ($i <= $gallery_fields){
		$name = 'ddata_gallery' . $i;
		array_push($gallery, $name);
		$i++;
	}
	foreach ($gallery as $key=>$value){
		if(!empty($_FILES[$value]['tmp_name'])){
			$override = array('test_form'=>false);
			$file = wp_handle_upload($_FILES[$value], $override);
			$plugin_options[$value] = $file['url'];
		}else{
			if (empty($this->options[$value])){
				$plugin_options[$value] = '';
			}
			else {
				$plugin_options[$value] = $this->options[$value];
			}
		}
	}
}
?>