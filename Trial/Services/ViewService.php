<?php namespace Trial\Services;

use Trial\Injection\Container;
	
use Trial\View\Factory,
	Trial\View\Plugins\RoutePlugin;

class ViewService extends Service {
	
	public function register () {
		$factory = new Factory($this->container);
		
		$factory->registerPlugin(new RoutePlugin($this->container));
		
		$this->container->set('view', $factory);
	}
	
}