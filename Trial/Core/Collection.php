<?php namespace Trial\Core;

use Iterator;

class Collection implements Iterator {
	
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
	
	public function shift () {
		return array_shift($this->items);
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
	
}