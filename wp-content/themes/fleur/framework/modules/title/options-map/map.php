<?php

if(!function_exists('fleur_mikado_title_options_map')) {

    function fleur_mikado_title_options_map() {

        fleur_mikado_add_admin_page(
            array(
                'slug'  => '_title_page',
                'title' => esc_html__('Title', 'fleur'),
                'icon'  => 'icon_archive_alt'
            )
        );

        $panel_title = fleur_mikado_add_admin_panel(
            array(
                'page'  => '_title_page',
                'name'  => 'panel_title',
                'title' => esc_html__('Title Settings', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'show_title_area',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Show Title Area', 'fleur'),
                'description'   => esc_html__('This option will enable/disable Title Area', 'fleur'),
                'parent'        => $panel_title,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_show_title_area_container"
                )
            )
        );

        $show_title_area_container = fleur_mikado_add_admin_container(
            array(
                'parent'          => $panel_title,
                'name'            => 'show_title_area_container',
                'hidden_property' => 'show_title_area',
                'hidden_value'    => 'no'
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'title_area_type',
                'type'          => 'select',
                'default_value' => 'standard',
                'label'         => esc_html__('Title Area Type', 'fleur'),
                'description'   => esc_html__('Choose title type', 'fleur'),
                'parent'        => $show_title_area_container,
                'options'       => array(
                    'standard'   => esc_html__('Standard', 'fleur'),
                    'breadcrumb' => esc_html__('Breadcrumb', 'fleur')
                ),
                'args'          => array(
                    "dependence" => true,
                    "hide"       => array(
                        "standard"   => "",
                        "breadcrumb" => "#mkd_title_area_type_container"
                    ),
                    "show"       => array(
                        "standard"   => "#mkd_title_area_type_container",
                        "breadcrumb" => ""
                    )
                )
            )
        );

        $title_area_type_container = fleur_mikado_add_admin_container(
            array(
                'parent'          => $show_title_area_container,
                'name'            => 'title_area_type_container',
                'hidden_property' => 'title_area_type',
                'hidden_value'    => '',
                'hidden_values'   => array('breadcrumb'),
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'title_area_enable_breadcrumbs',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Enable Breadcrumbs', 'fleur'),
                'description'   => esc_html__('This option will display Breadcrumbs in Title Area', 'fleur'),
                'parent'        => $title_area_type_container,
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'title_area_animation',
                'type'          => 'select',
                'default_value' => 'no',
                'label'         => esc_html__('Animations', 'fleur'),
                'description'   => esc_html__('Choose an animation for Title Area', 'fleur'),
                'parent'        => $show_title_area_container,
                'options'       => array(
                    'no'         => esc_html__('No Animation', 'fleur'),
                    'right-left' => esc_html__('Text right to left', 'fleur'),
                    'left-right' => esc_html__('Text left to right', 'fleur')
                )
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'title_area_vertial_alignment',
                'type'          => 'select',
                'default_value' => 'header_bottom',
                'label'         => esc_html__('Vertical Alignment', 'fleur'),
                'description'   => esc_html__('Specify title vertical alignment', 'fleur'),
                'parent'        => $show_title_area_container,
                'options'       => array(
                    'header_bottom' => esc_html__('From Bottom of Header', 'fleur'),
                    'window_top'    => esc_html__('From Window Top', 'fleur')
                )
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'title_area_content_alignment',
                'type'          => 'select',
                'default_value' => 'left',
                'label'         => esc_html__('Horizontal Alignment', 'fleur'),
                'description'   => esc_html__('Specify title horizontal alignment', 'fleur'),
                'parent'        => $show_title_area_container,
                'options'       => array(
                    'left'   => esc_html__('Left', 'fleur'),
                    'center' => esc_html__('Center', 'fleur'),
                    'right'  => esc_html__('Right', 'fleur')
                )
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'title_area_background_color',
                'type'        => 'color',
                'label'       => esc_html__('Background Color', 'fleur'),
                'description' => esc_html__('Choose a background color for Title Area', 'fleur'),
                'parent'      => $show_title_area_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'title_area_background_image',
                'type'        => 'image',
                'label'       => esc_html__('Background Image', 'fleur'),
                'description' => esc_html__('Choose an Image for Title Area', 'fleur'),
                'parent'      => $show_title_area_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'title_area_background_image_responsive',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Background Responsive Image', 'fleur'),
                'description'   => esc_html__('Enabling this option will make Title background image responsive', 'fleur'),
                'parent'        => $show_title_area_container,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "#mkd_title_area_background_image_responsive_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $title_area_background_image_responsive_container = fleur_mikado_add_admin_container(
            array(
                'parent'          => $show_title_area_container,
                'name'            => 'title_area_background_image_responsive_container',
                'hidden_property' => 'title_area_background_image_responsive',
                'hidden_value'    => 'yes'
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'title_area_background_image_parallax',
                'type'          => 'select',
                'default_value' => 'no',
                'label'         => esc_html__('Background Image in Parallax', 'fleur'),
                'description'   => esc_html__('Enabling this option will make Title background image parallax', 'fleur'),
                'parent'        => $title_area_background_image_responsive_container,
                'options'       => array(
                    'no'       => esc_html__('No', 'fleur'),
                    'yes'      => esc_html__('Yes', 'fleur'),
                    'yes_zoom' => esc_html__('Yes, with zoom out', 'fleur')
                )
            )
        );

        fleur_mikado_add_admin_field(array(
            'name'        => 'title_area_height',
            'type'        => 'text',
            'label'       => esc_html__('Height', 'fleur'),
            'description' => esc_html__('Set a height for Title Area', 'fleur'),
            'parent'      => $title_area_background_image_responsive_container,
            'args'        => array(
                'col_width' => 2,
                'suffix'    => 'px'
            )
        ));


        $panel_typography = fleur_mikado_add_admin_panel(
            array(
                'page'  => '_title_page',
                'name'  => 'panel_title_typography',
                'title' => esc_html__('Typography', 'fleur')
            )
        );

        $group_page_title_styles = fleur_mikado_add_admin_group(array(
            'name'        => 'group_page_title_styles',
            'title'       => esc_html__('Title', 'fleur'),
            'description' => esc_html__('Define styles for page title', 'fleur'),
            'parent'      => $panel_typography
        ));

        $row_page_title_styles_1 = fleur_mikado_add_admin_row(array(
            'name'   => 'row_page_title_styles_1',
            'parent' => $group_page_title_styles
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'page_title_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'fleur'),
            'parent'        => $row_page_title_styles_1
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_title_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_title_styles_1
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_title_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_title_styles_1
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_title_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'fleur'),
            'options'       => fleur_mikado_get_text_transform_array(),
            'parent'        => $row_page_title_styles_1
        ));

        $row_page_title_styles_2 = fleur_mikado_add_admin_row(array(
            'name'   => 'row_page_title_styles_2',
            'parent' => $group_page_title_styles,
            'next'   => true
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'page_title_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'fleur'),
            'parent'        => $row_page_title_styles_2
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_title_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'fleur'),
            'options'       => fleur_mikado_get_font_style_array(),
            'parent'        => $row_page_title_styles_2
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_title_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'fleur'),
            'options'       => fleur_mikado_get_font_weight_array(),
            'parent'        => $row_page_title_styles_2
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_title_letter_spacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_title_styles_2
        ));

        $group_page_subtitle_styles = fleur_mikado_add_admin_group(array(
            'name'        => 'group_page_subtitle_styles',
            'title'       => esc_html__('Subtitle', 'fleur'),
            'description' => esc_html__('Define styles for page subtitle', 'fleur'),
            'parent'      => $panel_typography
        ));

        $row_page_subtitle_styles_1 = fleur_mikado_add_admin_row(array(
            'name'   => 'row_page_subtitle_styles_1',
            'parent' => $group_page_subtitle_styles
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'page_subtitle_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'fleur'),
            'parent'        => $row_page_subtitle_styles_1
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_subtitle_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_subtitle_styles_1
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_subtitle_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_subtitle_styles_1
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_subtitle_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'fleur'),
            'options'       => fleur_mikado_get_text_transform_array(),
            'parent'        => $row_page_subtitle_styles_1
        ));

        $row_page_subtitle_styles_2 = fleur_mikado_add_admin_row(array(
            'name'   => 'row_page_subtitle_styles_2',
            'parent' => $group_page_subtitle_styles,
            'next'   => true
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'page_subtitle_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'fleur'),
            'parent'        => $row_page_subtitle_styles_2
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_subtitle_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'fleur'),
            'options'       => fleur_mikado_get_font_style_array(),
            'parent'        => $row_page_subtitle_styles_2
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_subtitle_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'fleur'),
            'options'       => fleur_mikado_get_font_weight_array(),
            'parent'        => $row_page_subtitle_styles_2
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_subtitle_letter_spacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_subtitle_styles_2
        ));

        $group_page_breadcrumbs_styles = fleur_mikado_add_admin_group(array(
            'name'        => 'group_page_breadcrumbs_styles',
            'title'       => esc_html__('Breadcrumbs', 'fleur'),
            'description' => esc_html__('Define styles for page breadcrumbs', 'fleur'),
            'parent'      => $panel_typography
        ));

        $row_page_breadcrumbs_styles_1 = fleur_mikado_add_admin_row(array(
            'name'   => 'row_page_breadcrumbs_styles_1',
            'parent' => $group_page_breadcrumbs_styles
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'page_breadcrumb_color',
            'default_value' => '',
            'label'         => esc_html__('Text Color', 'fleur'),
            'parent'        => $row_page_breadcrumbs_styles_1
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_breadcrumb_fontsize',
            'default_value' => '',
            'label'         => esc_html__('Font Size', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_breadcrumbs_styles_1
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_breadcrumb_lineheight',
            'default_value' => '',
            'label'         => esc_html__('Line Height', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_breadcrumbs_styles_1
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_breadcrumb_texttransform',
            'default_value' => '',
            'label'         => esc_html__('Text Transform', 'fleur'),
            'options'       => fleur_mikado_get_text_transform_array(),
            'parent'        => $row_page_breadcrumbs_styles_1
        ));

        $row_page_breadcrumbs_styles_2 = fleur_mikado_add_admin_row(array(
            'name'   => 'row_page_breadcrumbs_styles_2',
            'parent' => $group_page_breadcrumbs_styles,
            'next'   => true
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'fontsimple',
            'name'          => 'page_breadcrumb_google_fonts',
            'default_value' => '-1',
            'label'         => esc_html__('Font Family', 'fleur'),
            'parent'        => $row_page_breadcrumbs_styles_2
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_breadcrumb_fontstyle',
            'default_value' => '',
            'label'         => esc_html__('Font Style', 'fleur'),
            'options'       => fleur_mikado_get_font_style_array(),
            'parent'        => $row_page_breadcrumbs_styles_2
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'selectblanksimple',
            'name'          => 'page_breadcrumb_fontweight',
            'default_value' => '',
            'label'         => esc_html__('Font Weight', 'fleur'),
            'options'       => fleur_mikado_get_font_weight_array(),
            'parent'        => $row_page_breadcrumbs_styles_2
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'page_breadcrumb_letter_spacing',
            'default_value' => '',
            'label'         => esc_html__('Letter Spacing', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_page_breadcrumbs_styles_2
        ));

        $row_page_breadcrumbs_styles_3 = fleur_mikado_add_admin_row(array(
            'name'   => 'row_page_breadcrumbs_styles_3',
            'parent' => $group_page_breadcrumbs_styles,
            'next'   => true
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'page_breadcrumb_hovercolor',
            'default_value' => '',
            'label'         => esc_html__('Hover/Active Color', 'fleur'),
            'parent'        => $row_page_breadcrumbs_styles_3
        ));

    }

    add_action('fleur_mikado_options_map', 'fleur_mikado_title_options_map', 7);

}