<?php

namespace Fleur\Modules\Shortcodes\ComparisonPricingTables;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class ComparisonPricingTable implements ShortcodeInterface {
    private $base;

    /**
     * ComparisonPricingTable constructor.
     */
    public function __construct() {
        $this->base = 'mkd_comparison_pricing_table';

        add_action('vc_before_init', array($this, 'vcMap'));
    }


    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Comparison Pricing Table', 'fleur'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-pricing-table extended-custom-icon',
            'category'                  => 'by MIKADO',
            'allowed_container_element' => 'vc_row',
            'as_child'                  => array('only' => 'mkd_comparison_pricing_tables_holder'),
            'params'                    => array(
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Title', 'fleur'),
                    'param_name'  => 'title',
                    'value'       => esc_html__('Basic Plan', 'fleur'),
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Title Size (px)', 'fleur'),
                    'param_name'  => 'title_size',
                    'value'       => '',
                    'description' => '',
                    'dependency'  => array('element' => 'title', 'not_empty' => true),
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Price', 'fleur'),
                    'param_name'  => 'price',
                    'description' => esc_html__('Default value is 100', 'fleur')
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Currency', 'fleur'),
                    'param_name'  => 'currency',
                    'description' => esc_html__('Default mark is $', 'fleur')
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Price Period', 'fleur'),
                    'param_name'  => 'price_period',
                    'description' => esc_html__('Default label is monthly', 'fleur')
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Show Button', 'fleur'),
                    'param_name'  => 'show_button',
                    'value'       => array(
                        esc_html__('Default', 'fleur') => '',
                        esc_html__('Yes', 'fleur')     => 'yes',
                        esc_html__('No', 'fleur')      => 'no'
                    ),
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Button Text', 'fleur'),
                    'param_name'  => 'button_text',
                    'dependency'  => array('element' => 'show_button', 'value' => 'yes')
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Button Link', 'fleur'),
                    'param_name'  => 'link',
                    'dependency'  => array('element' => 'show_button', 'value' => 'yes')
                ),
                array(
                    'type'        => 'textarea_html',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Content', 'fleur'),
                    'param_name'  => 'content',
                    'value'       => '<li>content content content</li><li>content content content</li><li>content content content</li>',
                    'description' => '',
                    'admin_label' => false
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Border Top Color', 'fleur'),
                    'param_name'  => 'border_top_color',
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                ),
                array(
                    'type'        => 'colorpicker',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Button Background Color', 'fleur'),
                    'param_name'  => 'btn_background_color',
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'title'                => esc_html__('Basic Plan', 'fleur'),
            'title_size'           => '',
            'price'                => '100',
            'currency'             => '',
            'price_period'         => '',
            'show_button'          => 'yes',
            'link'                 => '',
            'button_text'          => 'button',
            'border_top_color'     => '',
            'btn_background_color' => ''
        );

        $params = shortcode_atts($args, $atts);

        $params['content']        = $content;
        $params['border_style']   = $this->getBorderStyles($params);
        $params['display_border'] = is_array($params['border_style']) && count($params['border_style']);
        $params['btn_styles']     = $this->getBtnStyles($params);

        return fleur_mikado_get_shortcode_module_template_part('templates/cpt-table-template', 'comparison-pricing-tables', '', $params);
    }

    private function getBorderStyles($params) {
        $styles = array();

        if($params['border_top_color'] !== '') {
            $styles[] = 'background-color: '.$params['border_top_color'];
        }

        return $styles;
    }

    private function getBtnStyles($params) {
        $styles = array();

        if($params['btn_background_color'] !== '') {
            $styles[] = 'background-color: '.$params['btn_background_color'];
        }

        return $styles;
    }

}