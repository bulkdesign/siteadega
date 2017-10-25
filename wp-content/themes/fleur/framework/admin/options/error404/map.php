<?php

if(!function_exists('fleur_mikado_error_404_options_map')) {

    function fleur_mikado_error_404_options_map() {

        fleur_mikado_add_admin_page(array(
            'slug'  => '__404_error_page',
            'title' => esc_html__('404 Error Page', 'fleur'),
            'icon'  => 'icon_info_alt'
        ));

        $panel_404_options = fleur_mikado_add_admin_panel(array(
            'page'  => '__404_error_page',
            'name'  => 'panel_404_options',
            'title' => esc_html__('404 Page Option', 'fleur')
        ));

        fleur_mikado_add_admin_field(array(
            'parent'        => $panel_404_options,
            'type'          => 'text',
            'name'          => '404_title',
            'default_value' => '',
            'label'         => esc_html__('Title', 'fleur'),
            'description'   => esc_html__('Enter title for 404 page', 'fleur')
        ));

        fleur_mikado_add_admin_field(array(
            'parent'        => $panel_404_options,
            'type'          => 'text',
            'name'          => '404_text',
            'default_value' => '',
            'label'         => esc_html__('Text', 'fleur'),
            'description'   => esc_html__('Enter text for 404 page', 'fleur')
        ));

        fleur_mikado_add_admin_field(array(
            'parent'        => $panel_404_options,
            'type'          => 'text',
            'name'          => '404_back_to_home',
            'default_value' => '',
            'label'         => esc_html__('Back to Home Button Label', 'fleur'),
            'description'   => esc_html__('Enter label for "Back to Home" button', 'fleur')
        ));

    }

    add_action('fleur_mikado_options_map', 'fleur_mikado_error_404_options_map', 17);

}