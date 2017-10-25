<?php

//WooCommerce
if (fleur_mikado_is_woocommerce_installed()) {


	if (!function_exists('fleur_mikado_woocommerce_meta_box_map')) {
		function fleur_mikado_woocommerce_meta_box_map() {

			$woocommerce_meta_box = fleur_mikado_add_meta_box(
				array(
					'scope' => array('product'),
					'title' => esc_html__('Product Meta', 'fleur'),
					'name'  => 'woo_product_meta'
				)
			);

			fleur_mikado_add_meta_box_field(array(
				'name'        => 'mkd_single_product_new_meta',
				'type'        => 'select',
				'label'       => esc_html__('Enable New Product Mark', 'fleur'),
				'description' => esc_html__('Enabling this option will show new product mark on your product lists and product single', 'fleur'),
				'parent'      => $woocommerce_meta_box,
				'options'     => array(
					'no'  => esc_html__('No', 'fleur'),
					'yes' => esc_html__('Yes', 'fleur')
				)
			));
		}

		add_action('fleur_mikado_meta_boxes_map', 'fleur_mikado_woocommerce_meta_box_map');
	}
}