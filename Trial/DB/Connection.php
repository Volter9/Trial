<?php namespace Trial\DB;

use PDO,
	PDOException;

use Trial\DB\Query\Query;

class Connection {
	
	const PREFIX_TOKEN = '__';
	
	private $config;
	private $dsn;
	
	private $pdo;
	
	public function __construct (array $config) {
		$host = $config['host'];
		$name = $config['name'];
		
		$driver = $config['driver'];
		$charset = $config['charset'];
	
		$this->config = $config;
		$this->dsn = "$driver:host=$host;dbname=$name;charset=$charset";
	}
	
	public function connect () {
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_EMULATE_PREPARES => false,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$this->config['charset']}"
		];
		
		$pdo = new PDO(
			$this->dsn, 
			$this->config['user'], 
			$this->config['password'], 
			$options
		);
		
		$this->pdo = $pdo;
	}
	
	public function getConnection () {
		return $this->pdo;
	}
	
	public function query ($query, array $parameters = []) {
		$query = str_replace(self::PREFIX_TOKEN, $this->config['prefix'], $query);
		
		try {
			$statement = $this->pdo->prepare($query);
			$statement->execute($parameters);
		}
		catch (PDOException $e) {
			throw $e;
		}
		
		return $statement;
	}
	
	public function builder () {
		return new Query($this);
	}
	
	public function table ($table) {
		return $this->builder()->from($table);
	}
	
}