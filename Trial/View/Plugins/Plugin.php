<?php namespace Trial\View\Plugins;

use Trial\Injection\Container;

interface Plugin {
	
	public function execute (array $arguments = []);
	
	public function getName ();
	
}