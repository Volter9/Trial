<?php namespace Trial\DB\ORM;

use Closure,
	Exception;

use Trial\Core\Collection,
	Trial\DB\Connection;

class Mapper {
	
	private $connection;
	private $entity;
	private $table;
	private $columns;
	
	private $pk = 'id';
	private $query;
	
	public function __construct (
		Connection $connection, 
		$entity, 
		$table
	) {
		$this->checkClass($entity);
		
		$this->entity = $entity;
		$this->table = $table;
		
		$this->query = $connection->getTable($table);
	}
	
	private function checkClass ($entity) {
		if (class_exists($entity)) {
			return;
		}
		
		throw new Exception("Entity '$entitiy' does not exists!");
	}
	
	public function build (array $data) {
		$entity = $this->entity;
		
		return new $entity($data);
	}
	
	public function create (array $data) {
		$id = $this->query->insert($data)->execute();
		
		return $this->get($id);
	}
	
	public function save (Entity $entity) {
		if (!$entity->isDirty()) {
			return;
		}
		
		$result = $entity->isOriginal()
			? $this->insert($entity)
			: $this->update($entity);
		
		$entity->clean();
		
		return $result;
	}
	
	public function insert (Entity $entity) {
		$data = $entity->getData();
		$id = $this->query
			->insert($data)
			->execute();
		
		$entity[$this->pk] = $id;
		$entity->expire();
		
		return $id;
	}
	
	public function update (Entity $entity) {
		$data = $entity->getData();
		$pk = $this->pk;
		
		return $this->query
			->where("$pk = ?", [$data[$pk]])
			->update($data)
			->execute();
	}
	
	public function get ($id) {
		if (!$id) {
			return false;
		}
		
		$pk = $this->pk;
		$result = $this->query
			->where("$pk = ?", [$id])
			->limit(1)
			->select($this->columns)
			->execute();
		
		if (!$result) {
			return false;
		}
		
		$entity = $this->wrapOne($result[0]);
		$entity->expire();
		
		return $entity;
	}
	
	public function all () {
		return $this->wrapInCollection(
			$this->query
				->orderBy('id DESC')
				->select($this->columns)
				->execute()
		);
	}
	
	public function custom (Closure $callback) {
		$callback($this->query);
		
		return $this->wrapInCollection($this->query->execute());
	}
	
	public function getQuery () {
		return $this->query;
	}
	
	public function limit ($columns = '*') {
		$this->columns = $columns;
		
		return $this;
	}
	
	/**
	 * Wrappers
	 * 
	 * @todo extract into seperate class
	 */
	
	protected function wrapOne (array $data) {
		$entity = $this->entity;
		
		return new $entity($data);
	}
	
	protected function wrapInCollection (array $data) {
		return new Collection(array_map([$this, 'wrapOne'], $data));
	}
	
}