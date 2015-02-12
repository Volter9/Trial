<?php namespace Trial\Routing\Http;

interface Output {
	
	public function render (Response $response = null);
	
}