<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	if (!function_exists('array_merge_recursive2')) {
		function array_merge_recursive2($array1, $array2)
		{
			$arrays = func_get_args();
			$narrays = count($arrays);

			// check arguments
			// comment out if more performance is necessary (in this case the foreach loop will trigger a warning if the argument is not an array)
			for ($i = 0; $i < $narrays; $i++) {
				if (!is_array($arrays[$i])) {
					// also array_merge_recursive returns nothing in this case
					trigger_error('Argument #' . ($i + 1) . ' is not an array - trying to merge array with scalar! Returning null!', E_USER_WARNING);

					return;
				}
			}

			// the first array is in the output set in every case
			$ret = $arrays[0];

			// merege $ret with the remaining arrays
			for ($i = 1; $i < $narrays; $i++) {
				foreach ($arrays[$i] as $key => $value) {
					if (((string)$key) === ((string)intval($key))) { // integer or string as integer key - append
						$ret[] = $value;
					} else { // string key - megre
						if (is_array($value) && isset($ret[$key])) {
							// if $ret[$key] is not an array you try to merge an scalar value with an array - the result is not defined (incompatible arrays)
							// in this case the call will trigger an E_USER_WARNING and the $ret[$key] will be null.
							$ret[$key] = array_merge_recursive2($ret[$key], $value);
						} else {
							$ret[$key] = $value;
						}
					}
				}
			}

			return $ret;
		}
	}

	if (!function_exists('unique_multidim_array')) {
		function unique_multidim_array($array, $key)
		{
			$temp_array = array();
			$i = 0;
			$key_array = array();

			foreach ($array as $val) {
				if (!in_array($val[$key], $key_array)) {
					$key_array[$i] = $val[$key];
					$temp_array[$i] = $val;
				}
				$i++;
			}

			return $temp_array;
		}
	}