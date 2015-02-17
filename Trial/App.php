<?php namespace Trial;

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
	 * @var string Path to app
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
		
		$this->path = $path;
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
	 * Build a path to app
	 * 
	 * @todo "that's not your responsibility, son"
	 * @param string $file
	 * @param string $ext
	 * @return string
	 */
	public function buildAppPath ($file, $ext = 'php') {
		return BASE_PATH . "{$this->path}/{$file}.{$ext}";
	}
	
	/**
	 * Boot the app
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
	 * @todo remove that method
	 * @param \Trial\Injection\Factory
	 */
	protected function registerFactories ($factory) {
		$factory->register('config', function ($path) {
			$app = $this->get('app');
			
			return new Config($app->buildAppPath($path));
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
		
		$container->set('config.db', $factory->create('config', 'Configs/database'));
		$container->set('config.app', $factory->create('config', 'Configs/app'));
		$container->set('config.routing', $factory->create('config', 'Configs/routing'));
		
		$container->set('routes', include $this->buildAppPath('Configs/routes'));
	}
	
	/**
	 * Tweak the PHP system
	 */
	protected function tweak () {
		include $this->buildAppPath('Configs/bootstrap');
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
		
		$request = $container->factory()->create('request');
		
		$router = new Router($container);
		$router->setRoutes($container->get('routes'));
		
		$route = $router->route($request);
		
		$dispatcher = new Dispatcher($container);
		$dispatcher->dispatch($route, $request)->send();
		
		return $this;
	}
	
}