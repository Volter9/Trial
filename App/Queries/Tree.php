<?php namespace App\Queries;

use Trial\DB\Repository\Query;

abstract class Tree extends Query {
	
	protected function group (array $items) {
		$result = [];
		
		foreach ($items as $item) {
			$result[$item['id']] = $item;
		}
		
		return $result;
	}
	
	protected function order (array $items) {
		$result = [];
		
		foreach ($items as $id => &$item) {
			$parent_id = (int)$item['parent_id'];
			
			if ($parent_id === 0) {
				$result[$id] = &$item;
			}
			else {
				$items[$parent_id]['sub'][] = &$item;
			}
		}
		
		return $result;
	}
	
}