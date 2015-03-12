<?php namespace Tests\Data;

use Trial\Data\Validation;

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
	
	public function validators () {
		return [
			'required' => function ($value) {
				return !!$value;
			},
			
			'length' => function ($value, $key, $min, $max) {
				$min = $min === ''   ? 0           : (int)$min;
				$max = $max === null ? PHP_INT_MAX : (int)$max;
				
				$length = strlen($value);
				
				return $length <= $max && $length >= $min; 
			},
			
			'alphadash' => function ($value) {
				return (bool)preg_match('/^[\w\d\-\_]+$/i', $value);
			}
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
	
	public function createValidation () {
		return new Validation(
			$this->rules(),
			$this->validators()	
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
	 * @dataProvider invalidData
	 */
	public function testErrorFields ($data) {
		$validation = $this->createValidation();
		$validation->isValid($data);
		
		$this->assertCount(2, $validation->getErroredFields());
	}
	
}