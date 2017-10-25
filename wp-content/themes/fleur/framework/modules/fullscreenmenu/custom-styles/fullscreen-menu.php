<?php

if(!function_exists('fleur_mikado_fullscreen_menu_general_styles')) {

	function fleur_mikado_fullscreen_menu_general_styles() {
		$fullscreen_menu_background_color = '';
		if(fleur_mikado_options()->getOptionValue('fullscreen_alignment') !== '') {
			echo fleur_mikado_dynamic_css('nav.mkd-fullscreen-menu ul li, .mkd-fullscreen-above-menu-widget-holder, .mkd-fullscreen-below-menu-widget-holder, .mkd-fullscreen-logo-wrapper', array(
				'text-align' => fleur_mikado_options()->getOptionValue('fullscreen_alignment')
			));
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_background_color') !== '') {
			$fullscreen_menu_background_color = fleur_mikado_hex2rgb(fleur_mikado_options()->getOptionValue('fullscreen_menu_background_color'));
			if(fleur_mikado_options()->getOptionValue('fullscreen_menu_background_transparency') !== '') {
				$fullscreen_menu_background_transparency = fleur_mikado_options()->getOptionValue('fullscreen_menu_background_transparency');
			} else {
				$fullscreen_menu_background_transparency = 0.9;
			}
		}

		if($fullscreen_menu_background_color !== '') {
			echo fleur_mikado_dynamic_css('.mkd-fullscreen-menu-holder', array(
				'background-color' => 'rgba('.$fullscreen_menu_background_color[0].','.$fullscreen_menu_background_color[1].','.$fullscreen_menu_background_color[2].','.$fullscreen_menu_background_transparency.')'
			));
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_background_image') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-fullscreen-menu-holder', array(
				'background-image'    => 'url('.fleur_mikado_options()->getOptionValue('fullscreen_menu_background_image').')',
				'background-position' => 'center 0',
				'background-repeat'   => 'no-repeat'
			));
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_pattern_image') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-fullscreen-menu-holder', array(
				'background-image'    => 'url('.fleur_mikado_options()->getOptionValue('fullscreen_menu_pattern_image').')',
				'background-repeat'   => 'repeat',
				'background-position' => '0 0'
			));
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_fullscreen_menu_general_styles');

}

if(!function_exists('fleur_mikado_fullscreen_menu_first_level_style')) {

	function fleur_mikado_fullscreen_menu_first_level_style() {

		$first_menu_style = array();

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_color') !== '') {
			$first_menu_style['color'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_color');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_google_fonts') !== '-1') {
			$first_menu_style['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('fullscreen_menu_google_fonts')).',sans-serif';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_fontsize') !== '') {
			$first_menu_style['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_fontsize')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_lineheight') !== '') {
			$first_menu_style['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_lineheight')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_fontstyle') !== '') {
			$first_menu_style['font-style'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_fontstyle');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_fontweight') !== '') {
			$first_menu_style['font-weight'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_fontweight');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_letterspacing') !== '') {
			$first_menu_style['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_letterspacing')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_texttransform') !== '') {
			$first_menu_style['text-transform'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_texttransform');
		}

		if(!empty($first_menu_style)) {
			echo fleur_mikado_dynamic_css('nav.mkd-fullscreen-menu > ul > li > a, nav.mkd-fullscreen-menu > ul > li > h6', $first_menu_style);
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-fullscreen-menu-opener.opened .mkd-line:after, .mkd-fullscreen-menu-opener.opened .mkd-line:before', array(
				'background-color' => fleur_mikado_options()->getOptionValue('fullscreen_menu_color')
			));
		}

		$first_menu_hover_style = array();

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_hover_color') !== '') {
			$first_menu_hover_style['color'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_hover_color');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_hover_background_color') !== '') {
			$first_menu_hover_style['background-color'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_hover_background_color');
		}

		if(!empty($first_menu_hover_style)) {
			echo fleur_mikado_dynamic_css('nav.mkd-fullscreen-menu > ul > li > a:hover, nav.mkd-fullscreen-menu > ul > li > h6:hover', $first_menu_hover_style);
		}

		$first_menu_active_style = array();

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_active_color') !== '') {
			$first_menu_active_style['color'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_active_color');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_active_background_color') !== '') {
			$first_menu_active_style['background-color'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_active_background_color');
		}

		if(!empty($first_menu_active_style)) {
			echo fleur_mikado_dynamic_css('nav.mkd-fullscreen-menu > ul > li > a.current', $first_menu_active_style);
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_fullscreen_menu_first_level_style');

}

if(!function_exists('fleur_mikado_fullscreen_menu_second_level_style')) {

	function fleur_mikado_fullscreen_menu_second_level_style() {
		$second_menu_style = array();
		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_color_2nd') !== '') {
			$second_menu_style['color'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_color_2nd');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_google_fonts_2nd') !== '-1') {
			$second_menu_style['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('fullscreen_menu_google_fonts_2nd')).',sans-serif';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_fontsize_2nd') !== '') {
			$second_menu_style['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_fontsize_2nd')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_lineheight_2nd') !== '') {
			$second_menu_style['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_lineheight_2nd')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_fontstyle_2nd') !== '') {
			$second_menu_style['font-style'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_fontstyle_2nd');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_fontweight_2nd') !== '') {
			$second_menu_style['font-weight'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_fontweight_2nd');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_letterspacing_2nd') !== '') {
			$second_menu_style['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_letterspacing_2nd')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_texttransform_2nd') !== '') {
			$second_menu_style['text-transform'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_texttransform_2nd');
		}

		if(!empty($second_menu_style)) {
			echo fleur_mikado_dynamic_css('nav.mkd-fullscreen-menu > ul > li > ul > li > a, nav.mkd-fullscreen-menu > ul > li > ul > li > h6', $second_menu_style);
		}

		$second_menu_hover_style = array();

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_hover_color_2nd') !== '') {
			$second_menu_hover_style['color'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_hover_color_2nd');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_hover_background_color_2nd') !== '') {
			$second_menu_hover_style['background-color'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_hover_background_color_2nd');
		}

		if(!empty($second_menu_hover_style)) {
			echo fleur_mikado_dynamic_css('nav.mkd-fullscreen-menu > ul > li > ul > li > a:hover, nav.mkd-fullscreen-menu > ul > li > ul > li > h6:hover', $second_menu_hover_style);
		}
	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_fullscreen_menu_second_level_style');

}

if(!function_exists('fleur_mikado_fullscreen_menu_third_level_style')) {

	function fleur_mikado_fullscreen_menu_third_level_style() {
		$third_menu_style = array();
		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_color_3rd') !== '') {
			$third_menu_style['color'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_color_3rd');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_google_fonts_3rd') !== '-1') {
			$third_menu_style['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('fullscreen_menu_google_fonts_3rd')).',sans-serif';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_fontsize_3rd') !== '') {
			$third_menu_style['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_fontsize_3rd')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_lineheight_3rd') !== '') {
			$third_menu_style['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_lineheight_3rd')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_fontstyle_3rd') !== '') {
			$third_menu_style['font-style'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_fontstyle_3rd');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_fontweight_3rd') !== '') {
			$third_menu_style['font-weight'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_fontweight_3rd');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_letterspacing_3rd') !== '') {
			$third_menu_style['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_letterspacing_3rd')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_texttransform_3rd') !== '') {
			$third_menu_style['text-transform'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_texttransform_3rd');
		}

		if(!empty($third_menu_style)) {
			echo fleur_mikado_dynamic_css('nav.mkd-fullscreen-menu ul li ul li ul li a', $third_menu_style);
		}

		$third_menu_hover_style = array();

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_hover_color_3rd') !== '') {
			$third_menu_hover_style['color'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_hover_color_3rd');
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_hover_background_color_3rd') !== '') {
			$third_menu_hover_style['background-color'] = fleur_mikado_options()->getOptionValue('fullscreen_menu_hover_background_color_3rd');
		}

		if(!empty($third_menu_hover_style)) {
			echo fleur_mikado_dynamic_css('nav.mkd-fullscreen-menu ul li ul li ul li a:hover', $third_menu_hover_style);
		}
	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_fullscreen_menu_third_level_style');

}

if(!function_exists('fleur_mikado_fullscreen_menu_icon_styles')) {

	function fleur_mikado_fullscreen_menu_icon_styles() {

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_color') !== '') {

			echo fleur_mikado_dynamic_css('.mkd-fullscreen-menu-opener', array(
				'color' => fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_color')
			));

		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_hover_color') !== '') {

			echo fleur_mikado_dynamic_css('.mkd-fullscreen-menu-opener:hover', array(
				'color' => fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_hover_color')
			));

		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_light_icon_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-light-header .mkd-page-header > div:not(.mkd-sticky-header) .mkd-fullscreen-menu-opener:not(.opened),
			.mkd-light-header.mkd-header-style-on-scroll .mkd-page-header .mkd-fullscreen-menu-opener:not(.opened),
			.mkd-light-header .mkd-top-bar .mkd-fullscreen-menu-opener:not(.opened)', array(
				'color' => fleur_mikado_options()->getOptionValue('fullscreen_menu_light_icon_color').' !important'
			));

		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_light_icon_hover_color') !== '') {

			echo fleur_mikado_dynamic_css('.mkd-light-header .mkd-page-header > div:not(.mkd-sticky-header) .mkd-fullscreen-menu-opener:not(.opened):hover,
			.mkd-light-header.mkd-header-style-on-scroll .mkd-page-header .mkd-fullscreen-menu-opener:not(.opened):hover,
			.mkd-light-header .mkd-top-bar .mkd-fullscreen-menu-opener:not(.opened):hover', array(
				'color' => fleur_mikado_options()->getOptionValue('fullscreen_menu_light_icon_hover_color').' !important'
			));

		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_dark_icon_color') !== '') {

			echo fleur_mikado_dynamic_css('.mkd-dark-header .mkd-page-header > div:not(.mkd-sticky-header) .mkd-fullscreen-menu-opener:not(.opened),
			.mkd-dark-header.mkd-header-style-on-scroll .mkd-page-header .mkd-fullscreen-menu-opener:not(.opened),
			.mkd-dark-header .mkd-top-bar .mkd-fullscreen-menu-opener:not(.opened)', array(
				'color' => fleur_mikado_options()->getOptionValue('fullscreen_menu_dark_icon_color').' !important'
			));

		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_dark_icon_hover_color') !== '') {

			echo fleur_mikado_dynamic_css('.mkd-dark-header .mkd-page-header > div:not(.mkd-sticky-header) .mkd-fullscreen-menu-opener:not(.opened):hover ,
			.mkd-dark-header.mkd-header-style-on-scroll .mkd-page-header .mkd-fullscreen-menu-opener:not(.opened):hover,
			.mkd-dark-header .mkd-top-bar .mkd-fullscreen-menu-opener:not(.opened):hover', array(
				'color' => fleur_mikado_options()->getOptionValue('fullscreen_menu_dark_icon_hover_color').' !important'
			));

		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_background_color') !== '') {

			echo fleur_mikado_dynamic_css('.mkd-fullscreen-menu-opener', array(
				'-webkit-backface-visibility' => 'hidden',
				'display'                     => 'inline-block'
			));
			echo fleur_mikado_dynamic_css('.mkd-fullscreen-menu-opener.normal', array(
				'padding' => '10px 15px',
			));
			echo fleur_mikado_dynamic_css('.mkd-fullscreen-menu-opener.medium', array(
				'padding' => '10px 13px',
			));
			echo fleur_mikado_dynamic_css('.mkd-fullscreen-menu-opener.large', array(
				'padding' => '15px',
			));
			echo fleur_mikado_dynamic_css('.mkd-fullscreen-menu-opener:not(.opened)', array(
				'background-color' => fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_background_color')
			));

		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_background_hover_color') !== '') {

			fleur_mikado_dynamic_css('.mkd-fullscreen-menu-opener.normal:not(.opened):hover, .mkd-fullscreen-menu-opener.medium:not(.opened):hover, .mkd-fullscreen-menu-opener.large:not(.opened):hover', array(
				'background-color' => fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_background_hover_color')
			));

		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_fullscreen_menu_icon_styles');

}

if(!function_exists('fleur_mikado_fullscreen_menu_icon_spacing')) {

	function fleur_mikado_fullscreen_menu_icon_spacing() {

		$fullscreen_menu_icon_spacing = array();

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_padding_left') !== '') {
			$fullscreen_menu_icon_spacing['padding-left'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_padding_left')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_padding_right') !== '') {
			$fullscreen_menu_icon_spacing['padding-right'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_padding_right')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_margin_left') !== '') {
			$fullscreen_menu_icon_spacing['margin-left'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_margin_left')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_margin_right') !== '') {
			$fullscreen_menu_icon_spacing['margin-right'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('fullscreen_menu_icon_margin_right')).'px';
		}

		if(!empty($fullscreen_menu_icon_spacing)) {
			echo fleur_mikado_dynamic_css('a.mkd-fullscreen-menu-opener', $fullscreen_menu_icon_spacing);
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_fullscreen_menu_icon_spacing');

}