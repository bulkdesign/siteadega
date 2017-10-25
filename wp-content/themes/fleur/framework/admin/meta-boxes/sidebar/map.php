<?php

$custom_sidebars = fleur_mikado_get_custom_sidebars();

$sidebar_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__('Sidebar', 'fleur'),
        'name'  => 'sidebar_meta'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_sidebar_meta',
        'type'        => 'select',
        'label'       => esc_html__('Layout', 'fleur'),
        'description' => esc_html__('Choose the sidebar layout', 'fleur'),
        'parent'      => $sidebar_meta_box,
        'options'     => array(
            ''                 => esc_html__('Default', 'fleur'),
            'no-sidebar'       => esc_html__('No Sidebar', 'fleur'),
            'sidebar-33-right' => esc_html__('Sidebar 1/3 Right', 'fleur'),
            'sidebar-25-right' => esc_html__('Sidebar 1/4 Right', 'fleur'),
            'sidebar-33-left'  => esc_html__('Sidebar 1/3 Left', 'fleur'),
            'sidebar-25-left'  => esc_html__('Sidebar 1/4 Left', 'fleur'),
        )
    )
);

if(count($custom_sidebars) > 0) {
    fleur_mikado_add_meta_box_field(array(
        'name'        => 'mkd_custom_sidebar_meta',
        'type'        => 'selectblank',
        'label'       => esc_html__('Choose Widget Area in Sidebar', 'fleur'),
        'description' => esc_html__('Choose Custom Widget area to display in Sidebar"', 'fleur'),
        'parent'      => $sidebar_meta_box,
        'options'     => $custom_sidebars
    ));
}
