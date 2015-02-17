<?php namespace Trial\DB;

use PDO,
	PDOException;

use Trial\DB\Query\Query;

/**
 * @todo extract query caching
 */

class Connection {
	
	const ONE = 1;
	const SIMPLE = 2;
	const CUD = 4;
	const INSERT = 8;
	
	private $config;
	private $dsn;
	
	private $pdo;
	private $queries = [];
	
	private $count = 0;
	
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
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
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
	
	public function getCount () {
		return $this->count;
	}
	
	public function query ($query, array $parameters = []) {
		try {
			$this->count ++;
			
			$statement = $this->cacheStatement($query);		
			$statement->execute($parameters);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
			var_dump($query, $parameters);
			
			throw $e;
		}
		
		return $statement;
	}
	
	protected function cacheStatement ($query) {
		if (!isset($this->queries[$query])) {
			$statement = $this->pdo->prepare($query);
			
			$this->queries[$query] = $statement;
		}
		
		return $this->queries[$query];
	}
	
	public function getBuilder () {
		return new Query($this);
	}
	
	public function getTable ($table) {
		return $this->getBuilder()->setTable($table);
	}
	
}