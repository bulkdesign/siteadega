<?php
use Fleur\Modules\Header\Lib;

if(!function_exists('fleur_mikado_set_header_object')) {
	function fleur_mikado_set_header_object() {
		$header_type = fleur_mikado_get_meta_field_intersect('header_type', fleur_mikado_get_page_id());

		$object = Lib\HeaderFactory::getInstance()->build($header_type);

		if(Lib\HeaderFactory::getInstance()->validHeaderObject()) {
			$header_connector = new Lib\HeaderConnector($object);
			$header_connector->connect($object->getConnectConfig());
		}
	}

	add_action('wp', 'fleur_mikado_set_header_object', 1);
}