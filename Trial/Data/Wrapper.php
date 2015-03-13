<?php namespace Trial\Data;

class Wrapper {
	
	private $validation;
	private $formatter;
	
	public function __construct (
		Validation $validation, 
		Formatter $formatter
	) {
		$this->validation = $validation;
		$this->formatter = $formatter;
	}
	
	public function validate (array $data) {
		return $this->validation->isValid($data);
	}
	
	public function getErrors () {
		return $this->formatter->format(
			$this->validation->getErroredFields()
		);
	}
	
}