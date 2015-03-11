<?php namespace Trial\Injection;

use Exception;

class Container {
	
	private $members = [];
	private $factory;
	
	public function setFactory (Factory $factory) {
		$this->factory = $factory;
	}
	
	public function factory () {
		return $this->factory;
	}
	
	public function set ($name, $object) {
		$this->members[$name] = $object;
	}
	
	public function get ($name) {
		if (!isset($this->members[$name])) {
			throw new Exception("Member '$name' does not exists in container!");
		}
		
		return $this->members[$name];
	}
	
}