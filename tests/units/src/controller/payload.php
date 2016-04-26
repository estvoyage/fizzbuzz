<?php namespace fizzbuzz\tests\units\controller;

require __DIR__ . '/../../runner.php';

use
	fizzbuzz\tests\units,
	mock\fizzbuzz as mockOfFizzbuzz
;

class payload extends units\test
{
	function testNumberIs()
	{
		$this
			->given(
				$outputValue = new mockOfFizzbuzz\output\value,

				$analyzer = new mockOfFizzbuzz\analyzer,
				$this->calling($analyzer)->analyzerControllerHasNumber = function($controller, $number) use ($outputValue) {
					$controller->outputValueOfNumberIs($outputValue);
				},

				$output = new mockOfFizzbuzz\output,

				$number = new mockOfFizzbuzz\number
			)
			->if(
				$this->newTestedInstance($analyzer, $output)
			)
			->then
				->object($this->testedInstance->numberIs($number))
					->isEqualTo($this->newTestedInstance($analyzer, $output))
				->mock($output)
					->receive('outputValueIs')
						->withIdenticalArguments($outputValue)
							->once
		;
	}
}
