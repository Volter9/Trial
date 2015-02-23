<?php namespace Trial\View\Plugins;

use Trial\Core\Collection;

use Trial\Injection\Container;

use Trial\View\Template;

class AssetPlugin implements Plugin {
	
	private $builder;
	
	public function __construct (Container $container) {
		$this->builder = $container->get('routing.builder');
	}
	
	public function execute (Collection $arguments, Template $template) {
		$path = $arguments->first();
		
		return $this->builder->url("/assets/$path");
	}
	
	public function getName () {
		return 'asset';
	}
	
}