<?php namespace Trial\View;

use Trial\Injection\Container;

use Trial\View\Plugins\Plugin;

use Trial\View\Template\Data,
	Trial\View\Template\Partial;

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
		$path = $this->container->get('app.path');
		
		$data = new Data($data);
		$view = new Partial($data, $path->build("Views/$view"));
		
		return new Template($this->plugins, $view);
	}
	
	public function createView ($view, array $data) {
		$path = $this->container->get('app.path');
		
		$data = new Data($data);
		
		return new View($data, $path->build("Views/$view"));
	}
	
}