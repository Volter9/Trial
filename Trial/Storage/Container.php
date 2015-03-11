<?php namespace Trial\Storage;

interface Container extends Readable {
	
	public function set ($key, $value);
	
}