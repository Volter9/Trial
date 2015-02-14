<?php namespace Tests;

use Trial\Core\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase {
	
	public function testCreation () {
		$collection = new Collection(range(1, 10));
		
		$this->assertCount(10, $collection);
	}
	
	public function names () {
		return ['Peter', 'Jack', 'Olivia', 'Stacey', 'Skyler'];
	}
	
	public function testFirstAndLast () {
		$names = new Collection($this->names());
		
		$this->assertEquals($names->first(), 'Peter');
		$this->assertEquals($names->last(), 'Skyler');
	}
	
	public function testPopAndAppend () {
		$stack = new Collection(range(20, 30));
		
		$this->assertEquals($stack->pop(), 30);
		
		$stack->append(30);
		
		$this->assertEquals($stack->last(), 30);
		
		return $stack;
	}
	
	/**
	 * @depends testPopAndAppend
	 */
	public function testShiftAndPrepend ($stack) {
		$this->assertEquals($stack->shift(), 20);
		
		$stack->prepend(20);
		
		$this->assertEquals($stack->first(), 20);
		
		return $stack;
	}
	
	/**
	 * @depends testShiftAndPrepend
	 */
	public function testCount ($stack) {
		$this->assertCount(11, $stack);
	}
	
}