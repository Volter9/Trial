<?php namespace Trial\DB\Repository;

interface Model {
	
	/**
	 * @return array
	 */
	public function export ();
	
	/**
	 * @param array $data
	 */
	public function import (array $data);
	
}