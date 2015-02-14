<?php namespace Trial\View\Plugins;

use Trial\Injection\Container,
	Trial\Core\Collection;

class RoutePlugin implements Plugin {
	
	private $router;
	
	public function __construct (Container $container) {
		$this->router = $container->get('router');
	}
	
	public function execute (Collection $arguments) {
		return $this->router->urlTo(
			$arguments->pop(), 
			$arguments->content()
		);
	}
	
	public function getName () {
		return 'route';
	}
	
}