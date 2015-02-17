<?php namespace Trial\DB\ORM\Relations;

use Trial\DB\ORM\Relation,
	Trial\DB\ORM\Entity;

class Multiple extends Relation {
	
	protected $relations = [];
	
	protected function initialize () {
		
	}
	
	public function relateOne (Entity $entity) {
		// Nothing here yet
	}
	
}