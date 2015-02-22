<?php namespace App\Models;

use Trial\DB\Repository\Model as ModelInterface;

abstract class Model implements ModelInterface {
	
	public function export () {
		return array_filter(get_object_vars($this), function ($value) {
			return $value !== null;
		});
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