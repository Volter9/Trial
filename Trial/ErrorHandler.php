<?php namespace Trial;

use Exception;

use Trial\Injection\Container;

class ErrorHandler {
	
	private $container;
	
	public function __construct (Container $container) {
		$this->container = $container;
		
		set_exception_handler([$this, 'handleException']);
	}
	
	/**
	 * Ugly trick
	 */
	public function handleException (Exception $exception) {
		$viewFactory = $this->container->get('view');
		$language = $this->container->get('language');
		
		$template = $viewFactory->create('exception', [
			'title' => $exception->getMessage(),
			'exception' => $exception,
			'container' => $this->container
		]);
		
		$template->render();
	}
	
}