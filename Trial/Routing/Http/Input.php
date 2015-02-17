<?php namespace Trial\Routing\Http;

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
		if (!$header === null) {
			return $this->headers;
		}
		
		if (!isset($this->headers[$header])) {
			return false;
		}
		
		return $this->headers[$header];
	}
	
	public function get ($array, $key = null) {
		$array = $this->arrays[$array];
		
		if ($key === null) {
			return $array;
		}
		
		if (isset($array[$key])) {
			return $array[$key];
		}
		
		return false;
	}
	
}