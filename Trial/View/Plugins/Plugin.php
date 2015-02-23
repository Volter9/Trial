<?php namespace Trial\View\Plugins;

use Trial\Core\Collection;

use Trial\Injection\Container;

use Trial\View\Template;

interface Plugin {
	
	public function __construct (Container $container);
	public function execute (Collection $arguments, Template $template);
	public function getName ();
	
}