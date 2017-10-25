<?php

if(!function_exists('fleur_mikado_woo_single_style')) {

	function fleur_mikado_woo_single_style() {

		$styles = array();

		if(fleur_mikado_options()->getOptionValue('hide_product_info') === 'yes') {
			$styles['display'] = 'none';
		}

		$selector = array(
			'.single.single-product .product_meta'
		);

		echo fleur_mikado_dynamic_css($selector, $styles);

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_woo_single_style');

}

?>