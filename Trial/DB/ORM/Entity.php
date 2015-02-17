<?php namespace Trial\DB\ORM;

use ArrayAccess;

class Entity implements ArrayAccess {
	
	protected $data;
	
	private $dirty = true;
	private $original = true;
	
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
	
	public function isDirty () {
		return $this->dirty;
	}
	
	public function clean () {
		$this->dirty = false;
	}
	
	public function isOriginal () {
		return $this->original;
	}
	
	public function expire () {
		$this->original = false;
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
		$this->dirty = true;
	}
	
}