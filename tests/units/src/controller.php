<?php namespace fizzbuzz\tests\units;

require __DIR__ . '/../runner.php';

use
	fizzbuzz\number,
	fizzbuzz\output,
	mock\fizzbuzz as mockOfFizzbuzz
;

class controller extends test
{
	function testClass()
	{
		$this->testedClass
			->implements('fizzbuzz\analyzer\controller')
		;
	}

	function testOutputForNumberIs()
	{
		$this
			->given(
				$analyzer = new mockOfFizzbuzz\analyzer,
				$number = new mockOfFizzbuzz\number,
				$output = new mockOfFizzbuzz\output
			)
			->if(
				$this->newTestedInstance($analyzer)
			)
			->then
				->object($this->testedInstance->outputForNumberIs($number, $output))
					->isEqualTo($this->newTestedInstance($analyzer))
				->mock($output)
					->receive('outputValueIs')
						->withArguments(new output\value)
							->once

			->given(
				$outputValue = new mockOfFizzbuzz\output\value,

				$this->calling($analyzer)->analyzerControllerHasNumber = function($controller, $number) use ($outputValue) {
					$controller->outputValueOfNumberIs($outputValue);
				}
			)
			->if(
				$this->testedInstance->outputForNumberIs($number, $output)
			)
			->then
				->mock($output)
					->receive('outputValueIs')
						->withIdenticalArguments($outputValue)
							->once
		;
	}

	function testOutputForNumberIteratorIs()
	{
		$this
			->given(
				$analyzer = new mockOfFizzbuzz\analyzer,
				$iterator = new mockOfFizzbuzz\number\iterator,
				$output = new mockOfFizzbuzz\output
			)
			->if(
				$this->newTestedInstance($analyzer)
			)
			->then
				->object($this->testedInstance->outputForNumberIteratorIs($iterator, $output))
					->isEqualTo($this->newTestedInstance($analyzer))
				->mock($output)
					->receive('outputValueIs')
						->never

			->given(
				$outputValue = new mockOfFizzbuzz\output\value,

				$aNumber = new mockOfFizzbuzz\number,

				$this->calling($iterator)->recipientOfNumberIs = function($recipient) use ($aNumber) {
					$recipient->numberIs($aNumber);
				},

				$this->calling($analyzer)->analyzerControllerHasNumber = function($controller, $number) use ($outputValue, $aNumber) {
					if ($aNumber === $number)
					{
						$controller->outputValueOfNumberIs($outputValue);
					}
				}
			)
			->if(
				$this->testedInstance->outputForNumberIteratorIs($iterator, $output)
			)
			->then
				->mock($output)
					->receive('outputValueIs')
						->withIdenticalArguments($outputValue)
							->once
		;
	}

	function testOutputValueOfNumberIs()
	{
		$this->object($this->newTestedInstance(new mockOfFizzbuzz\analyzer)->outputValueOfNumberIs(new mockOfFizzbuzz\output\value))->isTestedInstance;
	}

	function testNumberIs()
	{
		$this->object($this->newTestedInstance(new mockOfFizzbuzz\analyzer)->numberIs(new mockOfFizzbuzz\number))->isTestedInstance;
	}
}
