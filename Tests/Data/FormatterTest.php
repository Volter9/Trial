<?php namespace Tests\Data;

use Trial\Data\Formatters\Basic;

class FormatterTest extends \PHPUnit_Framework_TestCase {
	
	public function erroredFields () {
		return [
			[
				['username' => ['required' => []]],
				['username' => [
					sprintf(
						Config::$messages['required'], 
						Config::$fields['username']
					),
				]]
			],
			[
				[
					'username' => ['required' => []],
					'password' => ['required' => [], 'length' => [10, 20]]
				],
				[
					'username' => [
						sprintf(
							Config::$messages['required'], 
							Config::$fields['username']
						)
					],
					'password' => [
						sprintf(
							Config::$messages['required'], 
							Config::$fields['password']
						),
						sprintf(
							Config::$messages['length'], 
							Config::$fields['password'], 10, 20
						),
					]
				]
			]	
		];
	}
	
	/**
	 * @dataProvider erroredFields
	 */
	public function testFormatting ($errors, $expected) {
		$basic = new Basic(Config::$messages, Config::$fields);
		
		$this->assertEquals($basic->format($errors), $expected);
	}
	
}