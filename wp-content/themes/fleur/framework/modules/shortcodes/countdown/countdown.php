<?php
namespace Fleur\Modules\Counter;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Countdown
 */
class Countdown implements ShortcodeInterface {

    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkd_countdown';

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
            'name'                      => esc_html__('Countdown', 'fleur'),
            'base'                      => $this->getBase(),
            'category'                  => 'by MIKADO',
            'admin_enqueue_css'         => array(fleur_mikado_get_skin_uri().'/assets/css/mkd-vc-extend.css'),
            'icon'                      => 'icon-wpb-countdown extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Type', 'fleur'),
                    'param_name'  => 'countdown_type',
                    'value'       => array(
                        esc_html__('Type 1', 'fleur') => 'countdown_type_one',
                        esc_html__('Type 2', 'fleur') => 'countdown_type_two'
                    ),
                    'admin_label' => true,
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Year', 'fleur'),
                    'param_name'  => 'year',
                    'value'       => array(
                        ''     => '',
                        '2017' => '2017',
                        '2018' => '2018',
                        '2019' => '2019',
                        '2020' => '2020',
                        '2021' => '2021',
						'2022' => '2022'
                    ),
                    'admin_label' => true,
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Month', 'fleur'),
                    'param_name'  => 'month',
                    'value'       => array(
                        ''                             => '',
                        esc_html__('January', 'fleur')   => '1',
                        esc_html__('February', 'fleur')  => '2',
                        esc_html__('March', 'fleur')     => '3',
                        esc_html__('April', 'fleur')     => '4',
                        esc_html__('May', 'fleur')       => '5',
                        esc_html__('June', 'fleur')      => '6',
                        esc_html__('July', 'fleur')      => '7',
                        esc_html__('August', 'fleur')    => '8',
                        esc_html__('September', 'fleur') => '9',
                        esc_html__('October', 'fleur')   => '10',
                        esc_html__('November', 'fleur')  => '11',
                        esc_html__('December', 'fleur')  => '12'
                    ),
                    'admin_label' => true,
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Day', 'fleur'),
                    'param_name'  => 'day',
                    'value'       => array(
                        ''   => '',
                        '1'  => '1',
                        '2'  => '2',
                        '3'  => '3',
                        '4'  => '4',
                        '5'  => '5',
                        '6'  => '6',
                        '7'  => '7',
                        '8'  => '8',
                        '9'  => '9',
                        '10' => '10',
                        '11' => '11',
                        '12' => '12',
                        '13' => '13',
                        '14' => '14',
                        '15' => '15',
                        '16' => '16',
                        '17' => '17',
                        '18' => '18',
                        '19' => '19',
                        '20' => '20',
                        '21' => '21',
                        '22' => '22',
                        '23' => '23',
                        '24' => '24',
                        '25' => '25',
                        '26' => '26',
                        '27' => '27',
                        '28' => '28',
                        '29' => '29',
                        '30' => '30',
                        '31' => '31',
                    ),
                    'admin_label' => true,
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Hour', 'fleur'),
                    'param_name'  => 'hour',
                    'value'       => array(
                        ''   => '',
                        '0'  => '0',
                        '1'  => '1',
                        '2'  => '2',
                        '3'  => '3',
                        '4'  => '4',
                        '5'  => '5',
                        '6'  => '6',
                        '7'  => '7',
                        '8'  => '8',
                        '9'  => '9',
                        '10' => '10',
                        '11' => '11',
                        '12' => '12',
                        '13' => '13',
                        '14' => '14',
                        '15' => '15',
                        '16' => '16',
                        '17' => '17',
                        '18' => '18',
                        '19' => '19',
                        '20' => '20',
                        '21' => '21',
                        '22' => '22',
                        '23' => '23',
                        '24' => '24'
                    ),
                    'admin_label' => true,
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Minute', 'fleur'),
                    'param_name'  => 'minute',
                    'value'       => array(
                        ''   => '',
                        '0'  => '0',
                        '1'  => '1',
                        '2'  => '2',
                        '3'  => '3',
                        '4'  => '4',
                        '5'  => '5',
                        '6'  => '6',
                        '7'  => '7',
                        '8'  => '8',
                        '9'  => '9',
                        '10' => '10',
                        '11' => '11',
                        '12' => '12',
                        '13' => '13',
                        '14' => '14',
                        '15' => '15',
                        '16' => '16',
                        '17' => '17',
                        '18' => '18',
                        '19' => '19',
                        '20' => '20',
                        '21' => '21',
                        '22' => '22',
                        '23' => '23',
                        '24' => '24',
                        '25' => '25',
                        '26' => '26',
                        '27' => '27',
                        '28' => '28',
                        '29' => '29',
                        '30' => '30',
                        '31' => '31',
                        '32' => '32',
                        '33' => '33',
                        '34' => '34',
                        '35' => '35',
                        '36' => '36',
                        '37' => '37',
                        '38' => '38',
                        '39' => '39',
                        '40' => '40',
                        '41' => '41',
                        '42' => '42',
                        '43' => '43',
                        '44' => '44',
                        '45' => '45',
                        '46' => '46',
                        '47' => '47',
                        '48' => '48',
                        '49' => '49',
                        '50' => '50',
                        '51' => '51',
                        '52' => '52',
                        '53' => '53',
                        '54' => '54',
                        '55' => '55',
                        '56' => '56',
                        '57' => '57',
                        '58' => '58',
                        '59' => '59',
                        '60' => '60',
                    ),
                    'admin_label' => true,
                    'save_always' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Month Label', 'fleur'),
                    'param_name'  => 'month_label',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Day Label', 'fleur'),
                    'param_name'  => 'day_label',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Hour Label', 'fleur'),
                    'param_name'  => 'hour_label',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Minute Label', 'fleur'),
                    'param_name'  => 'minute_label',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Second Label', 'fleur'),
                    'param_name'  => 'second_label',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Digit Font Size (px)', 'fleur'),
                    'param_name'  => 'digit_font_size',
                    'description' => '',
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Digit color', 'fleur'),
                    'param_name'  => 'digit_color',
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Label Font Size (px)', 'fleur'),
                    'param_name'  => 'label_font_size',
                    'description' => '',
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Label color', 'fleur'),
                    'param_name'  => 'label_color',
                    'group'       => esc_html__('Advanced Options', 'fleur'),
                    'admin_label' => true
                ),

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
            'countdown_type'  => 'countdown_type_one',
            'year'            => '',
            'month'           => '',
            'day'             => '',
            'hour'            => '',
            'minute'          => '',
            'month_label'     => 'Months',
            'day_label'       => 'Days',
            'hour_label'      => 'Hours',
            'minute_label'    => 'Minutes',
            'second_label'    => 'Seconds',
            'digit_font_size' => '',
            'digit_color'     => '',
            'label_font_size' => '',
            'label_color'     => ''
        );

        $params = shortcode_atts($args, $atts);

        $params['id'] = mt_rand(1000, 9999);

        //Get HTML from template

        if($params['countdown_type'] == 'countdown_type_one') {
            $html = fleur_mikado_get_shortcode_module_template_part('templates/countdown-template-one', 'countdown', '', $params);
        } else {
            $html = fleur_mikado_get_shortcode_module_template_part('templates/countdown-template-two', 'countdown', '', $params);
        }

        return $html;

    }
}