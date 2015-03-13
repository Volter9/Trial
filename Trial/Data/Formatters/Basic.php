<?php namespace Trial\Data\Formatters;

use Trial\Data\Formatter;

class Basic implements Formatter {
	
	private $messages;
	private $fields;
	
	public function __construct (array $messages, array $fields) {
		$this->messages = $messages;
		$this->fields = $fields;
	}
	
	public function format (array $errors) {
		foreach ($errors as $field => $rules) {
			$errors[$field] = $this->formatError($field, $rules);
		}
		
		return $errors;
	}
	
	public function formatError ($field, $rules) {
		$label  = isset($this->fields[$field]) ? $this->fields[$field] : $field;
		$errors = [];
		
		foreach ($rules as $rule => $parameters) {
			$parameters = array_merge(
				[$this->messages[$rule], $label], $parameters
			);
			
			$errors[] = call_user_func_array('sprintf', $parameters);
		}
		
		return $errors;
	}
	
}