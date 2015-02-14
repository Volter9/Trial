<?php namespace Trial\Routing\Route;

class Parameters {
	
	private $url;
	private $parameters;
	
	private $pattern;
	private $symbol = '/@([\w\d-_]+)/';
	private $any = '([\w\d-_]+)';
	
	public function __construct (Url $url) {
		$this->url = $url;
		$this->pattern = $this->compilePattern($url->getUrl());
		$this->url->setPattern($this->pattern);
	}
	
	private function compilePattern ($url) {
		$url = preg_replace($this->symbol, $this->any, $url);
		
		return "#^$url$#i";
	}
	
	public function parseParameters ($url) {
		if (!$this->parameters) {
			$keys = $this->getParameters();
			$values = $this->readParameters($url);
			
			$this->parameters = array_combine($keys, $values);
		}
		
		return $this->parameters;
	}
	
	private function getParameters () {
		preg_match_all($this->symbol, $this->url->getUrl(), $matches);
		
		return $matches[1];
	}
	
	private function readParameters ($url) {
		preg_match_all($this->pattern, $url, $matches);
		array_shift($matches);
		
		return array_map(function ($match) {
			return $match[0];
		}, $matches);
	}
	
	public function get ($key) {
		if (isset($this->parameters[$key])) {
			return $this->parameters[$key];
		}
		
		return false;
	}
	
	public function apply (array $params) {
		$url = '/' . $this->url->getUrl();
		
		if (!empty($params)) {
			return $url;
		}
		
		foreach (array_keys($this->parameters) as $index => $value) {
			$url = str_replace("/@$value", $params[$index], $url);
		}
		
		return preg_replace('/\/{2,}/', '/', $url);
	}
	
}