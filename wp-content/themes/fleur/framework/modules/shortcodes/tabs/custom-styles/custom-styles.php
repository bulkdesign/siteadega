<?php
if(!function_exists('fleur_mikado_tabs_typography_styles')) {
	function fleur_mikado_tabs_typography_styles() {
		$selector              = '.mkd-tabs .mkd-tabs-nav li a';
		$tabs_tipography_array = array();
		$font_family           = fleur_mikado_options()->getOptionValue('tabs_font_family');

		if(fleur_mikado_is_font_option_valid($font_family)) {
			$tabs_tipography_array['font-family'] = fleur_mikado_is_font_option_valid($font_family);
		}

		$text_transform = fleur_mikado_options()->getOptionValue('tabs_text_transform');
		if(!empty($text_transform)) {
			$tabs_tipography_array['text-transform'] = $text_transform;
		}

		$font_style = fleur_mikado_options()->getOptionValue('tabs_font_style');
		if(!empty($font_style)) {
			$tabs_tipography_array['font-style'] = $font_style;
		}

		$letter_spacing = fleur_mikado_options()->getOptionValue('tabs_letter_spacing');
		if($letter_spacing !== '') {
			$tabs_tipography_array['letter-spacing'] = fleur_mikado_filter_px($letter_spacing).'px';
		}

		$font_weight = fleur_mikado_options()->getOptionValue('tabs_font_weight');
		if(!empty($font_weight)) {
			$tabs_tipography_array['font-weight'] = $font_weight;
		}

		echo fleur_mikado_dynamic_css($selector, $tabs_tipography_array);
	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_tabs_typography_styles');
}

if(!function_exists('fleur_mikado_tabs_inital_color_styles')) {
	function fleur_mikado_tabs_inital_color_styles() {
		$selector = '.mkd-tabs .mkd-tabs-nav li a';
		$styles   = array();

		if(fleur_mikado_options()->getOptionValue('tabs_color')) {
			$styles['color'] = fleur_mikado_options()->getOptionValue('tabs_color');
		}
		if(fleur_mikado_options()->getOptionValue('tabs_back_color')) {
			$styles['background-color'] = fleur_mikado_options()->getOptionValue('tabs_back_color');
		}
		if(fleur_mikado_options()->getOptionValue('tabs_border_color')) {
			$styles['border-color'] = fleur_mikado_options()->getOptionValue('tabs_border_color');
		}

		echo fleur_mikado_dynamic_css($selector, $styles);
	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_tabs_inital_color_styles');
}
if(!function_exists('fleur_mikado_tabs_active_color_styles')) {
	function fleur_mikado_tabs_active_color_styles() {
		$selector = '.mkd-tabs .mkd-tabs-nav li.ui-state-active a, .mkd-tabs .mkd-tabs-nav li.ui-state-hover a';
		$styles   = array();

		if(fleur_mikado_options()->getOptionValue('tabs_color_active')) {
			$styles['color'] = fleur_mikado_options()->getOptionValue('tabs_color_active');
		}
		if(fleur_mikado_options()->getOptionValue('tabs_back_color_active')) {
			$styles['background-color'] = fleur_mikado_options()->getOptionValue('tabs_back_color_active');
		}
		if(fleur_mikado_options()->getOptionValue('tabs_border_color_active')) {
			$styles['border-color'] = fleur_mikado_options()->getOptionValue('tabs_border_color_active');
		}

		echo fleur_mikado_dynamic_css($selector, $styles);
	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_tabs_active_color_styles');
}