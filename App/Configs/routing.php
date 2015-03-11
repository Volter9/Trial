<?php

use Trial\Routing\Routes,
	Trial\Routing\RoutesFactory;

/**
 * Define your routes here
 * 
 * @package Trial
 * @var \Trial\Core\PathBuilder $path
 */

$routes = new Routes;
$factory = new RoutesFactory($routes);

$config = include $path->build('Configs/routes');

$factory->import($config);

return $routes;