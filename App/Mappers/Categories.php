<?php namespace App\Mappers;

use Trial\DB\ORM\Mapper;

class Categories extends Mapper {
	
	public function tree () {
		$categories = $this->all();
		
		return $categories;
	}
	
}