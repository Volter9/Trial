<?php namespace Trial\DB\Query;

use Exception;

use Trial\DB\Connection,
	Trial\DB\Query\Builders\Builder;

class Query {
	
	private $connection;
	
	private $table;
	private $columns = '*';
	
	private $where = [];
	private $groups = [];
	private $orders = [];
	
	private $limit = 0;
	private $offset = 0;
	
	private $type;
	private $sql = '';
	private $data;
	
	public function __construct (Connection $connection) {
		// Hahaha
		$this->builder = new Builder($this);
		$this->connection = $connection;
	}
	
	public function getColumns () {
		return $this->columns;
	}
	
	public function getTable () {
		return $this->table;
	}
	
	public function getWhere () {
		return $this->where;
	}
	
	public function getGroups () {
		return $this->groups;
	}
	
	public function getOrders () {
		return $this->orders;
	}
	
	public function getLimit () {
		return $this->limit;
	}
	
	public function getOffset () {
		return $this->offset;
	}
	
	public function setTable ($table) {
		$this->table = $table;
		
		return $this;
	}
	
	public function select ($columns = '*') {
		$this->columns = $columns;
		$select = $this->builder->formSelect();
		
		$this->type = 'select';
		$this->sql = $select['query'];
		$this->data = $select['data'];
		
		return $this;
	}
	
	public function insert (array $data) {
		$insert = $this->builder->formInsert($data);
		
		$this->type = 'insert';
		$this->sql = $insert['query'];
		$this->data = $insert['data'];
		
		return $this;
	}
	
	public function update (array $data) {
		$update = $this->builder->formUpdate($data);
		
		$this->type = 'update';
		$this->sql = $update['query'];
		$this->data = $update['data'];
		
		return $this;
	}
	
	public function delete () {
		$delete = $this->builder->formDelete();
		
		$this->type = 'delete';
		$this->sql = $delete['query'];
		$this->data = $delete['data'];
		
		return $this;
	}
	
	public function execute () {
		$statement = $this->connection->query(trim($this->sql), $this->data);

		$this->clear();
		
		switch ($this->type) {
			case 'select':
				if ($this->limit === 1) return $statement->fetch();
				
				return $statement->fetchAll();
			
			case 'insert':
				return $this->connection->getConnection()->lastInsertId();
			
			case 'update':
			case 'delete':
				return $statement->rowCount() > 0;
			
			default:
				throw new Exception('WTF man?');
		}
	}
	
	public function where ($condition, array $data) {
		$this->where[] = [
			'condition' => $condition,
			'data' => $data,
			'type' => 'AND'
		];
		
		return $this;
	}
	
	public function orWhere ($condition, array $data) {
		$this->where[] = [
			'condition' => $condition,
			'data' => $data,
			'type' => 'OR'
		];
		
		return $this;
	}
	
	public function groupBy ($group) {
		$this->groups[] = $group;
		
		return $this;
	}
	
	public function orderBy ($field) {
		$this->orders[] = $field;
		
		return $this;
	}
	
	public function limit ($limit, $offset = 0) {
		$this->limit = $limit;
		$this->offset = $offset;
		
		return $this;
	}
	
	public function clear () {
		$this->columns = '*';
		
		$this->where = [];
		$this->groups = [];
		$this->orders = [];
		
		$this->limit = 0;
		$this->offset = 0;
		
		$this->sql = '';
		$this->data = [];
		
		return $this;
	}
	
}