<?php

if(!function_exists('fleur_mikado_load_elements_map')) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function fleur_mikado_load_elements_map() {

		fleur_mikado_add_admin_page(
			array(
				'slug'  => '_elements_page',
				'title' => esc_html__('Elements', 'fleur'),
				'icon'  => 'icon_star_alt '
			)
		);

		do_action('fleur_mikado_options_elements_map');

	}

	add_action('fleur_mikado_options_map', 'fleur_mikado_load_elements_map');

}