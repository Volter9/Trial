<?php namespace Trial\View\UI;

use Trial\View\View,
	Trial\View\Template\Data;

class Form {
	
	/**
	 * @var \Trial\Data\Validation|null
	 */
	protected $validation;
	
	/**
	 * @var \Trial\View\View
	 */
	protected $view;
	
	/**
	 * @var array
	 */
	protected $fields;
	
	public function __construct (Validation $validation, View $view) {
		$this->validation = $validation;
		$this->view = $view;
	}
	
	public function setFields (array $fields) {
		$this->fields = $fields;
	}
	
	/**
	 * @param array $data
	 * @return bool
	 */
	public function isValid (array $data) {
		return $this->validator !== null
			&& $this->validator->isValid($data);
	}
	
	public function render (array $data = []) {
		$data = [
			'errors' => $this->validation->getErrors(),
			'fields' => $this->fields
		];
		
		$this->view
			->getData()
			->merge($data);
		
		$this->view->render();
	}
	
}