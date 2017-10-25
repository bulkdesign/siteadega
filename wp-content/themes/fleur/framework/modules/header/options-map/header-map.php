<?php

if (!function_exists('fleur_mikado_header_options_map')) {

	function fleur_mikado_header_options_map() {

		fleur_mikado_add_admin_page(
			array(
				'slug'  => '_header_page',
				'title' => esc_html__('Header', 'fleur'),
				'icon'  => 'icon_folder-open_alt',
			)
		);

		$panel_header = fleur_mikado_add_admin_panel(
			array(
				'page'  => '_header_page',
				'name'  => 'panel_header',
				'title' => esc_html__('Header', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header,
				'type'          => 'radiogroup',
				'name'          => 'header_type',
				'default_value' => 'header-standard',
				'label'         => esc_html__('Choose Header Type', 'fleur'),
				'description'   => esc_html__('Select the type of header you would like to use', 'fleur'),
				'options'       => array(
					'header-standard'          => array(
						'image' => MIKADO_FRAMEWORK_ROOT . '/admin/assets/img/header-standard.png',
						'label' => esc_html__('Standard', 'fleur')
					),
					'header-standard-extended' => array(
						'image' => MIKADO_FRAMEWORK_ROOT . '/admin/assets/img/header-standard-extended.png',
						'label' => esc_html__('Standard Extended', 'fleur')
					),
					'header-box'               => array(
						'image' => MIKADO_FRAMEWORK_ROOT . '/admin/assets/img/header-box.png',
						'label' => esc_html__('In The Box', 'fleur')
					),
					'header-minimal'           => array(
						'image' => MIKADO_FRAMEWORK_ROOT . '/admin/assets/img/header-minimal.png',
						'label' => esc_html__('Minimal', 'fleur')
					),
					'header-divided'           => array(
						'image' => MIKADO_FRAMEWORK_ROOT . '/admin/assets/img/header-divided.png',
						'label' => esc_html__('Divided', 'fleur')
					),
					'header-centered'          => array(
						'image' => MIKADO_FRAMEWORK_ROOT . '/admin/assets/img/header-centered.png',
						'label' => esc_html__('Centered', 'fleur')
					),
					'header-vertical'          => array(
						'image' => MIKADO_FRAMEWORK_ROOT . '/admin/assets/img/header-vertical.png',
						'label' => esc_html__('Vertical', 'fleur')
					)
				),
				'args'          => array(
					'use_images'  => true,
					'hide_labels' => true,
					'dependence'  => true,
					'show'        => array(
						'header-standard'          => '#mkd_panel_header_standard,#mkd_header_behaviour,#mkd_panel_sticky_header,#mkd_panel_main_menu',
						'header-standard-extended' => '#mkd_panel_header_standard_extended,#mkd_header_behaviour,#mkd_panel_sticky_header,#mkd_panel_main_menu',
						'header-box'               => '#mkd_panel_header_box,#mkd_header_behaviour,#mkd_panel_sticky_header,#mkd_panel_main_menu',
						'header-minimal'           => '#mkd_panel_header_minimal,#mkd_header_behaviour,#mkd_panel_fullscreen_menu,#mkd_panel_sticky_header',
						'header-divided'           => '#mkd_panel_header_divided,#mkd_header_behaviour,#mkd_panel_sticky_header,#mkd_panel_main_menu',
						'header-centered'          => '#mkd_panel_header_centered,#mkd_header_behaviour,#mkd_panel_sticky_header,#mkd_panel_main_menu',
						'header-vertical'          => '#mkd_panel_header_vertical,#mkd_panel_vertical_main_menu',
					),
					'hide'        => array(
						'header-standard'          => '#mkd_panel_header_vertical,#mkd_panel_vertical_main_menu,#mkd_panel_header_minimal,#mkd_panel_header_centered,#mkd_panel_fullscreen_menu,#mkd_panel_fixed_header,#mkd_panel_header_divided,#mkd_panel_header_standard_extended,#mkd_panel_header_box',
						'header-standard-extended' => '#mkd_panel_header_vertical,#mkd_panel_vertical_main_menu,#mkd_panel_header_standard,#mkd_panel_header_minimal,#mkd_panel_header_centered,#mkd_panel_fullscreen_menu,#mkd_panel_fixed_header,#mkd_panel_header_divided,#mkd_panel_header_box',
						'header-box'               => '#mkd_panel_header_vertical,#mkd_panel_vertical_main_menu,#mkd_panel_header_standard,#mkd_panel_header_minimal,#mkd_panel_header_centered,#mkd_panel_fullscreen_menu,#mkd_panel_fixed_header,#mkd_panel_header_divided,#mkd_panel_header_standard_extended',
						'header-minimal'           => '#mkd_panel_header_standard,#mkd_panel_main_menu,#mkd_panel_header_vertical,#mkd_panel_fixed_header,#mkd_panel_header_divided,#mkd_panel_header_centered,#mkd_panel_header_standard_extended,#mkd_panel_header_box',
						'header-divided'           => '#mkd_panel_header_standard,#mkd_panel_header_minimal,#mkd_panel_header_centered,#mkd_panel_header_vertical,#mkd_panel_vertical_main_menu,#mkd_panel_fullscreen_menu,#mkd_panel_fixed_header,#mkd_panel_header_standard_extended,#mkd_panel_header_box',
						'header-centered'          => '#mkd_panel_header_standard,#mkd_panel_header_minimal,#mkd_panel_header_divided,#mkd_panel_header_vertical,#mkd_panel_vertical_main_menu,#mkd_panel_fullscreen_menu,#mkd_panel_fixed_header,#mkd_panel_header_standard_extended,#mkd_panel_header_box',
						'header-vertical'          => '#mkd_panel_header_standard,#mkd_header_behaviour,#mkd_panel_fixed_header,#mkd_panel_sticky_header,#mkd_panel_main_menu,#mkd_panel_header_minimal,#mkd_panel_header_centered,#mkd_panel_fullscreen_menu,#mkd_panel_header_divided,#mkd_panel_header_standard_extended,#mkd_panel_header_box',
					)
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'          => $panel_header,
				'type'            => 'select',
				'name'            => 'header_behaviour',
				'default_value'   => 'sticky-header-on-scroll-up',
				'label'           => esc_html__('Choose Header behaviour', 'fleur'),
				'description'     => esc_html__('Select the behaviour of header when you scroll down to page', 'fleur'),
				'options'         => array(
					'no-behavior'                     => esc_html__('No Behavior', 'fleur'),
					'sticky-header-on-scroll-up'      => esc_html__('Sticky on scrol up', 'fleur'),
					'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scrol up/down', 'fleur'),
					'fixed-on-scroll'                 => esc_html__('Fixed on scroll', 'fleur')
				),
				'hidden_property' => 'header_type',
				'hidden_value'    => '',
				'hidden_values'   => array('header-vertical'),
				'args'            => array(
					'dependence' => true,
					'show'       => array(
						'sticky-header-on-scroll-up'      => '#mkd_panel_sticky_header',
						'sticky-header-on-scroll-down-up' => '#mkd_panel_sticky_header',
						'fixed-on-scroll'                 => '',
					),
					'hide'       => array(
						'sticky-header-on-scroll-up'      => '#mkd_panel_fixed_header',
						'sticky-header-on-scroll-down-up' => '#mkd_panel_fixed_header',
						'no-behavior'                     => '#mkd_panel_fixed_header, #mkd_panel_fixed_header, #mkd_panel_sticky_header',
						'fixed-on-scroll'                 => '#mkd_panel_sticky_header',
					)
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'name'          => 'top_bar',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Top Bar', 'fleur'),
				'description'   => esc_html__('Enabling this option will show top bar area', 'fleur'),
				'parent'        => $panel_header,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkd_top_bar_container"
				)
			)
		);

		$top_bar_container = fleur_mikado_add_admin_container(array(
			'name'            => 'top_bar_container',
			'parent'          => $panel_header,
			'hidden_property' => 'top_bar',
			'hidden_value'    => 'no'
		));

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $top_bar_container,
				'type'          => 'select',
				'name'          => 'top_bar_layout',
				'default_value' => 'three-columns',
				'label'         => esc_html__('Choose top bar layout', 'fleur'),
				'description'   => esc_html__('Select the layout for top bar', 'fleur'),
				'options'       => array(
					'two-columns'   => esc_html__('Two columns', 'fleur'),
					'three-columns' => esc_html__('Three columns', 'fleur')
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'two-columns'   => '#mkd_top_bar_layout_container',
						'three-columns' => '#mkd_top_bar_two_columns_layout_container'
					),
					'show'       => array(
						'two-columns'   => '#mkd_top_bar_two_columns_layout_container',
						'three-columns' => '#mkd_top_bar_layout_container'
					)
				)
			)
		);

		$top_bar_layout_container = fleur_mikado_add_admin_container(array(
			'name'            => 'top_bar_layout_container',
			'parent'          => $top_bar_container,
			'hidden_property' => 'top_bar_layout',
			'hidden_value'    => '',
			'hidden_values'   => array('two-columns'),
		));

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $top_bar_layout_container,
				'type'          => 'select',
				'name'          => 'top_bar_column_widths',
				'default_value' => '30-30-30',
				'label'         => esc_html__('Choose column widths', 'fleur'),
				'description'   => '',
				'options'       => array(
					'30-30-30' => '33% - 33% - 33%',
					'25-50-25' => '25% - 50% - 25%'
				)
			)
		);

		$top_bar_two_columns_layout = fleur_mikado_add_admin_container(array(
			'name'            => 'top_bar_two_columns_layout_container',
			'parent'          => $top_bar_container,
			'hidden_property' => 'top_bar_layout',
			'hidden_value'    => '',
			'hidden_values'   => array('three-columns'),
		));

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $top_bar_two_columns_layout,
				'type'          => 'select',
				'name'          => 'top_bar_two_column_widths',
				'default_value' => '50-50',
				'label'         => esc_html__('Choose column widths', 'fleur'),
				'description'   => '',
				'options'       => array(
					'50-50' => '50% - 50%',
					'33-66' => '33% - 66%',
					'66-33' => '66% - 33%'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'name'          => 'top_bar_in_grid',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Top Bar in grid', 'fleur'),
				'description'   => esc_html__('Set top bar content to be in grid', 'fleur'),
				'parent'        => $top_bar_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkd_top_bar_in_grid_container"
				)
			)
		);

		$top_bar_in_grid_container = fleur_mikado_add_admin_container(array(
			'name'            => 'top_bar_in_grid_container',
			'parent'          => $top_bar_container,
			'hidden_property' => 'top_bar_in_grid',
			'hidden_value'    => 'no'
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'top_bar_grid_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Grid Background Color', 'fleur'),
			'description' => esc_html__('Set grid background color for top bar', 'fleur'),
			'parent'      => $top_bar_in_grid_container
		));


		fleur_mikado_add_admin_field(array(
			'name'        => 'top_bar_grid_background_transparency',
			'type'        => 'text',
			'label'       => esc_html__('Grid Background Transparency', 'fleur'),
			'description' => esc_html__('Set grid background transparency for top bar', 'fleur'),
			'parent'      => $top_bar_in_grid_container,
			'args'        => array('col_width' => 3)
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'top_bar_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Background Color', 'fleur'),
			'description' => esc_html__('Set background color for top bar', 'fleur'),
			'parent'      => $top_bar_container
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'top_bar_background_transparency',
			'type'        => 'text',
			'label'       => esc_html__('Background Transparency', 'fleur'),
			'description' => esc_html__('Set background transparency for top bar', 'fleur'),
			'parent'      => $top_bar_container,
			'args'        => array('col_width' => 3)
		));

		fleur_mikado_add_admin_field(
			array(
				'name'          => 'top_bar_border',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Top Bar Border', 'fleur'),
				'description'   => esc_html__('Set top bar border', 'fleur'),
				'parent'        => $top_bar_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkd_top_bar_border_container"
				)
			)
		);

		$top_bar_border_container = fleur_mikado_add_admin_container(array(
			'name'            => 'top_bar_border_container',
			'parent'          => $top_bar_container,
			'hidden_property' => 'top_bar_border',
			'hidden_value'    => 'no'
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'top_bar_border_color',
			'type'        => 'color',
			'label'       => esc_html__('Top Bar Border', 'fleur'),
			'description' => esc_html__('Set border color for top bar', 'fleur'),
			'parent'      => $top_bar_border_container
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'top_bar_height',
			'type'        => 'text',
			'label'       => esc_html__('Top bar height', 'fleur'),
			'description' => esc_html__('Enter top bar height (Default is 37px)', 'fleur'),
			'parent'      => $top_bar_container,
			'args'        => array(
				'col_width' => 2,
				'suffix'    => 'px'
			)
		));

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header,
				'type'          => 'select',
				'name'          => 'header_style',
				'default_value' => '',
				'label'         => esc_html__('Header Skin', 'fleur'),
				'description'   => esc_html__('Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'fleur'),
				'options'       => array(
					''             => '',
					'light-header' => esc_html__('Light', 'fleur'),
					'dark-header'  => esc_html__('Dark', 'fleur')
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header,
				'type'          => 'yesno',
				'name'          => 'enable_header_style_on_scroll',
				'default_value' => 'no',
				'label'         => esc_html__('Enable Header Style on Scroll', 'fleur'),
				'description'   => esc_html__('Enabling this option, header will change style depending on row settings for dark/light style', 'fleur'),
			)
		);

		$panel_header_standard = fleur_mikado_add_admin_panel(
			array(
				'page'            => '_header_page',
				'name'            => 'panel_header_standard',
				'title'           => esc_html__('Header Standard', 'fleur'),
				'hidden_property' => 'header_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'header-standard-extended',
					'header-box',
					'header-vertical',
					'header-minimal',
					'header-centered',
					'header-divided'
				)
			)
		);

		fleur_mikado_add_admin_section_title(
			array(
				'parent' => $panel_header_standard,
				'name'   => 'menu_area_title',
				'title'  => esc_html__('Menu Area', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard,
				'type'          => 'select',
				'default_value' => 'center',
				'name'          => 'menu_area_position_header_standard',
				'options'       => array(
					'center' => esc_html__('Center', 'fleur'),
					'left'   => esc_html__('Left', 'fleur'),
					'right'  => esc_html__('Right', 'fleur')
				),
				'label'         => esc_html__('Menu Area position', 'fleur'),
				'description'   => esc_html__('Set menu area position', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_header_standard',
				'default_value' => 'yes',
				'label'         => esc_html__('Header In Grid', 'fleur'),
				'description'   => esc_html__('Set header content to be in grid', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_in_grid_header_standard_container'
				)
			)
		);

		$menu_area_in_grid_header_standard_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_standard,
				'name'            => 'menu_area_in_grid_header_standard_container',
				'hidden_property' => 'menu_area_in_grid_header_standard',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_standard_container,
				'type'          => 'color',
				'name'          => 'menu_area_grid_background_color_header_standard',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Color', 'fleur'),
				'description'   => esc_html__('Set grid background color for header area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_standard_container,
				'type'          => 'text',
				'name'          => 'menu_area_grid_background_transparency_header_standard',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Transparency', 'fleur'),
				'description'   => esc_html__('Set grid background transparency for header', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_standard_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_border_header_standard',
				'default_value' => 'no',
				'label'         => esc_html__('Grid Area Border', 'fleur'),
				'description'   => esc_html__('Set border on grid area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_in_grid_border_header_standard_container'
				)
			)
		);

		$menu_area_in_grid_border_header_standard_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_in_grid_header_standard_container,
				'name'            => 'menu_area_in_grid_border_header_standard_container',
				'hidden_property' => 'menu_area_in_grid_border_header_standard',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_border_header_standard_container,
				'type'          => 'color',
				'name'          => 'menu_area_in_grid_border_color_header_standard',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for grid area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard,
				'type'          => 'color',
				'name'          => 'menu_area_background_color_header_standard',
				'default_value' => '',
				'label'         => esc_html__('Background color', 'fleur'),
				'description'   => esc_html__('Set background color for header', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard,
				'type'          => 'text',
				'name'          => 'menu_area_background_transparency_header_standard',
				'default_value' => '',
				'label'         => esc_html__('Background transparency', 'fleur'),
				'description'   => esc_html__('Set background transparency for header', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard,
				'type'          => 'yesno',
				'name'          => 'menu_area_border_header_standard',
				'default_value' => 'yes',
				'label'         => esc_html__('Header Area Border', 'fleur'),
				'description'   => esc_html__('Set border on header area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_border_header_standard_container'
				)
			)
		);

		$menu_area_border_header_standard_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_standard,
				'name'            => 'menu_area_border_header_standard_container',
				'hidden_property' => 'menu_area_border_header_standard',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_border_header_standard_container,
				'type'          => 'color',
				'name'          => 'menu_area_border_color_header_standard',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for header area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard,
				'type'          => 'text',
				'name'          => 'menu_area_height_header_standard',
				'default_value' => '',
				'label'         => esc_html__('Height', 'fleur'),
				'description'   => esc_html__('Enter header height (default is 82px)', 'fleur'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		$panel_header_minimal = fleur_mikado_add_admin_panel(
			array(
				'page'            => '_header_page',
				'name'            => 'panel_header_minimal',
				'title'           => esc_html__('Header Minimal', 'fleur'),
				'hidden_property' => 'header_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'header-vertical',
					'header-standard',
					'header-standard-extended',
					'header-box',
					'header-centered',
					'header-divided',
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_minimal,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_header_minimal',
				'default_value' => 'no',
				'label'         => esc_html__('Header In Grid', 'fleur'),
				'description'   => esc_html__('Set header content to be in grid', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_in_grid_header_minimal_container'
				)
			)
		);

		$menu_area_in_grid_header_minimal_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_minimal,
				'name'            => 'menu_area_in_grid_header_minimal_container',
				'hidden_property' => 'menu_area_in_grid_header_minimal',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_minimal_container,
				'type'          => 'color',
				'name'          => 'menu_area_grid_background_color_header_minimal',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Color', 'fleur'),
				'description'   => esc_html__('Set grid background color for header area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_minimal_container,
				'type'          => 'text',
				'name'          => 'menu_area_grid_background_transparency_header_minimal',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Transparency', 'fleur'),
				'description'   => esc_html__('Set grid background transparency for header', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_minimal_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_border_header_minimal',
				'default_value' => 'no',
				'label'         => esc_html__('Grid Area Border', 'fleur'),
				'description'   => esc_html__('Set border on grid area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_in_grid_border_header_minimal_container'
				)
			)
		);

		$menu_area_in_grid_border_header_minimal_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_in_grid_header_minimal_container,
				'name'            => 'menu_area_in_grid_border_header_minimal_container',
				'hidden_property' => 'menu_area_in_grid_border_header_minimal',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_border_header_minimal_container,
				'type'          => 'color',
				'name'          => 'menu_area_in_grid_border_color_header_minimal',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for grid area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_minimal,
				'type'          => 'color',
				'name'          => 'menu_area_background_color_header_minimal',
				'default_value' => '',
				'label'         => esc_html__('Background color', 'fleur'),
				'description'   => esc_html__('Set background color for header', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_minimal,
				'type'          => 'text',
				'name'          => 'menu_area_background_transparency_header_minimal',
				'default_value' => '',
				'label'         => esc_html__('Background transparency', 'fleur'),
				'description'   => esc_html__('Set background transparency for header', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_minimal,
				'type'          => 'yesno',
				'name'          => 'menu_area_border_header_minimal',
				'default_value' => 'no',
				'label'         => esc_html__('Header Area Border', 'fleur'),
				'description'   => esc_html__('Set border on header area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_border_header_minimal_container'
				)
			)
		);

		$menu_area_border_header_minimal_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_minimal,
				'name'            => 'menu_area_border_header_minimal_container',
				'hidden_property' => 'menu_area_border_header_minimal',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_border_header_minimal_container,
				'type'          => 'color',
				'name'          => 'menu_area_border_color_header_minimal',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for header area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_minimal,
				'type'          => 'text',
				'name'          => 'menu_area_height_header_minimal',
				'default_value' => '',
				'label'         => esc_html__('Height', 'fleur'),
				'description'   => esc_html__('Enter header height (default is 82px)', 'fleur'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		do_action('fleur_mikado_header_options_map');

		/***************** Divided Header Layout *******************/

		$panel_header_divided = fleur_mikado_add_admin_panel(
			array(
				'page'            => '_header_page',
				'name'            => 'panel_header_divided',
				'title'           => esc_html__('Header Divided', 'fleur'),
				'hidden_property' => 'header_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'header-standard',
					'header-standard-extended',
					'header-box',
					'header-minimal',
					'header-centered',
					'header-vertical'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_divided,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_header_divided',
				'default_value' => 'no',
				'label'         => esc_html__('Header In Grid', 'fleur'),
				'description'   => esc_html__('Set header content to be in grid', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_in_grid_header_divided_container'
				)
			)
		);

		$menu_area_in_grid_header_divided_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_divided,
				'name'            => 'menu_area_in_grid_header_divided_container',
				'hidden_property' => 'menu_area_in_grid_header_divided',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_divided_container,
				'type'          => 'color',
				'name'          => 'menu_area_grid_background_color_header_divided',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Color', 'fleur'),
				'description'   => esc_html__('Set grid background color for header area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_divided_container,
				'type'          => 'text',
				'name'          => 'menu_area_grid_background_transparency_header_divided',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Transparency', 'fleur'),
				'description'   => esc_html__('Set grid background transparency for header', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_divided_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_border_header_divided',
				'default_value' => 'no',
				'label'         => esc_html__('Grid Area Border', 'fleur'),
				'description'   => esc_html__('Set border on grid area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_in_grid_border_header_divided_container'
				)
			)
		);

		$menu_area_in_grid_border_header_divided_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_in_grid_header_divided_container,
				'name'            => 'menu_area_in_grid_border_header_divided_container',
				'hidden_property' => 'menu_area_in_grid_border_header_divided',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_border_header_divided_container,
				'type'          => 'color',
				'name'          => 'menu_area_in_grid_border_color_header_divided',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for grid area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_divided,
				'type'          => 'color',
				'name'          => 'menu_area_background_color_header_divided',
				'default_value' => '',
				'label'         => esc_html__('Background Color', 'fleur'),
				'description'   => esc_html__('Set background color for header', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_divided,
				'type'          => 'text',
				'name'          => 'menu_area_background_transparency_header_divided',
				'default_value' => '',
				'label'         => esc_html__('Background Transparency', 'fleur'),
				'description'   => esc_html__('Set background transparency for header', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);


		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_divided,
				'type'          => 'yesno',
				'name'          => 'menu_area_border_header_divided',
				'default_value' => 'no',
				'label'         => esc_html__('Header Area Border', 'fleur'),
				'description'   => esc_html__('Set border on header area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_border_header_divided_container'
				)
			)
		);

		$menu_area_border_header_divided_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_divided,
				'name'            => 'menu_area_border_header_divided_container',
				'hidden_property' => 'menu_area_border_header_divided',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_border_header_divided_container,
				'type'          => 'color',
				'name'          => 'menu_area_border_color_header_divided',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for header', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_divided,
				'type'          => 'text',
				'name'          => 'menu_area_height_header_divided',
				'default_value' => '',
				'label'         => esc_html__('Height', 'fleur'),
				'description'   => esc_html__('Enter Header Height (default is 82px)', 'fleur'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		/***************** Divided Header Layout - end *******************/

		/***************** Centered Header Layout - start ****************/

		$panel_header_centered = fleur_mikado_add_admin_panel(
			array(
				'page'            => '_header_page',
				'name'            => 'panel_header_centered',
				'title'           => esc_html__('Header Centered', 'fleur'),
				'hidden_property' => 'header_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'header-vertical',
					'header-standard',
					'header-standard-extended',
					'header-box',
					'header-minimal',
					'header-divided',
				)
			)
		);

		fleur_mikado_add_admin_section_title(
			array(
				'parent' => $panel_header_centered,
				'name'   => 'logo_menu_area_title',
				'title'  => esc_html__('Logo Area', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_centered,
				'type'          => 'yesno',
				'name'          => 'logo_area_in_grid_header_centered',
				'default_value' => 'no',
				'label'         => esc_html__('Logo Area In Grid', 'fleur'),
				'description'   => esc_html__('Set menu area content to be in grid', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_logo_area_in_grid_header_centered_container'
				)
			)
		);

		$logo_area_in_grid_header_centered_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_centered,
				'name'            => 'logo_area_in_grid_header_centered_container',
				'hidden_property' => 'logo_area_in_grid_header_centered',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_header_centered_container,
				'type'          => 'color',
				'name'          => 'logo_area_grid_background_color_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Color', 'fleur'),
				'description'   => esc_html__('Set grid background color for logo area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_header_centered_container,
				'type'          => 'text',
				'name'          => 'logo_area_grid_background_transparency_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Transparency', 'fleur'),
				'description'   => esc_html__('Set grid background transparency', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_header_centered_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_in_grid_border_header_centered',
				'default_value' => 'no',
				'label'         => esc_html__('Grid Area Border', 'fleur'),
				'description'   => esc_html__('Set border on grid area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_logo_area_in_grid_border_header_centered_container'
				)
			)
		);

		$logo_area_in_grid_border_header_centered_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $logo_area_in_grid_header_centered_container,
				'name'            => 'logo_area_in_grid_border_header_centered_container',
				'hidden_property' => 'logo_area_in_grid_border_header_centered',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_border_header_centered_container,
				'type'          => 'color',
				'name'          => 'logo_area_in_grid_border_color_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for grid area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_centered,
				'type'          => 'color',
				'name'          => 'logo_area_background_color_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Background color', 'fleur'),
				'description'   => esc_html__('Set background color for logo area', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_centered,
				'type'          => 'text',
				'name'          => 'logo_area_background_transparency_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Background transparency', 'fleur'),
				'description'   => esc_html__('Set background transparency for logo area', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_centered,
				'type'          => 'yesno',
				'name'          => 'logo_area_border_header_centered',
				'default_value' => 'no',
				'label'         => esc_html__('Logo Area Border', 'fleur'),
				'description'   => esc_html__('Set border on logo area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_logo_area_border_header_centered_container'
				)
			)
		);

		$logo_area_border_header_centered_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_centered,
				'name'            => 'logo_area_border_header_centered_container',
				'hidden_property' => 'logo_area_border_header_centered',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_border_header_centered_container,
				'type'          => 'color',
				'name'          => 'logo_area_border_color_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for logo area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_centered,
				'type'          => 'text',
				'name'          => 'logo_wrapper_padding_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Logo Padding', 'fleur'),
				'description'   => esc_html__('Insert padding in format: 0px 0px 1px 0px', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_centered,
				'type'          => 'text',
				'name'          => 'logo_area_height_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Height', 'fleur'),
				'description'   => esc_html__('Enter logo area height (default is 155px)', 'fleur'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);


		fleur_mikado_add_admin_section_title(
			array(
				'parent' => $panel_header_centered,
				'name'   => 'main_menu_area_title',
				'title'  => esc_html__('Menu Area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_centered,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_header_centered',
				'default_value' => 'no',
				'label'         => esc_html__('Menu Area In Grid', 'fleur'),
				'description'   => esc_html__('Set menu area content to be in grid', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_in_grid_header_centered_container'
				)
			)
		);

		$menu_area_in_grid_header_centered_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_centered,
				'name'            => 'menu_area_in_grid_header_centered_container',
				'hidden_property' => 'menu_area_in_grid_header_centered',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_centered_container,
				'type'          => 'color',
				'name'          => 'menu_area_grid_background_color_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Color', 'fleur'),
				'description'   => esc_html__('Set grid background color for menu area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_centered_container,
				'type'          => 'text',
				'name'          => 'menu_area_grid_background_transparency_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Transparency', 'fleur'),
				'description'   => esc_html__('Set grid background transparency', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_centered_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_border_header_centered',
				'default_value' => 'no',
				'label'         => esc_html__('Grid Area Border', 'fleur'),
				'description'   => esc_html__('Set border on grid area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_in_grid_border_header_centered_container'
				)
			)
		);

		$menu_area_in_grid_border_header_centered_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_in_grid_header_centered_container,
				'name'            => 'menu_area_in_grid_border_header_centered_container',
				'hidden_property' => 'menu_area_in_grid_border_header_centered',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_border_header_centered_container,
				'type'          => 'color',
				'name'          => 'menu_area_in_grid_border_color_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for grid area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_centered,
				'type'          => 'color',
				'name'          => 'menu_area_background_color_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Background color', 'fleur'),
				'description'   => esc_html__('Set background color for menu area', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_centered,
				'type'          => 'text',
				'name'          => 'menu_area_background_transparency_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Background transparency', 'fleur'),
				'description'   => esc_html__('Set background transparency for menu area', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_centered,
				'type'          => 'yesno',
				'name'          => 'menu_area_border_header_centered',
				'default_value' => 'no',
				'label'         => esc_html__('Menu Area Border', 'fleur'),
				'description'   => esc_html__('Set border on menu area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_border_header_centered_container'
				)
			)
		);

		$menu_area_border_header_centered_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_centered,
				'name'            => 'menu_area_border_header_centered_container',
				'hidden_property' => 'menu_area_border_header_centered',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_border_header_centered_container,
				'type'          => 'color',
				'name'          => 'menu_area_border_color_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for header area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_centered,
				'type'          => 'text',
				'name'          => 'menu_area_height_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Height', 'fleur'),
				'description'   => esc_html__('Enter menu area height (default is 82px)', 'fleur'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		/***************** Centered Header Layout - end ****************/


		/***************** Standard Extended Header Layout - start ****************/

		$panel_header_standard_extended = fleur_mikado_add_admin_panel(
			array(
				'page'            => '_header_page',
				'name'            => 'panel_header_standard_extended',
				'title'           => esc_html__('Header Standard Extended', 'fleur'),
				'hidden_property' => 'header_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'header-vertical',
					'header-standard',
					'header-box',
					'header-minimal',
					'header-divided',
					'header-centered'
				)
			)
		);

		fleur_mikado_add_admin_section_title(
			array(
				'parent' => $panel_header_standard_extended,
				'name'   => 'logo_menu_area_title',
				'title'  => esc_html__('Logo Area', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard_extended,
				'type'          => 'yesno',
				'name'          => 'logo_area_in_grid_header_standard_extended',
				'default_value' => 'yes',
				'label'         => esc_html__('Logo Area In Grid', 'fleur'),
				'description'   => esc_html__('Set menu area content to be in grid', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_logo_area_in_grid_header_standard_extended_container'
				)
			)
		);

		$logo_area_in_grid_header_standard_extended_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_standard_extended,
				'name'            => 'logo_area_in_grid_header_standard_extended_container',
				'hidden_property' => 'logo_area_in_grid_header_standard_extended',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_header_standard_extended_container,
				'type'          => 'color',
				'name'          => 'logo_area_grid_background_color_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Color', 'fleur'),
				'description'   => esc_html__('Set grid background color for logo area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_header_standard_extended_container,
				'type'          => 'text',
				'name'          => 'logo_area_grid_background_transparency_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Transparency', 'fleur'),
				'description'   => esc_html__('Set grid background transparency', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_header_standard_extended_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_in_grid_border_header_standard_extended',
				'default_value' => 'no',
				'label'         => esc_html__('Grid Area Border', 'fleur'),
				'description'   => esc_html__('Set border on grid area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_logo_area_in_grid_border_header_standard_extended_container'
				)
			)
		);

		$logo_area_in_grid_border_header_standard_extended_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $logo_area_in_grid_header_standard_extended_container,
				'name'            => 'logo_area_in_grid_border_header_standard_extended_container',
				'hidden_property' => 'logo_area_in_grid_border_header_standard_extended',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_border_header_standard_extended_container,
				'type'          => 'color',
				'name'          => 'logo_area_in_grid_border_color_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for grid area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard_extended,
				'type'          => 'color',
				'name'          => 'logo_area_background_color_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Background color', 'fleur'),
				'description'   => esc_html__('Set background color for logo area', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard_extended,
				'type'          => 'text',
				'name'          => 'logo_area_background_transparency_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Background transparency', 'fleur'),
				'description'   => esc_html__('Set background transparency for logo area', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard_extended,
				'type'          => 'yesno',
				'name'          => 'logo_area_border_header_standard_extended',
				'default_value' => 'no',
				'label'         => esc_html__('Logo Area Border', 'fleur'),
				'description'   => esc_html__('Set border on logo area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_logo_area_border_header_standard_extended_container'
				)
			)
		);

		$logo_area_border_header_standard_extended_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_standard_extended,
				'name'            => 'logo_area_border_header_standard_extended_container',
				'hidden_property' => 'logo_area_border_header_standard_extended',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $logo_area_border_header_standard_extended_container,
				'type'          => 'color',
				'name'          => 'logo_area_border_color_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for logo area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard_extended,
				'type'          => 'text',
				'name'          => 'logo_area_height_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Height', 'fleur'),
				'description'   => esc_html__('Enter logo area height (default is 90px)', 'fleur'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);


		fleur_mikado_add_admin_section_title(
			array(
				'parent' => $panel_header_standard_extended,
				'name'   => 'main_menu_area_title',
				'title'  => esc_html__('Menu Area', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard_extended,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_header_standard_extended',
				'default_value' => 'yes',
				'label'         => esc_html__('Menu Area In Grid', 'fleur'),
				'description'   => esc_html__('Set menu area content to be in grid', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_in_grid_header_standard_extended_container'
				)
			)
		);

		$menu_area_in_grid_header_standard_extended_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_standard_extended,
				'name'            => 'menu_area_in_grid_header_standard_extended_container',
				'hidden_property' => 'menu_area_in_grid_header_standard_extended',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_standard_extended_container,
				'type'          => 'color',
				'name'          => 'menu_area_grid_background_color_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Color', 'fleur'),
				'description'   => esc_html__('Set grid background color for menu area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_standard_extended_container,
				'type'          => 'text',
				'name'          => 'menu_area_grid_background_transparency_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Grid Background Transparency', 'fleur'),
				'description'   => esc_html__('Set grid background transparency', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_header_standard_extended_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_border_header_standard_extended',
				'default_value' => 'no',
				'label'         => esc_html__('Grid Area Border', 'fleur'),
				'description'   => esc_html__('Set border on grid area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_in_grid_border_header_standard_extended_container'
				)
			)
		);

		$menu_area_in_grid_border_header_standard_extended_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_in_grid_header_standard_extended_container,
				'name'            => 'menu_area_in_grid_border_header_standard_extended_container',
				'hidden_property' => 'menu_area_in_grid_border_header_standard_extended',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_border_header_standard_extended_container,
				'type'          => 'color',
				'name'          => 'menu_area_in_grid_border_color_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for grid area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard_extended,
				'type'          => 'color',
				'name'          => 'menu_area_background_color_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Background color', 'fleur'),
				'description'   => esc_html__('Set background color for menu area', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard_extended,
				'type'          => 'text',
				'name'          => 'menu_area_background_transparency_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Background transparency', 'fleur'),
				'description'   => esc_html__('Set background transparency for menu area', 'fleur'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard_extended,
				'type'          => 'yesno',
				'name'          => 'menu_area_border_header_standard_extended',
				'default_value' => 'no',
				'label'         => esc_html__('Menu Area Border', 'fleur'),
				'description'   => esc_html__('Set border on menu area', 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_menu_area_border_header_standard_extended_container'
				)
			)
		);

		$menu_area_border_header_standard_extended_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_header_standard_extended,
				'name'            => 'menu_area_border_header_standard_extended_container',
				'hidden_property' => 'menu_area_border_header_standard_extended',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_border_header_standard_extended_container,
				'type'          => 'color',
				'name'          => 'menu_area_border_color_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
				'description'   => esc_html__('Set border color for header area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_standard_extended,
				'type'          => 'text',
				'name'          => 'menu_area_height_header_standard_extended',
				'default_value' => '',
				'label'         => esc_html__('Height', 'fleur'),
				'description'   => esc_html__('Enter menu area height (default is 75px)', 'fleur'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		/***************** Standard Extended Header Layout - end ****************/

		/***************** In The Box Header Layout - start ****************/

		$panel_header_box = fleur_mikado_add_admin_panel(
			array(
				'page'            => '_header_page',
				'name'            => 'panel_header_box',
				'title'           => esc_html__('Header "In The Box"', 'fleur'),
				'hidden_property' => 'header_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'header-standard',
					'header-standard-extended',
					'header-vertical',
					'header-minimal',
					'header-centered',
					'header-divided'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_box,
				'type'          => 'color',
				'name'          => 'menu_area_grid_background_color_header_box',
				'default_value' => '',
				'label'         => esc_html__('Background Color', 'fleur'),
				'description'   => esc_html__('Set grid background color for header area', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_header_box,
				'type'          => 'text',
				'name'          => 'menu_area_height_header_box',
				'default_value' => '',
				'label'         => esc_html__('Height', 'fleur'),
				'description'   => esc_html__('Enter header height (default is 85px)', 'fleur'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		/***************** In The Box Header Layout - end ****************/

		$panel_header_vertical = fleur_mikado_add_admin_panel(
			array(
				'page'            => '_header_page',
				'name'            => 'panel_header_vertical',
				'title'           => esc_html__('Header Vertical', 'fleur'),
				'hidden_property' => 'header_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'header-standard',
					'header-standard-extended',
					'header-box',
					'header-minimal',
					'header-centered',
					'header-divided'
				)
			)
		);

		fleur_mikado_add_admin_field(array(
			'name'        => 'vertical_header_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Background Color', 'fleur'),
			'description' => esc_html__('Set background color for vertical menu', 'fleur'),
			'parent'      => $panel_header_vertical
		));

		fleur_mikado_add_admin_field(
			array(
				'name'          => 'vertical_header_background_image',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__('Background Image', 'fleur'),
				'description'   => esc_html__('Set background image for vertical menu', 'fleur'),
				'parent'        => $panel_header_vertical
			)
		);

		$panel_sticky_header = fleur_mikado_add_admin_panel(
			array(
				'title'           => esc_html__('Sticky Header', 'fleur'),
				'name'            => 'panel_sticky_header',
				'page'            => '_header_page',
				'hidden_property' => 'header_behaviour',
				'hidden_values'   => array(
					'no-behavior',
					'fixed-on-scroll'

				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'name'        => 'scroll_amount_for_sticky',
				'type'        => 'text',
				'label'       => esc_html__('Scroll Amount for Sticky', 'fleur'),
				'description' => esc_html__('Enter scroll amount for Sticky Menu to appear (deafult is header height)', 'fleur'),
				'parent'      => $panel_sticky_header,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'name'          => 'sticky_header_in_grid',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Sticky Header in grid', 'fleur'),
				'description'   => esc_html__('Set sticky header content to be in grid', 'fleur'),
				'parent'        => $panel_sticky_header,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkd_sticky_header_in_grid_container"
				)
			)
		);

		$sticky_header_in_grid_container = fleur_mikado_add_admin_container(array(
			'name'            => 'sticky_header_in_grid_container',
			'parent'          => $panel_sticky_header,
			'hidden_property' => 'sticky_header_in_grid',
			'hidden_value'    => 'no'
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'sticky_header_grid_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Grid Background Color', 'fleur'),
			'description' => esc_html__('Set grid background color for sticky header', 'fleur'),
			'parent'      => $sticky_header_in_grid_container
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'sticky_header_grid_transparency',
			'type'        => 'text',
			'label'       => esc_html__('Sticky Header Grid Transparency', 'fleur'),
			'description' => esc_html__('Enter transparency for sticky header grid (value from 0 to 1)', 'fleur'),
			'parent'      => $sticky_header_in_grid_container,
			'args'        => array(
				'col_width' => 1
			)
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'sticky_header_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Background Color', 'fleur'),
			'description' => esc_html__('Set background color for sticky header', 'fleur'),
			'parent'      => $panel_sticky_header
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'sticky_header_transparency',
			'type'        => 'text',
			'label'       => esc_html__('Sticky Header Transparency', 'fleur'),
			'description' => esc_html__('Enter transparency for sticky header (value from 0 to 1)', 'fleur'),
			'parent'      => $panel_sticky_header,
			'args'        => array(
				'col_width' => 1
			)
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'sticky_header_height',
			'type'        => 'text',
			'label'       => esc_html__('Sticky Header Height', 'fleur'),
			'description' => esc_html__('Enter height for sticky header (default is 82px)', 'fleur'),
			'parent'      => $panel_sticky_header,
			'args'        => array(
				'col_width' => 2,
				'suffix'    => 'px'
			)
		));

		$group_sticky_header_menu = fleur_mikado_add_admin_group(array(
			'title'       => esc_html__('Sticky Header Menu', 'fleur'),
			'name'        => 'group_sticky_header_menu',
			'parent'      => $panel_sticky_header,
			'description' => esc_html__('Define styles for sticky menu items', 'fleur'),
		));

		$row1_sticky_header_menu = fleur_mikado_add_admin_row(array(
			'name'   => 'row1',
			'parent' => $group_sticky_header_menu
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'sticky_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Text Color', 'fleur'),
			'description' => '',
			'parent'      => $row1_sticky_header_menu
		));

		$row2_sticky_header_menu = fleur_mikado_add_admin_row(array(
			'name'   => 'row2',
			'parent' => $group_sticky_header_menu
		));

		fleur_mikado_add_admin_field(
			array(
				'name'          => 'sticky_google_fonts',
				'type'          => 'fontsimple',
				'label'         => esc_html__('Font Family', 'fleur'),
				'default_value' => '-1',
				'parent'        => $row2_sticky_header_menu,
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'sticky_fontsize',
				'label'         => esc_html__('Font Size', 'fleur'),
				'default_value' => '',
				'parent'        => $row2_sticky_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'sticky_lineheight',
				'label'         => esc_html__('Line height', 'fleur'),
				'default_value' => '',
				'parent'        => $row2_sticky_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'sticky_texttransform',
				'label'         => esc_html__('Text transform', 'fleur'),
				'default_value' => '',
				'options'       => fleur_mikado_get_text_transform_array(),
				'parent'        => $row2_sticky_header_menu
			)
		);

		$row3_sticky_header_menu = fleur_mikado_add_admin_row(array(
			'name'   => 'row3',
			'parent' => $group_sticky_header_menu
		));

		fleur_mikado_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'sticky_fontstyle',
				'default_value' => '',
				'label'         => esc_html__('Font Style', 'fleur'),
				'options'       => fleur_mikado_get_font_style_array(),
				'parent'        => $row3_sticky_header_menu
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'sticky_fontweight',
				'default_value' => '',
				'label'         => esc_html__('Font Weight', 'fleur'),
				'options'       => fleur_mikado_get_font_weight_array(),
				'parent'        => $row3_sticky_header_menu
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'sticky_letterspacing',
				'label'         => esc_html__('Letter Spacing', 'fleur'),
				'default_value' => '',
				'parent'        => $row3_sticky_header_menu,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$panel_fixed_header = fleur_mikado_add_admin_panel(
			array(
				'title'           => esc_html__('Fixed Header', 'fleur'),
				'name'            => 'panel_fixed_header',
				'page'            => '_header_page',
				'hidden_property' => 'header_behaviour',
				'hidden_values'   => array(
					'sticky-header-on-scroll-up',
					'sticky-header-on-scroll-down-up',
					'no-behavior',
					'fixed-on-scroll'
				)
			)
		);

		fleur_mikado_add_admin_field(array(
			'name'          => 'fixed_header_grid_background_color',
			'type'          => 'color',
			'default_value' => '',
			'label'         => esc_html__('Grid Background Color', 'fleur'),
			'description'   => esc_html__('Set grid background color for fixed header', 'fleur'),
			'parent'        => $panel_fixed_header
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'fixed_header_grid_transparency',
			'type'          => 'text',
			'default_value' => '',
			'label'         => esc_html__('Header Transparency Grid', 'fleur'),
			'description'   => esc_html__('Enter transparency for fixed header grid (value from 0 to 1)', 'fleur'),
			'parent'        => $panel_fixed_header,
			'args'          => array(
				'col_width' => 1
			)
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'fixed_header_background_color',
			'type'          => 'color',
			'default_value' => '',
			'label'         => esc_html__('Background Color', 'fleur'),
			'description'   => esc_html__('Set background color for fixed header', 'fleur'),
			'parent'        => $panel_fixed_header
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'fixed_header_transparency',
			'type'        => 'text',
			'label'       => esc_html__('Header Transparency', 'fleur'),
			'description' => esc_html__('Enter transparency for fixed header (value from 0 to 1)', 'fleur'),
			'parent'      => $panel_fixed_header,
			'args'        => array(
				'col_width' => 1
			)
		));


		$panel_main_menu = fleur_mikado_add_admin_panel(
			array(
				'title'           => esc_html__('Main Menu', 'fleur'),
				'name'            => 'panel_main_menu',
				'page'            => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_values'   => array('header-vertical', 'header-minimal')
			)
		);

		fleur_mikado_add_admin_section_title(
			array(
				'parent' => $panel_main_menu,
				'name'   => 'main_menu_area_title',
				'title'  => esc_html__('Main Menu General Settings', 'fleur')
			)
		);

		$drop_down_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $panel_main_menu,
				'name'        => 'drop_down_group',
				'title'       => esc_html__('Main Dropdown Menu', 'fleur'),
				'description' => esc_html__('Choose a color and transparency for the main menu background (0 = fully transparent, 1 = opaque)', 'fleur')
			)
		);

		$drop_down_row1 = fleur_mikado_add_admin_row(
			array(
				'parent' => $drop_down_group,
				'name'   => 'drop_down_row1',
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $drop_down_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_background_color',
				'default_value' => '',
				'label'         => esc_html__('Background Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $drop_down_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_border_color',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
			)
		);


		fleur_mikado_add_admin_field(
			array(
				'parent'        => $drop_down_row1,
				'type'          => 'textsimple',
				'name'          => 'dropdown_background_transparency',
				'default_value' => '',
				'label'         => esc_html__('Transparency', 'fleur'),
			)
		);

		$drop_down_padding_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $panel_main_menu,
				'name'        => 'drop_down_padding_group',
				'title'       => esc_html__('Main Dropdown Menu Padding', 'fleur'),
				'description' => esc_html__('Choose a top/bottom padding for dropdown menu', 'fleur')
			)
		);

		$drop_down_padding_row = fleur_mikado_add_admin_row(
			array(
				'parent' => $drop_down_padding_group,
				'name'   => 'drop_down_padding_row',
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $drop_down_padding_row,
				'type'          => 'textsimple',
				'name'          => 'dropdown_top_padding',
				'default_value' => '',
				'label'         => esc_html__('Top Padding', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $drop_down_padding_row,
				'type'          => 'textsimple',
				'name'          => 'dropdown_bottom_padding',
				'default_value' => '',
				'label'         => esc_html__('Bottom Padding', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_main_menu,
				'type'          => 'select',
				'name'          => 'menu_dropdown_appearance',
				'default_value' => 'default',
				'label'         => esc_html__('Main Dropdown Menu Appearance', 'fleur'),
				'description'   => esc_html__('Choose appearance for dropdown menu', 'fleur'),
				'options'       => array(
					'dropdown-default'           => esc_html__('Default', 'fleur'),
					'dropdown-slide-from-bottom' => esc_html__('Slide From Bottom', 'fleur'),
					'dropdown-slide-from-top'    => esc_html__('Slide From Top', 'fleur'),
					'dropdown-animate-height'    => esc_html__('Animate Height', 'fleur'),
					'dropdown-slide-from-left'   => esc_html__('Slide From Left', 'fleur')
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_main_menu,
				'type'          => 'text',
				'name'          => 'dropdown_top_position',
				'default_value' => '',
				'label'         => esc_html__('Dropdown position', 'fleur'),
				'description'   => esc_html__('Enter value in percentage of entire header height', 'fleur'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => '%'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $panel_main_menu,
				'type'          => 'yesno',
				'name'          => 'enable_wide_menu_background',
				'default_value' => 'no',
				'label'         => esc_html__('Enable Full Width Background for Wide Dropdown Type', 'fleur'),
				'description'   => esc_html__('Enabling this option will show full width background  for wide dropdown type', 'fleur'),
			)
		);

		$first_level_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $panel_main_menu,
				'name'        => 'first_level_group',
				'title'       => esc_html__('1st Level Menu', 'fleur'),
				'description' => esc_html__('Define styles for 1st level in Top Navigation Menu', 'fleur')
			)
		);

		$first_level_row1 = fleur_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'menu_color',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'menu_hovercolor',
				'default_value' => '',
				'label'         => esc_html__('Hover Text Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'menu_activecolor',
				'default_value' => '',
				'label'         => esc_html__('Active Text Color', 'fleur'),
			)
		);

		$first_level_row2 = fleur_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'colorsimple',
				'name'          => 'menu_text_background_color',
				'default_value' => '',
				'label'         => esc_html__('Text Background Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'colorsimple',
				'name'          => 'menu_hover_background_color',
				'default_value' => '',
				'label'         => esc_html__('Hover Text Background Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'colorsimple',
				'name'          => 'menu_active_background_color',
				'default_value' => '',
				'label'         => esc_html__('Active Text Background Color', 'fleur'),
			)
		);

		$first_level_row3 = fleur_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row3',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row3,
				'type'          => 'colorsimple',
				'name'          => 'menu_light_hovercolor',
				'default_value' => '',
				'label'         => esc_html__('Light Menu Hover Text Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row3,
				'type'          => 'colorsimple',
				'name'          => 'menu_light_activecolor',
				'default_value' => '',
				'label'         => esc_html__('Light Menu Active Text Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row3,
				'type'          => 'colorsimple',
				'name'          => 'menu_light_border_color',
				'default_value' => '',
				'label'         => esc_html__('Light Menu Border Hover/Active Color', 'fleur'),
			)
		);

		$first_level_row4 = fleur_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row4',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row4,
				'type'          => 'colorsimple',
				'name'          => 'menu_dark_hovercolor',
				'default_value' => '',
				'label'         => esc_html__('Dark Menu Hover Text Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row4,
				'type'          => 'colorsimple',
				'name'          => 'menu_dark_activecolor',
				'default_value' => '',
				'label'         => esc_html__('Dark Menu Active Text Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row4,
				'type'          => 'colorsimple',
				'name'          => 'menu_dark_border_color',
				'default_value' => '',
				'label'         => esc_html__('Dark Menu Border Hover/Active Color', 'fleur'),
			)
		);

		$first_level_row5 = fleur_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row5',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row5,
				'type'          => 'fontsimple',
				'name'          => 'menu_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row5,
				'type'          => 'textsimple',
				'name'          => 'menu_fontsize',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row5,
				'type'          => 'textsimple',
				'name'          => 'menu_hover_background_color_transparency',
				'default_value' => '',
				'label'         => esc_html__('Hover Background Color Transparency', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row5,
				'type'          => 'textsimple',
				'name'          => 'menu_active_background_color_transparency',
				'default_value' => '',
				'label'         => esc_html__('Active Background Color Transparency', 'fleur'),
			)
		);

		$first_level_row6 = fleur_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row6',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row6,
				'type'          => 'selectblanksimple',
				'name'          => 'menu_fontstyle',
				'default_value' => '',
				'label'         => esc_html__('Font Style', 'fleur'),
				'options'       => fleur_mikado_get_font_style_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row6,
				'type'          => 'selectblanksimple',
				'name'          => 'menu_fontweight',
				'default_value' => '',
				'label'         => esc_html__('Font Weight', 'fleur'),
				'options'       => fleur_mikado_get_font_weight_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row6,
				'type'          => 'textsimple',
				'name'          => 'menu_letterspacing',
				'default_value' => '',
				'label'         => esc_html__('Letter Spacing', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row6,
				'type'          => 'selectblanksimple',
				'name'          => 'menu_texttransform',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'fleur'),
				'options'       => fleur_mikado_get_text_transform_array()
			)
		);

		$first_level_row7 = fleur_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row7',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row7,
				'type'          => 'textsimple',
				'name'          => 'menu_lineheight',
				'default_value' => '',
				'label'         => esc_html__('Line Height', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row7,
				'type'          => 'textsimple',
				'name'          => 'menu_padding_left_right',
				'default_value' => '',
				'label'         => esc_html__('Padding Left/Right', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $first_level_row7,
				'type'          => 'textsimple',
				'name'          => 'menu_margin_left_right',
				'default_value' => '',
				'label'         => esc_html__('Margin Left/Right', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $panel_main_menu,
				'name'        => 'second_level_group',
				'title'       => esc_html__('2nd Level Menu', 'fleur'),
				'description' => esc_html__('Define styles for 2nd level in Top Navigation Menu', 'fleur')
			)
		);

		$second_level_row1 = fleur_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_color',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_hovercolor',
				'default_value' => '',
				'label'         => esc_html__('Hover/Active Color', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_background_hovercolor',
				'default_value' => '',
				'label'         => esc_html__('Hover/Active Background Color', 'fleur')
			)
		);

		$second_level_row2 = fleur_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'fontsimple',
				'name'          => 'dropdown_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_fontsize',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_lineheight',
				'default_value' => '',
				'label'         => esc_html__('Line Height', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_padding_top_bottom',
				'default_value' => '',
				'label'         => esc_html__('Padding Top/Bottom', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_row3 = fleur_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row3',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_fontstyle',
				'default_value' => '',
				'label'         => esc_html__('Font style', 'fleur'),
				'options'       => fleur_mikado_get_font_style_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_fontweight',
				'default_value' => '',
				'label'         => esc_html__('Font weight', 'fleur'),
				'options'       => fleur_mikado_get_font_weight_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row3,
				'type'          => 'textsimple',
				'name'          => 'dropdown_letterspacing',
				'default_value' => '',
				'label'         => esc_html__('Letter spacing', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_texttransform',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'fleur'),
				'options'       => fleur_mikado_get_text_transform_array()
			)
		);

		$second_level_wide_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $panel_main_menu,
				'name'        => 'second_level_wide_group',
				'title'       => esc_html__('2nd Level Wide Menu', 'fleur'),
				'description' => esc_html__('Define styles for 2nd level in Wide Menu', 'fleur')
			)
		);

		$second_level_wide_row1 = fleur_mikado_add_admin_row(
			array(
				'parent' => $second_level_wide_group,
				'name'   => 'second_level_wide_row1'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_wide_color',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_wide_hovercolor',
				'default_value' => '',
				'label'         => esc_html__('Hover/Active Color', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_wide_background_hovercolor',
				'default_value' => '',
				'label'         => esc_html__('Hover/Active Background Color', 'fleur')
			)
		);

		$second_level_wide_row2 = fleur_mikado_add_admin_row(
			array(
				'parent' => $second_level_wide_group,
				'name'   => 'second_level_wide_row2',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row2,
				'type'          => 'fontsimple',
				'name'          => 'dropdown_wide_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_fontsize',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_lineheight',
				'default_value' => '',
				'label'         => esc_html__('Line Height', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_padding_top_bottom',
				'default_value' => '',
				'label'         => esc_html__('Padding Top/Bottom', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_wide_row3 = fleur_mikado_add_admin_row(
			array(
				'parent' => $second_level_wide_group,
				'name'   => 'second_level_wide_row3',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_wide_fontstyle',
				'default_value' => '',
				'label'         => esc_html__('Font style', 'fleur'),
				'options'       => fleur_mikado_get_font_style_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_wide_fontweight',
				'default_value' => '',
				'label'         => esc_html__('Font weight', 'fleur'),
				'options'       => fleur_mikado_get_font_weight_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row3,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_letterspacing',
				'default_value' => '',
				'label'         => esc_html__('Letter spacing', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $second_level_wide_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_wide_texttransform',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'fleur'),
				'options'       => fleur_mikado_get_text_transform_array()
			)
		);

		$third_level_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $panel_main_menu,
				'name'        => 'third_level_group',
				'title'       => esc_html__('3nd Level Menu', 'fleur'),
				'description' => esc_html__('Define styles for 3nd level in Top Navigation Menu', 'fleur')
			)
		);

		$third_level_row1 = fleur_mikado_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => 'third_level_row1'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_color_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_hovercolor_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Hover/Active Color', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_background_hovercolor_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Hover/Active Background Color', 'fleur')
			)
		);

		$third_level_row2 = fleur_mikado_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => 'third_level_row2',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'fontsimple',
				'name'          => 'dropdown_google_fonts_thirdlvl',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_fontsize_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_lineheight_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Line Height', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_row3 = fleur_mikado_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => 'third_level_row3',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_fontstyle_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Font style', 'fleur'),
				'options'       => fleur_mikado_get_font_style_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_fontweight_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Font weight', 'fleur'),
				'options'       => fleur_mikado_get_font_weight_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row3,
				'type'          => 'textsimple',
				'name'          => 'dropdown_letterspacing_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Letter spacing', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_texttransform_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'fleur'),
				'options'       => fleur_mikado_get_text_transform_array()
			)
		);


		/***********************************************************/
		$third_level_wide_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $panel_main_menu,
				'name'        => 'third_level_wide_group',
				'title'       => esc_html__('3rd Level Wide Menu', 'fleur'),
				'description' => esc_html__('Define styles for 3rd level in Wide Menu', 'fleur')
			)
		);

		$third_level_wide_row1 = fleur_mikado_add_admin_row(
			array(
				'parent' => $third_level_wide_group,
				'name'   => 'third_level_wide_row1'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_wide_color_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_wide_hovercolor_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Hover/Active Color', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row1,
				'type'          => 'colorsimple',
				'name'          => 'dropdown_wide_background_hovercolor_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Hover/Active Background Color', 'fleur')
			)
		);

		$third_level_wide_row2 = fleur_mikado_add_admin_row(
			array(
				'parent' => $third_level_wide_group,
				'name'   => 'third_level_wide_row2',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row2,
				'type'          => 'fontsimple',
				'name'          => 'dropdown_wide_google_fonts_thirdlvl',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_fontsize_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row2,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_lineheight_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Line Height', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_wide_row3 = fleur_mikado_add_admin_row(
			array(
				'parent' => $third_level_wide_group,
				'name'   => 'third_level_wide_row3',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_wide_fontstyle_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Font style', 'fleur'),
				'options'       => fleur_mikado_get_font_style_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_wide_fontweight_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Font weight', 'fleur'),
				'options'       => fleur_mikado_get_font_weight_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row3,
				'type'          => 'textsimple',
				'name'          => 'dropdown_wide_letterspacing_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Letter spacing', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $third_level_wide_row3,
				'type'          => 'selectblanksimple',
				'name'          => 'dropdown_wide_texttransform_thirdlvl',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'fleur'),
				'options'       => fleur_mikado_get_text_transform_array()
			)
		);

		$panel_vertical_main_menu = fleur_mikado_add_admin_panel(
			array(
				'title'           => esc_html__('Vertical Main Menu', 'fleur'),
				'name'            => 'panel_vertical_main_menu',
				'page'            => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_values'   => array(
					'header-standard',
					'header-minimal'
				)
			)
		);

		$drop_down_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $panel_vertical_main_menu,
				'name'        => 'vertical_drop_down_group',
				'title'       => esc_html__('Main Dropdown Menu', 'fleur'),
				'description' => esc_html__('Set a style for dropdown menu', 'fleur')
			)
		);

		$vertical_drop_down_row1 = fleur_mikado_add_admin_row(
			array(
				'parent' => $drop_down_group,
				'name'   => 'mkd_drop_down_row1',
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $vertical_drop_down_row1,
				'type'          => 'colorsimple',
				'name'          => 'vertical_dropdown_background_color',
				'default_value' => '',
				'label'         => esc_html__('Background Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $vertical_drop_down_row1,
				'type'          => 'colorsimple',
				'name'          => 'vertical_dropdown_border_color',
				'default_value' => '',
				'label'         => esc_html__('Border Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $vertical_drop_down_row1,
				'type'          => 'textsimple',
				'name'          => 'vertical_dropdown_transparency',
				'default_value' => '',
				'label'         => esc_html__('Transparency', 'fleur'),
			)
		);

		$group_vertical_first_level = fleur_mikado_add_admin_group(array(
			'name'        => 'group_vertical_first_level',
			'title'       => esc_html__('1st level', 'fleur'),
			'description' => esc_html__('Define styles for 1st level menu', 'fleur'),
			'parent'      => $panel_vertical_main_menu
		));

		$row_vertical_first_level_1 = fleur_mikado_add_admin_row(array(
			'name'   => 'row_vertical_first_level_1',
			'parent' => $group_vertical_first_level
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'vertical_menu_1st_color',
			'default_value' => '',
			'label'         => esc_html__('Text Color', 'fleur'),
			'parent'        => $row_vertical_first_level_1
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'vertical_menu_1st_hover_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Color', 'fleur'),
			'parent'        => $row_vertical_first_level_1
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'vertical_menu_1st_hover_background_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Background Color', 'fleur'),
			'parent'        => $row_vertical_first_level_1
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'vertical_menu_1st_fontsize',
			'default_value' => '',
			'label'         => esc_html__('Font Size', 'fleur'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_vertical_first_level_1
		));

		$row_vertical_first_level_2 = fleur_mikado_add_admin_row(array(
			'name'   => 'row_vertical_first_level_2',
			'parent' => $group_vertical_first_level,
			'next'   => true
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'vertical_menu_1st_lineheight',
			'default_value' => '',
			'label'         => esc_html__('Line Height', 'fleur'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_vertical_first_level_2
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'vertical_menu_1st_texttransform',
			'default_value' => '',
			'label'         => esc_html__('Text Transform', 'fleur'),
			'options'       => fleur_mikado_get_text_transform_array(),
			'parent'        => $row_vertical_first_level_2
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'fontsimple',
			'name'          => 'vertical_menu_1st_google_fonts',
			'default_value' => '-1',
			'label'         => esc_html__('Font Family', 'fleur'),
			'parent'        => $row_vertical_first_level_2
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'vertical_menu_1st_fontstyle',
			'default_value' => '',
			'label'         => esc_html__('Font Style', 'fleur'),
			'options'       => fleur_mikado_get_font_style_array(),
			'parent'        => $row_vertical_first_level_2
		));

		$row_vertical_first_level_3 = fleur_mikado_add_admin_row(array(
			'name'   => 'row_vertical_first_level_3',
			'parent' => $group_vertical_first_level,
			'next'   => true
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'vertical_menu_1st_fontweight',
			'default_value' => '',
			'label'         => esc_html__('Font Weight', 'fleur'),
			'options'       => fleur_mikado_get_font_weight_array(),
			'parent'        => $row_vertical_first_level_3
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'vertical_menu_1st_letter_spacing',
			'default_value' => '',
			'label'         => esc_html__('Letter Spacing', 'fleur'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_vertical_first_level_3
		));

		$group_vertical_second_level = fleur_mikado_add_admin_group(array(
			'name'        => 'group_vertical_second_level',
			'title'       => esc_html__('2nd level', 'fleur'),
			'description' => esc_html__('Define styles for 2nd level menu', 'fleur'),
			'parent'      => $panel_vertical_main_menu
		));

		$row_vertical_second_level_1 = fleur_mikado_add_admin_row(array(
			'name'   => 'row_vertical_second_level_1',
			'parent' => $group_vertical_second_level
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'vertical_menu_2nd_color',
			'default_value' => '',
			'label'         => esc_html__('Text Color', 'fleur'),
			'parent'        => $row_vertical_second_level_1
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'vertical_menu_2nd_hover_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Color', 'fleur'),
			'parent'        => $row_vertical_second_level_1
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'vertical_menu_2nd_hover_background_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Background Color', 'fleur'),
			'parent'        => $row_vertical_second_level_1
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'vertical_menu_2nd_fontsize',
			'default_value' => '',
			'label'         => esc_html__('Font Size', 'fleur'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_vertical_second_level_1
		));

		$row_vertical_second_level_2 = fleur_mikado_add_admin_row(array(
			'name'   => 'row_vertical_second_level_2',
			'parent' => $group_vertical_second_level,
			'next'   => true
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'vertical_menu_2nd_lineheight',
			'default_value' => '',
			'label'         => esc_html__('Line Height', 'fleur'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_vertical_second_level_2
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'vertical_menu_2nd_texttransform',
			'default_value' => '',
			'label'         => esc_html__('Text Transform', 'fleur'),
			'options'       => fleur_mikado_get_text_transform_array(),
			'parent'        => $row_vertical_second_level_2
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'fontsimple',
			'name'          => 'vertical_menu_2nd_google_fonts',
			'default_value' => '-1',
			'label'         => esc_html__('Font Family', 'fleur'),
			'parent'        => $row_vertical_second_level_2
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'vertical_menu_2nd_fontstyle',
			'default_value' => '',
			'label'         => esc_html__('Font Style', 'fleur'),
			'options'       => fleur_mikado_get_font_style_array(),
			'parent'        => $row_vertical_second_level_2
		));

		$row_vertical_second_level_3 = fleur_mikado_add_admin_row(array(
			'name'   => 'row_vertical_second_level_3',
			'parent' => $group_vertical_second_level,
			'next'   => true
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'vertical_menu_2nd_fontweight',
			'default_value' => '',
			'label'         => esc_html__('Font Weight', 'fleur'),
			'options'       => fleur_mikado_get_font_weight_array(),
			'parent'        => $row_vertical_second_level_3
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'vertical_menu_2nd_letter_spacing',
			'default_value' => '',
			'label'         => esc_html__('Letter Spacing', 'fleur'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_vertical_second_level_3
		));

		$group_vertical_third_level = fleur_mikado_add_admin_group(array(
			'name'        => 'group_vertical_third_level',
			'title'       => esc_html__('3rd level', 'fleur'),
			'description' => esc_html__('Define styles for 3rd level menu', 'fleur'),
			'parent'      => $panel_vertical_main_menu
		));

		$row_vertical_third_level_1 = fleur_mikado_add_admin_row(array(
			'name'   => 'row_vertical_third_level_1',
			'parent' => $group_vertical_third_level
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'vertical_menu_3rd_color',
			'default_value' => '',
			'label'         => esc_html__('Text Color', 'fleur'),
			'parent'        => $row_vertical_third_level_1
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'vertical_menu_3rd_hover_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Color', 'fleur'),
			'parent'        => $row_vertical_third_level_1
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'vertical_menu_3rd_hover_background_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Background Color', 'fleur'),
			'parent'        => $row_vertical_third_level_1
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'vertical_menu_3rd_fontsize',
			'default_value' => '',
			'label'         => esc_html__('Font Size', 'fleur'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_vertical_third_level_1
		));

		$row_vertical_third_level_2 = fleur_mikado_add_admin_row(array(
			'name'   => 'row_vertical_third_level_2',
			'parent' => $group_vertical_third_level,
			'next'   => true
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'vertical_menu_3rd_lineheight',
			'default_value' => '',
			'label'         => esc_html__('Line Height', 'fleur'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_vertical_third_level_2
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'vertical_menu_3rd_texttransform',
			'default_value' => '',
			'label'         => esc_html__('Text Transform', 'fleur'),
			'options'       => fleur_mikado_get_text_transform_array(),
			'parent'        => $row_vertical_third_level_2
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'fontsimple',
			'name'          => 'vertical_menu_3rd_google_fonts',
			'default_value' => '-1',
			'label'         => esc_html__('Font Family', 'fleur'),
			'parent'        => $row_vertical_third_level_2
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'vertical_menu_3rd_fontstyle',
			'default_value' => '',
			'label'         => esc_html__('Font Style', 'fleur'),
			'options'       => fleur_mikado_get_font_style_array(),
			'parent'        => $row_vertical_third_level_2
		));

		$row_vertical_third_level_3 = fleur_mikado_add_admin_row(array(
			'name'   => 'row_vertical_third_level_3',
			'parent' => $group_vertical_third_level,
			'next'   => true
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'selectblanksimple',
			'name'          => 'vertical_menu_3rd_fontweight',
			'default_value' => '',
			'label'         => esc_html__('Font Weight', 'fleur'),
			'options'       => fleur_mikado_get_font_weight_array(),
			'parent'        => $row_vertical_third_level_3
		));

		fleur_mikado_add_admin_field(array(
			'type'          => 'textsimple',
			'name'          => 'vertical_menu_3rd_letter_spacing',
			'default_value' => '',
			'label'         => esc_html__('Letter Spacing', 'fleur'),
			'args'          => array(
				'suffix' => 'px'
			),
			'parent'        => $row_vertical_third_level_3
		));

		$panel_mobile_header = fleur_mikado_add_admin_panel(array(
			'title' => esc_html__('Mobile header', 'fleur'),
			'name'  => 'panel_mobile_header',
			'page'  => '_header_page'
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_header_height',
			'type'        => 'text',
			'label'       => esc_html__('Mobile Header Height', 'fleur'),
			'description' => esc_html__('Enter height for mobile header in pixels', 'fleur'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_header_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Header Background Color', 'fleur'),
			'description' => esc_html__('Choose color for mobile header', 'fleur'),
			'parent'      => $panel_mobile_header
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_menu_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Menu Background Color', 'fleur'),
			'description' => esc_html__('Choose color for mobile menu', 'fleur'),
			'parent'      => $panel_mobile_header
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_menu_separator_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Menu Item Separator Color', 'fleur'),
			'description' => esc_html__('Choose color for mobile menu horizontal separators', 'fleur'),
			'parent'      => $panel_mobile_header
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_logo_height',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Header', 'fleur'),
			'description' => esc_html__('Define logo height for screen size smaller than 1000px', 'fleur'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_logo_height_phones',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Devices', 'fleur'),
			'description' => esc_html__('Define logo height for screen size smaller than 480px', 'fleur'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		fleur_mikado_add_admin_section_title(array(
			'parent' => $panel_mobile_header,
			'name'   => 'mobile_header_fonts_title',
			'title'  => esc_html__('Typography', 'fleur')
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_text_color',
			'type'        => 'color',
			'label'       => esc_html__('Navigation Text Color', 'fleur'),
			'description' => esc_html__('Define color for mobile navigation text', 'fleur'),
			'parent'      => $panel_mobile_header
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_text_hover_color',
			'type'        => 'color',
			'label'       => esc_html__('Navigation Hover/Active Color', 'fleur'),
			'description' => esc_html__('Define hover/active color for mobile navigation text', 'fleur'),
			'parent'      => $panel_mobile_header
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_font_family',
			'type'        => 'font',
			'label'       => esc_html__('Navigation Font Family', 'fleur'),
			'description' => esc_html__('Define font family for mobile navigation text', 'fleur'),
			'parent'      => $panel_mobile_header
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_font_size',
			'type'        => 'text',
			'label'       => esc_html__('Navigation Font Size', 'fleur'),
			'description' => esc_html__('Define font size for mobile navigation text', 'fleur'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_line_height',
			'type'        => 'text',
			'label'       => esc_html__('Navigation Line Height', 'fleur'),
			'description' => esc_html__('Define line height for mobile navigation text', 'fleur'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_text_transform',
			'type'        => 'select',
			'label'       => esc_html__('Navigation Text Transform', 'fleur'),
			'description' => esc_html__('Define text transform for mobile navigation text', 'fleur'),
			'parent'      => $panel_mobile_header,
			'options'     => fleur_mikado_get_text_transform_array(true)
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_font_style',
			'type'        => 'select',
			'label'       => esc_html__('Navigation Font Style', 'fleur'),
			'description' => esc_html__('Define font style for mobile navigation text', 'fleur'),
			'parent'      => $panel_mobile_header,
			'options'     => fleur_mikado_get_font_style_array(true)
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_font_weight',
			'type'        => 'select',
			'label'       => esc_html__('Navigation Font Weight', 'fleur'),
			'description' => esc_html__('Define font weight for mobile navigation text', 'fleur'),
			'parent'      => $panel_mobile_header,
			'options'     => fleur_mikado_get_font_weight_array(true)
		));

		fleur_mikado_add_admin_section_title(array(
			'name'   => 'mobile_opener_panel',
			'parent' => $panel_mobile_header,
			'title'  => esc_html__('Mobile Menu Opener', 'fleur')
		));

		fleur_mikado_add_admin_field(array(
			'name'          => 'mobile_icon_pack',
			'type'          => 'select',
			'label'         => esc_html__('Mobile Navigation Icon Pack', 'fleur'),
			'default_value' => 'font_awesome',
			'description'   => esc_html__('Choose icon pack for mobile navigation icon', 'fleur'),
			'parent'        => $panel_mobile_header,
			'options'       => fleur_mikado_icon_collections()->getIconCollectionsExclude(array(
				'linea_icons',
				'simple_line_icons',
				'linear_icons'
			))
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Color', 'fleur'),
			'description' => esc_html__('Choose color for icon header', 'fleur'),
			'parent'      => $panel_mobile_header
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_hover_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Hover Color', 'fleur'),
			'description' => esc_html__('Choose hover color for mobile navigation icon ', 'fleur'),
			'parent'      => $panel_mobile_header
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_size',
			'type'        => 'text',
			'label'       => esc_html__('Mobile Navigation Icon size', 'fleur'),
			'description' => esc_html__('Choose size for mobile navigation icon', 'fleur'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));
	}

	add_action('fleur_mikado_options_map', 'fleur_mikado_header_options_map', 3);

}