<?php namespace Trial\Services;

use Trial\Injection\Container;
	
use Trial\DB\ORM\Factory;

class MapperService extends Service {
	
	public function register () {
		$factory = new Factory($this->container);
		
		$this->container->set('orm', $factory);
	}
	
}