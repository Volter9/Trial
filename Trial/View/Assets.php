<?php namespace Trial\View;

use Trial\Injection\Container;

class Assets {
	
	private $assets;
	
	public function __construct (Container $container) {
		$this->assets = $container->get('configs.app')->get('assets');
	}
	
	public function buildPath ($asset) {
		return $this->assets . $asset;
	}
	
}