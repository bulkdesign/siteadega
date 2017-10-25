<?php

if(!function_exists('fleur_mikado_map_portfolio_settings')) {
    function fleur_mikado_map_portfolio_settings() {
        $meta_box = fleur_mikado_add_meta_box(array(
            'scope' => 'portfolio-item',
            'title' => esc_html__('Portfolio Settings', 'fleur'),
            'name'  => 'portfolio_settings_meta_box'
        ));

        fleur_mikado_add_meta_box_field(array(
            'name'        => 'mkd_portfolio_single_template_meta',
            'type'        => 'select',
            'label'       => esc_html__('Portfolio Type', 'fleur'),
            'description' => esc_html__('Choose a default type for Single Project pages', 'fleur'),
            'parent'      => $meta_box,
            'options'     => array(
                ''                  => esc_html__('Default', 'fleur'),
                'small-images'      => esc_html__('Portfolio small images', 'fleur'),
                'small-slider'      => esc_html__('Portfolio small slider', 'fleur'),
                'big-images'        => esc_html__('Portfolio big images', 'fleur'),
                'big-slider'        => esc_html__('Portfolio big slider', 'fleur'),
                'custom'            => esc_html__('Portfolio custom', 'fleur'),
                'full-width-custom' => esc_html__('Portfolio full width custom', 'fleur'),
                'masonry'           => esc_html__('Portfolio masonry', 'fleur'),
                'gallery'           => esc_html__('Portfolio gallery', 'fleur')
            )
        ));

        $all_pages = array();
        $pages     = get_pages();
        foreach($pages as $page) {
            $all_pages[$page->ID] = $page->post_title;
        }

        fleur_mikado_add_meta_box_field(array(
            'name'        => 'portfolio_single_back_to_link',
            'type'        => 'select',
            'label'       => esc_html__('"Back To" Link', 'fleur'),
            'description' => esc_html__('Choose "Back To" page to link from portfolio Single Project page', 'fleur'),
            'parent'      => $meta_box,
            'options'     => $all_pages
        ));

        $group_portfolio_external_link = fleur_mikado_add_admin_group(array(
            'name'        => 'group_portfolio_external_link',
            'title'       => esc_html__('Portfolio External Link', 'fleur'),
            'description' => esc_html__('Enter URL to link from Portfolio List page', 'fleur'),
            'parent'      => $meta_box
        ));

        $row_portfolio_external_link = fleur_mikado_add_admin_row(array(
            'name'   => 'row_gradient_overlay',
            'parent' => $group_portfolio_external_link
        ));

        fleur_mikado_add_meta_box_field(array(
            'name'        => 'portfolio_external_link',
            'type'        => 'textsimple',
            'label'       => esc_html__('Link', 'fleur'),
            'description' => '',
            'parent'      => $row_portfolio_external_link,
            'args'        => array(
                'col_width' => 3
            )
        ));

        fleur_mikado_add_meta_box_field(array(
            'name'        => 'portfolio_external_link_target',
            'type'        => 'selectsimple',
            'label'       => esc_html__('Target', 'fleur'),
            'description' => '',
            'parent'      => $row_portfolio_external_link,
            'options'     => array(
                '_self'  => esc_html__('Same Window', 'fleur'),
                '_blank' => esc_html__('New Window', 'fleur')
            )
        ));


        fleur_mikado_add_meta_box_field(array(
            'name'        => 'portfolio_masonry_dimenisions',
            'type'        => 'select',
            'label'       => esc_html__('Dimensions for Masonry', 'fleur'),
            'description' => esc_html__('Choose image layout when it appears in Masonry type portfolio lists', 'fleur'),
            'parent'      => $meta_box,
            'options'     => array(
                'default'            => esc_html__('Default', 'fleur'),
                'large_width'        => esc_html__('Large width', 'fleur'),
                'large_height'       => esc_html__('Large height', 'fleur'),
                'large_width_height' => esc_html__('Large width/height', 'fleur')
            )
        ));
    }

    add_action('fleur_mikado_meta_boxes_map', 'fleur_mikado_map_portfolio_settings');
}