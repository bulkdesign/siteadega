<?php

if(!function_exists('fleur_mikado_search_options_map')) {

	function fleur_mikado_search_options_map() {

		fleur_mikado_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__('Search', 'fleur'),
				'icon'  => 'icon_search'
			)
		);

		$search_panel = fleur_mikado_add_admin_panel(
			array(
				'title' => esc_html__('Search', 'fleur'),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_type',
				'default_value' => 'fullscreen-search',
				'label'         => esc_html__('Select Search Type', 'fleur'),
				'description'   => esc_html__("Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with transparent header)", 'fleur'),
				'options'       => array(
					'fullscreen-search'                => esc_html__('Fullscreen Search', 'fleur'),
					'search-covers-header'             => esc_html__('Search Covers Header', 'fleur'),
					'search-slides-from-window-top'    => esc_html__('Slide from Window Top', 'fleur'),
					'search-dropdown'                  => esc_html__('Search Dropdown', 'fleur')
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'search-covers-header'             => '#mkd_search_height_container, #mkd_search_animation_container',
						'fullscreen-search'                => '#mkd_search_height_container, #mkd_search_close_container',
						'search-slides-from-window-top'    => '#mkd_search_height_container, #mkd_search_animation_container'
					),
					'show'       => array(
						'search-covers-header'             => '#mkd_search_close_container',
						'fullscreen-search'                => '#mkd_search_animation_container',
						'search-slides-from-window-top'    => '#mkd_search_close_container'
					)
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'font_awesome',
				'label'         => esc_html__('Search Icon Pack', 'fleur'),
				'description'   => esc_html__('Choose icon pack for search icon', 'fleur'),
				'options'       => fleur_mikado_icon_collections()->getIconCollectionsExclude(array(
					'linea_icons',
					'simple_line_icons',
					'dripicons'
				))
			)
		);

		$search_height_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_height_container',
				'hidden_property' => 'search_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'fullscreen-search',
					'search-covers-header',
					'search-slides-from-window-top'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_height_container,
				'type'          => 'text',
				'name'          => 'search_height',
				'default_value' => '',
				'label'         => esc_html__('Search bar height', 'fleur'),
				'description'   => esc_html__('Set search bar height', 'fleur'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		$search_animation_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_animation_container',
				'hidden_property' => 'search_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'search-covers-header',
					'search-slides-from-window-top'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__('Search area in grid', 'fleur'),
				'description'   => esc_html__('Set search area to be in grid', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(array(
			'name' => 'fullscreen_search_background_image',
			'type' => 'image',
			'parent' => $search_animation_container,
			'label' => esc_html__('Full Screen Search Background Image', 'fleur'),
			'description' => esc_html__('Choose full screen search background image', 'fleur')
		));

		fleur_mikado_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => esc_html__('Initial Search Icon in Header', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => esc_html__('Icon Size', 'fleur'),
				'description'   => esc_html__('Set size for icon', 'fleur'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		$search_icon_color_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Icon Colors', 'fleur'),
				'description' => esc_html__('Define color style for icon', 'fleur'),
				'name'        => 'search_icon_color_group'
			)
		);

		$search_icon_color_row = fleur_mikado_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => esc_html__('Color', 'fleur')
			)
		);
		fleur_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => esc_html__('Hover Color', 'fleur')
			)
		);
		fleur_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_light_search_icon_color',
				'label'  => esc_html__('Light Header Icon Color', 'fleur')
			)
		);
		fleur_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_light_search_icon_hover_color',
				'label'  => esc_html__('Light Header Icon Hover Color', 'fleur')
			)
		);

		$search_icon_color_row2 = fleur_mikado_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row2',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row2,
				'type'   => 'colorsimple',
				'name'   => 'header_dark_search_icon_color',
				'label'  => esc_html__('Dark Header Icon Color', 'fleur')
			)
		);
		fleur_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row2,
				'type'   => 'colorsimple',
				'name'   => 'header_dark_search_icon_hover_color',
				'label'  => esc_html__('Dark Header Icon Hover Color', 'fleur')
			)
		);


		$search_icon_background_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Icon Background Style', 'fleur'),
				'description' => esc_html__('Define background style for icon', 'fleur'),
				'name'        => 'search_icon_background_group'
			)
		);

		$search_icon_background_row = fleur_mikado_add_admin_row(
			array(
				'parent' => $search_icon_background_group,
				'name'   => 'search_icon_background_row'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_background_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_background_color',
				'default_value' => '',
				'label'         => esc_html__('Background Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_background_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_background_hover_color',
				'default_value' => '',
				'label'         => esc_html__('Background Hover Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label'         => esc_html__('Enable Search Icon Text', 'fleur'),
				'description'   => esc_html__("Enable this option to show 'Search' text next to search icon in header", 'fleur'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkd_enable_search_icon_text_container'
				)
			)
		);

		$enable_search_icon_text_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'hidden_property' => 'enable_search_icon_text',
				'hidden_value'    => 'no'
			)
		);

		$enable_search_icon_text_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title'       => esc_html__('Search Icon Text', 'fleur'),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__('Define Style for Search Icon Text', 'fleur')
			)
		);

		$enable_search_icon_text_row = fleur_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_text_color',
				'label'         => esc_html__('Text Color', 'fleur'),
				'default_value' => ''
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_text_color_hover',
				'label'         => esc_html__('Text Hover Color', 'fleur'),
				'default_value' => ''
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_fontsize',
				'label'         => esc_html__('Font Size', 'fleur'),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_lineheight',
				'label'         => esc_html__('Line Height', 'fleur'),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$enable_search_icon_text_row2 = fleur_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_texttransform',
				'label'         => esc_html__('Text Transform', 'fleur'),
				'default_value' => '',
				'options'       => fleur_mikado_get_text_transform_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label'         => esc_html__('Font Family', 'fleur'),
				'default_value' => '-1',
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_fontstyle',
				'label'         => esc_html__('Font Style', 'fleur'),
				'default_value' => '',
				'options'       => fleur_mikado_get_font_style_array(),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_fontweight',
				'label'         => esc_html__('Font Weight', 'fleur'),
				'default_value' => '',
				'options'       => fleur_mikado_get_font_weight_array(),
			)
		);

		$enable_search_icon_text_row3 = fleur_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letterspacing',
				'label'         => esc_html__('Letter Spacing', 'fleur'),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$search_icon_spacing_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Icon Spacing', 'fleur'),
				'description' => esc_html__('Define padding and margins for Search icon', 'fleur'),
				'name'        => 'search_icon_spacing_group'
			)
		);

		$search_icon_spacing_row = fleur_mikado_add_admin_row(
			array(
				'parent' => $search_icon_spacing_group,
				'name'   => 'search_icon_spacing_row'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'search_padding_left',
				'default_value' => '',
				'label'         => esc_html__('Padding Left', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'search_padding_right',
				'default_value' => '',
				'label'         => esc_html__('Padding Right', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'search_margin_left',
				'default_value' => '',
				'label'         => esc_html__('Margin Left', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'search_margin_right',
				'default_value' => '',
				'label'         => esc_html__('Margin Right', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'search_form_title',
				'title'  => esc_html__('Search Bar', 'fleur')
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'color',
				'name'          => 'search_background_color',
				'default_value' => '',
				'label'         => esc_html__('Background Color', 'fleur'),
				'description'   => esc_html__('Choose a background color for Select search bar', 'fleur')
			)
		);

		$search_input_text_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Search Input Text', 'fleur'),
				'description' => esc_html__('Define style for search text', 'fleur'),
				'name'        => 'search_input_text_group'
			)
		);

		$search_input_text_row = fleur_mikado_add_admin_row(
			array(
				'parent' => $search_input_text_group,
				'name'   => 'search_input_text_row'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row,
				'type'          => 'colorsimple',
				'name'          => 'search_text_color',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row,
				'type'          => 'colorsimple',
				'name'          => 'search_text_disabled_color',
				'default_value' => '',
				'label'         => esc_html__('Disabled Text Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_text_fontsize',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row,
				'type'          => 'selectblanksimple',
				'name'          => 'search_text_texttransform',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'fleur'),
				'options'       => fleur_mikado_get_text_transform_array()
			)
		);

		$search_input_text_row2 = fleur_mikado_add_admin_row(
			array(
				'parent' => $search_input_text_group,
				'name'   => 'search_input_text_row2'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_text_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_text_fontstyle',
				'default_value' => '',
				'label'         => esc_html__('Font Style', 'fleur'),
				'options'       => fleur_mikado_get_font_style_array(),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_text_fontweight',
				'default_value' => '',
				'label'         => esc_html__('Font Weight', 'fleur'),
				'options'       => fleur_mikado_get_font_weight_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_input_text_row2,
				'type'          => 'textsimple',
				'name'          => 'search_text_letterspacing',
				'default_value' => '',
				'label'         => esc_html__('Letter Spacing', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$search_label_text_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Search Label Text', 'fleur'),
				'description' => esc_html__('Define style for search label text', 'fleur'),
				'name'        => 'search_label_text_group'
			)
		);

		$search_label_text_row = fleur_mikado_add_admin_row(
			array(
				'parent' => $search_label_text_group,
				'name'   => 'search_label_text_row'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row,
				'type'          => 'colorsimple',
				'name'          => 'search_label_text_color',
				'default_value' => '',
				'label'         => esc_html__('Text Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_label_text_fontsize',
				'default_value' => '',
				'label'         => esc_html__('Font Size', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row,
				'type'          => 'selectblanksimple',
				'name'          => 'search_label_text_texttransform',
				'default_value' => '',
				'label'         => esc_html__('Text Transform', 'fleur'),
				'options'       => fleur_mikado_get_text_transform_array()
			)
		);

		$search_label_text_row2 = fleur_mikado_add_admin_row(
			array(
				'parent' => $search_label_text_group,
				'name'   => 'search_label_text_row2',
				'next'   => true
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_label_text_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__('Font Family', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_label_text_fontstyle',
				'default_value' => '',
				'label'         => esc_html__('Font Style', 'fleur'),
				'options'       => fleur_mikado_get_font_style_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_label_text_fontweight',
				'default_value' => '',
				'label'         => esc_html__('Font Weight', 'fleur'),
				'options'       => fleur_mikado_get_font_weight_array()
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_label_text_row2,
				'type'          => 'textsimple',
				'name'          => 'search_label_text_letterspacing',
				'default_value' => '',
				'label'         => esc_html__('Letter Spacing', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$search_icon_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Search Icon', 'fleur'),
				'description' => esc_html__('Define style for search icon', 'fleur'),
				'name'        => 'search_icon_group'
			)
		);

		$search_icon_row = fleur_mikado_add_admin_row(
			array(
				'parent' => $search_icon_group,
				'name'   => 'search_icon_row'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_color',
				'default_value' => '',
				'label'         => esc_html__('Icon Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_hover_color',
				'default_value' => '',
				'label'         => esc_html__('Icon Hover Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_disabled_color',
				'default_value' => '',
				'label'         => esc_html__('Icon Disabled Color', 'fleur'),
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_size',
				'default_value' => '',
				'label'         => esc_html__('Icon Size', 'fleur'),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$search_close_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_close_container',
				'hidden_property' => 'search_type',
				'hidden_value'    => 'fullscreen-search',
			)
		);

		$search_close_icon_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $search_close_container,
				'title'       => esc_html__('Search Close', 'fleur'),
				'description' => esc_html__('Define style for search close icon', 'fleur'),
				'name'        => 'search_close_icon_group'
			)
		);

		$search_close_icon_row = fleur_mikado_add_admin_row(
			array(
				'parent' => $search_close_icon_group,
				'name'   => 'search_icon_row'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_close_icon_row,
				'type'          => 'colorsimple',
				'name'          => 'search_close_color',
				'label'         => esc_html__('Icon Color', 'fleur'),
				'default_value' => ''
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_close_icon_row,
				'type'          => 'colorsimple',
				'name'          => 'search_close_hover_color',
				'label'         => esc_html__('Icon Hover Color', 'fleur'),
				'default_value' => ''
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_close_icon_row,
				'type'          => 'textsimple',
				'name'          => 'search_close_size',
				'label'         => esc_html__('Icon Size', 'fleur'),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$search_bottom_border_group = fleur_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__('Search Bottom Border', 'fleur'),
				'description' => esc_html__('Define style for Search text input bottom border (for Fullscreen search type)', 'fleur'),
				'name'        => 'search_bottom_border_group'
			)
		);

		$search_bottom_border_row = fleur_mikado_add_admin_row(
			array(
				'parent' => $search_bottom_border_group,
				'name'   => 'search_icon_row'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_bottom_border_row,
				'type'          => 'colorsimple',
				'name'          => 'search_border_color',
				'label'         => esc_html__('Border Color', 'fleur'),
				'default_value' => ''
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'parent'        => $search_bottom_border_row,
				'type'          => 'colorsimple',
				'name'          => 'search_border_focus_color',
				'label'         => esc_html__('Border Focus Color', 'fleur'),
				'default_value' => ''
			)
		);

	}

	add_action('fleur_mikado_options_map', 'fleur_mikado_search_options_map', 6);

}