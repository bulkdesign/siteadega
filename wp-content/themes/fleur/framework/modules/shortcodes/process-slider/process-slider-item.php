<?php
namespace Fleur\Modules\Shortcodes\ProcessSlider;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessSliderItem implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_process_slider_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Process Slider Item', 'fleur'),
            'base'                    => $this->getBase(),
            'as_child'                => array('only' => 'mkd_process_slider'),
            'category'                => 'by MIKADO',
            'icon'                    => 'icon-wpb-process-slider-item extended-custom-icon',
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Number', 'fleur'),
                    'param_name'  => 'number',
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Title', 'fleur'),
                    'param_name'  => 'title',
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__('Text', 'fleur'),
                    'param_name'  => 'text',
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Title Color', 'fleur'),
                    'param_name'  => 'title_color',
                    'admin_label' => true,
                    'group'       => esc_html__('Design Options', 'fleur'),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Text Color', 'fleur'),
                    'param_name'  => 'text_color',
                    'admin_label' => true,
                    'group'       => esc_html__('Design Options', 'fleur'),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Background Color', 'fleur'),
                    'param_name'  => 'background_color',
                    'admin_label' => true,
                    'group'       => esc_html__('Design Options', 'fleur'),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Shadow Color', 'fleur'),
                    'param_name'  => 'shadow_color',
                    'admin_label' => true,
                    'group'       => esc_html__('Design Options', 'fleur'),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Number Color', 'fleur'),
                    'param_name'  => 'number_color',
                    'admin_label' => true,
                    'group'       => esc_html__('Design Options', 'fleur'),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Flip on Hover', 'fleur'),
                    'param_name'  => 'flip_on_hover',
                    'value'       => array(
                        esc_html__('No', 'fleur')  => 'no',
                        esc_html__('Yes', 'fleur') => 'yes'
                    ),
                    'admin_label' => true,
                    'group'       => esc_html__('Design Options', 'fleur'),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Back Side Background Color', 'fleur'),
                    'param_name'  => 'back_side_background_color',
                    'admin_label' => true,
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'dependency'  => array('element' => 'flip_on_hover', 'value' => array('yes'))
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Back Side Text Color', 'fleur'),
                    'param_name'  => 'back_side_text_color',
                    'admin_label' => true,
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'dependency'  => array('element' => 'flip_on_hover', 'value' => array('yes'))
                ),
                array(
                    'type'        => 'attach_image',
                    'heading'     => esc_html__('Back Side Background Image', 'fleur'),
                    'param_name'  => 'back_side_background_image',
                    'admin_label' => true,
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'dependency'  => array('element' => 'flip_on_hover', 'value' => array('yes'))
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Link', 'fleur'),
                    'param_name'  => 'link',
                    'description' => esc_html__('Enter the URL of an external link and make this item fully clickable.', 'fleur'),
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'admin_label' => true,
                    'dependency'  => array('element' => 'flip_on_hover', 'value' => array('yes'))
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Link Target', 'fleur'),
                    'param_name'  => 'target',
                    'value'       => array(
                        esc_html__('Blank', 'fleur') => '_blank',
                        esc_html__('Self', 'fleur')  => '_self'
                    ),
                    'admin_label' => true,
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'dependency'  => array('element' => 'link', 'not_empty' => true)
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Show Process List', 'fleur'),
                    'param_name'  => 'process_list',
                    'value'       => array(
                        esc_html__('No', 'fleur')  => 'no',
                        esc_html__('Yes', 'fleur') => 'yes'
                    ),
                    'admin_label' => true,
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'dependency'  => array('element' => 'flip_on_hover', 'value' => array('yes'))
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Process List Item 1', 'fleur'),
                    'param_name'  => 'process_list_item_1',
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'admin_label' => true,
                    'dependency'  => array('element' => 'process_list', 'value' => array('yes'))
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Process List Item 2', 'fleur'),
                    'param_name'  => 'process_list_item_2',
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'admin_label' => true,
                    'dependency'  => array('element' => 'process_list_item_1', 'not_empty' => true)
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Process List Item 3', 'fleur'),
                    'param_name'  => 'process_list_item_3',
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'admin_label' => true,
                    'dependency'  => array('element' => 'process_list_item_2', 'not_empty' => true)
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Process List Item 4', 'fleur'),
                    'param_name'  => 'process_list_item_4',
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'admin_label' => true,
                    'dependency'  => array('element' => 'process_list_item_3', 'not_empty' => true)
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Process List Item 5', 'fleur'),
                    'param_name'  => 'process_list_item_5',
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'admin_label' => true,
                    'dependency'  => array('element' => 'process_list_item_4', 'not_empty' => true)
                ),
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'number'                     => '',
            'title'                      => '',
            'text'                       => '',
            'title_color'                => '',
            'text_color'                 => '',
            'background_color'           => '',
            'shadow_color'               => '',
            'number_color'               => '',
            'flip_on_hover'              => '',
            'back_side_background_color' => '',
            'back_side_text_color'       => '',
            'back_side_background_image' => '',
            'link'                       => '',
            'target'                     => '_blank',
            'process_list'               => 'no',
            'process_list_item_1'        => '',
            'process_list_item_2'        => '',
            'process_list_item_3'        => '',
            'process_list_item_4'        => '',
            'process_list_item_5'        => '',
        );

        $params = shortcode_atts($default_atts, $atts);

        extract($params);

        $params['process_item_styles']           = $this->getProcessItemStyles($params);
        $params['process_number_style']         = $this->getProcessNumberStyle($params);
        $params['process_item_classes']          = $this->getProcessItemClasses($params);
        $params['process_item_back_side_styles'] = $this->getProcessItemBackSideStyles($params);


        return fleur_mikado_get_shortcode_module_template_part('templates/process-slider-item-template', 'process-slider', '', $params);
    }


    private function getProcessItemStyles($params) {
        $styles = array();

        if($params['background_color'] !== '') {
            $styles[] = 'background-color: '.$params['background_color'];
        }

        if($params['shadow_color'] !== '') {
            $styles[] = '-webkit-box-shadow: 0px 0px 5px 0px '.$params['shadow_color'];
            $styles[] = '-moz-box-shadow: 0px 0px 5px 0px '.$params['shadow_color'];
            $styles[] = 'box-shadow: 0px 0px 5px 0px '.$params['shadow_color'];
        }


        if($params['text_color']) {
            $styles[] = 'color: '.$params['text_color'];
        }

        return $styles;
    }

    private function getProcessNumberStyle($params) {
        $styles = array();

        if($params['number_color']) {
            $styles[] = 'color: '.$params['number_color'];
        }

        return $styles;
    }

    private function getProcessItemClasses($params) {
        $classes = array('mkd-process-item-holder');

        if(!empty($params['flip_on_hover']) && ($params['flip_on_hover'] == 'yes')) {
            $classes[] = 'mkd-pi-flip';
        }

        return $classes;
    }


    private function getProcessItemBackSideStyles($params) {
        $styles = array();


        if($params['back_side_background_color'] !== '') {
            $styles[] = 'background-color: '.$params['back_side_background_color'];
        }

        if($params['shadow_color'] !== '') {
            $styles[] = '-webkit-box-shadow: 0px 0px 5px 0px '.$params['shadow_color'];
            $styles[] = '-moz-box-shadow: 0px 0px 5px 0px '.$params['shadow_color'];
            $styles[] = 'box-shadow: 0px 0px 5px 0px '.$params['shadow_color'];
        }

        if($params['back_side_text_color'] !== '') {
            $styles[] = 'color: '.$params['back_side_text_color'];
        }

        if(($params['back_side_background_image']) !== '') {
            $styles[] = 'background-image: url('.wp_get_attachment_url($params['back_side_background_image']).')';;
        }

        return $styles;
    }

}