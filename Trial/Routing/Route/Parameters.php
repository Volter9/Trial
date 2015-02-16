<?php namespace Trial\Routing\Route;

use Trial\Helpers\UrlParsing;

class Parameters {
	
	private $url;
	private $parameters;
	
	private $pattern;
	private $symbol = '/@([\w\d-_]+)/';
	private $any = '([\w\d-_]+)';
	
	public function __construct (Url $url) {
		$this->url = $url;
		$this->pattern = UrlParsing::compilePattern($url->getUrl());
		$this->parameters = UrlParsing::getTokens($url->getUrl());
		
		$this->url->setPattern($this->pattern);
	}
	
	public function parseParameters ($url) {
		$values = UrlParsing::parseTokens($this->pattern, $url);
		
		return array_combine($this->parameters, $values);
	}
		
	public function get ($key) {
		if (isset($this->parameters[$key])) {
			return $this->parameters[$key];
		}
		
		return false;
	}
	
	public function apply (array $values) {
		$url = '/' . $this->url->getUrl();
		
		if (empty($values)) {
			return $url;
		}
		
		return UrlParsing::applyValues($url, $this->parameters, $values);
	}
	
}