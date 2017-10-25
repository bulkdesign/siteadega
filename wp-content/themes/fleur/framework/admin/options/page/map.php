<?php

if(!function_exists('fleur_mikado_page_options_map')) {

    function fleur_mikado_page_options_map() {

        fleur_mikado_add_admin_page(
            array(
                'slug'  => '_page_page',
                'title' => esc_html__('Page', 'fleur'),
                'icon'  => 'icon_document_alt'
            )
        );

        $custom_sidebars = fleur_mikado_get_custom_sidebars();

        $panel_sidebar = fleur_mikado_add_admin_panel(
            array(
                'page'  => '_page_page',
                'name'  => 'panel_sidebar',
                'title' => esc_html__('Design Style', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(array(
            'name'          => 'page_sidebar_layout',
            'type'          => 'select',
            'label'         => esc_html__('Sidebar Layout', 'fleur'),
            'description'   => esc_html__('Choose a sidebar layout for pages', 'fleur'),
            'default_value' => 'default',
            'parent'        => $panel_sidebar,
            'options'       => array(
                'default'          => esc_html__('No Sidebar', 'fleur'),
                'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'fleur'),
                'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'fleur'),
                'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'fleur'),
                'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'fleur')
            )
        ));


        if(count($custom_sidebars) > 0) {
            fleur_mikado_add_admin_field(array(
                'name'        => 'page_custom_sidebar',
                'type'        => 'selectblank',
                'label'       => esc_html__('Sidebar to Display', 'fleur'),
                'description' => esc_html__('Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'fleur'),
                'parent'      => $panel_sidebar,
                'options'     => $custom_sidebars
            ));
        }

        fleur_mikado_add_admin_field(array(
            'name'          => 'page_show_likes',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Likes', 'fleur'),
            'description'   => esc_html__('Enabling this option will show likes on your page', 'fleur'),
            'default_value' => 'no',
            'parent'        => $panel_sidebar
        ));

        fleur_mikado_add_admin_field(array(
            'name'          => 'page_show_comments',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Comments', 'fleur'),
            'description'   => esc_html__('Enabling this option will show comments on your page', 'fleur'),
            'default_value' => 'yes',
            'parent'        => $panel_sidebar
        ));

    }

    add_action('fleur_mikado_options_map', 'fleur_mikado_page_options_map', 9);

}