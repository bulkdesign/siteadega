<?php
namespace Fleur\Modules\IconListItem;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Icon List Item
 */
class IconListItem implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkd_icon_list_item';

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
     */

    public function vcMap() {
        vc_map(array(
            'name'     => esc_html__('Icon List Item', 'fleur'),
            'base'     => $this->base,
            'icon'     => 'icon-wpb-icon-list-item extended-custom-icon',
            'category' => 'by MIKADO',
            'params'   => array_merge(
                \FleurMikadoIconCollections::get_instance()->getVCParamsArray(),
                array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Icon Size (px)', 'fleur'),
                        'param_name'  => 'icon_size',
                        'description' => ''
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Icon Color', 'fleur'),
                        'param_name'  => 'icon_color',
                        'description' => ''
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Title', 'fleur'),
                        'param_name'  => 'title',
                        'description' => ''
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Title size (px)', 'fleur'),
                        'param_name'  => 'title_size',
                        'description' => '',
                        'dependency'  => Array('element' => 'title', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Title Color', 'fleur'),
                        'param_name'  => 'title_color',
                        'description' => '',
                        'dependency'  => Array('element' => 'title', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Title Font Weight', 'fleur'),
                        'param_name'  => 'title_font_weight',
                        'value'       => array_flip(fleur_mikado_get_font_weight_array(true)),
                        'description' => '',
                        'dependency'  => Array('element' => 'title', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Title Font Family', 'fleur'),
                        'param_name'  => 'title_font_family',
                        'value'       => array(
                            esc_html__('Default', 'fleur')              => 'default-font-family',
                            esc_html__('Headings Font Family', 'fleur') => 'headings-font-family'
                        ),
                        'save_always' => true,
                        'description' => '',
                        'dependency'  => Array('element' => 'title', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Spacing between Title and Icon (px)', 'fleur'),
                        'param_name'  => 'space_title_and_icon',
                        'description' => '',
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Margin Bottom (px)', 'fleur'),
                        'param_name'  => 'margin_bottom',
                        'description' => '',
                        'save_always' => true
                    )
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'icon_size'            => '',
            'icon_color'           => '',
            'title'                => '',
            'title_color'          => '',
            'title_size'           => '',
            'title_font_weight'    => '',
            'title_font_family'    => 'headings-font-family',
            'space_title_and_icon' => '',
            'margin_bottom'        => ''
        );

        $args = array_merge($args, fleur_mikado_icon_collections()->getShortcodeParams());

        $params = shortcode_atts($args, $atts);

        //Extract params for use in method
        extract($params);
        $iconPackName = fleur_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
        $iconClasses  = '';

        //generate icon holder classes
        $iconClasses .= 'mkd-icon-list-item-icon ';
        $iconClasses .= $params['icon_pack'];

        $params['icon_classes']             = $iconClasses;
        $params['icon']                     = $params[$iconPackName];
        $params['icon_attributes']['style'] = $this->getIconStyle($params);
        $params['title_style']              = $this->getTitleStyle($params);

        $params['holder_classes'] = array('mkd-icon-list-item');
        $params['holder_styles']  = array();

        if($params['margin_bottom'] !== '') {
            $params['holder_styles'][] = 'margin-bottom: '.fleur_mikado_filter_px($params['margin_bottom']).'px';
        }

        if($params['title_font_family'] !== '') {
            $params['holder_classes'][] = 'mkd-icon-list-item-'.$params['title_font_family'];
        }

        //Get HTML from template
        $html = fleur_mikado_get_shortcode_module_template_part('templates/icon-list-item-template', 'icon-list-item', '', $params);

        return $html;
    }

    /**
     * Generates icon styles
     *
     * @param $params
     *
     * @return array
     */
    private function getIconStyle($params) {

        $iconStylesArray = array();
        if(!empty($params['icon_color'])) {
            $iconStylesArray[] = 'color:'.$params['icon_color'];
        }

        if(!empty($params['icon_size'])) {
            $iconStylesArray[] = 'font-size:'.fleur_mikado_filter_px($params['icon_size']).'px';
        }

        return implode(';', $iconStylesArray);
    }

    /**
     * Generates title styles
     *
     * @param $params
     *
     * @return array
     */
    private function getTitleStyle($params) {
        $titleStylesArray = array();
        if(!empty($params['title_color'])) {
            $titleStylesArray[] = 'color:'.$params['title_color'];
        }

        if(!empty($params['title_size'])) {
            $titleStylesArray[] = 'font-size:'.fleur_mikado_filter_px($params['title_size']).'px';
        }

        if(!empty($params['title_font_weight'])) {
            $titleStylesArray[] = 'font-weight: '.$params['title_font_weight'];
        }

        if(!empty($params['space_title_and_icon'])) {
            $titleStylesArray[] = 'padding-left: '.fleur_mikado_filter_px($params['space_title_and_icon']).'px';
        }

        return implode(';', $titleStylesArray);
    }

}