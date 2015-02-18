<?php namespace Trial\Services;

use Trial\Injection\Container;

use Trial\Routing\Factory;

class RoutingService implements Service {
	
	public function register (Container $container) {
		$factory = new Factory($container);
		
		$path = $container->get('app.path');
		
		$input  = $factory->input();
		$routes = include $path->build('Configs/routes');
		
		$builder    = $factory->urlBuilder($input, $routes);
		$dispatcher = $factory->dispatcher();
		$router     = $factory->router($routes);
		
		$url     = $builder->requestUrl();
		$request = $factory->request($url, $input);
		
		$container->set('routes', $routes);
		$container->set('routing.request', $request);
		$container->set('routing.router', $router);
		$container->set('routing.dispatcher', $dispatcher);
		$container->set('routing.builder', $builder);
		
		$container->set('routing', $factory);
	}
	
}