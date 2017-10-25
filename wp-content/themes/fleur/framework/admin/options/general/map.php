<?php

if(!function_exists('fleur_mikado_general_options_map')) {
    /**
     * General options page
     */
    function fleur_mikado_general_options_map() {

        fleur_mikado_add_admin_page(
            array(
                'slug'  => '',
                'title' => esc_html__('General', 'fleur'),
                'icon'  => 'icon_building'
            )
        );

        $panel_logo = fleur_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_logo',
                'title' => esc_html__('Branding', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'parent'        => $panel_logo,
                'type'          => 'yesno',
                'name'          => 'hide_logo',
                'default_value' => 'no',
                'label'         => esc_html__('Hide Logo', 'fleur'),
                'description'   => esc_html__('Enabling this option will hide logo image', 'fleur'),
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "#mkd_hide_logo_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $hide_logo_container = fleur_mikado_add_admin_container(
            array(
                'parent'          => $panel_logo,
                'name'            => 'hide_logo_container',
                'hidden_property' => 'hide_logo',
                'hidden_value'    => 'yes'
            )
        );

        fleur_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'standard_minimal_logo_title',
                'title'  => esc_html__('Standard, Minimal & Boxed Header Logo', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label'         => esc_html__('Logo Image - Default', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_dark',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_black.png",
                'label'         => esc_html__('Logo Image - Dark', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_light',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_white.png",
                'label'         => esc_html__('Logo Image - Light', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_sticky',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label'         => esc_html__('Logo Image - Sticky', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'divided_logo_title',
                'title'  => esc_html__('Divided Header Logo', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_divided',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_divided.png",
                'label'         => esc_html__('Logo Image - Divided', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_divided_dark',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_divided_dark.png",
                'label'         => esc_html__('Logo Image - Divided Dark', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_divided_light',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_divided_light.png",
                'label'         => esc_html__('Logo Image - Divided Light', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_divided_sticky',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_divided.png",
                'label'         => esc_html__('Logo Image - Divided Sticky', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'centered_logo_title',
                'title'  => esc_html__('Centered Header Logo', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_centered',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_centered.png",
                'label'         => esc_html__('Logo Image - Centered', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_centered_dark',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_centered_dark.png",
                'label'         => esc_html__('Logo Image - Centered Dark', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_centered_light',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_centered_light.png",
                'label'         => esc_html__('Logo Image - Centered Light', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_centered_sticky',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo_centered.png",
                'label'         => esc_html__('Logo Image - Centered Sticky', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'vertical_logo_title',
                'title'  => esc_html__('Vertical Header Logo', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_vertical',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label'         => esc_html__('Logo Image - Vertical Header', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display on vertilcal header', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        fleur_mikado_add_admin_section_title(
            array(
                'parent' => $hide_logo_container,
                'name'   => 'mobile_logo_title',
                'title'  => esc_html__('Mobile Header Logo', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_mobile',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label'         => esc_html__('Logo Image - Mobile', 'fleur'),
                'description'   => esc_html__('Choose a default logo image to display ', 'fleur'),
                'parent'        => $hide_logo_container
            )
        );

        $panel_design_style = fleur_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_design_style',
                'title' => esc_html__('Appearance', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'google_fonts',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'fleur'),
                'description'   => esc_html__('Choose a default Google font for your site', 'fleur'),
                'parent'        => $panel_design_style
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_fonts',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Additional Google Fonts', 'fleur'),
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_additional_google_fonts_container"
                )
            )
        );

        $additional_google_fonts_container = fleur_mikado_add_admin_container(
            array(
                'parent'          => $panel_design_style,
                'name'            => 'additional_google_fonts_container',
                'hidden_property' => 'additional_google_fonts',
                'hidden_value'    => 'no'
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font1',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'fleur'),
                'description'   => esc_html__('Choose additional Google font for your site', 'fleur'),
                'parent'        => $additional_google_fonts_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font2',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'fleur'),
                'description'   => esc_html__('Choose additional Google font for your site', 'fleur'),
                'parent'        => $additional_google_fonts_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font3',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'fleur'),
                'description'   => esc_html__('Choose additional Google font for your site', 'fleur'),
                'parent'        => $additional_google_fonts_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font4',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'fleur'),
                'description'   => esc_html__('Choose additional Google font for your site', 'fleur'),
                'parent'        => $additional_google_fonts_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font5',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'fleur'),
                'description'   => esc_html__('Choose additional Google font for your site', 'fleur'),
                'parent'        => $additional_google_fonts_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'first_color',
                'type'        => 'color',
                'label'       => esc_html__('First Main Color', 'fleur'),
                'description' => esc_html__('Choose the most dominant theme color. Default color is #d7d3db', 'fleur'),
                'parent'      => $panel_design_style
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'page_background_color',
                'type'        => 'color',
                'label'       => esc_html__('Page Background Color', 'fleur'),
                'description' => esc_html__('Choose the background color for page content. Default color is #ffffff', 'fleur'),
                'parent'      => $panel_design_style
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'selection_color',
                'type'        => 'color',
                'label'       => esc_html__('Text Selection Color', 'fleur'),
                'description' => esc_html__('Choose the color users see when selecting text', 'fleur'),
                'parent'      => $panel_design_style
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'boxed',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Boxed Layout', 'fleur'),
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_boxed_container"
                )
            )
        );

        $boxed_container = fleur_mikado_add_admin_container(
            array(
                'parent'          => $panel_design_style,
                'name'            => 'boxed_container',
                'hidden_property' => 'boxed',
                'hidden_value'    => 'no'
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'page_background_color_in_box',
                'type'        => 'color',
                'label'       => esc_html__('Page Background Color', 'fleur'),
                'description' => esc_html__('Choose the page background color outside box.', 'fleur'),
                'parent'      => $boxed_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'boxed_background_image',
                'type'        => 'image',
                'label'       => esc_html__('Background Image', 'fleur'),
                'description' => esc_html__('Choose an image to be displayed in background', 'fleur'),
                'parent'      => $boxed_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'boxed_pattern_background_image',
                'type'        => 'image',
                'label'       => esc_html__('Background Pattern', 'fleur'),
                'description' => esc_html__('Choose an image to be used as background pattern', 'fleur'),
                'parent'      => $boxed_container
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'boxed_background_image_attachment',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => esc_html__('Background Image Attachment', 'fleur'),
                'description'   => esc_html__('Choose background image attachment', 'fleur'),
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'  => 'Fixed',
                    'scroll' => 'Scroll'
                )
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'initial_content_width',
                'type'          => 'select',
                'default_value' => 'grid-1300',
                'label'         => esc_html__('Initial Width of Content', 'fleur'),
                'description'   => esc_html__('Choose the initial width of content which is in grid. Applies to pages set to "Default Template" and rows set to "In Grid"', 'fleur'),
                'parent'        => $panel_design_style,
                'options'       => array(
                    "grid-1300" => esc_html__("1300px - default", 'fleur'),
                    "grid-1200" => "1200px",
                    ""          => "1100px",
                    "grid-1000" => "1000px",
                    "grid-800"  => "800px"
                )
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'preload_pattern_image',
                'type'        => 'image',
                'label'       => esc_html__('Preload Pattern Image', 'fleur'),
                'description' => esc_html__('Choose preload pattern image to be displayed until images are loaded', 'fleur'),
                'parent'      => $panel_design_style
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'element_appear_amount',
                'type'        => 'text',
                'label'       => esc_html__('Element Appearance', 'fleur'),
                'description' => esc_html__('For animated elements, set distance (related to browser bottom) to start the animation', 'fleur'),
                'parent'      => $panel_design_style,
                'args'        => array(
                    'col_width' => 2,
                    'suffix'    => 'px'
                )
            )
        );

        $panel_settings = fleur_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_settings',
                'title' => esc_html__('Behavior', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'smooth_scroll',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Smooth Scroll', 'fleur'),
                'description'   => esc_html__('Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'fleur'),
                'parent'        => $panel_settings
            )
        );

		fleur_mikado_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'fleur' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'fleur' ),
				'parent'        => $panel_settings,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkd_page_transitions_container"
				)
			)
		);

		$page_transitions_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $panel_settings,
				'name'            => 'page_transitions_container',
				'hidden_property' => 'smooth_page_transitions',
				'hidden_value'    => 'no'
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'name'          => 'page_transition_preloader',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Preloading Animation', 'fleur' ),
				'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'fleur' ),
				'parent'        => $page_transitions_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkd_page_transition_preloader_container"
				)
			)
		);

		$page_transition_preloader_container = fleur_mikado_add_admin_container(
			array(
				'parent'          => $page_transitions_container,
				'name'            => 'page_transition_preloader_container',
				'hidden_property' => 'page_transition_preloader',
				'hidden_value'    => 'no'
			)
		);


		fleur_mikado_add_admin_field(
			array(
				'name'   => 'smooth_pt_bgnd_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Page Loader Background Color', 'fleur' ),
				'parent' => $page_transition_preloader_container
			)
		);

		$group_pt_spinner_animation = fleur_mikado_add_admin_group(
			array(
				'name'        => 'group_pt_spinner_animation',
				'title'       => esc_html__( 'Loader Style', 'fleur' ),
				'description' => esc_html__( 'Define styles for loader spinner animation', 'fleur' ),
				'parent'      => $page_transition_preloader_container
			)
		);

		$row_pt_spinner_animation = fleur_mikado_add_admin_row(
			array(
				'name'   => 'row_pt_spinner_animation',
				'parent' => $group_pt_spinner_animation
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'type'          => 'selectsimple',
				'name'          => 'smooth_pt_spinner_type',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Type', 'fleur' ),
				'parent'        => $row_pt_spinner_animation,
				'options'       => array(
                    'fleur'                 => esc_html__( 'Fleur', 'fleur' ),
                    'rotate_circles'        => esc_html__( 'Rotate Circles', 'fleur' ),
					'pulse'                 => esc_html__( 'Pulse', 'fleur' ),
					'double_pulse'          => esc_html__( 'Double Pulse', 'fleur' ),
					'cube'                  => esc_html__( 'Cube', 'fleur' ),
					'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'fleur' ),
					'stripes'               => esc_html__( 'Stripes', 'fleur' ),
					'wave'                  => esc_html__( 'Wave', 'fleur' ),
					'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'fleur' ),
					'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'fleur' ),
					'atom'                  => esc_html__( 'Atom', 'fleur' ),
					'clock'                 => esc_html__( 'Clock', 'fleur' ),
					'mitosis'               => esc_html__( 'Mitosis', 'fleur' ),
					'lines'                 => esc_html__( 'Lines', 'fleur' ),
					'fussion'               => esc_html__( 'Fussion', 'fleur' ),
					'wave_circles'          => esc_html__( 'Wave Circles', 'fleur' ),
					'pulse_circles'         => esc_html__( 'Pulse Circles', 'fleur' )
				),
                'args'          => array(
                    "dependence"             => true,
                    'show'        => array(
                        "fleur"         => "#mkd_fleur_loader_container",
                        "rotate_circles"        => "",
                        "pulse"                 => "",
                        "double_pulse"          => "",
                        "cube"                  => "",
                        "rotating_cubes"        => "",
                        "stripes"               => "",
                        "wave"                  => "",
                        "two_rotating_circles"  => "",
                        "five_rotating_circles" => "",
                        "atom"                  => "",
                        "clock"                 => "",
                        "mitosis"               => "",
                        "lines"                 => "",
                        "fussion"               => "",
                        "wave_circles"          => "",
                        "pulse_circles"         => ""
                    ),
                    'hide'        => array(
                        "fleur"         => "",
                        ""                      => "#mkd_fleur_loader_container",
                        "rotate_circles"        => "#mkd_fleur_loader_container",
                        "pulse"                 => "#mkd_fleur_loader_container",
                        "double_pulse"          => "#mkd_fleur_loader_container",
                        "cube"                  => "#mkd_fleur_loader_container",
                        "rotating_cubes"        => "#mkd_fleur_loader_container",
                        "stripes"               => "#mkd_fleur_loader_container",
                        "wave"                  => "#mkd_fleur_loader_container",
                        "two_rotating_circles"  => "#mkd_fleur_loader_container",
                        "five_rotating_circles" => "#mkd_fleur_loader_container",
                        "atom"                  => "#mkd_fleur_loader_container",
                        "clock"                 => "#mkd_fleur_loader_container",
                        "mitosis"               => "#mkd_fleur_loader_container",
                        "lines"                 => "#mkd_fleur_loader_container",
                        "fussion"               => "#mkd_fleur_loader_container",
                        "wave_circles"          => "#mkd_fleur_loader_container",
                        "pulse_circles"         => "#mkd_fleur_loader_container"
                    )
                )
			)
		);

		fleur_mikado_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'smooth_pt_spinner_color',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Color', 'fleur' ),
				'parent'        => $row_pt_spinner_animation
			)
		);

        $fleur_loader_container = fleur_mikado_add_admin_container(
            array(
                'parent'          => $page_transition_preloader_container,
                'name'            => 'fleur_loader_container',
                'hidden_property' => 'smooth_pt_spinner_type',
                'hidden_value'    => '',
                'hidden_values'   =>array(
                    "",
                    "rotate_circles",
                    "pulse",
                    "double_pulse",
                    "cube",
                    "rotating_cubes",
                    "stripes",
                    "wave",
                    "two_rotating_circles",
                    "five_rotating_circles",
                    "atom",
                    "clock",
                    "mitosis",
                    "lines",
                    "fussion",
                    "wave_circles",
                    "pulse_circles"
                )
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'type'          => 'text',
                'name'          => 'fleur_loader_logo',
                'default_value' => 'f',
                'label'         => esc_html__('Logo letter', 'fleur'),
                'description'   => esc_html__('Enter the optional logo letter', 'fleur'),
                'args' => array(
                    'col_width' => 1,
                ),
                'parent'        => $fleur_loader_container,
            )
        );

		fleur_mikado_add_admin_field(
			array(
				'name'          => 'page_transition_fadeout',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Fade Out Animation', 'fleur' ),
				'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'fleur' ),
				'parent'        => $page_transitions_container
			)
		);

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'show_back_button',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Show "Back To Top Button"', 'fleur'),
                'description'   => esc_html__('Enabling this option will display a Back to Top button on every page', 'fleur'),
                'parent'        => $panel_settings
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'          => 'responsiveness',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Responsiveness', 'fleur'),
                'description'   => esc_html__('Enabling this option will make all pages responsive', 'fleur'),
                'parent'        => $panel_settings
            )
        );

        $panel_custom_code = fleur_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_custom_code',
                'title' => esc_html__('Custom Code', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'custom_css',
                'type'        => 'textarea',
                'label'       => esc_html__('Custom CSS', 'fleur'),
                'description' => esc_html__('Enter your custom CSS here', 'fleur'),
                'parent'      => $panel_custom_code
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'custom_js',
                'type'        => 'textarea',
                'label'       => esc_html__('Custom JS', 'fleur'),
                'description' => esc_html__('Enter your custom Javascript here', 'fleur'),
                'parent'      => $panel_custom_code
            )
        );

        $panel_google_api = fleur_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_google_api',
                'title' => esc_html__('Google API', 'fleur')
            )
        );

        fleur_mikado_add_admin_field(
            array(
                'name'        => 'google_maps_api_key',
                'type'        => 'text',
                'label'       => esc_html__('Google Maps Api Key', 'fleur'),
                'description' => esc_html__('Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'fleur'),
                'parent'      => $panel_google_api
            )
        );
    }

    add_action('fleur_mikado_options_map', 'fleur_mikado_general_options_map', 1);

}