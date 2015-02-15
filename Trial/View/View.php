<?php namespace Trial\View;

use Trial\Injection\Container,
	Trial\Routing\Http\Output,
	Trial\Routing\Http\Response;

use Trial\View\Template\Data;

class View implements Output {
	
	private $template;
	
	private $data;
	private $path;
	
	public function __construct (
		Template $template, 
		$path, 
		Data $data
	) {
		$this->template = $template;
		$this->path = $path;
		$this->data = $data;
	}
	
	public function render (Response $response = null) {	
		$closure = function ($__view, $__data) {
			extract($__data);
			
			include $__view;
		};
		
		$closure = $closure->bindTo($this->template);
		$closure($this->path, $this->data->content());
	}
	
	public function getData () {
		return $this->data;
	}
	
}