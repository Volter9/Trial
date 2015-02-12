<?php namespace Trial\Routing;

use Trial\Injection\Container;

abstract class Controller {
	
	protected $container;
	protected $viewFactory;
	
	public function __construct (Container $container) {
		$this->container = $container;
		$this->viewFactory = $container->get('view');
	}
	
}