<?php namespace fizzbuzz\tests\units\analyzer\iterator;

require __DIR__ . '/../../../runner.php';

use
	fizzbuzz\tests\units,
	fizzbuzz\boolean,
	mock\fizzbuzz as mockOfFizzbuzz
;

class fifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('fizzbuzz\analyzer\iterator')
		;
	}

	function testControllerHasAnalyzerRecipient()
	{
		$this
			->given(
				$aAnalyzer = new mockOfFizzbuzz\analyzer,
				$bAnalyzer = new mockOfFizzbuzz\analyzer,
				$cAnalyzer = new mockOfFizzbuzz\analyzer,

				$recipient = new mockOfFizzbuzz\analyzer\iterator\recipient,
				$this->calling($recipient)->iteratorHasAnalyzer = function($iterator, $analyzer) use (& $iteratorForRecipient) {
					$iteratorForRecipient = $iterator;
				}
			)
			->if(
				$this->newTestedInstance($aAnalyzer, $bAnalyzer, $cAnalyzer)
			)
			->then
				->object($this->testedInstance->recipientOfAnalyzerIs($recipient))
					->isEqualTo($this->newTestedInstance($aAnalyzer, $bAnalyzer, $cAnalyzer))
				->mock($recipient)
					->receive('iteratorHasAnalyzer')
						->withIdenticalArguments($iteratorForRecipient, $aAnalyzer)
							->once
						->withIdenticalArguments($iteratorForRecipient, $bAnalyzer)
							->once
						->withIdenticalArguments($iteratorForRecipient, $cAnalyzer)
							->once

			->given(
				$recipient = new mockOfFizzbuzz\analyzer\iterator\recipient,

				$this->calling($recipient)->iteratorHasAnalyzer = function($iterator, $analyzer) use (& $iteratorForRecipient) {
					$iteratorForRecipient = $iterator;

					$iterator->booleanAboutContinuationOfIterationIs(new boolean\false);
				}
			)
			->if(
				$this->testedInstance->recipientOfAnalyzerIs($recipient)
			)
			->then
				->mock($recipient)
					->receive('iteratorHasAnalyzer')
						->withIdenticalArguments($iteratorForRecipient, $aAnalyzer)
							->once
						->withIdenticalArguments($iteratorForRecipient, $bAnalyzer)
							->never
						->withIdenticalArguments($iteratorForRecipient, $cAnalyzer)
							->never
		;
	}

	function testBooleanAboutContinuationOfIteratorIs()
	{
		$this
			->given(
				$boolean = new mockOfFizzbuzz\boolean
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->booleanAboutContinuationOfIterationIs($boolean))
					->isEqualTo($this->newTestedInstance)
		;
	}
}
