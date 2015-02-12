<?php namespace Trial\View;

use Trial\Injection\Container;

use Trial\View\Plugins\Plugin;

class Factory {
	
	private $plugins = [];
	
	public function __construct (Container $container) {
		$this->container = $container;
	}
	
	public function registerPlugin (Plugin $plugin) {
		$this->plugins[] = $plugin;
	}
	
	public function create ($view, array $data = []) {
		$template = new Template($this->container, $view, $data);
		
		foreach ($this->plugins as $plugin) {
			$template->registerPlugin($plugin);
		}
		
		return $template;
	}
	
}