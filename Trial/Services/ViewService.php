<?php namespace Trial\Services;

use Trial\Injection\Container;
	
use Trial\View\Factory,
	Trial\View\Plugins,
	Trial\View\Plugins\AssetPlugin,
	Trial\View\Plugins\PartialPlugin,
	Trial\View\Plugins\RoutePlugin,
	Trial\View\Plugins\LanguagePlugin;

class ViewService implements Service {
	
	public function register (Container $container) {
		$plugins = new Plugins;
		
		$plugins->register(new RoutePlugin($container));
		$plugins->register(new AssetPlugin($container));
		$plugins->register(new PartialPlugin($container));
		$plugins->register(new LanguagePlugin($container));
		
		$container->set('view', new Factory($container, $plugins));
	}
	
}