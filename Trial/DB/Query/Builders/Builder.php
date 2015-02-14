<?php namespace Trial\DB\Query\Builders;

use Trial\DB\Query\Query;

/**
 * @todo decompose
 */

class Builder {
	
	private $query;
	
	public function __construct (Query $query) {
		$this->query = $query;
	}
	
	public function formSelect () {
		$columns = $this->query->getColumns();
		$table = $this->query->getTable();
		$where = $this->query->getWhere();
		$limit = $this->query->getLimit();
		$offset = $this->query->getOffset();
		
		$sql = "SELECT $columns ";
		$sql .= "FROM $table ";
		$sql .= $this->formWhere($where);
		$sql .= $this->formFields(' GROUP BY', $this->query->getGroups());
		$sql .= $this->formFields(' ORDER BY', $this->query->getOrders());
		$sql .= $this->formLimit($limit, $offset);
		
		$data = $this->formWhereData($where);
		
		if ($limit) {
			$data[] = $limit;
		}
		if ($offset) {
			$data[] = $offset;
		}
		
		return [
			'query' => $sql,
			'data' => $data
		];
	}
	
	public function formInsert (array $data) {
		$table = $this->query->getTable();
		$columns = $this->formColumns($data);
		$placeholders = $this->formPlaceholders($data);
		
		$sql = "INSERT INTO $table ";
		$sql .= "($columns) VALUES ";
		$sql .= "($placeholders)";
		
		return [
			'query' => $sql,
			'data' => array_values($data)
		];
	}
	
	protected function formColumns (array $data) {
		return implode(',', array_keys($data));
	}
	
	protected function formPlaceholders (array $data) {
		return trim(str_repeat('?,', count($data)), ', ');
	}
	
	public function formUpdate (array $data) {
		$table = $this->query->getTable();
		$fields = $this->formUpdateFields($data);
		$where = $this->query->getWhere();
		$limit = $this->query->getLimit();
		
		$sql = "UPDATE $table ";
		$sql .= "SET $fields ";
		$sql .= $this->formWhere($where);
		$sql .= $this->formFields('ORDER BY', $this->query->getOrders());
		$sql .= $this->formLimit($limit, 0);
		
		$data = array_values($data);
		$data = array_merge($data, $this->formWhereData($where));
		
		if ($limit) {
			$data[] = $limit;
		}
		
		return [
			'query' => $sql,
			'data' => $data
		];
	}
	
	public function formUpdateFields (array $data) {
		foreach ($data as $field => $value) {
			$fields[] = "$field = ?";
		}
		
		return implode(',', $fields);
	}
	
	public function formDelete () {
		$table = $this->query->getTable();
		$where = $this->query->getWhere();
		$limit = $this->query->getLimit();
		
		$sql = "DELETE FROM $table ";
		$sql .= $this->formWhere($where);
		$sql .= $this->formFields(' ORDER BY', $this->query->getOrders());
		$sql .= $this->formLimit($limit, 0);
		
		$data = $where['data'];
		
		if ($limit) {
			$data[] = $limit;
		}
		
		return [
			'query' => $sql,
			'data' => $data
		];
	}
	
	protected function formWhereData (array $where) {
		$data = [];
		
		foreach ($where as $statement) {
			$data = array_merge($data, $statement['data']);
		}
		
		return $data;
	}
	
	protected function formWhere (array $where) {
		if (empty($where)) {
			return '';
		}
		
		$query = 'WHERE ';
		
		foreach ($where as $statement) {
			$query .= "{$statement['condition']} {$statement['type']} ";
		}
		
		return trim($query, 'AND OR') . ' ';
	}
	
	protected function formFields ($query, array $data) {
		if (empty($data)) {
			return ' ';
		}
		
		return "$query " . implode(',', $data) . ' ';
	}
	
	protected function formLimit ($limit, $offset) {
		$limit = $limit > 0 ? "LIMIT ? " : '';
		$offset = $offset > 0 ? "OFFSET ? " : '';
		
		return $limit . $offset;
	}
	
}