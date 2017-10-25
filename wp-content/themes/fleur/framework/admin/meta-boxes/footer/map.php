<?php

$footer_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__('Footer', 'fleur'),
        'name'  => 'footer_meta'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_enable_footer_image_meta',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Disable Footer Image for this Page', 'fleur'),
        'description'   => esc_html__('Enabling this option will hide footer image on this page', 'fleur'),
        'parent'        => $footer_meta_box,
        'args'          => array(
            'dependence'             => true,
            'dependence_hide_on_yes' => '#mkd_mkd_footer_background_image_meta',
            'dependence_show_on_yes' => ''
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_footer_style_meta',
        'label'         => esc_html__('Footer Skin', 'fleur'),
        'type'          => 'select',
        'default_value' => '',
        'description'   => esc_html__('Choose Footer Skin on single page', 'fleur'),
        'parent'        => $footer_meta_box,
        'options'       => array(
            ''               => '',
            'default-footer' => esc_html__('Default', 'fleur'),
            'dark-footer'    => esc_html__('Dark', 'fleur'),
            'light-footer'   => esc_html__('Light', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'            => 'mkd_footer_background_image_meta',
        'type'            => 'image',
        'label'           => esc_html__('Background Image', 'fleur'),
        'description'     => esc_html__('Choose Background Image for Footer Area on this page', 'fleur'),
        'parent'          => $footer_meta_box,
        'hidden_property' => 'mkd_enable_footer_background_image_meta',
        'hidden_value'    => 'yes'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'            => 'mkd_uncovering_footer_meta',
        'type'            => 'yesno',
        'default_value'   => 'no',
        'label'           => esc_html__('Enable Uncovering Footer for this Page', 'fleur'),
        'description'     => esc_html__('Enabling this option will make uncovering Footer on this page', 'fleur'),
        'parent'          => $footer_meta_box,
        'hidden_property' => 'mkd_enable_uncovering_footer_meta',
        'hidden_value'    => 'yes'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_disable_footer_top_meta',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Disable Footer Top', 'fleur'),
        'description'   => esc_html__('Enabling this option will hide footer top area on this page', 'fleur'),
        'parent'        => $footer_meta_box,
    )
);

fleur_mikado_add_meta_box_field(
	array(
		'name'          => 'mkd_disable_footer_bottom_meta',
		'type'          => 'yesno',
		'default_value' => 'no',
		'label'         => esc_html__('Disable Footer Bottom', 'fleur'),
		'description'   => esc_html__('Enabling this option will hide footer bottom area on this page', 'fleur'),
		'parent'        => $footer_meta_box,
	)
);