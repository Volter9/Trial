<?php namespace Trial\View;

use Trial\Injection\Container,
	Trial\Routing\Http\Output,
	Trial\Routing\Http\Response;

class View implements Output {
	
	private $container;
	private $template;
	
	private $name;
	private $variables;
	private $view;
	
	public function __construct (
		Container $container, 
		Template $template, 
		$view, 
		array $variables = []
	) {
		$this->container = $container;
		$this->template = $template;
		
		$this->name = $view;
		$this->view = $container->get('app')->buildAppPath("Views/$view");
		$this->variables = $variables;
	}
	
	public function render (Response $response = null) {	
		$closure = function ($__view, $__variables) {
			extract($__variables);
			
			include $__view;
		};
		
		$closure = $closure->bindTo($this->template);
		$closure($this->view, $this->variables);
	}
	
	public function assign ($key, $value = null) {
		$this->variables[$key] = $value;
	}
	
	public function inject (array $values) {
		$this->variables = array_merge($this->variables, $values);
	}
	
	public function getVariables () {
		return $this->variables;
	}
	
}