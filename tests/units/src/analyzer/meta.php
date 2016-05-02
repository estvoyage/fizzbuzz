<?php namespace fizzbuzz\tests\units\analyzer;

require __DIR__ . '/../../runner.php';

use
	fizzbuzz\tests\units,
	fizzbuzz\boolean,
	mock\fizzbuzz as mockOfFizzbuzz
;

class meta extends units\test
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
				$aAnalyzerOutputValue = new mockOfFizzbuzz\output\value,

				$aAnalyzer = new mockOfFizzbuzz\analyzer,

				$bAnalyzerOutputValue = new mockOfFizzbuzz\output\value,

				$bAnalyzer = new mockOfFizzbuzz\analyzer,

				$cAnalyzerOutputValue = new mockOfFizzbuzz\output\value,
				$this->calling($cAnalyzerOutputValue)->ifIsNotEmptyOutputValue = function($callable) {
					$callable();
				},

				$cAnalyzer = new mockOfFizzbuzz\analyzer,
				$this->calling($cAnalyzer)->analyzerControllerHasNumber = function($controller, $number) use ($cAnalyzerOutputValue) {
					$controller->outputValueOfNumberIs($cAnalyzerOutputValue);
				},

				$iterator = new mockOfFizzbuzz\analyzer\iterator,
				$this->calling($iterator)->recipientOfAnalyzerIs = function($recipient) use ($iterator, & $continue, $aAnalyzer, $bAnalyzer, $cAnalyzer) {
					$recipient->iteratorHasAnalyzer($iterator, $aAnalyzer);

					if ($continue)
					{
							$recipient->iteratorHasAnalyzer($iterator, $bAnalyzer);

							if ($continue)
							{
								$recipient->iteratorHasAnalyzer($iterator, $cAnalyzer);
							}
					}
				},
				$this->calling($iterator)->recipientOfAnalyzerGoAway = function() use (& $continue) {
					$continue = false;
				},

				$controller = new mockOfFizzbuzz\analyzer\controller,

				$number = new mockOfFizzbuzz\number,

				$continue = true
			)
			->if(
				$this->newTestedInstance($iterator)
			)
			->then
				->object($this->testedInstance->analyzerControllerHasNumber($controller, $number))
					->isEqualTo($this->newTestedInstance($iterator))
				->mock($controller)
					->receive('outputValueOfNumberIs')
						->withIdenticalArguments($cAnalyzerOutputValue)
							->once

			->given(
				$this->calling($aAnalyzerOutputValue)->ifIsNotEmptyOutputValue = function($callable) {
					$callable();
				},
				$this->calling($aAnalyzer)->analyzerControllerHasNumber = function($controller, $number) use ($aAnalyzerOutputValue) {
					$controller->outputValueOfNumberIs($aAnalyzerOutputValue);
				}
			)
			->if(
				$this->testedInstance->analyzerControllerHasNumber($controller, $number)
			)
			->then
				->mock($controller)
					->receive('outputValueOfNumberIs')
						->withIdenticalArguments($aAnalyzerOutputValue)
							->once

			->given(
				$aAnalyzer = new mockOfFizzbuzz\analyzer,

				$cAnalyzer = new mockOfFizzbuzz\analyzer,

				$iterator = new mockOfFizzbuzz\analyzer\iterator,

				$controller = new mockOfFizzbuzz\analyzer\controller
			)
			->if(
				$this->newTestedInstance($iterator)->analyzerControllerHasNumber($controller, $number)
			)
			->then
				->mock($controller)
					->receive('outputValueOfNumberIs')
						->never
		;
	}
}
