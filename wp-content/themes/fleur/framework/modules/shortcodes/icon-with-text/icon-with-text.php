<?php
namespace Fleur\Modules\Shortcodes\IconWithText;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class IconWithText
 * @package Fleur\Modules\Shortcodes\IconWithText
 */
class IconWithText implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 *
	 */
	public function __construct() {
		$this->base = 'mkd_icon_with_text';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 *
	 */
	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Icon With Text', 'fleur'),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-icon-with-text extended-custom-icon',
			'category'                  => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'params'                    => array_merge(
				fleur_mikado_icon_collections()->getVCParamsArray(array(), '', true),
				array(
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Custom Icon', 'fleur'),
						'param_name' => 'custom_icon'
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Icon Position', 'fleur'),
						'param_name'  => 'icon_position',
						'value'       => array(
							esc_html__('Top', 'fleur')             => 'top',
							esc_html__('Left', 'fleur')            => 'left',
							esc_html__('Left From Title', 'fleur') => 'left-from-title',
							esc_html__('Right', 'fleur')           => 'right'
						),
						'description' => esc_html__('Icon Position', 'fleur'),
						'save_always' => true,
						'admin_label' => true
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Icon Type', 'fleur'),
						'param_name'  => 'icon_type',
						'value'       => array(
							esc_html__('Normal', 'fleur') => 'normal',
							esc_html__('Circle', 'fleur') => 'circle',
							esc_html__('Square', 'fleur') => 'square'
						),
						'save_always' => true,
						'admin_label' => true,
						'group'       => esc_html__('Icon Settings', 'fleur'),
						'description' => esc_html__('This attribute doesn\'t work when Icon Position is Top. In This case Icon Type is Normal', 'fleur'),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Icon Size', 'fleur'),
						'param_name'  => 'icon_size',
						'value'       => array(
							esc_html__('Tiny', 'fleur')       => 'mkd-icon-tiny',
							esc_html__('Small', 'fleur')      => 'mkd-icon-small',
							esc_html__('Medium', 'fleur')     => 'mkd-icon-medium',
							esc_html__('Large', 'fleur')      => 'mkd-icon-large',
							esc_html__('Very Large', 'fleur') => 'mkd-icon-huge'
						),
						'admin_label' => true,
						'save_always' => true,
						'group'       => esc_html__('Icon Settings', 'fleur'),
						'description' => esc_html__('This attribute doesn\'t work when Icon Position is Top', 'fleur')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Custom Icon Size (px)', 'fleur'),
						'param_name' => 'custom_icon_size',
						'group'      => esc_html__('Icon Settings', 'fleur'),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Icon Animation', 'fleur'),
						'param_name'  => 'icon_animation',
						'value'       => array(
							esc_html__('No', 'fleur')  => '',
							esc_html__('Yes', 'fleur') => 'yes'
						),
						'group'       => esc_html__('Icon Settings', 'fleur'),
						'save_always' => true,
						'admin_label' => true
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon Animation Delay (ms)', 'fleur'),
						'param_name' => 'icon_animation_delay',
						'group'      => esc_html__('Icon Settings', 'fleur'),
						'dependency' => array('element' => 'icon_animation', 'value' => array('yes'))
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Icon Margin', 'fleur'),
						'param_name'  => 'icon_margin',
						'value'       => '',
						'description' => esc_html__('Margin should be set in a top right bottom left format', 'fleur'),
						'admin_label' => true,
						'group'       => esc_html__('Icon Settings', 'fleur'),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Shape Size (px)', 'fleur'),
						'param_name'  => 'shape_size',
						'description' => '',
						'admin_label' => true,
						'group'       => esc_html__('Icon Settings', 'fleur'),
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon Color', 'fleur'),
						'param_name' => 'icon_color',
						'group'      => esc_html__('Icon Settings', 'fleur'),
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon Hover Color', 'fleur'),
						'param_name' => 'icon_hover_color',
						'group'      => esc_html__('Icon Settings', 'fleur'),
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Icon Background Color', 'fleur'),
						'param_name'  => 'icon_background_color',
						'description' => esc_html__('Icon Background Color (only for square and circle icon type)', 'fleur'),
						'dependency'  => array('element' => 'icon_type', 'value' => array('square', 'circle')),
						'group'       => esc_html__('Icon Settings', 'fleur'),
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Icon Hover Background Color', 'fleur'),
						'param_name'  => 'icon_hover_background_color',
						'description' => esc_html__('Icon Hover Background Color (only for square and circle icon type)', 'fleur'),
						'dependency'  => array('element' => 'icon_type', 'value' => array('square', 'circle')),
						'group'       => esc_html__('Icon Settings', 'fleur'),
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Icon Border Color', 'fleur'),
						'param_name'  => 'icon_border_color',
						'description' => esc_html__('Only for Square and Circle Icon type', 'fleur'),
						'dependency'  => array('element' => 'icon_type', 'value' => array('square', 'circle')),
						'group'       => esc_html__('Icon Settings', 'fleur'),
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Icon Border Hover Color', 'fleur'),
						'param_name'  => 'icon_border_hover_color',
						'description' => esc_html__('Only for Square and Circle Icon type', 'fleur'),
						'dependency'  => array('element' => 'icon_type', 'value' => array('square', 'circle')),
						'group'       => esc_html__('Icon Settings', 'fleur'),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Border Width', 'fleur'),
						'param_name'  => 'icon_border_width',
						'description' => esc_html__('Only for Square and Circle Icon type', 'fleur'),
						'dependency'  => array('element' => 'icon_type', 'value' => array('square', 'circle')),
						'group'       => esc_html__('Icon Settings', 'fleur'),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Title', 'fleur'),
						'param_name'  => 'title',
						'value'       => '',
						'admin_label' => true
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Title Tag', 'fleur'),
						'param_name' => 'title_tag',
						'value'      => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'dependency' => array('element' => 'title', 'not_empty' => true),
						'group'      => esc_html__('Text Settings', 'fleur'),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Title Text Transform', 'fleur'),
						'param_name'  => 'title_text_transform',
						'value'       => array_flip(fleur_mikado_get_text_transform_array(true)),
						'save_always' => true,
						'group'       => esc_html__('Text Settings', 'fleur'),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Title Text Font Weight', 'fleur'),
						'param_name'  => 'title_text_font_weight',
						'value'       => array_flip(fleur_mikado_get_font_weight_array(true)),
						'save_always' => true,
						'group'       => esc_html__('Text Settings', 'fleur'),
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Title Color', 'fleur'),
						'param_name' => 'title_color',
						'dependency' => array('element' => 'title', 'not_empty' => true),
						'group'      => esc_html__('Text Settings', 'fleur'),
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('Text', 'fleur'),
						'param_name' => 'text'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Text Color', 'fleur'),
						'param_name' => 'text_color',
						'dependency' => array('element' => 'text', 'not_empty' => true),
						'group'      => esc_html__('Text Settings', 'fleur'),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Link', 'fleur'),
						'param_name'  => 'link',
						'value'       => '',
						'admin_label' => true
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Link Text', 'fleur'),
						'param_name' => 'link_text',
						'dependency' => array('element' => 'link', 'not_empty' => true)
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Target', 'fleur'),
						'param_name' => 'target',
						'value'      => array(
							''      => '',
							'Self'  => '_self',
							'Blank' => '_blank'
						),
						'dependency' => array('element' => 'link', 'not_empty' => true),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Text Left Padding (px)', 'fleur'),
						'param_name' => 'text_left_padding',
						'dependency' => array('element' => 'icon_position', 'value' => array('left')),
						'group'      => esc_html__('Text Settings', 'fleur'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Text Right Padding (px)', 'fleur'),
						'param_name' => 'text_right_padding',
						'dependency' => array('element' => 'icon_position', 'value' => array('right')),
						'group'      => esc_html__('Text Settings', 'fleur'),
					)
				)
			)
		));
	}

	/**
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$default_atts = array(
			'custom_icon'                 => '',
			'icon_position'               => '',
			'icon_type'                   => '',
			'icon_size'                   => '',
			'custom_icon_size'            => '',
			'icon_animation'              => '',
			'icon_animation_delay'        => '',
			'icon_margin'                 => '',
			'shape_size'                  => '',
			'icon_color'                  => '',
			'icon_hover_color'            => '',
			'icon_background_color'       => '',
			'icon_hover_background_color' => '',
			'icon_border_color'           => '',
			'icon_border_hover_color'     => '',
			'icon_border_width'           => '',
			'title'                       => '',
			'title_tag'                   => 'h4',
			'title_text_transform'        => '',
			'title_text_font_weight'      => '',
			'title_color'                 => '',
			'text'                        => '',
			'text_color'                  => '',
			'link'                        => '',
			'link_text'                   => '',
			'target'                      => '_self',
			'text_left_padding'           => '',
			'text_right_padding'          => ''
		);

		$default_atts = array_merge($default_atts, fleur_mikado_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($default_atts, $atts);

		$params['icon_parameters'] = $this->getIconParameters($params);
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['title_styles'] = $this->getTitleStyles($params);
		$params['content_styles'] = $this->getContentStyles($params);
		$params['custom_icon_styles'] = $this->getCustomIconStyles($params);
		$params['text_styles'] = $this->getTextStyles($params);

		return fleur_mikado_get_shortcode_module_template_part('templates/iwt', 'icon-with-text', $params['icon_position'], $params);
	}

	/**
	 * Returns parameters for icon shortcode as a string
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getIconParameters($params) {
		$params_array = array();

		if (empty($params['custom_icon'])) {
			$iconPackName = fleur_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

			$params_array['icon_pack'] = $params['icon_pack'];
			if ($params['icon_pack']) {
				$params_array[$iconPackName] = $params[$iconPackName];
			}

			if (!empty($params['icon_size'])) {
				$params_array['size'] = $params['icon_size'];
			}

			if (!empty($params['custom_icon_size'])) {
				$params_array['custom_size'] = $params['custom_icon_size'];
			}

			if (!empty($params['icon_type'])) {
				$params_array['type'] = $params['icon_type'];
			}

			$params_array['shape_size'] = $params['shape_size'];

			if (!empty($params['icon_border_color'])) {
				$params_array['border_color'] = $params['icon_border_color'];
			}

			if (!empty($params['icon_border_hover_color'])) {
				$params_array['hover_border_color'] = $params['icon_border_hover_color'];
			}

			if (!empty($params['icon_border_width'])) {
				$params_array['border_width'] = $params['icon_border_width'];
			}

			if (!empty($params['icon_background_color'])) {
				$params_array['background_color'] = $params['icon_background_color'];
			}

			if (!empty($params['icon_hover_background_color'])) {
				$params_array['hover_background_color'] = $params['icon_hover_background_color'];
			}

			$params_array['icon_color'] = $params['icon_color'];

			if (!empty($params['icon_hover_color'])) {
				$params_array['hover_icon_color'] = $params['icon_hover_color'];
			}

			$params_array['icon_animation'] = $params['icon_animation'];
			$params_array['icon_animation_delay'] = $params['icon_animation_delay'];
			$params_array['margin'] = $params['icon_margin'];
		}

		return $params_array;
	}

	/**
	 * Returns array of holder classes
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getHolderClasses($params) {
		$classes = array('mkd-iwt', 'clearfix');

		if (!empty($params['icon_position'])) {
			switch ($params['icon_position']) {
				case 'top':
					$classes[] = 'mkd-iwt-icon-top';
					break;
				case 'left':
					$classes[] = 'mkd-iwt-icon-left';
					break;
				case 'right':
					$classes[] = 'mkd-iwt-icon-right';
					break;
				case 'left-from-title':
					$classes[] = 'mkd-iwt-left-from-title';
					break;
				default:
					break;
			}
		}

		if (!empty($params['icon_size'])) {
			$classes[] = 'mkd-iwt-' . str_replace('mkd-', '', $params['icon_size']);
		}

		return $classes;
	}

	private function getTitleStyles($params) {
		$styles = array();

		if (!empty($params['title_color'])) {
			$styles[] = 'color: ' . $params['title_color'];
		}

		if (!empty($params['title_text_transform'])) {
			$styles[] = 'text-transform: ' . $params['title_text_transform'];
		}

		if (!empty($params['title_text_font_weight'])) {
			$styles[] = 'font-weight: ' . $params['title_text_font_weight'];
		}

		return $styles;
	}

	private function getTextStyles($params) {
		$styles = array();

		if (!empty($params['text_color'])) {
			$styles[] = 'color: ' . $params['text_color'];
		}

		return $styles;
	}

	private function getContentStyles($params) {
		$styles = array();

		if ($params['icon_position'] == 'left' && !empty($params['text_left_padding'])) {
			$styles[] = 'padding-left: ' . fleur_mikado_filter_px($params['text_left_padding']) . 'px';
		}

		if ($params['icon_position'] == 'right' && !empty($params['text_right_padding'])) {
			$styles[] = 'padding-right: ' . fleur_mikado_filter_px($params['text_right_padding']) . 'px';
		}

		return $styles;
	}

	private function getCustomIconStyles($params) {
		$styles = array();

		if (!empty($params['icon_margin'])) {
			$styles[] = 'margin: ' . $params['icon_margin'];
		}

		return $styles;
	}
}