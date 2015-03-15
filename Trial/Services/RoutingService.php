<?php namespace Trial\Services;

use Trial\Injection\Container;

use Trial\Routing\Dispatcher,
	Trial\Routing\Router,
	Trial\Routing\UrlBuilder;

use Trial\Routing\Http\Input,
	Trial\Routing\Http\Request;

class RoutingService implements Service {
	
	public function register (Container $container) {
		$routes = function ($path) {
			return include $path->build('Configs/routing');
		};
		
		$routes = $routes($container->get('app.path'));
		
		$dispatcher = new Dispatcher;
		
		$input   = new Input;
		$router  = new Router($routes);
		$builder = new UrlBuilder($input, $routes, BASE_PATH);
		
		$url     = $builder->requestUrl();
		$request = new Request($url, $input);
		
		$container->set('routing.request', $request);
		$container->set('routing.router', $router);
		$container->set('routing.dispatcher', $dispatcher);
		$container->set('routing.builder', $builder);
	}
	
}