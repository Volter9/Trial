<?php namespace Trial\Services;

use Trial\Injection\Container;
	
use Trial\View\Factory,
	Trial\View\Plugins\RoutePlugin,
	Trial\View\Plugins\AssetPlugin;

class ViewService implements Service {
	
	public function register (Container $container) {
		$factory = new Factory($container);
		$factory->registerPlugin(new RoutePlugin($container));
		$factory->registerPlugin(new AssetPlugin($container));
		
		$container->set('view', $factory);
	}
	
}