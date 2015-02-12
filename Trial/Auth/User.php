<?php namespace Trial\Auth;

class User {
	
	private $rules;
	
	public function __construct (RuleSet $rules) {
		$this->rules = $rules;
	}
	
}