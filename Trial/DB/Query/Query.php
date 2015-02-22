<?php namespace Trial\DB\Query;

use Exception;

use Trial\DB\Connection,
	Trial\DB\Query\Builders\Builder;

/**
 * @todo decompose
 * @todo make the order of operation unimportant
 */

class Query {
	
	private $connection;
	
	private $table;
	private $columns = '*';
	
	private $where = [];
	private $groups = [];
	private $orders = [];
	
	private $limit = 0;
	private $offset = 0;
	
	private $joins = [];
	
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
	
	public function getJoins() {
		return $this->joins;
	}
	
	public function from ($table) {
		$this->table = $table;
		
		return $this;
	}
	
	public function select ($columns = '*') {
		$this->columns = $columns;
		$select = $this->builder->formSelect();
		
		$query = $select['query'];
		$data = $select['data'];
		
		$statement = $this->connection->query($query, $data);
		
		if ($this->limit === 1) return $statement->fetch();
		
		$this->clear();
		
		return $statement->fetchAll();
	}
	
	public function insert (array $data) {
		$insert = $this->builder->formInsert($data);
		
		$query = $insert['query'];
		$data = $insert['data'];
		
		$statement = $this->connection->query($query, $data);
		
		$this->clear();
		
		return $this->connection
			->getConnection()
			->lastInsertId();
	}
	
	public function update (array $data) {
		$update = $this->builder->formUpdate($data);
		
		$query = $update['query'];
		$data = $update['data'];
		
		$statement = $this->connection->query($query, $data);
		
		$this->clear();
		
		return $statement->rowCount() > 0;
	}
	
	public function delete () {
		$delete = $this->builder->formDelete();
		
		$query = $delete['query'];
		$data = $delete['data'];
		
		$statement = $this->connection->query($query, $data);
		
		$this->clear();
		
		return $statement->rowCount() > 0;
	}
	
	public function where ($condition, array $data = []) {
		$this->where[] = [
			'condition' => $condition,
			'data' => $data,
			'type' => 'AND'
		];
		
		return $this;
	}
	
	public function orWhere ($condition, array $data = []) {
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
	
	public function join ($table, $on, array $data = []) {
		$this->joins[] = [
			'table' => $table,
			'on' => $on,
			'data' => $data
		];
		
		return $this;
	}
	
	public function clear () {
		$this->columns = '*';
		
		$this->where = [];
		$this->groups = [];
		$this->orders = [];
		
		$this->limit = 0;
		$this->offset = 0;
		
		$this->joins = [];
		
		return $this;
	}
	
}