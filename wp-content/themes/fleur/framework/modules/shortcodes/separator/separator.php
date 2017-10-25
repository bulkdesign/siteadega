<?php
namespace Fleur\Modules\Separator;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class Separator implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'mkd_separator';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(
            array(
                'name'                    => esc_html__('Separator', 'fleur'),
                'base'                    => $this->base,
                'category'                => 'by MIKADO',
                'icon'                    => 'icon-wpb-separator extended-custom-icon',
                'show_settings_on_create' => true,
                'class'                   => 'wpb_vc_separator',
                'custom_markup'           => '<div></div>',
                'params'                  => array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Extra class name', 'fleur'),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'fleur')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Type', 'fleur'),
                        'param_name'  => 'type',
                        'value'       => array(
                            esc_html__('Normal', 'fleur')     => 'normal',
                            esc_html__('Full Width', 'fleur') => 'full-width'
                        ),
                        'description' => ''
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Position', 'fleur'),
                        'param_name'  => 'position',
                        'value'       => array(
                            esc_html__('Center', 'fleur') => 'center',
                            esc_html__('Left', 'fleur')   => 'left',
                            esc_html__('Right', 'fleur')  => 'right'
                        ),
                        'save_always' => true,
                        'dependency'  => array('element' => 'type', 'value' => array('normal'))
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__('Color', 'fleur'),
                        'param_name' => 'color',
                        'value'      => ''
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => esc_html__('Border Style', 'fleur'),
                        'param_name' => 'border_style',
                        'value'      => array(
                            esc_html__('Default', 'fleur') => '',
                            esc_html__('Dashed', 'fleur')  => 'dashed',
                            esc_html__('Solid', 'fleur')   => 'solid',
                            esc_html__('Dotted', 'fleur')  => 'dotted'
                        )
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Width', 'fleur'),
                        'param_name'  => 'width',
                        'value'       => '',
                        'description' => '',
                        'dependency'  => array('element' => 'type', 'value' => array('normal'))
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Thickness (px)', 'fleur'),
                        'param_name'  => 'thickness',
                        'value'       => '',
                        'description' => ''
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Top Margin', 'fleur'),
                        'param_name'  => 'top_margin',
                        'value'       => '',
                        'description' => ''
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__('Bottom Margin', 'fleur'),
                        'param_name' => 'bottom_margin',
                        'value'      => '',
                    )
                )
            )
        );

    }

    public function render($atts, $content = null) {
        $args = array(
            'class_name'    => '',
            'type'          => '',
            'position'      => 'center',
            'color'         => '',
            'border_style'  => '',
            'width'         => '',
            'thickness'     => '',
            'top_margin'    => '',
            'bottom_margin' => ''
        );

        $params = shortcode_atts($args, $atts);
        extract($params);
        $params['separator_class'] = $this->getSeparatorClass($params);
        $params['separator_style'] = $this->getSeparatorStyle($params);


        $html = fleur_mikado_get_shortcode_module_template_part('templates/separator-template', 'separator', '', $params);

        return $html;
    }


    /**
     * Return Separator classes
     *
     * @param $params
     *
     * @return array
     */
    private function getSeparatorClass($params) {

        $separator_class = array();

        if($params['class_name'] !== '') {
            $separator_class[] = $params['class_name'];
        }
        if($params['position'] !== '') {
            $separator_class[] = 'mkd-separator-'.$params['position'];
        }
        if($params['type'] !== '') {
            $separator_class[] = 'mkd-separator-'.$params['type'];
        }

        return implode(' ', $separator_class);

    }

    /**
     * Return Elements Holder Item Content style
     *
     * @param $params
     *
     * @return array
     */
    private function getSeparatorStyle($params) {

        $separator_style = array();

        if($params['color'] !== '') {
            $separator_style[] = 'border-color: '.$params['color'];
        }
        if($params['border_style'] !== '') {
            $separator_style[] = 'border-style: '.$params['border_style'];
        }
        if($params['width'] !== '') {
            if(fleur_mikado_string_ends_with($params['width'], '%') || fleur_mikado_string_ends_with($params['width'], 'px')) {
                $separator_style[] = 'width: '.$params['width'];
            } else {
                $separator_style[] = 'width: '.$params['width'].'px';
            }
        }
        if($params['thickness'] !== '') {
            $separator_style[] = 'border-bottom-width: '.$params['thickness'].'px';
        }
        if($params['top_margin'] !== '') {
            if(fleur_mikado_string_ends_with($params['top_margin'], '%') || fleur_mikado_string_ends_with($params['top_margin'], 'px')) {
                $separator_style[] = 'margin-top: '.$params['top_margin'];
            } else {
                $separator_style[] = 'margin-top: '.$params['top_margin'].'px';
            }
        }
        if($params['bottom_margin'] !== '') {
            if(fleur_mikado_string_ends_with($params['bottom_margin'], '%') || fleur_mikado_string_ends_with($params['bottom_margin'], 'px')) {
                $separator_style[] = 'margin-bottom: '.$params['bottom_margin'];
            } else {
                $separator_style[] = 'margin-bottom: '.$params['bottom_margin'].'px';
            }
        }

        return implode(';', $separator_style);

    }

}
