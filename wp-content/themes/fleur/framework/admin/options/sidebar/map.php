<?php

if(!function_exists('fleur_mikado_sidebar_options_map')) {

    function fleur_mikado_sidebar_options_map() {

        $panel_widgets = fleur_mikado_add_admin_panel(
            array(
                'page'  => '_page_page',
                'name'  => 'panel_widgets',
                'title' => esc_html__('Widgets', 'fleur')
            )
        );

        /**
         * Navigation style
         */
        fleur_mikado_add_admin_field(array(
            'type'          => 'color',
            'name'          => 'sidebar_background_color',
            'default_value' => '',
            'label'         => esc_html__('Sidebar Background Color', 'fleur'),
            'description'   => esc_html__('Choose background color for sidebar', 'fleur'),
            'parent'        => $panel_widgets
        ));

        $group_sidebar_padding = fleur_mikado_add_admin_group(array(
            'name'   => 'group_sidebar_padding',
            'title'  => esc_html__('Padding', 'fleur'),
            'parent' => $panel_widgets
        ));

        $row_sidebar_padding = fleur_mikado_add_admin_row(array(
            'name'   => 'row_sidebar_padding',
            'parent' => $group_sidebar_padding
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'sidebar_padding_top',
            'default_value' => '',
            'label'         => esc_html__('Top Padding', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_sidebar_padding
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'sidebar_padding_right',
            'default_value' => '',
            'label'         => esc_html__('Right Padding', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_sidebar_padding
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'sidebar_padding_bottom',
            'default_value' => '',
            'label'         => esc_html__('Bottom Padding', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_sidebar_padding
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'textsimple',
            'name'          => 'sidebar_padding_left',
            'default_value' => '',
            'label'         => esc_html__('Left Padding', 'fleur'),
            'args'          => array(
                'suffix' => 'px'
            ),
            'parent'        => $row_sidebar_padding
        ));

        fleur_mikado_add_admin_field(array(
            'type'          => 'select',
            'name'          => 'sidebar_alignment',
            'default_value' => '',
            'label'         => esc_html__('Text Alignment', 'fleur'),
            'description'   => esc_html__('Choose text aligment', 'fleur'),
            'options'       => array(
                'left'   => esc_html__('Left', 'fleur'),
                'center' => esc_html__('Center', 'fleur'),
                'right'  => esc_html__('Right', 'fleur')
            ),
            'parent'        => $panel_widgets
        ));

    }

    add_action('fleur_mikado_options_map', 'fleur_mikado_sidebar_options_map');

}