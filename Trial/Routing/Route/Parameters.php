<?php namespace Trial\Routing\Route;

use Trial\Helpers\UrlParsing;

class Parameters {
	
	private $url;
	private $parameters;
	
	private $values;
	private $pattern;
	
	public function __construct (Url $url) {
		$this->url = $url;
		$this->pattern = UrlParsing::compilePattern($url->getUrl());
		$this->parameters = UrlParsing::getTokens($url->getUrl());
		
		$this->url->setPattern($this->pattern);
	}
	
	public function parseParameters ($url) {
		if ($this->values) {
			return $this->values;
		}
		
		$values = UrlParsing::parseTokens($this->pattern, $url);
		
		return $this->values = array_combine($this->parameters, $values);
	}
		
	public function get ($key) {
		if (isset($this->values[$key])) {
			return $this->values[$key];
		}
		
		return false;
	}
	
	public function apply (array $values = []) {
		$url = '/' . $this->url->getUrl();
		
		return UrlParsing::applyValues($url, $this->parameters, $values);
	}
	
}