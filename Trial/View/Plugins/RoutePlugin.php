<?php namespace Trial\View\Plugins;

use Trial\Injection\Container;

use Trial\Core\Collection;

class RoutePlugin implements Plugin {
	
	private $builder;
	
	public function __construct (Container $container) {
		$this->builder = $container->get('routing.builder');
	}
	
	public function execute (Collection $arguments) {
		return $this->builder->urlToRoute(
			$arguments->shift(), 
			$arguments->content()
		);
	}
	
	public function getName () {
		return 'route';
	}
	
}