<?php namespace Tests\Helpers;

use Trial\Helpers\DotNotation;

/**
 * @coversDefaultClass \Trial\Helpers\DotNotation
 */
class DotNotationTest extends \PHPUnit_Framework_TestCase {
	
	public function getData () {
		return [
			[
				['foo' => ['bar' => 'cool']],
				'foo.bar', 'cool'
			],
			[
				['baz' => ['cool' => ['bar' => 'cool']]],
				'baz.cool.bar', 'cool'
			]
		];
	}
	
	/**
	 * @dataProvider getData
	 * @covers ::get
	 */
	public function testGet ($array, $key, $expected) {
		$this->assertEquals(DotNotation::get($array, $key), $expected);
	}
	
	public function setData () {
		return [
			['foo.bar.cool.school', 'tron'],
			['baz.bar.cool.doll', 'something']
		];
	}
	
	/**
	 * @dataProvider setData
	 * @covers ::set
	 * @covers ::get
	 */
	public function testSet ($key, $expected) {
		$array = [];
		
		DotNotation::set($array, $key, $expected);
		
		$this->assertEquals(DotNotation::get($array, $key), $expected);
	}
	
	public function getFalseData () {
		return [
			[[], 'foo.bar.baz'],
			[['foor' => 'bar'], 'cool.man.strong']
		];
	}
	
	/**
	 * @dataProvider getFalseData
	 * @covers ::set
	 */
	public function testFalseGet ($array, $key) {
		$this->assertFalse(DotNotation::get($array, $key));
	}
	
	public function getFalseDataWithDefault () {
		return [
			[[], 'foo.bar.baz', 'happens'],
			[['foor' => 'bar'], 'cool.man.strong', 'shit!']
		];
	}
	
	/**
	 * @dataProvider getFalseDataWithDefault
	 * @covers ::get
	 */
	public function testFalseDefaultGet ($array, $key, $default) {
		$this->assertEquals(DotNotation::get($array, $key, $default), $default);
	}
	
	/**
	 * @covers ::set
	 * @covers ::get
	 */
	public function testOptimizedGetAndSet () {
		$array = ['foo' => 'abc'];
		$key = 'foo';
		$value = 'bar';
		
		DotNotation::set($array, $key, $value);
		
		$this->assertEquals(DotNotation::get($array, $key), $value);
	}
	
}