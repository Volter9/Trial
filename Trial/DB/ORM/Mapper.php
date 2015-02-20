<?php namespace Trial\DB\ORM;

use Closure,
	Exception;

use Trial\Core\Collection,
	Trial\DB\Connection;

class Mapper {
	
	protected $entity;
	protected $table;
	protected $columns;
	
	protected $pk = 'id';
	protected $query;
	
	public function __construct (
		Connection $connection, 
		$entity, $table
	) {
		$this->entity = $entity;
		$this->table = $table;
		$this->query = $connection->getTable($table);
	}
	
	public function build (array $data) {
		$entity = $this->entity;
		
		return new $entity($data);
	}
	
	public function create (array $data) {
		$data['id'] = $this->query->insert($data);
		
		return $this->build($data);
	}
	
	public function save (Entity $entity) {
		$entity->clean();
		
		return $entity->isOriginal()
			? $this->insert($entity)
			: $this->update($entity);
	}
	
	public function insert (Entity $entity) {
		$data = $entity->getData();
		$id = $this->query
			->insert($data);
		
		$entity[$this->pk] = $id;
		$entity->expire();
		
		return $id;
	}
	
	public function update (Entity $entity) {
		$pk = $this->pk;
		
		return $this->query
			->where("$pk = ?", [$data[$pk]])
			->update($entity->getData());
	}
	
	public function get ($id) {
		$pk = $this->pk;
		$result = $this->query
			->where("$pk = ?", [$id])
			->limit(1)
			->select();
		
		if (!$result) {
			return false;
		}
		
		$entity = $this->build($result);
		$entity->expire();
		
		return $entity;
	}
	
	public function all () {
		return $this->wrapInCollection(
			$this->query->orderBy('id DESC')->select()
		);
	}
	
	public function custom (Closure $callback) {
		$callback($this->query);
		
		return $this->wrapInCollection($this->query->select());
	}
	
	public function getQuery () {
		return $this->query;
	}
	
	/**
	 * Wrappers
	 * 
	 * @todo extract into seperate class
	 */
	
	protected function wrapInCollection (array $data) {
		return new Collection(array_map([$this, 'build'], $data));
	}
	
}