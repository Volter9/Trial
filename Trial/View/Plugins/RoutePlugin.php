<?php namespace Trial\View\Plugins;

use Trial\Core\Collection;

use Trial\Injection\Container;

use Trial\View\Template;

class RoutePlugin implements Plugin {
	
	private $builder;
	
	public function __construct (Container $container) {
		$this->builder = $container->get('routing.builder');
	}
	
	public function execute (Collection $arguments, Template $template) {
		return $this->builder->urlToRoute(
			$arguments->shift(), 
			$arguments->content()
		);
	}
	
	public function getName () {
		return 'route';
	}
	
}