<?php namespace Trial\View\Plugins;

use Trial\Injection\Container;

class RoutePlugin implements Plugin {
	
	private $router;
	
	public function __construct (Container $container) {
		$this->router = $container->get('router');
	}
	
	public function execute (array $arguments = []) {
		$id = current($arguments);
		$params = array_slice($arguments, 1);
		
		return $this->router->urlTo($id, $params);
	}
	
	public function getName () {
		return 'route';
	}
	
}