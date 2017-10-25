<?php

if(!function_exists('fleur_mikado_button_map')) {
	function fleur_mikado_button_map() {
		$panel = fleur_mikado_add_admin_panel(array(
			'title' => esc_html__('Button', 'fleur'),
			'name'  => 'panel_button',
			'page'  => '_elements_page'
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'button_hover_animation',
			'type'        => 'select',
			'label'       => esc_html__('Hover Animation', 'fleur'),
			'description' => esc_html__('Choose default hover animation type', 'fleur'),
			'parent'      => $panel,
			'options'     => fleur_mikado_get_btn_hover_animation_types()
		));

		//Typography options
		fleur_mikado_add_admin_section_title(array(
			'name'   => 'typography_section_title',
			'title'  => esc_html__('Typography', 'fleur'),
			'parent' => $panel
		));

		$typography_group = fleur_mikado_add_admin_group(array(
			'name'        => 'typography_group',
			'title'       => esc_html__('Typography', 'fleur'),
			'description' => esc_html__('Setup typography for all button types', 'fleur'),
			'parent'      => $panel
		));

		$typography_row = fleur_mikado_add_admin_row(array(
			'name'   => 'typography_row',
			'next'   => true,
			'parent' => $typography_group
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'fontsimple',
			'name'          => 'button_font_family',
			'default_value' => '',
			'label'         => esc_html__('Font Family', 'fleur'),
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'selectsimple',
			'name'          => 'button_text_transform',
			'default_value' => '',
			'label'         => esc_html__('Text Transform', 'fleur'),
			'options'       => fleur_mikado_get_text_transform_array()
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'selectsimple',
			'name'          => 'button_font_style',
			'default_value' => '',
			'label'         => esc_html__('Font Style', 'fleur'),
			'options'       => fleur_mikado_get_font_style_array()
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'textsimple',
			'name'          => 'button_letter_spacing',
			'default_value' => '',
			'label'         => esc_html__('Letter Spacing', 'fleur'),
			'args'          => array(
				'suffix' => 'px'
			)
		));

		$typography_row2 = fleur_mikado_add_admin_row(array(
			'name'   => 'typography_row2',
			'next'   => true,
			'parent' => $typography_group
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $typography_row2,
			'type'          => 'selectsimple',
			'name'          => 'button_font_weight',
			'default_value' => '',
			'label'         => esc_html__('Font Weight', 'fleur'),
			'options'       => fleur_mikado_get_font_weight_array()
		));

		//Outline type options
		fleur_mikado_add_admin_section_title(array(
			'name'   => 'type_section_title',
			'title'  => esc_html__('Types', 'fleur'),
			'parent' => $panel
		));

		$outline_group = fleur_mikado_add_admin_group(array(
			'name'        => 'outline_group',
			'title'       => esc_html__('Outline Type', 'fleur'),
			'description' => esc_html__('Setup outline button type', 'fleur'),
			'parent'      => $panel
		));

		$outline_row = fleur_mikado_add_admin_row(array(
			'name'   => 'outline_row',
			'next'   => true,
			'parent' => $outline_group
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $outline_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Color', 'fleur'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $outline_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_hover_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Hover Color', 'fleur'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $outline_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_hover_bg_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Background Color', 'fleur'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $outline_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_border_color',
			'default_value' => '',
			'label'         => esc_html__('Border Color', 'fleur'),
			'description'   => ''
		));

		$outline_row2 = fleur_mikado_add_admin_row(array(
			'name'   => 'outline_row2',
			'next'   => true,
			'parent' => $outline_group
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $outline_row2,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_hover_border_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Border Color', 'fleur'),
			'description'   => ''
		));

		//Solid type options
		$solid_group = fleur_mikado_add_admin_group(array(
			'name'        => 'solid_group',
			'title'       => esc_html__('Solid Type', 'fleur'),
			'description' => esc_html__('Setup solid button type', 'fleur'),
			'parent'      => $panel
		));

		$solid_row = fleur_mikado_add_admin_row(array(
			'name'   => 'solid_row',
			'next'   => true,
			'parent' => $solid_group
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Color', 'fleur'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_hover_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Hover Color', 'fleur'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_bg_color',
			'default_value' => '',
			'label'         => esc_html__('Background Color', 'fleur'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_hover_bg_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Background Color', 'fleur'),
			'description'   => ''
		));

		$solid_row2 = fleur_mikado_add_admin_row(array(
			'name'   => 'solid_row2',
			'next'   => true,
			'parent' => $solid_group
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $solid_row2,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_border_color',
			'default_value' => '',
			'label'         => esc_html__('Border Color', 'fleur'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $solid_row2,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_hover_border_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Border Color', 'fleur'),
			'description'   => ''
		));
	}

	add_action('fleur_mikado_options_elements_map', 'fleur_mikado_button_map');
}