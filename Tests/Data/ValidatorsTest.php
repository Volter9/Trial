<?php namespace Tests\Data;

use Trial\Data\Validators;

class ValidatorsTest extends \PHPUnit_Framework_TestCase {
	
	public function validators () {
		return [
			['new', function ($value) {
				return true;	
			}]
		];
	}
	
	/**
	 * @dataProvider validators
	 */
	public function testAddingValidator ($key, $validator) {
		$validators = new Validators(Config::validators());
		$validators->add($key, $validator);
		
		$this->assertEquals($validators->get($key), $validator);
	}
	
	/**
	 * @expectedException \Exception
	 */
	public function testGettingNonExistentValidators () {
		$validators = new Validators(Config::validators());
		$validators->get('bullshit_validator');
	}
	
	public function testInvokingValidator () {
		$validators = new Validators(Config::validators());
		
		$this->assertTrue(
			$validators->invoke('required', ['hello'])
		);
	}
	
}