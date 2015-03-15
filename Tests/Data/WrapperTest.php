<?php namespace Tests\Data;

use Trial\Data\Wrapper;

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
	
	public function createValidationWrapper ($valid, array $errors = []) {
		$validation = $this->getMockBuilder('\Trial\Data\Validation')
			->disableOriginalConstructor()
			->getMock();
		
		$validation->method('isValid')
			->willReturn($valid);
		
		$validation->method('getErroredFields')
			->willReturn($errors);
		
		$formatter = $this->getMockBuilder('\Trial\Data\Formatter')
			->disableOriginalConstructor()
			->getMock();
		
		$formatter->method('format')
			->willReturn($errors);
		
		return new Wrapper($validation, $formatter);
	}
	
	/**
	 * @dataProvider data
	 */
	public function testValidationOfData ($rules, $data, $expected) {
		$wrapper = $this->createValidationWrapper($expected);
		
		$this->assertEquals($wrapper->validate($data), $expected);
	}
	
	public function testValdationErrors () {
		$wrapper = $this->createValidationWrapper(false, ['bullshit' => []]);
		
		$wrapper->validate([]);
		
		$this->assertCount(1, $wrapper->getErrors());
	}
	
}