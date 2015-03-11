<?php namespace Trial\Data;

class Validation {
	
	private $rules;
	private $validators;
	private $fields;
	
	private $errors = [];
	
	public function __construct (
		RuleSet $rules, 
		Validators $validators, 
		array $fields
	) {
		$this->rules = $rules;
		$this->validators = $valudators;
		$this->fields = $fields;
	}
	
	public function getValidators () {
		return $this->validators;
	}
	
	public function isValid () {
		return empty($this->errors);
	}
	
	public function getErrors () {
		return $this->errors;
	}
	
	public function validate (array $data) {
		foreach ($this->rules as $rule) {
			
		}
	}
	
}