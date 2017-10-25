<?php
namespace MikadoCore\CPT\Portfolio\Shortcodes;

use MikadoCore\Lib;
use MikadoCore\CPT\Portfolio\Lib\PortfolioQuery;

/**
 * Class PortfolioSlider
 * @package MikadoCore\CPT\Portfolio\Shortcodes
 */
class PortfolioSlider implements Lib\ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkd_portfolio_slider';

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
	 * Maps shortcode to Visual Composer
	 *
	 * @see vc_map()
	 */
	public function vcMap() {
		if (function_exists('vc_map')) {
			vc_map(array(
					'name'                      => 'Portfolio Slider',
					'base'                      => $this->base,
					'category'                  => 'by MIKADO',
					'icon'                      => 'icon-wpb-portfolio-slider extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
							array(
								'type'        => 'dropdown',
								'admin_label' => true,
								'heading'     => 'Slider Type',
								'param_name'  => 'slider_type',
								'value'       => array(
									'Standard' => 'standard-slider',
									'Gallery'  => 'masonry-slider',
									'Variable' => 'variable-slider'
								),
								'group'       => 'Layout Options',
							),
							array(
								'type'        => 'dropdown',
								'admin_label' => true,
								'heading'     => 'Image size',
								'param_name'  => 'image_size',
								'value'       => array(
									'Default'       => '',
									'Original Size' => 'full',
									'Square'        => 'square',
									'Landscape'     => 'landscape',
									'Portrait'      => 'portrait',
									'Custom'        => 'custom'
								),
								'description' => '',
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'textfield',
								'admin_label' => true,
								'heading'     => 'Image Dimensions',
								'param_name'  => 'custom_image_dimensions',
								'value'       => '',
								'description' => 'Enter custom image dimensions. Enter image size in pixels: 200x100 (Width x Height)',
								'group'       => 'Layout Options',
								'dependency'  => array('element' => 'image_size', 'value' => 'custom')
							),
							array(
								'type'        => 'dropdown',
								'heading'     => 'Number of Columns',
								'param_name'  => 'columns',
								'admin_label' => true,
								'value'       => array(
									'One'   => '1',
									'Two'   => '2',
									'Three' => '3',
									'Four'  => '4'
								),
								'description' => 'Number of portfolios that are showing at the same time in full width (on smaller screens is responsive so there will be less items shown)',
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => 'Title Tag',
								'param_name'  => 'title_tag',
								'value'       => array(
									''   => '',
									'h2' => 'h2',
									'h3' => 'h3',
									'h4' => 'h4',
									'h5' => 'h5',
									'h6' => 'h6',
								),
								'description' => '',
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => 'Enable AutoPlay?',
								'param_name'  => 'enable_autoplay',
								'value'       => array(
									'Yes' => 'yes',
									'No'  => 'no'
								),
								'save_always' => true,
								'description' => '',
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => 'Enable Pagination?',
								'param_name'  => 'enable_pagination',
								'value'       => array(
									'Yes' => 'yes',
									'No'  => 'no'
								),
								'save_always' => true,
								'description' => '',
								'dependency'  => array('element' => 'slider_type', 'value' => 'variable-slider'),
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => 'Show Read More Button?',
								'param_name'  => 'show_read_more_button',
								'value'       => array(
									'Yes' => 'yes',
									'No'  => 'no'
								),
								'save_always' => true,
								'description' => '',
								'dependency'  => array('element' => 'slider_type', 'value' => 'standard-slider'),
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'textfield',
								'class'       => '',
								'heading'     => 'Excerpt Length',
								'param_name'  => 'excerpt_length',
								'save_always' => true,
								'description' => '',
								'dependency'  => array('element' => 'slider_type', 'value' => array('standard-slider', 'variable-slider')),
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => 'Style',
								'param_name'  => 'style',
								'value'       => array(
									'Default' => '',
									'Light'   => 'light',
									'Dark'    => 'dark'
								),
								'save_always' => true,
								'description' => '',
								'group'       => 'Layout Options'
							),
							array(
								'type'        => 'dropdown',
								'heading'     => 'Show Category?',
								'param_name'  => 'show_category',
								'value'       => array(
									''    => '',
									'Yes' => 'yes',
									'No'  => 'no'
								),
								'admin_label' => true,
								'save_always' => true,
								'dependency'  => array(
									'element' => 'slider_type',
									'value'   => array('variable-slider')
								),
								'group'       => 'Layout Options'
							)
						),
						PortfolioQuery::getInstance()->queryVCParams()
					)
				)
			);
		}
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
			'image_size'              => 'full',
			'title_tag'               => 'h4',
			'columns'                 => '1',
			'enable_pagination'       => 'yes',
			'enable_autoplay'         => 'yes',
			'show_read_more_button'   => 'yes',
			'excerpt_length'          => '90',
			'style'                   => '',
			'custom_image_dimensions' => '',
			'show_category'           => '',
			'slider_type'             => 'standard-slider'
		);

		$args = array_merge($args, PortfolioQuery::getInstance()->getShortcodeAtts());
		$params = shortcode_atts($args, $atts);

		$query = PortfolioQuery::getInstance()->buildQueryObject($params);

		$params['query'] = $query;
		$params['holder_data'] = $this->getHolderData($params);
		$params['thumb_size'] = $this->getThumbSize($params);
		$params['caller'] = $this;
		$params['holder_classes'] = $this->getHolderClasses($params);

		$params['use_custom_image_size'] = false;
		if ($params['thumb_size'] === 'custom' && !empty($params['custom_image_dimensions'])) {
			$params['use_custom_image_size'] = true;
			$params['custom_image_sizes'] = $this->getCustomImageSize($params['custom_image_dimensions']);
		}

		return mkd_core_get_shortcode_module_template_part('portfolio-slider/templates/' . $params['slider_type'], 'portfolio', '', $params);
	}

	private function getHolderData($params) {
		$data = array();

		$data['data-columns'] = $params['columns'];
		$data['data-enable-pagination'] = $params['enable_pagination'];
		$data['data-enable-autoplay'] = $params['enable_autoplay'];

		return $data;
	}

	public function getThumbSize($params) {
		switch ($params['image_size']) {
			case 'landscape':
				$thumbSize = 'fleur_mikado_landscape';
				break;
			case 'portrait':
				$thumbSize = 'fleur_mikado_portrait';
				break;
			case 'square':
				$thumbSize = 'fleur_mikado_square';
				break;
			case 'full':
				$thumbSize = 'full';
				break;
			case 'custom':
				$thumbSize = 'custom';
				break;
			default:
				$thumbSize = 'full';
				break;
		}

		return $thumbSize;
	}

	public function itemExcerpt($textLength) {
		$excerpt = ($textLength > 0) ? substr(get_the_excerpt(), 0, intval($textLength)) : get_the_excerpt();

		return $excerpt;
	}

	private function getHolderClasses($params) {
		$classes = array(
			'mkd-portfolio-slider-holder',
			'mkd-carousel-pagination'
		);

		if ($params['slider_type'] == 'variable-slider') {
			$classes[] = 'mkd-variable-slider';
		}

		if ($params['style'] !== '') {
			$classes[] = 'mkd-portfolio-slider-' . $params['style'];
		}

		if (($params['show_read_more_button'] !== 'no') && ($params['slider_type'] == 'standard-slider')) {
			$classes[] = 'mkd-portfolio-slider-with-read-more';
		}

		return $classes;
	}

	private function getCustomImageSize($customImageSize) {
		$imageSize = trim($customImageSize);
		//Find digits
		preg_match_all('/\d+/', $imageSize, $matches);
		if (!empty($matches[0])) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		}

		return false;
	}
}