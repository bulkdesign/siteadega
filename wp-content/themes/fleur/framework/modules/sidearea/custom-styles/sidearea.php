<?php

if(!function_exists('fleur_mikado_side_area_slide_from_right_type_style')) {

	function fleur_mikado_side_area_slide_from_right_type_style() {

		if(fleur_mikado_options()->getOptionValue('side_area_type') == 'side-menu-slide-from-right') {

			if(fleur_mikado_options()->getOptionValue('side_area_width') !== '' && fleur_mikado_options()->getOptionValue('side_area_width') >= 30) {
				echo fleur_mikado_dynamic_css('.mkd-side-menu-slide-from-right .mkd-side-menu', array(
					'right' => '-'.fleur_mikado_options()->getOptionValue('side_area_width').'%',
					'width' => fleur_mikado_options()->getOptionValue('side_area_width').'%'
				));
			}

			if(fleur_mikado_options()->getOptionValue('side_area_content_overlay_color') !== '') {

				echo fleur_mikado_dynamic_css('.mkd-side-menu-slide-from-right .mkd-wrapper .mkd-cover', array(
					'background-color' => fleur_mikado_options()->getOptionValue('side_area_content_overlay_color')
				));

			}
			if(fleur_mikado_options()->getOptionValue('side_area_content_overlay_opacity') !== '') {

				echo fleur_mikado_dynamic_css('.mkd-side-menu-slide-from-right.mkd-right-side-menu-opened .mkd-wrapper .mkd-cover', array(
					'opacity' => fleur_mikado_options()->getOptionValue('side_area_content_overlay_opacity')
				));

			}
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_side_area_slide_from_right_type_style');

}

if(!function_exists('fleur_mikado_side_area_icon_color_styles')) {

	function fleur_mikado_side_area_icon_color_styles() {

		if(fleur_mikado_options()->getOptionValue('side_area_icon_font_size') !== '') {

			echo fleur_mikado_dynamic_css('a.mkd-side-menu-button-opener', array(
				'font-size' => fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_icon_font_size')).'px'
			));

			if(fleur_mikado_options()->getOptionValue('side_area_icon_font_size') > 30) {
				echo '@media only screen and (max-width: 480px) {
						a.mkd-side-menu-button-opener {
						font-size: 30px;
						}
					}';
			}

		}

		if(fleur_mikado_options()->getOptionValue('side_area_icon_color') !== '') {

			echo fleur_mikado_dynamic_css('a.mkd-side-menu-button-opener', array(
				'color' => fleur_mikado_options()->getOptionValue('side_area_icon_color')
			));

		}
		if(fleur_mikado_options()->getOptionValue('side_area_icon_hover_color') !== '') {

			echo fleur_mikado_dynamic_css('a.mkd-side-menu-button-opener:hover', array(
				'color' => fleur_mikado_options()->getOptionValue('side_area_icon_hover_color')
			));

		}
		if(fleur_mikado_options()->getOptionValue('side_area_light_icon_color') !== '') {

			echo fleur_mikado_dynamic_css('.mkd-light-header .mkd-page-header > div:not(.mkd-sticky-header) .mkd-side-menu-button-opener,
			.mkd-light-header.mkd-header-style-on-scroll .mkd-page-header .mkd-side-menu-button-opener,
			.mkd-light-header .mkd-top-bar .mkd-side-menu-button-opener', array(
				'color' => fleur_mikado_options()->getOptionValue('side_area_light_icon_color').' !important'
			));

		}
		if(fleur_mikado_options()->getOptionValue('side_area_light_icon_hover_color') !== '') {

			echo fleur_mikado_dynamic_css('.mkd-light-header .mkd-page-header > div:not(.mkd-sticky-header) .mkd-side-menu-button-opener:hover,
			.mkd-light-header.mkd-header-style-on-scroll .mkd-page-header .mkd-side-menu-button-opener:hover,
			.mkd-light-header .mkd-top-bar .mkd-side-menu-button-opener:hover', array(
				'color' => fleur_mikado_options()->getOptionValue('side_area_light_icon_hover_color').' !important'
			));

		}
		if(fleur_mikado_options()->getOptionValue('side_area_dark_icon_color') !== '') {

			echo fleur_mikado_dynamic_css('.mkd-dark-header .mkd-page-header > div:not(.mkd-sticky-header) .mkd-side-menu-button-opener,
			.mkd-dark-header.mkd-header-style-on-scroll .mkd-page-header .mkd-side-menu-button-opener,
			.mkd-dark-header .mkd-top-bar .mkd-side-menu-button-opener', array(
				'color' => fleur_mikado_options()->getOptionValue('side_area_dark_icon_color').' !important'
			));

		}
		if(fleur_mikado_options()->getOptionValue('side_area_dark_icon_hover_color') !== '') {

			echo fleur_mikado_dynamic_css('.mkd-dark-header .mkd-page-header > div:not(.mkd-sticky-header) .mkd-side-menu-button-opener:hover,
			.mkd-dark-header.mkd-header-style-on-scroll .mkd-page-header .mkd-side-menu-button-opener:hover,
			.mkd-dark-header .mkd-top-bar .mkd-side-menu-button-opener:hover', array(
				'color' => fleur_mikado_options()->getOptionValue('side_area_dark_icon_hover_color').' !important'
			));

		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_side_area_icon_color_styles');

}

if(!function_exists('fleur_mikado_side_area_icon_spacing_styles')) {

	function fleur_mikado_side_area_icon_spacing_styles() {
		$icon_spacing = array();

		if(fleur_mikado_options()->getOptionValue('side_area_icon_padding_left') !== '') {
			$icon_spacing['padding-left'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_icon_padding_left')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_icon_padding_right') !== '') {
			$icon_spacing['padding-right'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_icon_padding_right')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_icon_margin_left') !== '') {
			$icon_spacing['margin-left'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_icon_margin_left')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_icon_margin_right') !== '') {
			$icon_spacing['margin-right'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_icon_margin_right')).'px';
		}

		if(!empty($icon_spacing)) {

			echo fleur_mikado_dynamic_css('a.mkd-side-menu-button-opener', $icon_spacing);

		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_side_area_icon_spacing_styles');
}

if(!function_exists('fleur_mikado_side_area_icon_border_styles')) {

	function fleur_mikado_side_area_icon_border_styles() {
		if(fleur_mikado_options()->getOptionValue('side_area_icon_border_yesno') == 'yes') {

			$side_area_icon_border = array();

			if(fleur_mikado_options()->getOptionValue('side_area_icon_border_color') !== '') {
				$side_area_icon_border['border-color'] = fleur_mikado_options()->getOptionValue('side_area_icon_border_color');
			}

			if(fleur_mikado_options()->getOptionValue('side_area_icon_border_width') !== '') {
				$side_area_icon_border['border-width'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_icon_border_width')).'px';
			} else {
				$side_area_icon_border['border-width'] = '1px';
			}

			if(fleur_mikado_options()->getOptionValue('side_area_icon_border_radius') !== '') {
				$side_area_icon_border['border-radius'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_icon_border_radius')).'px';
			}

			if(fleur_mikado_options()->getOptionValue('side_area_icon_border_style') !== '') {
				$side_area_icon_border['border-style'] = fleur_mikado_options()->getOptionValue('side_area_icon_border_style');
			} else {
				$side_area_icon_border['border-style'] = 'solid';
			}

			if(!empty($side_area_icon_border)) {
				$side_area_icon_border['-webkit-transition'] = 'all 0.15s ease-out';
				$side_area_icon_border['transition']         = 'all 0.15s ease-out';
				echo fleur_mikado_dynamic_css('a.mkd-side-menu-button-opener', $side_area_icon_border);
			}

			if(fleur_mikado_options()->getOptionValue('side_area_icon_border_hover_color') !== '') {
				$side_area_icon_border_hover['border-color'] = fleur_mikado_options()->getOptionValue('side_area_icon_border_hover_color');
				echo fleur_mikado_dynamic_css('a.mkd-side-menu-button-opener:hover', $side_area_icon_border_hover);
			}
		}
	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_side_area_icon_border_styles');

}

if(!function_exists('fleur_mikado_side_area_alignment')) {

	function fleur_mikado_side_area_alignment() {

		if(fleur_mikado_options()->getOptionValue('side_area_aligment')) {

			echo fleur_mikado_dynamic_css('.mkd-side-menu-slide-from-right .mkd-side-menu, .mkd-side-menu-slide-with-content .mkd-side-menu, .mkd-side-area-uncovered-from-content .mkd-side-menu', array(
				'text-align' => fleur_mikado_options()->getOptionValue('side_area_aligment')
			));

		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_side_area_alignment');

}

if(!function_exists('fleur_mikado_side_area_styles')) {

	function fleur_mikado_side_area_styles() {

		$side_area_styles = array();

		if(fleur_mikado_options()->getOptionValue('side_area_background_color') !== '') {
			$side_area_styles['background-color'] = fleur_mikado_options()->getOptionValue('side_area_background_color');
		}

		if(fleur_mikado_options()->getOptionValue('side_area_padding_top') !== '') {
			$side_area_styles['padding-top'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_padding_top')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_padding_right') !== '') {
			$side_area_styles['padding-right'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_padding_right')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_padding_bottom') !== '') {
			$side_area_styles['padding-bottom'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_padding_bottom')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_padding_left') !== '') {
			$side_area_styles['padding-left'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_padding_left')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_bakground_image') !== '') {
			$side_area_styles['background-image'] = 'url('.fleur_mikado_options()->getOptionValue('side_area_bakground_image').')';
			$side_area_styles['background-size']  = 'cover';
			$side_area_styles['background-position']  = 'center center';
		}

		if(!empty($side_area_styles)) {
			echo fleur_mikado_dynamic_css('.mkd-side-menu', $side_area_styles);
		}

		if(fleur_mikado_options()->getOptionValue('side_area_close_icon') == 'dark') {
			echo fleur_mikado_dynamic_css('.mkd-side-menu a.mkd-close-side-menu span, .mkd-side-menu a.mkd-close-side-menu i', array(
				'color' => '#000000'
			));
		}

		if(fleur_mikado_options()->getOptionValue('side_area_close_icon_size') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-side-menu a.mkd-close-side-menu', array(
				'height'      => fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_close_icon_size')).'px',
				'width'       => fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_close_icon_size')).'px',
				'line-height' => fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_close_icon_size')).'px',
				'padding'     => 0,
			));
			echo fleur_mikado_dynamic_css('.mkd-side-menu a.mkd-close-side-menu span, .mkd-side-menu a.mkd-close-side-menu i', array(
				'font-size'   => fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_close_icon_size')).'px',
				'height'      => fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_close_icon_size')).'px',
				'width'       => fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_close_icon_size')).'px',
				'line-height' => fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_close_icon_size')).'px',
			));
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_side_area_styles');

}

if(!function_exists('fleur_mikado_side_area_title_styles')) {

	function fleur_mikado_side_area_title_styles() {

		$title_styles = array();

		if(fleur_mikado_options()->getOptionValue('side_area_title_color') !== '') {
			$title_styles['color'] = fleur_mikado_options()->getOptionValue('side_area_title_color');
		}

		if(fleur_mikado_options()->getOptionValue('side_area_title_fontsize') !== '') {
			$title_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_title_fontsize')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_title_lineheight') !== '') {
			$title_styles['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_title_lineheight')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_title_texttransform') !== '') {
			$title_styles['text-transform'] = fleur_mikado_options()->getOptionValue('side_area_title_texttransform');
		}

		if(fleur_mikado_options()->getOptionValue('side_area_title_google_fonts') !== '-1') {
			$title_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('side_area_title_google_fonts')).', sans-serif';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_title_fontstyle') !== '') {
			$title_styles['font-style'] = fleur_mikado_options()->getOptionValue('side_area_title_fontstyle');
		}

		if(fleur_mikado_options()->getOptionValue('side_area_title_fontweight') !== '') {
			$title_styles['font-weight'] = fleur_mikado_options()->getOptionValue('side_area_title_fontweight');
		}

		if(fleur_mikado_options()->getOptionValue('side_area_title_letterspacing') !== '') {
			$title_styles['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_title_letterspacing')).'px';
		}

		if(!empty($title_styles)) {

			echo fleur_mikado_dynamic_css('.mkd-sidearea-widget-title', $title_styles);

		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_side_area_title_styles');

}

if(!function_exists('fleur_mikado_side_area_text_styles')) {

	function fleur_mikado_side_area_text_styles() {
		$text_styles = array();

		if(fleur_mikado_options()->getOptionValue('side_area_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('side_area_text_google_fonts')).', sans-serif';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_text_fontsize') !== '') {
			$text_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_text_fontsize')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_text_lineheight') !== '') {
			$text_styles['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_text_lineheight')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('side_area_text_letterspacing')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('side_area_text_fontweight') !== '') {
			$text_styles['font-weight'] = fleur_mikado_options()->getOptionValue('side_area_text_fontweight');
		}

		if(fleur_mikado_options()->getOptionValue('side_area_text_fontstyle') !== '') {
			$text_styles['font-style'] = fleur_mikado_options()->getOptionValue('side_area_text_fontstyle');
		}

		if(fleur_mikado_options()->getOptionValue('side_area_text_texttransform') !== '') {
			$text_styles['text-transform'] = fleur_mikado_options()->getOptionValue('side_area_text_texttransform');
		}

		if(fleur_mikado_options()->getOptionValue('side_area_text_color') !== '') {
			$text_styles['color'] = fleur_mikado_options()->getOptionValue('side_area_text_color');
		}

		if(!empty($text_styles)) {

			echo fleur_mikado_dynamic_css('.mkd-side-menu .widget, .mkd-side-menu .widget.widget_search form, .mkd-side-menu .widget.widget_search form input[type="text"], .mkd-side-menu .widget.widget_search form input[type="submit"], .mkd-side-menu .widget h6, .mkd-side-menu .widget h6 a, .mkd-side-menu .widget p, .mkd-side-menu .widget li a, .mkd-side-menu .widget.widget_rss li a.rsswidget, .mkd-side-menu #wp-calendar caption,.mkd-side-menu .widget li, .mkd-side-menu h3, .mkd-side-menu .widget.widget_archive select, .mkd-side-menu .widget.widget_categories select, .mkd-side-menu .widget.widget_text select, .mkd-side-menu .widget.widget_search form input[type="submit"], .mkd-side-menu #wp-calendar th, .mkd-side-menu #wp-calendar td, .mkd-side-menu .q_social_icon_holder i.simple_social', $text_styles);

		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_side_area_text_styles');

}

if(!function_exists('fleur_mikado_side_area_link_styles')) {

	function fleur_mikado_side_area_link_styles() {
		$link_styles = array();

		if(fleur_mikado_options()->getOptionValue('sidearea_link_font_family') !== '-1') {
			$link_styles['font-family'] = fleur_mikado_get_formatted_font_family(fleur_mikado_options()->getOptionValue('sidearea_link_font_family')).',sans-serif';
		}

		if(fleur_mikado_options()->getOptionValue('sidearea_link_font_size') !== '') {
			$link_styles['font-size'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('sidearea_link_font_size')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('sidearea_link_line_height') !== '') {
			$link_styles['line-height'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('sidearea_link_line_height')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('sidearea_link_letter_spacing') !== '') {
			$link_styles['letter-spacing'] = fleur_mikado_filter_px(fleur_mikado_options()->getOptionValue('sidearea_link_letter_spacing')).'px';
		}

		if(fleur_mikado_options()->getOptionValue('sidearea_link_font_weight') !== '') {
			$link_styles['font-weight'] = fleur_mikado_options()->getOptionValue('sidearea_link_font_weight');
		}

		if(fleur_mikado_options()->getOptionValue('sidearea_link_font_style') !== '') {
			$link_styles['font-style'] = fleur_mikado_options()->getOptionValue('sidearea_link_font_style');
		}

		if(fleur_mikado_options()->getOptionValue('sidearea_link_text_transform') !== '') {
			$link_styles['text-transform'] = fleur_mikado_options()->getOptionValue('sidearea_link_text_transform');
		}

		if(fleur_mikado_options()->getOptionValue('sidearea_link_color') !== '') {
			$link_styles['color'] = fleur_mikado_options()->getOptionValue('sidearea_link_color');
		}

		if(!empty($link_styles)) {

			echo fleur_mikado_dynamic_css('.mkd-side-menu .widget li a, .mkd-side-menu .widget a:not(.qbutton)', $link_styles);

		}

		if(fleur_mikado_options()->getOptionValue('sidearea_link_hover_color') !== '') {
			echo fleur_mikado_dynamic_css('.mkd-side-menu .widget a:hover, .mkd-side-menu .widget li:hover, .mkd-side-menu .widget li:hover>a', array(
				'color' => fleur_mikado_options()->getOptionValue('sidearea_link_hover_color')
			));
		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_side_area_link_styles');

}

if(!function_exists('fleur_mikado_side_area_border_styles')) {

	function fleur_mikado_side_area_border_styles() {

		if(fleur_mikado_options()->getOptionValue('side_area_enable_bottom_border') == 'yes') {

			if(fleur_mikado_options()->getOptionValue('side_area_bottom_border_color') !== '') {

				echo fleur_mikado_dynamic_css('.mkd-side-menu .widget', array(
					'border-bottom:'  => '1px solid '.fleur_mikado_options()->getOptionValue('side_area_bottom_border_color'),
					'margin-bottom:'  => '10px',
					'padding-bottom:' => '10px',
				));

			}

		}

	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_side_area_border_styles');

}