<?php

$general_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__('General', 'fleur'),
        'name'  => 'general_meta'
    )
);


fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_page_background_color_meta',
        'type'          => 'color',
        'default_value' => '',
        'label'         => esc_html__('Page Background Color', 'fleur'),
        'description'   => esc_html__('Choose background color for page content', 'fleur'),
        'parent'        => $general_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_page_padding_meta',
        'type'          => 'text',
        'default_value' => '',
        'label'         => esc_html__('Page Padding', 'fleur'),
        'description'   => esc_html__('Insert padding in format 10px 10px 10px 10px', 'fleur'),
        'parent'        => $general_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_page_content_behind_header_meta',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Always put content behind header', 'fleur'),
        'description'   => esc_html__('Enabling this option will put page content behind page header', 'fleur'),
        'parent'        => $general_meta_box,
        'args'          => array(
            'suffix' => 'px'
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_page_slider_meta',
        'type'          => 'text',
        'default_value' => '',
        'label'         => esc_html__('Slider Shortcode', 'fleur'),
        'description'   => esc_html__('Paste your slider shortcode here', 'fleur'),
        'parent'        => $general_meta_box
    )
);

fleur_mikado_add_meta_box_field(
	array(
		'name'          => 'mkd_smooth_page_transitions_meta',
		'type'          => 'select',
		'default_value' => '',
		'label'         => esc_html__( 'Smooth Page Transitions', 'fleur' ),
		'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'fleur' ),
		'parent'        => $general_meta_box,
		'options'     => fleur_mikado_get_yes_no_select_array(),
		'args'          => array(
			"dependence"             => true,
			"hide"       => array(
				""    => "#mkd_page_transitions_container_meta",
				"no"  => "#mkd_page_transitions_container_meta",
				"yes" => ""
			),
			"show"       => array(
				""    => "",
				"no"  => "",
				"yes" => "#mkd_page_transitions_container_meta"
			)
		)
	)
);

$page_transitions_container_meta = fleur_mikado_add_admin_container(
	array(
		'parent'          => $general_meta_box,
		'name'            => 'page_transitions_container_meta',
		'hidden_property' => 'mkd_smooth_page_transitions_meta',
		'hidden_values'   => array('','no')
	)
);

fleur_mikado_add_meta_box_field(
	array(
		'name'          => 'mkd_page_transition_preloader_meta',
		'type'          => 'select',
		'default_value' => '',
		'label'         => esc_html__( 'Enable Preloading Animation', 'fleur' ),
		'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'fleur' ),
		'parent'        => $page_transitions_container_meta,
		'options'     => fleur_mikado_get_yes_no_select_array(),
		'args'          => array(
			"dependence"             => true,
			"hide"       => array(
				""    => "#mkd_page_transition_preloader_container_meta",
				"no"  => "#mkd_page_transition_preloader_container_meta",
				"yes" => ""
			),
			"show"       => array(
				""    => "",
				"no"  => "",
				"yes" => "#mkd_page_transition_preloader_container_meta"
			)
		)
	)
);

$page_transition_preloader_container_meta = fleur_mikado_add_admin_container(
	array(
		'parent'          => $page_transitions_container_meta,
		'name'            => 'page_transition_preloader_container_meta',
		'hidden_property' => 'mkd_page_transition_preloader_meta',
		'hidden_values'   => array('','no')
	)
);

fleur_mikado_add_meta_box_field(
	array(
		'name'   => 'mkd_smooth_pt_bgnd_color_meta',
		'type'   => 'color',
		'label'  => esc_html__( 'Page Loader Background Color', 'fleur' ),
		'parent' => $page_transition_preloader_container_meta
	)
);

$group_pt_spinner_animation_meta = fleur_mikado_add_admin_group(
	array(
		'name'        => 'group_pt_spinner_animation_meta',
		'title'       => esc_html__( 'Loader Style', 'fleur' ),
		'description' => esc_html__( 'Define styles for loader spinner animation', 'fleur' ),
		'parent'      => $page_transition_preloader_container_meta
	)
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_page_likes_meta',
        'type'        => 'selectblank',
        'label'       => esc_html__('Show Likes', 'fleur'),
        'description' => esc_html__('Enabling this option will show likes on your page', 'fleur'),
        'parent'      => $general_meta_box,
        'options'     => array(
            'yes' => esc_html__('Yes', 'fleur'),
            'no'  => esc_html__('No', 'fleur'),
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_page_comments_meta',
        'type'        => 'selectblank',
        'label'       => esc_html__('Show Comments', 'fleur'),
        'description' => esc_html__('Enabling this option will show comments on your page', 'fleur'),
        'parent'      => $general_meta_box,
        'options'     => array(
            'yes' => esc_html__('Yes', 'fleur'),
            'no'  => esc_html__('No', 'fleur'),
        )
    )
);

fleur_mikado_add_meta_box_field(
	array(
		'name'          => 'mkd_boxed_meta',
		'type'          => 'select',
		'default_value' => '',
		'label'         => esc_html__('Boxed Layout', 'fleur'),
		'parent'        => $general_meta_box,
		'options'     => array(
			'' => '',
			'yes' => esc_html__('Yes', 'fleur'),
			'no' => esc_html__('No', 'fleur'),
		),
		'args'          => array(
			"dependence" => true,
			'show' => array(
				'' => '',
				'yes' => '#mkd_mkd_boxed_container_meta',
				'no' => '',

			),
			'hide' => array(
				'' => '#mkd_mkd_boxed_container_meta',
				'yes' => '',
				'no' => '#mkd_mkd_boxed_container_meta',
			)
		)
	)
);

$boxed_container = fleur_mikado_add_admin_container(
	array(
		'parent'            => $general_meta_box,
		'name'              => 'mkd_boxed_container_meta',
		'hidden_property'   => 'mkd_boxed_meta',
		'hidden_values'     => array('','no')
	)
);

fleur_mikado_add_meta_box_field(
	array(
		'name'        => 'mkd_page_background_color_in_box_meta',
		'type'        => 'color',
		'label'       => esc_html__('Page Background Color', 'fleur'),
		'description' => esc_html__('Choose the page background color outside box.', 'fleur'),
		'parent'      => $boxed_container
	)
);

fleur_mikado_add_meta_box_field(
	array(
		'name'        => 'mkd_boxed_pattern_background_image_meta',
		'type'        => 'image',
		'label'       => esc_html__('Background Pattern', 'fleur'),
		'description' => esc_html__('Choose an image to be used as background pattern', 'fleur'),
		'parent'      => $boxed_container
	)
);

fleur_mikado_add_meta_box_field(
	array(
		'name'        => 'mkd_boxed_background_image_meta',
		'type'        => 'image',
		'label'       => esc_html__('Background Image', 'fleur'),
		'description' => esc_html__('Choose an image to be displayed in background', 'fleur'),
		'parent'      => $boxed_container,
	)
);

fleur_mikado_add_meta_box_field(
	array(
		'name'          => 'mkd_boxed_background_image_attachment_meta',
		'type'          => 'select',
		'default_value' => 'fixed',
		'label'         => esc_html__('Background Image Attachment', 'fleur'),
		'description'   => esc_html__('Choose background image attachment if background image option is set', 'fleur'),
		'parent'        => $boxed_container,
		'options'       => array(
			'fixed'  => esc_html__('Fixed', 'fleur'),
			'scroll' => esc_html__('Scroll', 'fleur')
		)
	)
);