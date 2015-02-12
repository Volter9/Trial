<?php namespace Trial\Core;

interface Config {
	
	public function __construct ($file);
	public function get ($key = null);
	
}