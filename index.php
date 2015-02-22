<?php

/**
 * Any cool project should have an ascii logo (not really):
 * ___________           ___             ___                 ____
 * \          \          \__\            \  \               /__  \
 *  \___    ___\ ___  ___  ___  ___  ____ \  \    ___    __    \  \
 *      \   \    \  \/ __\ \  \ \  \/ __ \ \  \   \  \  / /     \  \
 *       \   \    \   /     \  \ \    \_\ \ \  \   \  \/ / __  __\  \__
 *        \___\    \__\      \__\ \_/\_____\ \__\   \___/  \_\ \_______\
 * 
 * Bootstrap file
 * Requirements: PHP5.4+ only
 * 
 * @package Trial
 * @version 1.0
 */

version_compare(PHP_VERSION, '5.4', '>=') or die('Works on PHP5.4+ only.');

define('BASE_PATH', __DIR__ . '/');

require 'Trial/Autoloader.php';

use Trial\Autoloader,
	Trial\App\Web;

Autoloader::register();

(new Web('App'))->boot()->dispatch();