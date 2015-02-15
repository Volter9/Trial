<?php namespace Trial;

use Exception;

use Trial\Helpers\DotNotation;

use Trial\Core\Config as ConfigInterface;

/**
 * PHP Config class
 * 
 * Loads PHP's file data (from return) and keeps it safe for retrieval.
 * The config is read-only. 
 * 
 * @package Trial
 */

class Config implements ConfigInterface {
	
	/**
	 * @var string Path to the config file
	 */
	private $file;
	
	/**
	 * @var array File's data (from return)
	 */
	private $data;
	
	/**
	 * Constructor
	 * 
	 * @param string $file
	 */
	public function __construct ($file) {
		$this->file = $this->checkFile($file);		
		$this->data = $this->getData($this->file);
	}
	
	/**
	 * Check if config exists
	 * 
	 * @param string $file
	 * @throws \Exception
	 * @return string
	 */
	protected function checkFile ($file) {
		if (file_exists($file)) {
			return $file;
		}
		
		throw new Exception ("File '$file' is not exists!");
	}
	
	/**
	 * Get data
	 * 
	 * @param string $file
	 * @return array
	 */
	protected function getData ($file) {
		return include $file;
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