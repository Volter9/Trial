<?php namespace Tests\Data;

use Trial\Data\RulePacker,
	Trial\Data\Validation,
	Trial\Data\Validators,
	Trial\Data\Wrapper;

use Trial\Data\Formatters\Basic;

class WrapperTest extends \PHPUnit_Framework_TestCase {
	
	public function data () {
		return [
			[
				['username' => 'required', 'password' => 'length:4,20'],
				['username' => 'volter9', 'password' => '1234'],
				true
			],
			[
				['username' => 'required', 'password' => 'length:4,20'],
				['username' => '', 'password' => '123'],
				false
			]	
		];
	}
	
	public function createValidationWrapper (array $rules) {
		$packer = new RulePacker;
		$validators = new Validators(Config::validators());
		
		$validation = new Validation(
			$packer->packRuleSet($rules), 
			$validators
		);
		
		return new Wrapper($validation, $this->createFormatter());
	}
	
	public function createFormatter () {
		return new Basic (
			Config::$messages,
			Config::$fields
		);
	}
	
	/**
	 * @dataProvider data
	 */
	public function testValidationOfData ($rules, $data, $expected) {
		$wrapper = $this->createValidationWrapper($rules);
		
		$this->assertEquals($wrapper->validate($data), $expected);
	}
	
	public function testValdationErrors () {
		$wrapper = $this->createValidationWrapper([
			'bullshit' => 'required|alphadash'
		]);
		$wrapper->validate([]);
		
		$this->assertCount(1, $wrapper->getErrors());
	}
	
}