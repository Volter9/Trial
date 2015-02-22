<?php namespace Trial\DB\DataMapper;

use ArrayAccess;

class Entity implements ArrayAccess {
	
	protected $data;
	
	/**
	 * Constructor
	 * 
	 * @param array $data
	 */
	public function __construct (array $data = []) {
		$this->data = $data;
	}
	
	public function getData () {
		return $this->data;
	}
	
	/**
	 * ArrayAccess interface implementation
	 */
	
	public function offsetExists ($offset) {
		return isset($this->data[$offset]);
	}
	
	public function offsetUnset ($offset) {
		unset($this->data[$offset]);
	}
	
	public function offsetGet ($offset) {
		if (!$this->offsetExists($offset)) {
			return false;
		}
		
		return $this->data[$offset];
	}
	
	public function offsetSet ($offset, $value) {
		$this->data[$offset] = $value;
	}
	
}