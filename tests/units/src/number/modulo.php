<?php namespace fizzbuzz\tests\units\number;

require __DIR__ . '/../../runner.php';

use
	fizzbuzz\tests\units
;

class modulo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('fizzbuzz\number')
		;
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testWithInvalidValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance($value); })
				->isInstanceOf('domainException')
				->hasMessage('Modulo should be an integer not equal to 0')
		;
	}

	protected function invalidValueProvider()
	{
		return [
			true,
			false,
			null,
			'foo' . uniqid(),
			M_PI,
			[ [] ],
			new \stdclass,
			0,
			0.
		];
	}
}
