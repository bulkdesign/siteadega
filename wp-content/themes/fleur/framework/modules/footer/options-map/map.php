<?php

if(!function_exists('fleur_mikado_footer_options_map')) {
    /**
     * Add footer options
     */
    function fleur_mikado_footer_options_map() {

        fleur_mikado_add_admin_page(
            array(
                'slug'  => '_footer_page',
                'title' => esc_html__('Footer', 'fleur'),
                'icon'  => 'icon_cone_alt'
            )
        );

        $footer_panel = fleur_mikado_add_admin_panel(
            array(
                'title' => esc_html__('Footer', 'fleur'),
                'name'  => 'footer',
                'page'  => '_footer_page'
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__('Uncovering Footer', 'fleur'),
                'description'   => esc_html__('Enabling this option will make Footer gradually appear on scroll', 'fleur'),
                'parent'        => $footer_panel,
            )
        );
        fleur_mikado_add_admin_field(
            array(
                'parent'        => $footer_panel,
                'type'          => 'select',
                'name'          => 'footer_style',
                'default_value' => '',
                'label'         => esc_html__('Footer Skin', 'fleur'),
                'description'   => esc_html__('Choose Footer Skin for Footer Area', 'fleur'),
                'options'       => array(
                    ''             => '',
                    'dark-footer'  => esc_html__('Dark', 'fleur'),
                    'light-footer' => esc_html__('Light', 'fleur')
                )
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'footer_background_image',
                'type'        => 'image',
                'label'       => esc_html__('Background Image', 'fleur'),
                'description' => esc_html__('Choose Background Image for Footer Area', 'fleur'),
                'parent'      => $footer_panel
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'footer_in_grid',
                'default_value' => 'yes',
                'label'         => esc_html__('Footer in Grid', 'fleur'),
                'description'   => esc_html__('Enabling this option will place Footer content in grid', 'fleur'),
                'parent'        => $footer_panel,
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'show_footer_top',
                'default_value' => 'yes',
                'label'         => esc_html__('Show Footer Top', 'fleur'),
                'description'   => esc_html__('Enabling this option will show Footer Top area', 'fleur'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_show_footer_top_container'
                ),
                'parent'        => $footer_panel,
            )
        );

        $show_footer_top_container = fleur_mikado_add_admin_container(
            array(
                'name'            => 'show_footer_top_container',
                'hidden_property' => 'show_footer_top',
                'hidden_value'    => 'no',
                'parent'          => $footer_panel
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_top_columns',
                'default_value' => '4',
                'label'         => esc_html__('Footer Top Columns', 'fleur'),
                'description'   => esc_html__('Choose number of columns for Footer Top area', 'fleur'),
                'options'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '5' => '3(25%+25%+50%)',
                    '6' => '3(50%+25%+25%)',
                    '4' => '4'
                ),
                'parent'        => $show_footer_top_container,
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_top_columns_alignment',
                'default_value' => '',
                'label'         => esc_html__('Footer Top Columns Alignment', 'fleur'),
                'description'   => esc_html__('Text Alignment in Footer Columns', 'fleur'),
                'options'       => array(
                    'left'   => esc_html__('Left', 'fleur'),
                    'center' => esc_html__('Center', 'fleur'),
                    'right'  => esc_html__('Right', 'fleur')
                ),
                'parent'        => $show_footer_top_container,
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'show_footer_bottom',
                'default_value' => 'yes',
                'label'         => esc_html__('Show Footer Bottom', 'fleur'),
                'description'   => esc_html__('Enabling this option will show Footer Bottom area', 'fleur'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_show_footer_bottom_container'
                ),
                'parent'        => $footer_panel,
            )
        );

        $show_footer_bottom_container = fleur_mikado_add_admin_container(
            array(
                'name'            => 'show_footer_bottom_container',
                'hidden_property' => 'show_footer_bottom',
                'hidden_value'    => 'no',
                'parent'          => $footer_panel
            )
        );


        fleur_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_bottom_columns',
                'default_value' => '3',
                'label'         => esc_html__('Footer Bottom Columns', 'fleur'),
                'description'   => esc_html__('Choose number of columns for Footer Bottom area', 'fleur'),
                'options'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3'
                ),
                'parent'        => $show_footer_bottom_container,
            )
        );

		fleur_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_bottom_separator',
				'default_value' => 'yes',
				'label'         => esc_html__('Footer Bottom Separator', 'fleur'),
				'description'   => esc_html__('Enabling this option will show separator between Footer Top and Bottom areas', 'fleur'),
				'parent'        => $show_footer_bottom_container,
			)
		);


	}

    add_action('fleur_mikado_options_map', 'fleur_mikado_footer_options_map');

}