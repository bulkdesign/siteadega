<?php

if(!function_exists('fleur_mikado_woocommerce_options_map')) {

    /**
     * Add Woocommerce options page
     */
    function fleur_mikado_woocommerce_options_map() {

        fleur_mikado_add_admin_page(
            array(
                'slug'  => '_woocommerce_page',
                'title' => esc_html__('Woocommerce', 'fleur'),
                'icon'  => 'icon_cart_alt'
            )
        );

        /**
         * Product List Settings
         */
        $panel_product_list = fleur_mikado_add_admin_panel(
            array(
                'page'  => '_woocommerce_page',
                'name'  => 'panel_product_list',
                'title' => esc_html__('Product List', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(array(
            'name'          => 'mkd_woo_products_list_full_width',
            'type'          => 'yesno',
            'label'         => esc_html__('Enable Full Width Template', 'fleur'),
            'default_value' => 'no',
            'description'   => esc_html__('Enabling this option will enable full width template for shop page', 'fleur'),
            'parent'        => $panel_product_list,
        ));

        fleur_mikado_add_admin_field(array(
            'name'          => 'mkd_woo_product_list_columns',
            'type'          => 'select',
            'label'         => esc_html__('Product List Columns', 'fleur'),
            'default_value' => 'mkd-woocommerce-columns-3',
            'description'   => esc_html__('Choose number of columns for product listing and related products on single product', 'fleur'),
            'options'       => array(
                'mkd-woocommerce-columns-3' => esc_html__('3 Columns (2 with sidebar)', 'fleur'),
                'mkd-woocommerce-columns-4' => esc_html__('4 Columns (3 with sidebar)', 'fleur')
            ),
            'parent'        => $panel_product_list,
        ));

        fleur_mikado_add_admin_field(array(
            'name'          => 'mkd_woo_products_per_page',
            'type'          => 'text',
            'label'         => esc_html__('Number of products per page', 'fleur'),
            'default_value' => '',
            'description'   => esc_html__('Set number of products on shop page', 'fleur'),
            'parent'        => $panel_product_list,
            'args'          => array(
                'col_width' => 3
            )
        ));

        fleur_mikado_add_admin_field(array(
            'name'          => 'mkd_products_list_title_tag',
            'type'          => 'select',
            'label'         => esc_html__('Products Title Tag', 'fleur'),
            'default_value' => 'h4',
            'description'   => '',
            'options'       => array(
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6',
            ),
            'parent'        => $panel_product_list,
        ));

        /**
         * Single Product Settings
         */
        $panel_single_product = fleur_mikado_add_admin_panel(
            array(
                'page'  => '_woocommerce_page',
                'name'  => 'panel_single_product',
                'title' => esc_html__('Single Product', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(array(
            'name'          => 'mkd_single_product_title_tag',
            'type'          => 'select',
            'label'         => esc_html__('Single Product Title Tag', 'fleur'),
            'default_value' => 'h1',
            'description'   => '',
            'options'       => array(
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6',
            ),
            'parent'        => $panel_single_product,
        ));
        fleur_mikado_add_admin_field(array(
            'name'          => 'hide_product_info',
            'type'          => 'yesno',
            'label'         => esc_html__('Hide Product Info', 'fleur'),
            'default_value' => 'no',
            'description'   => esc_html__('Enabling this option will hide product category, tag, SKU etc.', 'fleur'),
            'parent'        => $panel_single_product,
        ));


    }

    add_action('fleur_mikado_options_map', 'fleur_mikado_woocommerce_options_map', 19);

}