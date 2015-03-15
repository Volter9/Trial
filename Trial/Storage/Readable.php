<?php namespace Trial\Storage;

interface Readable {
	
	/**
	 * @param string $key
	 * @param mixed  $default
	 * @return mixed
	 */
	public function get ($key, $default = null);
	
}