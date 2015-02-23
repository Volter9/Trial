<?php namespace Trial\Storage;

class Session implements Container {
	
	public function get ($key) {
		if (!isset($_SESSION[$key])) {
			return false;
		}
		
		return $_SESSION[$key];
	}
	
	public function set ($key, $value) {
		$_SESSION[$key] = $value;
	}
	
}