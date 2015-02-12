<?php namespace Trial;

use Exception;

use Trial\Helpers\DotNotation;

use Trial\Core\Config as ConfigInterface;

class Config implements ConfigInterface {
	
	private $file;
	private $data;
	
	public function __construct ($file) {
		$this->file = $this->checkFile($file);		
		$this->data = $this->getData($this->file);
	}
	
	protected function checkFile ($file) {
		if (file_exists($file)) {
			return $file;
		}
		
		throw new Exception ("File '$file' is not exists!");
	}
	
	protected function getData ($file) {
		return include $file;
	}
	
	public function get ($key = null) {
		if ($key === null) {
			return $this->data;
		}
		
		return DotNotation::get($this->data, $key);
	}
	
}