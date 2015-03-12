<?php namespace Tests\Data;

use Trial\Data\Formatters\Basic;

class FormatterTest extends \PHPUnit_Framework_TestCase {
	
	private $messages = [
		'required'  => 'The field "%s" is required!',
		'alphadash' => 'The field "%s" should be an alpha numeric!',
		'length'    => 'The field "%s" should be between %s and %s!'
	];
	
	private $fields = [
		'username' => 'Cool user name',
		'password' => 'Unique ID of Swagger'
	];
	
	public function erroredFields () {
		return [
			[
				['username' => ['required' => []]],
				['username' => [
					sprintf($this->messages['required'], $this->fields['username']),
				]]
			],
			[
				[
					'username' => ['required' => []],
					'password' => ['required' => [], 'length' => [10, 20]]
				],
				[
					'username' => [
						sprintf($this->messages['required'], $this->fields['username'])
					],
					'password' => [
						sprintf($this->messages['required'], $this->fields['password']),
						sprintf($this->messages['length']  , $this->fields['password'], 10, 20),
					]
				]
			]	
		];
	}
	
	/**
	 * @dataProvider erroredFields
	 */
	public function testFormatting ($errors, $expected) {
		$basic = new Basic($this->messages, $this->fields);
		
		$this->assertEquals($basic->format($errors), $expected);
	}
	
}