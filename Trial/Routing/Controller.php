<?php namespace Trial\Routing;

use Trial\Injection\Container;

/**
 * Controller class
 * 
 * @package Trial
 */

abstract class Controller {
	
	/**
	 * @var \Trial\Injection\Container DI Container
	 */
	protected $container;
	
	/**
	 * @var \Trial\View\Factory Template factory
	 */
	protected $viewFactory;
	
	/**
	 * Constructor
	 * 
	 * @param \Trial\Injection\Container $container
	 */
	public function __construct (Container $container) {
		$this->container = $container;
		$this->viewFactory = $container->get('view');
	}
	
	/**
	 * Index action
	 * 
	 * @param \Trial\Routing\Http\Request $request
	 * @param \Trial\Routing\Http\Response $response
	 * @return \Trial\Routing\Http\Output|null
	 */
	abstract public function indexAction ($request, $response);
	
}