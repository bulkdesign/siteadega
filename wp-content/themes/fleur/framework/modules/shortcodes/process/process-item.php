<?php
namespace Fleur\Modules\Shortcodes\Process;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessItem implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkd_process_item';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                    => esc_html__('Process Item', 'fleur'),
			'base'                    => $this->getBase(),
			'as_child'                => array('only' => 'mkd_process_holder'),
			'category'                => 'by MIKADO',
			'icon'                    => 'icon-wpb-process-item extended-custom-icon',
			'show_settings_on_create' => true,
			'params'                  => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Number', 'fleur'),
					'param_name'  => 'number',
					'save_always' => true,
					'admin_label' => true
				),
				array(
					"type"        => "dropdown",
					"class"       => "",
					"heading"     => esc_html__('Skin', 'fleur'),
					"param_name"  => "skin",
					"value"       => array(
						esc_html__('Default', 'fleur') => '',
						esc_html__('Light', 'fleur')   => 'light',
					),
					"save_always" => true,
					"description" => '',
					'admin_label' => true
				),
				array(
					'type'       => 'attach_image',
					'class'      => '',
					'heading'    => esc_html__('Background Image', 'fleur'),
					'param_name' => 'background_image',
					'value'      => '',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Title', 'fleur'),
					'param_name'  => 'title',
					'save_always' => true,
					'admin_label' => true
				),
				array(
					'type'        => 'textarea',
					'heading'     => esc_html__('Text', 'fleur'),
					'param_name'  => 'text',
					'save_always' => true,
					'admin_label' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'number' => '',
			'skin'   => '',
			'background_image' => '',
			'title'  => '',
			'text'   => '',
		);

		$params = shortcode_atts($default_atts, $atts);

		$params['item_classes'] = $this->getItemClasses($params);
		$params['item_styles'] = $this->getItemStyles($params);

		return fleur_mikado_get_shortcode_module_template_part('templates/process-item-template', 'process', '', $params);
	}

	private function getItemClasses($params) {
		$classes = array('mkd-process-item-holder');

		$classes[] = $params['skin'];

		return $classes;
	}

	private function getItemStyles($params) {
		$styles = array();

		if (($params['background_image']) !== '') {
			$styles[] = 'background-image: url(' . wp_get_attachment_url($params['background_image']) . ')';;
			$styles[] = 'background-color: transparent';
		}


		return $styles;
	}
}