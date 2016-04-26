<?php namespace fizzbuzz\tests\units\analyzer;

require __DIR__ . '/../../runner.php';

use
	fizzbuzz\tests\units,
	mock\fizzbuzz as mockOfFizzbuzz
;

class transparent extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('fizzbuzz\analyzer')
		;
	}

	function testAnalyzerControllerHasNumber()
	{
		$this
			->given(
				$controller = new mockOfFizzbuzz\analyzer\controller,

				$outputValue = new mockOfFizzbuzz\output\value,

				$number = new mockOfFizzbuzz\number,
				$this->calling($number)->recipientOfOutputValueIs = function($recipient) use ($outputValue) {
					$recipient->outputValueIs($outputValue);
				}
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->analyzerControllerHasNumber($controller, $number))
					->isEqualTo($this->newTestedInstance)
				->mock($controller)
					->receive('outputValueOfNumberIs')
						->withIdenticalArguments($outputValue)
							->once
		;
	}
}
