EZFC = {
	init: function() {
		// do not init twice
		if (typeof EZFC_LOADED !== "undefined") return;
		EZFC_LOADED = true;

		var _this = this;

		// form vars
		this.form_vars = [];

		// form element subtotals array
		// this.subtotals[form][element_id] = subtotal_price;
		this.subtotals = [];
		// conditional once values
		this.conditional_once = [];

		// payment form id
		this.payment_form_id = 0;

		// caching elements when using custom JS functions
		this.elements_cache = [];

		/**
			global functions for custom calculation codes
		**/
		this.functions = {
			calculate_element: function(form_id, element_id) {
				return _this.calculate_element(form_id, element_id);
			},
			calculate_price: function(form_id) {
				var $form = jQuery(".ezfc-form[data-id='" + form_id + "']");
				return _this.calculate_price($form);
			},
			get_element_id_by_name: function(form_id, name) {
				if (typeof _this.elements_cache[form_id][name] === "undefined") {
					_this.elements_cache[form_id][name] = jQuery("#ezfc-form-" + form_id + " .ezfc-element[data-elementname='" + name + "']");
				}

				return _this.elements_cache[form_id][name].length ? _this.elements_cache[form_id][name].data("id") : false;
			},
			get_value_from: function(id, is_text) {
				return _this.get_value_from_element(null, id, is_text);
			},
			get_value_from_name: function(form_id, name, is_text) {
				var id = this.get_element_id_by_name(form_id, name);

				return this.get_value_from(id, is_text);
			},
			get_calculated_value_from: function(form_id, id) {
				return _this.get_calculated_element_value(form_id, id);
			},
			price_format: function(form_id, price, currency, custom_price_format, format_with_currency) {
				return _this.format_price(form_id, price, currency, custom_price_format, format_with_currency);
			}
		};
		// global functions for custom calculation codes / wrapper
		ezfc_functions = this.functions;

		// listeners for external values on change
		this.external_listeners = [];
		this.price_old_global = [];

		numeral.language("ezfc", {
			delimiters: {
				decimal:   ezfc_vars.price_format_dec_point,
				thousands: ezfc_vars.price_format_dec_thousand
			},
			abbreviations: {
				thousand: 'k',
				million: 'm',
				billion: 'b',
				trillion: 't'
			},
			ordinal: function (number) {
				var b = number % 10;
				return (~~ (number % 100 / 10) === 1) ? 'th' :
					(b === 1) ? 'st' :
					(b === 2) ? 'nd' :
					(b === 3) ? 'rd' : 'th';
			},
			currency: {
				symbol: '$'
			}
		});
		numeral.language("ezfc");

		this.defaultFormat = ezfc_vars.price_format ? ezfc_vars.price_format : "0,0[.]00";
		numeral.defaultFormat(this.defaultFormat);

		// datepicker language
		jQuery.datepicker.setDefaults(jQuery.datepicker.regional[ezfc_vars.datepicker_language]);

		this.attach_events();
	},

	attach_events: function() {
		var _this = this;

		// image option listener
		jQuery(".ezfc-element-option-image").click(function() {
			// radio option image listener
			if (jQuery(this).hasClass("ezfc-element-radio-image")) {
				var $parent_container = jQuery(this).parents(".ezfc-element-wrapper-radio");

				// remove selected class from images
				$parent_container.find(".ezfc-selected").removeClass("ezfc-selected");
				// "uncheck"
				$parent_container.find(".ezfc-element-radio-input").prop("checked", false).trigger("change");
				// check radio input
				jQuery(this).siblings(".ezfc-element-radio-input").prop("checked", true).trigger("change");
				// add selected class
				jQuery(this).addClass("ezfc-selected");
			}
			else if (jQuery(this).hasClass("ezfc-element-checkbox-image")) {
				var checkbox_el = jQuery(this).siblings(".ezfc-element-checkbox-input");
				if (checkbox_el.attr("disabled")) return false;
				
				// uncheck it -> remove selected class
				if (checkbox_el.prop("checked")) {
					checkbox_el.prop("checked", false).trigger("change");
					jQuery(this).removeClass("ezfc-selected");
				}
				// check it
				else {
					checkbox_el.prop("checked", true).trigger("change");
					jQuery(this).addClass("ezfc-selected");
				}
			}
		});

		// init each form
		jQuery(".ezfc-form").each(function() {
			_this.init_form(this);
			// trigger custom event
			jQuery(document).trigger("ezfc_forms_loaded");
		});

		jQuery(".ezfc-element-fileupload").each(function(i, el) {
			var parent   = jQuery(this).parents(".ezfc-element");
			var btn      = jQuery(parent).find(".ezfc-upload-button");

			// build form data
			var form     = jQuery(this).parents("form.ezfc-form");
			var form_id  = form.find("input[name='id']").val();
			var ref_id   = form.find("input[name='ref_id']").val();

			var formData = {
				action: "ezfc_frontend_fileupload",
				data: "id=" + form_id + "&ref_id=" + ref_id
			};

			if (typeof jQuery.prototype.fileupload !== "function") {
				_this.debug_message("Unable to load fileupload function.");
				return false;
			}

			jQuery(this).fileupload({
				formData: formData,
				dataType: 'json',
				add: function (e, data) {
					jQuery(parent).find(".ezfc-bar").css("width", 0);
					jQuery(parent).find(".progress").addClass("active");
					jQuery(parent).find(".ezfc-fileupload-message").text("");

					// add event listener
					if (!btn.data("listener")) {
						btn.data("listener", 1);

						btn.click(function() {
							if (jQuery(el).val() == "") return false;

							data.submit();
							jQuery(btn).attr("disabled", "disabled");

							e.preventDefault();
							return false;
						});
					}
				},
				done: function (e, data) {
					jQuery(btn).removeAttr("disabled");

					if (data.result.error) {
						jQuery(parent).find(".ezfc-fileupload-message").text(data.result.error);
						jQuery(parent).find(".ezfc-bar").css("width", 0);

						return false;
					}

					if (jQuery(this).attr("multiple")) {
						jQuery(this).val("");
						jQuery(btn).removeAttr("disabled");
					}

					jQuery(parent).find(".progress").removeClass("active");
					jQuery(parent).find(".ezfc-fileupload-message").text(ezfc_vars.upload_success);
				},
				progressall: function (e, data) {
					var progress = parseInt(data.loaded / data.total * 100, 10);
					jQuery(parent).find(".ezfc-bar").css("width", progress + "%");
				},
				replaceFileInput: false,
				url: ezfc_vars.ajaxurl
			});
		});

		jQuery(".ezfc-overview").dialog({
			autoOpen: false,
			modal: true
		});

		/**
			ui events
		**/
		// form has changed -> recalc price
		jQuery(".ezfc-form input, .ezfc-form select").on("change keyup", function() {
			var form = jQuery(this).parents(".ezfc-form");
			_this.form_change(form);
		});

		// numbers only
		jQuery(".ezfc-element-numbers").on("change keyup", function() {
			this.value = this.value.replace(/[^0-9\.,]/g, "");
		});

		// checkbox
		jQuery(".ezfc-element-wrapper-checkbox").change(function() {
			var max_selectable = jQuery(this).data("max_selectable");

			if (max_selectable) {
				var selected = jQuery(this).find(":checked").length;

				if (selected >= max_selectable) {
					jQuery(this).find("input:not(:checked)").attr("disabled", "disabled");
				}
				else {
					jQuery(this).find("input:not(:checked)").removeAttr("disabled");	
				}
			}
		});

		// number-slider
		jQuery(".ezfc-slider").each(function(i, el) {
			var $target = jQuery(this);
			var $slider_element = jQuery(el).siblings(".ezfc-slider-element");

			var slider_object = $slider_element.slider({
				min:   $target.data("min") || 0,
				max:   $target.data("max") || 100,
				//range: "min",
				step:  $target.data("stepsslider") || 1,
				value: $target.val() || 0,
				slide: function(ev, ui) {
					// change value before trigger
					var value = _this.normalize_value(ui.value, true);
					$target.val(value);
					$target.trigger("change");
				}
			});

			$target.on("change keyup", function() {
				slider_object.slider("value", $target.val());
			});

			if ($target.hasClass("ezfc-pips")) {
				$slider_element.slider("pips", {
					rest: "label",
					step: $target.data("stepspips") || 1
				});

				$slider_element.find(".ui-slider-pip").on("click", function() {
					var pip_val = jQuery(this).find(".ui-slider-label").data("value");
					
					$target.val(pip_val);
					$target.trigger("change");
				});
			}

			// slider compatibility for mobile devices
			$target.draggable();
		});

		// number-spinner
		jQuery(".ezfc-spinner").each(function(i, el) {
			var $target = jQuery(this);

			$target.spinner({
				min:  $target.data("min") || 0,
				max:  $target.data("max") || 100,
				step: $target.data("stepsspinner") || 1,
				change: function(ev, ui) {
					$target.trigger("change");
				},
				spin: function(ev, ui) {
					// normalize
					var value = _this.normalize_value(ui.value, true);
					// change value before trigger
					$target.val(value);
					$target.trigger("change");
				},
				start: function(ev, ui) {
					// normalize
					var value = _this.normalize_value($target.val());
					$target.val(value);
				},
				stop: function(ev, ui) {
					// normalize
					var value = _this.normalize_value($target.val(), true);
					$target.val(value);
				}
			});
		});

		// steps
		jQuery(".ezfc-step-button").on("click", function() {
			var form_wrapper = jQuery(this).parents(".ezfc-form");
			var current_step = parseInt(form_wrapper.find(".ezfc-step-active").data("step"));
			var next_step    = current_step + (jQuery(this).hasClass("ezfc-step-next") ? 1 : -1);
			var verify_step  = jQuery(this).hasClass("ezfc-step-next") ? 1 : 0;

			_this.set_step(form_wrapper, next_step, verify_step);
			return false;
		});
		// steps indicator
		jQuery(".ezfc-step-indicator-item-active").on("click", function() {
			var $form = jQuery(this).closest(".ezfc-form");
			var step = parseInt(jQuery(this).data("step"));

			_this.set_step($form, step, 0);
			return false;
		});

		// payment option text switch
		jQuery(".ezfc-element-wrapper-payment input").on("change", function() {
			var form_id   = jQuery(this).parents(".ezfc-form").data("id");

			// submit text will be toggled by this.price_request_toggle()
			if (_this.form_vars[form_id].price_show_request == 1 || _this.form_vars[form_id].summary_enabled) return;

			var is_paypal     = jQuery(this).data("value")=="paypal";
			var submit_text   = is_paypal ? _this.form_vars[form_id].submit_text.paypal : _this.form_vars[form_id].submit_text.default;
		});

		// fixed price
		jQuery(window).scroll(this.scroll);
		this.scroll();

		// submit button
		jQuery(".ezfc-form").submit(function(e) {
			var $form   = jQuery(this);
			var id      = $form.data("id");
			var $submit = $form.find(".ezfc-submit");

			if (_this.form_vars[id].hard_submit == 1) {
				return true;
			}

			_this.form_submit($form, -1, $submit.data("type"));

			e.preventDefault();
			return false;
		});
		// payment submit button
		jQuery(".ezfc-payment-submit").click(function(e) {
			var $payment_form = jQuery(this).closest(".ezfc-payment-form");
			var form_id       = $payment_form.data("form_id");
			var $form         = jQuery(".ezfc-form[data-id='" + form_id + "']");

			_this.form_submit($form, -1, jQuery(this).data("payment"));

			e.preventDefault();
			return false;
		});

		// payment cancel
		jQuery(".ezfc-payment-cancel").click(function() {
			var $payment_form = jQuery(this).closest(".ezfc-payment-form");
			var form_id       = $payment_form.data("form_id");
			var $form         = jQuery("#ezfc-form-" + form_id);

			var selectors = ".ezfc-payment-dialog-modal[data-form_id='" + form_id + "']";
			selectors    += ", .ezfc-payment-form";

			jQuery(selectors).removeClass("ezfc-payment-dialog-open");
			_this.form_submit($form, false, false, true);
			return false;
		});

		// reset button
		jQuery(".ezfc-reset").click(function() {
			var $form = jQuery(this).parents(".ezfc-form");
			_this.reset_form($form);

			return false;
		});

		// collapsible groups
		jQuery(".ezfc-collapse-title-wrapper").on("click", function() {
			var $group_wrapper = jQuery(this).closest(".ezfc-element-wrapper-group");

			_this.toggle_group($group_wrapper);
		});

		// credit card number formatter
		jQuery(".ezfc-cc-number-formatter").on("change keyup", function() {
			var value = jQuery(this).val();
			value = value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
			jQuery(this).val(value);
		});
	},

	/**
		init form
	**/
	init_form: function(form_dom) {
		var _this   = this;
		var $form   = jQuery(form_dom);
		var form_id = $form.data("id");
		
		this.form_vars[form_id] = $form.data("vars");
		if (typeof this.form_vars[form_id] !== "object") {
			this.form_vars[form_id] = jQuery.parseJSON($form.data("vars"));
		}

		// subtotals array
		this.subtotals[form_id] = [];
		// conditional once values
		this.conditional_once[form_id] = [];

		// init listener for each form
		this.external_listeners[form_id] = [];

		// elements cache
		this.elements_cache[form_id] = [];

		// set request price text
		if (this.form_vars[form_id].price_show_request == 1) {
			this.price_request_toggle(form_id, false);
		}

		// init datepicker
		$form.find(".ezfc-element-datepicker").each(function() {
			var $element = jQuery(this);

			var el_settings = {};
			if ($element.data("settings")) {
				el_settings = $element.data("settings");
			}

			// get available days
			var available_days = [0, 1, 2, 3, 4, 5, 6];
			if (el_settings.available_days.length) {
				available_days = el_settings.available_days.split(",");
			}
			// convert to int
			available_days = available_days.map(function(d) {
				return parseInt(d);
			});

			$element.datepicker({
				dateFormat:     _this.form_vars[form_id].datepicker_format,
				minDate:        el_settings.minDate ? el_settings.minDate : "",
				maxDate:        el_settings.maxDate ? el_settings.maxDate : "",
				numberOfMonths: el_settings.numberOfMonths ? parseInt(el_settings.numberOfMonths) : 1,
				showAnim:       el_settings.showAnim ? el_settings.showAnim : "fadeIn",
				showWeek:       el_settings.showWeek=="1" ? el_settings.showWeek : false,
				firstDay:       el_settings.firstDay ? el_settings.firstDay : false,
				beforeShowDay: function(date) {
			        var day = date.getDay();
			        return [jQuery.inArray(day, available_days), ''];

			    }
			});
		});

		// init timepicker
		$form.find(".ezfc-element-timepicker").each(function() {
			var $element = jQuery(this);

			var el_settings = {};
			if ($element.data("settings")) {
				el_settings = $element.data("settings");
			}

			$element.timepicker({
				minTime:    el_settings.minTime ? el_settings.minTime : null,
				maxTime:    el_settings.maxTime ? el_settings.maxTime : null,
				step:       el_settings.steps ? el_settings.steps : 30,
				timeFormat: el_settings.format ? el_settings.format : _this.form_vars[form_id].timepicker_format
			});
		});

		// date range setup
		$form.find(".ezfc-element-daterange").each(function() {
			var $element    = jQuery(this);
			var date_format = _this.form_vars[form_id].datepicker_format;

			// from
			if ($element.hasClass("ezfc-element-daterange-from")) {
				$element.datepicker({
					dateFormat: date_format,
					minDate: $element.data("mindate"),
					maxDate: $element.data("maxdate"),
					onSelect: function(selectedDate) {
						var minDays = $element.data("mindays") || 0;
						var maxDays = $element.data("maxdays") || 0;

						var minDate = jQuery.datepicker.parseDate(date_format, selectedDate);
						minDate.setDate(minDate.getDate() + minDays);
						var maxDate = jQuery.datepicker.parseDate(date_format, selectedDate);
						maxDate.setDate(maxDate.getDate() + maxDays);

						$element.siblings(".ezfc-element-daterange-to").datepicker("option", "minDate", minDate);
						if (maxDays != 0) $element.siblings(".ezfc-element-daterange-to").datepicker("option", "maxDate", maxDate);
						$element.trigger("change");
					}
				});
			}
			// to
			else {
				$element.datepicker({
					dateFormat: _this.form_vars[form_id].datepicker_format,
					minDate: $element.data("mindate"),
					maxDate: $element.data("maxdate"),
					onSelect: function(selectedDate) {
						$element.trigger("change");
					}
				});
			}
		});

		// colorpicker
		$form.find(".ezfc-element-colorpicker").each(function() {
			var $element = jQuery(this);
			var input    = $element.parents(".ezfc-element").find(".ezfc-element-colorpicker-input");

			var colorpicker = $element.colorpicker({
				container: $element
			}).on("changeColor.colorpicker", function(ev) {
				$element.css("background-color", ev.color.toHex());
				input.val(ev.color.toHex());
			});

			jQuery(input).on("click focus", function() {
				colorpicker.colorpicker("show");
			}).on("change", function() {
				colorpicker.colorpicker("setValue", $form.val());
			});
		});

		// if steps are used, move the submission button + summary table to the last step
		var steps = $form.find(".ezfc-step");
		if (steps.length > 0) {
			var last_step = steps.last();
			
			$form.find(".ezfc-summary-wrapper").appendTo(last_step);
			$form.find(".ezfc-submit-wrapper").appendTo(last_step).addClass("ezfc-submit-step");

			// prevent enter step in last step
			this.prevent_enter_step_listener(last_step.find("input"), $form);
		}

		// put elements into groups
		jQuery(".ezfc-custom-element[data-group]").each(function() {
			var $element = jQuery(this);

			var group_id = $element.data("group");
			var $group_element = jQuery("#ezfc_element-" + group_id);

			if ($group_element.data("element") != "group") return;

			// append element to group
			if ($group_element.length > 0) {
				var $group_element_wrapper = $group_element.find("> .ezfc-group-elements");
				$element.appendTo($group_element_wrapper);
			}
		});

		// set price
		this.set_price($form);
		// set submit text
		this.set_submit_text($form);

		// hide woocommerce price+button
		if (this.form_vars[form_id].use_woocommerce) {
			var elements_to_hide = ".woocommerce form.cart, .woocommerce .price";

			jQuery(elements_to_hide).hide();
		}

		// step indicator start added by 1 so it becomes more readable
		var step_indicator_start = parseInt(this.form_vars[form_id].step_indicator_start) + 1;
		if (step_indicator_start > 1) {
			$form.find(".ezfc-step-indicator").hide();
		}

		// init debug info
		if (ezfc_vars.debug_mode == "2") {
			$form.append("<button id='ezfc-show-all-elements'>Show/hide elements</button>");

			jQuery("#ezfc-show-all-elements").click(function() {
				if ($form.hasClass("ezfc-debug-visible")) {
					$form.removeClass("ezfc-debug-visible");
					$form.find(".ezfc-tmp-visible").removeClass("ezfc-tmp-visible").hide();
				}
				else {
					$form.addClass("ezfc-debug-visible");
					$form.find(".ezfc-hidden").addClass("ezfc-tmp-visible").show().css("display", "inline-block");
				}

				return false;
			});
		}

		// stripe
		if (this.form_vars[form_id].use_stripe && typeof Stripe !== "undefined") {
			Stripe.setPublishableKey(ezfc_vars.stripe.publishable_key);
		}

		// prevent enter key to submit form
		this.prevent_enter_step_listener(":input:not(textarea):not([type=submit])", $form);

		// populate html placeholders
		this.populate_html_placeholders($form);

		// trigger custom event
		jQuery(document).trigger("ezfc_form_init", form_id);
	},

	// form has changed
	form_change: function(form) {
		var form_id = jQuery(form).data("id");

		// clear hidden values
		this.clear_hidden_values(form);

		// populate html placeholder data
		this.populate_html_placeholders(form);

		// form has changed -> reset price + summary
		this.form_vars[form_id].price_requested = 0;
		this.form_vars[form_id].summary_shown = 0;

		jQuery(form).find(".ezfc-summary-wrapper").fadeOut();
		
		// price request
		if (this.form_vars[form_id].price_show_request == 1) {
			this.price_request_toggle(form_id, false);

			return false;
		}
		
		this.set_price(form);
		this.set_submit_text(form);
	},

	/**
		form submitted
	**/
	form_submit: function(form, step, submit_type, cancel) {
		var _this         = this;
		var $form         = jQuery(form);
		var $form_wrapper = $form.closest(".ezfc-wrapper");
		var id            = $form.data("id");

		// show submit icon
		$form.find(".ezfc-submit-icon").addClass("ezfc-submit-icon-show");

		// set spinner icon to submit field
		var submit_icon    = $form.find(".ezfc-submit-icon");
		var submit_element = $form.find("input[type='submit']");

		// price request
		if (this.form_vars[id].price_show_request == 1) {
			this.set_price(form);
		}

		// cancel submit
		if (cancel) {
			submit_icon.fadeOut();
			submit_element.prop("disabled", false);
			$form_wrapper.find(".ezfc-payment-submit, .ezfc-payment-cancel").prop("disabled", false);

			this.form_vars[id].stripe_cc_info_shown = 0;

			return false;
		}

		// show cc info
		if (submit_type == "stripe") {
			var $payment_form = jQuery("#ezfc-stripe-form-" + id);

			// fill placeholders with total price
			var price_html = this.format_price(id, this.price_old_global[id], false, false, true);
			$payment_form.find(".ezfc-payment-price").text(price_html);

			// show cc details dialog
			if (!this.form_vars[id].stripe_cc_info_shown) {
				this.form_vars[id].stripe_cc_info_shown = 1;
				// open dialog + modal
				jQuery("#ezfc-stripe-form-" + id + ", #ezfc-stripe-form-modal-" + id).addClass("ezfc-payment-dialog-open");
			}
			// create request token
			else {
				var $payment_form = jQuery("#ezfc-stripe-form-" + id);
				this.payment_form_id = id;
				// create token
				Stripe.card.createToken($payment_form, this.stripe_response_handler);
				// disable action buttons
				$payment_form.find(".ezfc-payment-submit, .ezfc-payment-cancel").prop("disabled", true);
			}

			submit_icon.fadeOut();
			return false;
		}

		// show loading icon, disable submit button
		submit_icon.fadeIn();
		submit_element.prop("disabled", true);

		// clear hidden elements (due to conditional logic)
		$form.find(".ezfc-custom-hidden:not(.ezfc-element-wrapper-fileupload):not(.ezfc-element-wrapper-group)").each(function() {
			// empty radio buttons --> select first element to submit __hidden__ data
			var radio_empty = jQuery(this).find(".ezfc-element-radio:not(:has(:radio:checked))");
			if (radio_empty.length) {
				jQuery(radio_empty).first().find("input").prop("checked", true);
			}
			
			// todo: re-add disabled attribute after price request / summary
			jQuery(this).find("input, :selected").val("__HIDDEN__").removeAttr("disabled").addClass("ezfc-has-hidden-placeholder");
		});

		$form.find(".ezfc-element[data-calculate_activated='0']").each(function() {
			jQuery(this).find("input, :selected").val("__HIDDEN__");
		});

		var data = $form.serialize();

		// url
		data += "&url=" + encodeURI(window.location.href);

		// request price for the first time
		if (this.form_vars[id].price_requested == 0) {
			data += "&price_requested=1";
		}

		// summary
		if (this.form_vars[id].summary_shown == 0) {
			data += "&summary=1";
		}

		// next/previous step
		if (step != -1) {
			data += "&step=" + step;
		}

		// preview
		if (this.form_vars[id].preview_form) {
			data += "&preview_form=" + this.form_vars[id].preview_form;
		}

		data += "&generated_price=" + this.price_old_global[id];

		this.call_hook("ezfc_before_submission", {
			data: data,
			form: $form,
			form_vars: this.form_vars[id],
			id: id
		});

		jQuery.ajax({
			type: "post",
			url: ezfc_vars.ajaxurl,
			data: {
				action: "ezfc_frontend",
				data: data
			},
			success: function(response) {
				jQuery(".ezfc-submit-icon").removeClass("ezfc-submit-icon-show");

				submit_element.removeAttr("disabled");
				submit_icon.fadeOut();

				_this.debug_message(response);

				try {
					response = jQuery.parseJSON(response);
				}
				catch (e) {
					response = false;
					_this.debug_message(e);
				}

				if (!response) {
					$form.find(".ezfc-message").text("Something went wrong. :(");
					_this.recaptcha_reload();

					_this.reset_disabled_fields(form, true);
						
					return false;
				}

				// error occurred -> invalid form fields
				if (response.error) {
					_this.reset_disabled_fields(form, true);

					if (response.id) {
						// error tip (if the form uses steps, do not show this if all fields are valid up until this step)
						var show_error_tip = true;
						// error tip data
						var el_target = "#ezfc_element-" + response.id;
						var el_tip    = jQuery(el_target).find(".ezfc-element").first();
						var tip       = null;

						// check if form uses steps
						var use_steps = $form.find(".ezfc-step-active").length > 0 ? true : false;
						if (use_steps) {
							var error_step = parseInt(jQuery(el_target).parents(".ezfc-step").data("step"));
							
							// if invalid field is not on the current step, do not show the tip. also, do not show the tip when submitting the form (step = -1)
							if (error_step != step && step != -1) {
								show_error_tip = false;
								_this.set_step(form, step + 1);
							}
						}

						if (show_error_tip) {
							if (!el_tip.length) {
								el_tip = jQuery(el_target);
							}

							var tip_delay = use_steps ? 1000 : 400;

							if (el_tip.is(":visible")) {
								_this.show_tip(el_tip, el_target, tip_delay, response.error);
							}
							else {
								var $el_tip_parent_groups = el_tip.parents(".ezfc-element-wrapper-group");

								// element is hidden in a group
								if ($el_tip_parent_groups.length) {
									$el_tip_parent_groups.each(function(gi, group_el) {
										_this.toggle_group(jQuery(group_el));
									});

									_this.show_tip(el_tip, el_target, tip_delay, response.error);
								}
								// element is still hidden
								else {
									_this.set_message(id, response.error + " (#" + response.id + ")");
								}
							}

							// auto hide tooltip
							if (typeof ezfc_vars.required_text_auto_hide !== "undefined") {
								var required_text_auto_hide = parseFloat(ezfc_vars.required_text_auto_hide) * 1000;

								if (required_text_auto_hide > 0) {
									setTimeout(function() {
										if (tip) tip.hide();
									}, required_text_auto_hide);
								}
							}

							if (!_this.form_vars[id].disable_error_scroll) {
								_this.scroll_to(el_target);
							}
						}
					}
					else {
						_this.set_message(id, response.error);
					}

					_this.recaptcha_reload();

					return false;
				}
				// next step
				else if (response.step_valid) {
					_this.reset_disabled_fields(form);
					_this.set_step(form, step + 1);

					return false;
				}
				// summary
				else if (response.summary) {
					$form.find(".ezfc-summary-wrapper").fadeIn().find(".ezfc-summary").html(response.summary);
					_this.form_vars[id].summary_shown = 1;

					_this.reset_disabled_fields(form);

					return false;
				}

				// prevent spam
				_this.recaptcha_reload();

				// submit paypal form
				if (response.paypal) {
					// disable submit button again to prevent doubleclicking
					submit_element.attr("disabled", "disabled");
					// redirect to paypal express checkout url
					window.location.href = response.paypal;
				}
				else {
					// price request
					if (response.price_requested || response.price_requested === 0) {
						_this.price_request_toggle(id, true, response.price_requested);
						return false;
					}

					/**
						submission successful
					**/
					var hook_vars = {
						form: $form,
						form_vars: _this.form_vars[id],
						id: id,
						price: price,
						response: response
					};
					// hook
					_this.call_hook("ezfc_submission_success", hook_vars);
					// call custom js function
					if (_this.form_vars[id]["submission_js_func"] && typeof window[_this.form_vars[id]["submission_js_func"]] === "function") {
						window[_this.form_vars[id]["submission_js_func"]](hook_vars);
					}

					// hide payment dialog(s)
					$form_wrapper.find(".ezfc-payment-dialog, .ezfc-payment-dialog-modal").removeClass("ezfc-payment-dialog-open");

					// add success text
					var $success_text = jQuery(".ezfc-success-text[data-id='" + id + "']");
					$success_text.html(response.success);

					// reset form after submission
					if (_this.form_vars[id].reset_after_submission == 1) {
						_this.reset_form(form);

						$success_text.fadeIn().delay(7500).fadeOut();
						return;
					}

					// hide all forms
					if (_this.form_vars[id].hide_all_forms == 1) {
						jQuery(".ezfc-form, .ezfc-required-notification").fadeOut();
					}
					else {
						$form.find(".ezfc-required-notification").fadeOut();

						if (_this.form_vars[id].show_success_text == 1) {
							$form.fadeOut();
						}
					}

					// show success text
					if (_this.form_vars[id].show_success_text == 1) {
						// scroll to success message
						if (_this.form_vars[id].scroll_to_success_message == 1) {
							$success_text.fadeIn(400, function() {
								_this.scroll_to($success_text, -200);
							});
						}
						else {
							$success_text.fadeIn();
						}
					}

					// update mini cart
					if (response.woo_update_cart && response.woo_cart_html && ezfc_vars.woocommerce_update_cart_selector.length > 0) {
						jQuery(ezfc_vars.woocommerce_update_cart_selector).html(response.woo_cart_html);
					}

					// redirect the user
					if (typeof _this.form_vars[id].redirect_url !== "undefined" && _this.form_vars[id].redirect_url.length > 0) {
						var redirect_form_vars = "";

						if (_this.form_vars[id].redirect_forward_values == 1) {
 							redirect_form_vars = $form.serialize();
 							redirect_form_vars += "&total=" + _this.price_old_global[id];
 							redirect_form_vars += "&total_f=" + _this.functions.price_format(id, _this.price_old_global[id]);
 						}

						var href_separator = _this.form_vars[id].redirect_url.indexOf("?") == -1 ? "?" : "&";
						window.location.href = _this.form_vars[id].redirect_url + href_separator + redirect_form_vars;
					}
					// refresh the page
					else if (typeof _this.form_vars[id].refresh_page_after_submission !== "undefined" && _this.form_vars[id].refresh_page_after_submission == 1) {
						var redirect_timer = Math.max(0, Math.abs(parseInt(_this.form_vars[id].redirect_timer)));

						setTimeout(function() {
							window.location.reload();
						}, redirect_timer * 1000);
					}
				}
			}
		});
	},

	/**
		external values
	**/
	calculate_get_external_values: function(form, form_id, el_object, el_type) {
		var _this = this;
		var value_external_element = el_object.data("value_external");
		var value_external_listen  = el_object.data("value_external_listen");

		// only do it once if listen is disabled
		if (this.external_listeners[form_id][value_external_element] && !value_external_listen) return;

		if (value_external_element && jQuery(value_external_element).length > 0) {
			// get external value
			var value_external;

			if (jQuery(value_external_element).is("input[type='radio']")) {
				value_external = jQuery(value_external_element).find(":checked").val();
			}
			else if (jQuery(value_external_element).is("input, input[type='text'], textarea")) {
				value_external = jQuery(value_external_element).val();
			}
			else if (jQuery(value_external_element).is("select")) {
				value_external = jQuery(value_external_element).find(":selected").text();
			}
			else {
				value_external = jQuery(value_external_element).text();
			}

			// set external value
			if (el_type == "input" || el_type == "numbers" || el_type == "subtotal") {
				el_object.find("input").val(value_external);
			}
			else if (el_type == "dropdown") {
				el_object.find(":selected").removeAttr("selected");
				el_object.find("option[value='" + value_external + "']").attr("selected", "selected");
			}
			else if (el_type == "radio") {
				el_object.find(":checked").removeAttr("checked");
				el_object.find("input[value='" + value_external + "']").attr("checked", "checked");
			}
			else if (el_type == "checkbox") {
				el_object.find(":checked").removeAttr("checked");
				el_object.find("input[value='" + value_external + "']").attr("checked", "checked");
			}
			else if (el_type == "textfield") {
				el_object.find("textarea").val(value_external);
			}

			// set event listener
			if (!this.external_listeners[form_id][value_external_element]) {
				this.external_listeners[form_id][value_external_element] = 1;

				jQuery(value_external_element).on("change keyup", function() {
					_this.set_price(jQuery(form));
				});
			}
		}
	},


	/**
		conditionals
	**/
	calculate_conditionals: function(form, form_id, el_object, el_type) {
		var _this = this;

		var cond_action       = el_object.data("conditional_action");
		var cond_operator     = el_object.data("conditional_operator");
		var cond_target       = el_object.data("conditional_target");
		var cond_value        = el_object.data("conditional_values");
		var cond_target_value = el_object.data("conditional_target_value");
		var cond_notoggle     = el_object.data("conditional_notoggle");
		var cond_redirects    = el_object.data("conditional_redirects");
		var cond_use_factor   = el_object.data("conditional_use_factor");
		var cond_row_operator = el_object.data("conditional_row_operator");

		// check if there should be conditional actions
		if (!cond_action || cond_action == 0) return;

		var cond_actions_elements    = cond_action.toString().split(",");
		var cond_operator_elements   = cond_operator.toString().split(",");
		var cond_target_elements     = cond_target.toString().split(",");
		var cond_custom_values       = cond_value.toString().split(",");
		var cond_custom_target_value = cond_target_value.toString().split(",");
		var cond_notoggle_values     = cond_notoggle.toString().split(",");
		var cond_redirects_values    = cond_redirects.toString().split(",");
		var cond_use_factor_values   = cond_use_factor.toString().split(",");
		var cond_row_operator_values = cond_row_operator.toString().split(",");

		// value of this element (but beware of is_number due to text values)
		var is_number = el_object.data("is_number");
		var el_value  = this.get_value_from_element(el_object, null, !is_number);
		var el_factor = 1;
		var el_id     = el_object.data("id");

		// go through all conditionals
		jQuery.each(cond_actions_elements, function(ic, action) {
			// get conditional target element
			var cond_target;
			if (cond_target_elements[ic] == "submit_button") {
				cond_target = jQuery(form).find(".ezfc-submit");
			}
			else if (cond_target_elements[ic] == "price") {
				cond_target = jQuery(form).find(".ezfc-price-wrapper-element");
			}
			else {
				cond_target = jQuery("#ezfc_element-" + cond_target_elements[ic]);
			}

			// no target element found
			if (cond_target.length < 1 && cond_redirects_values.length < 1) return;

			// check if raw value should be used
			if (cond_use_factor_values[ic] == 1) {
				el_factor = parseFloat(el_factor);
				if (!isNaN(el_factor)) {
					el_value *= el_factor;
				}
			}

			// chaining
			var conditional_chain = [ { operator: cond_operator_elements[ic], value: cond_custom_values[ic], compare_target: "" } ];

			var chain_length = el_object.data("conditional_chain_length");
			if (chain_length > 0) {
				// conditional operator chain
				var $dom_coc = el_object.data("conditional_operator_chain_" + ic);
				// conditional value chain
				var $dom_cvc = el_object.data("conditional_value_chain_" + ic);
				// conditional chain compare target
				var $dom_cct = el_object.data("conditional_compare_target_chain_" + ic);

				if ($dom_coc) {
					var conditional_operator_chain       = $dom_coc.toString().split(",");
					var conditional_value_chain          = $dom_cvc.toString().split(",");
					var conditional_compare_target_chain = $dom_cct.toString().split(",");

					jQuery.each(conditional_operator_chain, function(cn, operator_chain) {
						conditional_chain.push({ operator: operator_chain, value: conditional_value_chain[cn], compare_target: conditional_compare_target_chain[cn] });
					});
				}
			}

			/**
				check all conditional chains
			**/
			var do_action = false;

			jQuery.each(conditional_chain, function(chain_index, chain_row) {
				var cond_custom_value = chain_row.value;

				var tmp_compare_value = el_value;
				if (chain_row.compare_target != 0) {
					tmp_compare_value = _this.get_value_from_element(false, chain_row.compare_target);
				}

				// only parse floats if value is a number
				var parse_exceptions = ["in", "not_in", "selected", "not_selected"];
				if (is_number == 1 && !jQuery.inArray(chain_row.operator, parse_exceptions)) {
					cond_custom_value = parseFloat(chain_row.value);
				}
				else {
					cond_custom_value = chain_row.value;
				}

				// check if conditional is true - separate text and number elements
				if (el_type == "input") {
					do_action = cond_custom_value.toLowerCase()==cond_target.val().toLowerCase();
				}
				else {
					var cond_value_min_max = chain_row.value.split(":");
					if (cond_value_min_max.length > 1) {
						cond_value_min_max[0] = parseFloat(cond_value_min_max[0]);
						cond_value_min_max[1] = parseFloat(cond_value_min_max[1]);
					}

					switch (chain_row.operator) {
						case "gr": do_action = tmp_compare_value > cond_custom_value;
						break;
						case "gre": do_action = tmp_compare_value >= cond_custom_value;
						break;

						case "less": do_action = tmp_compare_value < cond_custom_value;
						break;
						case "lesse": do_action = tmp_compare_value <= cond_custom_value;
						break;

						case "equals": do_action = tmp_compare_value == cond_custom_value;
						break;

						case "between":
							if (cond_value_min_max.length < 2) {
								do_action = false;
							}
							else {
								do_action = (tmp_compare_value >= cond_value_min_max[0] && tmp_compare_value <= cond_value_min_max[1]);
							}
						break;

						case "not_between":
							if (cond_value_min_max.length < 2) {
								do_action = false;
							}
							else {
								do_action = (tmp_compare_value < cond_value_min_max[0] || tmp_compare_value > cond_value_min_max[1]);
							}
						break;

						case "not":
							if (cond_value_min_max.length < 2) {
								do_action = tmp_compare_value != cond_custom_value;
							}
							else {
								do_action = (tmp_compare_value < cond_value_min_max[0] && tmp_compare_value > cond_value_min_max[1]);
							}
						break;

						case "hidden": do_action = !el_object.is(":visible");
						break;

						case "visible": do_action = el_object.is(":visible");
						break;

						case "mod0": do_action = tmp_compare_value > 0 && (tmp_compare_value % cond_custom_value) == 0;
						break;
						case "mod1": do_action = tmp_compare_value > 0 && (tmp_compare_value % cond_custom_value) != 0;
						break;

						case "bit_and": do_action = tmp_compare_value & cond_custom_value;
						break;

						case "bit_or": do_action = tmp_compare_value | cond_custom_value;
						break;

						case "empty":
							if (typeof tmp_compare_value === "undefined") {
								do_action = true;
							}
							if (typeof tmp_compare_value === "number") {
								do_action = isNaN(tmp_compare_value);
							}
							else {
								do_action = tmp_compare_value.length < 1;
							}
						break;

						case "notempty":
							if (typeof tmp_compare_value === "undefined") {
								do_action = false;
							}
							else if (typeof tmp_compare_value === "number") {
								do_action = !isNaN(tmp_compare_value);
							}
							else {
								do_action = tmp_compare_value.length > 0;
							}
						break;

						case "in":
							if (typeof tmp_compare_value === "undefined") {
								do_action = false;
							}
							else {
								var in_values = cond_custom_value.split("|");

								do_action = false;
								for (var i in in_values) {
									if (tmp_compare_value == in_values[i]) {
										do_action = true;
										return;
									}
								}
							}
						break;

						case "not_in":
							if (typeof tmp_compare_value === "undefined") {
								do_action = false;
							}
							else {
								var in_values = cond_custom_value.split("|");

								do_action = true;
								for (var i in in_values) {
									if (tmp_compare_value == in_values[i]) {
										do_action = false;
										return;
									}
								}
							}
						break;

						case "once":
							do_action = true;

							if (typeof _this.conditional_once[form_id][el_id] === "undefined") {
								_this.conditional_once[form_id][el_id] = [];
							}
							if (typeof _this.conditional_once[form_id][el_id][ic] === "undefined") {
								_this.conditional_once[form_id][el_id][ic] = [];
							}

							if (typeof _this.conditional_once[form_id][el_id][ic][chain_index] === "undefined") {
								_this.conditional_once[form_id][el_id][ic][chain_index] = 1;
							}
							else {
								do_action = false;
							}
						break;

						case "selected":
							do_action = false;

							// get array value
							tmp_value = _this.get_value_from_element(el_object, null, true, false, { return_array: true, return_value: "value" });

							if (typeof tmp_value === "object") {
								var in_values = cond_custom_value.split("|");

								for (var i in in_values) {
									cmp_value = in_values[i];

									for (var t in tmp_value) {
										if (tmp_value[t] == cmp_value) {
											do_action = true;
											return;
										}
									}
								}
							}
						break;

						case "not_selected":
							do_action = true;

							// get array value
							var tmp_value = _this.get_value_from_element(el_object, null, true, false, { return_array: true, return_value: "value" });

							if (typeof tmp_value === "object") {
								var in_values = cond_custom_value.split("|");

								for (var i in in_values) {
									cmp_value = in_values[i];

									for (var t in tmp_value) {
										if (tmp_value[t] == cmp_value) {
											do_action = false;
											return;
										}
									}
								}
							}
						break;

						default: do_action = false;
						break;
					}
				}

				// at least one condition needs to be true (i.e. row OR operator)
				if (typeof cond_row_operator_values[ic] !== "undefined" && cond_row_operator_values[ic] == 1) {
					if (do_action) return false;
				}
				// all conditions need to be true (i.e. row AND operator)
				else {
					if (!do_action) return false;
				}
			});

			// conditional actions
			var js_action, js_counter_action;
			// when cond_notoggle_element is true, the opposite action will not be executed
			var cond_notoggle_element = cond_notoggle_values[ic];
			// target element type
			var cond_target_type = cond_target.data("element");

			// set cond_target to all direct child elements when it's a group
			if (cond_target_type == "group") {
				cond_target.push(jQuery(cond_target).find("> .ezfc-custom-element"));
			}

			// set values
			if (action == "set" && do_action) {
				// set target value to this value
				if (cond_custom_target_value[ic] == "__self__") {
					cond_custom_target_value[ic] = el_value;
				}

				if (cond_target_type == "input" || cond_target_type == "hidden" || cond_target_type == "numbers" || cond_target_type == "subtotal" || cond_target_type == "set") {
					cond_target.find("input").val(cond_custom_target_value[ic]);
				}
				else if (cond_target_type == "dropdown") {
					cond_target.find(":selected").removeAttr("selected");
					cond_target.find("option[data-value='" + cond_custom_target_value[ic] + "']").prop("selected", "selected");
				}
				else if (cond_target_type == "radio") {
					cond_target.find(":checked").removeAttr("checked");
					cond_target.find("input[data-value='" + cond_custom_target_value[ic] + "']").prop("checked", true);
				}
				else if (cond_target_type == "checkbox") {
					cond_target.find("input[data-value='" + cond_custom_target_value[ic] + "']").prop("checked", true);
				}
				else {
					cond_target.text(cond_custom_target_value[ic]);
				}
			}
			// activate element
			else if (action == "activate") {
				// activate
				if (do_action) {
					// submit button
					if (cond_target_type == "submit") {
						cond_target.prop("disabled", false);
					}
					// group
					else if (cond_target_type == "group") {
						var tmp_cond_targets = cond_target.find("[data-calculate_enabled]");
						tmp_cond_targets.data("calculate_enabled", 1);
						tmp_cond_targets.attr("data-calculate_activated", 1);
					}
					// element
					else {
						cond_target.data("calculate_enabled", 1);
						cond_target.attr("data-calculate_activated", 1);
					}
				}
				// deactivate
				else if (cond_notoggle_element != 1) {
					// submit button
					if (cond_target_type == "submit") {
						cond_target.prop("disabled", true);
					}
					// group
					else if (cond_target_type == "group") {
						var tmp_cond_targets = cond_target.find("[data-calculate_enabled]");
						tmp_cond_targets.data("calculate_enabled", 0);
						tmp_cond_targets.attr("data-calculate_activated", 0);
					}
					// element
					else {
						cond_target.data("calculate_enabled", 0);
						cond_target.attr("data-calculate_activated", 0);
					}
				}
			}
			// deactivate element
			else if (action == "deactivate") {
				// deactivate
				if (do_action) {
					// submit button
					if (cond_target_type == "submit") {
						cond_target.prop("disabled", true);
					}
					// group
					else if (cond_target_type == "group") {
						var tmp_cond_targets = cond_target.find("[data-calculate_enabled]");
						tmp_cond_targets.data("calculate_enabled", 0);
						tmp_cond_targets.attr("data-calculate_activated", 0);
					}
					// element
					else cond_target.data("calculate_enabled", 0);
					cond_target.attr("data-calculate_activated", 0);
				}
				// activate
				else if (cond_notoggle_element != 1) {
					// submit button
					if (cond_target_type == "submit") {
						cond_target.prop("disabled", false);
					}
					// group
					else if (cond_target_type == "group") {
						var tmp_cond_targets = cond_target.find("[data-calculate_enabled]");
						tmp_cond_targets.data("calculate_enabled", 1);
						tmp_cond_targets.attr("data-calculate_activated", 1);
					}
					// element
					else {
						cond_target.data("calculate_enabled", 1);
						cond_target.attr("data-calculate_activated", 1);
					}
				}
			}
			// load form
			else if (action == "redirect" && do_action) {
				// set message
				var message_wrapper = jQuery(form).parents(".ezfc-wrapper").find(".ezfc-message");
				message_wrapper.text(_this.form_vars[form_id].redirect_text).fadeIn();

				// hide the form
				jQuery(form).fadeOut();

				setTimeout(function() {
					window.location.href = cond_redirects_values[ic];
				}, _this.form_vars[form_id].redirect_timer * 1000);
			}
			// steps
			else if ((action == "step_goto" || action == "step_prev" || action == "step_next") && do_action) {
				var current_step = parseInt(jQuery(form).find(".ezfc-step-active").data("step"));
				var next_step = 0;

				switch (action) {
					case "step_prev":
						if (current_step == 0) return;
						next_step = current_step - 1;
					break;

					case "step_next":
						var step_length = jQuery(form).find(".ezfc-step-start").length;
						if (current_step == step_length - 1) return;

						next_step = current_step + 1;
					break;

					case "step_goto":
						var step_goto = jQuery(form).find(".ezfc-step-start[data-id='" + cond_target_elements[ic] + "']");
						if (step_goto.length < 1) return;

						next_step = parseInt(step_goto.data("step"));
					break;
				}

				_this.set_step(jQuery(form), next_step, 0);
			}
			// show / hide elements
			else {
				if (action == "show") {
					js_action         = "removeClass";
					js_counter_action = "addClass";
				}
				else if (action == "hide") {
					js_action         = "addClass"
					js_counter_action = "removeClass";
				}
				else return;

				if (do_action) {
					cond_target[js_action]("ezfc-hidden ezfc-custom-hidden");
					
					// fade in
					if (action == "show") {
						cond_target.addClass("ezfc-fade-in");
					}
					// fade out
					else if (cond_target.is(":visible")) {
						cond_target.fadeOut(500, function() {
							cond_target.removeClass("ezfc-fade-in");

							if (_this.form_vars[form_id].clear_selected_values_hidden == 1) {
								// clear values
								_this.clear_hidden_values_element();
							}
						});
					}
				}
				// only do the counter action when notoggle is not enabled
				else if (cond_notoggle_element != 1) {
					cond_target[js_counter_action]("ezfc-hidden ezfc-custom-hidden");

					if (action == "show") { cond_target.removeClass("ezfc-fade-in"); }
					else { cond_target.addClass("ezfc-fade-in"); }
				}
			}
		});
	},

	/**
		calculate single element
	**/
	calculate_element: function(form_id, element_id, loop_price) {
		var _this = this;
		var $form    = jQuery("#ezfc-form-" + form_id);
		var $element = jQuery("#ezfc_element-" + element_id);

		// check if form and element exist
		if (!$form || !$element) {
			console.log("Unable to find form #" + form_id + " or element #" + element_id);
			return;
		}

		var calc_rows       = $element.data("calculate_rows");
		var calc_enabled    = $element.data("calculate_enabled");
		var add_to_price    = $element.data("add_to_price");
		var el_type         = $element.data("element");
		var form_has_steps  = $element.closest(".ezfc-step").length > 0;
		var overwrite_price = $element.data("overwrite_price");
		var price           = 0;

		if (el_type == "subtotal" || el_type == "custom_calculation" || el_type == "extension") {
			price = loop_price;
		}

		if (el_type == "custom_calculation") {
			calc_rows = [];
		}
	
		// dropdowns / radios / checkboxes could contain more values
		var calc_list = $element.find(".ezfc-element-numbers, .ezfc-element-input-hidden, .ezfc-element-subtotal, .ezfc-element-daterange-container, .ezfc-element-set, .ezfc-element-extension, :selected, :checked, .ezfc-element-custom-calculation");

		// these operators do not need any target or value
		var operator_no_check = ["ceil", "floor", "round", "abs", "subtotal"];

		jQuery(calc_list).each(function(cl, cl_object) {
			if (typeof calc_rows === "undefined") return;

			var el_settings = {};
			if (jQuery(this).data("settings")) {
				el_settings = jQuery(this).data("settings");
			}

			// skip when calculation is disabled for hidden elements
			var check_visible = $element.is(":visible");

			// if we use steps, check_visible needs to be changed to ezfc-custom-hidden selector
			if (form_has_steps && !$element.closest(".ezfc-step-active").length) {
				check_visible = !$element.hasClass("ezfc-custom-hidden");
			}

			if (!check_visible && (!el_settings.hasOwnProperty("calculate_when_hidden") || el_settings.calculate_when_hidden == 0) && el_type != "hidden") {
				_this.add_debug_info("calculate", $element, "Skipped as element is hidden and calculate_when_hidden is not enabled.");
				return;
			}

			// no target or values to calculate with were found. skip for subtotals / hidden.
			if ((!calc_enabled || calc_enabled == 0) &&
				!calc_rows.targets &&
				!calc_rows.values &&
				el_type != "set" &&
				el_type != "subtotal" &&
				el_type != "hidden" &&
				el_type != "extension" &&
				el_type != "custom_calculation") {
				_this.add_debug_info("calculate", $element, "No target or values were found to calculate with. Subtotal, Hidden and Set elements are skipped.");
				return;
			}

			// check if calculation is enabled for _this element
			if ((!calc_enabled || calc_enabled == 0) && el_type != "custom_calculation") {
				_this.add_debug_info("calculate", $element, "Calculation is disabled.");
				return;
			}

			var factor       = parseFloat(jQuery(cl_object).data("factor"));
			var value_raw    = jQuery(cl_object).val();
			var value        = _this.get_value_from_element($element, null, false);
			var value_pct    = value / 100;
			var value_is_pct = value_raw.indexOf("%") >= 0;

			// default values
			if (!value || isNaN(value)) value = 0;
			if ((!factor || isNaN(factor)) && factor !== 0) factor = 1;

			// set addprice to value at first
			var addPrice = value;

			// basic calculations
			switch (el_type) {
				case "numbers":
				case "extension":
					addPrice = value;
				break;

				case "hidden":
					// set price from woocommerce product
					if (jQuery(cl_object).data("use_woocommerce_price")) {
						// get product price
						var woo_product_price = parseFloat(jQuery("meta[itemprop='price']").attr("content"));
						// if no price can be found, set it to 0
						if (isNaN(woo_product_price)) woo_product_price = 0;
						// element price
						addPrice = woo_product_price;
						// also set the hidden input value
						jQuery(cl_object).val(woo_product_price);
					}
					else {
						addPrice = value;
					}
				break;

				case "dropdown":
				case "radio":
				case "checkbox":
					addPrice = parseFloat(jQuery(cl_object).data("value"));
					if (isNaN(addPrice)) addPrice = 0;
				break;

				case "subtotal":
					addPrice = loop_price;
				break;

				case "daterange":
					var tmp_target_value = [
						// from
						jQuery(cl_object).find(".ezfc-element-daterange-from").datepicker("getDate"),
						// to
						jQuery(cl_object).find(".ezfc-element-daterange-to").datepicker("getDate")
					];

					addPrice = _this.jqueryui_date_diff(tmp_target_value[0], tmp_target_value[1], jQuery(cl_object).data("workdays_only")) * factor;
				break;

				// custom calculation function
				case "custom_calculation":
					var function_name = jQuery($element).find(".ezfc-element-custom-calculation").data("function");

					addPrice = window[function_name](price);

					if (calc_enabled) {
						addPrice = parseFloat(addPrice);
					}

					jQuery($element).find(".ezfc-element-custom-calculation-input").val(addPrice);

					// improve performance here
					if (ezfc_vars.debug_mode == 2) {
						var function_text = jQuery($element).find(".ezfc-element-custom-calculation script").text();
						_this.add_debug_info("custom_calculation", $element, "custom_calculation:\n" + function_text);
					}
				break;
			}

			// percent calculation
			if (value_is_pct) {
				addPrice = price * value_pct;
			}

			// check if any advanced calculations are present
			if (typeof calc_rows[0] !== "undefined") {
				// transfer "open" bracket data to "close" bracket
				for (var c_open in calc_rows) {
					if (calc_rows[c_open].target == "__open__" && typeof calc_rows[c_open].reference_index === "undefined") {
						// check for valid prio
						calc_rows[c_open].prio = parseInt(calc_rows[c_open].prio);
						if (isNaN(calc_rows[c_open].prio)) {
							calc_rows[c_open].prio = 0;
						}

						for (var c_close in calc_rows) {
							if (c_open == c_close) continue;

							calc_rows[c_close].prio = parseInt(calc_rows[c_close].prio);
							if (isNaN(calc_rows[c_close].prio)) {
								calc_rows[c_close].prio = 0;
							}

							// find next close bracket with the same priority as the open bracket
							if (calc_rows[c_close].target == "__close__" && calc_rows[c_open].prio == calc_rows[c_close].prio && typeof calc_rows[c_open].reference_index === "undefined" && typeof calc_rows[c_close].reference_index === "undefined") {
								calc_rows[c_close].operator        = calc_rows[c_open].operator;
								calc_rows[c_close].reference_index = c_open;
								calc_rows[c_open].reference_index  = c_close;
							}
						}
					}
				}

				// iterate through all operators elements
				jQuery.each(calc_rows, function(n, calc_row) {
					// no calculation operator
					if (!calc_row.operator && calc_row.target != "__close__") {
						_this.add_debug_info("calculate", $element, "#" + n + ": No operator found here.");
						return;
					}

					// skip open bracket
					if (calc_row.target == "__open__") {
						calc_row.value = addPrice;
						addPrice = 0;
						return;
					}

					var calc_target = [];
					// operator needs a target
					if (jQuery.inArray(calc_row.operator, operator_no_check) == -1 && calc_row.target != "__open__" && calc_row.target != "__close__") {
						// target to be calculated with
						calc_target = jQuery("#ezfc_element-" + calc_row.target);
						el_settings_target = calc_target.find("input").data("settings");

						// skip hidden element only if calculate_when_hidden is false
						if (calc_target.hasClass("ezfc-custom-hidden") && el_settings_target && (el_settings_target.hasOwnProperty("calculate_when_hidden") && el_settings_target.calculate_when_hidden == 0)) {
							_this.add_debug_info("calculate", $element, "#" + n + ": Skipping this element as it is conditionally hidden.");
							return;
						}
					}

					// custom value used when no target was found
					var calc_value = calc_row.value;

					// use value from target
					var target_value;
					var calc_target_id = 0;

					// target value is value of next close bracket
					if (calc_row.target == "__close__") {
						if (typeof calc_rows[calc_row.reference_index] === "undefined") return;

						target_value = addPrice;
						addPrice = calc_rows[calc_row.reference_index].value;
					}
					else {
						if (calc_target.length > 0) {
							calc_target_id = calc_target.data("id");

							if (typeof calc_row.use_calculated_target_value === "undefined") {
								calc_row.use_calculated_target_value = 0;
							}

							// raw value
							if (calc_row.use_calculated_target_value == 0) {
								target_value = _this.get_value_from_element(calc_target, null, false);
							}
							// calculated target value with subtotal
							else if (calc_row.use_calculated_target_value == 1) {
								target_value = _this.get_target_subtotal_value(form_id, calc_target_id) + _this.get_calculated_element_value(form_id, calc_target_id);
							}
							// calculated target value without subtotal
							else if (calc_row.use_calculated_target_value == 2) {
								target_value = _this.get_calculated_element_value(form_id, calc_target_id);
							}
							// raw value without factor
							else if (calc_row.use_calculated_target_value == 3) {
								target_value = _this.get_value_from_element(calc_target, null, false, true);
							}
						}
						else if (calc_value != 0) {
							target_value = parseFloat(calc_value);
						}
					}

					if (!target_value || isNaN(target_value)) target_value = 0;

					switch (calc_row.operator) {
						case "add":	addPrice += target_value;
						break;

						case "subtract": addPrice -= target_value;
						break;

						case "multiply": addPrice *= target_value;
						break;

						case "divide": 
							if (target_value == 0) {
								_this.add_debug_info("calculate", $element, "#" + n + ": Division by 0.");
								return;
							}

							addPrice /= target_value;

							// still necessary?
							if (jQuery(cl_object).data("calculate_before") == "1") {
								overwrite_price = 1;
								addPrice = target_value / value;
							}
						break;

						case "equals":
							addPrice = target_value;
						break;

						case "power":
							addPrice = Math.pow(addPrice, target_value);
						break;

						case "ceil":
							addPrice = Math.ceil(addPrice);
						break;

						case "floor":
							addPrice = Math.floor(addPrice);
						break;

						case "round":
							addPrice = Math.round(addPrice);
						break;

						case "abs":
							addPrice = Math.abs(addPrice);
						break;

						case "subtotal":
							addPrice = loop_price;
						break;

						case "log":
							if (target_value == 0) return;
							addPrice = Math.log(target_value);
						break;
						case "log2":
							if (target_value == 0) return;
							addPrice = Math.log2(target_value);
						break;
						case "log10":
							if (target_value == 0) return;
							addPrice = Math.log10(target_value);
						break;
					}

					_this.add_debug_info("calculate", $element, "#" + n + ": operator = " + calc_row.operator + "\ntarget_value = " + target_value + "\ntarget_element = #" + calc_target_id + "\ncalc_value = " + calc_value + "\naddPrice = " + addPrice);
				});
			}

			// add calculated price to total price
			if (add_to_price == 1) {
				price += addPrice;
			}
			else if (add_to_price == 2) {
				price = addPrice;
			}

			// overwrite price
			if (overwrite_price == 1) {
				price = addPrice;
			}

			_this.add_debug_info("calculate", $element, "\nprice = " + price + "\naddPrice = " + addPrice + "\nfactor = " + factor);
		});

		return price;
	},

	/**
		element calculations
	**/
	calculate_element_loop: function(form_id, el_object, el_type, price) {
		var calc_enabled    = el_object.data("calculate_enabled");
		var overwrite_price = el_object.data("overwrite_price");
		var add_to_price    = el_object.data("add_to_price");

		var addPrice = this.calculate_element(form_id, el_object.data("id"), price);
	
		// add calculated price to total price
		if (add_to_price >= 1) {
			if (overwrite_price == 1) {
				price = addPrice;
			}
			else if (calc_enabled == 1) {
				price += addPrice;
			}
		}
		// for subtotal / set elements only (doesn't interfere with calculation but use the calculated price as text)
		else {
			if (overwrite_price == 1) {
				tmp_price = addPrice;
			}
		}

		if (el_type == "subtotal" || el_type == "set" || el_type == "custom_calculation") {
			var tmp_price;
			if (add_to_price == 1) {
				tmp_price = overwrite_price==1 ? price : addPrice;
			}
			else if (add_to_price == 2) {
				tmp_price = addPrice;
			}
			else {
				tmp_price = addPrice;
			}

			var precision = 2;
			var element_settings = el_object.find("input").data("settings");
			if (element_settings) {
				precision = element_settings.precision;
			}

			var price_to_write = this.normalize_value(tmp_price.toFixed(precision), true);
			el_object.find("input").val(price_to_write);
		}

		return price;
	},

	/**
		discount calculations
	**/
	calculate_discounts: function(form, form_id, el_object, el_type, price) {
		var _this = this;
		var discount_range_min = el_object.data("discount_range_min");
		var discount_range_max = el_object.data("discount_range_max");
		var discount_operator  = el_object.data("discount_operator");
		var discount_value     = el_object.data("discount_values");
		var overwrite_price    = el_object.data("overwrite_price");

		// check if there should be conditional actions
		if (discount_value || discount_value == 0) {
			var discount_range_min_values = discount_range_min.toString().split(",");
			var discount_range_max_values = discount_range_max.toString().split(",");
			var discount_operator_values  = discount_operator.toString().split(",");
			var discount_value_values     = discount_value.toString().split(",");

			var el_value = 0;
			var factor   = 1;

			// get selected value from input fields
			if (el_type == "input" || el_type == "numbers" || el_type == "subtotal" || el_type == "hidden" || el_type == "extension") {
				var el_input = el_object.find("input");

				factor = parseFloat(el_input.data("factor"));
				if ((!factor || isNaN(factor)) && factor !== 0) factor = 1;

				el_value = this.normalize_value(el_input.val());
			}
			// get selected value from dropdowns
			else if (el_type == "dropdown") {
				el_value = parseFloat(el_object.find(":selected").data("value"));
			}
			// get selected value from radio
			else if (el_type == "radio") {
				el_value = parseFloat(el_object.find(":checked").data("value"));
			}
			// get selected values from checkboxes
			else if (el_type == "checkbox") {
				el_value = 0;
				el_object.find(":checked").each(function(ct, ct_el) {
					el_value += parseFloat(jQuery(ct_el).data("value"));
				});
			}
			// get amount of days from date range
			else if (el_type == "daterange") {
				var tmp_target_value = [
					// from
					el_object.find(".ezfc-element-daterange-from").datepicker("getDate"),
					// to
					el_object.find(".ezfc-element-daterange-to").datepicker("getDate")
				];

				el_value = _this.jqueryui_date_diff(tmp_target_value[0], tmp_target_value[1], el_object.data("workdays_only"));
			}

			// go through all discounts
			jQuery.each(discount_operator_values, function(id, operator) {
				if (discount_value_values[id].length < 1) return;
				
				if (!discount_range_min_values[id] && discount_range_min_values[id] !== 0) discount_range_min_values[id] = Number.NEGATIVE_INFINITY;
				if (!discount_range_max_values[id] && discount_range_max_values[id] !== 0) discount_range_max_values[id] = Number.POSITIVE_INFINITY;

				var discount_value_write_to_input;

				if (el_value >= parseFloat(discount_range_min_values[id]) && el_value <= parseFloat(discount_range_max_values[id])) {
					var disc_value = parseFloat(discount_value_values[id]);
					var discount_value_operator;

					switch (operator) {
						case "add":
							discount_value_operator = disc_value;
							discount_value_write_to_input = price + discount_value_operator;

							if (overwrite_price) {
								price = discount_value_write_to_input;
							}
							else {
								price += discount_value_write_to_input;
							}
						break;

						case "subtract":
							discount_value_operator = disc_value;
							discount_value_write_to_input = price - discount_value_operator;

							if (overwrite_price) {
								price = discount_value_write_to_input;
							}
							else {
								price -= discount_value_write_to_input;
							}
						break;

						case "percent_add":
							discount_value_operator = el_value * factor * (disc_value / 100);
							discount_value_write_to_input = price + discount_value_operator;

							price = discount_value_write_to_input;
						break;

						case "percent_sub":
							discount_value_operator = el_value * factor * (disc_value / 100);
							discount_value_write_to_input = price - discount_value_operator;

							price = discount_value_write_to_input;
						break;

						case "equals":
							discount_value_operator = disc_value;
							discount_value_write_to_input = discount_value_operator;

							price = discount_value_write_to_input;
						break;

						case "factor":
							discount_value_operator = el_value * disc_value;
							discount_value_write_to_input = discount_value_operator;

							price = discount_value_write_to_input;
							el_object.find("[data-factor]").attr("data-factor", disc_value);
						break;
					}

					if (el_type == "subtotal" && !isNaN(discount_value_write_to_input)) {
						discount_value_write_to_input = _this.normalize_value(discount_value_write_to_input, true);
						jQuery(el_object).find("input").val(discount_value_write_to_input);
					}

					_this.add_debug_info("discount", el_object, "discount = " + discount_value_operator + "\nprice after discount = " + price);
				}
			});
		}


		return price;
	},

	/**
		set values for set elements
	**/
	calculate_set_elements: function(form, form_id, el_object, el_type, price) {
		var _this = this;
		var set_operator = el_object.data("set_operator");
		var tmp_targets  = el_object.data("set_elements");
		var allow_zero   = el_object.data("set_allow_zero") == 1;

		// check if there should be conditional actions
		if (!tmp_targets) return;

		var targets = tmp_targets.toString().split(",");
		var value_to_write;

		jQuery.each(targets, function(i, v) {
			var target_object = jQuery("#ezfc_element-" + v);

			if (!target_object) return;

			var el_value = _this.get_value_from_element(target_object, null, false);

			// check for 0
			if (!allow_zero && el_value == 0) return;

			// first element
			if (i == 0) {
				value_to_write = el_value;
				return;
			}

			switch (set_operator) {
				case "min":
					if (el_value < value_to_write) value_to_write = el_value;
				break;

				case "max":
					if (el_value > value_to_write) value_to_write = el_value;
				break;

				case "avg":
				case "sum":
					value_to_write += el_value;
				break;

				case "dif":
					value_to_write -= el_value;
				break;

				case "prod":
					value_to_write *= el_value;
				break;

				case "quot":
					if (el_value != 0) value_to_write /= el_value;
				break;
			}
		});

		if (set_operator == "avg") {
			value_to_write = value_to_write / targets.length;
		}

		value_to_write = this.normalize_value(value_to_write, true);

		el_object.find("input").val(value_to_write);
	},

	// price calculation
	calculate_price: function(form) {
		var _this = this;
		var form_id = jQuery(form).data("id");
		var price = 0;

		// reset subtotals
		this.subtotals[form_id] = [];

		// remove debug info
		this.remove_debug_info();

		// find all elements first
		jQuery(form).find(".ezfc-custom-element").each(function(i, el_object) {
			var form_id     = jQuery(form).data("id");
			var $element    = jQuery(el_object);
			var el_id       = $element.data("id");
			var el_type     = $element.data("element");

			var el_settings = {};
			if ($element.find("input").data("settings")) {
				el_settings = $element.find("input").data("settings");
			}

			// get external value if present
			_this.calculate_get_external_values(form, form_id, $element, el_type);

			// check conditionals
			_this.calculate_conditionals(form, form_id, $element, el_type);

			var calculate_when_hidden = 0;
			if (typeof el_settings["calculate_when_hidden"] !== "undefined") {
				calculate_when_hidden = parseInt(el_settings.calculate_when_hidden);
			}

			if ($element.hasClass("ezfc-hidden") && !calculate_when_hidden) return;

			// set elements
			_this.calculate_set_elements(form, form_id, $element, el_type);

			// process calculations
			var element_loop_price = _this.calculate_element_loop(form_id, $element, el_type, price);
			price = element_loop_price;

			// discount
			price = _this.calculate_discounts(form, form_id, $element, el_type, price);

			_this.subtotals[form_id].push({
				el_id: el_id,
				price: price
			});

			// check conditionals again
			_this.calculate_conditionals(form, form_id, $element, el_type);
		});

		return price;
	},

	set_price: function(form, price_old, force_price) {
		var _this   = this;
		var form_id = jQuery(form).data("id");

		// calculate price
		if (force_price) {
			price = force_price;
		}
		else if (!price_old || price_old !== 0) {
			price = this.calculate_price(jQuery(form));
		}

		this.set_subtotal_values(jQuery(form));

		// show price after request
		if (this.form_vars[form_id].price_show_request == 1 && this.form_vars[form_id].price_requested == 0) {
			this.price_request_toggle(form_id, false);

			return;
		}

		if (typeof this.price_old_global[form_id] === "undefined") this.price_old_global[form_id] = 0;
		if (this.price_old_global[form_id] == price) return;

		if (this.form_vars[form_id].counter_duration != 0) {
			jQuery(form).find(".ezfc-price-value").countTo({
				from: _this.price_old_global[form_id],
				to: price,
				speed: this.form_vars[form_id].counter_duration,
				refreshInterval: this.form_vars[form_id].counter_interval,
				formatter: function (value, options) {
					return _this.format_price(form_id, value);
				}
			});
		}
		else {
			jQuery(form).find(".ezfc-price-value").text(this.format_price(form_id, price));
		}

		this.price_old_global[form_id] = price;
	},

	format_price: function(form_id, price, currency, custom_price_format, format_with_currency) {
		var form_price_format = this.defaultFormat;
		var form_currency     = currency || this.form_vars[form_id].currency;

		// use price format from form settings
		if (this.form_vars[form_id].price_format && this.form_vars[form_id].price_format.length > 0) {
			form_price_format = this.form_vars[form_id].price_format;
		}

		// if defined, use custom price format
		if (custom_price_format && custom_price_format.length > 0) {
			form_price_format = custom_price_format;
		}

		if (isNaN(price)) price = 0;

		var price_formatted = 0;
		if (isFinite(price)) {
			price_formatted = numeral(price).format(form_price_format);
		}

		// add currency symbol
		if (format_with_currency) {
			if (this.form_vars[form_id].currency_position == 0) {
				price_formatted = form_currency + price_formatted;
			}
			else {
				price_formatted = price_formatted + form_currency;
			}
		}

		return price_formatted;
	},

	// price request toggler
	price_request_toggle: function(form_id, enable, price) {
		var form = jQuery(".ezfc-form[data-id='" + form_id + "']");

		// enable submit
		if (enable) {
			this.price_old_global[form_id] = 0;
			this.form_vars[form_id].price_requested = 1;
			// calculate form price so element values show the correct price
			this.calculate_price(form);
			// set request price
			this.set_price(form, null, price);
			// set submit button text
			this.set_submit_text(form);
		}
		else {
			this.form_vars[form_id].price_requested = 0;

			jQuery(form).find(".ezfc-price-value").text(this.form_vars[form_id].price_show_request_before);
			jQuery(form).find(".ezfc-submit").val(this.form_vars[form_id].submit_text.request);
		}
	},

	set_subtotal_values: function(form) {
		var _this = this;

		var element_list = ["subtotal", "set", "numbers"];

		jQuery(element_list).each(function(el_i, el_e) {
			jQuery(form).find("[data-element='" + el_e + "']").each(function(i, el) {
				var $tmp_element  = jQuery(el).find(".ezfc-element-" + el_e);
				var value         = _this.normalize_value($tmp_element.val());
				var price_format  = null;

				var el_settings, text;

				if ($tmp_element.data("settings")) {
					el_settings  = $tmp_element.data("settings");
					price_format = el_settings.price_format;
				}

				text = _this.format_price(jQuery(form).data("id"), value, null, price_format);

				jQuery(el).find(".ezfc-text").text(text);
			});
		});
	},

	scroll: function() {
		jQuery(".ezfc-fixed-price").each(function() {
			var offset             = jQuery(this).offset();
			var form_id            = jQuery(this).data("id");
			var form               = jQuery(".ezfc-form[data-id='" + form_id + "']");
			var form_height        = form.outerHeight();
			var form_offset        = form.offset();
			var window_top         = jQuery(window).scrollTop();
			var price_position_top = parseFloat(EZFC.form_vars[form_id].price_position_scroll_top);

			var diff = form_offset.top - window_top - price_position_top;
			if (diff < 0 && diff > -form_height) jQuery(this).offset({ top: window_top + price_position_top });
			if (diff > 0 && offset.top > form_offset.top) jQuery(this).offset({ top: form_offset.top });
		});
	},

	// reset disabled fields and restore initial values (since they may have changed due to conditional logic). also, set the relevant submit button text
	reset_disabled_fields: function(form, error) {
		var $form_wrapper = jQuery(form).closest(".ezfc-wrapper");

		jQuery(form).find(".ezfc-custom-hidden").each(function() {
			jQuery.each(jQuery(this).find("input, :selected"), function(i, v) {
				jQuery(this).val(jQuery(this).data("index")).removeAttr("disabled");
			});
		});

		// also reset payment fields
		$form_wrapper.find(".ezfc-payment-submit, .ezfc-payment-cancel").prop("disabled", false);

		this.set_submit_text(form, error);
	},

	// reset the whole form
	reset_form: function($form) {
		this.init_form($form);

		// reset values
		$form.find(".ezfc-custom-element").each(function() {
			var el_type = jQuery(this).data("element");
			var initvalue = jQuery(this).find("[data-initvalue]").data("initvalue");

			switch (el_type) {
				case "checkbox":
					jQuery(this).find("input").each(function() {
						initvalue = jQuery(this).data("initvalue");

						if (initvalue == 1)
							jQuery(this).prop("checked", true);
						else
							jQuery(this).removeAttr("checked");
					});
				break;

				case "dropdown":
					jQuery(this).find("option").removeAttr("selected");
					jQuery(this).find("option[data-index='" + initvalue + "']").prop("selected", true);
				break;

				case "numbers":
					jQuery(this).find("input").val(initvalue);
					var $sliders = jQuery(this).find(".ezfc-slider-element");
					if ($sliders.length) $sliders.slider({ value: initvalue });
				break;

				case "radio":
					jQuery(this).find("input").removeAttr("checked");
					jQuery(this).find("input[data-initvalue]").prop("checked", true);
				break;

				case "textfield":
					jQuery(this).find("textarea").val(initvalue);
				break;

				default:
					jQuery(this).find("input").val(initvalue);
				break;
			}
		});

		$form.find(".ezfc-selected").removeClass("ezfc-selected");

		this.set_step($form, 0, 0);
		this.form_change($form);
	},

	set_step: function(form, new_step, verify) {
		var _this = this;
		var current_step = parseInt(form.find(".ezfc-step-active").data("step"));
		var step_wrapper = form.find(".ezfc-step[data-step='" + current_step + "']");
		var form_id      = form.data("id");

		if (current_step == new_step) return;

		// check ajax
		if (verify == 1 && this.form_vars[form_id].verify_steps == 1) {
			var submit_icon = form.find(".ezfc-submit-icon");
			submit_icon.fadeIn();

			this.form_submit(form, new_step - 1);

			jQuery(".ezfc-has-hidden-placeholder").val("").removeClass("ezfc-has-hidden-placeholder");
			return;
		}

		var step_indicator_start = parseInt(this.form_vars[form_id].step_indicator_start) - 1;

		step_wrapper.fadeOut(200, function() {
			var step_wrapper_next = form.find(".ezfc-step[data-step='" + new_step + "']");
			
			step_wrapper_next.fadeIn(200).addClass("ezfc-step-active");
			jQuery(this).removeClass("ezfc-step-active");

			// maybe show step indicator
			if (new_step >= step_indicator_start) {
				form.find(".ezfc-step-indicator").fadeIn();
			}
			else {
				form.find(".ezfc-step-indicator").hide();
			}

			_this.scroll_to(step_wrapper_next);
		});

		form.find(".ezfc-step-indicator-item").each(function() {
			var step_dom = parseInt(jQuery(this).data("step"));
			jQuery(this).removeClass("ezfc-step-indicator-item-active");
			
			if (step_dom <= new_step) {
				jQuery(this).addClass("ezfc-step-indicator-item-active");
			}
		});

		return false;
	},

	scroll_to: function(element, custom_offset) {
		var element_offset = jQuery(element).offset();

		if (typeof element_offset === "undefined" || ezfc_vars.auto_scroll_steps == 0) return;

		var offset_add = parseFloat(custom_offset) || parseFloat(ezfc_vars.scroll_steps_offset) || 50;
		var offset_scroll = element_offset.top + offset_add;

		jQuery("html, body").animate({ scrollTop: offset_scroll });
	},

	get_value_from_element: function($el_object, e_id, is_text, ignore_factor, options) {
		var _this = this;
		var default_options = {
			return_array: false,
			return_value: "value"
		};
		options = jQuery.extend({}, default_options, options);

		if (!$el_object) $el_object = jQuery("#ezfc_element-" + e_id);
		if (!$el_object.length) {
			this.debug_message("Unable to find element #" + e_id);
			return 0;
		}

		var el_type       = $el_object.data("element");
		var value_raw     = $el_object.find("input").val();
		var value_is_pct  = value_raw ? value_raw.indexOf("%") >= 0 : 0;
		var value         = value_is_pct ? this.normalize_value(value_raw, false, true) : this.normalize_value(value_raw);
		var value_pct     = value / 100;

		// default values
		if (!value || isNaN(value)) value = 0;

		// set addprice to value first
		var return_value = is_text ? value : parseFloat(value);

		// basic calculations
		switch (el_type) {
			case "subtotal":
			case "numbers":
			case "hidden":
			case "extension":
			case "set":
				var $input_element = $el_object.find("input");
				var factor = parseFloat($input_element.data("factor"));

				if ((!factor || isNaN(factor)) && factor !== 0) factor = 1;

				if (is_text) {
					return_value = value_raw;
				}
				else {
					return_value = ignore_factor ? value : value * factor;
				}
			break;

			case "dropdown":
			case "radio":
			case "checkbox":
				$el_object.find(":selected, :checked").each(function() {
					// return array of checked / selected values
					if (is_text) {
						// return array of selected values from index or actual value
						var read_value = options.return_value

						if (typeof return_value !== "object") return_value = [];
						return_value.push(jQuery(this).data(read_value));
					}
					// add up values by default
					else {
						return_value += parseFloat(jQuery(this).data("value"));
					}
				});
			break;

			case "daterange":
				var tmp_target_value = [
					// from
					$el_object.find(".ezfc-element-daterange-from").datepicker("getDate"),
					// to
					$el_object.find(".ezfc-element-daterange-to").datepicker("getDate")
				];

				var factor = parseFloat($el_object.find(".ezfc-element-daterange-from").data("factor"));

				if ((!factor || isNaN(factor)) && factor !== 0) factor = 1;

				// return dates as array
				if (is_text) {
					return_value = tmp_target_value;
				}
				// return date difference in days
				else {
					var days = _this.jqueryui_date_diff(tmp_target_value[0], tmp_target_value[1], $el_object.data("workdays_only"));

					return_value = ignore_factor ? days : days * factor;
				}
			break;

			// custom calculation function
			case "custom_calculation":
				return_value = $el_object.find(".ezfc-element-custom-calculation-input").val();

				if (!is_text) {
					return_value = parseFloat(return_value);
				}
			break;

			case "starrating":
				return_value = parseFloat($el_object.find(":checked").val());
				if (isNaN(return_value)) return_value = 0;
			break;
		}

		// percent calculation
		if (value_is_pct) {
			return_value = price * value_pct;
		}

		if (!is_text) {
			if (isNaN(return_value)) return_value = 0;
			
			return !return_value ? 0 : parseFloat(return_value);
		}

		return return_value;
	},

	clear_hidden_values: function(form) {
		var form_id = jQuery(form).data("id");
		if (this.form_vars[form_id].clear_selected_values_hidden != 1) return;

		jQuery(form).find(".ezfc-custom-hidden").each(function() {	
			jQuery(this).find("input[type='text']").val("");
			jQuery(this).find(":checkbox, :radio").prop("checked", false);
		});
	},

	clear_hidden_values_element: function(element) {
		var cond_target_type = element.data("element");

		if (cond_target_type == "input" || cond_target_type == "numbers" || cond_target_type == "subtotal") {
			cond_target.find("input").val("");
		}
		else if (cond_target_type == "dropdown") {
			cond_target.find(":selected").removeAttr("selected");
		}
		else if (cond_target_type == "radio" || cond_target_type == "checkbox") {
			cond_target.find(":checked").removeAttr("checked");
		}
	},

	normalize_value: function(value, reverse, parse) {
		var decimal_point    = ezfc_vars.price_format_dec_point;
		var value_normalized = String(value);

		// use dot as default
		if (decimal_point.length < 1) decimal_point = ".";

		if (reverse) {
			if (decimal_point == ",") {
				value_normalized = value_normalized.replace(",", "");
				value_normalized = value_normalized.replace(".", ",");
			}
		}
		else {
			if (decimal_point == ",") {
				value_normalized = value_normalized.replace(".", "");
				value_normalized = value_normalized.replace(",", ".");
			}
		}

		if (parse) {
			// pct calculation
			if (value_normalized.indexOf("%") >= 0) {
				value_normalized = value_normalized.replace("%", "");
			}

			value_normalized = parseFloat(value_normalized);
			if (isNaN(value_normalized)) value_normalized = 0;
		}

		return value_normalized;
	},

	set_submit_text: function(form, error) {
		var form_id = jQuery(form).data("id");

		// default submit text
		var $submit_button = jQuery(form).find(".ezfc-submit");
		var submit_type = "default";
		var submit_text = this.form_vars[form_id].submit_text.default;
		
		// price request
		if (this.form_vars[form_id].price_show_request == 1) {
			if (!this.form_vars[form_id].price_requested || error) {
				submit_text = this.form_vars[form_id].submit_text.request;
				submit_type = "request";
			}

			if (error) {
				this.price_request_toggle(form_id, false);
				return false;
			}
		}
		// summary
		else if (this.form_vars[form_id].summary_enabled == 1 && this.form_vars[form_id].summary_shown == 0) {
			submit_type = "summary";
			submit_text = this.form_vars[form_id].submit_text.summary;
		}
		// paypal
		else if (this.form_vars[form_id].use_paypal == 1) {
			submit_type = "paypal";
			submit_text = this.form_vars[form_id].submit_text.paypal;
		}
		// stripe
		else if (this.form_vars[form_id].payment_force_stripe == 1) {
			submit_type = "stripe";
			submit_text = this.form_vars[form_id].submit_text.stripe;
		}
		// woocommerce
		else if (this.form_vars[form_id].use_woocommerce == 1) {
			submit_type = "woocommerce";
			submit_text = this.form_vars[form_id].submit_text.woocommerce;
		}
		// default text
		else {
			submit_text = this.form_vars[form_id].submit_text.default;

			// check is payment method is used and use payment submit text
			var payment_method_element = jQuery(form).find(".ezfc-element-wrapper-payment");
			if (payment_method_element.length > 0) {
				var payment_method_value = jQuery(payment_method_element).find(":checked").data("value");

				if (typeof this.form_vars[form_id].submit_text[payment_method_value] !== "undefined") {
					submit_type = payment_method_value;
					submit_text = this.form_vars[form_id].submit_text[payment_method_value];
				}
			}
		}

		$submit_button.val(submit_text);
		$submit_button.data("type", submit_type);
	},

	/**
		prevent enter key to trigger the click-event on step-buttons since pressing enter would submit the form and move a step backwards in the last step
	**/
	prevent_enter_step_listener: function($elements, $form) {
		// step prevent enter keypress
		jQuery($elements).keypress(function(e) {
			// normalize
			var key = e.keyCode || e.which;

			if (e.which == 13) {
				//_this.form_submit($form, -1);
				e.preventDefault();
			}
		});
	},

	/**
		js hooks for advanced customization purposes
	**/
	call_hook: function(hook_name, args) {
		var func = window[hook_name];

		if (typeof func !== "function") return;

		args = args || {};

		func(args);
	},

	/**
		stripe response handler
	**/
	stripe_response_handler: function(status, response) {
		var _this = EZFC; // "this" is overriden for some reason
		var $form = jQuery(".ezfc-form[data-id='" + _this.payment_form_id + "']");
		var $form_payment = jQuery(".ezfc-payment-form[data-form_id='" + _this.payment_form_id + "']");

		if (response.error) {
			_this.debug_message(response.error.message);

			jQuery("#ezfc-payment-message-" + _this.payment_form_id).text(response.error.message);
			$form_payment.find(".ezfc-payment-submit, .ezfc-payment-cancel").prop("disabled", false);

			setTimeout(function() {
				jQuery("#ezfc-payment-message-" + _this.payment_form_id).text("");
			}, 7500)
		}
		else {
			// Get the token ID:
			var token = response.id;

			// Insert the token ID into the form so it gets submitted to the server:
			$form.find("#ezfc-stripetoken-" + _this.payment_form_id).val(token);

			// Submit the form:
			_this.form_submit($form, -1, "stripe-checkout");
		}
	},

	/**
		get subtotal value from target
	**/
	get_target_subtotal_value: function(form_id, element_id, use_previous_element_price) {
		for (i in this.subtotals[form_id]) {
			if (this.subtotals[form_id][i].el_id == element_id) {
				if (use_previous_element_price) {
					// if previous element doesn't exist, return 0
					return typeof this.subtotals[form_id][i-1] !== "undefined" ? this.subtotals[form_id][i-1].price : 0;
				}
				else {
					return this.subtotals[form_id][i].price;
				}
			}
		}

		return null;
	},

	get_calculated_element_value: function(form_id, element_id) {
		var $form = jQuery("#ezfc-form-" + form_id);
		var $element = jQuery("#ezfc_element-" + element_id);
		var el_type = $element.data("element");

		// calculations
		var calculated_value = this.calculate_element_loop(form_id, $element, el_type, 0);
		// discount
		calculated_value = this.calculate_discounts($form, form_id, $element, el_type, calculated_value);

		return calculated_value;
	},

	/**
		set message
	**/
	set_message: function(form_id, message) {
		var $form = jQuery("#ezfc-form-" + form_id);
		if (!$form) return false;

		var $form_wrapper = $form.closest(".ezfc-wrapper");
		var $message_wrapper;

		// use payment message element
		if ($form_wrapper.find(".ezfc-payment-dialog-open").length > 0) {
			$message_wrapper = $form_wrapper.find(".ezfc-payment-errors");
		}
		else {
			$message_wrapper = $form.parents(".ezfc-wrapper").find(".ezfc-message");
		}

		if (!$message_wrapper.length && console) {
			console.log(message);
			return false;
		}

		$message_wrapper.text(message).fadeIn().delay(7500).fadeOut();
	},

	/**
		reload recaptcha
	**/
	recaptcha_reload: function() {
		var has_recaptcha = jQuery(".ezfc-form .g-recaptcha").length;

		if (has_recaptcha && typeof grecaptcha !== "undefined") {
			grecaptcha.reset();
		}
	},

	/**
		populate html placeholders
	**/
	populate_html_placeholders: function($form) {
		var _this = this;

		$form.find(".ezfc-html-placeholder").each(function(i, el) {
			var target_id = _this.functions.get_element_id_by_name($form.data("id"), jQuery(el).data("listen_target"));

			if (!target_id) return;

			var value = _this.functions.get_value_from(target_id, true);
			value = jQuery.trim(value);

			jQuery(el).text(value);
		});
	},

	/**
		toggle group
	**/
	toggle_group: function($group_wrapper) {
		var $group = $group_wrapper.find("> .ezfc-group-elements").first();

		$group.slideToggle(500);

		var icon_class_open   = "fa-chevron-circle-down";
		var icon_class_closed = "fa-chevron-circle-right";

		var $toggle_icon = $group_wrapper.find(".ezfc-collapse-icon i").first();
		if ($toggle_icon.hasClass(icon_class_open)) {
			$toggle_icon.removeClass(icon_class_open).addClass(icon_class_closed);
		}
		else {
			$toggle_icon.removeClass(icon_class_closed).addClass(icon_class_open);
		}
	},

	/**
		show tip
	**/
	show_tip: function(el_tip, el_target, tip_delay, message) {
		var tip = new Opentip(el_tip, {
			background: ezfc_vars.opentip.background || "yellow",
			delay: tip_delay,
			hideDelay: 0.1,
			hideTriggers: ["closeButton", "target"],
			removeElementsOnHide: true,
			showOn: null,
			target: el_target,
			tipJoint: ezfc_vars.required_text_position || "middle right",
		});

		tip.setContent(message);
		tip.show();
	},


	/**
		debug
	**/
	remove_debug_info: function() {
		jQuery(".ezfc-debug-info").remove();
	},

	add_debug_info: function(type, element, text) {
		if (ezfc_vars.debug_mode != 2) return;

		var type = jQuery(element).data("element");
		// don't show group elements
		if (type == "group") return;

		var id = jQuery(element).attr("id");
		if (id) {
			id = id.split("ezfc_element-")[1];
		}

		var element_type = jQuery(element).data("element");

		jQuery(element).append("<pre class='ezfc-debug-info ezfc-debug-type-" + type + "'>[[" + element_type + " #" + id + "]]\n[" + type + "]\n" + text + "</pre>");

		console.log(text, element);
	},

	debug_message: function(message) {
		if (ezfc_vars.debug_mode == 0) return;

		console.log(message);
	},

	/**
		misc
	**/
	jqueryui_date_diff: function(start, end, workdays_only) {
		if (!start || !end)  return 0;

		var days = 0;

		if (workdays_only) {
			var elapsed, daysBeforeFirstSaturday, daysAfterLastSunday;
			var ifThen = function (a, b, c) {
				return a == b ? c : a;
			};

			elapsed = end - start;
			elapsed /= 86400000;

			daysBeforeFirstSunday = (7 - start.getDay()) % 7;
			daysAfterLastSunday = end.getDay();

			elapsed -= (daysBeforeFirstSunday + daysAfterLastSunday);
			elapsed = (elapsed / 7) * 5;
			elapsed += ifThen(daysBeforeFirstSunday - 1, -1, 0) + ifThen(daysAfterLastSunday, 6, 5);

			days = Math.ceil(elapsed);
		}
		else {
			days = (end - start) / 1000 / 60 / 60 / 24;
		}

		return days;
	}
};

ezfc_functions = {};

jQuery(document).ready(function() {
	EZFC.init();
});