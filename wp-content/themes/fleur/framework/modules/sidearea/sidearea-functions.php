<?php
if (!function_exists('fleur_mikado_register_side_area_sidebar')) {
	/**
	 * Register side area sidebar
	 */
	function fleur_mikado_register_side_area_sidebar() {

		register_sidebar(array(
			'name'          => esc_html__('Side Area', 'fleur'),
			'id'            => 'sidearea', //TODO Change name of sidebar
			'description'   => esc_html__('Side Area', 'fleur'),
			'before_widget' => '<div id="%1$s" class="widget mkd-sidearea %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="mkd-sidearea-widget-title">',
			'after_title'   => '</h5>'
		));

	}

	add_action('widgets_init', 'fleur_mikado_register_side_area_sidebar');

}

if (!function_exists('fleur_mikado_side_menu_body_class')) {
	/**
	 * Function that adds body classes for different side menu styles
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function fleur_mikado_side_menu_body_class($classes) {

		if (is_active_widget(false, false, 'mkd_side_area_opener')) {

			if (fleur_mikado_options()->getOptionValue('side_area_type')) {

				$classes[] = 'mkd-' . fleur_mikado_options()->getOptionValue('side_area_type');

				if (fleur_mikado_options()->getOptionValue('side_area_type') === 'side-menu-slide-with-content') {

					$classes[] = 'mkd-' . fleur_mikado_options()->getOptionValue('side_area_slide_with_content_width');

				}

			}

		}

		return $classes;

	}

	add_filter('body_class', 'fleur_mikado_side_menu_body_class');
}


if (!function_exists('fleur_mikado_get_side_area')) {
	/**
	 * Loads side area HTML
	 */
	function fleur_mikado_get_side_area() {

		if (is_active_widget(false, false, 'mkd_side_area_opener')) {

			$parameters = array(
				'show_side_area_title' => fleur_mikado_options()->getOptionValue('side_area_title') !== '' ? true : false,
				//Dont show title if empty
			);

			fleur_mikado_get_module_template_part('templates/sidearea', 'sidearea', '', $parameters);

		}
	}

	add_action('fleur_mikado_action_after_body_tag', 'fleur_mikado_get_side_area', 10);

}

if (!function_exists('fleur_mikado_get_side_area_title')) {
	/**
	 * Loads side area title HTML
	 */
	function fleur_mikado_get_side_area_title() {

		$parameters = array(
			'side_area_title' => fleur_mikado_options()->getOptionValue('side_area_title')
		);

		fleur_mikado_get_module_template_part('templates/parts/title', 'sidearea', '', $parameters);

	}

}

if (!function_exists('fleur_mikado_get_side_menu_icon_html')) {
	/**
	 * Function that outputs html for side area icon opener.
	 * Uses $fleur_IconCollections global variable
	 * @return string generated html
	 */
	function fleur_mikado_get_side_menu_icon_html() {

		$icon_html = '';
		$sidearea_default_opener_enabled = fleur_mikado_options()->getOptionValue('side_area_enable_default_opener') === 'yes';

		if ($sidearea_default_opener_enabled) {
			$icon_html = fleur_mikado_icon_collections()->renderIcon('lnr-menu', 'linear_icons');
		} elseif (fleur_mikado_options()->getOptionValue('side_area_button_icon_pack') !== '') {
			$icon_pack = fleur_mikado_options()->getOptionValue('side_area_button_icon_pack');

			$icons = fleur_mikado_icon_collections()->getIconCollection($icon_pack);
			$icon_options_field = 'side_area_icon_' . $icons->param;

			if (fleur_mikado_options()->getOptionValue($icon_options_field) !== '') {

				$icon = fleur_mikado_options()->getOptionValue($icon_options_field);
				$icon_html = fleur_mikado_icon_collections()->renderIcon($icon, $icon_pack);

			}

		}

		return $icon_html;
	}
}