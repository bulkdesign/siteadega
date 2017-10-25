<?php
namespace Fleur\Modules\Shortcodes\TeamSlider;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Team Slider Item
 */
class TeamSliderItem implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkd_team_slider_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * @see mkd_core_get_carousel_slider_array_vc()
     */
    public function vcMap() {

        $team_social_icons_array = array();
        for($x = 1; $x < 6; $x++) {
            $teamIconCollections = fleur_mikado_icon_collections()->getCollectionsWithSocialIcons();
            foreach($teamIconCollections as $collection_key => $collection) {

                $team_social_icons_array[] = array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__('Social Icon ', 'fleur').$x,
                    'param_name' => 'team_social_'.$collection->param.'_'.$x,
                    'value'      => $collection->getSocialIconsArrayVC(),
                    'dependency' => Array('element' => 'team_social_icon_pack', 'value' => array($collection_key))
                );

            }

            $team_social_icons_array[] = array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Social Icon ', 'fleur').$x.esc_html__(' Link', 'fleur'),
                'param_name' => 'team_social_icon_'.$x.'_link',
                'dependency' => array(
                    'element' => 'team_social_icon_pack',
                    'value'   => fleur_mikado_icon_collections()->getIconCollectionsKeys()
                )
            );

            $team_social_icons_array[] = array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Social Icon ', 'fleur').$x.esc_html__(' Target', 'fleur'),
                'param_name' => 'team_social_icon_'.$x.'_target',
                'value'      => array(
                    ''                         => '',
                    esc_html__('Self', 'fleur')  => '_self',
                    esc_html__('Blank', 'fleur') => '_blank'
                ),
                'dependency' => Array('element' => 'team_social_icon_'.$x.'_link', 'not_empty' => true)
            );

        }

        vc_map(array(
            'name'                      => esc_html__('Team Slider Item', 'fleur'),
            'base'                      => $this->base,
            'category'                  => 'by MIKADO',
            'as_child'                  => array('only' => 'mkd_team_slider'),
            'icon'                      => 'icon-wpb-team-slider-item extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                array(
                    array(
                        'type'        => 'dropdown',
                        'admin_label' => true,
                        'heading'     => esc_html__('Type', 'fleur'),
                        'param_name'  => 'team_type',
                        'value'       => array(
                            esc_html__('Main Info on Hover', 'fleur')    => 'main-info-on-hover',
                            esc_html__('Main Info Below Image', 'fleur') => 'main-info-below-image'
                        ),
                        'save_always' => true
                    ),
                    array(
                        'type'       => 'attach_image',
                        'heading'    => esc_html__('Image', 'fleur'),
                        'param_name' => 'team_image'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__('Set Dark/Light Type', 'fleur'),
                        'param_name' => 'dark_light_type',
                        'value'      => array(
                            esc_html__('Dark', 'fleur')  => 'dark',
                            esc_html__('Light', 'fleur') => 'light',
                        ),
                        'dependency' => array('element' => 'team_type', 'value' => 'main-info-below-image')
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__('Add Box Shadow', 'fleur'),
                        'param_name' => 'boxed',
                        'value'      => array(
                            esc_html__('Yes', 'fleur') => 'with_box',
                            esc_html__('No', 'fleur')  => 'without_box',
                        ),
                        'dependency' => array('element' => 'team_type', 'value' => 'main-info-below-image')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Shadow Color', 'fleur'),
                        'param_name'  => 'shadow_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'boxed', 'value' => 'with_box')
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Name', 'fleur'),
                        'admin_label' => true,
                        'param_name'  => 'team_name'
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__('Name Tag', 'fleur'),
                        'param_name' => 'team_name_tag',
                        'value'      => array(
                            ''   => '',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6',
                        ),
                        'dependency' => array('element' => 'team_name', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Position', 'fleur'),
                        'admin_label' => true,
                        'param_name'  => 'team_position'
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Background Color For Team Position', 'fleur'),
                        'param_name'  => 'background_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'team_type', 'value' => 'main-info-below-image')
                    ),
                    array(
                        'type'        => 'textarea',
                        'heading'     => esc_html__('Description', 'fleur'),
                        'admin_label' => true,
                        'param_name'  => 'team_description'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Social Icon Pack', 'fleur'),
                        'param_name'  => 'team_social_icon_pack',
                        'admin_label' => true,
                        'value'       => array_merge(array('' => ''), fleur_mikado_icon_collections()->getIconCollectionsVCExclude('linea_icons')),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Social Icons Type', 'fleur'),
                        'param_name'  => 'team_social_icon_type',
                        'value'       => array(
                            esc_html__('Normal', 'fleur') => 'normal',
                            esc_html__('Circle', 'fleur') => 'circle',
                            esc_html__('Square', 'fleur') => 'square'
                        ),
                        'save_always' => true,
                        'dependency'  => array(
                            'element' => 'team_social_icon_pack',
                            'value'   => fleur_mikado_icon_collections()->getIconCollectionsKeys()
                        )
                    ),
                    array(
                        'type'        => 'dropdown',
                        'admin_label' => true,
                        'heading'     => esc_html__('Flip On Hover', 'fleur'),
                        'param_name'  => 'flip_on_hover',
                        'value'       => array(
                            esc_html__('No', 'fleur')  => 'no',
                            esc_html__('Yes', 'fleur') => 'yes'
                        ),
                        'dependency'  => array(
                            'element' => 'team_type',
                            'value'   => 'main-info-below-image'
                        ),
                        'save_always' => true,
                        'group'       => esc_html__('Advanced Options', 'fleur'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Phone Number', 'fleur'),
                        'admin_label' => true,
                        'param_name'  => 'phone_number',
                        'dependency'  => array(
                            'element' => 'flip_on_hover',
                            'value'   => 'yes'
                        ),
                        'group'       => esc_html__('Advanced Options', 'fleur'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Email Address', 'fleur'),
                        'admin_label' => true,
                        'param_name'  => 'email_address',
                        'dependency'  => array(
                            'element' => 'flip_on_hover',
                            'value'   => 'yes'
                        ),
                        'group'       => esc_html__('Advanced Options', 'fleur'),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Back Side Text Color', 'fleur'),
                        'admin_label' => true,
                        'param_name'  => 'back_side_color',
                        'dependency'  => array(
                            'element' => 'flip_on_hover',
                            'value'   => 'yes'
                        ),
                        'group'       => esc_html__('Advanced Options', 'fleur'),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Back Side Background Color', 'fleur'),
                        'admin_label' => true,
                        'param_name'  => 'back_side_background_color',
                        'dependency'  => array(
                            'element' => 'flip_on_hover',
                            'value'   => 'yes'
                        ),
                        'group'       => esc_html__('Advanced Options', 'fleur'),
                    ),
                ),
                $team_social_icons_array
            )
        ));

    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'team_image'                      => '',
            'team_type'                       => 'main-info-on-hover',
            'team_name'                       => '',
            'team_name_tag'                   => 'h4',
            'team_position'                   => '',
            'team_description'                => '',
            'background_color'                => '',
            'shadow_color'                    => '',
            'team_social_icon_pack'           => '',
            'team_social_icon_type'           => 'normal_social',
            'dark_light_type'                 => '',
            'boxed'                           => 'with_box',
            'flip_on_hover'                   => '',
            'phone_number'                    => '',
            'email_address'                   => '',
            'back_side_color'                 => '',
            'back_side_background_color'      => ''
        );

        $team_social_icons_form_fields = array();
        $number_of_social_icons        = 5;

        for($x = 1; $x <= $number_of_social_icons; $x++) {

            foreach(fleur_mikado_icon_collections()->iconCollections as $collection_key => $collection) {
                $team_social_icons_form_fields['team_social_'.$collection->param.'_'.$x] = '';
            }

            $team_social_icons_form_fields['team_social_icon_'.$x.'_link']   = '';
            $team_social_icons_form_fields['team_social_icon_'.$x.'_target'] = '';

        }

        $args = array_merge($args, $team_social_icons_form_fields);

        $params = shortcode_atts($args, $atts);

        $counter_classes = '';

        if($params['dark_light_type'] == 'light') {
            $counter_classes .= 'light';
        }

        $params['light_class'] = $counter_classes;

        $box_classes = '';

        if($params['boxed'] === 'with_box') {
            $box_classes = ' mkd-team-boxed';
        }

        $params['box_class'] = $box_classes;

        $flip_class = '';

        if($params['flip_on_hover'] == 'yes') {
            $flip_class = ' mkd-team-flip';
        }

        $params['flip_class'] = $flip_class;


        $params['number_of_social_icons'] = 5;
        $params['team_name_tag']          = $this->getTeamNameTag($params, $args);
        $params['team_image_src']         = $this->getTeamImage($params);
        $params['team_social_icons']      = $this->getTeamSocialIcons($params);
        $params['background_styles']      = $this->getPositionStyles($params);
        $params['team_back_side_styles']  = $this->getBackSideStyles($params);
        $params['team_shadow_styles']     = $this->getShadowStyles($params);


        //Get HTML from template based on type of team
        $html = fleur_mikado_get_shortcode_module_template_part('templates/'.$params['team_type'].'-slide', 'team-slider', '', $params);

        return $html;

    }

    /**
     * Return correct heading value. If provided heading isn't valid get the default one
     *
     * @param $params
     *
     * @return mixed
     */
    private function getTeamNameTag($params, $args) {

        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        return (in_array($params['team_name_tag'], $headings_array)) ? $params['team_name_tag'] : $args['team_name_tag'];

    }

    /**
     * Return Team image
     *
     * @param $params
     *
     * @return false|string
     */
    private function getTeamImage($params) {

        if(is_numeric($params['team_image'])) {
            $team_image_src = wp_get_attachment_url($params['team_image']);
        } else {
            $team_image_src = $params['team_image'];
        }

        return $team_image_src;

    }

    private function getShadowStyles($params) {
        $styles = array();

        if(!empty($params['shadow_color'])) {
            $styles[] = '-webkit-box-shadow: 0px 0px 5px 0px '.$params['shadow_color'];
            $styles[] = '-moz-box-shadow: 0px 0px 5px 0px '.$params['shadow_color'];
            $styles[] = 'box-shadow: 0px 0px 5px 0px '.$params['shadow_color'];
        }

        return $styles;
    }


    private function getPositionStyles($params) {
        $styles = '';

        if(!empty($params['background_color'])) {
            $styles = 'background-color: '.$params['background_color'];
        }

        return $styles;
    }

    private function getTeamSocialIcons($params) {

        extract($params);
        $social_icons = array();

        if($team_social_icon_pack !== '') {

            $icon_pack                    = fleur_mikado_icon_collections()->getIconCollection($team_social_icon_pack);
            $team_social_icon_type_label  = 'team_social_'.$icon_pack->param;
            $team_social_icon_param_label = $icon_pack->param;

            for($i = 1; $i <= $number_of_social_icons; $i++) {

                $team_social_icon   = ${$team_social_icon_type_label.'_'.$i};
                $team_social_link   = ${'team_social_icon_'.$i.'_link'};
                $team_social_target = ${'team_social_icon_'.$i.'_target'};

                if($team_social_icon !== '') {

                    $team_icon_params                                = array();
                    $team_icon_params['icon_pack']                   = $team_social_icon_pack;
                    $team_icon_params[$team_social_icon_param_label] = $team_social_icon;
                    $team_icon_params['link']                        = ($team_social_link !== '') ? $team_social_link : '';
                    $team_icon_params['target']                      = ($team_social_target !== '') ? $team_social_target : '';
                    $team_icon_params['type']                        = ($team_social_icon_type !== '') ? $team_social_icon_type : '';

                    $social_icons[] = fleur_mikado_execute_shortcode('mkd_icon', $team_icon_params);
                }

            }

        }

        return $social_icons;

    }

    private function getBackSideStyles($params) {
        $styles = array();

        if(!empty($params['back_side_background_color'])) {
            $styles[] = 'background-color: '.$params['back_side_background_color'];
        }

        if(!empty($params['back_side_color'])) {
            $styles[] = 'color: '.$params['back_side_color'];
        }

        if(!empty($params['shadow_color'])) {
            $styles[] = '-webkit-box-shadow: 0px 0px 5px 0px '.$params['shadow_color'];
            $styles[] = '-moz-box-shadow: 0px 0px 5px 0px '.$params['shadow_color'];
            $styles[] = 'box-shadow: 0px 0px 5px 0px '.$params['shadow_color'];
        }

        return $styles;
    }

}