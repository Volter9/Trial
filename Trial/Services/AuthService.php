<?php namespace Trial\Services;

use Trial\Injection\Container,
	Trial\Auth\Guard;

class AuthService extends Service {
	
	public function register () {
		$this->container->set(
			'auth', new Guard($this->container)
		);
	}
	
}