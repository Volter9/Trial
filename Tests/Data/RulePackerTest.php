<?php namespace Tests\Data;

use Trial\Data\RulePacker;

class RulePackerTest extends \PHPUnit_Framework_TestCase {
	
	public function plainRules () {
		return [
			['required|alpha_dash', ['required' => null, 'alpha_dash' => null]],
			['something_else|cool', ['something_else' => null, 'cool' => null]]
		];
	}
	
	public function complexRules () {
		return [
			['length:9cm,21cm', ['length' => ['9cm', '21cm']]],
			['contains:dope', ['contains' => ['dope']]]
		];
	}
	
	public function ruleSets () {
		return [
			[
				[
					'username' => 'required',
					'password' => 'required|length:4,20'
				],
				[
					'username' => [
						'required' => null
					],
					'password' => [
						'required' => null,
						'length'   => [4, 20]
					]
				]
			]
		];
	}
	
	public function mixedRuleSets () {
		return [
			[
				[
					'username' => [
						'required' => null
					],
					'password' => 'required|length:4,20'
				],
				[
					'username' => [
						'required' => null
					],
					'password' => [
						'required' => null,
						'length'   => [4, 20]
					]
				]
			]
		];
	}
	
	/**
	 * @dataProvider plainRules
	 */
	public function testPackingPlainRule ($rules, $expected) {
		$packer = new RulePacker;
		
		$this->assertEquals($packer->plainPack($rules), $expected);
	}
	
	/**
	 * @dataProvider complexRules
	 */
	public function testPackingComplexRule ($rules, $expected) {
		$packer = new RulePacker;
		
		$this->assertEquals($packer->complexPack($rules), $expected);
	}
	
	/**
	 * @dataProvider ruleSets
	 */
	public function testPackingRuleSet ($ruleSet, $expected) {
		$packer = new RulePacker;
		
		$this->assertEquals($packer->packRuleSet($ruleSet), $expected);
	}
	
	/**
	 * @dataProvider mixedRuleSets
	 */
	public function testPackingMixedRuleSet ($ruleSet, $expected) {
		$this->testPackingRuleSet($ruleSet, $expected);
	}
	
}