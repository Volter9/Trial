<?php namespace Trial;

use Exception;

use Trial\Injection\Container;

/**
 * @todo do it better
 */
class ErrorHandler {
	
	private $container;
	
	public function __construct (Container $container) {
		$this->container = $container;
		
		set_exception_handler([$this, 'handleException']);
	}
	
	public function handleException (Exception $exception) {
		$viewFactory = $this->container->get('view');
		$language    = $this->container->get('language');
		
		$template = $viewFactory->createTemplate('exception', [
			'title'     => $exception->getMessage(),
			'exception' => $exception,
			'container' => $this->container
		]);
		
		$template->render();
	}
	
}