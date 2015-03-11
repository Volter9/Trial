<?php namespace Trial\Data;

use Trial\Storage\Readable;

class Factory {
	
	private $config;
	private $validators;
	
	public function __construct (
		Readable $config, 
		Validators $validators
	) {
		$this->config = $config;
		$this->validators = $validators;
	}
	
	public function createValidation ($group) {
		$group = $this->config->get($group);
	}
	
}