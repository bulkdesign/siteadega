<?php

//Slider

$slider_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__('Slide Background Type', 'fleur'),
        'name'  => 'slides_type'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_slide_background_type',
        'type'          => 'imagevideo',
        'default_value' => 'image',
        'label'         => esc_html__('Slide Background Type', 'fleur'),
        'description'   => esc_html__('Do you want to upload an image or video?', 'fleur'),
        'parent'        => $slider_meta_box,
        'args'          => array(
            "dependence"             => true,
            "dependence_hide_on_yes" => "#mkd-meta-box-mkd_slides_video_settings",
            "dependence_show_on_yes" => "#mkd-meta-box-mkd_slides_image_settings"
        )
    )
);


//Slide Image

$slider_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope'           => array('slides'),
        'title'           => esc_html__('Slide Background Image', 'fleur'),
        'name'            => 'mkd_slides_image_settings',
        'hidden_property' => 'mkd_slide_background_type',
        'hidden_values'   => array('video')
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_image',
        'type'        => 'image',
        'label'       => esc_html__('Slide Image', 'fleur'),
        'description' => esc_html__('Choose background image', 'fleur'),
        'parent'      => $slider_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_overlay_image',
        'type'        => 'image',
        'label'       => esc_html__('Overlay Image', 'fleur'),
        'description' => esc_html__('Choose overlay image (pattern) for background image', 'fleur'),
        'parent'      => $slider_meta_box
    )
);


//Slide Video

$video_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope'           => array('slides'),
        'title'           => esc_html__('Slide Background Video', 'fleur'),
        'name'            => 'mkd_slides_video_settings',
        'hidden_property' => 'mkd_slide_background_type',
        'hidden_values'   => array('image')
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_video_webm',
        'type'        => 'text',
        'label'       => esc_html__('Video - webm', 'fleur'),
        'description' => esc_html__('Path to the webm file that you have previously uploaded in Media Section', 'fleur'),
        'parent'      => $video_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_video_mp4',
        'type'        => 'text',
        'label'       => esc_html__('Video - mp4', 'fleur'),
        'description' => esc_html__('Path to the mp4 file that you have previously uploaded in Media Section', 'fleur'),
        'parent'      => $video_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_video_ogv',
        'type'        => 'text',
        'label'       => esc_html__('Video - ogv', 'fleur'),
        'description' => esc_html__('Path to the ogv file that you have previously uploaded in Media Section', 'fleur'),
        'parent'      => $video_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_video_image',
        'type'        => 'image',
        'label'       => esc_html__('Video Preview Image', 'fleur'),
        'description' => esc_html__('Choose background image that will be visible until video is loaded. This image will be shown on touch devices too.', 'fleur'),
        'parent'      => $video_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_slide_video_overlay',
        'type'          => 'yesempty',
        'default_value' => '',
        'label'         => esc_html__('Video Overlay Image', 'fleur'),
        'description'   => esc_html__('Do you want to have a overlay image on video?', 'fleur'),
        'parent'        => $video_meta_box,
        'args'          => array(
            "dependence"             => true,
            "dependence_hide_on_yes" => "",
            "dependence_show_on_yes" => "#mkd_mkd_slide_video_overlay_container"
        )
    )
);

$slide_video_overlay_container = fleur_mikado_add_admin_container(array(
    'name'            => 'mkd_slide_video_overlay_container',
    'parent'          => $video_meta_box,
    'hidden_property' => 'mkd_slide_video_overlay',
    'hidden_values'   => array('', 'no')
));

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_video_overlay_image',
        'type'        => 'image',
        'label'       => esc_html__('Overlay Image', 'fleur'),
        'description' => esc_html__('Choose overlay image (pattern) for background video.', 'fleur'),
        'parent'      => $slide_video_overlay_container
    )
);


//Slide General

$general_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__('Slide General', 'fleur'),
        'name'  => 'mkd_slides_general_settings'
    )
);

fleur_mikado_add_admin_section_title(
    array(
        'parent' => $general_meta_box,
        'name'   => 'mkd_text_content_title',
        'title'  => esc_html__('Slide Text Content', 'fleur')
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_slide_hide_title',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Hide Slide Title', 'fleur'),
        'description'   => esc_html__('Do you want to hide slide title?', 'fleur'),
        'parent'        => $general_meta_box,
        'args'          => array(
            "dependence"             => true,
            "dependence_hide_on_yes" => "#mkd_mkd_slide_hide_title_container, #mkd-meta-box-mkd_slides_title",
            "dependence_show_on_yes" => ""
        )
    )
);

$slide_hide_title_container = fleur_mikado_add_admin_container(array(
    'name'            => 'mkd_slide_hide_title_container',
    'parent'          => $general_meta_box,
    'hidden_property' => 'mkd_slide_hide_title',
    'hidden_value'    => 'yes'
));

$group_title_link = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Title Link', 'fleur'),
    'name'        => 'group_title_link',
    'description' => esc_html__('Define styles for title', 'fleur'),
    'parent'      => $slide_hide_title_container
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $group_title_link
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_link',
        'type'   => 'textsimple',
        'label'  => esc_html__('Link', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'parent'        => $row1,
        'type'          => 'selectsimple',
        'name'          => 'mkd_slide_title_target',
        'default_value' => '_self',
        'label'         => esc_html__('Target', 'fleur'),
        'options'       => array(
            "_self"  => esc_html__('Self', 'fleur'),
            "_blank" => esc_html__('Blank', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_subtitle',
        'type'        => 'text',
        'label'       => esc_html__('Subtitle Text', 'fleur'),
        'description' => esc_html__('Enter text for subtitle', 'fleur'),
        'parent'      => $general_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_text',
        'type'        => 'text',
        'label'       => esc_html__('Body Text', 'fleur'),
        'description' => esc_html__('Enter slide body text', 'fleur'),
        'parent'      => $general_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_button_label',
        'type'        => 'text',
        'label'       => esc_html__('Button 1 Text', 'fleur'),
        'description' => esc_html__('Enter text to be displayed on button 1', 'fleur'),
        'parent'      => $general_meta_box
    )
);

$group_button1 = fleur_mikado_add_admin_group(array(
    'title'  => esc_html__('Button 1 Link', 'fleur'),
    'name'   => 'group_button1',
    'parent' => $general_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $group_button1
));

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_slide_button_link',
        'type'          => 'textsimple',
        'label'         => esc_html__('Link', 'fleur'),
        'default_value' => '',
        'parent'        => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'parent'        => $row1,
        'type'          => 'selectsimple',
        'name'          => 'mkd_slide_button_target',
        'default_value' => '_self',
        'label'         => esc_html__('Target', 'fleur'),
        'options'       => array(
            "_self"  => esc_html__('Self', 'fleur'),
            "_blank" => esc_html__('Blank', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_button_label2',
        'type'        => 'text',
        'label'       => esc_html__('Button 2 Text', 'fleur'),
        'description' => esc_html__('Enter text to be displayed on button 2', 'fleur'),
        'parent'      => $general_meta_box
    )
);

$group_button2 = fleur_mikado_add_admin_group(array(
    'title'  => esc_html__('Button 2 Link', 'fleur'),
    'name'   => 'group_button2',
    'parent' => $general_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $group_button2
));

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_slide_button_link2',
        'type'          => 'textsimple',
        'default_value' => '',
        'label'         => esc_html__('Link', 'fleur'),
        'parent'        => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'parent'        => $row1,
        'type'          => 'selectsimple',
        'name'          => 'mkd_slide_button_target2',
        'default_value' => '_self',
        'label'         => esc_html__('Target', 'fleur'),
        'options'       => array(
            '_self'  => esc_html__('Self', 'fleur'),
            '_blank' => esc_html__('Blank', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_text_content_top_margin',
        'type'        => 'text',
        'label'       => esc_html__('Text Content Top Margin', 'fleur'),
        'description' => esc_html__('Enter top margin for text content', 'fleur'),
        'parent'      => $general_meta_box,
        'args'        => array(
            'col_width' => 2,
            'suffix'    => 'px'
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_text_content_bottom_margin',
        'type'        => 'text',
        'label'       => esc_html__('Text Content Bottom Margin', 'fleur'),
        'description' => esc_html__('Enter bottom margin for text content', 'fleur'),
        'parent'      => $general_meta_box,
        'args'        => array(
            'col_width' => 2,
            'suffix'    => 'px'
        )
    )
);

fleur_mikado_add_admin_section_title(
    array(
        'parent' => $general_meta_box,
        'name'   => 'mkd_graphic_title',
        'title'  => esc_html__('Slide Graphic', 'fleur')
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_thumbnail',
        'type'        => 'image',
        'label'       => esc_html__('Slide Graphic', 'fleur'),
        'description' => esc_html__('Choose slide graphic', 'fleur'),
        'parent'      => $general_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_thumbnail_link',
        'type'        => 'text',
        'label'       => esc_html__('Graphic Link', 'fleur'),
        'description' => esc_html__('Enter URL to link slide graphic', 'fleur'),
        'parent'      => $general_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_graphic_top_padding',
        'type'        => 'text',
        'label'       => esc_html__('Graphic Top Padding', 'fleur'),
        'description' => esc_html__('Enter top padding for slide graphic', 'fleur'),
        'parent'      => $general_meta_box,
        'args'        => array(
            'col_width' => 2,
            'suffix'    => 'px'
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_graphic_bottom_padding',
        'type'        => 'text',
        'label'       => esc_html__('Graphic Bottom Padding', 'fleur'),
        'description' => esc_html__('Enter bottom padding for slide graphic', 'fleur'),
        'parent'      => $general_meta_box,
        'args'        => array(
            'col_width' => 2,
            'suffix'    => 'px'
        )
    )
);

fleur_mikado_add_admin_section_title(
    array(
        'parent' => $general_meta_box,
        'name'   => 'mkd_general_styling_title',
        'title'  => esc_html__('General Styling', 'fleur')
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'parent'        => $general_meta_box,
        'type'          => 'selectblank',
        'name'          => 'mkd_slide_header_style',
        'default_value' => '',
        'label'         => esc_html__('Header Style', 'fleur'),
        'description'   => esc_html__('Header style will be applied when this slide is in focus', 'fleur'),
        'options'       => array(
            "light" => esc_html__('Light', 'fleur'),
            "dark"  => esc_html__('Dark', 'fleur')
        )
    )
);

//Slide Behaviour

$behaviours_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__('Slide Behaviours', 'fleur'),
        'name'  => 'mkd_slides_behaviour_settings'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_scroll_to_section',
        'type'        => 'text',
        'label'       => esc_html__('Scroll to Section', 'fleur'),
        'description' => esc_html__('An arrow will appear to take viewers to the next section of the page. Enter the section anchor here, for example, \'#contact\'', 'fleur'),
        'parent'      => $behaviours_meta_box
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_scroll_to_section_position',
        'type'        => 'select',
        'label'       => esc_html__('Scroll to Section Icon Position', 'fleur'),
        'description' => esc_html__('Choose position for anchor icon - scroll to section', 'fleur'),
        'parent'      => $behaviours_meta_box,
        'options'     => array(
            "in_content"       => esc_html__('In Text Content', 'fleur'),
            "bottom_of_slider" => esc_html__('Bottom of the slide', 'fleur')
        )
    )
);

fleur_mikado_add_admin_section_title(
    array(
        'parent' => $behaviours_meta_box,
        'name'   => 'mkd_image_animation_title',
        'title'  => esc_html__('Slide Image Animation', 'fleur')
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_enable_image_animation',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Enable Image Animation', 'fleur'),
        'description'   => esc_html__('Enabling this option will turn on a motion animation on the slide image', 'fleur'),
        'parent'        => $behaviours_meta_box,
        'args'          => array(
            "dependence"             => true,
            "dependence_hide_on_yes" => "",
            "dependence_show_on_yes" => "#mkd_mkd_enable_image_animation_container"
        )
    )
);

$enable_image_animation_container = fleur_mikado_add_admin_container(array(
    'name'            => 'mkd_enable_image_animation_container',
    'parent'          => $behaviours_meta_box,
    'hidden_property' => 'mkd_enable_image_animation',
    'hidden_value'    => 'no'
));

fleur_mikado_add_meta_box_field(
    array(
        'parent'        => $enable_image_animation_container,
        'type'          => 'select',
        'name'          => 'mkd_enable_image_animation_type',
        'default_value' => 'zoom_center',
        'label'         =>  esc_html__('Animation Type', 'fleur'),
        'options'       => array(
            'zoom_center'       => esc_html__('Zoom In Center', 'fleur'),
            'zoom_top_left'     => esc_html__('Zoom In to Top Left', 'fleur'),
            'zoom_top_right'    => esc_html__('Zoom In to Top Right', 'fleur'),
            'zoom_bottom_left'  => esc_html__('Zoom In to Bottom Left', 'fleur'),
            'zoom_bottom_right' => esc_html__('Zoom In to Bottom Right', 'fleur')
        )
    )
);

fleur_mikado_add_admin_section_title(
    array(
        'parent' => $behaviours_meta_box,
        'name'   => 'mkd_content_animation_title',
        'title'  => esc_html__('Slide Content Entry Animations', 'fleur')
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'parent'        => $behaviours_meta_box,
        'type'          => 'select',
        'name'          => 'mkd_slide_thumbnail_animation',
        'default_value' => 'flip',
        'label'         => esc_html__('Graphic Entry Animation', 'fleur'),
        'description'   => esc_html__('Choose entry animation for graphic', 'fleur'),
        'options'       => array(
            'flip'              => esc_html__('Flip', 'fleur'),
            'fade'              => esc_html__('Fade In', 'fleur'),
            'from_bottom'       => esc_html__('From Bottom', 'fleur'),
            'from_top'          => esc_html__('From Top', 'fleur'),
            'from_left'         => esc_html__('From Left', 'fleur'),
            'from_right'        => esc_html__('From Right', 'fleur'),
            'clip_anim_hor'     => esc_html__('Clip Animation Horizontal', 'fleur'),
            'clip_anim_ver'     => esc_html__('Clip Animation Vertical', 'fleur'),
            'clip_anim_puzzle'  => esc_html__('Clip Animation Puzzle', 'fleur'),
            'without_animation' => esc_html__('No Animation', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'parent'        => $behaviours_meta_box,
        'type'          => 'select',
        'name'          => 'mkd_slide_content_animation',
        'default_value' => 'all_at_once',
        'label'         => esc_html__('Content Entry Animation', 'fleur'),
        'description'   => esc_html__('Choose entry animation for whole slide content group (title, subtitle, text, button)', 'fleur'),
        'options'       => array(
            'all_at_once'       => esc_html__('All At Once', 'fleur'),
            'one_by_one'        => esc_html__('One By One', 'fleur'),
            'without_animation' => esc_html__('No Animation', 'fleur')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                "all_at_once"       => "",
                "one_by_one"        => "",
                "without_animation" => "#mkd_mkd_slide_content_animation_container"
            ),
            "show"       => array(
                "all_at_once"       => "#mkd_mkd_slide_content_animation_container",
                "one_by_one"        => "#mkd_mkd_slide_content_animation_container",
                "without_animation" => ""
            )
        )
    )
);

$slide_content_animation_container = fleur_mikado_add_admin_container(array(
    'name'            => 'mkd_slide_content_animation_container',
    'parent'          => $behaviours_meta_box,
    'hidden_property' => 'mkd_slide_content_animation',
    'hidden_value'    => 'without_animation'
));

fleur_mikado_add_meta_box_field(
    array(
        'parent'        => $slide_content_animation_container,
        'type'          => 'select',
        'name'          => 'mkd_slide_content_animation_direction',
        'default_value' => 'from_bottom',
        'label'         => esc_html__('Animation Direction', 'fleur'),
        'options'       => array(
            'from_bottom' => esc_html__('From Bottom', 'fleur'),
            'from_top'    => esc_html__('From Top', 'fleur'),
            'from_left'   => esc_html__('From Left', 'fleur'),
            'from_right'  => esc_html__('From Right', 'fleur'),
            'fade'        => esc_html__('Fade In', 'fleur')
        )
    )
);

//Slide Title Styles

$title_style_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope'           => array('slides'),
        'title'           => esc_html__('Slide Title Style', 'fleur'),
        'name'            => 'mkd_slides_title',
        'hidden_property' => 'mkd_slide_hide_title',
        'hidden_values'   => array('yes')
    )
);

$title_text_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Title Text Style', 'fleur'),
    'description' => esc_html__('Define styles for title text', 'fleur'),
    'name'        => 'mkd_title_text_group',
    'parent'      => $title_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $title_text_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_color',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Font Color', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_font_size',
        'type'   => 'textsimple',
        'label'  => esc_html__('Font Size (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_line_height',
        'type'   => 'textsimple',
        'label'  => esc_html__('Line Height (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_letter_spacing',
        'type'   => 'textsimple',
        'label'  => esc_html__('Letter Spacing (px)', 'fleur'),
        'parent' => $row1
    )
);

$row2 = fleur_mikado_add_admin_row(array(
    'name'   => 'row2',
    'parent' => $title_text_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_font_family',
        'type'   => 'fontsimple',
        'label'  => esc_html__('Font Family', 'fleur'),
        'parent' => $row2
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'    => 'mkd_slide_title_font_style',
        'type'    => 'selectblanksimple',
        'label'   => esc_html__('Font Style', 'fleur'),
        'parent'  => $row2,
        'options' => $fleur_options_fontstyle
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'    => 'mkd_slide_title_font_weight',
        'type'    => 'selectblanksimple',
        'label'   => esc_html__('Font Weight', 'fleur'),
        'parent'  => $row2,
        'options' => $fleur_options_fontweight
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'    => 'mkd_slide_title_text_transform',
        'type'    => 'selectblanksimple',
        'label'   => esc_html__('Text Transform', 'fleur'),
        'parent'  => $row2,
        'options' => $fleur_options_texttransform
    )
);

$title_background_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Background', 'fleur'),
    'description' => esc_html__('Define background for title', 'fleur'),
    'name'        => 'mkd_title_background_group',
    'parent'      => $title_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $title_background_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_background_color',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Background Color', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_bg_color_transparency',
        'type'   => 'textsimple',
        'label'  => esc_html__('Background Color Transparency (values 0-1)', 'fleur'),
        'parent' => $row1
    )
);

$title_margin_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Margin Bottom (px)', 'fleur'),
    'description' => esc_html__('Enter value for title bottom margin (default value is 14)', 'fleur'),
    'name'        => 'mkd_title_margin_group',
    'parent'      => $title_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $title_margin_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_margin_bottom',
        'type'   => 'textsimple',
        'label'  => '',
        'parent' => $row1
    )
);

$title_padding_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Padding', 'fleur'),
    'description' => esc_html__('Define padding for title', 'fleur'),
    'name'        => 'mkd_title_padding_group',
    'parent'      => $title_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $title_padding_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_padding_top',
        'type'   => 'textsimple',
        'label'  => esc_html__('Top Padding (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_padding_right',
        'type'   => 'textsimple',
        'label'  => esc_html__('Right Padding (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_padding_bottom',
        'type'   => 'textsimple',
        'label'  => esc_html__('Bottom Padding (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_padding_left',
        'type'   => 'textsimple',
        'label'  => esc_html__('Left Padding (px)', 'fleur'),
        'parent' => $row1
    )
);

$slide_title_border = fleur_mikado_add_meta_box_field(array(
    'label'         => esc_html__('Border', 'fleur'),
    'description'   => esc_html__('Do you want to have a title border?', 'fleur'),
    'name'          => 'mkd_slide_title_border',
    'type'          => 'yesno',
    'default_value' => 'no',
    'parent'        => $title_style_meta_box,
    'args'          => array(
        'dependence'             => true,
        'dependence_hide_on_yes' => '',
        'dependence_show_on_yes' => '#mkd_mkd_title_border_container'
    )
));

$title_border_container = fleur_mikado_add_admin_container(array(
    'name'            => 'mkd_title_border_container',
    'parent'          => $title_style_meta_box,
    'hidden_property' => 'mkd_slide_title_border',
    'hidden_value'    => 'no'
));

$title_border_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Title Border', 'fleur'),
    'description' => esc_html__('Define border for title', 'fleur'),
    'name'        => 'mkd_title_border_group',
    'parent'      => $title_border_container
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $title_border_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_title_border_thickness',
        'type'   => 'textsimple',
        'label'  => esc_html__('Thickness (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'    => 'mkd_slide_title_border_style',
        'type'    => 'selectsimple',
        'label'   => esc_html__('Style', 'fleur'),
        'parent'  => $row1,
        'options' => array(
            'solid'  => esc_html__('solid', 'fleur'),
            'dashed' => esc_html__('dashed', 'fleur'),
            'dotted' => esc_html__('dotted', 'fleur'),
            'double' => esc_html__('double', 'fleur'),
            'groove' => esc_html__('groove', 'fleur'),
            'ridge'  => esc_html__('ridge', 'fleur'),
            'inset'  => esc_html__('inset', 'fleur'),
            'outset' => esc_html__('outset', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slider_title_border_color',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Color', 'fleur'),
        'parent' => $row1
    )
);

//Slide Subtitle Styles

$subtitle_style_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__('Slide Subtitle Style', 'fleur'),
        'name'  => 'mkd_slides_subtitle'
    )
);

$subtitle_text_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Subtitle Text Style', 'fleur'),
    'description' => esc_html__('Define styles for subtitle text', 'fleur'),
    'name'        => 'mkd_subtitle_text_group',
    'parent'      => $subtitle_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $subtitle_text_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_subtitle_color',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Font Color', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_subtitle_font_size',
        'type'   => 'textsimple',
        'label'  => esc_html__('Font Size (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_subtitle_line_height',
        'type'   => 'textsimple',
        'label'  => esc_html__('Line Height (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_subtitle_letter_spacing',
        'type'   => 'textsimple',
        'label'  => esc_html__('Letter Spacing (px)', 'fleur'),
        'parent' => $row1
    )
);

$row2 = fleur_mikado_add_admin_row(array(
    'name'   => 'row2',
    'parent' => $subtitle_text_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_subtitle_font_family',
        'type'   => 'fontsimple',
        'label'  => esc_html__('Font Family', 'fleur'),
        'parent' => $row2
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'    => 'mkd_slide_subtitle_font_style',
        'type'    => 'selectblanksimple',
        'label'   => esc_html__('Font Style', 'fleur'),
        'parent'  => $row2,
        'options' => $fleur_options_fontstyle
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'    => 'mkd_slide_subtitle_font_weight',
        'type'    => 'selectblanksimple',
        'label'   => esc_html__('Font Weight', 'fleur'),
        'parent'  => $row2,
        'options' => $fleur_options_fontweight
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'    => 'mkd_slide_subtitle_text_transform',
        'type'    => 'selectblanksimple',
        'label'   => esc_html__('Text Transform', 'fleur'),
        'parent'  => $row2,
        'options' => $fleur_options_texttransform
    )
);

$subtitle_background_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Background', 'fleur'),
    'description' => esc_html__('Define background for subtitle', 'fleur'),
    'name'        => 'mkd_subtitle_background_group',
    'parent'      => $subtitle_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $subtitle_background_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_subtitle_background_color',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Background Color', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_subtitle_bg_color_transparency',
        'type'   => 'textsimple',
        'label'  => esc_html__('Background Color Transparency (values 0-1)', 'fleur'),
        'parent' => $row1
    )
);

$subtitle_margin_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Margin Bottom (px)', 'fleur'),
    'description' => esc_html__('Enter value for subtitle bottom margin (default value is 14)', 'fleur'),
    'name'        => 'mkd_subtitle_margin_group',
    'parent'      => $subtitle_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $subtitle_margin_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_subtitle_margin_bottom',
        'type'   => 'textsimple',
        'label'  => '',
        'parent' => $row1
    )
);

$subtitle_padding_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Padding', 'fleur'),
    'description' => esc_html__('Define padding for subtitle', 'fleur'),
    'name'        => 'mkd_subtitle_padding_group',
    'parent'      => $subtitle_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $subtitle_padding_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_subtitle_padding_top',
        'type'   => 'textsimple',
        'label'  => esc_html__('Top Padding (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_subtitle_padding_right',
        'type'   => 'textsimple',
        'label'  => esc_html__('Right Padding (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_subtitle_padding_bottom',
        'type'   => 'textsimple',
        'label'  => esc_html__('Bottom Padding (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_subtitle_padding_left',
        'type'   => 'textsimple',
        'label'  => esc_html__('Left Padding (px)', 'fleur'),
        'parent' => $row1
    )
);

//Slide Text Styles

$text_style_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__('Slide Text Style', 'fleur'),
        'name'  => 'mkd_slides_text'
    )
);

$text_common_text_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Text Color and Size', 'fleur'),
    'description' => esc_html__('Define text color and size', 'fleur'),
    'name'        => 'mkd_text_common_text_group',
    'parent'      => $text_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $text_common_text_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_text_color',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Font Color', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_text_font_size',
        'type'   => 'textsimple',
        'label'  => esc_html__('Font Size (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_text_line_height',
        'type'   => 'textsimple',
        'label'  => esc_html__('Line Height (px)', 'fleur'),
        'parent' => $row1
    )
);

$text_without_separator_padding_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Padding', 'fleur'),
    'description' => esc_html__('Define padding for text', 'fleur'),
    'name'        => 'mkd_text_without_separator_padding_group',
    'parent'      => $text_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $text_without_separator_padding_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_text_padding_top',
        'type'   => 'textsimple',
        'label'  => esc_html__('Top Padding (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_text_padding_right',
        'type'   => 'textsimple',
        'label'  => esc_html__('Right Padding (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_text_padding_bottom',
        'type'   => 'textsimple',
        'label'  => esc_html__('Bottom Padding (px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_text_padding_left',
        'type'   => 'textsimple',
        'label'  => esc_html__('Left Padding (px)', 'fleur'),
        'parent' => $row1
    )
);

$text_without_separator_text_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Text Style', 'fleur'),
    'description' => esc_html__('Define styles for slide text', 'fleur'),
    'name'        => 'mkd_text_without_separator_text_group',
    'parent'      => $text_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $text_without_separator_text_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_text_letter_spacing',
        'type'   => 'textsimple',
        'label'  => esc_html__('Letter Spacing (px)', 'fleur'),
        'parent' => $row1
    )
);

$row2 = fleur_mikado_add_admin_row(array(
    'name'   => 'row2',
    'parent' => $text_without_separator_text_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_text_font_family',
        'type'   => 'fontsimple',
        'label'  => esc_html__('Font Family', 'fleur'),
        'parent' => $row2
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'    => 'mkd_slide_text_font_style',
        'type'    => 'selectblanksimple',
        'label'   => esc_html__('Font Style', 'fleur'),
        'parent'  => $row2,
        'options' => $fleur_options_fontstyle
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'    => 'mkd_slide_text_font_weight',
        'type'    => 'selectblanksimple',
        'label'   => esc_html__('Font Weight', 'fleur'),
        'parent'  => $row2,
        'options' => $fleur_options_fontweight
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'    => 'mkd_slide_text_text_transform',
        'type'    => 'selectblanksimple',
        'label'   => esc_html__('Text Transform', 'fleur'),
        'parent'  => $row2,
        'options' => $fleur_options_texttransform
    )
);

$text_without_separator_background_group = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Background', 'fleur'),
    'description' => esc_html__('Define background for text', 'fleur'),
    'name'        => 'mkd_text_without_separator_background_group',
    'parent'      => $text_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $text_without_separator_background_group
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_text_background_color',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Background Color', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_text_bg_color_transparency',
        'type'   => 'textsimple',
        'label'  => esc_html__('Background Color Transparency (values 0-1)', 'fleur'),
        'parent' => $row1
    )
);

//Slide Buttons Styles

$buttons_style_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__('Slide Buttons Style', 'fleur'),
        'name'  => 'mkd_slides_buttons'
    )
);

fleur_mikado_add_admin_section_title(
    array(
        'parent' => $buttons_style_meta_box,
        'name'   => 'mkd_button_1_styling_title',
        'title'  => esc_html__('Button 1', 'fleur')
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_slide_button_size',
        'type'          => 'selectblank',
        'parent'        => $buttons_style_meta_box,
        'label'         => esc_html__('Size', 'fleur'),
        'description'   => esc_html__('Choose button size', 'fleur'),
        'default_value' => '',
        'options'       => array(
            ''                => esc_html__('Default', 'fleur'),
            'small'           => esc_html__('Small', 'fleur'),
            'medium'          => esc_html__('Medium', 'fleur'),
            'large'           => esc_html__('Large', 'fleur'),
            'huge'            => esc_html__('Extra Large', 'fleur'),
            'huge-full-width' => esc_html__('Extra Large Full Width', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_slide_button_type',
        'type'          => 'selectblank',
        'parent'        => $buttons_style_meta_box,
        'label'         => esc_html__('Type', 'fleur'),
        'description'   => esc_html__('Choose button type', 'fleur'),
        'default_value' => '',
        'options'       => array(
            ''        => esc_html__('Default', 'fleur'),
            'outline' => esc_html__('Outline', 'fleur'),
            'solid'   => esc_html__('Solid', 'fleur')
        )
    )
);

$buttons_style_group_1 = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Text Style', 'fleur'),
    'description' => esc_html__('Define text style', 'fleur'),
    'name'        => 'mkd_buttons_style_group_1',
    'parent'      => $buttons_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $buttons_style_group_1
));


fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_font_size',
        'type'   => 'textsimple',
        'label'  => esc_html__('Text Size(px)', 'fleur'),
        'parent' => $row1
    )
);


fleur_mikado_add_meta_box_field(
    array(
        'name'    => 'mkd_slide_button_font_weight',
        'type'    => 'selectblanksimple',
        'label'   => esc_html__('Font Weight', 'fleur'),
        'parent'  => $row1,
        'options' => $fleur_options_fontweight
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_text_color',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Text Color', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_text_hover_color',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Text Hover Color', 'fleur'),
        'parent' => $row1
    )
);

$buttons_style_group_2 = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Background', 'fleur'),
    'description' => esc_html__('Define background', 'fleur'),
    'name'        => 'mkd_buttons_style_group_2',
    'parent'      => $buttons_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $buttons_style_group_2
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_background_color',
        'type'   => esc_html__('colorsimple', 'fleur'),
        'label'  => esc_html__('Background Color', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_background_hover_color',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Background Hover Color', 'fleur'),
        'parent' => $row1
    )
);

$buttons_style_group_4 = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Border', 'fleur'),
    'description' => esc_html__('Define border style', 'fleur'),
    'name'        => 'mkd_buttons_style_group_4',
    'parent'      => $buttons_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $buttons_style_group_4
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_border_color',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Border Color', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_border_hover_color',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Border Hover Color', 'fleur'),
        'parent' => $row1
    )
);

$buttons_style_group_5 = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Margin (px)', 'fleur'),
    'description' => esc_html__('Please insert margin in format (top right bottom left) i.e. 5px 5px 5px 5px', 'fleur'),
    'name'        => 'mkd_buttons_style_group_5',
    'parent'      => $buttons_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $buttons_style_group_5
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_margin1',
        'type'   => 'textsimple',
        'label'  => '',
        'parent' => $row1
    )
);

//init icon pack hide and show array. It will be populated dinamically from collections array
$button1_icon_pack_hide_array = array();
$button1_icon_pack_show_array = array();

//do we have some collection added in collections array?
if(is_array($fleur_IconCollections->iconCollections) && count($fleur_IconCollections->iconCollections)) {
    //get collections params array. It will contain values of 'param' property for each collection
    $button1_icon_collections_params = $fleur_IconCollections->getIconCollectionsParams();

    //foreach collection generate hide and show array
    foreach($fleur_IconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
        $button1_icon_pack_hide_array[$dep_collection_key] = '';
        $button1_icon_pack_hide_array["no_icon"]           = "";

        //button1_icon_size is input that is always shown when some icon pack is activated and hidden if 'no_icon' is selected
        $button1_icon_pack_hide_array["no_icon"] .= "#mkd_slider_button1_icon_size,";

        //we need to include only current collection in show string as it is the only one that needs to show
        $button1_icon_pack_show_array[$dep_collection_key] = '#mkd_slider_button1_icon_size, #mkd_button1_icon_'.$dep_collection_object->param.'_container';

        //for all collections param generate hide string
        foreach($button1_icon_collections_params as $button1_icon_collections_param) {
            //we don't need to include current one, because it needs to be shown, not hidden
            if($button1_icon_collections_param !== $dep_collection_object->param) {
                $button1_icon_pack_hide_array[$dep_collection_key] .= '#mkd_button1_icon_'.$button1_icon_collections_param.'_container,';
            }

            $button1_icon_pack_hide_array["no_icon"] .= '#mkd_button1_icon_'.$button1_icon_collections_param.'_container,';
        }

        //remove remaining ',' character
        $button1_icon_pack_hide_array[$dep_collection_key] = rtrim($button1_icon_pack_hide_array[$dep_collection_key], ',');
        $button1_icon_pack_hide_array["no_icon"]           = rtrim($button1_icon_pack_hide_array["no_icon"], ',');
    }

}

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_button1_icon_pack',
        'type'          => 'select',
        'label'         => esc_html__('Button 1 Icon Pack', 'fleur'),
        'description'   => esc_html__('Choose icon pack for the first button', 'fleur'),
        'default_value' => 'no_icon',
        'parent'        => $buttons_style_meta_box,
        'options'       => $fleur_IconCollections->getIconCollectionsEmpty("no_icon"),
        'args'          => array(
            "dependence" => true,
            "hide"       => $button1_icon_pack_hide_array,
            "show"       => $button1_icon_pack_show_array
        )
    )
);


if(is_array($fleur_IconCollections->iconCollections) && count($fleur_IconCollections->iconCollections)) {
    //foreach icon collection we need to generate separate container that will have dependency set
    //it will have one field inside with icons dropdown
    foreach($fleur_IconCollections->iconCollections as $collection_key => $collection_object) {
        $icons_array = $collection_object->getIconsArray();

        //get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
        $icon_collections_keys = $fleur_IconCollections->getIconCollectionsKeys();

        //unset current one, because it doesn't have to be included in dependency that hides icon container
        unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

        $button1_icon_hide_values   = $icon_collections_keys;
        $button1_icon_hide_values[] = "no_icon";
        $button1_icon_container     = fleur_mikado_add_admin_container(array(
            'name'            => "button1_icon_".$collection_object->param."_container",
            'parent'          => $buttons_style_meta_box,
            'hidden_property' => 'mkd_button1_icon_pack',
            'hidden_value'    => '',
            'hidden_values'   => $button1_icon_hide_values
        ));

        fleur_mikado_add_meta_box_field(
            array(
                'name'    => "button1_icon_".$collection_object->param,
                'type'    => 'select',
                'label'   => esc_html__('Button 1 Icon', 'fleur'),
                'parent'  => $button1_icon_container,
                'options' => $icons_array
            )
        );
    }

}

fleur_mikado_add_admin_section_title(
    array(
        'parent' => $buttons_style_meta_box,
        'name'   => 'mkd_button_2_styling_title',
        'title'  => esc_html__('Button 2', 'fleur')
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_slide_button_size2',
        'type'          => 'selectblank',
        'parent'        => $buttons_style_meta_box,
        'label'         => esc_html__('Size', 'fleur'),
        'description'   => esc_html__('Choose button size', 'fleur'),
        'default_value' => '',
        'options'       => array(
            ''                => esc_html__('Default', 'fleur'),
            'small'           => esc_html__('Small', 'fleur'),
            'medium'          => esc_html__('Medium', 'fleur'),
            'large'           => esc_html__('Large', 'fleur'),
            'huge'            => esc_html__('Extra Large', 'fleur'),
            'huge-full-width' => esc_html__('Extra Large Full Width', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_slide_button_type2',
        'type'          => 'selectblank',
        'parent'        => $buttons_style_meta_box,
        'label'         => esc_html__('Type', 'fleur'),
        'description'   => esc_html__('Choose button type', 'fleur'),
        'default_value' => '',
        'options'       => array(
            ''        => esc_html__('Default', 'fleur'),
            'outline' => esc_html__('Outline', 'fleur'),
            'solid'   => esc_html__('Solid', 'fleur')
        )
    )
);

$buttons2_style_group_1 = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Text Style', 'fleur'),
    'description' => esc_html__('Define text style', 'fleur'),
    'name'        => 'mkd_buttons2_style_group_1',
    'parent'      => $buttons_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $buttons2_style_group_1
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_font_size2',
        'type'   => 'textsimple',
        'label'  => esc_html__('Text Size(px)', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'    => 'mkd_slide_button_font_weight2',
        'type'    => 'selectblanksimple',
        'label'   => esc_html__('Font Weight', 'fleur'),
        'parent'  => $row1,
        'options' => $fleur_options_fontweight
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_text_color2',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Text Color', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_text_hover_color2',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Text Hover Color', 'fleur'),
        'parent' => $row1
    )
);

$buttons2_style_group_2 = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Background', 'fleur'),
    'description' => esc_html__('Define background', 'fleur'),
    'name'        => 'mkd_buttons2_style_group_2',
    'parent'      => $buttons_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $buttons2_style_group_2
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_background_color2',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Background Color', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_background_hover_color2',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Background Hover Color', 'fleur'),
        'parent' => $row1
    )
);

$buttons2_style_group_4 = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Border', 'fleur'),
    'description' => esc_html__('Define border style', 'fleur'),
    'name'        => 'mkd_buttons2_style_group_4',
    'parent'      => $buttons_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $buttons2_style_group_4
));


fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_border_color2',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Border Color', 'fleur'),
        'parent' => $row1
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_border_hover_color2',
        'type'   => 'colorsimple',
        'label'  => esc_html__('Border Hover Color', 'fleur'),
        'parent' => $row1
    )
);

$buttons2_style_group_5 = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Margin (px)', 'fleur'),
    'description' => esc_html__('Please insert margin in format (top right bottom left) i.e. 5px 5px 5px 5px', 'fleur'),
    'name'        => 'mkd_buttons2_style_group_5',
    'parent'      => $buttons_style_meta_box
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $buttons2_style_group_5
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_button_margin2',
        'type'   => 'textsimple',
        'label'  => '',
        'parent' => $row1
    )
);

//init icon pack hide and show array. It will be populated dinamically from collections array
$button2_icon_pack_hide_array = array();
$button2_icon_pack_show_array = array();

//do we have some collection added in collections array?
if(is_array($fleur_IconCollections->iconCollections) && count($fleur_IconCollections->iconCollections)) {
    //get collections params array. It will contain values of 'param' property for each collection
    $button2_icon_collections_params = $fleur_IconCollections->getIconCollectionsParams();

    //foreach collection generate hide and show array
    foreach($fleur_IconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
        $button2_icon_pack_hide_array[$dep_collection_key] = '';
        $button2_icon_pack_hide_array["no_icon"]           = "";

        //button2_icon_size is input that is always shown when some icon pack is activated and hidden if 'no_icon' is selected
        $button2_icon_pack_hide_array["no_icon"] .= "#mkd_slider_button2_icon_size,";

        //we need to include only current collection in show string as it is the only one that needs to show
        $button2_icon_pack_show_array[$dep_collection_key] = '#mkd_slider_button2_icon_size, #mkd_button2_icon_'.$dep_collection_object->param.'_container';

        //for all collections param generate hide string
        foreach($button2_icon_collections_params as $button2_icon_collections_param) {
            //we don't need to include current one, because it needs to be shown, not hidden
            if($button2_icon_collections_param !== $dep_collection_object->param) {
                $button2_icon_pack_hide_array[$dep_collection_key] .= '#mkd_button2_icon_'.$button2_icon_collections_param.'_container,';
            }

            $button2_icon_pack_hide_array["no_icon"] .= '#mkd_button2_icon_'.$button2_icon_collections_param.'_container,';
        }

        //remove remaining ',' character
        $button2_icon_pack_hide_array[$dep_collection_key] = rtrim($button2_icon_pack_hide_array[$dep_collection_key], ',');
        $button2_icon_pack_hide_array["no_icon"]           = rtrim($button2_icon_pack_hide_array["no_icon"], ',');
    }

}

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_button2_icon_pack',
        'type'          => 'select',
        'label'         => esc_html__('Button 2 Icon Pack', 'fleur'),
        'description'   => esc_html__('Choose icon pack for the first button', 'fleur'),
        'default_value' => 'no_icon',
        'parent'        => $buttons_style_meta_box,
        'options'       => $fleur_IconCollections->getIconCollectionsEmpty("no_icon"),
        'args'          => array(
            "dependence" => true,
            "hide"       => $button2_icon_pack_hide_array,
            "show"       => $button2_icon_pack_show_array
        )
    )
);


if(is_array($fleur_IconCollections->iconCollections) && count($fleur_IconCollections->iconCollections)) {
    //foreach icon collection we need to generate separate container that will have dependency set
    //it will have one field inside with icons dropdown
    foreach($fleur_IconCollections->iconCollections as $collection_key => $collection_object) {
        $icons_array = $collection_object->getIconsArray();

        //get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
        $icon_collections_keys = $fleur_IconCollections->getIconCollectionsKeys();

        //unset current one, because it doesn't have to be included in dependency that hides icon container
        unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

        $button2_icon_hide_values   = $icon_collections_keys;
        $button2_icon_hide_values[] = "no_icon";
        $button2_icon_container     = fleur_mikado_add_admin_container(array(
            'name'            => "button2_icon_".$collection_object->param."_container",
            'parent'          => $buttons_style_meta_box,
            'hidden_property' => 'mkd_button2_icon_pack',
            'hidden_value'    => '',
            'hidden_values'   => $button2_icon_hide_values
        ));

        fleur_mikado_add_meta_box_field(
            array(
                'name'    => "button2_icon_".$collection_object->param,
                'type'    => 'select',
                'label'   =>  esc_html__('Button 2 Icon', 'fleur'),
                'parent'  => $button2_icon_container,
                'options' => $icons_array
            )
        );
    }

}

//Slide Content Positioning

$content_positioning_meta_box = fleur_mikado_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__('Slide Content Positioning', 'fleur'),
        'name'  => 'mkd_content_positioning_settings'
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'parent'        => $content_positioning_meta_box,
        'type'          => 'selectblank',
        'name'          => 'mkd_slide_content_alignment',
        'default_value' => '',
        'label'         => esc_html__('Text Alignment', 'fleur'),
        'description'   => esc_html__('Choose an alignment for the slide text', 'fleur'),
        'options'       => array(
            'left'   => esc_html__('Left', 'fleur'),
            'center' => esc_html__('Center', 'fleur'),
            'right'  => esc_html__('Right', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'parent'        => $content_positioning_meta_box,
        'type'          => 'selectblank',
        'name'          => 'mkd_slide_separate_text_graphic',
        'default_value' => 'no',
        'label'         => esc_html__('Separate Graphic and Text Positioning', 'fleur'),
        'description'   => esc_html__('Do you want to separately position graphic and text?', 'fleur'),
        'options'       => array(
            'no'  => esc_html__('No', 'fleur'),
            'yes' => esc_html__('Yes', 'fleur')
        ),
        'args'          => array(
            "dependence" => true,
            "hide"       => array(
                ""   => "#mkd_mkd_slide_graphic_positioning_container",
                "no" => "#mkd_mkd_slide_graphic_positioning_container, #mkd_mkd_content_vertical_positioning_group_container"
            ),
            "show"       => array(
                "yes" => "#mkd_mkd_slide_graphic_positioning_container, #mkd_mkd_content_vertical_positioning_group_container"
            )
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_slide_content_vertical_middle',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Vertically Align Content to Middle', 'fleur'),
        'parent'        => $content_positioning_meta_box,
        'args'          => array(
            "dependence"             => true,
            "dependence_hide_on_yes" => "#mkd_mkd_slide_content_vertical_middle_no_container",
            "dependence_show_on_yes" => "#mkd_mkd_slide_content_vertical_middle_yes_container"
        )
    )
);

$slide_content_vertical_middle_yes_container = fleur_mikado_add_admin_container(array(
    'name'            => 'mkd_slide_content_vertical_middle_yes_container',
    'parent'          => $content_positioning_meta_box,
    'hidden_property' => 'mkd_slide_content_vertical_middle',
    'hidden_value'    => 'no'
));

fleur_mikado_add_meta_box_field(
    array(
        'parent'        => $slide_content_vertical_middle_yes_container,
        'type'          => 'selectblank',
        'name'          => 'mkd_slide_content_vertical_middle_type',
        'default_value' => '',
        'label'         => esc_html__('Align Content Vertically Relative to the Height Measured From', 'fleur'),
        'options'       => array(
            'bottom_of_header' => esc_html__('Bottom of Header', 'fleur'),
            'window_top'       => esc_html__('Window Top', 'fleur')
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_slide_vertical_content_full_width',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Content Holder Full Width', 'fleur'),
        'description'   => esc_html__('Do you want to set slide content holder to full width?', 'fleur'),
        'parent'        => $slide_content_vertical_middle_yes_container
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_vertical_content_width',
        'type'        => 'text',
        'label'       => esc_html__('Content Width', 'fleur'),
        'description' => esc_html__('Enter Width for Content Area', 'fleur'),
        'parent'      => $slide_content_vertical_middle_yes_container,
        'args'        => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

$group_space_around_content = fleur_mikado_add_admin_group(array(
    'title'  => esc_html__('Space Around Content in Slide', 'fleur'),
    'name'   => 'group_space_around_content',
    'parent' => $slide_content_vertical_middle_yes_container
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $group_space_around_content
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_vertical_content_left',
        'type'   => 'textsimple',
        'label'  => esc_html__('From Left', 'fleur'),
        'parent' => $row1,
        'args'   => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_vertical_content_right',
        'type'   => 'textsimple',
        'label'  => esc_html__('From Right', 'fleur'),
        'parent' => $row1,
        'args'   => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

$slide_content_vertical_middle_no_container = fleur_mikado_add_admin_container(array(
    'name'            => 'mkd_slide_content_vertical_middle_no_container',
    'parent'          => $content_positioning_meta_box,
    'hidden_property' => 'mkd_slide_content_vertical_middle',
    'hidden_value'    => 'yes'
));

fleur_mikado_add_meta_box_field(
    array(
        'name'          => 'mkd_slide_content_full_width',
        'type'          => 'yesno',
        'default_value' => 'no',
        'label'         => esc_html__('Content Holder Full Width', 'fleur'),
        'description'   => esc_html__('Do you want to set slide content holder to full width?', 'fleur'),
        'parent'        => $slide_content_vertical_middle_no_container,
        'args'          => array(
            "dependence"             => true,
            "dependence_hide_on_yes" => "#mkd_mkd_slide_content_width_container",
            "dependence_show_on_yes" => ""
        )
    )
);

$slide_content_width_container = fleur_mikado_add_admin_container(array(
    'name'            => 'mkd_slide_content_width_container',
    'parent'          => $slide_content_vertical_middle_no_container,
    'hidden_property' => 'mkd_slide_content_full_width',
    'hidden_value'    => 'yes'
));

fleur_mikado_add_meta_box_field(
    array(
        'name'        => 'mkd_slide_content_width',
        'type'        => 'text',
        'label'       => esc_html__('Content Holder Width', 'fleur'),
        'description' => esc_html__('Enter Width for Content Holder Area', 'fleur'),
        'parent'      => $slide_content_width_container,
        'args'        => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

$group_space_around_content = fleur_mikado_add_admin_group(array(
    'title'  => esc_html__('Space Around Content in Slide', 'fleur'),
    'name'   => 'group_space_around_content',
    'parent' => $slide_content_vertical_middle_no_container
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $group_space_around_content
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_content_top',
        'type'   => 'textsimple',
        'label'  => esc_html__('From Top', 'fleur'),
        'parent' => $row1,
        'args'   => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_content_left',
        'type'   => 'textsimple',
        'label'  => esc_html__('From Left', 'fleur'),
        'parent' => $row1,
        'args'   => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_content_bottom',
        'type'   => 'textsimple',
        'label'  => esc_html__('From Bottom', 'fleur'),
        'parent' => $row1,
        'args'   => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_content_right',
        'type'   => 'textsimple',
        'label'  => esc_html__('From Right', 'fleur'),
        'parent' => $row1,
        'args'   => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

$row2 = fleur_mikado_add_admin_row(array(
    'name'   => 'row2',
    'parent' => $group_space_around_content
));

$content_vertical_positioning_group_container = fleur_mikado_add_admin_container_no_style(array(
    'name'            => 'mkd_content_vertical_positioning_group_container',
    'parent'          => $row2,
    'hidden_property' => 'mkd_slide_separate_text_graphic',
    'hidden_value'    => 'no'
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_text_width',
        'type'   => 'textsimple',
        'label'  => esc_html__('Text Holder Width', 'fleur'),
        'parent' => $content_vertical_positioning_group_container,
        'args'   => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

$slide_graphic_positioning_container = fleur_mikado_add_admin_container(array(
    'name'            => 'mkd_slide_graphic_positioning_container',
    'parent'          => $slide_content_vertical_middle_no_container,
    'hidden_property' => 'mkd_slide_separate_text_graphic',
    'hidden_value'    => 'no'
));

fleur_mikado_add_meta_box_field(
    array(
        'parent'        => $slide_graphic_positioning_container,
        'type'          => 'selectblank',
        'name'          => 'mkd_slide_graphic_alignment',
        'default_value' => 'left',
        'label'         => esc_html__('Choose an alignment for the slide graphic', 'fleur'),
        'options'       => array(
            'left'   => esc_html__('Left', 'fleur'),
            'center' => esc_html__('Center', 'fleur'),
            'right'  => esc_html__('Right', 'fleur')
        )
    )
);

$group_graphic_positioning = fleur_mikado_add_admin_group(array(
    'title'       => esc_html__('Graphic Positioning', 'fleur'),
    'description' => esc_html__('Positioning for slide graphic', 'fleur'),
    'name'        => 'group_graphic_positioning',
    'parent'      => $slide_graphic_positioning_container
));

$row1 = fleur_mikado_add_admin_row(array(
    'name'   => 'row1',
    'parent' => $group_graphic_positioning
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_graphic_top',
        'type'   => 'textsimple',
        'label'  => esc_html__('From Top', 'fleur'),
        'parent' => $row1,
        'args'   => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_graphic_left',
        'type'   => 'textsimple',
        'label'  => esc_html__('From Left', 'fleur'),
        'parent' => $row1,
        'args'   => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_graphic_bottom',
        'type'   => 'textsimple',
        'label'  => esc_html__('From Bottom', 'fleur'),
        'parent' => $row1,
        'args'   => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_graphic_right',
        'type'   => 'textsimple',
        'label'  => esc_html__('From Right', 'fleur'),
        'parent' => $row1,
        'args'   => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);

$row2 = fleur_mikado_add_admin_row(array(
    'name'   => 'row2',
    'parent' => $group_graphic_positioning
));

fleur_mikado_add_meta_box_field(
    array(
        'name'   => 'mkd_slide_graphic_width',
        'type'   => 'textsimple',
        'label'  => esc_html__('Graphic Holder Width', 'fleur'),
        'parent' => $row2,
        'args'   => array(
            'col_width' => 2,
            'suffix'    => '%'
        )
    )
);