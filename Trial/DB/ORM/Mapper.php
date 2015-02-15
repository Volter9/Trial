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
		if (!class_exists($entity)) {
			throw new Exception (
				"Entity '$entitiy' does not exists!"
			);
		}
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
		
		if ($entity->isOriginal()) {
			$result = $this->insert($entity);
			$entity->expire();
		}
		else {
			$result = $this->update($entity);
		}
		
		$entity->clean();
		
		return $result;
	}
	
	public function insert (Entity $entity) {
		$data = $entity->getData();
		$id = $this->query->insert($data)->execute();
		
		$entity[$this->pk] = $id;
		
		return $id;
	}
	
	public function update (Entity $entity) {
		$data = $entity->getData();
		$pk = $this->pk;
		
		return $this->query->update($data)
			->where("$pk = ?", [$data[$pk]])
			->execute();
	}
	
	public function get ($id) {
		if (!$id) {
			return false;
		}
		
		$pk = $this->pk;
		$result = $this->query->select()
			->where("$pk = ?", [$id])
			->limit(1)
			->execute();
		
		if (!$result) {
			return false;
		}
		
		$entity = $this->wrapOne($result);
		$entity->expire();
		
		return $entity;
	}
	
	public function all () {
		return $this->wrap(
			$this->query->select()->orderBy('id DESC')->execute()
		);
	}
	
	public function custom (Closure $callback) {
		$callback($this->query);
		
		return $this->wrap($this->query->execute());
	}
	
	public function getQuery () {
		return $this->query;
	}
	
	/**
	 * Wrappers
	 * 
	 * @todo extract into seperate class
	 */
	
	protected function wrap ($result) {
		if (!$result) {
			return false;
		}
		
		return $this->query->getLimit() === 1 
			? $this->wrapOne($result[0])
			: $this->wrapInCollection($result);
	}
	
	protected function wrapOne (array $data) {
		$entity = $this->entity;
		
		return new $entity($data);
	}
	
	protected function wrapInCollection (array $data) {
		return new Collection(array_map([$this, 'wrapOne'], $data));
	}
	
}