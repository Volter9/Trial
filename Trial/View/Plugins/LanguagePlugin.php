<?php namespace Trial\View\Plugins;

use Trial\Core\Collection;

use Trial\Injection\Container;

use Trial\View\Template;

class LanguagePlugin implements Plugin {
	
	private $language;
	
	public function __construct (Container $container) {
		$this->language = $container->get('language');
	}
	
	public function execute (Collection $arguments, Template $template) {
		return $this->language->get($arguments->first());
	}
	
	public function getName () {
		return 'lang';
	}
	
}