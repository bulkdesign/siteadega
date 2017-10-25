<?php

if(!function_exists('fleur_mikado_archive_bg_color_styles')) {
	/**
	 * Outputs background color styles for blog archive pages
	 */
	function fleur_mikado_archive_bg_color_styles() {
		$blog_archive_background_color = fleur_mikado_options()->getOptionValue('blog_archive_background_color');

		if($blog_archive_background_color !== '') {
			$archive_bg_color_styles['background-color'] = $blog_archive_background_color;

			echo fleur_mikado_dynamic_css('body.archive:not(.woocommerce) .mkd-wrapper-inner, body.archive:not(.woocommerce) .mkd-content', $archive_bg_color_styles);
		}
	}

	add_action('fleur_mikado_style_dynamic', 'fleur_mikado_archive_bg_color_styles');
}
