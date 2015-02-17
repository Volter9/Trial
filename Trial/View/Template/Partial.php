<?php namespace Trial\View\Template;

use Trial\Routing\Http\Response;

use Trial\View\View,
	Trial\View\Template;

class Partial extends View {
	
	private $template;
	
	public function __construct (
		Template $template, 
		Data $data, 
		$path
	) {
		parent::__construct($data, $path);
		
		$this->template = $template;
	}
	
	public function render (Response $response = null) {
		$closure = $this->isolate()->bindTo($this->template);
		
		$closure($this->path, $this->data->content());
	}
	
}