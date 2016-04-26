<?php namespace fizzbuzz\tests\units\analyzer;

require __DIR__ . '/../../runner.php';

use
	fizzbuzz\tests\units,
	fizzbuzz\output,
	mock\fizzbuzz as mockOfFizzbuzz
;

class concatenator extends units\test
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
				$aAnalyzerOutputValue = new output\value('a'),

				$aAnalyzer = new mockOfFizzbuzz\analyzer,
				$this->calling($aAnalyzer)->analyzerControllerHasNumber = function($controller, $number) use ($aAnalyzerOutputValue) {
					$controller->outputValueOfNumberIs($aAnalyzerOutputValue);
				},

				$bAnalyzerOutputValue = new output\value('b'),

				$bAnalyzer = new mockOfFizzbuzz\analyzer,
				$this->calling($bAnalyzer)->analyzerControllerHasNumber = function($controller, $number) use ($bAnalyzerOutputValue) {
					$controller->outputValueOfNumberIs($bAnalyzerOutputValue);
				},

				$cAnalyzerOutputValue = new output\value('c'),

				$cAnalyzer = new mockOfFizzbuzz\analyzer,
				$this->calling($cAnalyzer)->analyzerControllerHasNumber = function($controller, $number) use ($cAnalyzerOutputValue) {
					$controller->outputValueOfNumberIs($cAnalyzerOutputValue);
				},

				$iterator = new mockOfFizzbuzz\analyzer\iterator,
				$this->calling($iterator)->recipientOfAnalyzerIs = function($recipient) use ($iterator, $aAnalyzer, $bAnalyzer, $cAnalyzer) {
					$recipient->iteratorHasAnalyzer($iterator, $aAnalyzer);
					$recipient->iteratorHasAnalyzer($iterator, $bAnalyzer);
					$recipient->iteratorHasAnalyzer($iterator, $cAnalyzer);
				},

				$controller = new mockOfFizzbuzz\analyzer\controller,

				$number = new mockOfFizzbuzz\number
			)
			->if(
				$this->newTestedInstance($iterator)
			)
			->then
				->object($this->testedInstance->analyzerControllerHasNumber($controller, $number))
					->isEqualTo($this->newTestedInstance($iterator))
				->mock($controller)
					->receive('outputValueOfNumberIs')
						->withArguments(new output\value('abc'))
							->once

			->given(
				$bAnalyzer = new mockOfFizzbuzz\analyzer,

				$iterator = new mockOfFizzbuzz\analyzer\iterator,
				$this->calling($iterator)->recipientOfAnalyzerIs = function($recipient) use ($iterator, $aAnalyzer, $bAnalyzer, $cAnalyzer) {
					$recipient->iteratorHasAnalyzer($iterator, $aAnalyzer);
					$recipient->iteratorHasAnalyzer($iterator, $bAnalyzer);
					$recipient->iteratorHasAnalyzer($iterator, $cAnalyzer);
				}
			)
			->if(
				$this->newTestedInstance($iterator)->analyzerControllerHasNumber($controller, $number)
			)
			->then
				->mock($controller)
					->receive('outputValueOfNumberIs')
						->withArguments(new output\value('ac'))
							->once

			->given(
				$iterator = new mockOfFizzbuzz\analyzer\iterator
			)
			->if(
				$this->newTestedInstance($iterator)->analyzerControllerHasNumber($controller, $number)
			)
			->then
				->mock($controller)
					->receive('outputValueOfNumberIs')
						->withArguments(new output\value)
							->once
		;
	}
}
