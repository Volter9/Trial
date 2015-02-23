<?php namespace Trial\Storage;

interface Container {
	
	public function get ($key);
	public function set ($key, $value);
	
}