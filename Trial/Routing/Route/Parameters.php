<?php namespace Trial\Routing\Route;

class Parameters {
	
	private $url;
	
	private $pattern;
	private $symbol = '/@([\w\d-_]+)/';
	
	private $parameters;
	
	public function __construct (Url $url) {
		$this->url = $url;
		$this->pattern = $url->getPattern();
	}
	
	private function getParameters () {
		if (!$this->parameters) {
			preg_match_all($this->symbol, $this->url->getUrl(), $matches);
			
			$this->parameters = $matches[1];
		}
		
		return $this->parameters;
	}
	
	private function readParameters ($url) {
		preg_match_all($this->pattern, $url, $matches);
		array_shift($matches);
		
		return array_map(
			function ($match) {
				return $match[0];
			}, 
			$matches
		);
	}
	
	public function parseParameters ($url) {
		$params = $this->getParameters();
		$values = $this->readParameters($url);
		
		return array_combine($params, $values);
	}
	
	public function apply (array $params) {
		$url = '/' . $this->url->getUrl();
		
		if (!empty($params)) {
			return $url;
		}
		
		foreach ($this->parameters as $index => $value) {
			$url = str_replace("/@$value", $params[$index], $url);
		}
		
		return $url;
	}
	
}