<?php namespace Trial\Helpers;

class UrlParsing {
	
	static public $symbol = '/@([\w\d-_]+)/';
	static public $anyToken = '([\w\d-_]+)';
	
	static public function compilePattern ($url) {
		$url = preg_replace(self::$symbol, self::$anyToken, $url);
		
		return "#^$url$#i";
	}
	
	static public function getTokens ($url) {
		preg_match_all(self::$symbol, $url, $matches);
		
		return $matches[1];
	}
	
	static public function parseTokens ($pattern, $url) {
		preg_match_all($pattern, $url, $matches);
		
		array_shift($matches);
		
		return array_map(
			function ($match) {
				return $match[0];
			}, 
			$matches
		);
	}
	
	static public function applyValues ($url, array $parameters, array $values) {
		foreach ($parameters as $index => $value) {
			$url = str_replace("/@$value", "/$values[$index]", $url);
		}
		
		return static::trimSlashes($url);
	}
	
	static public function trimSlashes ($path) {
		return preg_replace('/\/{2,}/', '/', $path);
	}
	
}