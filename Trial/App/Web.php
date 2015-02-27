<?php namespace Trial\App;

use Trial\Config;

use Trial\Core\PathBuilder;

use Trial\Injection\Container,
	Trial\Injection\Factory;

/**
 * App class
 * 
 * Initializes the application
 * 
 * @package Trial
 */

class Web implements Application {
	
	/**
	 * @var \Trial\Injection\Container DI Container
	 */
	private $container;
	
	/**
	 * @var \Trial\Core\PathBuilder App path builder
	 */
	private $path;
	
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
	 * Boot the app
	 * 
	 * @return \Trial\App
	 */
	public function boot () {
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
			$builder = $this->get('app.path');
			
			return new Config($builder->build("Configs/$path"));
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
		
		$container->set('configs.app', $factory->create('config', 'app'));
	}
	
	protected function systemTweaks () {
		include $this->path->build('Configs/bootstrap');
	}
	
	protected function setupServices () {
		$services = $this->container
			->get('configs.app')
			->get('services');
		
		foreach ($services as $service) {
			$service = new $service;
			$service->register($this->container);
		}
	}
	
	public function dispatch () {
		$container = $this->container;
		
		$router  = $container->get('routing.router');
		$request = $container->get('routing.request');
		
		$route = $router->route($request);
		
		$container
			->get('routing.dispatcher')
			->dispatch($container, $route, $request)
			->send();
	}
	
}