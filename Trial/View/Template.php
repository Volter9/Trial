<?php namespace Trial\View;

use Trial\Injection\Container,
	Trial\Core\Collection;

use Trial\Routing\Http\Output,
	Trial\Routing\Http\Response;

use Trial\View\Plugins\Plugin;

use Trial\View\Template\Data,
	Trial\View\Template\Partial;

/**
 * @method string route(string $route, ...string $parameters) Absolute URL to route
 * @method string language(string $key) Language string by key
 * @method string asset(string $path) Absolute path to asset
 * @method void   partial(string $view, array $data) View partial view
 * @package Trial
 */

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
		
		$this->view = new Partial($data, $this->path->build("Views/$view"));
		$this->view->attach($this);
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