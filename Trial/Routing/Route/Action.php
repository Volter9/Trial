<?php namespace Trial\Routing\Route;

use Trial\Injection\Container,
	Trial\Routing\Http\Request,
	Trial\Routing\Http\Response;

interface Action {
	
	/**
	 * @return bool
	 */
	public function exists ();
	
	/**
	 * @return \Trial\Routing\Http\Response
	 */
	public function invoke (
		Container $container, 
		Request $request, 
		Response $response
	);
	
}