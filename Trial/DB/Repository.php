<?php namespace Trial\DB;

use Trial\DB\Repository\Model,
	Trial\DB\Repository\RepositoryInterface;

abstract class Repository implements RepositoryInterface {
	
	protected $connection;
	
	protected $table;
	protected $model;
	
	protected $find;
	protected $remove;
	
	protected $insert;
	protected $update;
	
	public function __construct (Connection $connection, Factory $factory) {
		$this->connection = $connection;
		
		$this->find = $factory->query('find');
		$this->remove = $factory->query('remove');
		
		$this->insert = $factory->query('insert');
		$this->update = $factory->query('update');
	}
	
	public function find ($id, $fields = '*') {
		if (!$result = $this->find->fetch($this->table, $id, $fields)) {
			return false;
		}
		
		$item = new $this->model;
		$item->import($result);
		
		return $item;
	}
	
	public function save (Model $model) {
		$data = $model->export();
		
		return $user->id !== null
			? $this->insert->insert($this->table, $data)
			: $this->update->update($this->table, $model->id, $data);
	}
	
	public function remove ($id) {
		return $this->remove->delete($this->table, $id);
	}
	
}