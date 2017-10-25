<?php

if(!function_exists('fleur_mikado_loading_spinners')) {
	function fleur_mikado_loading_spinners($return = false) {
		global $fleur_options;

		$spinner_html = '';

		if(isset($fleur_options['smooth_pt_spinner_type'])) {

			switch($fleur_options['smooth_pt_spinner_type']) {
				case "fleur":
					$spinner_html = fleur_mikado_loading_spinner_fleur();
					break;
				case "pulse":
					$spinner_html = fleur_mikado_loading_spinner_pulse();
					break;
				case "double_pulse":
					$spinner_html = fleur_mikado_loading_spinner_double_pulse();
					break;
				case "cube":
					$spinner_html = fleur_mikado_loading_spinner_cube();
					break;
				case "rotating_cubes":
					$spinner_html = fleur_mikado_loading_spinner_rotating_cubes();
					break;
				case "stripes":
					$spinner_html = fleur_mikado_loading_spinner_stripes();
					break;
				case "wave":
					$spinner_html = fleur_mikado_loading_spinner_wave();
					break;
				case "two_rotating_circles":
					$spinner_html = fleur_mikado_loading_spinner_two_rotating_circles();
					break;
				case "five_rotating_circles":
					$spinner_html = fleur_mikado_loading_spinner_five_rotating_circles();
					break;
				case "atom":
					$spinner_html = fleur_mikado_loading_spinner_atom();
					break;
				case "clock":
					$spinner_html = fleur_mikado_loading_spinner_clock();
					break;
				case "mitosis":
					$spinner_html = fleur_mikado_loading_spinner_mitosis();
					break;
				case "lines":
					$spinner_html = fleur_mikado_loading_spinner_lines();
					break;
				case "fussion":
					$spinner_html = fleur_mikado_loading_spinner_fussion();
					break;
				case "wave_circles":
					$spinner_html = fleur_mikado_loading_spinner_wave_circles();
					break;
				case "pulse_circles":
					$spinner_html = fleur_mikado_loading_spinner_pulse_circles();
					break;
                default:
                    $spinner_html = fleur_mikado_loading_spinner_pulse();
                    break;
			}
		} else {
			$spinner_html = fleur_mikado_loading_spinner_cube();
		}

		if($return === true) {
			return $spinner_html;
		}

		echo wp_kses($spinner_html, array(
			'div' => array(
				'class' => true,
				'style' => true,
				'id'    => true
			),
			'img' => array(
				'class' => true,
				'src' => true,
				'alt' => true
			)
		));
	}
}

if(!function_exists('fleur_mikado_loading_spinner_fleur')) {
	function fleur_mikado_loading_spinner_fleur() {

		$html = '';
		$html .= '<div class="mkd-fleur-text">'.esc_attr(fleur_mikado_options()->getOptionValue('fleur_loader_logo')).'</div>';
		$html .= '<img class="mkd-fleur" src="'.MIKADO_ASSETS_ROOT.'/css/img/fleur.png" alt="'.esc_html__('Fleur', 'fleur').'"/>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_pulse')) {
	function fleur_mikado_loading_spinner_pulse() {

		$html = '';
		$html .= '<div class="pulse"></div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_double_pulse')) {
	function fleur_mikado_loading_spinner_double_pulse() {
		$html = '';
		$html .= '<div class="double_pulse">';
		$html .= '<div class="double-bounce1"></div>';
		$html .= '<div class="double-bounce2"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_cube')) {
	function fleur_mikado_loading_spinner_cube() {

		$html = '';
		$html .= '<div class="cube">';
		$html .= '<div class="cube-inner"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_rotating_cubes')) {
	function fleur_mikado_loading_spinner_rotating_cubes() {
		$html = '';
		$html .= '<div class="rotating_cubes">';
		$html .= '<div class="cube1"></div>';
		$html .= '<div class="cube2"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_stripes')) {
	function fleur_mikado_loading_spinner_stripes() {
		$html = '';
		$html .= '<div class="stripes">';
		$html .= '<div class="rect1"></div>';
		$html .= '<div class="rect2"></div>';
		$html .= '<div class="rect3"></div>';
		$html .= '<div class="rect4"></div>';
		$html .= '<div class="rect5"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_wave')) {
	function fleur_mikado_loading_spinner_wave() {
		$html = '';
		$html .= '<div class="wave">';
		$html .= '<div class="bounce1"></div>';
		$html .= '<div class="bounce2"></div>';
		$html .= '<div class="bounce3"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_two_rotating_circles')) {
	function fleur_mikado_loading_spinner_two_rotating_circles() {
		$html = '';
		$html .= '<div class="two_rotating_circles">';
		$html .= '<div class="dot1"></div>';
		$html .= '<div class="dot2"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_five_rotating_circles')) {
	function fleur_mikado_loading_spinner_five_rotating_circles() {
		$html = '';
		$html .= '<div class="five_rotating_circles">';
		$html .= '<div class="spinner-container container1">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '<div class="spinner-container container2">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '<div class="spinner-container container3">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_atom')) {
	function fleur_mikado_loading_spinner_atom() {
		$html = '';
		$html .= '<div class="atom">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_clock')) {
	function fleur_mikado_loading_spinner_clock() {
		$html = '';
		$html .= '<div class="clock">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_mitosis')) {
	function fleur_mikado_loading_spinner_mitosis() {
		$html = '';
		$html .= '<div class="mitosis">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_lines')) {
	function fleur_mikado_loading_spinner_lines() {
		$html = '';
		$html .= '<div class="lines">';
		$html .= '<div class="line1"></div>';
		$html .= '<div class="line2"></div>';
		$html .= '<div class="line3"></div>';
		$html .= '<div class="line4"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_fussion')) {
	function fleur_mikado_loading_spinner_fussion() {
		$html = '';
		$html .= '<div class="fussion">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_wave_circles')) {
	function fleur_mikado_loading_spinner_wave_circles() {
		$html = '';
		$html .= '<div class="wave_circles">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('fleur_mikado_loading_spinner_pulse_circles')) {
	function fleur_mikado_loading_spinner_pulse_circles() {
		$html = '';
		$html .= '<div class="pulse_circles">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';

		return $html;
	}
}
