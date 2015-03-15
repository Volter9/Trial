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
		$view = $arguments->shift();
		$data = $arguments->first() ?: [];
		
		$content = clone $template->getData();
		$content->merge($data);
		
		$view = new Partial($content, $this->path->build("Views/$view"));
		$view->attach($template);
		$view->render();
	}
	
	public function getName () {
		return 'partial';
	}
	
}