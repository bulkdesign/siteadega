<?php

if(!function_exists('fleur_mikado_register_full_screen_menu_nav')) {
	function fleur_mikado_register_full_screen_menu_nav() {
		register_nav_menus(
			array(
				'popup-navigation' => esc_html__('Fullscreen Navigation', 'fleur')
			)
		);
	}

	add_action('after_setup_theme', 'fleur_mikado_register_full_screen_menu_nav');
}

if(!function_exists('fleur_mikado_register_full_screen_menu_sidebars')) {

	function fleur_mikado_register_full_screen_menu_sidebars() {

		register_sidebar(array(
			'name'          => esc_html__('Fullscreen Menu Top', 'fleur'),
			'id'            => 'fullscreen_menu_above',
			'description'   => esc_html__('This widget area is rendered above fullscreen menu', 'fleur'),
			'before_widget' => '<div class="%2$s mkd-fullscreen-menu-above-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="mkd-fullscreen-widget-title">',
			'after_title'   => '</h4>'
		));

		register_sidebar(array(
			'name'          => esc_html__('Fullscreen Menu Bottom', 'fleur'),
			'id'            => 'fullscreen_menu_below',
			'description'   => esc_html__('This widget area is rendered below fullscreen menu', 'fleur'),
			'before_widget' => '<div class="%2$s mkd-fullscreen-menu-below-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="mkd-fullscreen-widget-title">',
			'after_title'   => '</h4>'
		));

	}

	add_action('widgets_init', 'fleur_mikado_register_full_screen_menu_sidebars');

}

if(!function_exists('fleur_mikado_fullscreen_menu_body_class')) {
	/**
	 * Function that adds body classes for different full screen menu types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function fleur_mikado_fullscreen_menu_body_class($classes) {

        if(fleur_mikado_get_meta_field_intersect('header_type') == 'header-minimal') {

			$classes[] = 'mkd-'.fleur_mikado_options()->getOptionValue('fullscreen_menu_animation_style');

		}

		return $classes;
	}

	add_filter('body_class', 'fleur_mikado_fullscreen_menu_body_class');
}

if(!function_exists('fleur_mikado_get_full_screen_menu')) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function fleur_mikado_get_full_screen_menu() {

		if(fleur_mikado_get_meta_field_intersect('header_type') == 'header-minimal') {
            extract(fleur_mikado_get_fullscreeen_page_options());

			$parameters = array(
				'fullscreen_menu_in_grid' => fleur_mikado_options()->getOptionValue('fullscreen_in_grid') === 'yes' ? true : false,
                'fullscreen_background_image' => $fullscreen_background_image
			);

			fleur_mikado_get_module_template_part('templates/fullscreen-menu', 'fullscreenmenu', '', $parameters);

		}

	}

}

if(!function_exists('fleur_mikado_get_full_screen_menu_navigation')) {
	/**
	 * Loads fullscreen menu navigation HTML template
	 */
	function fleur_mikado_get_full_screen_menu_navigation() {

		fleur_mikado_get_module_template_part('templates/parts/navigation', 'fullscreenmenu');

	}

}

if(!function_exists('fleur_mikado_get_fullscreeen_page_options')) {
    /**
     * Gets options from page
     */
    function fleur_mikado_get_fullscreeen_page_options() {
        $id                                = fleur_mikado_get_page_id();
        $page_options                      = array();
        $fullscreen_background_image       = '';

        if(get_post_meta($id, 'mkd_disable_fullscreen_menu_background_image_meta', true) == 'yes') {
            $fullscreen_background_image = 'background-image:none';
        } elseif(($meta_temp = get_post_meta($id, 'mkd_fullscreen_menu_background_image_meta', true)) !== '') {
            $fullscreen_background_image = 'background-image:url('.$meta_temp.')';
        }

        $page_options['fullscreen_background_image'] = $fullscreen_background_image;

        return $page_options;
    }
}