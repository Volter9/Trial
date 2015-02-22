<?php namespace Trial\DB;

use Trial\DB\Model;

abstract class Repository {
	
	protected $connection;
	protected $table;
	
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
	
	abstract function find ($id);
	
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