<?php

defined( 'ABSPATH' ) OR exit;

abstract class EZFC_WC_Hooks {
	static function init() {
		// woocommerce calculation
		add_action("woocommerce_before_calculate_totals", array(__CLASS__, "add_custom_price"));

		// show selected values on checkout page?
		if (get_option("ezfc_woocommerce_checkout_details") == 1) {
			add_filter("woocommerce_get_item_data", array(__CLASS__, "woo_add_item_data"), 10, 2);

			// checkout / emails
			add_action("woocommerce_add_order_item_meta", array(__CLASS__, "woo_add_order_item_meta"), 10, 3);

			// remove unwanted details on checkout
			add_action("woocommerce_order_item_get_formatted_meta_data", array(__CLASS__, "woo_order_item_meta"), 10, 2);
		}

		// email
		add_action("woocommerce_checkout_order_processed", array(__CLASS__, "woo_send_mails"), 10, 2);
		// pdf
		//add_filter("woocommerce_email_attachments", array(__CLASS__, "woo_add_email_pdf"), 10, 2);
	}

	/**
		woocommerce custom price hook
	**/
	static function add_custom_price( $cart_object ) {
		foreach ( $cart_object->cart_contents as $key => $value ) {
			// do not mess with other products
			if (!isset($value["ezfc_total"])) continue;
			
			// change price
			$value["data"]->set_price($value["ezfc_total"]);
		}
	}

	/**
		woocommerce add cart item data
	**/
	static function woo_add_item_data( $cart_array, $cart_data ) {
		// do not mess with other products
		if (!isset($cart_data["ezfc_values"])) return $cart_array;

		// add edit link
		if (get_option("ezfc_woocommerce_enable_edit", 1)) {
			if (method_exists($cart_data["data"], "get_id")) {
				$product_link = $cart_data["data"]->get_id();
			}
			else {
				$product_link = get_permalink($cart_data["data"]->id);
			}

			if (!empty($cart_data["ezfc_cart_product_key"])) {
				$edit_link = esc_url(add_query_arg("ezfc_cart_product_key", $cart_data["ezfc_cart_product_key"], $product_link));
			}
			// compatibility for old cart-items
			else {
				$edit_link = esc_url(add_query_arg("ezfc_edit_values", $cart_data["ezfc_edit_values"], $product_link));
			}

			$edit_text = get_option("ezfc_woocommerce_edit_text", __("Edit", "ezfc"));

			$cart_data["ezfc_values"]     .= "<br><a href='{$edit_link}'>{$edit_text}</a>";
			$cart_data["ezfc_raw_values"]  = $cart_data["ezfc_edit_values"];
		}
		
		return array(array(
			"name"  => get_option("ezfc_woocommerce_checkout_details_text"),
			"value" => $cart_data["ezfc_values"]
		));
	}

	/**
		woocommerce add item data to checkout / emails
	**/
	static function woo_add_order_item_meta($item_id, $values, $cart_item_key) {
		if (!empty($values["ezfc_values"])) {
			wc_add_order_item_meta($item_id, get_option("ezfc_woocommerce_checkout_details_text"), $values["ezfc_values"]);
			wc_add_order_item_meta($item_id, "ezfc_raw_values", $values["ezfc_edit_values"]);
			wc_add_order_item_meta($item_id, "ezfc_form_id", $values["ezfc_form_id"]);
		}
	}

	/**
		woocommerce send emails after checkout
	**/
	static function woo_send_mails($order_id) {
		$order = new WC_Order($order_id);

		if (!$order) return;

		require_once(EZFC_PATH . "class.ezfc_frontend.php");
		$ezfc = new Ezfc_frontend();

		$send_mails = false;
		$send_mails_option = 0;
		$email_output = array(
			"admin" => "",
			"user"  => ""
		);

		$items = $order->get_items();
		foreach ($items as $item) {
			// do not mess with other products
			if (empty($item["ezfc_raw_values"]) || empty($item["ezfc_form_id"])) continue;

			$customer_mail   = "";
			$raw_values      = array("ezfc_element" => unserialize($item["ezfc_raw_values"]));
			$ezfc->prepare_submission_data($item["ezfc_form_id"], $raw_values);
			$ezfc->replace_values["wc_order_id"] = $order_id;

			$send_mails_option = $ezfc->submission_data["options"]["woo_send_order_mails"];
			// no emails should be sent
			if (!$send_mails_option) continue;

			// set send mails flag
			$send_mails = true;

			// build output
			$tmp_output = $ezfc->get_mail_output($ezfc->submission_data);
			$email_output["admin"] .= $tmp_output["admin"] . "<br>";
			$email_output["user"]  .= $tmp_output["user"] . "<br>";
		}

		// send mails
		if (!empty($email_output)) {
			$send_to_admin = $send_mails_option == "admin" || $send_mails_option == "both";
			// add customer email
			if ($send_mails_option == "both") $customer_mail = get_post_meta($order->id, "_billing_email", true);

			$ezfc->send_mails(false, $email_output, $customer_mail, false, $ezfc->submission_data, array(
				"send_to_admin" => $send_to_admin
			));
		}
	}

	/**
		woocommerce add pdf to emails
	**/
	static function woo_add_email_pdf($attachments, $status) {
		// only for new orders
		if ($status != "new_order") return $attachments;

		// todo
		
		return $attachments;
	}

	/**
	 * unset ezfc_form_id meta
	 */
	static function woo_order_item_meta($formatted_meta, $order) {
		foreach ($formatted_meta as $id => $meta) {
			if ($meta->key == "ezfc_form_id") {
				unset($formatted_meta[$id]);
				break;
			}
		}

		return $formatted_meta;
	}
}

EZFC_WC_Hooks::init();