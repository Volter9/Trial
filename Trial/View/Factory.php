<?php namespace Trial\View;

use Trial\Injection\Container;

use Trial\View\Plugins\Plugin,
	Trial\View\Template\Data;

class Factory {
	
	private $plugins;
	
	public function __construct (Container $container, Plugins $plugins) {
		$this->container = $container;
		$this->plugins = $plugins;
	}
	
	public function create ($view, array $data = []) {
		$template = new Template($this->container, new Data($data), $view);
		$template->setPlugins($this->plugins);
		
		return $template;
	}
	
}