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
 * @author volter9
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
		$copy = $array;
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
		$copy = $array;
		
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