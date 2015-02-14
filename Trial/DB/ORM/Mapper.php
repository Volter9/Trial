<?php namespace Trial\DB\ORM;

use Closure,
	Exception;

use Trial\Core\Collection,
	Trial\DB\Connection;

class Mapper {
	
	private $connection;
	private $table;
	private $pk;
	
	private $query;
	
	public function __construct (Connection $connection, $entity, $table, $relations) {
		$this->checkClass($entity);
		
		$this->entity = $entity;
		$this->table = $table;
		$this->relations = $relations;
		
		$this->pk = $entity::$pk;
		$this->query = $connection->getTable($this->table);
	}
	
	private function checkClass ($entity) {
		if (!class_exists($entity)) {
			throw new Exception (
				"Entity's class '$entitiy' does not exists!"
			);
		}
	}
	
	public function build (array $data) {
		$entity = $this->entity;
		
		return new $entity($data);
	}
	
	public function create (array $data) {
		$id = $this->query
			->insert($data)
			->execute();
		
		return $this->get($id);
	}
	
	public function save (Entity $entity) {
		if (!$entity->isDirty()) {
			return;
		}
		
		if ($entity->isClean()) {
			$result = $this->insert($entity);
			$entity->markOld();
		}
		else {
			$result = $this->update($entity);
		}
		
		$entity->markClean();
		
		return $result;
	}
	
	public function insert (Entity $entity) {
		$data = $entity->getData();
		$pk = $this->pk;
		
		$id = $this->query
			->insert($data)
			->execute();
		
		$entity[$pk] = $id;
		
		return $id;
	}
	
	public function update (Entity $entity) {
		$data = $entity->getData();
		$pk = $this->pk;
		
		return $this->query
			->update($data)
			->where("$pk = ?", [$data[$pk]])
			->execute();
	}
	
	public function get ($id) {
		if (!$id) {
			return false;
		}
		
		$pk = $this->pk;
		$result = $this->query
			->select()
			->where("$pk = ?", [$id])
			->limit(1)
			->execute();
		
		if (!$result) {
			return false;
		}
		
		$entity = $this->wrapOne($result);
		$entity->markOld();
		
		return $entity;
	}
	
	public function all () {
		return $this->wrap(
			$this->query
				->select()
				->orderBy('id DESC')
				->execute()
		);
	}
	
	public function custom (Closure $callback) {
		$callback($this->query);
		
		return $this->wrap($this->query->execute());
	}
	
	/**
	 * Wrappers
	 */
	
	protected function wrap ($result) {
		if (!$result) {
			return false;
		}
		
		return $this->query->getLimit() === 1 
			|| (
				count($result) === 1 && 
				is_array($result[0])
			)
			? $this->wrapOne($result[0])
			: $this->wrapInCollection($result);
	}
	
	protected function wrapOne (array $data) {
		$entity = $this->entity;
		
		return new $entity($data);
	}
	
	protected function wrapInCollection (array $data) {
		return new Collection (array_map([$this, 'wrapOne'], $data));
	}
	
}