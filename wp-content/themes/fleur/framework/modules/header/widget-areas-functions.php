<?php

if(!function_exists('fleur_mikado_register_top_header_areas')) {
	/**
	 * Registers widget areas for top header bar when it is enabled
	 */
	function fleur_mikado_register_top_header_areas() {
		$top_bar_layout = fleur_mikado_options()->getOptionValue('top_bar_layout');

		register_sidebar(array(
			'name'          => esc_html__('Top Bar Left', 'fleur'),
			'id'            => 'mkd-top-bar-left',
			'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget"><div class="mkd-top-bar-widget-inner">',
			'after_widget'  => '</div></div>'
		));

		//register this widget area only if top bar layout is three columns
		if($top_bar_layout === 'three-columns') {
			register_sidebar(array(
				'name'          => esc_html__('Top Bar Center', 'fleur'),
				'id'            => 'mkd-top-bar-center',
				'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget"><div class="mkd-top-bar-widget-inner">',
				'after_widget'  => '</div></div>'
			));
		}

		register_sidebar(array(
			'name'          => esc_html__('Top Bar Right', 'fleur'),
			'id'            => 'mkd-top-bar-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget"><div class="mkd-top-bar-widget-inner">',
			'after_widget'  => '</div></div>'
		));
	}

	add_action('widgets_init', 'fleur_mikado_register_top_header_areas');
}

if(!function_exists('fleur_mikado_header_standard_widget_areas')) {
	/**
	 * Registers widget areas for standard header type
	 */
	function fleur_mikado_header_standard_widget_areas() {
        register_sidebar(array(
            'name'          => esc_html__('Right From Logo', 'fleur'),
            'id'            => 'mkd-right-from-logo',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-logo-widget"><div class="mkd-right-from-logo-widget-inner">',
            'after_widget'  => '</div></div>',
            'description'   => esc_html__('Widgets added here will appear on the right hand side from the logo - Standard Extended header type only', 'fleur')
        ));

        register_sidebar(array(
            'name'          => esc_html__('Right From Main Menu', 'fleur'),
            'id'            => 'mkd-right-from-main-menu',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-main-menu-widget"><div class="mkd-right-from-main-menu-widget-inner">',
            'after_widget'  => '</div></div>',
            'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu', 'fleur')
        ));
	}

	add_action('widgets_init', 'fleur_mikado_header_standard_widget_areas');
}

if(!function_exists('fleur_mikado_header_minimal_widget_areas')) {
	/**
	 * Registers widget areas for standard header type
	 */
	function fleur_mikado_header_minimal_widget_areas() {
		register_sidebar(array(
			'name'          => esc_html__('Minimal Header Area', 'fleur'),
			'id'            => 'mkd-minimal-header-area',
			'before_widget' => '<div id="%1$s" class="widget %2$s mkd-minimal-header-widget"><div class="mkd-minimal-header-widget-inner">',
			'after_widget'  => '</div></div>',
			'description'   => esc_html__('Widgets added here will appear on the left hand side from the menu opener - Minimal Header only', 'fleur')
		));
	}

	add_action('widgets_init', 'fleur_mikado_header_minimal_widget_areas');
}

if(!function_exists('fleur_mikado_header_vertical_widget_areas')) {
	/**
	 * Registers widget areas for vertical header
	 */
	function fleur_mikado_header_vertical_widget_areas() {
        register_sidebar(array(
            'name'          => esc_html__('Vertical Area', 'fleur'),
            'id'            => 'mkd-vertical-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-vertical-area-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the bottom of vertical menu', 'fleur')
        ));
	}

	add_action('widgets_init', 'fleur_mikado_header_vertical_widget_areas');
}

if(!function_exists('fleur_mikado_register_mobile_header_areas')) {
	/**
	 * Registers widget areas for mobile header
	 */
	function fleur_mikado_register_mobile_header_areas() {
		if(fleur_mikado_is_responsive_on()) {
			register_sidebar(array(
				'name'          => esc_html__('Right From Mobile Logo', 'fleur'),
				'id'            => 'mkd-right-from-mobile-logo',
				'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-mobile-logo">',
				'after_widget'  => '</div>',
				'description'   => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'fleur')
			));
		}
	}

	add_action('widgets_init', 'fleur_mikado_register_mobile_header_areas');
}

if(!function_exists('fleur_mikado_register_sticky_header_areas')) {
	/**
	 * Registers widget area for sticky header
	 */
	function fleur_mikado_register_sticky_header_areas() {

        register_sidebar(array(
            'name'          => esc_html__('Sticky Right', 'fleur'),
            'id'            => 'mkd-sticky-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-sticky-right-widget"><div class="mkd-sticky-right-widget-inner">',
            'after_widget'  => '</div></div>',
            'description'   => esc_html__('Widgets added here will appear on the right hand side in sticky menu', 'fleur')
        ));

	}

	add_action('widgets_init', 'fleur_mikado_register_sticky_header_areas');
}