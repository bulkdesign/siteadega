<?php

if(!function_exists('fleur_mikado_register_widgets')) {

	function fleur_mikado_register_widgets() {

		$widgets = array(
			'FleurMikadoLatestPosts',
			'FleurMikadoSearchOpener',
			'FleurMikadoSideAreaOpener',
			'FleurMikadoStickySidebar',
			'FleurMikadoSocialIconWidget',
			'FleurMikadoSeparatorWidget',
			'FleurMikadoCallToActionButton',
			'FleurMikadoHtmlWidget',
			'FleurMikadoPostCategories'
		);

		foreach($widgets as $widget) {
			register_widget($widget);
		}
	}
}

add_action('widgets_init', 'fleur_mikado_register_widgets');