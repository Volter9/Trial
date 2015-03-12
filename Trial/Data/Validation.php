<?php namespace Trial\Data;

class Validation {
	
	private $rules;
	private $validators;
	
	private $errored = [];
	
	public function __construct ($rules, $validators) {
		$this->rules = $rules;
		$this->validators = $validators;
	}
	
	public function isValid (array $data) {
		$this->errored = [];
		
		foreach ($this->rules as $field => $rules) {
			$value = $data[$field];
			
			$this->validateField($field, $rules, $value);
		}
		
		return empty($this->errored);
	}
	
	private function validateField ($field, $rules, $value) {
		foreach ($rules as $validator => $parameters) {
			$callback   = $this->validators[$validator];
			$parameters = array_merge([$value, $field], $parameters);
			
			if (!call_user_func_array($callback, $parameters)) {
				$this->errored[$field][] = $validator;
			}
		}
	}
	
	public function getErroredFields () {
		return $this->errored;
	}
	
}