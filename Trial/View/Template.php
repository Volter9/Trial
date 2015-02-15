<?php namespace Trial\View;

use Trial\Injection\Container,
	Trial\Core\Collection;

use Trial\Routing\Http\Output,
	Trial\Routing\Http\Response;

use Trial\View\Plugins\Plugin;

use Trial\View\Template\Data;

class Template implements Output {
	
	private $app;
	private $data;
	private $view;
	
	private $plugins;
	private $mainView;
	
	public function __construct (Container $container, Data $data, $view) {
		$this->app = $container->get('app');
		$this->view = $view;
		$this->data = $data;
	}
	
	public function getData () {
		return $this->data;
	}
	
	public function render (Response $response = null) {
		$this->mainView = new View(
			$this, $this->buildPath($this->view), $this->data
		);
		
		$this->mainView->render();
	}
	
	public function renderPartial ($name, array $data = []) {
		$content = clone $this->data;
		
		$view = new View(
			$this, $this->buildPath($name), $content->merge($data)
		);
		
		$view->render();
	}
	
	protected function buildPath ($view) {
		return $this->app->buildAppPath("Views/$view");
	}
	
	public function view ($view, array $data) {
		$this->data
			->merge($data)
			->set('view', $view);
		
		return $this;
	}
	
	public function setPlugins (Plugins $plugins) {
		$this->plugins = $plugins;
	}
	
	public function __call ($plugin, $params) {
		return $this->plugins
			->get($plugin)
			->execute(new Collection($params));
	}
		
}