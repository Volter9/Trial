<?php namespace Trial\Routing\Route;

use Trial\Routing\Http\Request;

class Url {
	
	private $method;
	private $url;
	
	private $pattern;
	
	public function __construct ($method, $url) {
		$this->method = $method;
		$this->url = chop($url, '/');
	}
	
	public function getUrl () {
		return $this->url;
	}
	
	public function getMethod () {
		return $this->method;
	}
	
	public function setPattern ($pattern) {
		$this->pattern = $pattern;
	}
	
	public function getPattern () {
		return $this->pattern;
	}
	
	public function setBase ($base) {
		$this->url = str_replace($base, '', $this->url);
	}
	
	public function match (Request $request) {
		return $this->compareMethod($request)
			&& $this->matchUrl($request);
	}
	
	private function compareMethod (Request $request) {
		$method = $request->getMethod();
		
		return $method === '*' 
			|| $method === $this->method;
	}
	
	protected function matchUrl (Request $request) {
		$url = $request->getUrl();
		
		return $this->url === $url 
			|| preg_match($this->pattern, $url);
	}
	
}