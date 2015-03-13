<?php namespace Trial\Data;

class Validation {
	
	private $rules;
	private $validators;
	
	private $errored = [];
	
	public function __construct ($rules, Validators $validators) {
		$this->rules = $rules;
		$this->validators = $validators;
	}
	
	public function isValid (array $data) {
		$this->errored = [];
		
		foreach ($this->rules as $field => $rules) {
			$value = isset($data[$field]) ? $data[$field] : null;
			
			$this->validateField($field, $rules, $value);
		}
		
		return empty($this->errored);
	}
	
	private function validateField ($field, $rules, $value) {
		foreach ($rules as $validator => $parameters) {
			$parameters = $parameters ?: [];
			$arguments  = array_merge([$value, $field], $parameters);
			
			if (!$this->validators->invoke($validator, $arguments)) {
				$this->errored[$field][$validator] = $parameters;
			}
		}
	}
	
	public function getErroredFields () {
		return $this->errored;
	}
	
}