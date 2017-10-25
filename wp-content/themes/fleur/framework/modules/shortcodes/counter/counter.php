<?php
namespace Fleur\Modules\Counter;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Counter
 */
class Counter implements ShortcodeInterface {

    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkd_counter';

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

        vc_map(array(
            'name'                      => esc_html__('Counter', 'fleur'),
            'base'                      => $this->getBase(),
            'category'                  => 'by MIKADO',
            'admin_enqueue_css'         => array(fleur_mikado_get_skin_uri().'/assets/css/mkd-vc-extend.css'),
            'icon'                      => 'icon-wpb-counter extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                fleur_mikado_icon_collections()->getVCParamsArray(array(), '', true),
                array(
                    array(
                        'type'        => 'dropdown',
                        'admin_label' => true,
                        'heading'     => esc_html__('Type', 'fleur'),
                        'param_name'  => 'type',
                        'value'       => array(
                            esc_html__('Zero Counter', 'fleur')   => 'zero',
                            esc_html__('Random Counter', 'fleur') => 'random'
                        ),
                        'save_always' => true,
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
                        'description' => ''
                    ),
                    array(
                        'type'        => 'dropdown',
                        'admin_label' => true,
                        'heading'     => esc_html__('Digit style', 'fleur'),
                        'param_name'  => 'digit_style',
                        'value'       => array(
                            esc_html__('Dark', 'fleur')  => 'dark',
                            esc_html__('Light', 'fleur') => 'light'
                        ),
                        'description' => '',
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Digit', 'fleur'),
                        'param_name'  => 'digit',
                        'description' => ''
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Digit Font Size (px)', 'fleur'),
                        'param_name'  => 'font_size',
                        'description' => '',
                        'group'       => esc_html__('Advanced Options', 'fleur'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Title', 'fleur'),
                        'param_name'  => 'title',
                        'admin_label' => true,
                        'description' => ''
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Title Tag', 'fleur'),
                        'param_name'  => 'title_tag',
                        'value'       => array(
                            ''   => '',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6',
                        ),
                        'description' => ''
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Text', 'fleur'),
                        'param_name'  => 'text',
                        'admin_label' => true,
                        'description' => ''
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Padding Bottom(px)', 'fleur'),
                        'param_name'  => 'padding_bottom',
                        'description' => '',
                        'group'       => esc_html__('Advanced Options', 'fleur'),
                    ),
                )
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

        $args   = array(
            'type'            => '',
            'position'        => '',
            'digit'           => '',
            'underline_digit' => '',
            'title'           => '',
            'title_tag'       => 'h4',
            'font_size'       => '',
            'text'            => '',
            'padding_bottom'  => '',
            'digit_style'     => 'dark'

        );
        $args   = array_merge($args, fleur_mikado_icon_collections()->getShortcodeParams());
        $params = shortcode_atts($args, $atts);

        $counter_classes = array('mkd-counter-holder');

        if($params['digit_style'] === 'light') {
            $counter_classes[] = 'mkd-counter-light';
        }

        $counter_classes[] = $params['position'];

        $params['counter_classes'] = $counter_classes;

        //get correct heading value. If provided heading isn't valid get the default one
        $headings_array      = array('h2', 'h3', 'h4', 'h5', 'h6');
        $params['title_tag'] = (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];

        $params['counter_holder_styles'] = $this->getCounterHolderStyle($params);
        $params['counter_styles']        = $this->getCounterStyle($params);

        $iconPackName   = fleur_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
        $params['icon'] = $iconPackName ? $params[$iconPackName] : '';

        //Get HTML from template
        $html = fleur_mikado_get_shortcode_module_template_part('templates/counter-template', 'counter', '', $params);

        return $html;

    }

    /**
     * Return Counter holder styles
     *
     * @param $params
     *
     * @return string
     */
    private function getCounterHolderStyle($params) {
        $counterHolderStyle = array();

        if($params['padding_bottom'] !== '') {

            $counterHolderStyle[] = 'padding-bottom: '.$params['padding_bottom'].'px';

        }

        return implode(';', $counterHolderStyle);
    }

    /**
     * Return Counter styles
     *
     * @param $params
     *
     * @return string
     */
    private function getCounterStyle($params) {
        $counterStyle = array();

        if($params['font_size'] !== '') {
            $counterStyle[] = 'font-size: '.$params['font_size'].'px';
        }

        return implode(';', $counterStyle);
    }

}