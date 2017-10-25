<?php

if (!function_exists('fleur_mikado_woocommerce_products_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 12
	 * @return int number of products to be shown per page
	 */
	function fleur_mikado_woocommerce_products_per_page() {

		$products_per_page = 12;

		if (fleur_mikado_options()->getOptionValue('mkd_woo_products_per_page')) {
			$products_per_page = fleur_mikado_options()->getOptionValue('mkd_woo_products_per_page');
		}

		return $products_per_page;

	}

}

if (!function_exists('fleur_mikado_woocommerce_cart_no_shipping_available_html')) {
	function fleur_mikado_woocommerce_cart_no_shipping_available_html() {
		return esc_html__('No shipping available', 'fleur');
	}
}

if (!function_exists('fleur_mikado_alter_woo_pagination')) {
	function fleur_mikado_alter_woo_pagination($args) {
		$args['prev_text'] = '<span class="mkd-left">' . esc_html__('Anterior', 'fleur') . '</span>';
		$args['next_text'] = '<span class="mkd-right">' . esc_html__('Próxima', 'fleur') . '</span>';
		return $args;
	}
}

if (!function_exists('fleur_mikado_woocommerce_cart_categories')) {
	function fleur_mikado_woocommerce_cart_categories($product_item, $cart_item, $cart_item_key) {

        $product_id = $cart_item['product_id'];
        $categories = wp_get_post_terms($product_id, 'product_cat');

        echo '<span class="mkd-woo-title">' . $cart_item['data']->get_title() . '</span>';
        if(!empty($categories)) {
            foreach ($categories as $cat) {
                echo '<a itemprop="url" class="qodef-pi-category-item" href="'.esc_url(get_term_link($cat->term_id)).'">'.esc_html($cat->name).'</a>';
            }
        }
	}
}


if (!function_exists('fleur_mikado_woocommerce_related_products_args')) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 *
	 * @param $args array array of args for the query
	 *
	 * @return mixed array of changed args
	 */
	function fleur_mikado_woocommerce_related_products_args($args) {

		if (fleur_mikado_options()->getOptionValue('mkd_woo_product_list_columns')) {

			$related = fleur_mikado_options()->getOptionValue('mkd_woo_product_list_columns');
			switch ($related) {
				case 'mkd-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'mkd-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}

		} else {
			$args['posts_per_page'] = 3;
		}

		return $args;

	}

}

if (!function_exists('fleur_mikado_woocommerce_template_loop_product_title')) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function fleur_mikado_woocommerce_template_loop_product_title() {

		$tag = fleur_mikado_options()->getOptionValue('mkd_products_list_title_tag');
		the_title('<' . $tag . ' class="mkd-product-list-product-title">', '</' . $tag . '>');

	}

}

if (!function_exists('fleur_mikado_woocommerce_template_single_title')) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function fleur_mikado_woocommerce_template_single_title() {

		$tag = fleur_mikado_options()->getOptionValue('mkd_single_product_title_tag');
		the_title('<' . $tag . '  itemprop="name" class="mkd-single-product-title">', '</' . $tag . '>');

	}

}

if (!function_exists('fleur_mikado_woocommerce_sale_flash')) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function fleur_mikado_woocommerce_sale_flash() {

		return '<span class="mkd-onsale">' . esc_html__('Sale', 'fleur') . '</span>';

	}

}

if (!function_exists('fleur_mikado_woocommerce_product_out_of_stock')) {
	/**
	 * Function for adding Out Of Stock Template
	 *
	 * @return string
	 */
	function fleur_mikado_woocommerce_product_out_of_stock() {

		global $product;

		if (!$product->is_in_stock()) {
			print '<span class="mkd-out-of-stock">' . esc_html__('SOLD', 'fleur') . '</span>';
		}
	}
}

if (!function_exists('fleur_mikado_custom_override_checkout_fields')) {
	/**
	 * Overrides placeholder values for checkout fields
	 *
	 * @param array all checkout fields
	 *
	 * @return array checkout fields with overriden values
	 */
	function fleur_mikado_custom_override_checkout_fields($fields) {
		//billing fields
		$args_billing = array(
			'first_name' => esc_html__('First name', 'fleur'),
			'last_name'  => esc_html__('Last name', 'fleur'),
			'company'    => esc_html__('Company name', 'fleur'),
			'address_1'  => esc_html__('Address', 'fleur'),
			'email'      => esc_html__('Email', 'fleur'),
			'phone'      => esc_html__('Phone', 'fleur'),
			'postcode'   => esc_html__('Postcode / ZIP', 'fleur'),
			'state'      => esc_html__('State / County', 'fleur')
		);

		//shipping fields
		$args_shipping = array(
			'first_name' => esc_html__('First name', 'fleur'),
			'last_name'  => esc_html__('Last name', 'fleur'),
			'company'    => esc_html__('Company name', 'fleur'),
			'address_1'  => esc_html__('Address', 'fleur'),
			'postcode'   => esc_html__('Postcode / ZIP', 'fleur')
		);

		//override billing placeholder values
		foreach ($args_billing as $key => $value) {
			$fields["billing"]["billing_{$key}"]["placeholder"] = $value;
		}

		//override shipping placeholder values
		foreach ($args_shipping as $key => $value) {
			$fields["shipping"]["shipping_{$key}"]["placeholder"] = $value;
		}

		return $fields;
	}

}

if (!function_exists('fleur_mikado_woocommerce_loop_add_to_cart_link')) {
	/**
	 * Function that overrides default woocommerce add to cart button on product list
	 * Uses HTML from mkd_button
	 *
	 * @return mixed|string
	 */
	function fleur_mikado_woocommerce_loop_add_to_cart_link() {

		global $product;

		$button_url = $product->add_to_cart_url();
		$button_classes = sprintf('%s %s product_type_%s',
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
			$product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
            esc_attr($product->get_type())
		);
		$button_text = $product->add_to_cart_text();
		$button_attrs = array(
			'rel'              => 'nofollow',
            'data-product_id'  => esc_attr($product->get_id()),
			'data-product_sku' => esc_attr($product->get_sku()),
			'data-quantity'    => esc_attr(isset($quantity) ? $quantity : 1)
		);


		$add_to_cart_button = fleur_mikado_get_button_html(
			array(
				'link'         => $button_url,
				'custom_class' => $button_classes,
				'text'         => $button_text,
				'custom_attrs' => $button_attrs,
				'type'         => 'outline',
				'size'         => 'small'
			)
		);

		return $add_to_cart_button;

	}

}

if (!function_exists('fleur_mikado_woocommerce_loop_add_to_cart_text')) {

	function fleur_mikado_woocommerce_loop_add_to_cart_text($add_to_cart_text = '') {
		$add_to_cart_text = esc_html__('Purchase', 'fleur');

		return $add_to_cart_text;
	}
}

if (!function_exists('fleur_mikado_woocommerce_new_product_mark')) {
	/**
	 * Function for adding New Product Template
	 *
	 * @return string
	 */
	function fleur_mikado_woocommerce_new_product_mark() {
		global $product;

		if (get_post_meta($product->get_id(), 'mkd_single_product_new_meta', true) === 'yes') {
			print '<span class="mkd-new-product">' . esc_html__('NEW', 'fleur') . '</span>';
		}
	}
}

if (!function_exists('fleur_mikado_get_woocommerce_add_to_cart_button')) {
	/**
	 * Function that overrides default woocommerce add to cart button on simple and grouped product single template
	 * Uses HTML from mkd_button
	 */
	function fleur_mikado_get_woocommerce_add_to_cart_button() {

		global $product;

		$add_to_cart_button = fleur_mikado_get_button_html(
			array(
				'custom_class'   => 'single_add_to_cart_button alt',
				'text'           => $product->single_add_to_cart_text(),
				'html_type'      => 'button',
				'icon_pack'      => 'linear_icons',
				'linear_icon'    => 'lnr-cart',
				'text_transform' => 'none',
				'type'           => 'solid',
                'custom_attrs'  => array('name' => 'add-to-cart', 'value' => $product->get_id())
			)
		);

		print $add_to_cart_button;

	}

}

if (!function_exists('fleur_mikado_get_woocommerce_add_to_cart_button_external')) {
	/**
	 * Function that overrides default woocommerce add to cart button on external product single template
	 * Uses HTML from mkd_button
	 */
	function fleur_mikado_get_woocommerce_add_to_cart_button_external() {

		global $product;

		$add_to_cart_button = fleur_mikado_get_button_html(
			array(
				'link'           => $product->add_to_cart_url(),
				'custom_class'   => 'single_add_to_cart_button alt',
				'text'           => $product->single_add_to_cart_text(),
				'custom_attrs'   => array(
					'rel' => 'nofollow'
				),
				'icon_pack'      => 'linear_icons',
				'linear_icon'    => 'lnr-cart',
				'text_transform' => 'none',
				'type'           => 'solid'
			)
		);

		print $add_to_cart_button;

	}

}

if (!function_exists('fleur_mikado_woocommerce_single_variation_add_to_cart_button')) {
	/**
	 * Function that overrides default woocommerce add to cart button on variable product single template
	 * Uses HTML from mkd_button
	 */
	function fleur_mikado_woocommerce_single_variation_add_to_cart_button() {
		global $product;

		$html = '<div class="variations_button">';
		woocommerce_quantity_input(array('input_value' => isset($_POST['quantity']) ? wc_stock_amount($_POST['quantity']) : 1));

		$button = fleur_mikado_get_button_html(array(
			'html_type'      => 'button',
			'custom_class'   => 'single_add_to_cart_button alt',
			'text'           => $product->single_add_to_cart_text(),
			'icon_pack'      => 'linear_icons',
			'linear_icon'    => 'lnr-cart',
			'text_transform' => 'none',
			'type'           => 'solid'
		));

		$html .= $button;

        $html .= '<input type="hidden" name="add-to-cart" value="' . absint($product->get_id()) . '" />';
        $html .= '<input type="hidden" name="product_id" value="' . absint($product->get_id()) . '" />';
		$html .= '<input type="hidden" name="variation_id" class="variation_id" value="" />';
		$html .= '</div>';

		print $html;

	}

}

if (!function_exists('fleur_mikado_get_woocommerce_apply_coupon_button')) {
	/**
	 * Function that overrides default woocommerce apply coupon button
	 * Uses HTML from mkd_button
	 */
	function fleur_mikado_get_woocommerce_apply_coupon_button() {

		$coupon_button = fleur_mikado_get_button_html(array(
			'html_type'  => 'input',
			'input_name' => 'apply_coupon',
			'text'       => esc_html__('Apply Coupon', 'fleur')
		));

		print $coupon_button;

	}

}

if (!function_exists('fleur_mikado_get_woocommerce_update_cart_button')) {
	/**
	 * Function that overrides default woocommerce update cart button
	 * Uses HTML from mkd_button
	 */
	function fleur_mikado_get_woocommerce_update_cart_button() {

		$update_cart_button = fleur_mikado_get_button_html(array(
			'html_type'  => 'input',
			'input_name' => 'update_cart',
			'text'       => esc_html__('Update Cart', 'fleur'),
			'type'       => 'outline'
		));

		print $update_cart_button;

	}

}

if (!function_exists('fleur_mikado_woocommerce_button_proceed_to_checkout')) {
	/**
	 * Function that overrides default woocommerce proceed to checkout button
	 * Uses HTML from mkd_button
	 */
	function fleur_mikado_woocommerce_button_proceed_to_checkout() {

		$proceed_to_checkout_button = fleur_mikado_get_button_html(array(
			'link'         => WC()->cart->get_checkout_url(),
			'custom_class' => 'checkout-button alt wc-forward',
			'text'         => esc_html__('Checkout', 'fleur'),
			'type'         => 'outline'
		));

		print $proceed_to_checkout_button;

	}

}

if (!function_exists('fleur_mikado_get_woocommerce_update_totals_button')) {
	/**
	 * Function that overrides default woocommerce update totals button
	 * Uses HTML from mkd_button
	 */
	function fleur_mikado_get_woocommerce_update_totals_button() {

		$update_totals_button = fleur_mikado_get_button_html(array(
			'html_type'    => 'button',
			'text'         => esc_html__('Update Totals', 'fleur'),
			'custom_attrs' => array(
				'value' => 1,
				'name'  => 'calc_shipping'
			)
		));

		print $update_totals_button;

	}

}

if (!function_exists('fleur_mikado_woocommerce_pay_order_button_html')) {
	/**
	 * Function that overrides default woocommerce pay order button on checkout page
	 * Uses HTML from mkd_button
	 */
	function fleur_mikado_woocommerce_pay_order_button_html() {

		$pay_order_button_text = esc_html__('Pay for order', 'fleur');

		$place_order_button = fleur_mikado_get_button_html(array(
			'html_type'    => 'input',
			'custom_class' => 'alt',
			'custom_attrs' => array(
				'id'         => 'place_order',
				'data-value' => $pay_order_button_text
			),
			'text'         => $pay_order_button_text,
		));

		return $place_order_button;

	}

}

if (!function_exists('fleur_mikado_woocommerce_order_button_html')) {
	/**
	 * Function that overrides default woocommerce place order button on checkout page
	 * Uses HTML from mkd_button
	 */
	function fleur_mikado_woocommerce_order_button_html() {

		$pay_order_button_text = esc_html__('Place Order', 'fleur');

		$place_order_button = fleur_mikado_get_button_html(array(
			'html_type'    => 'input',
			'custom_class' => 'alt',
			'custom_attrs' => array(
				'id'         => 'place_order',
				'data-value' => $pay_order_button_text,
				'name'       => 'woocommerce_checkout_place_order'
			),
			'text'         => $pay_order_button_text,
			'type'         => 'outline'
		));

		return $place_order_button;

	}

}

if (!function_exists('fleur_mikado_woocommerce_stock_html')) {
	function fleur_mikado_woocommerce_stock_html($availability_html, $availability = false, $product = null) {
		return '<td class="stock">' . $availability_html . '</td>';
	}
}