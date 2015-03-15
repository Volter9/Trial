<?php namespace Trial\Data;

interface Formatter {
	
	public function __construct (array $messages, array $fields);
	
	/**
	 * @return array
	 */
	public function format(array $errors);
	
}