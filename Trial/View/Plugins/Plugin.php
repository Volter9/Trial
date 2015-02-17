<?php namespace Trial\View\Plugins;

use Trial\Injection\Container;

use Trial\Core\Collection;

interface Plugin {
	
	public function __construct (Container $container);
	public function execute (Collection $arguments);
	public function getName ();
	
}