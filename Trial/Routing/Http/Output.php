<?php namespace Trial\Routing\Http;

/**
 * @todo get a better name
 */

interface Output {
	
	public function render (Response $response = null);
	
}