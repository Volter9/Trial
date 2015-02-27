<?php namespace Trial\Routing\Route\Actions;

use Closure;

use Trial\Injection\Container;

use Trial\Routing\Route\Action,
	Trial\Routing\Http\Request,
	Trial\Routing\Http\Response;

class Callback implements Action {
	
	private $callback;
	
	public function __construct (Closure $callback) {
		$this->callback = $callback;
	}
	
	public function exists () {
		return true;
	}
	
	public function invoke (
		Container $container, 
		Request $request, 
		Response $response
	) {
		$closure = $this->callback->bindTo($container);
		
		return $closure($request, $response);
	}
	
}