<?php

if(!function_exists('fleur_mikado_reset_options_map')) {
    /**
     * Reset options panel
     */
    function fleur_mikado_reset_options_map() {

        fleur_mikado_add_admin_page(
            array(
                'slug'  => '_reset_page',
                'title' => esc_html__('Reset', 'fleur'),
                'icon'  => 'icon_refresh'
            )
        );

        $panel_reset = fleur_mikado_add_admin_panel(
            array(
                'page'  => '_reset_page',
                'name'  => 'panel_reset',
                'title' => esc_html__('Reset', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(array(
            'type'          => 'yesno',
            'name'          => 'reset_to_defaults',
            'default_value' => 'no',
            'label'         => esc_html__('Reset to Defaults', 'fleur'),
            'description'   => esc_html__('This option will reset all Mikado Options values to defaults', 'fleur'),
            'parent'        => $panel_reset
        ));

    }

    add_action('fleur_mikado_options_map', 'fleur_mikado_reset_options_map', 19);

}