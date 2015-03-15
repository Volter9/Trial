<?php namespace Trial\Storage;

class Session extends Memory {
	
	public function __destruct () {
		$_SESSION = $this->data;
	}
	
}