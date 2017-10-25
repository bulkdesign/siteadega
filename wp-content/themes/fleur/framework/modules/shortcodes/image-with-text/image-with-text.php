<?php
namespace Fleur\Modules\Shortcodes\ImageWithText;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ImageWithTextOver
 */
class ImageWithText implements ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkd_image_with_text';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map(array(
			'name'                      => esc_html__('Image With Text', 'fleur'),
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-image-with-text extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'attach_image',
					'admin_label' => true,
					'heading'     => esc_html__('Image', 'fleur'),
					'param_name'  => 'image',
					'description' => ''
				),
				array(
					'type'        => 'dropdown',
					'admin_label' => true,
					'heading'     => esc_html__('Title tag', 'fleur'),
					'param_name'  => 'title_tag',
					'value'       => array(
						'p'  => 'p',
						'h1' => 'h1',
						'h2' => 'h2',
						'h3' => 'h3',
						'h4' => 'h4',
						'h5' => 'h5',
						'h6' => 'h6',
					),
					'save_always' => true,
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
					'admin_label' => true,
					'heading'     => esc_html__('Text', 'fleur'),
					'param_name'  => 'text',
					'description' => ''
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__('Link', 'fleur'),
					'param_name'  => 'link',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Link Target', 'fleur'),
					'param_name'  => 'link_target',
					'value'       => array(
						esc_html__('Same Window', 'fleur') => '_self',
						esc_html__('New Window', 'fleur')  => '_blank'
					),
					'dependency'  => array(
						'element'   => 'link',
						'not_empty' => true
					),
					'save_always' => true
				)
			)
		));

	}

	public function render($atts, $content = null) {

		$args = array(
			'image'       => '',
			'title_tag'   => '',
			'text'        => '',
			'title'       => '',
			'link'        => '',
			'link_target' => '_self'
		);

		$params = shortcode_atts($args, $atts);

		$html = fleur_mikado_get_shortcode_module_template_part('templates/image-with-text-template', 'image-with-text', '', $params);

		return $html;
	}
}