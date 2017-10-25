<?php

/**
 * Widget that adds separator boxes type
 *
 * Class Separator_Widget
 */
class FleurMikadoSeparatorWidget extends FleurMikadoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_separator_widget', // Base ID
            esc_html__('Mikado Separator Widget', 'fleur') // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type'    => 'dropdown',
                'title'   => esc_html__('Type', 'fleur'),
                'name'    => 'type',
                'options' => array(
                    'normal'     => esc_html__('Normal', 'fleur'),
                    'full-width' => esc_html__('Full Width', 'fleur')
                )
            ),
            array(
                'type'    => 'dropdown',
                'title'   => esc_html__('Position', 'fleur'),
                'name'    => 'position',
                'options' => array(
                    'center' => esc_html__('Center', 'fleur'),
                    'left'   => esc_html__('Left', 'fleur'),
                    'right'  => esc_html__('Right', 'fleur')
                )
            ),
            array(
                'type'    => 'dropdown',
                'title'   => esc_html__('Style', 'fleur'),
                'name'    => 'border_style',
                'options' => array(
                    'solid'  => esc_html__('Solid', 'fleur'),
                    'dashed' => esc_html__('Dashed', 'fleur'),
                    'dotted' => esc_html__('Dotted', 'fleur')
                )
            ),
            array(
                'type'  => 'textfield',
                'title' => esc_html__('Color', 'fleur'),
                'name'  => 'color'
            ),
            array(
                'type'        => 'textfield',
                'title'       => esc_html__('Width', 'fleur'),
                'name'        => 'width',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'title'       => esc_html__('Thickness (px)', 'fleur'),
                'name'        => 'thickness',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'title'       => esc_html__('Top Margin', 'fleur'),
                'name'        => 'top_margin',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'title'       => esc_html__('Bottom Margin', 'fleur'),
                'name'        => 'bottom_margin',
                'description' => ''
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        extract($args);

        //prepare variables
        $params = '';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params .= " $key='$value' ";
            }
        }

        echo '<div class="widget mkd-separator-widget">';

        //finally call the shortcode
        echo do_shortcode("[mkd_separator $params]"); // XSS OK

        echo '</div>'; //close div.mkd-separator-widget
    }
}