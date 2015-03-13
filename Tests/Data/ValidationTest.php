<?php namespace Tests\Data;

use Trial\Data\Validation,
	Trial\Data\Validators;

class ValidationTest extends \PHPUnit_Framework_TestCase {
	
	public function rules () {
		return [
			'username' => [
				'required'  => [],
				'alphadash' => [],
				'length'    => [4, 20],
			],
			'password' => [
				'required'  => [],
				'alphadash' => [],
				'length'    => [4, 20],
			]
		];
	}
	
	public function validData () {
		return [
			[
				[
					'username' => 'volter9',
					'password' => '1234569'
				]
			]
		];
	}
	
	public function invalidData () {
		return [
			[
				[
					'username' => 'volter$#12313 312 23123 9',
					'password' => ''
				]
			]
		];
	}
	
	public function nonExistentData () {
		return [
			[[]],
			[['username' => 'something']],
			[['password' => 'dasdasdsa']]
		];
	}
	
	public function extraFieldData () {
		return [
			[
				[
					'username' => 'someones', 
					'password' => '1234', 
					'extra' => '10'
				]
			],
			[
				[
					'username' => 'elseproblem', 
					'password' => '5678', 
					'another_field' => '42'
				]
			]
		];
	}
	
	public function createValidation () {
		return new Validation(
			$this->rules(),
			new Validators(Config::validators())
		);
	}
	
	/**
	 * @dataProvider validData
	 */
	public function testValidData ($data) {
		$validation = $this->createValidation();
		
		$this->assertTrue($validation->isValid($data));
	}
	
	/**
	 * @dataProvider invalidData
	 */
	public function testInvalidData ($data) {
		$validation = $this->createValidation();
		
		$this->assertFalse($validation->isValid($data));
	}
	
	/**
	 * @dataProvider extraFieldData
	 */
	public function testValidDataWithExtraFields ($data) {
		$this->testValidData($data);
	}
	
	/**
	 * @dataProvider nonExistentData
	 */
	public function testNonExistentFields ($data) {
		$this->testInvalidData($data);
	}
	
	/**
	 * @dataProvider invalidData
	 */
	public function testErrorFields ($data) {
		$validation = $this->createValidation();
		$validation->isValid($data);
		
		$this->assertCount(2, $validation->getErroredFields());
	}
	
}