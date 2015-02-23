<?php namespace Trial\View\Plugins;

use Trial\Core\Collection;

use Trial\Injection\Container;

use Trial\View\Template,
	Trial\View\Template\Partial;

class PartialPlugin implements Plugin {
	
	private $path;
	
	public function __construct (Container $container) {
		$this->path = $container->get('app.path');
	}
	
	public function execute (Collection $arguments, Template $template) {
		$content = clone $template->getData();
		
		$view = $arguments->shift();
		$data = $arguments->first() ?: [];
		
		$view = new Partial(
			$template, $content->merge($data), $this->path->build("Views/$view")
		);
		
		$view->render();
	}
	
	public function getName () {
		return 'partial';
	}
	
}