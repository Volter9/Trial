<?php

/**
 * Data validation validators
 */

return [
	'required' => function ($value) {
		return !!$value;
	},
	
	'length' => function ($value, $key, $min, $max) {
		$min = $min === '' ? 0 : (int)$min;
		$max = $max === null ? PHP_INT_MAX : (int)$max;
		$length = strlen($value);
		
		return $length <= $max && $length >= $min; 
	},
	
	'alpha_dash' => function ($value) {
		return (bool)preg_match('/^[\w\d\-\_]+$/i', $value);
	}
];