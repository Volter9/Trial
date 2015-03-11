<?php namespace Trial\Storage;

interface Readable {
	
	public function get ($key, $default = null);
	
}