<?php namespace Trial\Services;

use Trial\ErrorHandler;

use Trial\Injection\Container;

class ErrorHandlerService implements Service {
	
	public function register (Container $container) {
		$handler = new ErrorHandler($container);
				
		$container->set('error', $handler);
	}
	
}