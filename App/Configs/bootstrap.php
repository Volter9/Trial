<?php

/**
 * Bootstrap file
 * 
 * @package Trial
 */

ob_start();

ini_set('display_errors', 1);
error_reporting(-1);

set_error_handler(function ($code, $message, $file, $line) {
	$message = "$message in file '$file' at line $line";
	
	throw new Exception($message);
});

date_default_timezone_set('Europe/Moscow');