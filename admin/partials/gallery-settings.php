<?php
if (isset($this->options['ddata_amount'])){
	$gallery_fields = $this->options['ddata_amount'];
	$i = 1;
	while ($i <= $gallery_fields){
		$args = array('ddata_gallery' . $i);
		add_settings_field("ddata_gallery-" . $i , 'Gallery Image ' . $i, array($this, 'ddata_gallery'), __FILE__, 'ddata_portfolio', $args);
		$i++;
	}
}
?>