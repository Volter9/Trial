<?php namespace Trial\App;

use Trial\Injection\Container;

/**
 * @todo force the contract
 */

interface Application {
	
	public function __construct (Container $container = null);
	public function dispatch ($some_cool_arg_for_dispatching);
	
}