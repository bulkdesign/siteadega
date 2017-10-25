<?php
namespace Fleur\Modules\SeparatorWithIcon;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class SeparatorWithIcon implements ShortcodeInterface {

	private $base;

	function __construct() {
		$this->base = 'mkd_separator_with_icon';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map(
			array(
				'name'                    => esc_html__('Separator With Icon', 'fleur'),
				'base'                    => $this->base,
				'category'                => 'by MIKADO',
				'icon'                    => 'icon-wpb-separator-with-icon extended-custom-icon',
				'show_settings_on_create' => true,
				'class'                   => 'wpb_vc_separator_with_icon',
				'params'                  => array_merge(
					fleur_mikado_icon_collections()->getVCParamsArray(array(), '', true),
					array(
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__('Separator Color', 'fleur'),
							'param_name' => 'sep_color',
							'value'      => ''
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
			));

	}

	public function render($atts, $content = null) {
		$args = array(
			'sep_color'     => '',
			'top_margin'    => '',
			'bottom_margin' => ''
		);

		$default_atts = array_merge($args, fleur_mikado_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($default_atts, $atts);

		$iconPackName = fleur_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

		extract($params);

		if ($params['icon_pack']) {
			$params['icon'] = $params[$iconPackName];
		}

		$params['separator_holder_style'] = $this->getSeparatorHolderStyle($params);

		$params['separator_style'] = $this->getSeparatorStyle($params);
		$params['separator_class'] = $this->getSeparatorClass($params);


		$html = fleur_mikado_get_shortcode_module_template_part('templates/separator-with-icon', 'separator-with-icon', '', $params);

		return $html;
	}

	private function getSeparatorHolderStyle($params) {
		$styles = array();

		if ($params['top_margin'] !== '') {
			$styles[] = 'margin-top: ' . fleur_mikado_filter_px($params['top_margin']) . 'px';
		}

		if ($params['bottom_margin'] !== '') {
			$styles[] = 'margin-bottom: ' . fleur_mikado_filter_px($params['bottom_margin']) . 'px';
		}

		return $styles;
	}

	private function getSeparatorStyle($params) {
		$styles = array();

		if ($params['sep_color'] !== '') {
			$styles[] = 'background-color: ' . $params['sep_color'];
		}

		return $styles;
	}

	private function getSeparatorClass($params) {
		$classes = array('mkd-separator-with-icon-holder', 'clearfix');

		if ($params['icon_pack'] !== '') {
			$classes[] = 'mkd-custom-icon';
		} else {
			$classes[] = 'mkd-default-icon';
		}

		return $classes;
	}
}