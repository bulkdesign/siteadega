<?php
if(!function_exists('fleur_mikado_layerslider_overrides')) {
	/**
	 * Disables Layer Slider auto update box
	 */
	function fleur_mikado_layerslider_overrides() {
		$GLOBALS['lsAutoUpdateBox'] = false;
	}

	add_action('layerslider_ready', 'fleur_mikado_layerslider_overrides');
}
?>