<?php namespace Trial\Services;

use Trial\Injection\Container;

use Trial\Routing\Dispatcher,
	Trial\Routing\Router,
	Trial\Routing\UrlBuilder;

use Trial\Routing\Http\Input,
	Trial\Routing\Http\Request;

class RoutingService implements Service {
	
	public function register (Container $container) {
		$input  = new Input;
		$routes = function ($path) {
			return include $path->build('Configs/routing');
		};
		
		$routes = $routes($container->get('app.path'));
		
		$builder    = new UrlBuilder($input, $routes);
		$dispatcher = new Dispatcher;
		$router     = new Router($routes);
		
		$url     = $builder->requestUrl();
		$request = new Request($url, $input);
		
		$container->set('routes', $routes);
		$container->set('routing.request', $request);
		$container->set('routing.router', $router);
		$container->set('routing.dispatcher', $dispatcher);
		$container->set('routing.builder', $builder);
	}
	
}