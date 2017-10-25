<?php
namespace Fleur\Modules\Shortcodes\VerticalSplitSliderContentItem;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class VerticalSplitSliderContentItem implements ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkd_vertical_split_slider_content_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'      => esc_html__('Slide Content Item', 'fleur'),
            'base'      => $this->base,
            'icon'      => 'icon-wpb-vertical-split-slider-content-item extended-custom-icon',
            'category'  => 'by MIKADO',
            'as_parent' => array('except' => 'vc_row'),
            'as_child'  => array('only' => 'mkd_vertical_split_slider_left_panel,mkd_vertical_split_slider_right_panel'),
            'js_view'   => 'VcColumnView',
            'params'    => array(
                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__('Background Color', 'fleur'),
                    'param_name' => 'background_color',
                    'value'      => ''
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__('Background Image', 'fleur'),
                    'param_name' => 'background_image',
                    'value'      => ''
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Padding', 'fleur'),
                    'param_name'  => 'item_padding',
                    'value'       => '',
                    'description' => esc_html__('Please insert padding in format "10px 0 10px 0"', 'fleur')
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__('Content Aligment', 'fleur'),
                    'param_name' => 'alignment',
                    'value'      => array(
                        esc_html__('Left', 'fleur')   => 'left',
                        esc_html__('Right', 'fleur')  => 'right',
                        esc_html__('Center', 'fleur') => 'center'
                    )
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__('Header/Bullets Style', 'fleur'),
                    'param_name' => 'header_style',
                    'value'      => array(
                        esc_html__('Default', 'fleur') => '',
                        esc_html__('Light', 'fleur')   => 'light',
                        esc_html__('Dark', 'fleur')    => 'dark'
                    )
                )
            )
        ));
    }

    public function render($atts, $content = null) {

        $args   = array(
            'background_color' => '',
            'background_image' => '',
            'item_padding'     => '',
            'alignment'        => 'left',
            'header_style'     => '',
        );
        $params = shortcode_atts($args, $atts);
        extract($params);

        $params['content_style'] = $this->getContentStyle($params);
        $params['content_data']  = $this->getContentData($params);
        $params['content']       = $content;

        $html = fleur_mikado_get_shortcode_module_template_part('templates/vertical-split-slider-content-item-template', 'vertical-split-slider', '', $params);

        return $html;

    }


    /**
     * Return Content Style
     *
     * @param $params
     *
     * @return array
     */
    private function getContentStyle($params) {

        $content_style = array();

        if($params['background_color'] !== '') {
            $content_style[] = 'background-color:'.$params['background_color'];
        }

        if($params['background_image'] !== '') {
            $url             = wp_get_attachment_url($params['background_image']);
            $content_style[] = 'background-image:url('.$url.')';
        }

        if($params['item_padding'] !== '') {
            $content_style[] = 'padding:'.$params['item_padding'];
        }

        if($params['alignment'] !== '') {
            $content_style[] = 'text-align:'.$params['alignment'];
        }


        return $content_style;
    }

    private function getContentData($params) {

        $data = array();

        if($params['header_style'] !== '') {
            $data['data-header-style'] = $params['header_style'];
        }


        return $data;
    }

}
