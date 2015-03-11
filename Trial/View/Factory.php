<?php namespace Trial\View;

use Trial\Injection\Container;

use Trial\View\Plugins\Plugin,
	Trial\View\Template\Data;

class Factory {
	
	private $plugins;
	
	public function __construct (
		Container $container, 
		Plugins $plugins
	) {
		$this->container = $container;
		$this->plugins = $plugins;
	}
	
	public function createTemplate ($view, array $data = []) {
		$data = new Data($data);
		
		$template = new Template(
			$this->container, 
			$this->plugins,
			$data, $view
		);
		
		return $template;
	}
	
	public function createView ($view, array $data) {
		$path = $this->container->get('app.path');
		$data = new Data($data);
		
		$view = new View($data, $path->build("Views/$view"));
		
		return $view;
	}
	
}