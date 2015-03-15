<?php namespace Trial\Data;

use Trial\Injection\Container;

use Trial\Storage\Readable;

use Trial\Data\Formatters\Basic;

class Factory {
	
	private $rules;
	private $validators;
	
	private $language;
	private $packer;
	
	public function __construct (
		Readable $rules, 
		Readable $language,
		Validators $validators
	) {
		$this->rules = $rules;
		$this->validators = $validators;
		
		$this->language = $language;
		$this->packer = new RulePacker;
	}
	
	public function createWrapper ($ruleSet) {
		$rules = $this->rules->get($ruleSet);
		
		$fields   = $this->language->get("fields.$ruleSet");
		$messages = $this->language->get('messages');
		
		$validation = new Validation(
			$this->packer->packRuleSet($rules), 
			$this->validators
		);
		
		return new Wrapper($validation, new Basic($messages, $fields));
	}
	
}