<?php
namespace Fleur\Modules\ElementsHolderItem;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class ElementsHolderItem implements ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkd_elements_holder_item';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if (function_exists('vc_map')) {
			vc_map(
				array(
					'name'                    => esc_html__('Elements Holder Item', 'fleur'),
					'fleur',
					'base'                    => $this->base,
					'as_child'                => array('only' => 'mkd_elements_holder'),
					'as_parent'               => array('except' => 'vc_row, vc_accordion, no_cover_boxes, no_portfolio_list, no_portfolio_slider'),
					'content_element'         => true,
					'category'                => 'by MIKADO',
					'icon'                    => 'icon-wpb-elements-holder-item extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'colorpicker',
							'class'       => '',
							'heading'     => esc_html__('Background Color', 'fleur'),
							'param_name'  => 'background_color',
							'value'       => '',
							'description' => ''
						),
						array(
							'type'        => 'attach_image',
							'class'       => '',
							'heading'     => esc_html__('Background Image', 'fleur'),
							'param_name'  => 'background_image',
							'value'       => '',
							'description' => ''
						),
						array(
							'type'        => 'textfield',
							'class'       => '',
							'heading'     => esc_html__('Padding', 'fleur'),
							'param_name'  => 'item_padding',
							'value'       => '',
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'fleur')
						),
						array(
							'type'       => 'dropdown',
							'class'      => '',
							'heading'    => esc_html__('Border', 'fleur'),
							'param_name' => 'border',
							'value'      => array(
								esc_html__('No', 'fleur')  => 'no',
								esc_html__('Yes', 'fleur') => 'yes'
							)
						),
						array(
							'type'        => 'textfield',
							'class'       => '',
							'heading'     => esc_html__('Border Width', 'fleur'),
							'param_name'  => 'border_width',
							'value'       => '',
							'dependency'  => array(
								'element' => 'border',
								'value'   => array('yes')
							),
							'description' => esc_html__('Please insert border width in px. For example: 1 ', 'fleur')
						),
						array(
							'type'        => 'dropdown',
							'heading'     => esc_html__('Border Style', 'fleur'),
							'param_name'  => 'border_style',
							'value'       => array(
								esc_html__('Solid', 'fleur')  => 'solid',
								esc_html__('Dashed', 'fleur') => 'dashed',
								esc_html__('Dotted', 'fleur') => 'dotted'
							),
							'dependency'  => array(
								'element' => 'border',
								'value'   => array('yes')
							),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'class'      => '',
							'heading'    => esc_html__('Border Color', 'fleur'),
							'param_name' => 'border_color',
							'value'      => '',
							'dependency' => array(
								'element' => 'border',
								'value'   => array('yes')
							)
						),
						array(
							'type'        => 'dropdown',
							'class'       => '',
							'heading'     => esc_html__('Horizontal Alignment', 'fleur'),
							'param_name'  => 'horizontal_aligment',
							'value'       => array(
								esc_html__('Left', 'fleur')   => 'left',
								esc_html__('Right', 'fleur')  => 'right',
								esc_html__('Center', 'fleur') => 'center'
							),
							'description' => ''
						),
						array(
							'type'        => 'dropdown',
							'class'       => '',
							'heading'     => esc_html__('Vertical Alignment', 'fleur'),
							'param_name'  => 'vertical_alignment',
							'value'       => array(
								esc_html__('Middle', 'fleur') => 'middle',
								esc_html__('Top', 'fleur')    => 'top',
								esc_html__('Bottom', 'fleur') => 'bottom'
							),
							'description' => ''
						),
						array(
							'type'        => 'dropdown',
							'class'       => '',
							'heading'     => esc_html__('Animation Name', 'fleur'),
							'param_name'  => 'animation_name',
							'value'       => array(
								esc_html__('No Animation', 'fleur')          => '',
								esc_html__('Flip In', 'fleur')               => 'flip-in',
								esc_html__('Grow In', 'fleur')               => 'grow-in',
								esc_html__('X Rotate', 'fleur')              => 'x-rotate',
								esc_html__('Z Rotate', 'fleur')              => 'z-rotate',
								esc_html__('Y Translate', 'fleur')           => 'y-translate',
								esc_html__('Fade In', 'fleur')               => 'fade-in',
								esc_html__('Fade In Up', 'fleur')            => 'fade-in-up',
								esc_html__('Fade In Down', 'fleur')          => 'fade-in-down',
								esc_html__('Fade In Left', 'fleur')          => 'fade-in-left',
								esc_html__('Fade In Right', 'fleur')         => 'fade-in-right',
								esc_html__('Fade In Left X Rotate', 'fleur') => 'fade-in-left-x-rotate'
							),
							'description' => ''
						),
						array(
							'type'        => 'textfield',
							'class'       => '',
							'heading'     => esc_html__('Animation Delay (ms)', 'fleur'),
							'param_name'  => 'animation_delay',
							'value'       => '',
							'description' => '',
							'dependency'  => array('element' => 'animation_name', 'not_empty' => true)
						),
						array(
							'type'        => 'textfield',
							'class'       => '',
							'group'       => esc_html__('Width & Responsiveness', 'fleur'),
							'heading'     => esc_html__('Padding on screen size between 1280px-1440px', 'fleur'),
							'param_name'  => 'item_padding_1280_1440',
							'value'       => '',
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'fleur')
						),
						array(
							'type'        => 'textfield',
							'class'       => '',
							'group'       => esc_html__('Width & Responsiveness', 'fleur'),
							'heading'     => esc_html__('Padding on screen size between 1024px-1280px', 'fleur'),
							'param_name'  => 'item_padding_1024_1280',
							'value'       => '',
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'fleur')
						),
						array(
							'type'        => 'textfield',
							'class'       => '',
							'group'       => esc_html__('Width & Responsiveness', 'fleur'),
							'heading'     => esc_html__('Padding on screen size between 768px-1024px', 'fleur'),
							'param_name'  => 'item_padding_768_1024',
							'value'       => '',
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'fleur')
						),
						array(
							'type'        => 'textfield',
							'class'       => '',
							'group'       => esc_html__('Width & Responsiveness', 'fleur'),
							'heading'     => esc_html__('Padding on screen size between 600px-768px', 'fleur'),
							'param_name'  => 'item_padding_600_768',
							'value'       => '',
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'fleur')
						),
						array(
							'type'        => 'textfield',
							'class'       => '',
							'group'       => esc_html__('Width & Responsiveness', 'fleur'),
							'heading'     => esc_html__('Padding on screen size between 480px-600px', 'fleur'),
							'param_name'  => 'item_padding_480_600',
							'value'       => '',
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'fleur')
						),
						array(
							'type'        => 'textfield',
							'class'       => '',
							'group'       => esc_html__('Width & Responsiveness', 'fleur'),
							'heading'     => esc_html__('Padding on Screen Size Bellow 480px', 'fleur'),
							'param_name'  => 'item_padding_480',
							'value'       => '',
							'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'fleur')
						)
					)
				)
			);
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'background_color'       => '',
			'background_image'       => '',
			'item_padding'           => '',
			'border'                 => '',
			'border_width'           => '',
			'border_style'           => '',
			'border_color'           => '',
			'horizontal_aligment'    => 'left',
			'vertical_alignment'     => '',
			'animation_name'         => '',
			'animation_delay'        => '',
			'item_padding_1280_1440' => '',
			'item_padding_1024_1280' => '',
			'item_padding_768_1024'  => '',
			'item_padding_600_768'   => '',
			'item_padding_480_600'   => '',
			'item_padding_480'       => ''
		);

		$params = shortcode_atts($args, $atts);
		extract($params);
		$params['content'] = $content;

		$rand_class = 'mkd-elements-holder-custom-' . mt_rand(100000, 1000000);

		$params['elements_holder_item_style'] = $this->getElementsHolderItemStyle($params);
		$params['elements_holder_item_content_style'] = $this->getElementsHolderItemContentStyle($params);
		$params['elements_holder_item_class'] = $this->getElementsHolderItemClass($params);
		$params['elements_holder_item_content_class'] = $rand_class;
		$params['elements_holder_item_data'] = $this->getData($params);
		$params['element_holder_item_inner_classes'] = $this->getElementsHolderItemInnerClasses($params);
		$params['element_holder_item_inner_style'] = $this->getElementsHolderItemInnerStyle($params);

		$html = fleur_mikado_get_shortcode_module_template_part('templates/elements-holder-item-template', 'elements-holder', '', $params);

		return $html;
	}


	/**
	 * Return Elements Holder Item style
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getElementsHolderItemStyle($params) {

		$element_holder_item_style = array();

		if ($params['background_color'] !== '') {
			$element_holder_item_style[] = 'background-color: ' . $params['background_color'];
		}
		if ($params['background_image'] !== '') {
			$element_holder_item_style[] = 'background-image: url(' . wp_get_attachment_url($params['background_image']) . ')';
		}
		if ($params['animation_delay'] !== '') {
			$element_holder_item_style[] = 'transition-delay:' . $params['animation_delay'] . 'ms;' . '-webkit-transition-delay:' . $params['animation_delay'] . 'ms';
		}

		return implode(';', $element_holder_item_style);

	}

	/**
	 * Return Elements Holder Item Inner classes
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getElementsHolderItemInnerClasses($params) {
		$element_holder_item_inner_classes = array('mkd-elements-holder-item-inner');

		if ($params['border'] == 'yes') {
			$element_holder_item_inner_classes[] = 'mkd-border';
		}

		return $element_holder_item_inner_classes;
	}

	/**
	 * Return Elements Holder Item Inner style
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getElementsHolderItemInnerStyle($params) {
		$element_holder_item_inner_style = array('mkd-elements-holder-item-inner');

		if ($params['border_width'] !== '') {
			$element_holder_item_inner_style[] = 'border-width: ' . fleur_mikado_filter_px($params['border_width']) . 'px';
		}

		if ($params['border_style'] !== '') {
			$element_holder_item_inner_style[] = 'border-style: ' . $params['border_style'];
		}

		if ($params['border_color'] !== '') {
			$element_holder_item_inner_style[] = 'border-color: ' . $params['border_color'];
		}

		return $element_holder_item_inner_style;
	}

	/**
	 * Return Elements Holder Item Content style
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getElementsHolderItemContentStyle($params) {

		$element_holder_item_content_style = array();

		if ($params['item_padding'] !== '') {
			$element_holder_item_content_style[] = 'padding: ' . $params['item_padding'];
		}

		return implode(';', $element_holder_item_content_style);

	}

	/**
	 * Return Elements Holder Item classes
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getElementsHolderItemClass($params) {

		$element_holder_item_class = array();

		if ($params['vertical_alignment'] !== '') {
			$element_holder_item_class[] = 'mkd-vertical-alignment-' . $params['vertical_alignment'];
		}

		if ($params['horizontal_aligment'] !== '') {
			$element_holder_item_class[] = 'mkd-horizontal-alignment-' . $params['horizontal_aligment'];
		}

		if ($params['animation_name'] !== '') {
			$element_holder_item_class[] = 'mkd-' . $params['animation_name'];
		}


		return implode(' ', $element_holder_item_class);

	}

	private function getData($params) {
		$data = array();

		if ($params['animation_name'] !== '') {
			$data['data-animation'] = 'mkd-' . $params['animation_name'];
		}

		$data['data-item-class'] = $params['elements_holder_item_content_class'];

		if ($params['item_padding_1280_1440'] !== '') {
			$data['data-1280-1440'] = $params['item_padding_1280_1440'];
		}

		if ($params['item_padding_1024_1280'] !== '') {
			$data['data-1024-1280'] = $params['item_padding_1024_1280'];
		}

		if ($params['item_padding_768_1024'] !== '') {
			$data['data-768-1024'] = $params['item_padding_768_1024'];
		}

		if ($params['item_padding_600_768'] !== '') {
			$data['data-600-768'] = $params['item_padding_600_768'];
		}

		if ($params['item_padding_480_600'] !== '') {
			$data['data-480-600'] = $params['item_padding_480_600'];
		}

		if ($params['item_padding_480'] !== '') {
			$data['data-480'] = $params['item_padding_480'];
		}

		return $data;
	}
}
