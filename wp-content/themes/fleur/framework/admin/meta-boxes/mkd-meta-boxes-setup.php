<?php

add_action('after_setup_theme', 'fleur_mikado_meta_boxes_map_init', 1);
function fleur_mikado_meta_boxes_map_init() {
	/**
	 * Loades all meta-boxes by going through all folders that are placed directly in meta-boxes folder
	 * and loads map.php file in each.
	 *
	 * @see http://php.net/manual/en/function.glob.php
	 */

	do_action('fleur_mikado_before_meta_boxes_map');

	global $fleur_options;
	global $fleur_Framework;
	global $fleur_options_fontstyle;
	global $fleur_options_fontweight;
	global $fleur_options_texttransform;
	global $fleur_options_fontdecoration;
	global $fleur_options_arrows_type;

	foreach(glob(MIKADO_FRAMEWORK_ROOT_DIR.'/admin/meta-boxes/*/map.php') as $meta_box_load) {
		include_once $meta_box_load;
	}

	do_action('fleur_mikado_meta_boxes_map');

	do_action('fleur_mikado_after_meta_boxes_map');
}