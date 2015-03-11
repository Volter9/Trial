<?php namespace Trial\DB;

interface ConnectionInterface {
	
	public function __construct (array $config);
	
	public function connect ();
	public function getLink ();
	public function query ($query, array $parameters = []);
	
}