<?php namespace Trial\View;

use Exception;

use Trial\View\Plugins\Plugin;

class Plugins {
	
	private $plugins = [];
	
	public function register (Plugin $plugin) {
		$this->plugins[$plugin->getName()] = $plugin;
	}
	
	public function get ($name) {
		if (!isset($this->plugins[$name])) {
			throw new Exception("Plugin '$name' does not exists!");
		}
		
		return $this->plugins[$name];
	}
}