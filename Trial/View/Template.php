<?php namespace Trial\View;

use Trial\Injection\Container,
	Trial\Core\Collection;

use Trial\Routing\Http\Output,
	Trial\Routing\Http\Response;

use Trial\View\Plugins\Plugin;

class Template implements Output {
	
	private $app;
	private $container;
	private $data;
	private $view;
	
	private $plugins = [];
	private $mainView;
	
	public function __construct (Container $container, $view, array $data) {
		$this->app = $container->get('app');
		$this->container = $container;
		$this->data = $data;
		$this->view = $view;
	}
	
	public function render (Response $response = null) {
		if ($this->mainView) {
			throw new Exception('Template already was rendered!');
		}
		
		$view = new View(
			$this, $this->buildPath($this->view), $this->data
		);
		$this->mainView = $view;
		
		$view->render();
	}
	
	public function renderPartial ($name, array $data = []) {
		$view = new View(
			$this, $this->buildPath($name), array_merge(
				$this->mainView->getData(), $data
			)
		);
		
		$view->render();
	}
	
	protected function buildPath ($view) {
		return $this->app->buildAppPath("Views/$view");
	}
	
	public function registerPlugin (Plugin $plugin) {
		$this->plugins[$plugin->getName()] = $plugin;
	}
	
	public function __call ($plugin, $params) {
		return $this->getPlugin($plugin)->execute(
			new Collection($params)
		);
	}
	
	public function getPlugin ($name) {
		if (!isset($this->plugins[$name])) {
			throw new Exception(
				"Plugin '$name' does not exists!"
			);
		}
		
		return $this->plugins[$name];
	}
	
}