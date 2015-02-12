<?php namespace Trial\Helpers;

/**
 * Dot notation helper
 * 
 * This class allows to get and set values in multidimensional array
 * by specifying dot notation.
 * 
 * This class could be extended to change delimeter for multidimensional
 * arrays (i.e. you prefer more ':' than '.' as a delimeter).
 * 
 * @package Trial
 */

class DotNotation {
	
	/**
	 * @var string Delimeter of notation
	 */
	static protected $delimeter = '.';
	
	/**
	 * Get a value from multidimensional array
	 * 
	 * @param array $array
	 * @param string $key
	 * @return mixed
	 */
	static public function get (array $array, $key) {
		if (
			strpos($key, static::$delimeter) === false &&
			isset($array[$key])
		) {
			return $array[$key];
		}
		
		$reference = static::fetch($array, $key);
		$result = $reference;
		
		return $result;
	}
	
	/**
	 * Set a value
	 * 
	 * @param array $array
	 * @param string $key
	 * @param mixed $value
	 */
	static public function set (array &$array, $key, $value) {
		if (strpos($key, static::$delimeter) === false) {
			$array[$key] = $value;
			
			return;
		}
		
		static::fetch($array, $key, $value);
	}
	
	/**
	 * Fetch a key
	 * 
	 * @access protected
	 * @param array $array
	 * @param string $key
	 * @param mixed $value
	 * @return mixed
	 */
	static protected function fetch (array &$array, $key, $value = null) {
		$keys = explode(static::$delimeter, $key);
		
		/*
		// I wish I could put this while in other method,
		// but references are unpredictable...
		*/
		while (is_array($array) && $key !== null) {
			$key = array_shift($keys);
			
			if ($value !== null) {
				static::handleEmptyArray($array, $key);
			}
			
			if ($key !== null) {
				$array = &$array[$key];
			}
		} 
		
		if ($value !== null) {
			$array = $value;
		}
		
		return $array;
	}
	
	/**
	 * Handle empty array for setter
	 * 
	 * @access protected
	 * @param array $array
	 * @param string $key
	 */
	static protected function handleEmptyArray (array &$array, $key) {
		if (!isset($array[$key])) {
			$array[$key] = [];
		}
	}
	
}