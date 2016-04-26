<?php namespace fizzbuzz\tests\units\analyzer;

require __DIR__ . '/../../runner.php';

use
	fizzbuzz\tests\units,
	fizzbuzz\output,
	fizzbuzz\number,
	fizzbuzz\boolean,
	mock\fizzbuzz as mockOfFizzbuzz
;

class composite extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('fizzbuzz\analyzer')
			->implements('fizzbuzz\analyzer\controller')
			->implements('fizzbuzz\output\value\recipient')
			->implements('fizzbuzz\analyzer\iterator\recipient')
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

				$analyzerIterator = new mockOfFizzbuzz\analyzer\iterator,
				$this->calling($analyzerIterator)->recipientOfAnalyzerIs = function($recipient) use ($analyzerIterator, $aAnalyzer, $bAnalyzer, & $continue) {
					$recipient->iteratorHasAnalyzer($analyzerIterator, $aAnalyzer);

					$continue->ifTrue(function() use ($recipient, $analyzerIterator, $bAnalyzer) {
							$recipient->iteratorHasAnalyzer($analyzerIterator, $bAnalyzer);
						}
					);
				},
				$this->calling($analyzerIterator)->booleanAboutContinuationOfIterationIs = function($boolean) use (& $continue) {
					$continue = $boolean;
				},

				$controller = new mockOfFizzbuzz\analyzer\controller,
				$controllerNumber = new number,

				$continue = new boolean\true
			)
			->if(
				$this->newTestedInstance($analyzerIterator)
			)
			->then
				->object($this->testedInstance->analyzerControllerHasNumber($controller, $controllerNumber))
					->isEqualTo($this->newTestedInstance($analyzerIterator))
				->mock($controller)
					->receive('outputValueOfNumberIs')
						->withArguments(new output\value('ab'))
							->once

			->given(
				$controller = new mockOfFizzbuzz\analyzer\controller,
				$this->calling($bAnalyzer)->analyzerControllerHasNumber->doesNothing
			)
			->if(
				$this->testedInstance->analyzerControllerHasNumber($controller, $controllerNumber)
			)
			->then
				->mock($controller)
					->receive('outputValueOfNumberIs')
						->never
		;
	}
}
