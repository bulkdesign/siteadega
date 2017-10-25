<?php
namespace Fleur\Modules\ElementsHolder;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class ElementsHolder implements ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkd_elements_holder';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'      => esc_html__('Elements Holder', 'fleur'),
            'base'      => $this->base,
            'icon'      => 'icon-wpb-elements-holder extended-custom-icon',
            'category'  => 'by MIKADO',
            'as_parent' => array('only' => 'mkd_elements_holder_item, mkd_info_box'),
            'js_view'   => 'VcColumnView',
            'params'    => array(
                array(
                    'type'        => 'colorpicker',
                    'class'       => '',
                    'heading'     => esc_html__('Background Color', 'fleur'),
                    'param_name'  => 'background_color',
                    'value'       => '',
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__('Columns', 'fleur'),
                    'admin_label' => true,
                    'param_name'  => 'number_of_columns',
                    'value'       => array(
                        esc_html__('1 Column', 'fleur')  => 'one-column',
                        esc_html__('2 Columns', 'fleur') => 'two-columns',
                        esc_html__('3 Columns', 'fleur') => 'three-columns',
                        esc_html__('4 Columns', 'fleur') => 'four-columns',
                        esc_html__('5 Columns', 'fleur') => 'five-columns',
                        esc_html__('6 Columns', 'fleur') => 'six-columns'
                    ),
                    'description' => ''
                ),
                array(
                    'type'        => 'checkbox',
                    'class'       => '',
                    'heading'     => esc_html__('Items Float Left', 'fleur'),
                    'param_name'  => 'items_float_left',
                    'value'       => array('Make Items Float Left?' => 'yes'),
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'group'       => esc_html__('Width & Responsiveness', 'fleur'),
                    'heading'     => esc_html__('Switch to One Column', 'fleur'),
                    'param_name'  => 'switch_to_one_column',
                    'value'       => array(
                        esc_html__('Default', 'fleur')      => '',
                        esc_html__('Below 1280px', 'fleur') => '1280',
                        esc_html__('Below 1024px', 'fleur') => '1024',
                        esc_html__('Below 768px', 'fleur')  => '768',
                        esc_html__('Below 600px', 'fleur')  => '600',
                        esc_html__('Below 480px', 'fleur')  => '480',
                        esc_html__('Never', 'fleur')        => 'never'
                    ),
                    'description' => esc_html__('Choose on which stage item will be in one column', 'fleur')
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'group'       => esc_html__('Width & Responsiveness', 'fleur'),
                    'heading'     => esc_html__('Choose Alignment In Responsive Mode', 'fleur'),
                    'param_name'  => 'alignment_one_column',
                    'value'       => array(
                        esc_html__('Default', 'fleur') => '',
                        esc_html__('Left', 'fleur')    => 'left',
                        esc_html__('Center', 'fleur')  => 'center',
                        esc_html__('Right', 'fleur')   => 'right'
                    ),
                    'description' => esc_html__('Alignment When Items are in One Column', 'fleur')
                )
            )
        ));
    }

    public function render($atts, $content = null) {

        $args   = array(
            'number_of_columns'    => '',
            'switch_to_one_column' => '',
            'alignment_one_column' => '',
            'items_float_left'     => '',
            'background_color'     => ''
        );
        $params = shortcode_atts($args, $atts);
        extract($params);

        $html = '';

        $elements_holder_classes   = array();
        $elements_holder_classes[] = 'mkd-elements-holder';
        $elements_holder_style     = '';

        if($number_of_columns != '') {
            $elements_holder_classes[] .= 'mkd-'.$number_of_columns;
        }

        if($switch_to_one_column != '') {
            $elements_holder_classes[] = 'mkd-responsive-mode-'.$switch_to_one_column;
        } else {
            $elements_holder_classes[] = 'mkd-responsive-mode-768';
        }

        if($alignment_one_column != '') {
            $elements_holder_classes[] = 'mkd-one-column-alignment-'.$alignment_one_column;
        }

        if($items_float_left !== '') {
            $elements_holder_classes[] = 'mkd-elements-items-float';
        }

        if($background_color != '') {
            $elements_holder_style .= 'background-color:'.$background_color.';';
        }

        $elements_holder_class = implode(' ', $elements_holder_classes);

        $html .= '<div '.fleur_mikado_get_class_attribute($elements_holder_class).' '.fleur_mikado_get_inline_attr($elements_holder_style, 'style').'>';
        $html .= do_shortcode($content);
        $html .= '</div>';

        return $html;

    }

}
