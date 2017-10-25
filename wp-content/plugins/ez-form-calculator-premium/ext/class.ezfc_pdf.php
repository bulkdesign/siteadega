<?php

defined( 'ABSPATH' ) OR exit;

use Dompdf\Dompdf;
use Dompdf\Options;
define("EZFC_EXT_PDF_VERSION", "1.0.0");

class EZFC_Extension_PDF {
	private $attachment_file;
	private $frontend;
	private $realfile;

	/**
		constructor
	**/
	function __construct($frontend) {
		$this->frontend = $frontend;

		// frontend submission action
		add_action("ezfc_after_submission_before_send_mails", array($this, "frontend_submission"), 10, 7);

		// add attachment filter
		add_filter("ezfc_submission_attachments_admin", array($this, "add_attachment_admin"), 10, 3);
		add_filter("ezfc_submission_attachments_customer", array($this, "add_attachment_customer"), 10, 3);

		// after submission
		add_action("ezfc_after_submission", array($this, "after_submission"), 10, 1);
		
		$this->dirname = get_option("ezfc_ext_pdf_dirname");
	}

	/**
		frontend submission
	**/
	public function frontend_submission($insert_id, $total, $user_mail, $id, $output_data, $submission_data, $replace_values_text) {
		if ($submission_data["options"]["pdf_enable"] == 0) return;

		global $wp_filesystem;

		// check if pdf dir exists
		if ( ! file_exists( $this->dirname ) ) {
			$this->frontend->debug(__("PDF dir does not exist: {$this->dirname}", "ezfc"));
			return;
		}

		if (!defined("DOMPDF_UNICODE_ENABLED")) {
			define("DOMPDF_UNICODE_ENABLED", true);
		}

		// load dompdf
		require_once(EZFC_PATH . "lib/dompdf/autoload.inc.php");

		// prepare output text
		$mail_content = get_option("ezfc_pdf_text", "");
		// page setup
		$pdf_page_setup = array(
			"orientation" => get_option("ezfc_pdf_page_orientation", "portrait"),
			"size" => get_option("ezfc_pdf_page_size", "letter")
		);

		$output_data["pdf"] = "<html><head><style>body { font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif; }</style></head><body>" . $output_data["pdf"] . "</body></html>";

		// dompdf options
		$options = new Options();
		$options->set("isHtml5ParserEnabled", true);
		$options->set("logOutputFile", false);
		$options->set("tempDir", $this->dirname);

		// allow remote files
		if (get_option("ezfc_pdf_allow_remote", 1) == 1) {
			$options->setIsRemoteEnabled(true);
		}
		
		$dompdf = new Dompdf();
		$dompdf->setOptions($options);
		// page setup
		$dompdf->set_paper($pdf_page_setup["size"], $pdf_page_setup["orientation"]);
		// html output
		$dompdf->load_html($output_data["pdf"]);
		$dompdf->render();

		$output = @$dompdf->output();

		// create pdf dir
		$seed = get_option("ezfc_ext_pdf_seed");
		$filename = "submission-{$insert_id}-{$seed}.pdf";
		$this->realfile = $this->dirname . $filename;

		// replace filename placeholders
		$attachment_filename = empty($submission_data["options"]["pdf_filename"]) ? "form" : $submission_data["options"]["pdf_filename"];
		$attachment_filename = $this->frontend->replace_values_text($attachment_filename, $replace_values_text);

		$this->attachment_file = $this->dirname . $attachment_filename . ".pdf";

    	$bytes_written = @file_put_contents($this->realfile, $output);
    	if ($bytes_written === false) {
    		$this->frontend->debug(__("Unable to write PDF file.", "ezfc"));
    	}
    	else {
    		// copy file to have a different filename without the generated seed
    		@copy($this->realfile, $this->attachment_file);
    	}
	}

	/**
		add attachment (admin)
	**/
	public function add_attachment_admin($attachments, $submission_id, $form_options) {
		if ($form_options["pdf_enable"] == 0 || $form_options["pdf_send_to_admin"] == 0) return $attachments;

		$attachments[] = $this->attachment_file;

		return $attachments;
	}

	/**
		add attachment (user)
	**/
	public function add_attachment_customer($attachments, $submission_id, $form_options) {
		if ($form_options["pdf_enable"] == 0 || $form_options["pdf_send_to_customer"] == 0) return $attachments;

		$attachments[] = $this->attachment_file;

		return $attachments;
	}

	/**
		add attachment
	**/
	public function after_submission($submission_id) {
		// remove temporary file
		@unlink($this->attachment_file);

		if (!get_option("ezfc_pdf_save_file", 0)) {
			// remove generated file
			$seed     = get_option("ezfc_ext_pdf_seed");
			$filename = "submission-{$submission_id}-{$seed}.pdf";
			$realfile = $this->dirname . $filename;

			@unlink($realfile);
		}
	}
}