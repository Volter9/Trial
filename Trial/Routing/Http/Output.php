<?php namespace Trial\Routing\Http;

/**
 * @todo get a better name
 */

interface Output {
	
	/**
	 * @param \Trial\Routing\Http\Response
	 */
	public function render (Response $response = null);
	
}