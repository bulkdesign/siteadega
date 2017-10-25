<?php

/**
	help page
**/

defined( 'ABSPATH' ) OR exit;

require_once(EZFC_PATH . "class.ezfc_backend.php");
$ezfc = new Ezfc_backend();
$message = "";

// validate user
if (!empty($_POST)) $ezfc->validate_user("ezfc-nonce", "nonce");

$global_settings = Ezfc_settings::get_global_settings(true);

// clear logs
if (isset($_POST["clear_logs"]) && $_POST["clear_logs"] == 1) {
	$ezfc->clear_debug_log();
	$message = __("Logs cleared.", "ezfc");
}

// send test mail
if (!empty($_POST["send_test_mail"]) && !empty($_POST["send_test_mail_recipient"])) {
	$sendername = isset($_POST["send_test_mail_recipient_sender"]) ? $_POST["send_test_mail_recipient_sender"] : null;
	$message = $ezfc->send_test_mail($_POST["send_test_mail_recipient"], $sendername);
}

// paypal test
if (!empty($_POST["paypal_test"])) {
	// cURL not installed
	if (!function_exists("curl_version")) {
		$message = __("cURL is not installed on your webserver. Please contact your webhoster to install this module in order to use PayPal.", "ezfc");
	}
	else {
		$test_url_base = $_POST["paypal_env"]=="live" ? "https://api-3t.paypal.com/nvp" : "https://api-3t.sandbox.paypal.com/nvp";

		$test_query = http_build_query(array(
			"USER"                           => get_option("ezfc_pp_api_username"),
			"PWD"                            => get_option("ezfc_pp_api_password"),
			"SIGNATURE"                      => get_option("ezfc_pp_api_signature"),
			"VERSION"                        => "104.0",
			"method"                         => "SetExpressCheckout",
			"PAYMENTREQUEST_0_AMT"           => "10.00",
			"PAYMENTREQUEST_0_CURRENCYCODE"  => "USD",
			"PAYMENTREQUEST_0_PAYMENTACTION" => "Sale",
			"returnUrl"    	                 => "http://www.paypal.com/test.php",
			"cancelUrl"    	                 => "http://www.paypal.com/test.php",
			"L_PAYMENTREQUEST_0_NAME0"       => "item",
	 		"L_PAYMENTREQUEST_0_AMT0"        => "10.00",
	 		"L_PAYMENTREQUEST_0_QTY0"        => "1"
		));

		$test_url = $test_url_base . "?" . $test_query;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $test_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$res = curl_exec($ch);
		curl_close($ch);

		parse_str($res, $test_result);
		if (!empty($test_result["ACK"]) && $test_result["ACK"] == "Success") {
			$message = sprintf(__("PayPal successfully verified your %s credentials.", "ezfc"), "<strong>{$_POST["paypal_env"]}</strong>");
		}
		else {
			$message  = sprintf(__("Error while validating %s credentials:", "ezfc"), "<strong>{$_POST["paypal_env"]}</strong>");
			$message .= $test_result["L_LONGMESSAGE0"] . "<br><br>";
			$message .= sprintf(__("Please note that Sandbox API credentials are different! See %s to read how to get your API credentials.", "ezfc"), "<a href='https://developer.paypal.com/docs/classic/api/apiCredentials/'>PayPal docs</a>");
		}

		// check for valid URLs
		$check_empty = array(
			"PayPal Username" => get_option("ezfc_pp_api_username"),
			"PayPal Password" => get_option("ezfc_pp_api_password"),
			"PayPal Signature" => get_option("ezfc_pp_api_signature"),
			"PayPal Return URL" => $global_settings["pp_return_url"]["value"],
			"PayPal Cancel URL" => $global_settings["pp_cancel_url"]["value"],
			"PayPal Currency Code" => $global_settings["pp_currency_code"]["value"]
		);

		foreach ($check_empty as $option_name => $option_value) {
			if (empty($option_value)) {
				$message .= "<br>" . sprintf(__("Empty %s", "ezfc"), $option_name);
			}
		}
	}
}

// create paypal sites
if (!empty($_POST["paypal_create_sites"])) {
	// return page
	$post_arr = array(
		'post_type'     => 'page',
		'post_title'    => __("PayPal Return Page", "ezfc"),
		'post_content'  => '[ezfc_verify /]',
		'post_status'   => 'publish'
	);
	$post_id_return = wp_insert_post( $post_arr );

	// cancel page
	$post_arr = array(
		'post_type'     => 'page',
		'post_title'    => __("PayPal Cancel Page", "ezfc"),
		'post_content'  => __("PayPal payment was cancelled.", "ezfc"),
		'post_status'   => 'publish'
	);
	$post_id_cancel = wp_insert_post( $post_arr );

	if (empty($post_id_return) || empty($post_id_cancel)) {
		$message .= __("Unable to create PayPal pages.", "ezfc");
	}
	else {
		// update ezfc paypal options
		$post_return_url = get_permalink($post_id_return);
		$post_cancel_url = get_permalink($post_id_cancel);

		update_option("ezfc_pp_return_url", $post_return_url);
		update_option("ezfc_pp_cancel_url", $post_cancel_url);
	}
}

$debug_active = get_option("ezfc_debug_mode", 0)==1 ? true : false;
$debug_log    = $ezfc->get_debug_log();

// files / dirs
$upload_dir      = wp_upload_dir();
$ezfc_upload_dir = $upload_dir["basedir"] . "/ezfc-uploads/";
$pdf_dir         = get_option("ezfc_ext_pdf_dirname");
$pdf_seed        = get_option("ezfc_ext_pdf_seed");
$install_file    = EZFC_PATH . "db.sql";

// connection
$response = wp_remote_get(Ezfc_Functions::$test_url, array(
	"timeout" => 30
));
$response_code         = wp_remote_retrieve_response_code($response);
$response_version_tmp  = wp_remote_retrieve_body($response);

$response_version      = false;
$response_version_json = json_decode($response_version_tmp);
if (is_object($response_version_json) && property_exists($response_version_json, "version")) {
	$response_version = $response_version_json->version;
}

$icons = array(
	"bad"     => "<i class='fa fa-times'></i>",
	"good"    => "<i class='fa fa-check'></i>",
	"warning" => "<i class='fa fa-warning'></i>"
);

$debug_vars = array(
	"php_version" => array(
		"value"    => PHP_VERSION,
		"required" => "5.4.0",
		"error"    => sprintf(__("PHP version %s or greater is recommended.", "ezfc"), "5.4.0"),
		"is_version" => true
	),
	"wp_version" => array(
		"value"    => get_bloginfo("version"),
		"required" => version_compare(get_bloginfo("version"), "4.5"),
		"error"    => __("WP version 4.5 or greater is recommended.", "ezfc")
	),
	"ezfc_version" => array(
		"value"    => EZFC_VERSION,
		"required" => $response_version,
		"error"    => sprintf(__("A new update is available: %s", "ezfc"), $response_version),
		"is_version" => true
	),
	"contact_ez_server" => array(
		"value"    => $response_code == 200 && !is_wp_error($response) && $response_version,
		"required" => true,
		"is_bool"  => true,
		"error"    => __("Unable to contact licensing server.", "ezfc")
	),
	"file_get_contents" => array(
		"value"    => function_exists("file_get_contents"),
		"required" => true,
		"is_bool"  => true,
		"error"    => __("PHP function file_get_contents is disabled. Please contact your webhost to enable this function.", "ezfc")
	),
	"allow_url_fopen" => array(
		"value"    => @ini_get('allow_url_fopen'),
		"required" => true,
		"is_bool"  => true,
		"error"    => __("PHP option allow_url_fopen is disabled. Please contact your webhost to enable this option in order to retrieve external values.", "ezfc")
	),
	"memory_limit" => array(
		"value"    => @ini_get('memory_limit'),
		"required" => 128,
		"error"    => __("The PHP memory limit is too low. Please contact your webhost to increase the memory limit.", "ezfc")
	),
	"max_input_vars" => array(
		"value"    => @ini_get('max_input_vars'),
		"required" => 1000,
		"warning"  => 2000,
		"message"  => __("The option max_input_vars is used for form submissions. If you use large forms and can't get it to work, you can increase the value of this option. This might solve the 'Element can not be found' error message.", "ezfc")
	),
	"max_execution_time" => array(
		"value"    => @ini_get('max_execution_time'),
		"required" => 30,
		"warning"  => 120,
		"message"  => __("If you are working with large forms and you are unable to save, try to increase the PHP option max_execution_time to a higher value. You might need to contact your webhost to increase this value.", "ezfc")
	),
	"file_upload_dir" => array(
		"value"    => file_exists($ezfc_upload_dir) && is_writable($ezfc_upload_dir),
		"required" => true,
		"is_bool"  => true,
		"error"    => sprintf(__("Please make sure the following directory exists and it's writeable: %s", "ezfc"), $ezfc_upload_dir)
	),
	"PDF folder" => array(
		"value" => file_exists($pdf_dir) && is_writable($pdf_dir),
		"required" => true,
		"is_bool"  => true,
		"error"    => sprintf(__("Please make sure the following directory exists and it's writeable: %s", "ezfc"), $pdf_dir)
	),
	"PDF seed" => array(
		"value" => !empty($pdf_seed),
		"required" => true,
		"is_bool"  => true,
		"error"    => __("Empty pdf seed. Please go to the global settings page, check the option 'Manual update' and click on save.", "ezfc")
	),
	"cURL" => array(
		"value" => function_exists("curl_version"),
		"required" => true,
		"is_bool"  => true,
		"error"    => __("cURL is not installed on your webserver. Please contact your webhost to enable this function.", "ezfc")
	),
	"Install file" => array(
		"value"    => file_exists($install_file) && is_readable($install_file),
		"required" => true,
		"is_bool"  => true,
		"error"    => sprintf(__("Please make sure the following file exists and is readable: %s", "ezfc"), $install_file)
	),
	"mod_rewrite" => array(
		"value"    => function_exists("apache_get_modules") && in_array('mod_rewrite', apache_get_modules()),
		"required" => true,
		"is_bool"  => true,
		"error"    => __("If you encounter errors with message code 403, please enable mod_rewrite.", "ezfc")
	),
	"upload_max_filesize"   => @ini_get('upload_max_filesize'),
	"post_max_size"         => @ini_get('post_max_size')
);

// exceptions
if (!$debug_vars["contact_ez_server"]["value"]) {
	$debug_vars["ezfc_version"]["value"] = false;
	$debug_vars["ezfc_version"]["required"] = true;
	$debug_vars["ezfc_version"]["error"] = __("Unable to retrieve current version.", "ezfc");
}

// generate help table
$help_table = array();
$help_table[] = "<table>";
foreach ($debug_vars as $key => $var) {
	$help_table[] = "<tr><td>";
	$help_table[] = $key;
	$help_table[] = "</td><td>";

	if (is_array($var)) {
		$option_success = false;
		$tmp_out = "";
		$warning = false;

		if (isset($var["warning"])) {
			$warning = true;

			$option_success = (float) $var["value"] >= $var["warning"];
			$tmp_out = $var["value"];
		}

		if (!empty($var["is_bool"])) {
			$option_success = (bool) $var["value"] == $var["required"];
		}
		else if (!empty($var["is_version"])) {
			$option_success = version_compare($var["value"], $var["required"]) >= 0;
			$tmp_out = $var["value"];
		}
		else {
			$option_success = (float) $var["value"] >= $var["required"];
			$tmp_out = $var["value"];
		}

		if (isset($var["warning"])) {
			$icon      = $option_success ? $icons["warning"] : $icons["bad"];
			$css_class = $option_success ? "ezfc-color-warning" : "ezfc-color-error";
		}
		else {
			$icon      = $option_success ? $icons["good"] : $icons["bad"];
			$css_class = $option_success ? "ezfc-color-success" : "ezfc-color-error";	
		}

		if (!$option_success) {
			if (!empty($var["message"])) $var["error"] = $var["message"];

			$tmp_out .= "<br><strong>{$var["error"]}</strong>";
		}
		else if (!empty($var["message"])) {
			$tmp_out .= "<br>{$var["message"]}";
		}

		$help_table[] = "<span class='{$css_class}'>{$icon} {$tmp_out}</span>";
	}
	else {
		$help_table[] = $var;
	}

	$help_table[] = "</td></tr>";
}
$help_table[] = "</table>";
$help_table_output = implode("", $help_table);

/*if (!empty($_POST["download_support_log"])) {
	$support_output  = "Environment vars\n";
	$support_output .= "================\n";
	$support_output .= strip_tags($help_table_output);
	$support_output .= "\n\n";
	$support_output .= "Debug log\n";
	$support_output .= "================\n";
	$support_output .= $debug_log;
}*/

$nonce = wp_create_nonce("ezfc-nonce");

?>

<div class="ezfc wrap ezfc-wrapper container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="inner">
				<h2><?php echo __("Help / debug", "ezfc"); ?> - ez Form Calculator v<?php echo EZFC_VERSION; ?></h2> 
				<p>
					<a class="button button-primary" href="http://ez-form-calculator.ezplugins.de/documentation/" target="_blank"><?php echo __("Open documentation site", "ezfc"); ?></a>
				</p>

				<p>
					<?php echo sprintf(__("If you have found any bugs, please report them to %s. Thank you!", "ezfc"), "<a href='mailto:support@ezplugins.de'>support@ezplugins.de</a>"); ?>
				</p>
			</div>
		</div>

		<?php if (!empty($message)) { ?>
			<div class="col-lg-12">
				<div class="inner">
					<div id="message" class="updated"><?php echo $message; ?></div>
				</div>
			</div>
		<?php } ?>
	</div>
	
	<div class="row">
		<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
			<div class="inner">
				<h3>Debug log</h3>

				<p><?php echo sprintf(__("Debug mode is %s", "ezfc"), $debug_active ? __("active", "ezfc") : __("inactive", "ezfc")); ?>.</p>
				<textarea class="ezfc-settings-type-textarea" style="height: 400px;"><?php echo $debug_log; ?></textarea>

				<form action="" method="POST">
					<input type="hidden" value="1" name="clear_logs" />
					<input type="submit" value="Clear logs" class="button button-primary" />
					<input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />
				</form>
			</div>
		</div>

		<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
			<div class="inner">
				<h3><?php echo __("Environment Vars", "ezfc"); ?></h3>

				<?php echo $help_table_output; ?>
			</div>
		</div>

		<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
			<div class="inner">
				<h3><?php echo __("Emails", "ezfc"); ?></h3>

				<form action="" method="POST">
					<input type="hidden" value="1" name="send_test_mail" />

					<p>
						<label for="send_test_mail_recipient"><?php echo __("Email recipient", "ezfc"); ?></label><br>
						<input type="text" value="" name="send_test_mail_recipient" placeholder="your@email.com" id="send_test_mail_recipient" />
					</p>

					<p>
						<label for="send_test_mail_recipient_sender"><?php echo __("Sendername (optional)", "ezfc"); ?></label><br>
						<input type="text" value="" name="send_test_mail_recipient_sender" placeholder="sendername@email.com" id="send_test_mail_recipient_sender" /><br>
						<?php echo __("Some webhosts require a valid email address from the same domain or a single specified email address.", "ezfc"); ?>
					</p>

					<input type="submit" value="<?php echo __("Send test mail", "ezfc"); ?>" class="button" />
					<input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />
				</form>	
			</div>

			<div class="inner">
				<h3>PayPal</h3>

				<form action="" method="POST">
					<input type="hidden" value="1" name="paypal_test" />
					<select name="paypal_env">
						<option value="live"><?php echo __("Live", "ezfc"); ?></option>
						<option value="sandbox"><?php echo __("Sandbox", "ezfc"); ?></option>
					</select>
					<br />
					<input type="submit" value="<?php echo __("Test PayPal integration", "ezfc"); ?>" class="button" />
					<input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />
				</form>

				<hr />

				<p><?php echo __("The plugin can create all relevant PayPal sites for you automatically. The plugin will create 2 new sites with the relevant shortcodes. Please note that if you change the permalink of the pages, you need to update the pages in the global settings as well.", "ezfc"); ?></p>

				<form action="" method="POST">
					<input type="hidden" value="1" name="paypal_create_sites" />
					<input type="submit" value="<?php echo __("Create PayPal sites", "ezfc"); ?>" class="button" />
					<input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />
				</form>
			</div>
		</div>

		<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
			<a class="twitter-timeline" href="https://twitter.com/ezPlugins" data-widget-id="575319170478383104">Tweets by @ezPlugins</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div>
</div>
