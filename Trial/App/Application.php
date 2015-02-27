<?php namespace Trial\App;

use Trial\Injection\Container;

interface Application {
	
	/**
	 * @param string $path Path to application relative to the enter point
	 * @param \Trial\Injection\Container $container
	 */
	public function __construct ($path, Container $container = null);
	
	public function boot ();
	public function dispatch ();
	
}