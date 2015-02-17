<?php namespace Trial\Core;

class PathBuilder {
	
	private $base;
	private $extension;
	
	public function __construct ($base, $extension) {
		$this->base = $this->fixPath($base);
		$this->extension = $extension;
	}
	
	public function build ($path, $extension = '') {
		$extension = $extension ?: $this->extension;
		
		return "{$this->base}$path.$extension";
	}
	
	public function fixPath ($path) {
		return chop($path, '/') . '/';
	}
	
}