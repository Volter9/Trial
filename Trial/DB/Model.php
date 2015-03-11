<?php namespace Trial\DB;

use Trial\DB\Repository\Model as ModelInterface;

abstract class Model implements ModelInterface {
	
	public function export () {
		$properties = get_object_vars($this);
		
		$callback = function ($value) {
			return $value !== null;
		};
		
		return array_filter($properties, $callback);
	}
	
	public function import (array $data) {
		foreach ($data as $key => $value) {
			if (!property_exists($this, $key)) {
				continue;
			}
			
			$this->$key = $value;
		}
	}
	
}