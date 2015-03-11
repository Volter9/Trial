<?php namespace Trial\Storage;

use Trial\Helpers\DotNotation;

class PHPConfig implements Readable {
	
	/**
	 * @var array config data
	 */
	private $data;
	
	/**
	 * Constructor
	 * 
	 * @param string $file
	 */
	public function __construct ($file) {
		$this->data = include $file;
	}
	
	/**
	 * Get a value of key
	 * 
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function get ($key = null, $default = null) {
		if ($key === null) {
			return $this->data;
		}
		
		return DotNotation::get($this->data, $key, $default);
	}
	
}