<?php namespace Trial\Services;

use Trial\Injection\Container;
	
use Trial\View\Factory,
	Trial\View\Plugins\RoutePlugin;

class ViewService implements Service {
	
	public function register (Container $container) {
		$factory = new Factory($container);
		$factory->registerPlugin(new RoutePlugin($container));
		
		$container->set('view', $factory);
	}
	
}