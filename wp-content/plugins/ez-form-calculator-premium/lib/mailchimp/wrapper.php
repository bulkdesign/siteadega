<?php

defined( 'ABSPATH' ) OR exit;

use \DrewM\MailChimp\MailChimp;

abstract class Ezfc_Mailchimp_Wrapper {
	public static function get_instance($api_key) {
		if (!class_exists("MailChimp")) {
			require_once(EZFC_PATH . "lib/mailchimp/MailChimp.php");
		}
		
		$mc = new MailChimp($api_key);
		return $mc;
	}
}