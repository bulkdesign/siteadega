<?php

if(!function_exists('fleur_mikado_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function fleur_mikado_register_sidebars() {

        register_sidebar(array(
            'name'          => esc_html__('Sidebar', 'fleur'),
            'id'            => 'sidebar',
            'description'   => esc_html__('Default Sidebar', 'fleur'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="mkd-widget-title-holder"><span class="mkd-widget-title">',
            'after_title'   => '</span></h4>'
        ));

    }

    add_action('widgets_init', 'fleur_mikado_register_sidebars');
}

if(!function_exists('fleur_mikado_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates FleurMikadoSidebar object
     */
    function fleur_mikado_add_support_custom_sidebar() {
        add_theme_support('FleurMikadoSidebar');
        if(get_theme_support('FleurMikadoSidebar')) {
            new FleurMikadoSidebar();
        }
    }

    add_action('after_setup_theme', 'fleur_mikado_add_support_custom_sidebar');
}
