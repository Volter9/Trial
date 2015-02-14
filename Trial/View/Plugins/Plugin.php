<?php namespace Trial\View\Plugins;

use Trial\Injection\Container,
	Trial\Core\Collection;

interface Plugin {
	
	public function execute (Collection $arguments);
	public function getName ();
	
}