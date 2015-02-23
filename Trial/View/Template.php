<?php namespace Trial\View;

use Trial\Injection\Container,
	Trial\Core\Collection;

use Trial\Routing\Http\Output,
	Trial\Routing\Http\Response;

use Trial\View\Plugins\Plugin;

use Trial\View\Template\Data,
	Trial\View\Template\Partial;

class Template implements Output {
	
	private $path;
	
	private $plugins;
	private $view;
	
	public function __construct (
		Container $container, 
		Plugins $plugins, 
		Data $data, 
		$view
	) {
		$this->path = $container->get('app.path');
		$this->plugins = $plugins;
		
		$this->view = new Partial($this, $data, $this->path->build("Views/$view"));
	}
	
	public function getData () {
		return $this->view->getData();
	}
	
	public function render (Response $response = null) {
		$this->view->render();
	}
	
	public function view ($view, array $data) {
		$this->getData()
			->merge($data)
			->set('view', $view);
		
		return $this;
	}
	
	public function __call ($plugin, $params) {
		return $this->plugins
			->get($plugin)
			->execute(new Collection($params), $this);
	}
		
}