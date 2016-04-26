<?php namespace fizzbuzz\tests\units\output;

require __DIR__ . '/../../runner.php';

use
	fizzbuzz\tests\units,
	fizzbuzz
;

class stdout extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('fizzbuzz\output')
		;
	}

	function testOutputValueIs()
	{
		$this
			->given(
				$outputValue = new fizzbuzz\output\value(uniqid())
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->output(function() use ($outputValue) { $this->testedInstance->outputValueIs($outputValue); })
					->isEqualTo($outputValue . PHP_EOL)
		;
	}
}
