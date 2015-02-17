<?php namespace Trial\DB\ORM\Relations;

use Trial\DB\ORM\Relation,
	Trial\DB\ORM\Entity;

class OneToOne extends Relation {
	
	protected function initialize () {
		$table = $this->relations['table'];
		
		$this->mapper = $this->factory->table($table);
	}
	
	public function relateOne (Entity $entity) {
		$table = $this->relations['table'];
		$field = $this->relations['field'];
		
		$suffix = $this->removeSuffix($field);
		
		$entity[$suffix] = $this->mapper->get($entity[$field]);
		
		unset($entity[$suffix]);
	}
	
	private function removeSuffix ($string, $suffix = '_id') {
		return str_replace($suffix, '', $string);
	}
	
}