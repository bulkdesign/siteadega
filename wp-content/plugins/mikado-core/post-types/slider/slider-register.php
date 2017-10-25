<?php
namespace MikadoCore\CPT\Slider;

use MikadoCore\Lib;

/**
 * Class SliderRegister
 * @package MikadoCore\CPT\Slider
 */
class SliderRegister implements Lib\PostTypeInterface {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base    = 'slides';
		$this->taxBase = 'slides_category';
	}

	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Registers custom post type with WordPress
	 */
	public function register() {
		$this->registerPostType();
		$this->registerTax();
	}

	/**
	 * Registers custom post type with WordPress
	 */
	private function registerPostType() {
		global $fleur_Framework;

		$menuPosition = 5;
		$menuIcon     = 'dashicons-admin-post';

		if(mkd_core_theme_installed()) {
			$menuPosition = $fleur_Framework->getSkin()->getMenuItemPosition('slider');
			$menuIcon     = $fleur_Framework->getSkin()->getMenuIcon('slider');
		}

		register_post_type($this->base,
			array(
				'labels'        => array(
					'name'          => __('Mikado Slider', 'mkd_core'),
					'menu_name'     => __('Mikado Slider', 'mkd_core'),
					'all_items'     => __('Slides', 'mkd_core'),
					'add_new'       => __('Add New Slide', 'mkd_core'),
					'singular_name' => __('Slide', 'mkd_core'),
					'add_item'      => __('New Slide', 'mkd_core'),
					'add_new_item'  => __('Add New Slide', 'mkd_core'),
					'edit_item'     => __('Edit Slide', 'mkd_core')
				),
				'public'        => false,
				'show_in_menu'  => true,
				'rewrite'       => array('slug' => 'slides'),
				'menu_position' => $menuPosition,
				'show_ui'       => true,
				'has_archive'   => false,
				'hierarchical'  => false,
				'supports'      => array('title', 'thumbnail', 'page-attributes'),
				'menu_icon'     => $menuIcon
			)
		);
	}

	/**
	 * Registers custom taxonomy with WordPress
	 */
	private function registerTax() {
		$labels = array(
			'name'              => __('Sliders', 'mkd_core'),
			'singular_name'     => __('Slider', 'mkd_core'),
			'search_items'      => __('Search Sliders', 'mkd_core'),
			'all_items'         => __('All Sliders', 'mkd_core'),
			'parent_item'       => __('Parent Slider', 'mkd_core'),
			'parent_item_colon' => __('Parent Slider:', 'mkd_core'),
			'edit_item'         => __('Edit Slider', 'mkd_core'),
			'update_item'       => __('Update Slider', 'mkd_core'),
			'add_new_item'      => __('Add New Slider', 'mkd_core'),
			'new_item_name'     => __('New Slider Name', 'mkd_core'),
			'menu_name'         => __('Sliders', 'mkd_core'),
		);

		register_taxonomy($this->taxBase, array($this->base), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite'           => array('slug' => 'slides-category'),
		));
	}
}