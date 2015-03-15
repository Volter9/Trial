<?php namespace Trial\View;

use Trial\Core\Collection;

use Trial\Routing\Http\Output,
	Trial\Routing\Http\Response;

use Trial\View\Template\Partial;

/**
 * @method string route(string $route, ...string $parameters) Absolute URL to route
 * @method string language(string $key) Language string by key
 * @method string asset(string $path) Absolute path to asset
 * @method void   partial(string $view, array $data) View partial view
 * @package Trial
 */

class Template implements Output {
	
	private $plugins;
	private $view;
	
	public function __construct (
		Plugins $plugins, 
		Partial $view
	) {
		$this->plugins = $plugins;
		
		$this->view = $view;
		$this->view->attach($this);
	}
	
	public function getData () {
		return $this->view->getData();
	}
	
	public function render (Response $response = null) {
		$this->view->render();
	}
	
	public function view ($view, array $data) {
		$viewData = $this->getData();
		
		$viewData->merge($data);
		$viewData->set('view', $view);
		
		return $this;
	}
	
	public function __call ($plugin, $params) {		
		$params = new Collection($params);
		
		return $this->plugins
			->get($plugin)
			->execute($params, $this);
	}
		
}