<?php

/**
 * Routes
 */

$router->add('GET /@abc', '\App\Controllers\Index', 'home');
$router->add('GET /json/format', '\App\Controllers\Index::json', 'json');
$router->add('GET /@id/@pid/@uid', '\App\Controllers\Index::cool', 'cool');

$router->setErrorRoute('GET /', '\App\Controllers\Error');