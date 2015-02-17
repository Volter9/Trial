<?php namespace Trial\View\Plugins;

use Trial\Injection\Container;
	
use Trial\Core\Collection;

class RoutePlugin implements Plugin {
	
	private $router;
	
	public function __construct (Container $container) {
		$this->routes = $container->get('routes');
		$this->base = $this->getBase();
	}
	
	private function getBase () {
		// @todo
		$root = $_SERVER['DOCUMENT_ROOT'];
		$fragments = explode($root, BASE_PATH);
		
		$base = '/' . trim(end($fragments), '/');
		
		return $base;
	}
	
	public function execute (Collection $arguments) {
		return $this->urlTo(
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