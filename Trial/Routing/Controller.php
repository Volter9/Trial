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
	 * Constructor
	 * 
	 * @param \Trial\Injection\Container $container
	 */
	public function __construct (Container $container) {
		$this->container = $container;
	}
	
}