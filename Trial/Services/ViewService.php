<?php namespace Trial\Services;

use Trial\Injection\Container;
	
use Trial\View\Factory,
	Trial\View\Plugins,
	Trial\View\Plugins\RoutePlugin,
	Trial\View\Plugins\AssetPlugin;

class ViewService implements Service {
	
	public function register (Container $container) {
		$plugins = new Plugins;
		$plugins->register(new RoutePlugin($container));
		$plugins->register(new AssetPlugin($container));
		
		$container->set('view', new Factory($container, $plugins));
	}
	
}