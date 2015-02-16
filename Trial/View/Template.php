<?php namespace Trial\View;

use Trial\Injection\Container,
	Trial\Core\Collection;

use Trial\Routing\Http\Output,
	Trial\Routing\Http\Response;

use Trial\View\Plugins\Plugin;

use Trial\View\Template\Data;

class Template implements Output {
	
	private $app;
	
	private $plugins;
	private $view;
	
	public function __construct (
		Container $container, 
		Plugins $plugins, 
		Data $data, 
		$view
	) {
		$this->app = $container->get('app');
		$this->plugins = $plugins;
		
		$this->view = new View(
			$this, $this->buildPath($view), $data
		);
	}
	
	public function getData () {
		return $this->view->getData();
	}
	
	public function render (Response $response = null) {
		$this->view->render();
	}
	
	public function partial ($name, array $data = []) {
		$content = clone $this->view->getData();
		
		$view = new View(
			$this, $this->buildPath($name), $content->merge($data)
		);
		
		$view->render();
	}
	
	protected function buildPath ($view) {
		return $this->app->buildAppPath("Views/$view");
	}
	
	public function view ($view, array $data) {
		$this->view
			->getData()
			->merge($data)
			->set('view', $view);
		
		return $this;
	}
	
	public function __call ($plugin, $params) {
		return $this->plugins
			->get($plugin)
			->execute(new Collection($params));
	}
		
}