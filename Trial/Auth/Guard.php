<?php namespace Trial\Auth;

use Trial\Injection\Container;

class Guard {
	
	private $rules;
	private $user;
	
	public function __construct (Container $container) {
		$this->container = $container;
	}
	
	public function logIn (Entity $user, RuleSet $rules) {
		$this->user = $user;
		$this->rules = $rules;
	}
	
	public function isLoggedIn () {
		return $this->user !== null
			&& $this->rules !== null;
	}
	
	public function user () {
		return $this->user;
	}
	
	public function rules () {
		return $this->rules;
	}
	
}