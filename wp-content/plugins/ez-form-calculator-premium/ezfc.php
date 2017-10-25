<?php
/*
Plugin Name: ez Form Calculator Premium
Plugin URI: http://ez-form-calculator.ezplugins.de/
Description: With ez Form Calculator, you can simply create a form calculator for both yourself and your customers. Easily add basic form elements like checkboxes, dropdown menus, radio buttons etc. with only a few clicks. Each form element can be assigned a value which will be calculated automatically.
Version: 2.9.9.3
Author: Michael Schuppenies
Author URI: http://www.ezplugins.de/
Text Domain: ezfc
Domain Path: /lang
*/

defined( 'ABSPATH' ) OR exit;

if (defined("EZFC_VERSION")) return;

/**
	setup
**/
define("EZFC_VERSION", "2.9.9.3");
define("EZFC_PATH", trailingslashit(plugin_dir_path(__FILE__)));
define("EZFC_SLUG", plugin_basename(__FILE__));
define("EZFC_URL", plugin_dir_url(__FILE__));
define("EZFC_UPDATE_URL", "http://www.ezplugins.de/licensing/versions.php?slug=ezfc");

define("EZFC_PAYMENT_ID_DEFAULT", 0);
define("EZFC_PAYMENT_ID_PAYPAL", 1);
define("EZFC_PAYMENT_ID_STRIPE", 2);

// ez functions
require_once(EZFC_PATH . "class.ezfc_functions.php");

// wrapper
function ezfc_get_version() {
	return EZFC_VERSION;
}

/**
	install
**/
function ezfc_register() {
	require_once(EZFC_PATH . "ezfc-register.php");
}

/**
	uninstall
**/
function ezfc_uninstall() {
	require_once(EZFC_PATH . "ezfc-uninstall.php");
}

// hooks
register_activation_hook(__FILE__, "ezfc_register");
register_uninstall_hook(__FILE__, "ezfc_uninstall");

// custom filter
add_filter("ezfc_custom_filter_test", "ezfc_test_filter", 0, 2);
function ezfc_test_filter($element_data, $input_value) {
	if ($input_value%2 == 1) {
		return array("error" => "Error!");
	}
}


class EZFC_Premium {
	/**
		init plugin
	**/
	static function init() {
		// setup pages
		add_action("admin_menu", array(__CLASS__, "admin_menu"));
		// check for updates
		add_action("init", array(__CLASS__, "check_updates"));
		// load languages
		add_action("plugins_loaded", array(__CLASS__, "load_hooks"));

		// load backend scripts / styles
		add_action("admin_enqueue_scripts", array(__CLASS__, "load_scripts"));

		// settings page
		$ezfc_plugin_name = plugin_basename(__FILE__);
		add_filter("plugin_action_links_{$ezfc_plugin_name}", array(__CLASS__, "plugin_settings_page"));

		// ** ajax **
		// backend
		add_action("wp_ajax_ezfc_backend", array(__CLASS__, "ajax"));
		// frontend
		add_action("wp_ajax_ezfc_frontend", array(__CLASS__, "ajax_frontend"));
		add_action("wp_ajax_nopriv_ezfc_frontend", array(__CLASS__, "ajax_frontend"));
		// frontend fileupload
		add_action("wp_ajax_ezfc_frontend_fileupload", array(__CLASS__, "ajax_fileupload"));
		add_action("wp_ajax_nopriv_ezfc_frontend_fileupload", array(__CLASS__, "ajax_fileupload"));

		// tinymce
		add_action("admin_head", array(__CLASS__, "tinymce"));
		add_action("admin_print_scripts", array(__CLASS__, "tinymce_script"));

		// widget
		add_action("widgets_init", array(__CLASS__, "register_widget"));

		// download file
		add_action("init", array(__CLASS__, "download_file_add_rewrite_rule"));
		add_filter("query_vars", array(__CLASS__, "download_file_add_query_vars"));
		add_action("parse_request", array(__CLASS__, "download_file_parse_request"));

		// paypal ipn listener
		if (get_option("ezfc_pp_enable_ipn", 0) == 1 && version_compare(PHP_VERSION, "5.3.0") >= 0) {
			// preparations
			add_action("init", array(__CLASS__, "paypal_add_rewrite_rule"));
			add_filter("query_vars", array(__CLASS__, "paypal_add_query_vars"));
			add_action("parse_request", array(__CLASS__, "paypal_parse_request"));
		}

		if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
			require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		}
	}

	/**
		admin pages
	**/
	static function admin_menu() {
		// user role
		$role = get_option("ezfc_user_roles", "administrator");
		
		require_once(EZFC_PATH . "class.ezfc_backend.php");
		$ezfc_backend = new Ezfc_backend();

		// Check license. I know you can hide the notification, but please keep in mind that someone (ahem) needs to make a living.
		// Everytime you hide this notification manually, I'm pretty sure a kitten dies or someone installs IE. Still no remorse? Go ahead, you cruel little tightwad, you.
		if (substr($_SERVER['REMOTE_ADDR'], 0, 4) != '127.' && $_SERVER['REMOTE_ADDR'] != '::1') {
			$licensed = get_option("ezfc_license_activated", 0)==1;

			if (!$licensed) {
				add_action('admin_notices', array( __CLASS__, "show_register_notice" ));
			}
		}

		// setup pages
		add_menu_page("ezfc", "ez Form Calculator", $role, "ezfc", array(__CLASS__, "page_main"), EZFC_URL . "assets/img/ez-icon.png");
		add_submenu_page("ezfc", __("Form settings", "ezfc"), __("Form settings", "ezfc"), $role, "ezfc-settings-form", array(__CLASS__, "page_settings_form"));
		add_submenu_page("ezfc", __("Global settings", "ezfc"), __("Global settings", "ezfc"), $role, "ezfc-options", array(__CLASS__, "page_settings"));
		add_submenu_page("ezfc", __("Form submissions", "ezfc"), __("Form submissions", "ezfc"), $role, "ezfc-submissions", array(__CLASS__, "page_submissions"));
		add_submenu_page("ezfc", __("Import / export", "ezfc"), __("Import / Export", "ezfc"), $role, "ezfc-importexport", array(__CLASS__, "page_importexport"));
		add_submenu_page("ezfc", __("Help / debug", "ezfc"), __("Help / debug", "ezfc"), $role, "ezfc-help", array(__CLASS__, "page_help"));
		add_submenu_page("ezfc", __("Licensing", "ezfc"), __("Licensing", "ezfc"), $role, "ezfc-licensing", array(__CLASS__, "page_licensing"));
		add_submenu_page("ezfc", __("Preview", "ezfc"), __("Preview", "ezfc"), $role, "ezfc-preview", array(__CLASS__, "page_preview"));
		add_submenu_page("ezfc", __("Templates", "ezfc"), __("Templates", "ezfc"), $role, "ezfc-templates", array(__CLASS__, "page_templates"));
		//add_submenu_page("ezfc", __("Wizard", "ezfc"), __("Wizard", "ezfc"), $role, "ezfc-wizard", array(__CLASS__, "page_wizard"));
		add_submenu_page("ezfc", __("Elements Chart", "ezfc"), __("Elements Chart", "ezfc"), $role, "ezfc-chart", array(__CLASS__, "page_chart"));
	}

	static function show_register_notice() {
		echo '
		<div class="updated">
		  <p>' . __("Hello! Please register your license to receive automatic updates for <strong>ez Form Calculator Premium</strong>.", "ezfc") . ' <a href="' . admin_url('admin.php') . '?page=ezfc-licensing">' . __("Register license", "ezfc") . '</a></p>
		</div>';
	}

	static function page_main() {
		require_once(EZFC_PATH . "ezfc-page-main.php");
	}

	static function page_settings_form() {
		require_once(EZFC_PATH . "ezfc-page-settings-form.php");
	}

	static function page_settings() {
		require_once(EZFC_PATH . "ezfc-page-settings.php");
	}

	static function page_importexport() {
		require_once(EZFC_PATH . "ezfc-page-importexport.php");
	}

	static function page_help() {
		require_once(EZFC_PATH . "ezfc-page-help.php");
	}

	static function page_licensing() {
		require_once(EZFC_PATH . "ezfc-page-licensing.php");
	}

	static function page_preview() {
		require_once(EZFC_PATH . "ezfc-page-preview.php");
	}

	static function page_submissions() {
		require_once(EZFC_PATH . "ezfc-page-submissions.php");
	}


	static function page_templates() {
		require_once(EZFC_PATH . "ezfc-page-templates.php");
	}

	static function page_update() {
		require_once(EZFC_PATH . "ezfc-page-update.php");
	}

	static function page_wizard() {
		require_once(EZFC_PATH . "ezfc-page-wizard.php");
	}

	static function page_chart() {
		require_once(EZFC_PATH . "ezfc-page-chart.php");
	}

	/**
		add settings to plugins page
	**/
	static function plugin_settings_page($links) { 
		$settings_link = "<a href='" . admin_url("admin.php") . "?page=ezfc-options'>" . __("Global Settings", "ezfc") . "</a>";
		array_unshift($links, $settings_link);

		$form_settings_link = "<a href='" . admin_url("admin.php") . "?page=ezfc-settings-form'>" . __("Form Settings", "ezfc") . "</a>";
		array_unshift($links, $form_settings_link);

		return $links; 
	}

	/**
		ajax
	**/
	// frontend
	static function ajax_frontend() {
		require_once(EZFC_PATH . "ajax.php");
	}

	// frontend file upload
	static function ajax_fileupload() {
		require_once(EZFC_PATH . "ajax-fileupload.php");
	}

	// backend
	static function ajax() {
		require_once(EZFC_PATH . "ajax-admin.php");
	}


	/**
		load hooks
	**/
	static function load_hooks() {
		// load language
		load_plugin_textdomain("ezfc", false, dirname(plugin_basename(__FILE__)) . '/lang/');

		// woocommerce
		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ||
			is_plugin_active_for_network('woocommerce/woocommerce.php')) {
			require_once(EZFC_PATH . "ext/class.wc_hooks.php");
		}

		// visual composer widget
		if ( defined( 'WPB_VC_VERSION' ) ) {
            require_once(EZFC_PATH . "ext/class.vc_widget.php");
        }
	}

	// deprecated
	static function load_language() {}

	/**
		scripts
	**/
	static function load_scripts($page, $force_load=false) {
		if (!$force_load && $page != "toplevel_page_ezfc" && substr($page, 0, 23) != "ez-form-calculator_page") return;

		if ($page == "ez-form-calculator_page_ezfc-preview") return;

		wp_enqueue_media();
		
		wp_enqueue_style("bootstrap-grid", plugins_url("assets/css/bootstrap-grid.min.css", __FILE__));
		wp_enqueue_style("ezfc-jquery-ui", plugins_url("assets/css/jquery-ui.min.css", __FILE__));
		wp_enqueue_style("ezfc-jquery-ui-theme", plugins_url("assets/css/jquery-ui.theme.min.css", __FILE__));
		wp_enqueue_style("jquerytimepicker-css", plugins_url("assets/css/jquery.timepicker.css", __FILE__));
		wp_enqueue_style("opentip", plugins_url("assets/css/opentip.css", __FILE__));
		wp_enqueue_style("thickbox");
		wp_enqueue_style("ezfc-css-backend", plugins_url("style-backend.css", __FILE__), array(), EZFC_VERSION);
		wp_enqueue_style("ezfc-font-awesome", plugins_url("assets/css/font-awesome.min.css", __FILE__));

		wp_enqueue_script("jquery");
		wp_enqueue_script("jquery-ui-accordion");
		wp_enqueue_script("jquery-ui-core");
		wp_enqueue_script("jquery-ui-dialog");
		wp_enqueue_script("jquery-ui-draggable");
		wp_enqueue_script("jquery-ui-droppable");
		wp_enqueue_script("jquery-ui-mouse");
		wp_enqueue_script("jquery-ui-selectable");
		wp_enqueue_script("jquery-ui-sortable");
		wp_enqueue_script("jquery-ui-spinner");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-widget");
		wp_enqueue_script("jquery-opentip", plugins_url("assets/js/opentip-jquery.min.js", __FILE__), array("jquery"));
		wp_enqueue_script("ezfc-numeraljs", plugins_url("assets/js/numeral.min.js", __FILE__), array("jquery"));
		wp_enqueue_script("ezfc-jquery-timepicker", plugins_url("assets/js/jquery.timepicker.min.js", __FILE__), array("jquery"));
		wp_enqueue_script("ezfc-jquery-file-upload", plugins_url("assets/js/jquery.fileupload.min.js", __FILE__), array("jquery"));
		wp_enqueue_script("jquery-iframe-transport", plugins_url("assets/js/jquery.iframe-transport.min.js", __FILE__), array("jquery-ui-widget"));
		wp_enqueue_script("thickbox");
		wp_enqueue_script("wp-color-picker");

		wp_enqueue_script("ezfc-backend", plugins_url("backend.js", __FILE__), array("jquery"), EZFC_VERSION);
		wp_enqueue_script("ezfc-backend-options", plugins_url("backend-options.js", __FILE__), array("ezfc-backend"), EZFC_VERSION);

		if ($page == "ez-form-calculator_page_ezfc-chart") {
			wp_enqueue_script("ezfc-visjs", plugins_url("lib/vis-js/vis.min.js", __FILE__), array("ezfc-backend"), EZFC_VERSION);
			wp_enqueue_style("ezfc-visjs", plugins_url("lib/vis-js/vis.min.css", __FILE__));
		}
		else if ($page == "ez-form-calculator_page_ezfc-wizard") {
			wp_dequeue_script( "ezfc-backend" );
			wp_dequeue_script( "ezfc-backend-options" );
		}

		wp_localize_script("ezfc-backend", "ezfc_vars", array(
			"delete" => __("Delete", "ezfc"),
			"delete_form" => __("Really delete the selected form?", "ezfc"),
			"delete_element" => __("Really delete the selected element?", "ezfc"),
			"file_download_url" => trailingslashit(site_url()) . "ezfc-file.php",
			"form_changed" => __("You have changed the form without having saved. Really leave the current form unsaved?"),
			"form_overwrite_confirm" => __("Really overwrite this option for all forms?", "ezfc"),
			"price" => __("Price", "ezfc"),
			"submit_button" => __("Submit button", "ezfc"),
			"unavailable_element" => __("Unavailable for this element.", "ezfc"),
			"yes_no" => array(
				"yes" => __("Yes", "ezfc"),
				"no"  => __("No", "ezfc")
			),
			"element_option_description" => array(
				"add_line" => __("Add a line above step buttons.", "ezfc"),
				"add_to_price" => __("The calculated price of this element will be added in the calculation routine.", "ezfc"),
				"allow_multiple" => __("Allow multiple email addresses to be entered, separated by comma.", "ezfc"),
				"calculate" => __("Choose the operator and target element to calculate with. <br><br>Example: [ * ] [ field_1 ]<br>Result = current_value + field_1 * this_field.", "ezfc"),
				"calculate_enabled" => __("When checked, this field will be taken into calculations.", "ezfc"),
				"calculate_before" => __("When checked, this field will be calculated first. <br><br><strong>Checked</strong>: this_field / target_calculation_field. <br><br><strong>Unchecked</strong>: target_calculation_field / this_field.", "ezfc"),
				"calculate_when_hidden" => __("Whether to take this element into calculations when it is hidden or not.", "ezfc"),
				"class" => __("Additional CSS class for this element.", "ezfc"),
				"collapsible" => __("Allow the user to collapse or expand the group manually.", "ezfc"),
				"conditional" => __("Conditional fields can show or hide elements. Check out the conditional example from the templates or visit the documentation site for more information.", "ezfc"),
				"custom_calculation" => __("Javascript code. The code inside will be wrapped in a unique function. You do not need to add a return value since the variable 'price' will always be returned.", "ezfc"),
				"custom_error_message" => __("Error message when element value does not validate regular expression from custom_regex", "ezfc"),
				"custom_filter" => __("Run input through a custom WordPress filter.", "ezfc"),
				"custom_regex" => __("Custom regular expression. Only numbers allowed example: /[0-9]/i", "ezfc"),
				"custom_regex_check_first" => __("Check regex before empty-check", "ezfc"),
				"description" => __("Users will see the description in a tooltip.", "ezfc"),
				"discount" => __("Discount values", "ezfc"),
				"do_shortcode" => __("Process shortcodes", "ezfc"),
				"double_check" => __("Double check email-address", "ezfc"),
				"expanded" => __("Whether the group should be expanded or collapsed at page load (only relevant when 'collapsible' is enabled).", "ezfc"),
				"factor" => __("The value will be automatically multiplied by this factor. Default factor: 1", "ezfc"),
				"GET" => __("This field will be filled from a GET-parameter. Example: <br><br><strong>URL</strong>: http://www.test.com/?test_value=1 <br><strong>GET</strong>: test_value <br><strong>Field value</strong>: 1.", "ezfc"),
				"half_stars" => __("Allow half-star selection", "ezfc"),
				"hidden" => __("Hidden field. If this field is taken into conditional calculations, you need to enable the element option Calculate_when_hidden.", "ezfc"),
				"inline" => __("Display options in a row.", "ezfc"),
				"is_currency" => __("Format this field as currency value in submissions.", "ezfc"),
				"is_telephone_nr" => __("Mobile phones will automatically show the number pad when this element is focused. However, it will *not* check for actual phone numbers.", "ezfc"),
				"label" => __("This text will be displayed in the frontend.", "ezfc"),
				"recaptcha_language" => __("Set the recacptcha language. Use Google's language codes, e.g. en (English US), en-GB (English UK), de (German) etc. Leave empty so Google will auto-detect the user's language.", "ezfc"),
				"max" => __("Maximum value", "ezfc"),
				"maxDate" => __("The opposite of minDate.", "ezfc"),
				"maxDays" => __("The amount of maximum days to select.", "ezfc"),
				"max_length" => __("Maximum amount of characters.", "ezfc"),
				"min_selectable" => __("Minimum amount of selectable options. Use 0 for unlimited selectable options.", "ezfc"),
				"max_selectable" => __("Maximum amount of selectable options. Use 0 for unlimited selectable options.", "ezfc"),
				"max_width" => __("Maximum width of images (if no unit is present, px will be used)."),
				"max_height" => __("Maximum height of images (if no unit is present, px will be used)."),
				"min" => __("Minimum value", "ezfc"),
				"minDate" => __("Minimum date of both dates. Example: +1d;;+2d - the first datepicker (from) will only have selectable dates 1 day in the future, the second datepicker (to) will only have selectable dates 2 days in the future", "ezfc"),
				"minDays" => __("The amount of minimum days to select.", "ezfc"),
				"multiple" => __("When checked, multiple files can be uploaded.", "ezfc"),
				"name" => __("Internal name. This value is displayed in submissions/emails only.", "ezfc"),
				"overwrite_price" => __("When checked, this field will override the calculations above. Useful with division operator. <br><br><strong>Checked</strong>: result = target_calculation_field / this_field. <br><br><strong>Unchecked</strong>: result = current_value + target_calculation_field / this_field.", "ezfc"),
				"pips" => __("Show little \"pips\" in the slider.", "ezfc"),
				"placeholder" => __("Placeholder only (slight background text when no value is present).", "ezfc"),
				"post_id" => __("Enter the ID of the post you want to show.", "ezfc"),
				"precision" => __("How many decimal numbers are used to calculate with", "ezfc"),
				"price_format" => __("Custom price format (see numeraljs.com for syntax). Default: 0,0[.]00", "ezfc"),
				"read_only" => __("Element is read-only."),
				"required" => __("Whether this is a required field or not.", "ezfc"),
				"set" => __("All selected elements will use the \"set_operator\".", "ezfc"),
				"set_operator" => __("This operator will be applied on all selected elements.", "ezfc"),
				"set_use_factor" => __("The value to be read from another element will be multiplied by its factor.", "ezfc"),
				"show_in_email" => __("Show this element in emails", "ezfc"),
				"slider" => __("Display a slider instead of a textfield. Needs minimum and maximum fields defined.", "ezfc"),
				"slidersteps" => __("Slider step value", "ezfc"),
				"spinner" => __("Display a spinner instead of a textfield.", "ezfc"),
				"stars" => __("Amount of stars to be shown", "ezfc"),
				"steps_pips" => __("Incremental steps", "ezfc"),
				"steps_slider" => __("Incremental steps", "ezfc"),
				"steps_spinner" => __("Incremental steps", "ezfc"),
				"style" => __("CSS inline style, example (without quotes): \"color: #f00; margin-top: 1em;\"", "ezfc"),
				"tag" => __("HTML tag", "ezfc"),
				"text_after" => __("Text after price", "ezfc"),
				"text_before" => __("Text before price", "ezfc"),
				"title" => __("Title", "ezfc"),
				"use_address" => __("Emails will be sent to this address.", "ezfc"),
				"text_only" => __("Display text only instead of an input field", "ezfc"),
				"use_woocommerce_price" => __("This element will get the price of the current WooCommerce product.", "ezfc"),
				"value" => __("Predefined value. If you use floating values, you always have to use a dot as decimal point.", "ezfc"),
				"value_external" => __("DOM-selector to get the value from (e.g. #myinputfield).", "ezfc"),
				"value_http" => __("Fetch value from an external website. Make sure to enter a correct URL, e.g. http://www.yoursite.com/get_value.php", "ezfc"),
				"wrapper_class" => __("CSS class that will be added to the element wrapper.", "ezfc"),
				"wrapper_style" => __("CSS inline style that will be added to the element wrapper.", "ezfc")
			),
			"element_tip_description" => array(
				"action_perform" => esc_attr(__("This action will be performed", "ezfc")),
				"calc_target_element" => esc_attr(__("The value of the target element will be used to calculate with", "ezfc")),
				"calc_target_value" => esc_attr(__("The calculation value will only be used when no target element is selected", "ezfc")),
				"calc_ctv_raw" => esc_attr(__("Use raw target value", "ezfc")),
				"calc_ctv_raw_without_factor" => esc_attr(__("Use raw target value without factor", "ezfc")),
				"calc_ctv_with_subtotal" => esc_attr(__("Use calculated target value with subtotal", "ezfc")),
				"calc_ctv_without_subtotal" => esc_attr(__("Use calculated target value without subtotal", "ezfc")),
				"conditional_chain" => esc_attr(__("Conditional action will only be performed when all conditions are true.", "ezfc")),
				"conditional_factor" => esc_attr(__("Calculate with factor: the value to be read from another element will be multiplied by its factor", "ezfc")),
				"conditional_operator" => esc_attr(__("Conditional operator: compare operator of this element's value and target element's value. For the 'in between' operator, use a colon (:) as separator, example: 20:100", "ezfc")),
				"conditional_row_operator" => esc_attr(__("If this checkbox is checked, then at least one condition needs to be true to trigger the conditional action.")),
				"conditional_toggle" => esc_attr(__("Conditional toggle: when this field is checked, the opposite action will not be executed when this condition is triggered. Example: if you want to show an element on a certain condition but don't hide it automatically, you need to select this checkbox.", "ezfc")),
				"conditional_value" => esc_attr(__("Conditional value", "ezfc")),
				"discount_operator" => esc_attr(__("Discount operator for the following discount value", "ezfc")),
				"discount_value_min" => esc_attr(__("Minimum value for this discount condition (leave blank for negative infinity)", "ezfc")),
				"discount_value_max" => esc_attr(__("Maximum value for this discount condition (leave blank for positive infinity)", "ezfc")),
				"option_create_condition" => esc_attr(__("Create condition", "ezfc")),
				"prio_dec" => esc_attr(__("Decrease priority", "ezfc")),
				"prio_inc" => esc_attr(__("Increase priority", "ezfc")),
				"target_element" => esc_attr(__("Target element", "ezfc")),
				"target_value" => esc_attr(__("Set target element value to this value (only used with 'Set' action). Use __self__ in order to set the target element's value to the current value of this element.", "ezfc")),
				"use_calculated_target_value" => esc_attr(__("Use calculated target value. By default, the raw input value from the target element will be retrieved. If you want to retrieve the calculated element value, you need to select 'Use calculated target value' or 'Use calculated target value without Subtotal' (the latter is only relevant for Subtotal elements).", "ezfc"))
			),
			"notifications" => array(
				"value_dot_notfication" => __("NOTE: you have to use a dot as decimal point for floating numbers.", "ezfc")
			),
			"texts" => array(
				"action" => __("Action", "ezfc"),
				"add_calculation_field" => __("Add calculation field", "ezfc"),
				"add_conditional_field" => __("Add conditional field", "ezfc"),
				"add_discount_field" => __("Add discount field", "ezfc"),
				"add_option" => __("Add option", "ezfc"),
				"batch_edit" => __("Batch edit", "ezfc"),
				"change_element" => __("Change element", "ezfc"),
				"close_element_data" => __("Close", "ezfc"),
				"choose_image" => __("Choose image", "ezfc"),
				"choose_icon" => __("Choose icon", "ezfc"),
				"conditional_hidden" => __("Conditional hidden", "ezfc"),
				"conditional_operator_short" => __("CO", "ezfc"),
				"ctv_raw" => __("Use raw target value", "ezfc"),
				"ctv_subtotal" => __("Use calculated target value with subtotal", "ezfc"),
				"ctv_without_subtotal" => __("Use calculated target value without subtotal", "ezfc"),
				"discount_value" => __("Discount value", "ezfc"),
				"documentation" => __("Documentation", "ezfc"),
				"fileupload_conditional" => __("Please note that file upload elements cannot be both required and hidden at the same time due to browser security restrictions."),
				"functions" => __("Functions", "ezfc"),
				"clear_preselected_value" => __("Clear preselected value", "ezfc"),
				"operator" => __("Operator", "ezfc"),
				"option_create_all_conditions" => __("Create conditions", "ezfc"),
				"paid_with" => __("Paid with:", "ezfc") . " ",
				"pp_payment_verified" => esc_attr(__("Payment verified", "ezfc")),
				"pp_payment_denied" => esc_attr(__("Payment denied or cancelled", "ezfc")),
				"remove" => __("Remove", "ezfc"),
				"refresh_fields" => __("Refresh fields", "ezfc"),
				"show_if_not_empty" => __("Show if not empty", "ezfc"),
				"show_if_not_empty_0" => __("Show if not empty and not 0", "ezfc"),
				"submission_send_admin" => __("Send to admin", "ezfc"),
				"submission_send_customer" => __("Send to customer", "ezfc"),
				"target_element" => __("Target element", "ezfc"),
				"target_value_short" => __("TV", "ezfc"),
				"value" => __("Value", "ezfc"),
				"value_min" => __("Value min", "ezfc"),
				"value_max" => __("Value max", "ezfc")
			),
			"editor" => array(
				"use_tinymce" => get_option("ezfc_use_tinymce", 1),
				"use_large_data_editor" => get_option("ezfc_use_large_data_editor", 1),
				"reopen_last_form" => get_option("ezfc_reopen_last_form", 1),
				"reopen_last_form_id" => get_option("ezfc_reopen_last_form_id", 1),
				"tinymce_use_relative_urls" => get_option("ezfc_tinymce_use_relative_urls", 1),
				"batch_separator" => get_option("ezfc_batch_separator", ",")
			)
		));
	}

	/**
		tinymce button
	**/
	static function tinymce() {
		global $typenow;

		if( ! in_array( $typenow, array( 'post', 'page' ) ) )
			return;

		add_filter('mce_external_plugins', array(__CLASS__, 'add_tinymce_plugin'));
		add_filter('mce_buttons', array(__CLASS__, 'add_tinymce_button'));
	}

	static function tinymce_script() {
		global $typenow;

		if( ! in_array( $typenow, array( 'post', 'page' ) ) )
			return;

		require_once(EZFC_PATH . "class.ezfc_backend.php");
		$ezfc_backend = new Ezfc_backend();

		echo "<script>ezfc_forms = " . json_encode($ezfc_backend->forms_get()) . ";</script>";
	}

	static function add_tinymce_plugin( $plugin_array ) {
		$plugin_array['ezfc_tinymce'] = plugins_url('/ezfc_tinymce.js', __FILE__ );

		return $plugin_array;
	}

	static function add_tinymce_button( $buttons ) {
		array_push( $buttons, 'ezfc_tinymce_button' );

		return $buttons;
	}

	/**
		download file proxy
	**/
	static function download_file_add_rewrite_rule() {
		add_rewrite_rule("ezfc-file\.php", "index.php?ezfc_file=1", "top");
	}

	/**
		download file add query var
	**/
	static function download_file_add_query_vars($query_vars) {
		$query_vars[] = "ezfc_file";
		return $query_vars;
	}

	/**
		download file parse request
	**/
	static function download_file_parse_request($query) {
		$role = get_option("ezfc_user_roles", "administrator");

		if (array_key_exists("ezfc_file", $query->query_vars) && current_user_can($role) && isset($_GET["file_id"])) {
	        require_once(EZFC_PATH . "class.ezfc_backend.php");
	        $ezfc = new Ezfc_backend();

	        $file = $ezfc->get_file($_GET["file_id"]);
	        if (is_array($file) && isset($file["error"])) {
	        	die($file["error"]);
	        }

	        header("Cache-Control: public");
		    header("Content-Description: File Transfer");
		    header("Content-Disposition: attachment; filename=$file");
		    header("Content-Type: application/zip");
		    header("Content-Transfer-Encoding: binary");

		    // read the file from disk
		    readfile($file);

		    die();
		}
	}

	/**
		paypal ipn add rewrite rule
	**/
	static function paypal_add_rewrite_rule() {
		add_rewrite_rule("ezfc-pp-ipn\.php", "index.php?ezfc_paypal_api=1", "top");
	}

	/**
		paypal ipn add query var
	**/
	static function paypal_add_query_vars($query_vars) {
		$query_vars[] = "ezfc_paypal_api";
		return $query_vars;
	}

	/**
		paypal ipn parse request
	**/
	static function paypal_parse_request($query) {
		/*
		// load frontend
        require_once(EZFC_PATH . "class.ezfc_frontend.php");
        $ezfc = new Ezfc_frontend();

		if (array_key_exists("ezfc_paypal_api", $query->query_vars)) {
			$ezfc->debug("PayPal IPN...");
			//$ezfc->debug(var_export($_POST, true));

			// load ipn listener
			require_once(EZFC_PATH . "lib/paypal/IpnListener.php");
			$listener = new \wadeshuler\paypalipn\IpnListener();

			if (get_option("ezfc_pp_sandbox", 0)) {
				$listener->use_sandbox = true;
			}
			$listener->verify_ssl = false;

			$verified = $listener->processIpn();
			if ($verified) {
				if ($_POST["payment_status"] == "Completed") {

				}
		        // 1. Check that $_POST['payment_status'] is "Completed"
		        // 2. Check that $_POST['txn_id'] has not been previously processed
		        // 3. Check that $_POST['receiver_email'] is your Primary PayPal email
		        // 4. Check that $_POST['payment_amount'] and $_POST['payment_currency'] are correct

			    // Valid IPN
			    $transactionRawData = $listener->getRawPostData();
			    $transactionData = $listener->getPostData();
			    $ezfc->debug("Valid IPN");
			    $ezfc->debug(var_export($transactionData, true));
			} else {
			    // Invalid IPN
			    $errors = $listener->getErrors();
			    $ezfc->debug("IPN error");
			    $ezfc->debug(var_export($errors, true));
			}

	        die();
	    }
	    */
	}


	/**
		check for updates
	**/
	static function check_updates() {
		$remote_url    = EZFC_UPDATE_URL;
		$purchase_code = get_option("ezfc_purchase_code", "");

		if (!empty($purchase_code)) {
			$remote_url .= "&code={$purchase_code}";
		}

		if (!class_exists("PucFactory")) {
			require_once(EZFC_PATH . "plugin-updates/plugin-update-checker.php");
		}
		
		PucFactory::buildUpdateChecker(
			$remote_url,
			__FILE__,
			"ezfc"
		);
	}

	/**
		widget
	**/
	static function register_widget() {
		require_once(EZFC_PATH . "widget.php");

		return register_widget("Ezfc_widget");
	}
}

// init class
EZFC_Premium::init();

// shortcode
require_once(EZFC_PATH . "shortcode.php");