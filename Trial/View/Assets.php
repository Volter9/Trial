<?php namespace Trial\View;

class Assets {
	
	private $app;
	
	public function __cosntruct (Container $container) {
		$this->app = $container->get('app');
	}
	
	public function css () {
		
	}
	
}