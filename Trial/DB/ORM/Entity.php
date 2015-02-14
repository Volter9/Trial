<?php namespace Trial\DB\ORM;

use ArrayAccess;

class Entity implements ArrayAccess {
	
	private $data;
	
	private $dirty = false;
	private $clean = true;
	
	public static $pk = 'id';
	
	public static function getRules () {
		return [];
	}
	
	/**
	 * Constructor
	 * 
	 * @param array $data
	 */
	public function __construct (array $data = []) {
		$this->data = $data;
		
		!empty($data) and $this->dirty = true;
	}
	
	public function getData () {
		return $this->data;
	}
	
	
	public function isDirty () {
		return $this->dirty;
	}
	
	public function markClean () {
		if (!$this->dirty) {
			throw new Exception (
				'Entity is not dirty yet!'
			);
		}
		
		$this->dirty = false;
	}
	
	
	public function isClean () {
		return $this->clean;
	}
	
	public function markOld () {
		$this->clean = false;
	}
	
	
	public function toJSON () {
		return json_encode($this->data);
	}
	
	public function __toString () {
		return $this->toJSON();
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