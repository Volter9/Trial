<?php namespace Trial;

use Trial\Core\PathBuilder;

use Trial\Injection\Container,
	Trial\Injection\Factory;
	
use Trial\Routing\Dispatcher,
	Trial\Routing\Router,
	Trial\Routing\Routes,
	Trial\Routing\Http\Request,
	Trial\Routing\Http\Input;
	
use Trial\View\Template;

/**
 * App class
 * 
 * Initializes the application
 */

class App {
	
	/**
	 * @var \Trial\Injection\Container DI Container
	 */
	private $container;
	
	/**
	 * @var \Trial\Core\PathBuilder App path builder
	 */
	private $path;
	
	/**
	 * @var boolean is application running
	 */
	private $running = false;
	
	/**
	 * App's constructor
	 * 
	 * @param string $path
	 * @param \Trial\Injection\Container $container
	 */
	public function __construct ($path, Container $container = null) {
		$container = $container ?: new Container;
		$factory = new Factory($container);
		
		$this->container = $container;
		$this->container->setFactory($factory);
		
		$this->path = new PathBuilder($path, 'php');
	}
	
	/**
	 * Get path of app
	 * 
	 * @return string
	 */
	public function getPath () {
		return $this->path;
	}
	
	/**
	 * Boot the app
	 * 
	 * @return \Trial\App
	 */
	public function boot () {
		if ($this->running) {
			throw new Exception('Cannot run the app again!');
		}
		
		$this->running = true;
		
		$container = $this->container;
		$factory = $container->factory();
		
		$this->registerFactories($factory);
		$this->registerConfigs($container, $factory);
		$this->tweak();
		$this->setupServices();
		
		return $this;
	}
	
	/**
	 * Register factories
	 * 
	 * @todo extract this method
	 * @param \Trial\Injection\Factory
	 */
	protected function registerFactories ($factory) {
		$factory->register('config', function ($path) {
			$app = $this->get('app');
			
			return new Config($app->getPath()->build($path));
		});
		
		$factory->register('input', function () {
			$arrays = [
				'get' => $_GET,
				'post' => $_POST,
				'server' => $_SERVER
			];
			
			return new Input($arrays, getallheaders());
		});
		
		$factory->register('request', function () {
			return Request::withInput($this->factory()->create('input'));
		});
	}
	
	/**
	 * Get configs and configure
	 * 
	 * @param \Trial\Injection\Container $container
	 * @param \Trial\Injection\Factory $factory
	 */
	protected function registerConfigs ($container, $factory) {
		$container->set('app', $this);
		$container->set('app.path', $this->path);
		
		$container->set('config.db', $factory->create('config', 'Configs/database'));
		$container->set('config.app', $factory->create('config', 'Configs/app'));
		
		$container->set('routes', include $this->path->build('Configs/routes'));
	}
	
	/**
	 * Tweak the PHP system
	 */
	protected function tweak () {
		include $this->path->build('Configs/bootstrap');
	}
	
	/**
	 * Setup services
	 */
	protected function setupServices () {
		$services = $this->container
			->get('config.app')
			->get('services');
		
		foreach ($services as $service) {
			$service = new $service;
			$service->register($this->container);
		}
	}
	
	/**
	 * Dispatch the request
	 */
	public function dispatch () {
		$container = $this->container;
		$factory = $container->factory();
		
		$router = new Router($container->get('routes'));
		$dispatcher = new Dispatcher($container);
		
		$request = $factory->create('request');
		$route = $router->route($request);
		
		$dispatcher->dispatch($route, $request)->send();
	}
	
}