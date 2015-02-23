<?php namespace Trial\Storage;

class Memory implements Container {
	
	private $data = [];
	
	public function get ($key) {
		if (!isset($this->data[$key])) {
			return false;
		}
		
		return $this->data[$key];
	}
	
	public function set ($key, $value) {
		$this->data[$key] = $value;
	}
	
}