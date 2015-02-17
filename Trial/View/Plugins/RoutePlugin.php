<?php namespace Trial\View\Plugins;

use Trial\Injection\Container;

use Trial\Core\Collection;

use Trial\Routing\UrlBuilder;

class RoutePlugin implements Plugin {
	
	private $router;
	private $request;
	
	public function __construct (Container $container) {
		$this->builder = $container->get('routing.builder');
	}
	
	public function execute (Collection $arguments) {
		return $this->builder->urlTo(
			$arguments->shift(), 
			$arguments->content()
		);
	}
	
	protected function urlTo ($id, array $params) {
		$route = $this->routes->getById($id);
		
		$url = $route ? $route->url($params) : '';
		
		return $this->base . $url;
	}
	
	public function getName () {
		return 'route';
	}
	
}