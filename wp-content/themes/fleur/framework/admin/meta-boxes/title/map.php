<?php

$title_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__('Title', 'fleur'),
        'name'  => 'title_meta'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_show_title_area_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Show Title Area', 'fleur'),
        'description'   => esc_html__('Disabling this option will turn off page title area', 'fleur'),
        'parent'        => $title_meta_box,
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'fleur'),
            'yes' => esc_html__('Yes', 'fleur')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                ""    => "",
                "no"  => "#mkd_mkd_show_title_area_meta_container",
                "yes" => ""
            ),
            "show"       => array(
                ""    => "#mkd_mkd_show_title_area_meta_container",
                "no"  => "",
                "yes" => "#mkd_mkd_show_title_area_meta_container"
            )
        )
    )
);

$show_title_area_meta_container = fleur_mikado_add_admin_container(
    array(
        'parent'          => $title_meta_box,
        'name'            => 'mkd_show_title_area_meta_container',
        'hidden_property' => 'mkd_show_title_area_meta',
        'hidden_value'    => 'no'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_type_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Title Area Type', 'fleur'),
        'description'   => esc_html__('Choose title type', 'fleur'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''           => '',
            'standard'   => esc_html__('Standard', 'fleur'),
            'breadcrumb' => esc_html__('Breadcrumb', 'fleur')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                "standard"   => "",
                "standard"   => "",
                "breadcrumb" => "#mkd_mkd_title_area_type_meta_container"
            ),
            "show"       => array(
                ""           => "#mkd_mkd_title_area_type_meta_container",
                "standard"   => "#mkd_mkd_title_area_type_meta_container",
                "breadcrumb" => ""
            )
        )
    )
);

$title_area_type_meta_container = fleur_mikado_add_admin_container(
    array(
        'parent'          => $show_title_area_meta_container,
        'name'            => 'mkd_title_area_type_meta_container',
        'hidden_property' => 'mkd_title_area_type_meta',
        'hidden_value'    => '',
        'hidden_values'   => array('breadcrumb'),
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_enable_breadcrumbs_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Enable Breadcrumbs', 'fleur'),
        'description'   => esc_html__('This option will display Breadcrumbs in Title Area', 'fleur'),
        'parent'        => $title_area_type_meta_container,
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'fleur'),
            'yes' => esc_html('Yes', 'fleur')
        ),
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_animation_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Animations', 'fleur'),
        'description'   => esc_html__('Choose an animation for Title Area', 'fleur'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''           => '',
            'no'         => esc_html__('No Animation', 'fleur'),
            'right-left' => esc_html__('Text right to left', 'fleur'),
            'left-right' => esc_html__('Text left to right', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_vertial_alignment_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Vertical Alignment', 'fleur'),
        'description'   => esc_html__('Specify title vertical alignment', 'fleur'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''              => '',
            'header_bottom' => esc_html__('From Bottom of Header', 'fleur'),
            'window_top'    => esc_html__('From Window Top', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_content_alignment_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Horizontal Alignment', 'fleur'),
        'description'   => esc_html__('Specify title horizontal alignment', 'fleur'),
        'parent'        => $show_title_area_meta_container,
        'options'       => array(
            ''       => '',
            'left'   => esc_html__('Left', 'fleur'),
            'center' => esc_html__('Center', 'fleur'),
            'right'  => esc_html__('Right', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_title_text_color_meta',
        'type'        => 'color',
        'label'       => esc_html__('Title Color', 'fleur'),
        'description' => esc_html__('Choose a color for title text', 'fleur'),
        'parent'      => $show_title_area_meta_container
    )
);

fleur_mikado_add_meta_box_field(
	array(
		'name'        => 'mkd_title_separator_color_meta',
		'type'        => 'color',
		'label'       => esc_html__('Separator Color', 'fleur'),
		'description' => esc_html__('Choose a separaotr color for title section', 'fleur'),
		'parent'      => $show_title_area_meta_container
	)
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_title_breadcrumb_color_meta',
        'type'        => 'color',
        'label'       => esc_html__('Breadcrumb Color', 'fleur'),
        'description' => esc_html__('Choose a color for breadcrumb text', 'fleur'),
        'parent'      => $show_title_area_meta_container
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_title_area_background_color_meta',
        'type'        => 'color',
        'label'       => esc_html__('Background Color', 'fleur'),
        'description' => esc_html__('Choose a background color for Title Area', 'fleur'),
        'parent'      => $show_title_area_meta_container
    )
);

fleur_mikado_add_meta_box_field(
	array(
		'name'        => 'mkd_title_area_disable_border_meta',
		'type'          => 'yesno',
		'default_value' => 'no',
		'label'       => esc_html__('Disable Border', 'fleur'),
		'description' => esc_html__('Disable border below Title Area', 'fleur'),
		'parent'      => $show_title_area_meta_container
	)
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_hide_background_image_meta',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Hide Background Image', 'fleur'),
        'description'   => esc_html__('Enable this option to hide background image in Title Area', 'fleur'),
        'parent'        => $show_title_area_meta_container,
        'args'          => array(
            "dependence"             => true,
            "dependence_hide_on_yes" => "#mkd_mkd_hide_background_image_meta_container",
            "dependence_show_on_yes" => ""
        )
    )
);

$hide_background_image_meta_container = fleur_mikado_add_admin_container(
    array(
        'parent'          => $show_title_area_meta_container,
        'name'            => 'mkd_hide_background_image_meta_container',
        'hidden_property' => 'mkd_hide_background_image_meta',
        'hidden_value'    => 'yes'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_title_area_background_image_meta',
        'type'        => 'image',
        'label'       => esc_html__('Background Image', 'fleur'),
        'description' => esc_html__('Choose an Image for Title Area', 'fleur'),
        'parent'      => $hide_background_image_meta_container
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_background_image_responsive_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Background Responsive Image', 'fleur'),
        'description'   => esc_html__('Enabling this option will make Title background image responsive', 'fleur'),
        'parent'        => $hide_background_image_meta_container,
        'options'       => array(
            ''    => '',
            'no'  => esc_html__('No', 'fleur'),
            'yes' => esc_html__('Yes', 'fleur')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                ""    => "",
                "no"  => "",
                "yes" => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta"
            ),
            "show"       => array(
                ""    => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta",
                "no"  => "#mkd_mkd_title_area_background_image_responsive_meta_container, #mkd_mkd_title_area_height_meta",
                "yes" => ""
            )
        )
    )
);

$title_area_background_image_responsive_meta_container = fleur_mikado_add_admin_container(
    array(
        'parent'          => $hide_background_image_meta_container,
        'name'            => 'mkd_title_area_background_image_responsive_meta_container',
        'hidden_property' => 'mkd_title_area_background_image_responsive_meta',
        'hidden_value'    => 'yes'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_title_area_background_image_parallax_meta',
        'type'          => 'select',
        'default_value' => '',
        'label'         => esc_html__('Background Image in Parallax', 'fleur'),
        'description'   => esc_html__('Enabling this option will make Title background image parallax', 'fleur'),
        'parent'        => $title_area_background_image_responsive_meta_container,
        'options'       => array(
            ''         => '',
            'no'       => esc_html__('No', 'fleur'),
            'yes'      => esc_html__('Yes', 'fleur'),
            'yes_zoom' => esc_html__('Yes, with zoom out', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(array(
    'name'        => 'mkd_title_area_height_meta',
    'type'        => 'text',
    'label'       => esc_html__('Height', 'fleur'),
    'description' => esc_html__('Set a height for Title Area', 'fleur'),
    'parent'      => $show_title_area_meta_container,
    'args'        => array(
        'col_width' => 2,
        'suffix'    => 'px'
    )
));

fleur_mikado_add_meta_box_field(array(
    'name'          => 'mkd_title_area_subtitle_meta',
    'type'          => 'text',
    'default_value' => '',
    'label'         => esc_html__('Subtitle Text', 'fleur'),
    'description'   => esc_html__('Enter your subtitle text', 'fleur'),
    'parent'        => $show_title_area_meta_container,
    'args'          => array(
        'col_width' => 6
    )
));

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_subtitle_color_meta',
        'type'        => 'color',
        'label'       => esc_html__('Subtitle Color', 'fleur'),
        'description' => esc_html__('Choose a color for subtitle text', 'fleur'),
        'parent'      => $show_title_area_meta_container
    )
);