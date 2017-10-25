<?php

if(!function_exists('fleur_mikado_content_bottom_options_map')) {

    function fleur_mikado_content_bottom_options_map() {

        fleur_mikado_add_admin_page(
            array(
                'slug'  => '_content_bottom_page',
                'title' => esc_html__('Content Bottom', 'fleur'),
                'icon'  => 'arrow_carrot-2down'
            )
        );

        $panel_content_bottom = fleur_mikado_add_admin_panel(
            array(
                'page'  => '_content_bottom_page',
                'name'  => 'panel_content_bottom',
                'title' => esc_html__('Content Bottom Area', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(array(
            'name'          => 'enable_content_bottom_area',
            'type'          => 'yesno',
            'default_value' => 'no',
            'label'         => esc_html__('Enable Content Bottom Area', 'fleur'),
            'description'   => esc_html__('This option will enable Content Bottom area on pages', 'fleur'),
            'args'          => array(
                'dependence'             => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_enable_content_bottom_area_container'
            ),
            'parent'        => $panel_content_bottom
        ));

        $enable_content_bottom_area_container = fleur_mikado_add_admin_container(
            array(
                'parent'          => $panel_content_bottom,
                'name'            => 'enable_content_bottom_area_container',
                'hidden_property' => 'enable_content_bottom_area',
                'hidden_value'    => 'no'
            )
        );

        $custom_sidebars = fleur_mikado_get_custom_sidebars();

        fleur_mikado_add_admin_field(array(
            'type'          => 'selectblank',
            'name'          => 'content_bottom_sidebar_custom_display',
            'default_value' => '',
            'label'         => esc_html__('Widget Area to Display', 'fleur'),
            'description'   => esc_html__('Choose a Content Bottom widget area to display', 'fleur'),
            'options'       => $custom_sidebars,
            'parent'        => $enable_content_bottom_area_container
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'yesno',
            'name'          => 'content_bottom_in_grid',
            'default_value' => 'yes',
            'label'         => esc_html__('Display in Grid', 'fleur'),
            'description'   => esc_html__('Enabling this option will place Content Bottom in grid', 'fleur'),
            'parent'        => $enable_content_bottom_area_container
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'content_bottom_background_color',
            'default_value' => '',
            'label'         => esc_html__('Background Color', 'fleur'),
            'description'   => esc_html__('Choose a background color for Content Bottom area', 'fleur'),
            'parent'        => $enable_content_bottom_area_container
        ));

    }

    add_action('fleur_mikado_options_map', 'fleur_mikado_content_bottom_options_map', 16);

}