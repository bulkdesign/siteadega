<?php

if(!function_exists('fleur_mikado_is_responsive_on')) {
	/**
	 * Checks whether responsive mode is enabled in theme options
	 * @return bool
	 */
	function fleur_mikado_is_responsive_on() {
		return fleur_mikado_options()->getOptionValue('responsiveness') !== 'no';
	}
}