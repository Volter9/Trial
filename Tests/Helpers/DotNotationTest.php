<?php namespace Tests\Helpers;

use Trial\Helpers\DotNotation;

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
	 */
	public function testFalseDefaultGet ($array, $key, $default) {
		$this->assertEquals(DotNotation::get($array, $key, $default), $default);
	}
	
}