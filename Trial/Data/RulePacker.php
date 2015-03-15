<?php namespace Trial\Data;

use \Exception;

class RulePacker {
	
	protected static $delimeter = '|';
	protected static $arguments = ':';
	protected static $separator = ',';
	
	public function plainPack ($rules) {
		$rules  = explode(static::$delimeter, $rules);
		$length = count($rules);
		$values = array_fill(0, $length, null);
		
		return array_combine($rules, $values);
	}
	
	public function complexPack ($rules) {
		$rules = $this->plainPack($rules);
		
		foreach ($rules as $field => $value) {
			if (!strpos($field, static::$arguments)) {
				continue;
			}
			
			list($key, $parameters) = $this->prepareComplexRule($field);

			unset($rules[$field]);
			
			$rules[$key] = $parameters;
		}
		
		return $rules;
	}
	
	protected function prepareComplexRule ($field) {
		$fragments  = explode(static::$arguments, $field);
		$parameters = explode(static::$separator, array_pop($fragments));
		
		return [current($fragments), $parameters];
	}
	
	public function packRuleSet (array $rules) {
		$self = $this;
		
		$callback = function ($value) use ($self) {
			return is_array($value) ? $value : $self->complexPack($value);
		};
		
		return array_map($callback, $rules);
	}
	
}