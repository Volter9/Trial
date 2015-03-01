<?php namespace Trial\Routing\Route;

use Trial\Injection\Container;

use Trial\Routing\Http\Request,
	Trial\Routing\Http\Response;

interface Action {
	
	/**
	 * @return bool
	 */
	public function exists ();
	
	/**
	 * @param \Trial\Injection\Container $container
	 * @param \Trial\Routing\Http|Request $request
	 * @param \Trial\Routing\Http\Response $response
	 * @return \Trial\Routing\Http\Response
	 */
	public function invoke (
		Container $container, 
		Request $request, 
		Response $response
	);
	
}