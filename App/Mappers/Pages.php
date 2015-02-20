<?php namespace App\Mappers;

use Trial\DB\ORM\Mapper;

class Pages extends Mapper {
	
	public function all () {
		return $this->wrapInCollection(
			$this->addJoins()
				->orderBy('p.date DESC')
				->select('p.id, p.title, p.description, p.date, p.category_id, p.user_id, u.username as user, c.title as category')
		);
	}
	
	public function getByCategory ($category) {
		return $this->wrapInCollection(
			$this->addJoins()
				->where('category_id = ?', [$category])
				->orderBy('p.date DESC')
				->select('p.id, p.title, p.description, p.date, p.category_id, p.user_id, u.username as user, c.title as category')
		);
	}
	
	private function addJoins () {
		$this->query
			->from('pages p')
			->join('users u', 'p.user_id = u.id')
			->join('categories c', 'p.category_id = c.id');
		
		return $this->query;
	}
	
}