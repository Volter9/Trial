<?php namespace Trial\Data;

class Validator {
	
	private $validators;
	
	public function __construct (array $validators = []) {
		$this->validators = $validators;
	}
	
}