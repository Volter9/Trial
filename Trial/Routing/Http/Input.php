<?php namespace Trial\Routing\Http;

use Trial\Helpers\DotNotation;

/**
 * @todo make it unit testable
 */

class Input {
	
	private $arrays;
	private $headers;
	
	public function __construct (array $arrays, array $headers) {
		$this->arrays = $arrays;
		$this->headers = $headers;
	}
	
	public function getHeader ($header = null) {
		if ($header === null) {
			return $this->headers;
		}
		
		return DotNotation::get($this->headers, $header, false);
	}
	
	public function post ($key = null) {
		return $this->get('post', $key);
	}
	
	public function get ($array, $key = null) {
		$array = $this->arrays[$array];
		
		if ($key === null) {
			return $array;
		}
		
		return DotNotation::get($array, $key, false);
	}
	
}