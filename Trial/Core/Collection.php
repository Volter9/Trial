<?php namespace Trial\Core;

use ArrayAccess,
	Countable,
	Iterator;

class Collection implements ArrayAccess, Countable, Iterator {
	
	protected $items;
	protected $position;
	
	public function __construct (array $items = []) {
		$this->items = $items;
		$this->position = 0;
	}
	
	public function last () {
		$last = end($this->items);
		
		reset($this->items);
		
		return $last;
	}
	
	public function first () {
		reset($this->items);
		
		return current($this->items);
	}
	
	public function pop () {
		return array_pop($this->items);
	}
	
	public function append ($value) {
		array_push($this->items, $value);
	}
	
	public function shift () {
		return array_shift($this->items);
	}
	
	public function prepend ($value) {
		array_unshift($this->items, $value);
	}
	
	public function slice ($offset, $count) {
		return array_slice($this->items, $offset, $count);
	}
	
	public function content () {
		return $this->items;
	}
	
	/**
	 * ArrayAccess interface implementation
	 */
	
	public function offsetExists ($offset) {
		return isset($this->items[$offset]);
	}
	
	public function offsetUnset ($offset) {
		unset($this->items[$offset]);
	}
	
	public function offsetGet ($offset) {
		if (!$this->offsetExists($offset)) {
			return false;
		}
		
		return $this->items[$offset];
	}
	
	public function offsetSet ($offset, $value) {
		$this->items[$offset] = $value;
	}
	
	/**
	 * Iterator interface implementation
	 */
	
	public function rewind () {
        $this->position = 0;
    }

    public function current () {
        return $this->items[$this->position];
    }

    public function key () {
        return $this->position;
    }

    public function next () {
        $this->position ++;
    }

    public function valid () {
        return isset($this->items[$this->position]);
    }
	
	/**
	 * Countable interface implementation
	 */
	
	public function count () {
		return count($this->items);
	}
	
}