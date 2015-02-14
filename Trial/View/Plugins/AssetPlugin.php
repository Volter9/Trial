<?php namespace Trial\View\Plugins;

use Trial\Core\Collection;

use Trial\Injection\Container;

use Trial\View\Assets;

class AssetPlugin implements Plugin {
	
	private $assets;
	
	public function __construct (Container $container) {
		$this->assets = new Assets($container);
	}
	
	public function execute (Collection $arguments) {
		return $this->assets->buildPath($arguments->first());
	}
	
	public function getName () {
		return 'asset';
	}
	
}