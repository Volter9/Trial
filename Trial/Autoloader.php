<?php namespace Trial;

/**
 * Auto loader class
 * 
 * Registers SPL autoloader which is faster than custom function
 * 
 * @package Trial
 */

class Autoloader {
	
	/**
	 * Register autoloader
	 * 
	 * @link http://php.net/manual/ru/function.spl-autoload-register.php#92514
	 */
	static public function register () {
		spl_autoload_extensions('.php');
		spl_autoload_register();
	}

}