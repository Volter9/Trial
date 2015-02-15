<?php namespace Trial\View\Template;

class Data {
	
	private $data;
	
	public function __construct (array $data = []) {
		$this->data = $data;
	}
	
	public function set ($key, $value) {
		$this->data[$key] = $value;
	}
	
	public function merge (array $data) {
		$this->data = array_merge($this->data, $data);
		
		return $this;
	}
	
	public function content () {
		return $this->data;
	}
	
}