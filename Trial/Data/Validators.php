<?php namespace Trial\Data;

use Closure,
	Exception;

class Validators {
	
	private $validators;
	
	public function __construct (array $validators = []) {
		$this->validators = $validators;
	}
	
	public function add ($key, Closure $validator) {
		$this->validators[$key] = $validator;
	}
	
	public function get ($key) {
		if (!isset($this->validators[$key])) {
			throw new Exception("Validator '$key' does not exists!");
		}
		
		return $this->validators[$key];
	}
	
	public function invoke ($key, array $parameters) {
		$validator = $this->get($key);
		
		return call_user_func_array($validator, $parameters);
	}
	
}