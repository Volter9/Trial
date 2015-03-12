<?php namespace Trial\Data;

interface Formatter {
	
	public function __construct (array $messages, array $fields);
	public function format(array $errors);
	
}