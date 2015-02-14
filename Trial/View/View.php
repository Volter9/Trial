<?php namespace Trial\View;

use Trial\Injection\Container,
	Trial\Routing\Http\Output,
	Trial\Routing\Http\Response;

class View implements Output {
	
	private $template;
	
	private $variables;
	private $path;
	
	public function __construct (
		Template $template, 
		$path, 
		array $variables = []
	) {
		$this->template = $template;
		$this->path = $path;
		$this->variables = $variables;
	}
	
	public function render (Response $response = null) {	
		$closure = function ($__view, $__variables) {
			extract($__variables);
			
			include $__view;
		};
		
		$closure = $closure->bindTo($this->template);
		$closure($this->path, $this->variables);
	}
	
	public function getVariables () {
		return $this->variables;
	}
	
}