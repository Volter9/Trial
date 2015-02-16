<?php namespace Trial\Auth;

class RuleSet {
	
	private $rules;
	
	public function __construct (array $rules = []) {
		$this->rules = $rules;
	}
	
	public function isAllowed ($rule) {
		return in_array($this->rules, '*')
			|| in_array($this->rules, $rule);
	}
	
	public function get () {
		return $this->rules;
	}
	
}