<?php namespace Trial;

use Trial\Core\PathBuilder;

use Trial\Injection\Container,
	Trial\Injection\Factory;
	
use Trial\Routing\Dispatcher,
	Trial\Routing\Router,
	Trial\Routing\Routes,
	Trial\Routing\Http\Request,
	Trial\Routing\Http\Input,
	Trial\Routing\UrlBuilder;

use Trial\Routing\Factory as RoutingFactory;

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
		$this->systemTweaks();
		$this->setupServices();
		
		return $this;
	}
	
	/**
	 * Register factories
	 * 
	 * @param \Trial\Injection\Factory
	 */
	protected function registerFactories ($factory) {
		$factory->register('config', function ($path) {
			$app = $this->get('app');
			
			return new Config($app->getPath()->build($path));
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
		
		$container->set('configs.db', $factory->create('config', 'Configs/database'));
		$container->set('configs.app', $factory->create('config', 'Configs/app'));
	}
	
	/**
	 * Tweak the PHP system
	 */
	protected function systemTweaks () {
		include $this->path->build('Configs/bootstrap');
	}
	
	/**
	 * Setup services
	 */
	protected function setupServices () {
		$services = $this->container
			->get('configs.app')
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
		
		$router = $container->get('routing.router');
		$dispatcher = $container->get('routing.dispatcher');
		$request = $container->get('routing.request');
	
		$route = $router->route($request);
		
		$response = $dispatcher->dispatch($route, $request);
		$response->send();
	}
	
}