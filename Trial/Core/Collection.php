<?php namespace Trial\Core;

use Iterator,
	Countable;

class Collection implements Iterator, Countable {
	
	protected $items;
	
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