<?php

abstract class Ezfc_conditional {
	static public function check_conditional($element_data, $value, $single_conditional_action = "", $return_row = false) {
		// object needed | throw new Exception(__("Element data is not an object.", "ezfc"));
		if (!is_object($element_data)) return;
		// check value | throw new Exception(__("Value is not a number.", "ezfc"));
		if (!is_numeric($value)) return;

		$return_row_value = 0;
		$return_value = true;

		if (!empty($element_data->conditional) && count($element_data->conditional) > 0) {
			foreach ($element_data->conditional as $i => $condition) {
				// check for single conditional action only
				if (!property_exists($condition, "action") || (!empty($single_conditional_action) && $condition->action != $single_conditional_action)) continue;

				$condition_is_true = true;

				$condition_merged = array(
					array(
						"operator" => $condition->operator,
						"value" => $condition->value
					)
				);

				// chain
				$n = 1;
				if (!empty($condition->operator_chain) && !empty($condition->value_chain)) {
					$condition_merged[$n] = array();

					// operator
					foreach ($condition->operator_chain as $operator_chain) {
						$condition_merged[$n]["operator"] = $operator_chain;
					}

					// value
					foreach ($condition->value_chain as $value_chain) {
						$condition_merged[$n]["value"] = $value_chain;
					}

					$n++;
				}

				foreach ($condition_merged as $condition) {
					if (!self::check_operator($value, $condition["value"], $condition["operator"])) {
						$condition_is_true = false;
						$return_value = false;
					}
				}

				if ($condition_is_true && $return_row) {
					return array(
						"condition" => true,
						"row"       => $i
					);
				}
			}
		}

		return $return_value;
	}

	// $v1 = input value, $v2 = element conditional value
	static public function check_operator($v1, $v2, $operator) {
		$do_action = false;

		switch ($operator) {
			case "gr": $do_action = $v1 > $v2;
			break;
			case "gre": $do_action = $v1 >= $v2;
			break;

			case "less": $do_action = $v1 < $v2;
			break;
			case "lesse": $do_action = $v1 <= $v2;
			break;

			case "equals": $do_action = $v1 == $v2;
			break;

			case "between":
				if (count($v2) < 2) {
					$do_action = false;
				}
				else {
					$do_action = ($v1 >= $v2[0] && $v1 <= $v2[1]);
				}
			break;

			case "not_between":
				if (count($v2) < 2) {
					$do_action = false;
				}
				else {
					$do_action = ($v1 < $v2[0] || $v1 > $v2[1]);
				}
			break;

			case "not":
				if (count($v2) < 2) {
					$do_action = $v1 != $v2;
				}
				else {
					$do_action = ($v1 < $v2[0] && $v1 > $v2[1]);
				}
			break;

			/** not supported
			case "hidden": $do_action = !el_object.is(":visible");
			break;

			case "visible": $do_action = el_object.is(":visible");
			break;
			**/

			case "mod0": $do_action = $v1 > 0 && ($v1 % $v2) == 0;
			break;
			case "mod1": $do_action = $v1 > 0 && ($v1 % $v2) != 0;
			break;

			case "bit_and": $do_action = $v1 & $v2;
			break;

			case "bit_or": $do_action = $v1 | $v2;
			break;

			case "empty":
				$do_action = $v1 === "";
			break;

			case "notempty":
				$do_action = $v1 !== "";
			break;

			case "in":
				$do_action = in_array($v1, $v2);
			break;

			case "not_in":
				$do_action = !in_array($v1, $v2);
			break;

			/** not supported
			case "once":
			break;
			**/

			default: $do_action = false;
			break;
		}

		return $do_action;
	}
}