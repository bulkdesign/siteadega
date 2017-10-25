<?php

if(!function_exists('fleur_mikado_search_covers_header_style')) {

	function fleur_mikado_search_covers_header_style() {

		if(fleur_mikado_options()->getOptionValue('search_height') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-slide-header-bottom.mkd-animated .mkd-form-holder-outer, .mkd-search-slide-header-bottom .mkd-form-holder-outer, .mkd-search-slide-header-bottom', array(
				'height' => fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_height')).'px'
			));
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_search_covers_header_style');

}

if(!function_exists('fleur_mikado_search_opener_icon_size')) {

	function fleur_mikado_search_opener_icon_size() {

		if(fleur_mikado_options()->getOptionValue('header_search_icon_size')) {
			echo fleur_mikado_dynamic_css('.mkd-page-header .mkd-search-opener', array(
				'font-size' => fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('header_search_icon_size')).'px'
			));
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_search_opener_icon_size');

}

if(!function_exists('fleur_mikado_search_opener_icon_colors')) {

	function fleur_mikado_search_opener_icon_colors() {

		if(fleur_mikado_options()->getOptionValue('header_search_icon_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-page-header .mkd-search-opener', array(
				'color' => fleur_mikado_options()->getOptionValue('header_search_icon_color')
			));
		}

		if(fleur_mikado_options()->getOptionValue('header_search_icon_hover_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-page-header .mkd-search-opener:hover', array(
				'color' => fleur_mikado_options()->getOptionValue('header_search_icon_hover_color')
			));
		}

		if(fleur_mikado_options()->getOptionValue('header_light_search_icon_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-light-header .mkd-page-header > div:not(.mkd-sticky-header) .mkd-search-opener,
			.mkd-light-header.mkd-header-style-on-scroll .mkd-page-header .mkd-search-opener,
			.mkd-light-header .mkd-top-bar .mkd-search-opener', array(
				'color' => fleur_mikado_options()->getOptionValue('header_light_search_icon_color').' !important'
			));
		}

		if(fleur_mikado_options()->getOptionValue('header_light_search_icon_hover_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-light-header .mkd-page-header > div:not(.mkd-sticky-header) .mkd-search-opener:hover,
			.mkd-light-header.mkd-header-style-on-scroll .mkd-page-header .mkd-search-opener:hover,
			.mkd-light-header .mkd-top-bar .mkd-search-opener:hover', array(
				'color' => fleur_mikado_options()->getOptionValue('header_light_search_icon_hover_color').' !important'
			));
		}

		if(fleur_mikado_options()->getOptionValue('header_dark_search_icon_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-dark-header .mkd-page-header > div:not(.mkd-sticky-header) .mkd-search-opener,
			.mkd-dark-header.mkd-header-style-on-scroll .mkd-page-header .mkd-search-opener,
			.mkd-dark-header .mkd-top-bar .mkd-search-opener', array(
				'color' => fleur_mikado_options()->getOptionValue('header_dark_search_icon_color').' !important'
			));
		}
		if(fleur_mikado_options()->getOptionValue('header_dark_search_icon_hover_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-dark-header .mkd-page-header > div:not(.mkd-sticky-header) .mkd-search-opener:hover,
			.mkd-dark-header.mkd-header-style-on-scroll .mkd-page-header .mkd-search-opener:hover,
			.mkd-dark-header .mkd-top-bar .mkd-search-opener:hover', array(
				'color' => fleur_mikado_options()->getOptionValue('header_dark_search_icon_hover_color').' !important'
			));
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_search_opener_icon_colors');

}

if(!function_exists('fleur_mikado_search_opener_icon_background_colors')) {

	function fleur_mikado_search_opener_icon_background_colors() {

		if(fleur_mikado_options()->getOptionValue('search_icon_background_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-opener', array(
				'background-color' => fleur_mikado_options()->getOptionValue('search_icon_background_color')
			));
		}

		if(fleur_mikado_options()->getOptionValue('search_icon_background_hover_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-opener:hover', array(
				'background-color' => fleur_mikado_options()->getOptionValue('search_icon_background_hover_color')
			));
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_search_opener_icon_background_colors');
}

if(!function_exists('fleur_mikado_search_opener_text_styles')) {

	function fleur_mikado_search_opener_text_styles() {
		$text_styles = array();

		if(fleur_mikado_options()->getOptionValue('search_icon_text_color') !== '') {
			$text_styles['color'] = fleur_mikado_options()->getOptionValue('search_icon_text_color');
		}
		if(fleur_mikado_options()->getOptionValue('search_icon_text_fontsize') !== '') {
			$text_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_icon_text_fontsize')).'px';
		}
		if(fleur_mikado_options()->getOptionValue('search_icon_text_lineheight') !== '') {
			$text_styles['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_icon_text_lineheight')).'px';
		}
		if(fleur_mikado_options()->getOptionValue('search_icon_text_texttransform') !== '') {
			$text_styles['text-transform'] = fleur_mikado_options()->getOptionValue('search_icon_text_texttransform');
		}
		if(fleur_mikado_options()->getOptionValue('search_icon_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('search_icon_text_google_fonts')).', sans-serif';
		}
		if(fleur_mikado_options()->getOptionValue('search_icon_text_fontstyle') !== '') {
			$text_styles['font-style'] = fleur_mikado_options()->getOptionValue('search_icon_text_fontstyle');
		}
		if(fleur_mikado_options()->getOptionValue('search_icon_text_fontweight') !== '') {
			$text_styles['font-weight'] = fleur_mikado_options()->getOptionValue('search_icon_text_fontweight');
		}

		if(!empty($text_styles)) {
			echo fleur_mikado_dynamic_css('.mkd-search-icon-text', $text_styles);
		}
		if(fleur_mikado_options()->getOptionValue('search_icon_text_color_hover') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-opener:hover .mkd-search-icon-text', array(
				'color' => fleur_mikado_options()->getOptionValue('search_icon_text_color_hover')
			));
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_search_opener_text_styles');
}

if(!function_exists('fleur_mikado_search_opener_spacing')) {

	function fleur_mikado_search_opener_spacing() {
		$spacing_styles = array();

		if(fleur_mikado_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_padding_left')).'px';
		}
		if(fleur_mikado_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_padding_right')).'px';
		}
		if(fleur_mikado_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_margin_left')).'px';
		}
		if(fleur_mikado_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_margin_right')).'px';
		}

		if(!empty($spacing_styles)) {
			echo fleur_mikado_dynamic_css('.mkd-search-opener', $spacing_styles);
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_search_opener_spacing');
}

if(!function_exists('fleur_mikado_search_bar_background')) {

	function fleur_mikado_search_bar_background() {

		if(fleur_mikado_options()->getOptionValue('search_background_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-slide-header-bottom, .mkd-search-cover, .mkd-search-fade .mkd-fullscreen-search-holder .mkd-fullscreen-search-table, .mkd-fullscreen-search-overlay, .mkd-search-slide-window-top, .mkd-search-slide-window-top input[type="text"]', array(
				'background-color' => fleur_mikado_options()->getOptionValue('search_background_color')
			));
		}
	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_search_bar_background');
}

if(!function_exists('fleur_mikado_search_text_styles')) {

	function fleur_mikado_search_text_styles() {
		$text_styles = array();

		if(fleur_mikado_options()->getOptionValue('search_text_color') !== '') {
			$text_styles['color'] = fleur_mikado_options()->getOptionValue('search_text_color');
		}
		if(fleur_mikado_options()->getOptionValue('search_text_fontsize') !== '') {
			$text_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_text_fontsize')).'px';
		}
		if(fleur_mikado_options()->getOptionValue('search_text_texttransform') !== '') {
			$text_styles['text-transform'] = fleur_mikado_options()->getOptionValue('search_text_texttransform');
		}
		if(fleur_mikado_options()->getOptionValue('search_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('search_text_google_fonts')).', sans-serif';
		}
		if(fleur_mikado_options()->getOptionValue('search_text_fontstyle') !== '') {
			$text_styles['font-style'] = fleur_mikado_options()->getOptionValue('search_text_fontstyle');
		}
		if(fleur_mikado_options()->getOptionValue('search_text_fontweight') !== '') {
			$text_styles['font-weight'] = fleur_mikado_options()->getOptionValue('search_text_fontweight');
		}
		if(fleur_mikado_options()->getOptionValue('search_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_text_letterspacing')).'px';
		}

		if(!empty($text_styles)) {
			echo fleur_mikado_dynamic_css('.mkd-search-slide-header-bottom input[type="text"], .mkd-search-cover input[type="text"], .mkd-fullscreen-search-holder .mkd-search-field, .mkd-search-slide-window-top input[type="text"]', $text_styles);
		}
		if(fleur_mikado_options()->getOptionValue('search_text_disabled_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-slide-header-bottom.mkd-disabled input[type="text"]::-webkit-input-placeholder, .mkd-search-slide-header-bottom.mkd-disabled input[type="text"]::-moz-input-placeholder', array(
				'color' => fleur_mikado_options()->getOptionValue('search_text_disabled_color')
			));
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_search_text_styles');
}

if(!function_exists('fleur_mikado_search_label_styles')) {

	function fleur_mikado_search_label_styles() {
		$text_styles = array();

		if(fleur_mikado_options()->getOptionValue('search_label_text_color') !== '') {
			$text_styles['color'] = fleur_mikado_options()->getOptionValue('search_label_text_color');
		}
		if(fleur_mikado_options()->getOptionValue('search_label_text_fontsize') !== '') {
			$text_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_label_text_fontsize')).'px';
		}
		if(fleur_mikado_options()->getOptionValue('search_label_text_texttransform') !== '') {
			$text_styles['text-transform'] = fleur_mikado_options()->getOptionValue('search_label_text_texttransform');
		}
		if(fleur_mikado_options()->getOptionValue('search_label_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('search_label_text_google_fonts')).', sans-serif';
		}
		if(fleur_mikado_options()->getOptionValue('search_label_text_fontstyle') !== '') {
			$text_styles['font-style'] = fleur_mikado_options()->getOptionValue('search_label_text_fontstyle');
		}
		if(fleur_mikado_options()->getOptionValue('search_label_text_fontweight') !== '') {
			$text_styles['font-weight'] = fleur_mikado_options()->getOptionValue('search_label_text_fontweight');
		}
		if(fleur_mikado_options()->getOptionValue('search_label_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_label_text_letterspacing')).'px';
		}

		if(!empty($text_styles)) {
			echo fleur_mikado_dynamic_css('.mkd-fullscreen-search-holder .mkd-search-label', $text_styles);
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_search_label_styles');
}

if(!function_exists('fleur_mikado_search_icon_styles')) {

	function fleur_mikado_search_icon_styles() {

		if(fleur_mikado_options()->getOptionValue('search_icon_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-slide-window-top > i, .mkd-search-slide-header-bottom .mkd-search-submit i, .mkd-fullscreen-search-holder .mkd-search-submit', array(
				'color' => fleur_mikado_options()->getOptionValue('search_icon_color')
			));
		}
		if(fleur_mikado_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-slide-window-top > i:hover, .mkd-search-slide-header-bottom .mkd-search-submit i:hover, .mkd-fullscreen-search-holder .mkd-search-submit:hover', array(
				'color' => fleur_mikado_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if(fleur_mikado_options()->getOptionValue('search_icon_disabled_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-slide-header-bottom.mkd-disabled .mkd-search-submit i, .mkd-search-slide-header-bottom.mkd-disabled .mkd-search-submit i:hover', array(
				'color' => fleur_mikado_options()->getOptionValue('search_icon_disabled_color')
			));
		}
		if(fleur_mikado_options()->getOptionValue('search_icon_size') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-slide-window-top > i, .mkd-search-slide-header-bottom .mkd-search-submit i, .mkd-fullscreen-search-holder .mkd-search-submit', array(
				'font-size' => fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_icon_size')).'px'
			));
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_search_icon_styles');
}

if(!function_exists('fleur_mikado_search_close_icon_styles')) {

	function fleur_mikado_search_close_icon_styles() {

		if(fleur_mikado_options()->getOptionValue('search_close_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-slide-window-top .mkd-search-close i, .mkd-search-cover .mkd-search-close i, .mkd-fullscreen-search-close i', array(
				'color' => fleur_mikado_options()->getOptionValue('search_close_color')
			));
		}
		if(fleur_mikado_options()->getOptionValue('search_close_hover_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-slide-window-top .mkd-search-close i:hover, .mkd-search-cover .mkd-search-close i:hover, .mkd-fullscreen-search-close i:hover', array(
				'color' => fleur_mikado_options()->getOptionValue('search_close_hover_color')
			));
		}
		if(fleur_mikado_options()->getOptionValue('search_close_size') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-search-slide-window-top .mkd-search-close i, .mkd-search-cover .mkd-search-close i, .mkd-fullscreen-search-close i', array(
				'font-size' => fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('search_close_size')).'px'
			));
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_search_close_icon_styles');
}

if(!function_exists('fleur_mikado_fullscreen_search_styles')) {
	function fleur_mikado_fullscreen_search_styles() {
		$bg_image = fleur_mikado_options()->getOptionValue('fullscreen_search_background_image');
		$selector = '.mkd-search-fade .mkd-fullscreen-search-holder';
		$styles   = array();

		if(!$bg_image) {
			return;
		}

		$styles['background-image'] = 'url('.$bg_image.')';

		echo fleur_mikado_dynamic_css($selector, $styles);
	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_fullscreen_search_styles');
}

?>