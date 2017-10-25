<?php

namespace Fleur\Modules\AccordionTab;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * class Accordions
 */
class AccordionTab implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	function __construct() {
		$this->base = 'mkd_accordion_tab';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if (function_exists('vc_map')) {
			vc_map(array(
				"name"                    => esc_html__('Mikado Accordion Tab', 'fleur'),
				"base"                    => $this->base,
				"as_parent"               => array('except' => 'vc_row'),
				"as_child"                => array('only' => 'mkd_accordion'),
				'is_container'            => true,
				"category"                => 'by MIKADO',
				"icon"                    => "icon-wpb-accordion-section extended-custom-icon",
				"show_settings_on_create" => true,
				"js_view"                 => 'VcColumnView',
				'params'                  => array_merge(
					fleur_mikado_icon_collections()->getVCParamsArray(array(), '', true),
					array(
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__('Title', 'fleur'),
							'param_name'  => 'title',
							'admin_label' => true,
							'value'       => esc_html__('Section', 'fleur'),
							'description' => esc_html__('Enter accordion section title.', 'fleur')
						),
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__('Number', 'fleur'),
							'param_name'  => 'number',
							'admin_label' => true,
							'description' => esc_html__('Enter a number of your section.', 'fleur')
						),
						array(
							'type'        => 'colorpicker',
							'heading'     => esc_html__('Number Color', 'fleur'),
							'param_name'  => 'number_color',
							'admin_label' => true
						),
						array(
							'type'        => 'el_id',
							'heading'     => esc_html__('Section ID', 'fleur'),
							'param_name'  => 'el_id',
							'description' => sprintf(esc_html__('Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'fleur'), '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">' . esc_html__('link', 'fleur') . '</a>'),
						),
					)
				)
			));
		}
	}


	public function render($atts, $content = null) {

		$default_atts = (array(
			'title'        => esc_html__('Accordion Title', 'fleur'),
			'number'       => '',
			'el_id'        => '',
			'number_color' => ''
		));

		$default_atts = array_merge($default_atts, fleur_mikado_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($default_atts, $atts);

		$iconPackName = fleur_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$params['icon'] = $iconPackName ? $params[$iconPackName] : '';

		$params['link_params'] = $this->getLinkParams($params);
		$params['color_number'] = $this->getNumberStyles($params);

		$params['tab_title_classes'] = $this->getClasses($params)['title'];
		$params['tab_content_classes'] = $this->getClasses($params)['content'];

		extract($params);
		$params['content'] = $content;

		$output = '';

		$output .= fleur_mikado_get_shortcode_module_template_part('templates/accordion-template', 'accordions', '', $params);

		return $output;

	}

	private function getLinkParams($params) {
		$linkParams = array();

		if (!empty($params['link']) && !empty($params['link_text'])) {
			$linkParams['link'] = $params['link'];
			$linkParams['link_text'] = $params['link_text'];

			$linkParams['link_target'] = !empty($params['link_target']) ? $params['link_target'] : '_self';
		}

		return $linkParams;
	}

	private function getNumberStyles($params) {
		$styles = array();

		if ($params['number_color'] !== '') {
			$styles = 'color: ' . $params['number_color'];
		}

		return $styles;
	}

	private function getClasses($params) {
		$classes['title'] = array('mkd-tab-title');
		$classes['content'] = array('mkd-accordion-content');

		if ($params['icon']) {
			$classes['title'][] = 'mkd-with-icon';
			$classes['content'][] = 'mkd-with-icon';
		}

		return $classes;
	}

}