<?php namespace Trial\Routing\Http;

/**
 * @todo make it unit testable
 */

class Input {
	
	private $arrays;
	private $headers;
	
	public function __construct () {
		$this->arrays = [
			'get' => $_GET,
			'post' => $_POST,
			'server' => $_SERVER
		];
		
		$this->headers = getallheaders();
	}
	
	public function getHeaders () {
		return $this->headers;
	}
	
	public function getHeader ($header) {
		if (!isset($this->headers[$header])) {
			return false;
		}
		
		return $this->headers[$header];
	}
	
	public function getGet ($key = null) {
		return $this->get('get', $key);
	}
	
	public function getPost ($key = null) {
		return $this->get('post', $key);
	}
	
	public function getServer ($key = null) {
		return $this->get('server', $key);
	}
	
	protected function get ($array, $key = null) {
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